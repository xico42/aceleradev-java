FROM composer:1 as composer

FROM php:7.3-cli
RUN groupadd -g 1000 app \
    && useradd -m -u 1000 -g app app \
    && mkdir -p /opt/.composer \
    && mkdir -p /opt/project \
    && chown app:app -R /opt/.composer \
    && chown app:app -R /opt/project \
    && apt update && apt install -y git unzip
USER app:app
COPY  --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_HOME=/opt/.composer
VOLUME [ "/opt/project", "/opt/.composer" ]
WORKDIR /opt/project
