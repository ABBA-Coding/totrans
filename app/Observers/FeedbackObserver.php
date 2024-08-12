<?php

namespace App\Observers;

use App\Models\Feedback;
use App\Services\BitrixService;

class FeedbackObserver
{
    public function created(Feedback $feedback): void
    {
        #$service = new BitrixService();
        #$service->createFeedback($feedback->id);
    }
}
