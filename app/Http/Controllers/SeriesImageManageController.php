<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Tests\Feature\SeriesImageManageControllerTest;

class SeriesImageManageController extends Controller
{
    public static function testedBy()
    {
        return SeriesImageManageControllerTest::class;
  }

    public function update(Request $request)
    {   $serie=Serie::findOrFail($request->id) ;

        $serie->image= $request->file('image')->store('series','public');

        $serie->save();
        return back()->withInput();
  }

}
