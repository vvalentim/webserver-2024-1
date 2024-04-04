## Introdução

O objetivo desse projeto é criar uma aplicação web como um exercício avaliativo para a disciplina de _desenvolvimento web servidor_ durante o primeiro semestre de 2024.

O tema escolhido para o projeto é _sistema web para imobiliárias_.

Os participantes desse projeto são: João Victor Valentim e Guilherme Czarnecki Oconoski.

### Organização do projeto

Esse projeto vai consistir em três etapas, onde o código será separado após cada entrega. Dessa forma o ambiente, as dependências e instruções podem variar de acordo com cada etapa do projeto.

### Ambientes testados

1. Ubuntu 22.04.4 LTS (WSL2)
2. PHP 8.1.2
3. Apache/2.4.52 (Ubuntu)

### Instalação e execução

```
git clone https://github.com/vvalentim/webserver-2024-1.git
```

#### Para execução com o servidor do PHP:

```
cd webserver-2024-1/

php -S localhost:8080 -t public/ dev-server.php
```

#### Para execução com o servidor Apache:

Primeiro, é necessário habilitar o módulo de de reescrita do Apache:

```
a2enmod rewrite
systemctl restart apache2
```

Then you will need to change the AllowOverride directive on your virtual host configuration file, it should look like this:

Em seguida, alterar a diretiva *AllowOverride* para *All* no seu arquivo de configuração da sua *virtual host*, ficará parecido com:

```
<Directory /var/www/html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Por fim, configure o *document root* e *directory* para apontar para a pasta *public* do projeto, tal como:

```
ServerAdmin webmaster@localhost
DocumentRoot /home/user/projects/webserver-2024-1/public

<Directory /home/user/projects/webserver-2024-1/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```
