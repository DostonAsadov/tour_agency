<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TourTest extends TestCase
{
    use RefreshDatabase;

    public function test_tour_can_be_created_with_factory(): void
    {
        $tour = Tour::factory()->create();

        $this->assertDatabaseHas('tours', ['id' => $tour->id]);
    }

    public function test_tour_fillable_fields(): void
    {
        $fillable = (new Tour())->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('description', $fillable);
        $this->assertContains('price', $fillable);
        $this->assertContains('duration', $fillable);
        $this->assertContains('capacity_of_people', $fillable);
        $this->assertContains('season', $fillable);
        $this->assertContains('image', $fillable);
    }

    public function test_tour_price_is_cast_to_decimal(): void
    {
        $tour = Tour::factory()->create(['price' => 199.99]);

        $this->assertEquals('199.99', $tour->price);
    }

    public function test_tour_duration_is_cast_to_integer(): void
    {
        $tour = Tour::factory()->create(['duration' => 7]);

        $this->assertIsInt($tour->duration);
        $this->assertEquals(7, $tour->duration);
    }

    public function test_tour_capacity_is_cast_to_integer(): void
    {
        $tour = Tour::factory()->create(['capacity_of_people' => 20]);

        $this->assertIsInt($tour->capacity_of_people);
        $this->assertEquals(20, $tour->capacity_of_people);
    }

    public function test_tour_belongs_to_many_categories(): void
    {
        $tour = Tour::factory()->create();
        $category = Category::factory()->create();

        $tour->categories()->attach($category);

        $this->assertCount(1, $tour->categories);
        $this->assertEquals($category->id, $tour->categories->first()->id);
    }

    public function test_tour_can_have_multiple_categories(): void
    {
        $tour = Tour::factory()->create();
        $categories = Category::factory()->count(3)->create();

        $tour->categories()->attach($categories->pluck('id'));

        $this->assertCount(3, $tour->fresh()->categories);
    }

    public function test_tour_image_is_nullable(): void
    {
        $tour = Tour::factory()->create(['image' => null]);

        $this->assertNull($tour->image);
    }
}
