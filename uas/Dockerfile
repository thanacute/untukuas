
#COPY . /usr/src/myapp
#WORKDIR /usr/src/myapp
#CMD [ "php", "./index.php" ]

FROM php:7.4-cli
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install mysqli
CMD [ "php", "./index.php" ]
COPY . /var/www/html/myweb