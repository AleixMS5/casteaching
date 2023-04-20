<?php

namespace App\Providers;

use App\Actions\Fortify\SeriesImageUpdated;
use App\Events\VideoCreated;
use App\Listeners\SchedudleSeriesImageProcessing;
use App\Listeners\SendVideocreatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VideoCreated::class => [
            SendVideoCreatedNotification::class,
        ]
        ,SeriesImageUpdated::class=>[
            SchedudleSeriesImageProcessing::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
