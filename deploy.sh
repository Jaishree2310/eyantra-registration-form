#!/bin/bash
# e-Yantra Competition Registration System Deployment Script

echo "🚀 Deploying e-Yantra Competition Registration System..."

# Check if Docker is installed
if ! command -v docker &> /dev/null || ! command -v docker compose &> /dev/null; then
    echo "❌ Docker and Docker Compose are required but not installed."
    echo "Please install Docker and Docker Compose first."
    exit 1
fi

# Create necessary directories if they don't exist
mkdir -p backend/.docker/nginx/conf.d

# Copy configuration files
echo "📁 Setting up configuration files..."
cp backend-env-example backend/.env
cp backend-nginx-config backend/.docker/nginx/conf.d/default.conf

# Build and start Docker containers
echo "🏗️ Building and starting Docker containers..."
docker compose down
docker compose up -d --build

# Wait for the database to be ready
echo "⏳ Waiting for the database to initialize..."
sleep 20

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
docker compose exec app composer install

# Generate application key
echo "🔑 Generating application key..."
docker compose exec app php artisan key:generate

# Run migrations and seeding
echo "🔄 Running database migrations and seeders..."
docker compose exec app php artisan migrate:fresh --seed

# Create storage link
echo "🔗 Creating storage link..."
docker compose exec app php artisan storage:link

# Optimize Laravel application
echo "⚡ Optimizing Laravel application..."
docker compose exec app php artisan optimize:clear
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache

echo "✅ Deployment completed successfully!"
echo ""
echo "📱 Your application is now available at:"
echo "   - Backend API: http://localhost:8000/api"
echo "   - Frontend: http://localhost:8080"
echo "   - MailHog (Email Testing): http://localhost:8025"
echo ""
echo "Database credentials:"
echo "   - Host: localhost"
echo "   - Port: 3306"
echo "   - Database: eyantra"
echo "   - Username: eyantra"
echo "   - Password: password"
echo ""
echo "Happy coding! 🎉"