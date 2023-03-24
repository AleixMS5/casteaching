<?php

namespace Tests\Feature\Videoa;

use App\Models\Serie;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
*@covers \App\Http\Controllers\VideosController
 */
class VideoTest extends TestCase
{
    use RefreshDatabase;
    /**
    *
     * @test
     */
    public function users_can_view_videos()
    {
        //PREPARE
        //Wishful programming
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        //EXECUTION
        // Http test
        $response = $this->get('/videos/' . $video->id);


        //ASSERTIONS
        $response->assertStatus(200);
        $response->assertSee('Title here');
        $response->assertSee('Description here');
        $response->assertSee('13 de desembre de 2020');
    }




    /**
     *
     * @test
     */
    public function users_can_not_view_not_existing_videos()
    { $response = $this->get('/videos/9999');

        $response->assertStatus(404);
    }

    /**
     *
     * @test
     */
    public function video_have_serie()
    {
        $serie1=Serie::create([
            'title'=>'TDD',

            'description'=>'imatge',

            'image'=>'tdd.jepg',
            'teacher_name'=>'Aleix Montero Sabaté',
            'teacher_photo_url'=>'https://www.gravatar.com/avatar/'.md5('sergiturbadenas@gmail.com'),
            'created_at'=> \Illuminate\Support\Carbon::now()->addSeconds(1)
        ]);
        $video=Video::create([
            'title' => '132 2022 01 20 Laravel Database Relationships Relació 1 a n series i videos',
            'description' => 'bla bla bla',
            'url' => 'https://www.youtube.com/embed/VTIqo4fGkMs',

        ]);

        $this->assertNull($video->serie);

        $video->setSerie($serie1);

        $this->assertNotNull($video->fresh()->serie);
    }
    }
