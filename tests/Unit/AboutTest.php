<?php

namespace Tests\Unit;

use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_can_be_created_with_factory(): void
    {
        $about = About::factory()->create();

        $this->assertDatabaseHas('abouts', ['id' => $about->id]);
    }

    public function test_about_has_no_timestamps(): void
    {
        $about = new About();

        $this->assertFalse($about->timestamps);
    }

    public function test_about_fillable_fields(): void
    {
        $fillable = (new About())->getFillable();

        foreach (['company_name', 'email', 'phone', 'phone2', 'working_hours',
                  'facebook_link', 'instagram_link', 'youtube_link',
                  'travelers', 'hotels', 'completed_tours',
                  'experience_years', 'number_partners', 'address'] as $field) {
            $this->assertContains($field, $fillable);
        }
    }

    public function test_working_hours_is_cast_to_array(): void
    {
        $about = About::factory()->create([
            'working_hours' => ['Mon-Fri: 9:00-18:00', 'Sat: 10:00-14:00'],
        ]);

        $this->assertIsArray($about->working_hours);
        $this->assertCount(2, $about->working_hours);
        $this->assertEquals('Mon-Fri: 9:00-18:00', $about->working_hours[0]);
    }

    public function test_about_numeric_fields_store_correctly(): void
    {
        $about = About::factory()->create([
            'travelers'        => 5000,
            'hotels'           => 120,
            'completed_tours'  => 300,
            'experience_years' => 10,
            'number_partners'  => 45,
        ]);

        $this->assertEquals(5000, $about->travelers);
        $this->assertEquals(120, $about->hotels);
        $this->assertEquals(300, $about->completed_tours);
        $this->assertEquals(10, $about->experience_years);
        $this->assertEquals(45, $about->number_partners);
    }

    public function test_about_find_or_fail_by_id(): void
    {
        $about = About::factory()->create();

        $found = About::findOrFail($about->id);

        $this->assertEquals($about->company_name, $found->company_name);
    }
}
