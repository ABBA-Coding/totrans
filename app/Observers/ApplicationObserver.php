<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\Batch;
use App\Services\BitrixService;

class ApplicationObserver
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

    public function updated(Application $application)
    {
        if($application->wasChanged('batch_id'))
        {
            $batch = Batch::find($application->batch_id);
            (new BitrixService())->assignBatch($application->bitrix_id, $batch->batch_number, $this->status[$batch->status], $this->states[$batch->state_id]);
            \Log::info('Batch assigned to application', [$application->bitrix_id, $batch->batch_number, $this->status[$batch->status], $this->states[$batch->state_id]]);
        }
    }
}
