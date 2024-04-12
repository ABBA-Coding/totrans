<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Services\BitrixService;
use Illuminate\Http\Request;

class BitrixController extends Controller
{
    public function hook(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|integer',
        ]);

        $service = new BitrixService();
        $service->getDeal($params['id']);

        $application = new Application();


    }
}
