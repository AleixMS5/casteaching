<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * @covers VideoApiController
 */
class VideoApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function regular_users_permissions_cannot_destroy_published_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->deleteJson('api/videos/'.$video->id);

        $response
            ->assertStatus(403);

        $this->assertNotNull(Video::find($video->id));
    }

    /**
     * @test
     */
    public function gest_users_permissions_cannot_destroy_published_videos()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->deleteJson('api/videos/'.$video->id);

        $response
            ->assertStatus(401);

        $this->assertNotNull(Video::find($video->id));
    }
    /**
     * @test
     */
    public function cant_delete_non_existing_videos()
    {
$this->loginAsVideoManager();
        $response = $this->deleteJson('api/videos/999');

        $response
            ->assertStatus(404);


    }

    /**
     * @test
     */
    public function users_with_permissions_can_destroy_published_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->deleteJson('api/videos/'.$video->id);

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('id')
                ->where('title', $video['title'])
                ->where('url', $video['url'])
                ->etc()
            );

        $this->assertNull( Video::find($response['id']));

    }    /**
     * @test
     */
    public function regular_users_permissions_cannot_edit_published_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->putJson('api/videos/'.$video->id);

        $response
            ->assertStatus(403);

        $this->assertNotNull(Video::find($video->id));
    }

    /**
     * @test
     */
    public function gest_users_permissions_cannot_edit_published_videos()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->putJson('api/videos/'.$video->id);

        $response
            ->assertStatus(401);

        $newvideo= Video::find($video->id);
        $this->assertEquals($newvideo->id, $video->id);
        $this->assertEquals($newvideo->title, $video->title);
        $this->assertEquals($newvideo->description, $video->description);
        $this->assertEquals($newvideo->url, $video->url);
    }
    /**
     * @test
     */
    public function cant_edit_non_existing_videos()
    {
$this->loginAsVideoManager();
        $response = $this->putJson('api/videos/999');

        $response
            ->assertStatus(404);


    }

    /**
     * @test
     */
    public function users_with_permissions_can_edit_published_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->deleteJson('api/videos/'.$video->id);

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json->has('id')
                ->where('title', $video['title'])
                ->where('url', $video['url'])
                ->etc()
            );

        $this->assertNull( Video::find($response['id']));

    }


    /**
     * @test
     */
    public function regular_users_permissions_cannot_store_published_videos()
    {
        $this->loginAsRegularUser();
        $response = $this->postJson('api/videos', $video = [
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);

        $response
            ->assertStatus(403);

        $this->assertCount(0, Video::all());
    }

    /**
     * @test
     */
    public function gest_users_permissions_cannot_store_published_videos()
    {

        $response = $this->postJson('api/videos', $video = [
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);

        $response
            ->assertStatus(401);

        $this->assertCount(0, Video::all());
    }

    /**
     * @test
     */
    public function users_with_permissions_can_store_published_videos()
    {
        $this->loginAsVideoManager();
        $response = $this->postJson('api/videos', $video = [
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);

        $response->assertStatus(201)
            ->assertJson(fn(AssertableJson $json) => $json->has('id')
                ->where('title', $video['title'])
                ->where('url', $video['url'])
                ->etc()
            );

        $newVideo = Video::find($response['id']);
        $this->assertEquals($response['id'], $newVideo->id);
        $this->assertEquals($response['title'], $newVideo->title);
        $this->assertEquals($response['url'], $newVideo->url);
        $this->assertEquals($response['url'], $newVideo->url);
    }

    /**
     * @test
     */
    public function gest_users_can_index_published_videos()
    {
        $videos = create_sample_videos();
        $response = $this->get('/api/videos/');

        $response->assertStatus(200);
        $response->assertJsonCount(count($videos));
    }

    /**
     * @test
     */
    public function gest_users_can_show_published_videos()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I'

        ]);
        $response = $this->getJson('/api/videos/' . $video->id);

        $response->assertStatus(200);
        $response->assertSee($video->title);
        $response->assertSee($video->description);
        $response->assertJsonPath('title', $video->title);

    }

    /**
     * @test
     */
    public function gest_users_cannot_show_unexisting_videos()
    {
        $response = $this->get('/api/videos/1');

        $response->assertStatus(404);
    }

    private function loginAsVideoManager()
    {
        Auth::login(create_video_manager_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}
