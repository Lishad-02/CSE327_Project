-- Use the database
USE library_system;

-- Insert sample books
INSERT INTO books (title, author, borrow_duration, available) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 14, TRUE),
('1984', 'George Orwell', 14, TRUE),
('To Kill a Mockingbird', 'Harper Lee', 14, TRUE),
('Moby-Dick', 'Herman Melville', 30, TRUE),
('Pride and Prejudice', 'Jane Austen', 14, TRUE);

-- Insert sample members
INSERT INTO members (name, email, phone, active) VALUES
('John Doe', 'john.doe@example.com', '1234567890', TRUE),
('Jane Smith', 'jane.smith@example.com', '9876543210', TRUE),
('Robert Brown', 'robert.brown@example.com', '4567891230', TRUE);

-- Insert sample reservations
INSERT INTO reservations (book_id, member_id, borrow_date, due_date, return_date) VALUES
(1, 1, '2024-11-01', '2024-11-15', '2024-11-18'), -- Late return
(2, 2, '2024-11-05', '2024-11-19', NULL),         -- Not yet returned
(3, 3, '2024-11-10', '2024-11-24', '2024-11-22'); -- Returned on time

-- Insert sample late fees
INSERT INTO late_fees (reservation_id, late_days, fee) VALUES
(1, 3, 15.00); -- Example late fee for reservation ID 1
