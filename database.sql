
CREATE DATABASE SIGNUP;
USE signup;

CREATE TABLE IF NOT EXISTS registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL ,
    username VARCHAR(50) NOT NULL ,
    password VARCHAR(255) NOT NULL
);