<?php

namespace Tests\Feature;

use App\Models\About;
use App\Models\Tour;
use App\Services\GoogleSheetsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        About::factory()->create();
    }

    public function test_booking_page_returns_200(): void
    {
        $response = $this->get(route('booking.index'));

        $response->assertStatus(200);
    }

    public function test_booking_page_shows_tour_details_when_tour_param_provided(): void
    {
        $tour = Tour::factory()->create([
            'name'             => 'Silk Road Journey',
            'price'            => 499.00,
            'duration'         => 7,
            'capacity_of_people' => 15,
            'season'           => 'Spring',
        ]);

        $response = $this->get(route('booking.index', ['tour' => $tour->id]));

        $response->assertStatus(200);
        $response->assertViewHas('tourDetails');
        $this->assertStringContainsString('Silk Road Journey', $response->viewData('tourDetails'));
    }

    public function test_booking_page_tour_details_null_without_tour_param(): void
    {
        $response = $this->get(route('booking.index'));

        $response->assertViewHas('tourDetails', null);
    }

    public function test_booking_store_requires_name(): void
    {
        $response = $this->post(route('booking.store'), [
            'email'       => 'test@example.com',
            'destination' => 'Samarkand',
            'message'     => 'Hello',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_booking_store_requires_valid_email(): void
    {
        $response = $this->post(route('booking.store'), [
            'name'        => 'John',
            'email'       => 'not-an-email',
            'destination' => 'Tashkent',
            'message'     => 'Hello',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_booking_store_requires_destination(): void
    {
        $response = $this->post(route('booking.store'), [
            'name'    => 'John',
            'email'   => 'john@example.com',
            'message' => 'Hello',
        ]);

        $response->assertSessionHasErrors('destination');
    }

    public function test_booking_store_requires_message(): void
    {
        $response = $this->post(route('booking.store'), [
            'name'        => 'John',
            'email'       => 'john@example.com',
            'destination' => 'Bukhara',
        ]);

        $response->assertSessionHasErrors('message');
    }

    public function test_booking_store_succeeds_with_valid_data(): void
    {
        $this->mock(GoogleSheetsService::class, function ($mock) {
            $mock->shouldReceive('appendRow')->once()->with(\Mockery::type('array'));
        });

        $response = $this->post(route('booking.store'), [
            'name'        => 'Doston Asadov',
            'email'       => 'doston@example.com',
            'destination' => 'Samarkand',
            'message'     => 'I want to book a tour',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_booking_store_tour_details_is_optional(): void
    {
        $this->mock(GoogleSheetsService::class, function ($mock) {
            $mock->shouldReceive('appendRow')->once();
        });

        $response = $this->post(route('booking.store'), [
            'name'        => 'Ali',
            'email'       => 'ali@example.com',
            'destination' => 'Khiva',
            'message'     => 'Interested in tours',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_booking_store_passes_correct_data_to_google_sheets(): void
    {
        $this->mock(GoogleSheetsService::class, function ($mock) {
            $mock->shouldReceive('appendRow')
                ->once()
                ->withArgs(function (array $row) {
                    return $row[1] === 'Test User'
                        && $row[2] === 'user@example.com'
                        && $row[3] === 'Tashkent';
                });
        });

        $this->post(route('booking.store'), [
            'name'        => 'Test User',
            'email'       => 'user@example.com',
            'destination' => 'Tashkent',
            'message'     => 'Book me please',
        ]);
    }
}
