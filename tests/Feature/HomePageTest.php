<?php

namespace Tests\Feature;

use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_200(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_about_page_returns_200(): void
    {
        About::factory()->create();

        $response = $this->get(route('about'));

        $response->assertStatus(200);
    }

    public function test_about_page_shows_company_name(): void
    {
        About::factory()->create(['company_name' => 'Shirin Travel Agency']);

        $response = $this->get(route('about'));

        $response->assertSee('Shirin Travel Agency');
    }

    public function test_about_page_returns_404_when_no_about_record(): void
    {
        $response = $this->get(route('about'));

        $response->assertStatus(404);
    }
}
