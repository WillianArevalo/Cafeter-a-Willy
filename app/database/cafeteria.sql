CREATE DATABASE cafeteria;

USE cafeteria;

CREATE TABLE
    usuario (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL,
        clave VARCHAR(100) NOT NULL,
        rol VARCHAR(50) NOT NULL
    );

CREATE TABLE
    categoria (
        id int not null auto_increment primary key,
        nombre varchar(20),
        descripcion varchar(40)
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