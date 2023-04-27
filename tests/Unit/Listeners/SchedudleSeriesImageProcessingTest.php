<?php

namespace Tests\Unit\Listeners;

use App\Events\SeriesImageUpdated;
use App\Jobs\ProssesSeriesImage;
use App\Models\Serie;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SchedudleSeriesImageProcessingTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_queues_a_job_to_process_series_image()
    {
        Queue::fake();
        $serie = Serie::create([
            'title' => 'TDD 101',
            'description' => 'Aprèn tot sobre TDD',
            'image' => 'serieTDD.png',
            'teacher_name' => 'Sergi Tur'
        ]);
        SeriesImageUpdated::dispatch($serie);

        Queue::assertPushed(ProssesSeriesImage::class,function ($job) use ($serie){
            return $serie->is($job->serie);
        });
    }


    /**
     * @test
     */
    public function it_not_queues_a_job_to_process_series_image_if_image_not_exists()
    {
        Queue::fake();
        $serie = Serie::create([
            'title' => 'TDD 101',
            'description' => 'Aprèn tot sobre TDD',


        ]);
        SeriesImageUpdated::dispatch($serie);

        Queue::assertNotPushed(ProssesSeriesImage::class);
    }
}
