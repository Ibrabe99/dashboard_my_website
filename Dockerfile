# Use the official Render PHP base image
FROM renderinc/php:8.2-fpm-nginx

# Set the working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Install composer dependencies
RUN composer install --no-interaction --no-dev --prefer-dist

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Clear caches
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose port 80 and start php-fpm and nginx
# The base image's entrypoint will start nginx and php-fpm.
