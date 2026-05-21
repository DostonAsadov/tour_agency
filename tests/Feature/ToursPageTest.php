<?php

namespace Tests\Feature;

use App\Models\About;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToursPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        About::factory()->create();
    }

    public function test_tours_page_returns_200(): void
    {
        $response = $this->get(route('tours'));

        $response->assertStatus(200);
    }

    public function test_tours_page_shows_tours(): void
    {
        Tour::factory()->count(3)->create();

        $response = $this->get(route('tours'));

        $response->assertStatus(200);
        $response->assertViewHas('tours');
        $this->assertCount(3, $response->viewData('tours'));
    }

    public function test_tours_page_shows_categories(): void
    {
        Category::factory()->count(2)->create();

        $response = $this->get(route('tours'));

        $response->assertViewHas('categories');
        $this->assertCount(2, $response->viewData('categories'));
    }

    public function test_tours_search_by_name(): void
    {
        Tour::factory()->create(['name' => 'Safari Adventure']);
        Tour::factory()->create(['name' => 'Mountain Trek']);

        $response = $this->get(route('tours', ['search' => 'Safari']));

        $response->assertStatus(200);
        $this->assertCount(1, $response->viewData('tours'));
        $this->assertEquals('Safari Adventure', $response->viewData('tours')->first()->name);
    }

    public function test_tours_search_by_description(): void
    {
        Tour::factory()->create(['description' => 'Exotic jungle experience']);
        Tour::factory()->create(['description' => 'City sightseeing tour']);

        $response = $this->get(route('tours', ['search' => 'jungle']));

        $response->assertStatus(200);
        $this->assertCount(1, $response->viewData('tours'));
    }

    public function test_tours_filter_by_category_slug(): void
    {
        $beach   = Category::factory()->create(['name' => 'Beach']);
        $mountain = Category::factory()->create(['name' => 'Mountain']);

        $beachTour    = Tour::factory()->create();
        $mountainTour = Tour::factory()->create();

        $beachTour->categories()->attach($beach);
        $mountainTour->categories()->attach($mountain);

        $response = $this->get(route('tours', ['category' => $beach->slug]));

        $response->assertStatus(200);
        $this->assertCount(1, $response->viewData('tours'));
        $this->assertEquals($beachTour->id, $response->viewData('tours')->first()->id);
    }

    public function test_tour_show_returns_200(): void
    {
        $tour = Tour::factory()->create();

        $response = $this->get(route('tour.show', $tour->id));

        $response->assertStatus(200);
        $response->assertViewHas('tour');
    }

    public function test_tour_show_displays_correct_tour(): void
    {
        $tour = Tour::factory()->create(['name' => 'Pamir Highway']);

        $response = $this->get(route('tour.show', $tour->id));

        $response->assertSee('Pamir Highway');
    }

    public function test_tour_show_returns_404_for_nonexistent_tour(): void
    {
        $response = $this->get(route('tour.show', 9999));

        $response->assertStatus(404);
    }

    public function test_tours_page_is_paginated(): void
    {
        Tour::factory()->count(15)->create();

        $response = $this->get(route('tours'));

        $this->assertCount(9, $response->viewData('tours'));
    }
}
