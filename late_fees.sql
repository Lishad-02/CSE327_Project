-- schema.sql

-- Create the 'late_fees' table
CREATE TABLE late_fees (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Unique late fee ID
    reservation_id INT NOT NULL,              -- Foreign key referencing 'reservations.id'
    late_days INT NOT NULL,                   -- Number of days overdue
    fee DECIMAL(10, 2) NOT NULL,              -- Total calculated late fee
    calculated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the fee was calculated
    FOREIGN KEY (reservation_id) REFERENCES reservations(id) 
        ON DELETE CASCADE ON UPDATE CASCADE   -- Maintain referential integrity
);
