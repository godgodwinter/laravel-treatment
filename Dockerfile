FROM alpine:3.14
LABEL Maintainer="Kukuh Setya Nugraha <github@godgodwinter>" \
      Description="Laravel Sistem Manajemen Treatment dengan SMS gateway."

ARG PHP_VERSION="8.0.12-r0"

# https://github.com/wp-cli/wp-cli/issues/3840
ENV PAGER="more"
