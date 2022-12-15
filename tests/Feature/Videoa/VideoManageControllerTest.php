<?php

namespace Tests\Feature\Videoa;


use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use function GuzzleHttp\Promise\all;

/**
* @covers \App\Http\Controllers\VideosManageController
 */
class VideoManageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_with_permissions_can_manage_videos()
    {

        $videos = create_sample_videos();
        $this->loginAsVideoManager();



        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('videos',function ($v)use($videos){
            return $v->count() === count($videos) && get_class($v) === Collection::class &&
                get_class($videos[0]) === Video::class;

        });

        foreach ($videos as $video) {

            $response->assertSee($video->title);
            $response->assertSee($video->id);

        }
    }

    /** @test */
    public function regular_users_cannot_manage_videos(){

        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_videos(){

        $response = $this->get('/manage/videos');
        $response->assertRedirect(route('login'));
    }


    /** @test */
    public function superadmins_can_manage_videos()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
    }

    private function loginAsVideoManager()
    {
        Auth::login(create_video_manager_user());
    }


    private function loginAsSuperAdmin()
    {
        Auth::login(create_superadmin_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}

