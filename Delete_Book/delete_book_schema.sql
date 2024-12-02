
-- Create database
CREATE DATABASE IF NOT EXISTS delete_book;

USE delete_book;

-- Create books table
CREATE TABLE IF NOT EXISTS books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    isbn VARCHAR(13) NOT NULL UNIQUE,
    inventory_count INT NOT NULL
);

-- Insert sample data
INSERT INTO books (title, author, isbn, inventory_count) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 5),
('1984', 'George Orwell', '9780451524935', 3),
('To Kill a Mockingbird', 'Harper Lee', '9780061120084', 4);
