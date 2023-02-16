<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\Traits\Canlogin;
use Tests\TestCase;

class VideosManageVueControllerTest extends TestCase
{
    use RefreshDatabase, Canlogin;
    /**
     @test
     */
    public function user_with_permisions_can_manage_videos()
    {
        $this->loginAsVideoManager();
        $response = $this->get('/vue/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.vue.index');

    }


}
