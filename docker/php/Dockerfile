FROM amazonlinux:latest

RUN yum -y update

RUN amazon-linux-extras install php8.0

RUN yum install -y php-bz2 php-calendar php-ctype php-curl php-exif php-fileinfo php-ftp php-gettext php-iconv php-mysqlnd php-pdo php-phar php-sockets php-sqlite3 php-tokenizer php-zip php-mysqli php-pdo_mysql php-pdo_sqlite php-xml php-mbstring php-intl

# xdebug install
RUN yum install -y php-pear php-devel gcc make \
  && pecl install xdebug

# use php-fpm default tcp
EXPOSE 9000

# run php-fpm in the foreground
ENTRYPOINT /usr/sbin/php-fpm -F

COPY ./www.conf /etc/php-fpm.d/www.conf
COPY ./php.ini /etc/php.d/90_custom_php.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
