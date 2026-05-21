<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Tour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created_with_factory(): void
    {
        $category = Category::factory()->create();

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_category_fillable_fields(): void
    {
        $fillable = (new Category())->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('slug', $fillable);
    }

    public function test_category_slug_is_auto_generated_from_name(): void
    {
        $category = Category::factory()->create(['name' => 'Beach Tours']);

        $this->assertEquals('beach-tours', $category->slug);
    }

    public function test_category_slug_is_unique(): void
    {
        $first  = Category::factory()->create(['name' => 'Mountain']);
        $second = Category::factory()->create(['name' => 'Mountain']);

        $this->assertNotEquals($first->slug, $second->slug);
    }

    public function test_category_belongs_to_many_tours(): void
    {
        $category = Category::factory()->create();
        $tour     = Tour::factory()->create();

        $category->tours()->attach($tour);

        $this->assertCount(1, $category->tours);
        $this->assertEquals($tour->id, $category->tours->first()->id);
    }

    public function test_category_can_have_multiple_tours(): void
    {
        $category = Category::factory()->create();
        $tours    = Tour::factory()->count(4)->create();

        $category->tours()->attach($tours->pluck('id'));

        $this->assertCount(4, $category->fresh()->tours);
    }
}
