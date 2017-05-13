FROM alpine

RUN echo "@community http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories && \
    apk add --update --no-cache --no-progress --quiet \
    php7-fpm@community \
    php7-session@community \
    php7-curl@community \
    php7-gd@community \
    php7-mbstring@community \
    php7-mysqli@community \
    php7-zip@community \
    php7-zlib@community

COPY build /app

ENTRYPOINT ["/bin/sh", "/app/entrypoint/ippart.sh"]

CMD ["php-fpm7", "-F"]
