CREATE DATABASE cafeteria;

USE cafeteria;

CREATE TABLE
    usuario (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL,
        email VARCHAR(50) NOT NULL,
        clave VARCHAR(100) NOT NULL,
        imagen VARCHAR(200),
        direccion VARCHAR(255),
        rol VARCHAR(50) NOT NULL
    );

INSERT INTO
    usuario (username, email, clave, rol)
VALUES
    (
        "Willian",
        "awillianernesto@gmail.com",
        "123",
        "admin"
    );

CREATE TABLE
    categoria (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(20),
        descripcion VARCHAR(40),
        imagen VARCHAR(200),
        id_categoria_padre INT,
        FOREIGN KEY (id_categoria_padre) REFERENCES categoria (id)
    );

CREATE TABLE
    acompañante (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        descripcion VARCHAR(255) NOT NULL,
        precio DECIMAL(10, 2) NOT NULL
    );

CREATE TABLE
    producto (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(255) NOT NULL,
        descripcion VARCHAR(255) NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        id_categoria INT NOT NULL,
        imagen VARCHAR(200) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (id_categoria) REFERENCES categoria (id)
    );

CREATE TABLE
    detalle_acompañante (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_producto INT NOT NULL,
        id_acompañante INT NOT NULL,
        FOREIGN KEY (id_producto) REFERENCES producto (id),
        FOREIGN KEY (id_acompañante) REFERENCES acompañante (id)
    );

CREATE TABLE
    bebida (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(255) NOT NULL,
        descripcion VARCHAR(255) NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        PRIMARY KEY (id)
    );