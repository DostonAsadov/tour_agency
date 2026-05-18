# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Laravel 11** travel agency website ("Shirin Travel Agency") with a Filament v3 admin panel. The public frontend is a static-style Bootstrap theme served via Blade templates. Booking form submissions are stored in Google Sheets via the Google Sheets API (no database table for bookings).

## Development Commands

### Start the full dev stack (server + queue + logs + Vite)
```bash
composer run dev
```

This runs `php artisan serve`, `php artisan queue:listen`, `php artisan pail`, and `npm run dev` concurrently.

### Individual commands
```bash
php artisan serve          # PHP dev server only
npm run dev                # Vite asset watcher only
npm run build              # Build frontend assets for production
php artisan migrate        # Run database migrations
php artisan tinker         # Interactive REPL
```

### Code style
```bash
./vendor/bin/pint          # Laravel Pint (PSR-12 formatter)
```

### Tests
```bash
php artisan test                        # Run all tests
php artisan test tests/Feature/ExampleTest.php  # Run a single test file
```

## Architecture

### Database
Uses **MySQL** in production (configured in `.env`). The `.env.example` defaults to SQLite — the actual `.env` points to a local MySQL database `tour_agency`.

Migrations define these core tables: `tours`, `categories`, `category_tour` (pivot), `abouts`.

### Models and relationships
- `Tour` — has many `Category` via the `category_tour` pivot (BelongsToMany)
- `Category` — uses `spatie/laravel-sluggable` to auto-generate slugs from `name`; belongs to many `Tour`
- `About` — singleton-like table (always fetched as `About::first()` or `About::findOrFail(1)`); `working_hours` cast to array; no timestamps
- No `Booking` model — booking data goes directly to Google Sheets

### Google Sheets integration
`App\Services\GoogleSheetsService` authenticates via a Google service account JSON file at `storage/app/google-service-account.json`. Required env vars:
```
GOOGLE_SERVICE_ACCOUNT_JSON=storage/app/google-service-account.json
GOOGLE_SHEETS_SPREADSHEET_ID=<spreadsheet-id>
GOOGLE_SHEETS_SHEET_NAME=Брони
```
`BookingController@store` validates the form and calls `GoogleSheetsService::appendRow()` directly — no queuing.

### Admin panel (Filament v3)
Accessible at `/admin`. Filament resources exist for **Tour**, **Category**, and **About**. This is how content is managed — there are no separate admin controllers.

### Frontend / Views
All public pages extend `resources/views/layouts/app.blade.php`, which:
- Loads a pre-built Bootstrap theme from `public/assets/` (not compiled by Vite — it's a static theme)
- Includes `<x-navbar />` and `<x-footer />` Blade components
- Uses `@yield('content')`, `@yield('title')`, `@stack('styles')`, and `@stack('scripts')` for per-page overrides
- Accepts `@yield('page-offset', '7rem')` to control top padding (navbar height clearance)

Vite/Tailwind is set up (`tailwind.config.js`, `vite.config.js`) but the main styling comes from the pre-built theme CSS at `public/assets/css/theme.css`.

### Routes summary
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | `home` | Home page |
| GET | `/tours` | `tours` | Tour listing |
| GET | `/tour/{id}` | `tour.show` | Single tour |
| GET | `/about` | `about` | About page |
| GET | `/booking` | `booking.index` | Booking form |
| POST | `/booking` | `booking.store` | Submit booking |
