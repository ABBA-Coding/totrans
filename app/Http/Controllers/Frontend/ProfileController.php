<?php

namespace App\Http\Controllers\Frontend;

use  App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Application;
use App\Models\Batch;
use App\Models\District;
use App\Models\Manager;
use App\Models\Setting;
use App\Models\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    const STATUS_ACTIVE = 1;

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
        $applications = Application::with('pointA.country', 'pointB.country', 'batch.state.parent')
            ->whereHas('batch', function ($batch) {
                $batch->whereIn('status', [Batch::STATUS_WAITING, Batch::STATUS_PROCESSING]);
            })
            ->where('user_id', Auth::id())
            ->get();

        $manager = Manager::with('file')->find(Auth::user()->manager_id);
        $states = State::with('children')->whereNull('parent_id')->orderBy('sort')->get();
        return view('frontend.profile-home', compact('applications', 'manager', 'states'));
    }

    public function orders()
    {
        $applications = Application::with('pointA.country', 'pointB.country', 'batch.state.parent')
            ->whereHas('batch', function ($batch) {
                $batch->where('status', Batch::STATUS_COMPLETED);
            })
            ->where('user_id', Auth::id())
            ->get();
        $manager = Manager::with('file')->find(Auth::user()->manager_id);
        $states = State::with('children')->whereNull('parent_id')->orderBy('sort', 'asc')->get();

        // statistics
        $currentMonth = Application::whereHas('batch', function ($batch) {
                $batch->where('status', Batch::STATUS_COMPLETED);
            })
            ->whereBetween('arrival_date', [Carbon::now()->startOfMonth()->unix(), Carbon::now()->endOfMonth()->unix()])
            ->where('user_id', Auth::id())
            ->count();

        $prevMonth = Application::whereHas('batch', function ($batch) {
                $batch->where('status', Batch::STATUS_COMPLETED);
            })
            ->whereBetween('arrival_date', [Carbon::now()->subMonth()->startOfMonth()->unix(), Carbon::now()->subMonth()->endOfMonth()->unix()])
            ->where('user_id', Auth::id())
            ->count();

        $currentYear = Application::whereHas('batch', function ($batch) {
                $batch->where('status', Batch::STATUS_COMPLETED);
            })
            ->whereBetween('arrival_date', [Carbon::now()->startOfYear()->unix(), Carbon::now()->endOfDay()->unix()])
            ->where('user_id', Auth::id())
            ->count();

        $statistics = [
            'currentMonth' => $currentMonth,
            'prevMonth' => $prevMonth,
            'currentYear' => $currentYear,
        ];

        return view('frontend.profile-orders', compact('applications', 'manager', 'states', 'statistics'));
    }

    public function settings()
    {
        $manager = Manager::with('file')->find(Auth::user()->manager_id);
        $user = User::with('activity')->findOrFail(Auth::id());
        $activities = Activity::active()->get();
        return view('frontend.profile-settings', compact('manager', 'user', 'activities'));
    }

    public function settingsPost(Request $request)
    {
        $request->validate([
            'name' => 'string|nullable',
            'phone' => 'string|nullable',
            'company_name' => 'string|nullable',
            'email' => 'string|email|nullable',
            'activity_id' => 'int|nullable'
        ]);

        $data = $request->only(['name', 'phone', 'email', 'activity_id', 'company_name']);
        $user = Auth::user();

        $user->update($data);

        return redirect()->route('profile.settings')->with('success', 'Успешно изменено');
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function loginPost(Request $request)
    {
        $data = $request->except(['_token']);

        if (!User::where('login', $request->get('login'))->first()) {
            return redirect()->back()->with('error', 'Введен неверный логин или пароль');
        }

        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']])) {
            return redirect()->route('profile.home');
        } else {
            return redirect()->back()->with('error', 'Введен неверный логин или пароль');
        }
    }

    public function signUp()
    {
        return view('frontend.sign-up');
    }

    public function signUpSecondary()
    {
        $activities = Activity::active()->get();
        $managers = Manager::get();
        $districts = District::all();
        return view('frontend.sign-up-secondary', compact('activities', 'managers' , 'districts'));
    }

    public function signUpPost(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'phone' => 'string|required',
            'company_name' => 'string|nullable',
            'email' => 'string|email|nullable|unique:users,email',
            'activity_id' => 'int|required',
            'manager_id' => 'int|required',
            'district_id' => 'int|required',
            'password' => 'required'
        ]);

        $phone = preg_replace('/\D+/', null, $request->get('phone'));
        if (User::where('phone', $phone)->exists()) {
            return redirect()->back()->with('error', __('static.unique_phone_message'));
        }

        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'phone', 'company_name', 'email', 'activity_id', 'manager_id', 'district_id']);
            $data['password'] = bcrypt($request->get('password'));
            $data['login'] = User::generateLogin();

            $user = User::create($data);

            DB::table('roles')->insert([
                'user_id' => $user->id,
                'role' => User::ROLE_CLIENT
            ]);

            Auth::login($user);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->route('profile.home', ['_id' => $user->login]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to(__('static.menu.home'));
    }
}
