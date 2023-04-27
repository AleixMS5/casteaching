<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SendVideocreatedNotification implements  ShouldQueue
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoCreated $event)
    {
        Notification::route('mail', config('casteaching.admins'))->notify(new \App\Notifications\VideoCreated($event->video));
    }
}
