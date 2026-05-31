FROM php:8.4-apache

# Install system dependencies + Node
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Install PHP packages
RUN composer install --no-dev --optimize-autoloader

# Install Node + build assets
RUN npm install
RUN npm run build

# Laravel cache cleanup
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true
RUN php artisan cache:clear || true

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache public directory
RUN sed -i 's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf

  RUN php artisan optimize:clear || true
EXPOSE 80

# Start: run migration then apache
CMD ["sh", "-c", "php artisan migrate --force && php artisan optimize && apache2-foreground"]
