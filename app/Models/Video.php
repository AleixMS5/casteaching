<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tests\Feature\VideoTest;

class Video extends Model
{


    public static function testedBy(){
        return VideoTest::class;
    }

    use HasFactory;
    protected $guarded= [];
    protected $dates =['published_at'];

//formatted_published_at accesor
    public function getFormattedPublishedAtAttribute()
    {
        if (!$this->published_at) return '';

        $locale_date = $this->published_at->locale(config('app.locale'));
        return $locale_date->day . ' de ' . $locale_date->monthName . ' de ' . $locale_date->year;
    }

    public function getFormattedForHumansPublishedAtAttribute()
    {
        return optional($this->published_at)->diffForHumans(Carbon::now());
    }
}
