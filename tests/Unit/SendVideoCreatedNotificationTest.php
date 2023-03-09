<?php

namespace Tests\Unit;

use App\Events\VideoCreated as VideoCreatedEvent;
use App\Listeners\SendVideocreatedNotification;
use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class SendVideoCreatedNotificationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function handle_send_video_created_notification()
    {
        $sender = new SendVideocreatedNotification();
        Notification::fake();
        $sender->handle(new VideoCreatedEvent($video = Video::create([
            'title' => "hola",
            'description' => "adeu",
            'url' => "https://www.youtube.com/embed/AUWTpfH-M44"
        ])));
        $admins = config('casteaching.admins');
        Notification::assertSentTo(
            new AnonymousNotifiable, \App\Notifications\VideoCreated::class, function ($nonification,$channels,$notifiable)use($admins,$video){
                return in_array('mail',$channels)&& ($notifiable->routes['mail']=== $admins)&& Str::contains($nonification->toMail($notifiable)->render(),$video->title);
        }
);
    }
}
