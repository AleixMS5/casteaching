<?php

namespace Tests\Feature\Videoa;


use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use function GuzzleHttp\Promise\all;

/**
* @covers \App\Http\Controllers\UsersManageController
 */
class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function regular_users_cannot_manage_videos(){

        $this->loginAsRegularUser();
        $response = $this->get('/manage/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_videos(){

        $response = $this->get('/manage/users');
        $response->assertRedirect(route('login'));
    }


    /** @test */
    public function superadmins_can_manage_users()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.users');
    }

    /** @test */
    public function usermanagers_can_manage_users()
    {
        $this->loginAsUserManager();

        $response = $this->get('/manage/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.users');
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

    private function loginAsUserManager()
    {
        Auth::login(create_useradmin_user());
    }
}

