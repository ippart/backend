FROM alpine

RUN echo "@community http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories && \
    echo "@main http://dl-cdn.alpinelinux.org/alpine/edge/main" >> /etc/apk/repositories && \
    apk add --update --no-cache --no-progress \
        libwebp@main \
        libressl2.5-libcrypto@main \
        libressl2.5-libssl@main \
        php7-common@community \
        php7-fpm@community \
        php7-session@community \
        php7-curl@community \
        php7-gd@community \
        php7-mcrypt@community \
        php7-mbstring@community \
        php7-mysqli@community \
        php7-mysqlnd@community \
        php7-openssl@community \
        php7-zip@community \
        php7-zlib@community

COPY build /app

ENTRYPOINT ["/bin/sh", "/app/entrypoint/ippart-dev.sh"]

VOLUME ["/app"]

CMD ["php-fpm7", "-F"]
