FROM alpine:3.17
LABEL maintainer="github.contact@captnemo.in"

# Setup apache and php
RUN apk add --no-cache --update \
    php81-apache2 \
    && mkdir /htdocs

EXPOSE 80

ADD docker-entrypoint.sh /

COPY *.php jq /htdocs

HEALTHCHECK CMD wget -q --no-cache --spider localhost

ENTRYPOINT ["/docker-entrypoint.sh"]