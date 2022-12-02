FROM alpine:3.17
LABEL maintainer="github.contact@captnemo.in"

# Setup apache and php
RUN apk add --no-cache --update \
    php81-apache2 \
    && mkdir /htdocs \
    && sed -i 's#^DocumentRoot ".*#DocumentRoot "/htdocs"#g' /etc/apache2/httpd.conf \
	&& sed -i 's#Directory "/var/www/localhost/htdocs"#Directory "/htdocs"#g' /etc/apache2/httpd.conf

EXPOSE 80

COPY *.php jq /htdocs

ENTRYPOINT ["/usr/sbin/httpd","-D","FOREGROUND"]