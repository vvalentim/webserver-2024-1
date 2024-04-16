CREATE DATABASE webserver_2024;

CREATE TABLE users (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

create table leads (
	id SERIAL primary key,
	name varchar(200) not null,
	phone varchar(16) not null,
	email varchar(200) not null,
	subject varchar(100) not null,
	message text
);

alter table imoveis add column imagem_path varchar(255);
alter table imoveis type varchar(255);

INSERT INTO users (username, password) VALUES ('admin', '$2y$10$4ognoJWK1RYp.81fOffjVu4xfK1EqH37sYKPhH6smKEQEwFEO.Fne');