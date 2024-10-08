<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Services\BitrixService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BitrixController extends Controller
{
    public $cities = [
        412 => 5,
        410 => 2,
        414 => 1
    ];

    protected $deliveryTypes = [
        310 => Application::DELIVERY_TYPE_AUTO,
        312 => Application::DELIVERY_TYPE_AIR,
        314 => Application::DELIVERY_TYPE_TRAIN,
        316 => Application::DELIVERY_TYPE_MARINE,
        318 => Application::DELIVERY_TYPE_ALL,
    ];

    public function hook(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|integer',
        ]);

        $service = new BitrixService();
        $deal = $service->getDeal($params['id']);
        $contactId = $deal['UF_CRM_1714110375'];
        $user = User::where('login', $contactId)->first();
        if (!$user) {
            $service->addCommentToDeal($params['id'], 'CLIENT_ID : ' . $contactId . ' ни сайтга киритиб кайтадан уриниб куринг.');
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
        $pointA = $this->cities[$deal['UF_CRM_1712659161']];
        $pointB = $this->cities[$deal['UF_CRM_1712659280']];
        $deliveryType = $this->deliveryTypes[$deal['UF_CRM_1712315079793']];
        $weight = $this->convertEmptyToNull($deal['UF_CRM_1709990572889']);
        if(Application::where('bitrix_id', $deal['ID'])->exists()){
            $application = Application::where('bitrix_id', $deal['ID'])->first();
        }else{
            $application = new Application();
        }
        $application->application_number = $deal['ID'];
        $application->user_id = $user->id;
        $application->point_a_id = $pointA;
        $application->point_b_id = $pointB;
        $application->delivery_type = $deliveryType;
        $application->weight = $weight;
        $application->price = $deal['OPPORTUNITY'];
        $application->order_date = date('d.m.Y');
        $application->volume = $this->convertEmptyToNull($deal['UF_CRM_1709990549049']);
        $application->mileage = $this->convertEmptyToNull($deal['UF_CRM_1712898713429']);
        $application->bitrix_id = $deal['ID'];
        $application->save();

        return response()->json([
            'success' => true,
            'message' => 'Application created successfully'
        ]);
    }

    public function convertEmptyToNull($value)
    {
        return $value === '' ? null : $value;
    }
}
