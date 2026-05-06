-- Active: 1777994415959@@127.0.0.1@3306
CREATE DATABASE library;
use library;
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(255) NOT NULL
);
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    dateC DATE NOT NULL
);
CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    isbn VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL
);
CREATE TABLE bibliotheques (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE membres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);
CREATE TABLE borrowings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    membre_id INT NOT NULL,
    book_id INT NOT NULL,
    borrowat DATE NOT NULL,
    returnat DATE NOT NULL,
    FOREIGN KEY (membre_id) REFERENCES membres(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);
