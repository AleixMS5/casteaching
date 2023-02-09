<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideosManageVueControllerTest extends TestCase
{
    /**
     @test
     */
    public function test_example()
    {
        $response = $this->get('/vue/manage/videos');

        $response->assertStatus(200);
    }
}
