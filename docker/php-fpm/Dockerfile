#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
FROM php:7.2-fpm
LABEL maintainer="Ahsan Atiq <me@ahsanatiq.info>"

# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive

# Start as root
USER root

#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y --no-install-recommends \
    curl \
    git \
    vim \
    htop \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    mysql-client \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    # Install the PHP gd library
    && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd
 
# Add a non-root user
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}
ARG DOCKUSER=newsletter2go
ENV DOCKUSER ${DOCKUSER}
    
RUN set -xe; \
    apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    groupadd -g ${PGID} ${DOCKUSER}  && \
    useradd -u ${PUID} -g ${DOCKUSER} -m ${DOCKUSER} && \
    usermod -p "*" ${DOCKUSER} -s /bin/bash && \
    apt-get install -yqq \
    apt-utils \
    nasm \
    #--------------------------------------------------------------------------
    # Mandatory Software's Installation
    #--------------------------------------------------------------------------
    libzip-dev zip unzip && \
    docker-php-ext-configure zip --with-libzip && \
    # Install the zip extension
    docker-php-ext-install zip && \
    php -m | grep -q 'zip'

# Install xdebug extension
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
RUN sed -i "s/xdebug.remote_autostart=0/xdebug.remote_autostart=1/" /usr/local/etc/php/conf.d/xdebug.ini && \
    sed -i "s/xdebug.remote_enable=0/xdebug.remote_enable=1/" /usr/local/etc/php/conf.d/xdebug.ini && \
    sed -i "s/xdebug.cli_color=0/xdebug.cli_color=1/" /usr/local/etc/php/conf.d/xdebug.ini
    
# install opcache extension   
RUN docker-php-ext-install opcache
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install intl extension
RUN apt-get install -y zlib1g-dev libicu-dev g++ && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl

# Set Timezone
ARG TZ=UTC
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install Composer:
USER root
RUN curl -s http://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
COPY ./composer.json /home/${DOCKUSER}/.composer/composer.json
RUN chown -R ${DOCKUSER}:${DOCKUSER} /home/${DOCKUSER}/.composer
USER ${DOCKUSER}
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="~/.composer/vendor/bin:$PATH"' >> ~/.bashrc
RUN echo "" >> ~/.bashrc && \
    echo 'export PATH="/var/www/vendor/bin:$PATH"' >> ~/.bashrc
    # Install Prestissimo
RUN . ~/.bashrc
RUN composer global install

# Clean up
USER root
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000