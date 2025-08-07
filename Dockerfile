# Use official PHP image with extensions
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl libzip-dev \
    npm nodejs mariadb-client

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
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

# Command to serve app
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
