#!/bin/bash

# Attendre que la base de données soit prête
echo "Waiting for MariaDB to be ready..."
until mariadb -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1" &> /dev/null; do
  sleep 2
done

echo "MariaDB is ready!"

# Appliquer les fichiers de migration SQL
MIGRATIONS_DIR="/var/www/html/src/migrations"
for file in "$MIGRATIONS_DIR"/*.sql; do
  if [ -f "$file" ]; then
    echo "Applying migration: $file"
    mariadb -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < "$file"
  fi
done

echo "All migrations applied!"