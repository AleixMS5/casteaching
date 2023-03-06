<?php

namespace App\Console\Commands;

use App\Models\Video;
use App\Notifications\VideoCreated;
use Illuminate\Console\Command;

class TestSendVideoCreatedEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:videocreatednotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'bla bla bla';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $video1 = Video::create([
            'title' => 'Video 1',
            'description' => 'Descripció',
            'url' => 'https://www.youtube.com/embed/jKMTRtkXAF0'
        ]);

        Notification::route('mail', 'amontero@iesebre.com')->notify(new VideoCreated($video1));

    }
}
