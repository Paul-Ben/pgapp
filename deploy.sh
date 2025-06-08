#!/bin/bash
# filepath: deploy.sh

# Navigate to the project directory (update this path as needed)
cd /var/www/pgadmin/data/www/pg.bsum.edu.ng


# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Run Laravel database migrations
php artisan migrate --force

# Seed the database
php artisan db:seed --force

# (Optional) Clear and cache Laravel config/routes/views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# (Optional) Set correct permissions for storage and bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "Deployment complete."