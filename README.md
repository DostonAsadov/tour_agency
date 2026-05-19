# Tour Agency

A lightweight tour agency web application for managing tours, bookings, and customers.

## Features

- Browse and manage tours
- Create and manage bookings
- Customer profiles and contact details
- Admin dashboard for monitoring and reports

## Tech Stack

- Backend: PHP / Laravel (or your preferred framework)
- Frontend: HTML/CSS/JavaScript
- Database: MySQL / MariaDB

## Installation

1. Clone the repository:
	git clone <repo-url>
2. Install dependencies:
	- For PHP/Laravel: composer install
	- For frontend tools (if any): npm install
3. Copy environment file and configure:
	cp .env.example .env
	Edit database and mail settings in .env
4. Run migrations and seeders:
	php artisan migrate --seed
5. Start the development server:
	php artisan serve

## Usage

- Visit the app in your browser at http://localhost:8000
- Use the admin dashboard to create tours, manage bookings, and view reports.

## Configuration

- Update .env for database credentials, mail server, and other environment-specific settings.

## Deployment

- Use a standard PHP hosting setup or deploy via Forge, Vapor, Docker, or other platform.
- Ensure environment variables are set and migrations are run on the production database.

## Contributing

- Fork the repository, create a branch for your feature/fix, and open a pull request.

## License

MIT License. See LICENSE file for details.

## Contact

For questions or support, open an issue in the repository.
