<?php

namespace App\Observers;

use App\Models\Batch;
use App\Services\BitrixService;

class BatchObserver
{
    public $status = [
        Batch::STATUS_WAITING => 320,
        Batch::STATUS_PROCESSING => 322,
        Batch::STATUS_COMPLETED => 324,
        Batch::STATUS_REJECTED => 326,
    ];

    public $states = [
        7 => 328,
        8 => 330,
        14 => 332,
        15 => 334,
        16 => 336,
        17 => 338,
        18 => 340,
        5 => 342,
        6 => 344
    ];

    public $service;

    public function __construct()
    {
        $this->service = new BitrixService();
    }

    public function updated(Batch $batch)
    {
        if($batch->wasChanged('status')) {
            $applications = $batch->applications;
            foreach ($applications as $application){
                $this->service->updateDealStatus($application->bitrix_id, $this->status[$batch->status]);
            }
        }

        if($batch->wasChanged('state_id')) {
            $applications = $batch->applications;
            foreach ($applications as $application){
                $this->service->updateDealState($application->bitrix_id, $this->states[$batch->state_id]);
            }
        }
    }
}
