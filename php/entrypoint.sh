#!/bin/bash
chown -R www-data:www-data /var/www/html/public/uploads/pictures
chmod -R 775 /var/www/html/public/uploads/pictures
exec "$@"