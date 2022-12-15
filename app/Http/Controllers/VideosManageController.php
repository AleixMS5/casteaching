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
        //
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
        //
    }
}
