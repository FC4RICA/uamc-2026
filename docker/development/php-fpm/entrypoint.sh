#!/bin/sh
set -e

# Check if $UID and $GID are set, else fallback to default (1000:1000)
USER_ID=${UID:-1000}
GROUP_ID=${GID:-1000}

echo "Starting PHP-FPM (development)"
echo "User: $(id)"

# Only Docker volumes – safe to chown
chown -R ${USER_ID}:${GROUP_ID} /var/www/storage /var/www/bootstrap/cache || true

# Clear configurations to avoid caching issues in development
if [ "$1" = "php-fpm" ]; then
  echo "Clearing configurations..."

  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
fi

# Run the default command (e.g., php-fpm or bash)
exec "$@"