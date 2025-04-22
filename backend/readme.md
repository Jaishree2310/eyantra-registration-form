# e-Yantra Competition Registration Backend

This is the backend API for the e-Yantra competition registration system built with Laravel and MySQL. The API provides endpoints for managing registrations, email verification, and reference data.

## Features

- User registration with validation
- Email verification
- Reference data for countries, colleges, and departments
- Docker-based development environment
- API-driven architecture

## Prerequisites

- Docker and Docker Compose
- Git

## Setup Instructions

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Copy the environment file:
   ```bash
   cd backend
   cp .env.example .env
   ```

3. Build and start the Docker containers:
   ```bash
   cd ..
   docker-compose up -d
   ```

4. Install PHP dependencies:
   ```bash
   docker-compose exec app composer install
   ```

5. Generate application key:
   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. Run database migrations and seeders:
   ```bash
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan db:seed
   ```

7. Create storage link:
   ```bash
   docker-compose exec app php artisan storage:link
   ```

## API Endpoints

### Reference Data
- `GET /api/countries` - Get list of countries
- `GET /api/colleges` - Get list of colleges
- `GET /api/departments` - Get list of departments

### Email Verification
- `POST /api/verify-email` - Send verification email
  - Parameters: `email` (required)
- `POST /api/verify-token` - Verify email token
  - Parameters: `email` (required), `token` (required)

### Registration
- `POST /api/register` - Register a user
  - Parameters: 
    - `name` (required, string, no special characters)
    - `email` (required, email, unique)
    - `contact_number` (required, string)
    - `gender` (required, one of: male, female, other)
    - `year` (required, integer)
    - `department_id` (required, exists in departments table)
    - `college_id` (required, exists in colleges table)
    - `country_id` (required, exists in countries table)

## Accessing Services

- **Backend API**: http://localhost:8000/api
- **MailHog** (Email Testing): http://localhost:8025
- **MySQL Database**: localhost:3306
  - **Database**: eyantra
  - **Username**: eyantra
  - **Password**: password (configurable in .env)

## Development

### Running Tests

```bash
docker-compose exec app php artisan test
```

### Code Style

```bash
docker-compose exec app composer phpcs
```

### Generating API Documentation

```bash
docker-compose exec app php artisan l5-swagger:generate
```

## License

This project is licensed under the MIT License.