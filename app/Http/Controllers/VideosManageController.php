<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Feature\Videoa\VideoManageControllerTest;

class VideosManageController extends Controller
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
        return view('videos.manage.index',['videos'=>Video::all()]);
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

        Video::create([
'title'=>$request->title,
            'description'=>$request->description,
            'url'=>$request->url
        ]);
        session()->flash('succes','Succesfully created');
        return redirect()->route('manage.videos');
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
       return view('videos.manage.edit',['video'=>Video::findOrFail($id)]);
    }

    /**
     * prosesa el formulari i guarda les modificacions
     */
    public function update(Request $request, $id)
    {
        $video=Video::findOrFail($id);
        $video->title=$request->title;
        $video->description=$request->description;
        $video->url=$request->url;
        $video->save();
        session()->flash('succes','Succesfully updated');
        return redirect()->route('manage.videos');
    }

    /**
     * borrar un video
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('succes','Succesfully deleted');
        return redirect()->route('manage.videos');
    }
}
