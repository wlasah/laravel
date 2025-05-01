FROM webdevops/php-nginx:8.1

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Set correct permissions for storage and cache folders
RUN chown -R application:application /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["/opt/docker/bin/entrypoint.sh"]
