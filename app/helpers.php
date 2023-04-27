<?php

use App\Models\Serie;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

if(! function_exists('create_default_user')){
    function create_default_user(){
        $user=User::create([
            'name' => config('casteaching.default_user.name', 'Sergi Tur Badenas'),
            'email' => config('casteaching.default_user.email','sergiturbadenas@gmail.com'),
            'password' => Hash::make(config('casteaching.default_user.password','1234567'))
        ]);
        $user->superadmin=true;
        $user->save();

        try {
            Team::create([
                'name' => $user->name."'s team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        }catch (\Exception $exception){

        }


    }


}
if(! function_exists('create_default_videos')){
    function create_default_videos(){
        Video::create([
            'title'=> 'Ubuntu 101',
            'description'=>'',
            'url'=> 'https://youtu.be/w8j07_DBl_I',
            'published_at'=>Carbon::parse('December 13,2020 8:00pm'),
            'previous'=>null,
            'next'=>null,
            'series_id'=>1
        ]);

    }
}
if (!function_exists('create_regular_user')) {
    function create_regular_user()
    {
        $user = User::create([
            'name' => 'pepe',
            'email' => 'pepe@casteaching.com',
            'password' => Hash::make('12345678')
        ]);
        add_personal_team($user);

        return $user;
    }
}

if (!function_exists('create_superadmin_user')) {
    function create_superadmin_user()
    {
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $user->superadmin = true;
        $user->save();

        add_personal_team($user);

        return $user;
    }
}

if (!function_exists('create_sergi_tur')) {
    function create_sergi_tur()
    {
        $user = User::create([
            'name' => 'Sergi',
            'email' => 'sergiturbadenas@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $user->superadmin = true;
        $user->save();

        add_personal_team($user);

        return $user;
    }
}

if (!function_exists('create_useradmin_user')) {
    function create_useradmin_user()
    {
        Permission::create(['name' => 'user_manage_index']);
        Permission::create(['name' => 'users_manage_create']);
        Permission::create(['name' => 'users_manage_delete']);
        Permission::create(['name' => 'users_manage_add']);
        Permission::create(['name' => 'users_manage_edit']);
        Permission::create(['name' => 'users_manage_update']);
        $user = User::create([
            'name' => 'UserAdmin',
            'email' => 'useradmin@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $user->givePermissionTo('user_manage_index');
        $user->givePermissionTo('users_manage_create');
        $user->givePermissionTo('users_manage_delete');
        $user->givePermissionTo('users_manage_add');
        $user->givePermissionTo('users_manage_edit');
        $user->givePermissionTo('users_manage_update');
        add_personal_team($user);

        return $user;
    }
}

if (!function_exists('add_personal_team')) {
    function add_personal_team($user): void
    {
        try {
            $team = Team::forceCreate([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}

if (!function_exists('create_video_manager_user')) {
    function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'VideosManager',
            'email' => 'videosmanager@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);

        Permission::create(['name' => 'videos_manage_index']);
        Permission::create(['name' => 'videos_manage_create']);
        Permission::create(['name' => 'videos_manage_delete']);
        Permission::create(['name' => 'videos_manage_add']);
        Permission::create(['name' => 'videos_manage_edit']);
        Permission::create(['name' => 'videos_manage_update']);
        $user->givePermissionTo('videos_manage_index');
        $user->givePermissionTo('videos_manage_create');
        $user->givePermissionTo('videos_manage_delete');
        $user->givePermissionTo('videos_manage_add');
        $user->givePermissionTo('videos_manage_edit');
        $user->givePermissionTo('videos_manage_update');
        add_personal_team($user);
        return $user;
    }
}
if (!function_exists('define_gates')) {
    function define_gates()
    {
        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}

if (!function_exists('create_permissions')) {
    function create_permissions()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
        Permission::firstOrCreate(['name' => 'videos_manage_create']);
        Permission::firstOrCreate(['name' => 'users_manage_delete']);
        Permission::firstOrCreate(['name' => 'users_manage_add']);
        Permission::firstOrCreate(['name' => 'videos_manage_delete']);
        Permission::firstOrCreate(['name' => 'videos_manage_add']);
        Permission::firstOrCreate(['name' => 'users_manage_edit']);
        Permission::firstOrCreate(['name' => 'videos_manage_edit']);
        Permission::firstOrCreate(['name' => 'users_manage_update']);
        Permission::firstOrCreate(['name' => 'videos_manage_update']);
    }
}


if (!function_exists('create_sample_videos')) {
    function create_sample_videos()
    {
        $video1 = Video::create([
            'title' => 'Video 1',
            'description' => 'Descripció',
            'url' => 'https://www.youtube.com/embed/jKMTRtkXAF0',
            'published_at'=>Carbon::parse('December 13,2020 8:00pm'),
             'serie_id' => 1
        ]);
        $video2 = Video::create([
            'title' => 'Video 2',
            'description' => 'Descripció',
            'url' => 'https://www.youtube.com/embed/jKMTRtkXAF0',
            'published_at'=>Carbon::parse('December 13,2020 8:00pm'),
            'serie_id' => 2
        ]);
        $video2->markAsOnlyForSubscribers();
        $video3 = Video::create([
            'title' => 'Video 3',
            'description' => 'Descripció',
            'url' => 'https://www.youtube.com/embed/jKMTRtkXAF0',
            'published_at'=>Carbon::parse('December 13,2020 8:00pm'),
            'serie_id' => 3
        ]);
        return [$video1,$video2,$video3];
    }
}
if (! function_exists('create_series_manager_user')) {
    function create_series_manager_user() {
        $user = User::create([
            'name' => 'SeriesManager',
            'email' => 'seriesmanager@casteaching.com',
            'password' => Hash::make('12345678')
        ]);

        Permission::create(['name' => 'series_manage_index']);
        Permission::create(['name' => 'series_manage_show']);
        Permission::create(['name' => 'series_manage_create']);
        Permission::create(['name' => 'series_manage_store']);
        Permission::create(['name' => 'series_manage_edit']);
        Permission::create(['name' => 'series_manage_update']);
        Permission::create(['name' => 'series_manage_destroy']);
        $user->givePermissionTo('series_manage_index');
        $user->givePermissionTo('series_manage_show');
        $user->givePermissionTo('series_manage_create');
        $user->givePermissionTo('series_manage_store');
        $user->givePermissionTo('series_manage_destroy');
        $user->givePermissionTo('series_manage_edit');
        $user->givePermissionTo('series_manage_update');

        add_personal_team($user);
        return $user;
    }
}

if (! function_exists('create_placeholder_series_image')) {
    function create_placeholder_series_image()
    {
        return Storage::disk('public')->putFileAs('series', new File(base_path('/series_photos/placeholder.jpeg')),'placeholder.jpeg');
    }
}

if (! function_exists('create_sample_series')) {
    function create_sample_series()
    {
        $path=Storage::disk('public')->putFile('series',new File(base_path("series_photos/tdd.jpeg")));
        $serie1 = Serie::create([
            'title' => 'TDD (Test Driven Development)',
            'description' => 'Bla bla bla',
            'image' => $path,
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com')
        ]);

        sleep(1);
        $path=Storage::disk('public')->putFile('series',new File(base_path("series_photos/tdd2.jpeg")));
        $serie2 = Serie::create([
            'title' => 'Crud amb Vue i Laravel',
            'description' => 'Bla bla bla',
            'image' =>  $path,
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com')
        ]);

        sleep(1);
        $path=Storage::disk('public')->putFile('series',new File(base_path("series_photos/tdd3.jpeg")));
        $serie3 = Serie::create([
            'title' => 'ionic Real world',
            'description' => 'Bla bla bla',
            'image' =>  $path,
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com')
        ]);

        sleep(1);

        $serie4 = Serie::create([
            'title' => 'Serie TODO',
            'description' => 'Bla bla bla',
        ]);

        $path=Storage::disk('public')->putFile('series',new File(base_path("series_photos/placeholder.jpeg")));
        $serie5 = Serie::create([
            'title' => 'prova',
            'description' => 'prova',
            'image' =>  $path,
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com')
        ]);

        return [$serie1,$serie2,$serie3,$serie4,$serie5];
    }
}

class DomainObject implements ArrayAccess, JsonSerializable
{
    private $data = [];

    /**
     * DomainObject constructor.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function __toString()
    {
        return (string) collect($this->data);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}


if (! function_exists('objectify')) {
    function objectify($array)
    {
        return new DomainObject($array);
    }
}


