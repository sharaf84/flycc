FROM php:7.3.5-fpm-alpine

# install deps
RUN set -eux; \
	apk add --no-cache mysql-dev; \
	docker-php-ext-install pdo_mysql	

# prepare composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/api

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.json composer.lock ./

RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest; \
	composer clear-cache

# copy app
COPY . ./

# prepare the app
RUN set -eux; \
	composer dump-autoload --classmap-authoritative --no-dev; \
	chown -R www-data storage; \
	php artisan migrate

CMD ["php-fpm"]
