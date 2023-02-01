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
    public function user_with_permissions_can_update_users()
    {
        $this->loginAsUserManager();
        $user = User::create(['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->put('/manage/users/' . $user->id,['name' => 'title 2',
            'email' => 'description2@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=202']);

        $response->assertRedirect(route('manage.users'));
        $response->assertSessionHas('succes', 'Succesfully updated');
        $newVideo= User::find($user->id);
        $this->assertEquals('title 2',$newVideo->name);
        $this->assertEquals('description2@gmail.com',$newVideo->email);
        $this->assertEquals($user->id,$newVideo->id);


    }
    /** @test */
    public function user_with_permissions_can_see_edit_users ()
    {
        $this->loginAsUserManager();
        $user = User::create(['name' => 'title',
            'email' => 'description@gmail.com',
            'password' => 'https://www.youtube.com/watch?v=Tt8z8X8xv14&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=20']);
        $response = $this->get('/manage/users/'.$user->id);

        $response->assertStatus(200);
        $response->assertViewIs('users.manage.edit');

        $response->assertSee("<form",false);
        $response->assertViewHas('user',function ($v) use ($user){
            return $user->is($v);
        });

        $response->assertSeeText($user->name);
        $response->assertSee($user->email);

    }
    /** @test */
    public function user_with_permissions_can_store_users()
    {
        $this->loginAsUserManager();
        $user = objectify(['name' => 'UserAdmi',
            'email' => 'aseradmin@gmail.com',
            'password' => '1234']);

        $response = $this->post('/manage/users', ['name' => 'UserAdmi',
            'email' => 'aseradmin@gmail.com',
            'password' => '1234']);
        $response->assertRedirect(route('manage.users'));
        $response->assertSessionHas('succes', 'Succesfully created');

        $UserDB = User::where('email','aseradmin@gmail.com')->first();
//        dd($UserDB->password,Hash::make($user->password));

        $this->assertNotNull($UserDB);
        $this->assertEquals($UserDB->name, $user->name);
        $this->assertEquals($UserDB->email, $user->email);
        $this->assertTrue(Hash::check($user->password,$UserDB->password));

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

