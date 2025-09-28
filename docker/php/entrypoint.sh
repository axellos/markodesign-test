#!/bin/sh
set -e

cd /var/www/html

if [ ! -f vendor/autoload.php ]; then
    composer install --no-dev --optimize-autoloader
fi

exec supervisord -c /etc/supervisord.conf
