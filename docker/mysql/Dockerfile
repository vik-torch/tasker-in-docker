FROM mysql:8.4

RUN if [ ${MYSQL_VERSION} > '8.4.0-0.000' ]; then \
  echo 'mysql_native_password=on' >> /etc/mysql/conf.d/my.cnf \
else \
  echo 'default-authentication-plugin=mysql_native_password' >> /etc/mysql/conf.d/my.cnf \
;fi

ENV MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}
ENV MYSQL_DATABASE=${MYSQL_DATABASE}

EXPOSE 3306