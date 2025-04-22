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

# Add user for Laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy composer.json and composer.lock first to leverage Docker cache
COPY --chown=www:www composer.json composer.lock* ./

# Install dependencies (without running scripts)
RUN if [ -f composer.lock ]; then \
        composer install --no-scripts --no-autoloader; \
    fi

# Copy existing application directory contents
COPY --chown=www:www . /var/www

# Generate optimized autoload files if composer was previously run
RUN if [ -f composer.lock ]; then \
        composer dump-autoload --optimize; \
    fi

# Create required directories that might be missing in the repo
RUN mkdir -p /var/www/storage/app/public \
    /var/www/storage/framework/cache \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/testing \
    /var/www/storage/framework/views \
    /var/www/storage/logs \
    /var/www/bootstrap/cache

# Set proper permissions
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache
RUN chown -R www:www /var/www/storage /var/www/bootstrap/cache
RUN chown -R www:www /var/www

# Change current user to www
USER www

RUN composer install --no-scripts

# Expose port 9000 and start php-fpm server
EXPOSE 9000
USER root
CMD ["php-fpm"]