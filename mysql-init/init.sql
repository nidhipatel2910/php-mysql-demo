CREATE DATABASE IF NOT EXISTS testdb;
USE testdb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    dob DATE,
    address VARCHAR(255)
);

INSERT INTO users (name, dob, address) 
VALUES 
    ("Nidhi Patel", '2000-10-29', '30 Wortham Dr');

    
