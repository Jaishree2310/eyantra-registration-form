# e-Yantra Competition Registration System

A full-stack application for managing the registration process for e-Yantra robotics competitions. This system includes a Laravel backend API with MySQL database and a Vue.js frontend, all containerized with Docker for easy deployment.

## Project Overview

The competition registration system allows students to register for e-Yantra robotics competitions with the following features:

- User registration form with validation
- Reference data management (countries, colleges, departments)
- Responsive, mobile-friendly design
- Docker-based development environment
- API-driven architecture

## Repository Structure

```
├── backend/               # Laravel API
│   ├── .docker/           # Docker configuration files for the backend
│   ├── app/               # Laravel application code
│   ├── database/          # Database migrations and seeders
│   ├── routes/            # API route definitions
│   ├── Dockerfile         # Backend container definition
│   └── readme.md          # Backend-specific documentation
├── frontend/              # Vue.js frontend application
│   ├── src/               # Vue source code
│   │   ├── components/    # Vue components
│   │   ├── services/      # API service modules
│   │   └── assets/        # Frontend assets
│   ├── public/            # Static assets
│   ├── Dockerfile         # Frontend container definition
│   └── readme.md          # Frontend-specific documentation
├── automation/            # Test automation scripts
│   ├── eyantra_form_automator.py # Selenium form automation script
│   └── requirements.txt    # Python dependencies
├── docker-compose.yaml    # Docker Compose configuration
├── deploy.sh              # Deployment script for easy setup
└── readme.md              # This file
```

## Tech Stack

### Backend
- Laravel 10
- MySQL 8
- PHP 8.2
- Docker

### Frontend
- Vue.js 3 (Composition API)
- Tailwind CSS
- Axios for API communication
- Vuelidate for form validation

## Getting Started

### Prerequisites
- Docker and Docker Compose installed on your system
- Git

### Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Start the Docker environment:
   ```bash
   docker-compose up -d
   ```

3. Set up the backend:
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate --seed
   docker-compose exec app php artisan storage:link
   ```

### Alternative Installation Using Deploy Script

For a quick setup, you can use the included deployment script:

```bash
chmod +x deploy.sh
./deploy.sh
```

This script will:
- Check if Docker is installed
- Set up configuration files
- Build and start Docker containers
- Install dependencies
- Migrate and seed the database
- Optimize the Laravel application

## Accessing the Application

After installation, you can access the following services:

- Frontend: http://localhost:8080
- Backend API: http://localhost:8000/api
- MailHog (Email Testing): http://localhost:8025

## API Documentation

The API provides the following endpoints:

### Reference Data
- `GET /api/countries` - Get list of countries
- `GET /api/colleges` - Get list of colleges
- `GET /api/departments` - Get list of departments

### Registration
- `POST /api/register` - Register a user

### Example Request for Registration

```json
POST /api/register
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "contact_number": "+1234567890",
  "gender": "male",
  "year": 2,
  "department_id": 1,
  "college_id": 3,
  "country_id": 2
}
```

## Test Automation

The project includes a Selenium-based automation script for testing the registration form. Requirements:

- Python 3.7+
- Selenium WebDriver
- Chrome browser

To use the automation script:

```bash
cd automation
pip install -r requirements.txt
python eyantra_form_automator.py http://localhost:8080 --count 5 --delay 2
```

## Development

### Backend Development

The backend is a standard Laravel application with the following customizations:
- API routes defined in `/backend/routes/api.php`
- Models in `/backend/app/Models/`
- Controllers in `/backend/app/Http/Controllers/API/`
- Database migrations and seeders for reference data

### Frontend Development

The frontend is built with Vue.js 3 and includes:
- Responsive form layout with Tailwind CSS
- Form validation using Vuelidate
- API integration through service modules
- Component-based architecture

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