FROM alpine

RUN echo "@community http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories && \
    apk add --update --no-cache --no-progress --quiet php7-fpm

COPY build /app

ENTRYPOINT ["/bin/sh", "/app/entrypoint/ippart.sh"]

CMD ["php-fpm7", "-F"]
