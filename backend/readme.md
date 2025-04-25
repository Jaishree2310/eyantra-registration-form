# e-Yantra Competition Registration Backend

The backend system for the e-Yantra Competition Registration platform, built with Laravel 10 and PHP 8.2. This API-driven application handles user registration and provides reference data endpoints.

## System Architecture

The backend follows Laravel's MVC architecture:

- **Models**: Define database entities and relationships
- **Controllers**: Handle API requests and responses
- **Resources**: Transform model data for API responses
- **Requests**: Validate incoming data

## Key Components

### Models

- `User`: Participant registration data
- `Country`: Country reference data
- `College`: College/University data with country relation
- `Department`: Academic department data

### API Controllers

- `RegistrationController`: Handles user registration
- `ReferenceDataController`: Provides country, college, and department data

### Validation

- `RegistrationRequest`: Validates registration form submissions

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/countries` | List all countries |
| GET | `/api/colleges` | List all colleges with country info |
| GET | `/api/departments` | List all departments |
| POST | `/api/register` | Register a new participant |

### Registration Endpoint

**Request Format**:
```json
{
  "name": "String (required)",
  "email": "String (required, valid email, unique)",
  "contact_number": "String (required, valid format)",
  "gender": "String (required, one of: male, female, other)",
  "year": "Integer (required, 1-5)",
  "department_id": "Integer (required, existing ID)",
  "college_id": "Integer (required, existing ID)",
  "country_id": "Integer (required, existing ID)"
}
```

**Response Format** (Success - 201):
```json
{
  "message": "Registration successful",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "contact_number": "+1234567890",
    "gender": "male",
    "year": 2,
    "department_id": 1,
    "college_id": 3,
    "country_id": 1,
    "created_at": "2025-04-23T12:34:56.000000Z",
    "updated_at": "2025-04-23T12:34:56.000000Z"
  }
}
```

**Response Format** (Validation Error - 422):
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email has already been taken."],
    "contact_number": ["The contact number format is invalid."]
  }
}
```

## Database Schema

### countries
- `id` - Primary key
- `name` - Country name
- `code` - Country code (ISO)
- `timestamps`

### colleges
- `id` - Primary key
- `name` - College name
- `country_id` - Foreign key to countries
- `city` - Optional city
- `state` - Optional state
- `timestamps`

### departments
- `id` - Primary key
- `name` - Department name
- `timestamps`

### users
- `id` - Primary key
- `name` - Full name
- `email` - Email (unique)
- `contact_number` - Phone number
- `gender` - Enum: male, female, other
- `year` - Year of study
- `department_id` - Foreign key to departments
- `college_id` - Foreign key to colleges
- `country_id` - Foreign key to countries
- `timestamps`

## Development Setup

### Using Docker (Recommended)

The backend is configured to run inside a Docker container as part of the entire application stack.

1. From the project root directory, start the containers:
   ```bash
   docker compose up -d
   ```

2. The backend API will be available at `http://localhost:8000/api`

### Using PHP Directly

If you prefer to run the backend directly on your system:

1. Requirements:
   - PHP 8.2+
   - Composer
   - MySQL 8.0

2. Install dependencies:
   ```bash
   cd backend
   composer install
   ```

3. Create .env file:
   ```bash
   cp .env.example .env
   ```

4. Configure database in .env:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eyantra
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```

7. Start development server:
   ```bash
   php artisan serve
   ```

## Common Commands

Inside the Docker container:
```bash
# Execute artisan commands
docker compose exec app php artisan list

# Run migrations
docker compose exec app php artisan migrate

# Generate model
docker compose exec app php artisan make:model NewModel -mcr

# Clear cache
docker compose exec app php artisan cache:clear
```

## Testing

The backend includes tests for API endpoints:

```bash
# Run all tests
docker compose exec app php artisan test

# Run specific test
docker compose exec app php artisan test --filter=RegistrationTest
```

## Deployment Considerations

- Set appropriate values in .env for production
- Optimize Laravel for production:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan optimize
  ```
- Ensure appropriate file permissions
- Configure proper CORS settings for production domains

## License

This project is licensed under the MIT License.