<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\Videoa\VideoManageControllerTest;

class UsersManageController extends Controller
{

    public static function testedBy()
    {
        return VideoManageControllerTest::class;
    }

    /**
     * llistar videos
     */
    public function index()
    {
        return view('users.manage.users',['users'=>User::all()]);
    }

    /**
     * mostrar el formulari
     */
    public function create()
    {
        //
    }

    /**
     * guardar el video
     */
    public function store(Request $request)
    {
//        return response()->view('videos.manage.index',['videos'=>[]],201);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);
        session()->flash('succes','Succesfully created');
        return redirect()->route('manage.users');
    }

    /**
     * mostra un sol video
     */
    public function show($id)
    {
        //
    }

    /**
     * actualitza un video form
     */
    public function edit($id)
    {
        //
    }

    /**
     * prosesa el formulari i guarda les modificacions
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * borrar un video
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('succes','Succesfully deleted');
        return redirect()->route('manage.users');
    }
}
