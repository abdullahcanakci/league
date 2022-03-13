# League Prediction Service

Service developed and tested under php8.1 with extensions listed below:
```
pdo,xml,calendar,ctype,curl,dom,exif,ffi,fileinfo,
ftp,gd,gettext,iconv,igbinary,mbstring,pdo_pgsql,pgsql,
phar,posix,readline,redis,shmop,simplexml,sockets,
sysvmsg,sysvsem,sysvshm,tokenizer,xmlreader,xmlwriter,xsl
```

Service requires a PostgreSQL database for all environments since a generated column is used.
Connection options can be from relavent `.env` files 

# Start Up

```bash
cp .env.example .env
nano .env
# Fill out the relevant information. Mainly db config.
```

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

# General Information
Match result are purely random but has an advantage of 0.5 goal point advantage for the leading team of the two.

Prediction is calculated as a teams achievement of a their potential. A team can achieve maximum of 18 points if a teams has collected 9 points they achieved %50 of their potential. This achievement then run over with other contenders and normalized futher to make prediction meaningful.