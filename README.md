## Introduction

The goal of this project is to create a web application as an educational assessment for the classes of _Desenvolvimento Web Servidor_ during the first semester of 2024.

The choosen theme for this project is _Sistema Web para Imobiliárias_.

This code base is inteded for development only.

### Project organization

The project will consist of three phases which will be separated on their respective branches, this may change the requirements on environment/dependencies.

### Environment

1. Ubuntu 22.04.4 LTS
2. PHP 8.1.2

### Installation and getting started

#### If you're running the PHP builtin web server:

```
apt install php8.1

git clone https://github.com/vvalentim/webserver-2024-1.git
cd webserver-2024-1/

php -S localhost:8080 dev-server.php
```

#### If you're running Apache:

First you will need to enable the rewrite module with:

```
a2enmod rewrite
systemctl restart apache2
```

Then you will need to change the AllowOverride directive on your virtual host configuration file, it should look like this:

```
<Directory /var/www/html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```
