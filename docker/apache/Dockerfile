FROM httpd:2.4.51

COPY lara9.apache.conf /usr/local/apache2/conf/lara9.apache.conf

RUN echo "Include /usr/local/apache2/conf/lara9.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf