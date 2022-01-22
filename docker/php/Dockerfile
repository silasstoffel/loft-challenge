FROM composer as composer

FROM php:8.1.0-fpm

WORKDIR /var/www/

ENV ACCEPT_EULA=Y

########################################################################################################################
# Install system dependencies
########################################################################################################################
RUN apt-get update && \
    export DEBIAN_FRONTEND=noninteractive && \
    apt-get install -y --no-install-recommends \
    apt-utils \
    curl \
    libicu-dev \
    libcurl4-gnutls-dev \
    libpng-dev \
    libssl-dev \
    libxml2-dev \
    libpq-dev \
    openssl \
    tcpdump \
    telnet \
    unzip \
    wget && \
    rm -rf /var/lib/apt/lists/*


########################################################################################################################
# Install Composer
########################################################################################################################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer



CMD ["php-fpm"]

#COPY . .

#RUN composer install
