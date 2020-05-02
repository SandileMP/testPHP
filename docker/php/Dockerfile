FROM php:5.6-apache
RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN apt-get install -y libmcrypt-dev libssl-dev unzip git libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN apt-get install -y libmagickwand-dev --no-install-recommends
RUN apt-get update && apt-get install -y ssmtp &&   apt-get clean &&   echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf &&   echo 'sendmail_path = "/usr/sbin/ssmtp -t"' > /usr/local/etc/php/conf.d/mail.ini
RUN pecl install imagick-3.4.3 && docker-php-ext-enable imagick
RUN docker-php-ext-install mcrypt zip pdo pdo_mysql bcmath
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install mysqli intl
RUN docker-php-ext-configure intl
RUN a2enmod rewrite
RUN a2enmod ssl
RUN apt-get update && apt-get install -y certbot python-certbot-apache && apt-get clean
RUN rm -rf /var/lib/apt/lists/*
add php.ini /usr/local/etc/php/php.ini
add vhost.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /app
