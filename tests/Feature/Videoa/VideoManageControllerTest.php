<?php

namespace Tests\Feature\Videoa;


use App\Events\VideoCreated;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

use Tests\Feature\Traits\Canlogin;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use function GuzzleHttp\Promise\all;

/**
 * @covers \App\Http\Controllers\VideosManageController
 */
class VideoManageControllerTest extends TestCase
{
    use RefreshDatabase ,Canlogin;

    /** @test */
    public function user_with_permissions_can_update_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::create(['title' => 'title 2',
            'description' => 'description 2',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->put('/manage/videos/' . $video->id,[
            'title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20'
        ]);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('succes', 'Succesfully updated');
        $newVideo= Video::find($video->id);
        $this->assertEquals('title',$newVideo->title);
        $this->assertEquals('description',$newVideo->description);
        $this->assertEquals($video->id,$newVideo->id);
        $this->assertEquals('https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20',$newVideo->url);

    }

    /** @test */
    public function user_with_permissions_can_see_edit_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::create(['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->get('/manage/videos/' . $video->id);

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.edit');
        $response->assertViewHas('video', function ($v) use ($video) {
            return $video->is($v);
        });
        $response->assertSee("<form", false);
        $response->assertSeeText($video->title);
        $response->assertSeeText($video->description);
        $response->assertSee($video->url);
    }

    /** @test */
    public function user_with_permissions_can_store_videos()
    {
        $this->loginAsVideoManager();
        $video = objectify(['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        Event::fake();


        $response = $this->post('/manage/videos', ['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        Event::assertDispatched(VideoCreated::class);
        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('succes', 'Succesfully created');
        $videoDB = Video::first();

        $this->assertNotNull($videoDB);
        $this->assertEquals($video->title,$videoDB->title );
        $this->assertEquals($videoDB->description, $video->description);
        $this->assertEquals($videoDB->url, $video->url);

    }

    /** @test */
    public function user_with_permissions_can_delete_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::create(['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->delete('/manage/videos/' . $video->id);
        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('succes', 'Succesfully deleted');
        $this->assertNull(Video::find($video->id));
        $this->assertNull($video->fresh());
    }

    /** @test */
    public function user_without_permissions_cannot_delete_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::create(['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->delete('/manage/videos/' . $video->id);
        $response->assertStatus(403);
    }

    /** @test */
    public function user_without_permissions_cannot_add_videos()
    {
        $this->loginAsRegularUser();
        $video = objectify(['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);

        $response = $this->post('/manage/videos', ['title' => 'title',
            'description' => 'description',
            'url' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);

        $response->assertStatus(403);
    }


    /** @test */
    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();
        $response = $this->get('/manage/videos');
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertSee("<form", false);
    }

    /** @test */
    public function regular_user_can_not_see_add_videos()
    {
        Permission::create(['name' => 'videos_manage_index']);
        $user = User::create([
            'name' => 'pepe',
            'email' => 'pepe',
            'password' => Hash::make('12345678')
        ]);

        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);
        Auth::login($user);

        $response = $this->get('/manage/videos');
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertDontSee(_("form_video_create"));
    }

    /** @test */
    public function user_with_permissions_can_manage_videos()
    {

        $videos = create_sample_videos();
        $this->loginAsVideoManager();


        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('videos', function ($v) use ($videos) {
            return $v->count() === count($videos) && get_class($v) === Collection::class &&
                get_class($videos[0]) === Video::class;

        });

        foreach ($videos as $video) {

            $response->assertSee($video->title);
            $response->assertSee($video->id);

        }
    }

    /** @test */
    public function regular_users_cannot_manage_videos()
    {

        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_videos()
    {

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



}

