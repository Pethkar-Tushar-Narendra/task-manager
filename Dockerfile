# syntax=docker/dockerfile:1.0
# Use official PHP image
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl libzip-dev \
    npm nodejs \
    libpq-dev \
    mariadb-client \
    && apt-get clean

# Install PHP extensions (for both MySQL and PostgreSQL support)
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Install Node.js dependencies and build assets
RUN npm install && npm run build

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Create storage symlink
RUN php artisan storage:link || true

# Expose port
EXPOSE 10000

# Start application with database migration
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000