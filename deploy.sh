#!/bin/bash

echo "🚀 Starting Deployment..."

# Pull latest changes
git pull origin main

# Run migrations
php artisan migrate --force

# Clear and cache configs
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Clear application cache
php artisan cache:clear

echo "✅ Deployment Complete!"
