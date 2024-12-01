-- Create database
CREATE DATABASE IF NOT EXISTS library_system;

-- Use the database
USE library_system;

-- Create the books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    title VARCHAR(255) NOT NULL,              
    author VARCHAR(255),                      
    borrow_duration INT DEFAULT 14,           
    available BOOLEAN DEFAULT TRUE            
);

-- Create the members table
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    name VARCHAR(255) NOT NULL,               
    email VARCHAR(255) UNIQUE NOT NULL,       
    phone VARCHAR(15),                        
    active BOOLEAN DEFAULT TRUE               
);

-- Create the reservations table
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    book_id INT NOT NULL,                     
    member_id INT NOT NULL,                   
    borrow_date DATE NOT NULL,                
    due_date DATE NOT NULL,                   
    return_date DATE,                         
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create the late fees table
CREATE TABLE late_fees (
    id INT AUTO_INCREMENT PRIMARY KEY,        
    reservation_id INT NOT NULL,              
    late_days INT NOT NULL,                   
    fee FLOAT NOT NULL,                       
    FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE ON UPDATE CASCADE
);
