<?php

namespace Tests\Feature;

use App\Models\Serie;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Feature\Traits\Canlogin;

/**
 * @covers SeriesImageManageController::class
 */
class SeriesImageManageControllerTest extends TestCase
{
    use RefreshDatabase, Canlogin;

    /**
     * @test
     */
    public function series_manager_can_update_image_series()
    {
        $this->loginAsSeriesManager();
        $serie = Serie::create([
            'title' => 'TDD 101',
            'description' => 'Aprèn tot sobre TDD',
            'image' => 'anterior.png',
            'teacher_name' => 'Sergi Tur'
        ]);
        Storage::fake();
        $response = $this->put('manage/series/image/' . $serie->id, [
            'image' => $file=UploadedFile::fake()->image('serie.jpg'),]);

        $response->assertRedirect();

        Storage::disk()->assertExists('/series/'.$file->hashname());
        $this->assertEquals($serie->refresh()->image,'series/'.$file->hashname());

    }
}
