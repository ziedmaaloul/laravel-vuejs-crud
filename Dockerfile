# Use an official PHP 8 runtime as a parent imag
FROM ubuntu:latest

# Set timezone
ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt update && apt upgrade -y
RUN apt install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt install php8.2 -y
RUN apt-get install -y php8.2-cli php8.2-common php8.2-fpm php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml
RUN apt-get install -y php8.2-bcmath mysql-client git unzip libicu-dev libpq-dev libzip-dev  curl wget php-pear php8.2-dev
RUN apt-get install -y php-intl


ARG NODE_VERSION=14.16.0
ARG NODE_PACKAGE=node-v$NODE_VERSION-linux-x64
ARG NODE_HOME=/opt/$NODE_PACKAGE

ENV NODE_PATH $NODE_HOME/lib/node_modules
ENV PATH $NODE_HOME/bin:$PATH

RUN curl https://nodejs.org/dist/v$NODE_VERSION/$NODE_PACKAGE.tar.gz | tar -xzC /opt/

WORKDIR /var/www/html

RUN curl -sS https://get.symfony.com/cli/installer | bash
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Install application dependencies
RUN composer install && composer clear-cache && composer dump-autoload
# Build VueJs Project Into Laravel Rendered
RUN cd resources/frontend && npm install &&  npm run build &&  cd ../..

EXPOSE 8000
RUN mv env-data .env

# Migrate Database
RUN php artisan migrate
#Clear laravel Cache
RUN php artisan cache:clear

RUN chown -R www-data:www-data /var/www/html/public
RUN chmod -R 755 /var/www/html/public

CMD ["php", "artisan" , "serve"]
