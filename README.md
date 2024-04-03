## Introduction

The goal of this project is to create a web application as an educational assessment for the classes of _Desenvolvimento Web Servidor_ during the first semester of 2024.

The choosen theme for this project is _Sistema Web para Imobiliárias_.

This code base is inteded for development only.

### Project organization

The project will consist of three phases which will be separated on their respective branches, this may change the requirements on environment/dependencies.

### Tested environment

1. Ubuntu 22.04.4 LTS
2. PHP 8.1.2
3. Apache/2.4.52 (Ubuntu)

### Installation and getting started

```
git clone https://github.com/vvalentim/webserver-2024-1.git
```

#### If you're running the PHP builtin web server:

```
cd webserver-2024-1/

php -S localhost:8080 -t public/ dev-server.php
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

Ideally you should configure the document root and directory to point to the **public** folder like:

```
ServerAdmin webmaster@localhost
DocumentRoot /home/user/projects/webserver-2024-1/public

<Directory /home/user/projects/webserver-2024-1/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```
