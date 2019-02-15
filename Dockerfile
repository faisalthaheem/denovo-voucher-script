FROM php:5.6.40-apache-stretch

LABEL maintainer="Faisal Thaheem" BASENAME="faisalthaheem/dvs"

ADD ./conf/000-default.conf /etc/apache2/sites-enabled/
#copy to temp and move later in below statement to make 
#fs ownership to take effect
ADD ./site/ /opt/site

RUN true \
  && export DEBIAN_FRONTEND=noninteractive \
  && apt-get update \
  && apt-get install -y --no-install-recommends \
  nano \
  && docker-php-ext-install mysqli pdo pdo_mysql \
  && a2enmod rewrite \
  && rm -Rf /var/www/html \
  && mv /opt/site /var/www/html \
  && chown -R www-data.www-data /var/www/html

ENV DEBUG=0

VOLUME ["/var/www/html"]

EXPOSE 80