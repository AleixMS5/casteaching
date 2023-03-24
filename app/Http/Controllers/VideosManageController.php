<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
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
        return view('videos.manage.index', ['videos' => Video::all()]);
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' =>'required',
        ]);
        $video=Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'serie_id'=>$request->serie_id

        ]);
        session()->flash('succes', 'Succesfully created');

        VideoCreated::dispatch($video);

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
        return view('videos.manage.edit', ['video' => Video::findOrFail($id)]);
    }

    /**
     * prosesa el formulari i guarda les modificacions
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->url = $request->url;
        $video->serie_id=$request->serie_id;
        $video->save();
        session()->flash('succes', 'Succesfully updated');
        return redirect()->route('manage.videos');
    }

    /**
     * borrar un video
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('succes', 'Succesfully deleted');
        return redirect()->route('manage.videos');
    }
}
