# e-Yantra Competition Registration System

A full-stack application for managing the registration process for e-Yantra robotics competitions hosted at IIT Bombay. The system features a Laravel backend API with MySQL database and a Vue.js frontend, all containerized with Docker for easy deployment.

## System Overview

This application allows participants to register for e-Yantra robotics competitions with the following features:

- User-friendly registration form with client-side validation
- Backend validation and data storage
- Reference data management (countries, colleges, departments)
- Mobile-responsive design with Tailwind CSS
- Dockerized environment for easy setup and deployment
- Automated testing tools for form submission

## Repository Structure

```
├── automation/            # Test automation tools
│   ├── eyantra_form_automator.py # Selenium-based form testing
│   └── requirements.txt   # Python dependencies
├── backend/               # Laravel API
│   ├── app/               # Application code
│   │   ├── Http/          # Controllers, middleware, requests
│   │   ├── Models/        # Database models
│   │   └── Providers/     # Service providers
│   ├── database/          # Migrations and seeders
│   ├── routes/            # API route definitions
│   ├── Dockerfile         # Backend container definition
│   └── ... other Laravel files
├── frontend/              # Vue.js frontend
│   ├── src/               # Vue source code
│   │   ├── components/    # Vue components
│   │   ├── services/      # API service modules
│   │   └── assets/        # CSS and other assets
│   ├── Dockerfile         # Frontend container definition
│   └── nginx.conf         # Nginx configuration
├── docker-compose.yaml    # Multi-container Docker setup
├── deploy.sh              # Deployment automation script
└── README.md              # This file
```

## Tech Stack

### Backend
- PHP 8.2
- Laravel 10
- MySQL 8.0
- Nginx (webserver)

### Frontend
- Vue.js 3 (Composition API)
- Tailwind CSS
- Vuelidate for form validation
- Native Fetch API for API communication

### DevOps
- Docker & Docker Compose
- Bash deployment script
- Selenium automation testing

## Quick Start

### Prerequisites
- Docker and Docker Compose
- Git

### Installation

The easiest way to set up the project is using the deployment script:

```bash
# Clone the repository
git clone <repository-url>
cd <repository-directory>

# Make the deploy script executable
chmod +x deploy.sh

# Run the deployment script
./deploy.sh
```

The deployment script will:
1. Check for Docker and Docker Compose
2. Set up required configuration files
3. Build and start all Docker containers
4. Install dependencies
5. Run database migrations and seed reference data
6. Optimize the Laravel application

### Manual Setup

If you prefer to set up manually:

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Create necessary directories:
   ```bash
   mkdir -p backend/.docker/nginx/conf.d
   ```

3. Start the Docker environment:
   ```bash
   docker compose up -d
   ```

4. Set up the backend:
   ```bash
   docker compose exec app composer install
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate:fresh --seed
   docker compose exec app php artisan storage:link
   ```

## Accessing the Application

After installation, you can access:

- **Frontend**: http://localhost:8080
- **Backend API**: http://localhost:8000/api
- **Database**: localhost:3306 (credentials in docker-compose.yaml)

## API Documentation

### Reference Data Endpoints

#### Get Countries
```
GET /api/countries
```

Response:
```json
{
  "data": [
    { "id": 1, "name": "India", "code": "IN" },
    { "id": 2, "name": "United States", "code": "US" }
  ]
}
```

#### Get Colleges
```
GET /api/colleges
```

#### Get Departments
```
GET /api/departments
```

### Registration Endpoint

```
POST /api/register
```

Request Body:
```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "contact_number": "+91 9876543210",
  "gender": "male",
  "year": 2,
  "department_id": 1,
  "college_id": 3,
  "country_id": 1
}
```

## Test Automation

The system includes a Selenium-based Python script for automating registration form submissions:

```bash
# Install dependencies
cd automation
pip install -r requirements.txt

# Run the automation script
python eyantra_form_automator.py http://localhost:8080 --count 5 --delay 2
```

Parameters:
- `url`: The URL of the registration form
- `--count`: Number of submissions to make
- `--delay`: Delay between submissions in seconds
- `--headless`: Run in headless mode (optional)

## Development

### Backend Development

The backend uses Laravel with API resources for structured responses. Key files:

- `routes/api.php`: API route definitions
- `app/Http/Controllers/API/`: API controllers
- `app/Models/`: Database models
- `database/migrations/`: Database schema

To run backend commands:
```bash
docker compose exec app php artisan <command>
```

### Frontend Development

The frontend is built with Vue.js 3 using the Composition API. Key files:

- `src/components/RegistrationForm.vue`: Main registration form
- `src/services/api.js`: API communication service

To access frontend logs:
```bash
docker compose logs -f frontend
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License.

## Acknowledgements

- e-Yantra is a robotics outreach program funded by the Ministry of Education and hosted at IIT Bombay