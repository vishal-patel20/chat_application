#!/bin/sh
set -e

# Wait for database (if needed, simplified for sqlite/generic)
# if [ "$DB_CONNECTION" = "mysql" ]; then
#     echo "Waiting for mysql..."
#     while ! nc -z db 3306; do
#       sleep 0.1
#     done
#     echo "MySQL started"
# fi

# If we are in the 'app' container (running php-fpm)
if [ "$1" = "php-fpm" ]; then
    echo "Caching Laravel config and routes..."
    # php artisan config:cache
    # php artisan route:cache

    echo "Running migrations..."
    php artisan migrate --force

    # Ensure storage is writable
    chmod -R 777 storage bootstrap/cache

    exec "$@"
fi

# If we are in the 'reverb' container
if [ "$1" = "php" ] && [ "$2" = "artisan" ] && [ "$3" = "reverb:start" ]; then
    echo "Starting Reverb WebSocket Server..."
    exec "$@"
fi

# Default behavior
exec "$@"
