
-- Library Management System SQL Script

-- Create the database
CREATE DATABASE IF NOT EXISTS library_management;
USE library_management;

-- Create the members table
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    membership_type ENUM('standard', 'premium') DEFAULT 'standard',
    join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data into the members table
INSERT INTO members (member_name, contact_info, address, email, membership_type)
VALUES
    ('John Doe', '1234567890', '123 Elm Street', 'johndoe@example.com', 'standard'),
    ('Jane Smith', '9876543210', '456 Oak Avenue', 'janesmith@example.com', 'premium');
