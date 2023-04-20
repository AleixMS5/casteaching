<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Tests\Feature\VideoTest;

use Illuminate\Support\Facades\Auth;


class VideosController extends Controller
{
    public static function testedBy()
    {
        return VideoTest::class;
    }
    public function show($id)
    {
        $video = Video::findOrFail($id);
        if ($video->published_at === null) {
            if (!optional(Auth::user())->can('videos_manage_show')) {
                if ($video->user_id === null){
                    abort(404);
                }
                if (!($video->user_id == optional(Auth::user())->id)) {
                    abort (404);
                }
            }
        }

        return view(collect($video->serie?->videos)->count()>0 ?'videos.show': 'videos.show_without_serie',  ['video' =>$video,'videos_series'=> collect($video->serie?->videos)]);
    }
}
