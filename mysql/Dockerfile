FROM mariadb:10.5.8

# Make sure we have the correct timezone in the database
COPY ./conf.d/timezone.cnf /etc/mysql/conf.d/99-default.timezone.cnf
COPY ./conf.d/slow-log.cnf /etc/mysql/conf.d/99-slow-log.cnf

CMD ["mysqld"]