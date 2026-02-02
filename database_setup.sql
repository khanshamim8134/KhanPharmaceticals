-- Create Database
CREATE DATABASE IF NOT EXISTS khan_pharmaceuticals;
USE khan_pharmaceuticals;

-- Create Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    userType VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    company VARCHAR(150),
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_date DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login DATETIME NULL,
    status VARCHAR(20) DEFAULT 'active'
);

-- Create Index for faster queries
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_userType ON users(userType);

-- Optional: Create Activity Log Table
CREATE TABLE IF NOT EXISTS activity_log (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(100),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
