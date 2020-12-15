FROM php:7.4-cli
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install mysqli pdo_mysql
COPY . /var/www/html/myweb
WORKDIR /var/www/html/myweb
CMD [ "php", "./index.php" ]
