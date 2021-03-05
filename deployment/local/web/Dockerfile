FROM nginx:1.15.3 as base

COPY default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/public

RUN touch index.html

RUN echo "daemon off;" >> /etc/nginx/nginx.conf

EXPOSE 80

CMD ["service", "nginx", "start"]
