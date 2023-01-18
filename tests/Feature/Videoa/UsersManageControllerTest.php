<?php

namespace Tests\Feature\Videoa;


use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function user_with_permissions_can_store_users()
    {
        $this->loginAsUserManager();
        $user = objectify(['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);

        $response = $this->post('/manage/users', ['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response->assertRedirect(route('manage.users'));
        $response->assertSessionHas('succes', 'Succesfully created');
        $UserDB = User::first();
        $this->assertNotNull($UserDB);
        $this->assertEquals($UserDB->title, $user->title);
        $this->assertEquals($UserDB->description, $user->description);
        $this->assertEquals($UserDB->url, $user->url);

    }
    /** @test */
    public function user_without_permissions_cannot_add_users()
    {
        $this->loginAsRegularUser();
        $user = objectify(['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);

        $response = $this->post('/manage/users', ['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);

        $response ->assertStatus(403);
    }
    /** @test */
    public function user_with_permissions_can_delete_users()
    {
       $this->loginAsUserManager();
        $user = User::create(['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->delete('/manage/users/'.$user->id);
        $response->assertRedirect(route('manage.users'));
        $response->assertSessionHas('succes', 'Succesfully deleted');
        $this->assertNull(User::find($user->id));
        $this->assertNull($user->fresh());
    }

    /** @test */
    public function user_with_permissions_can_see_add_users()
    {
        $this->loginAsUserManager();
        $response = $this->get('/manage/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.manage.users');
        $response->assertSeeText(_('Create User'));
        $response->assertSee(_("form_user_create"));
    }

    /** @test */
    public function regular_user_can_not_see_add_users()
    {
        Permission::create(['name' => 'user_manage_index']);
        $user = User::create([
            'name' => 'pepe',
            'email' => 'pepe',
            'password' => Hash::make('12345678')
        ]);

        $user->givePermissionTo('user_manage_index');
        add_personal_team($user);
        Auth::login($user);

        $response = $this->get('/manage/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.manage.users');

        $response->assertDontSee(_("form_user_create"));
    }
    /** @test */
    public function regular_users_cannot_manage_users(){

        $this->loginAsRegularUser();
        $response = $this->get('/manage/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_users(){

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

