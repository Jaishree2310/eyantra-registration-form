# e-Yantra Competition Registration Backend

This is the Laravel backend API for the e-Yantra competition registration system. It provides RESTful endpoints for managing user registrations and reference data.

## Tech Stack

- PHP 8.2
- Laravel 10
- MySQL 8
- Docker

## Directory Structure

```
├── app/                   # Application code
│   ├── Http/              
│   │   ├── Controllers/   # API controllers
│   │   ├── Middleware/    # HTTP middleware
│   │   ├── Requests/      # Form request validation
│   │   └── Resources/     # API resources (transformers)
│   └── Models/            # Database models
├── database/
│   ├── migrations/        # Database table schemas
│   └── seeders/           # Data seeders for reference data
├── routes/                
│   └── api.php            # API route definitions
├── .docker/               # Docker configuration
├── tests/                 # Test files
├── Dockerfile             # PHP container definition
```

## API Endpoints

### Reference Data

#### Get Countries
```
GET /api/countries
```

Response:
```json
{
  "data": [
    { "id": 1, "name": "India", "code": "IN" },
    { "id": 2, "name": "United States", "code": "US" },
    { "id": 3, "name": "United Kingdom", "code": "GB" }
  ]
}
```

#### Get Colleges
```
GET /api/colleges
```

Response:
```json
{
  "data": [
    {
      "id": 1,
      "name": "Indian Institute of Technology Bombay",
      "city": "Mumbai",
      "state": "Maharashtra",
      "country": {
        "id": 1,
        "name": "India"
      }
    }
  ]
}
```

#### Get Departments
```
GET /api/departments
```

Response:
```json
{
  "data": [
    { "id": 1, "name": "Computer Science and Engineering" },
    { "id": 2, "name": "Electrical Engineering" }
  ]
}
```

### Registration

#### Register a New User
```
POST /api/register
```

Request Body:
```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "contact_number": "+911234567890",
  "gender": "male",
  "year": 2,
  "department_id": 1,
  "college_id": 1,
  "country_id": 1
}
```

Response:
```json
{
  "message": "Registration successful",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "contact_number": "+911234567890",
    "gender": "male",
    "year": 2,
    "department_id": 1,
    "college_id": 1,
    "country_id": 1,
    "created_at": "2025-04-23T10:00:00.000000Z",
    "updated_at": "2025-04-23T10:00:00.000000Z"
  }
}
```

## Development Setup

### Using Docker

1. Ensure you are in the project root directory (not the backend directory)
2. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```
3. Install dependencies:
   ```bash
   docker-compose exec app composer install
   ```
4. Generate app key:
   ```bash
   docker-compose exec app php artisan key:generate
   ```
5. Run migrations and seeders:
   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

### Local Development

If you prefer to run the backend locally without Docker:

1. Ensure you have PHP 8.2+ and Composer installed
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
4. Update the database connection in `.env` with your database credentials
5. Generate app key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```

## Database Schema

### Countries
- `id` - Primary key
- `name` - Country name 
- `code` - Country code (ISO 3166-1 alpha-2)

### Colleges
- `id` - Primary key
- `name` - College name
- `country_id` - Foreign key to countries
- `city` - City name
- `state` - State or region

### Departments
- `id` - Primary key
- `name` - Department name

### Users
- `id` - Primary key
- `name` - Full name
- `email` - Email address (unique)
- `contact_number` - Phone number
- `gender` - Gender (male, female, other)
- `year` - Year of study (1-5)
- `department_id` - Foreign key to departments
- `college_id` - Foreign key to colleges
- `country_id` - Foreign key to countries

## Testing

Run tests with PHPUnit:

```bash
php artisan test
```

## Contributing

When contributing to the backend:

1. Follow the Laravel coding style
2. Add appropriate validation for new endpoints
3. Update any API documentation
4. Write tests for new features

## License

This project is licensed under the MIT License.