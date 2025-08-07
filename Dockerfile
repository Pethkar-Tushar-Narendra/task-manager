# Use official PHP image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    npm \
    nodejs \
    libpq-dev \
    mariadb-client

# Install PHP extensions including PostgreSQL drivers
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . /var/www

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www

# Storage link
RUN php artisan storage:link || true

# Expose port
EXPOSE 8000

# Run migrations and serve
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
