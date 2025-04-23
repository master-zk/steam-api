FROM php:8.2.15-apache-bullseye

## 用于加速 apt-get update（不要再开梯子了，安装redis容易出问题）
RUN sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

## apt-get install autoconf && apt-get update && pecl channel-update pecl.php.net 用于解决redis安装不成功
## update apt-get
RUN apt-get install autoconf && \
    apt-get update &&  \
    pecl channel-update pecl.php.net &&  \
    apt-get install -y libpq-dev && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev


## install GD extension
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd

## install zip extension
RUN apt-get install -y libzip-dev zip &&  \
    docker-php-ext-install zip
## install pcntl extension
RUN docker-php-ext-install pcntl
## install pdo_mysql extension
RUN docker-php-ext-install pdo_mysql
## install redis extension
RUN pecl install redis && docker-php-ext-enable redis

## enable rewrite module
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

