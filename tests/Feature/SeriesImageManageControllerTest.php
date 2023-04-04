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
            'image' => $file=UploadedFile::fake()->image('serie.jpg',960,540),]);

        $response->assertRedirect();

        Storage::disk('public')->assertExists('/series/'.$file->hashname());
        $this->assertEquals($serie->refresh()->image,'series/'.$file->hashname());
        $this->assertFileEquals($file->getPathname(), Storage::disk('public')->path($serie->image));
    }

    /**
     * @test
     */
    public function series_Image_must_be_at_least_400px_heigh()
    {
        $this->loginAsSeriesManager();
        $serie = Serie::create([
            'title' => 'TDD 101',
            'description' => 'Aprèn tot sobre TDD',
            'image' => 'anterior.png',
            'teacher_name' => 'Sergi Tur'
        ]);
        Storage::fake('public');
        $response = $this->put('manage/series/image/' . $serie->id, [
            'image' => $file=UploadedFile::fake()->image('serie.jpg',200,399),]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('image');
        $this->assertEquals('anterior.png',$serie->refresh()->image);
    }

    /**
     * @test
     */
    public function series_Image_must_be_aspect_ratio_16_9()
    {
        $this->loginAsSeriesManager();
        $serie = Serie::create([
            'title' => 'TDD 101',
            'description' => 'Aprèn tot sobre TDD',
            'image' => 'anterior.png',
            'teacher_name' => 'Sergi Tur'
        ]);
        Storage::fake('public');
        $response = $this->put('manage/series/image/' . $serie->id, [
            'image' => $file=UploadedFile::fake()->image('serie.jpg',755,400),]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('image');
        $this->assertEquals('anterior.png',$serie->refresh()->image);
    }
    /**
     * @test
     */
    public function series_image_have_to_be_an_image()
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
            'image' => $file=UploadedFile::fake()->create('serie.pdf',0,'application/pdf'),]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('image');

        $this->assertEquals('anterior.png',$serie->refresh()->image);

    }


}
