# Use a popular and public PHP-FPM image with Nginx
FROM richarvey/nginx-php-fpm:2.2.1-php82

# Set the working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install composer dependencies
RUN composer install --no-interaction --no-dev --prefer-dist

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Clear caches for production
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# The base image's entrypoint will start nginx and php-fpm.
