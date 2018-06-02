FROM php:7.1-cli

MAINTAINER Rafael Silveira <rsilveiracc@gmail.com>

RUN apt-get update && \
    apt-get install -y git zip unzip && \
    php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

ADD ./ /var/www

WORKDIR /var/www

# Run composer install with the correct options if GITHUB_OAUTH is set or not
RUN if [ -z "$GITHUB_OAUTH" ]; then \
        composer install --no-scripts --no-progress --no-autoloader --no-suggest --prefer-source --dev; \
    else \
        composer config --global github-oauth.github.com "$GITHUB_OAUTH"; \
        composer install --no-scripts --no-progress --no-autoloader --no-suggest --prefer-dist --dev; \
    fi;

RUN composer dump-autoload --optimize
