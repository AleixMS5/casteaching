<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @covers \App\Models\Serie
*/
class SerieTest extends TestCase
{
    use RefreshDatabase;
    /**
     @test
     */
    public function Serie_have_videos()
    {
        $serie1=Serie::create([
            'title'=>'TDD',

            'description'=>'imatge',

            'image'=>'tdd.jepg',
            'teacher_name'=>'Aleix Montero Sabaté',
            'teacher_photo_url'=>'https://www.gravatar.com/avatar/'.md5('sergiturbadenas@gmail.com'),
            'created_at'=>Carbon::now()->addSeconds(1)
        ]);
        $video=Video::create([
            'title' => '132 2022 01 20 Laravel Database Relationships Relació 1 a n series i videos',
            'description' => 'bla bla bla',
            'url' => 'https://www.youtube.com/embed/VTIqo4fGkMs',
            'serie_id'=>$serie1->id
        ]);
        $this->assertNotNull( $serie1->videos);
        $this->assertCount(1,$serie1->videos);
    }
}
