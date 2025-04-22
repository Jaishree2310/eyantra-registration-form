# e-Yantra Competition Registration System

A full-stack application for managing the registration process for e-Yantra robotics competitions. This system includes a Laravel backend with MySQL database and is designed to be containerized with Docker.

## Project Overview

The competition registration system allows students to register for e-Yantra robotics competitions with the following features:

- User registration form with validation
- Email verification
- Reference data management (countries, colleges, departments)
- Responsive design
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
├── docker-compose.yaml    # Docker Compose configuration
├── frontend/              # Frontend application (to be implemented)
│   ├── Dockerfile         # Frontend container definition
│   └── readme.md          # Frontend-specific documentation
└── readme.md              # This file
```

## Tech Stack

### Backend
- Laravel 10
- MySQL 8
- PHP 8.2
- Docker

### Frontend (planned)
- Vue.js 3
- Tailwind CSS
- Axios for API communication

## Getting Started

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Copy environment files:
   ```bash
   cd backend
   cp .env.example .env
   cd ..
   ```

3. Start the Docker environment:
   ```bash
   docker-compose up -d
   ```

4. Set up the backend:
   ```bash
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate --seed
   docker-compose exec app php artisan storage:link
   ```

5. Access the services:
   - Backend API: http://localhost:8000/api
   - MailHog (Email Testing): http://localhost:8025

## API Documentation

The API provides the following endpoints:

### Reference Data
- `GET /api/countries` - Get list of countries
- `GET /api/colleges` - Get list of colleges
- `GET /api/departments` - Get list of departments

### Email Verification
- `POST /api/verify-email` - Send verification email
- `POST /api/verify-token` - Verify email token

### Registration
- `POST /api/register` - Register a user

For more details, see the backend README file.

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