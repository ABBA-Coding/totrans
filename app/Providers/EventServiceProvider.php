<?php

namespace App\Providers;

use App\Models\Application;
use App\Models\Batch;
use App\Models\Feedback;
use App\Observers\BatchObserver;
use App\Observers\FeedbackObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Feedback::observe(FeedbackObserver::class);
        Batch::observe(BatchObserver::class);

        parent::boot();

        //
    }
}
