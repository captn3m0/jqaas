FROM alpine:3.19
LABEL maintainer="github.contact@captnemo.in"

# Setup apache and php
RUN apk add --no-cache --update \
    php82-apache2 php82-openssl \
    && mkdir /htdocs \
    && sed -i 's#^DocumentRoot ".*#DocumentRoot "/htdocs"#g' /etc/apache2/httpd.conf \
	&& sed -i 's#Directory "/var/www/localhost/htdocs"#Directory "/htdocs"#g' /etc/apache2/httpd.conf

EXPOSE 80

COPY *.php jq /htdocs

ENTRYPOINT ["/usr/sbin/httpd","-D","FOREGROUND"]