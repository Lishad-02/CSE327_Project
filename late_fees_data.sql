-- sample_data.sql

-- Insert sample data into 'late_fees' table
INSERT INTO late_fees (reservation_id, late_days, fee) VALUES
(1, 3, 15.00),  -- Late fee for reservation ID 1: 3 days late, $15 fee
(2, 5, 25.00);  -- Late fee for reservation ID 2: 5 days late, $25 fee
