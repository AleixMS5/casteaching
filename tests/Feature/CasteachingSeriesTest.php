<?php

namespace Tests\Feature;

use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
/**
 * @covers CasteachingSeries
**/
class CasteachingSeriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     @test
     */
    public function guest_users_can_see_published_series()
    {
        $serie1=Serie::create([
            'title'=>'TDD',

'description'=>'imatge',

'image'=>'tdd.png',
'teacher_name'=>'Aleix Montero Sabaté',
'teacher_photo_url'=>'https://www.gravatar.com/avatar/'.md5('sergiturbadenas@gmail.com')

        ]);

        $serie2=Serie::create([
            'title'=>'TDD2',

            'description'=>'imatge',

            'image'=>'tdd.png',
            'teacher_name'=>'Aleix Montero Sabaté',
            'teacher_photo_url'=>'https://www.gravatar.com/avatar/'.md5('sergiturbadenas@gmail.com')

        ]);

        $serie3=Serie::create([
            'title'=>'TDD3',

            'description'=>'imatge',

            'image'=>'tdd.png',
            'teacher_name'=>'Aleix Montero Sabaté',
            'teacher_photo_url'=>'https://www.gravatar.com/avatar/'.md5('sergiturbadenas@gmail.com')

        ]);
     $view= $this->blade('<x-casteaching-series/>');

     $view->assertSeeInOrder( [$serie3->title,$serie2->title,$serie1->title]);
    }
}
