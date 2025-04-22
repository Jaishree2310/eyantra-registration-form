FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

# Create required directories that might be missing in the repo
RUN mkdir -p /var/www/storage/app/public \
    /var/www/storage/framework/cache/data \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/testing \
    /var/www/storage/framework/views \
    /var/www/storage/logs \
    /var/www/bootstrap/cache \
    /var/www/routes

# Create essential Laravel files if they don't exist
RUN touch /var/www/routes/web.php
RUN touch /var/www/routes/console.php

# Add content to the web.php file if it's empty
RUN echo '<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\nRoute::get(\"/\", function () {\n    return response()->json([\"message\" => \"e-Yantra Competition API\"]);\n});' > /var/www/routes/web.php

# Add content to the console.php file if it's empty
RUN echo '<?php\n\nuse Illuminate\\Foundation\\Inspiring;\nuse Illuminate\\Support\\Facades\\Artisan;\n\nArtisan::command(\"inspire\", function () {\n    $this->comment(Inspiring::quote());\n})->purpose(\"Display an inspiring quote\");' > /var/www/routes/console.php

# Set proper permissions for Laravel directories and files
RUN chown -R www-data:www-data /var/www
RUN find /var/www -type f -exec chmod 644 {} \;
RUN find /var/www -type d -exec chmod 755 {} \;
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Ensure the log file exists and is writable
RUN touch /var/www/storage/logs/laravel.log
RUN chmod 664 /var/www/storage/logs/laravel.log
RUN chown www-data:www-data /var/www/storage/logs/laravel.log

# Install dependencies with --no-scripts to prevent artisan commands from running during build
USER www-data
RUN composer install --no-scripts

# Expose port 9000 and go back to root user for startup script
USER root
EXPOSE 9000

# Create a startup script (without overriding permissions)
RUN echo '#!/bin/sh\n\
if [ ! -f .env ]; then\n\
    cp .env.example .env || true\n\
fi\n\
php artisan key:generate --force || true\n\
php artisan package:discover --ansi || true\n\
php artisan storage:link || true\n\
# No chown/chmod here that would override what we set in the Dockerfile\n\
php-fpm\n\
' > /usr/local/bin/start-container && \
chmod +x /usr/local/bin/start-container

CMD ["/usr/local/bin/start-container"]