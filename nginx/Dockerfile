FROM nginx:1.17-alpine AS nginx

RUN rm /etc/nginx/conf.d/default.conf
COPY ./conf.d/* /etc/nginx/conf.d

WORKDIR /srv