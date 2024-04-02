CREATE DATABASE webserver_2024;

CREATE TABLE users (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', '$2y$10$4ognoJWK1RYp.81fOffjVu4xfK1EqH37sYKPhH6smKEQEwFEO.Fne');