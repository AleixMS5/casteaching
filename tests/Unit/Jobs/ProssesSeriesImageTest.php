<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProssesSeriesImage;
use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @covers  ProssesSeriesImage::class
 **/
class ProssesSeriesImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_resizes_the_series_image_height_to_400px()
    {
        Storage::fake('public');
       Storage::disk('public')->put('series/serie-example.png',file_get_contents( $path=base_path('tests/Fixtures/img.png')));
        $originalSize= filesize($path);

        $serie = Serie::create([
            'title' => 'TDD 101',
            'description' => 'Aprèn tot sobre TDD',
            'image' => 'series/serie-example.png'

        ]);

        ProssesSeriesImage::dispatch($serie);
        $resizedImage=Storage::disk('public')->get('series/serie-example.png');
        list($with,$heith)=getimagesizefromstring($resizedImage);

        $this->assertEquals(400,$heith);
        $this->assertEquals(711,$with);
        $newSize= Storage::disk('public')->size('series/serie-example.png');
        $this->assertLessThan($originalSize,$newSize);

    }
}
