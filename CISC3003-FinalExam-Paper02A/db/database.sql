CREATE DATABASE IF NOT EXISTS finalexam_a;
USE finalexam_a;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    bio TEXT NOT NULL,
    country VARCHAR(50) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    subscribe TINYINT(1) NOT NULL DEFAULT 0
);