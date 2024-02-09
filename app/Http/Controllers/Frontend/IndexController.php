<?php

namespace App\Http\Controllers\Frontend;

use  App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AdditionalFunction;
use App\Models\City;
use App\Models\Country;
use App\Models\Feedback;
use App\Models\Includes;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    const TRANSPORT_VOLUME = 110;
    const TRANSPORT_WEIGHT = 25000;

    public function __construct(Request $request)
    {
        if ($request->method() == 'GET') {
            $lang = App::getLocale();
            view()->share('lang', $lang);

            $setting = Setting::first();
            view()->share('setting', $setting);
        }
    }

    public function home()
    {
        return view('frontend.index');
    }

    public function calculator(Request $request)
    {
        $activities = Activity::active()->get();
        $from_countries = Country::with('cities')->active()->where('type', Country::POINT_A)->get();
        $to_countries = Country::with('cities')->active()->where('type', Country::POINT_B)->get();
        $additional_functions = AdditionalFunction::active()->get();
        $includes = Includes::active()->orderBy('sort', 'ASC')->get();

        $calculatorData = $request->all();

        if ($request->ajax()) {

            $view = '';

            $pointA = null;
            $pointB = null;
            $selectedActivity = null;
            $selectedAdditionalFunction = null;

            if (!empty($request->get('point_a_id'))) {
                $pointA = City::with('country')->findOrFail($request->point_a_id);
            }
            if (!empty($request->get('point_b_id'))) {
                $pointB = City::with('country')->findOrFail($request->point_b_id);
            }
            if (!empty($request->get('activity_id'))) {
                $selectedActivity = Activity::findOrFail($request->activity_id);
            }
            if (!empty($request->get('additional_function_id'))) {
                $selectedAdditionalFunction = AdditionalFunction::findOrFail($request->additional_function_id);
            }

            switch ($request->get('toTab')) {
                case 'route':
                    $view = view('frontend.components.tab-route', compact('from_countries', 'to_countries', 'activities', 'calculatorData'))->render();
                    break;
                case 'transport':
                    $request->validate([
                        'point_a_country_id' => 'required',
                        'point_b_country_id' => 'required',
                        'point_a_id' => 'required',
                        'point_b_id' => 'required',
                        'activity_id' => 'required'
                    ]);
                    $view = view('frontend.components.tab-transport', compact('calculatorData', 'pointA', 'pointB'))->render();
                    break;
                case 'detail':
                    $request->validate([
                        'point_a_country_id' => 'required',
                        'point_b_country_id' => 'required',
                        'point_a_id' => 'required',
                        'point_b_id' => 'required',
                        'activity_id' => 'required',
                        'volume' => 'required',
                        'weight' => 'required',
                    ]);
                    $price = $this->calculatePrice($request->all());
                    $view = view('frontend.components.tab-detail', compact('additional_functions', 'includes','calculatorData', 'pointA', 'pointB', 'selectedActivity', 'selectedAdditionalFunction', 'price'))->render();
                    break;
                case 'application':
                    $request->validate([
                        'point_a_country_id' => 'required',
                        'point_b_country_id' => 'required',
                        'point_a_id' => 'required',
                        'point_b_id' => 'required',
                        'activity_id' => 'required',
                        'volume' => 'required',
                        'weight' => 'required',
                        'name' => 'required',
                        'phone' => 'required'
                    ]);

                    $data = $request->all();
                    $data['order_date'] = Carbon::now()->unix();
                    Feedback::create($data);

                    return response()->json(['application' => true]);
            }

            return response()->json(['success' => true, 'view' => $view]);
        }

        return view('frontend.calculator', compact('activities', 'from_countries', 'to_countries', 'calculatorData'));
    }

    private function calculatePrice($data)
    {
        $city = City::findOrFail($data['point_a_id']);
        $transport_price = $city->transport_price ?? 0;

        $priceByVolume = ($transport_price / self::TRANSPORT_VOLUME) * $data['volume'];
        $priceByWeight = ($transport_price / self::TRANSPORT_WEIGHT) * $data['weight'];

        return $priceByVolume > $priceByWeight ? $priceByVolume : $priceByWeight;
    }
}
