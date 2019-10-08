### Update your machine
`$ sudo apt update && sudo apt upgrade`
### Install apache2
`$ sudo apt install apache2 apache2-utils`
### Install PhP
`$ sudo apt install php php-pgsql libapache2-mod-php`
### Install Postgresql
I prefer Postgresql, but I’m pretty sure that you can replace that part by MySQL or your favorite database easily.

`$ sudo apt install postgresql libpq5 postgresql-9.5 postgresql-client-9.5 postgresql-client-common postgresql-contrib`
### (Optional) Install PhpPgAdmin
`$ sudo apt install phppgadmin`
### (Optional) Install PgAdmin3
`$ sudo apt install pgadmin3`
### Initialize Postgresql
`$ sudo -i -u postgres`

`$ psql`

` CREATE USER root WITH PASSWORD 'root';`

` CREATE DATABASE "test";`

` GRANT ALL ON DATABASE "test" TO root;`

` \q`

`$ exit`
### Restart apache2
reload apache2 in order to consider this new configuration.

`$ sudo service apache2 reload`