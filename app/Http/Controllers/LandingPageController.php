<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public static function testedBy()
    {
        return LandingPageControllertest::class;
    }

    public function show()
    {
        return view('welcome');
    }
}
