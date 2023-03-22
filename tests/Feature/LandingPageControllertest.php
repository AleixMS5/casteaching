<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @covers LandingPageController
 */
class LandingPageControllertest extends TestCase
{
    /**
     @test
     */
    public function landing_page_have_a_casteaching_series_component()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertSee('id="seires_cateaching"',false);
    }
}
