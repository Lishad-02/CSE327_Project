-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
-- 
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 12:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- Database: `library_db2`

-- --------------------------------------------------------

-- Table structure for table `books`

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `total_copies` int(11) DEFAULT 1,
  `available_copies` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `books`
INSERT INTO `books` (`book_id`, `title`, `author`, `genre`, `total_copies`, `available_copies`) VALUES
(2, '1984', 'George Orwell', 'Dystopian', 3, 1),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Classic', 4, 2),
(4, 'The Catcher in the Rye', 'J.D. Salinger', 'Classic', 2, 2),
(5, 'The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 6, 6),
(6, 'Pride and Prejudice', 'Jane Austen', 'Romance', 3, 3),
(7, 'Moby-Dick', 'Herman Melville', 'Adventure', 2, 1),
(8, 'War and Peace', 'Leo Tolstoy', 'Historical Fiction', 3, 2),
(9, 'The Odyssey', 'Homer', 'Epic', 5, 4),
(10, 'Hamlet', 'William Shakespeare', 'Tragedy', 4, 4);

-- --------------------------------------------------------

-- Table structure for table `borrow`

CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `borrow_date` date DEFAULT curdate(),
  `due_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `borrow`
INSERT INTO `borrow` (`borrow_id`, `user_email`, `book_id`, `borrow_date`, `due_date`, `return_date`) VALUES
(1, 'll@gmail.com', 2, '2024-10-31', '2024-11-07', NULL),
(2, 'gg@gmail.com', 3, '2024-10-31', '2024-11-07', NULL),
(3, 'ankon@gmail.com', 3, '2024-11-01', '2024-11-07', NULL),
(4, 'mokbul@gmail.com', 7, '2024-11-22', '2024-11-28', NULL),
(5, 'user3@gmail.com', 9, '2024-11-22', '2024-11-28', NULL),
(6, 'aurongojeblishad02@gmail.com', 2, '2024-11-22', '2024-11-28', NULL),
(7, 'aurongojeblishad@gmail.com', 8, '2024-11-22', '2024-11-28', NULL);

-- --------------------------------------------------------

-- Indexes for dumped tables

-- Indexes for table `books`
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

-- Indexes for table `borrow`
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `book_id` (`book_id`);

-- --------------------------------------------------------

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `books`
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

-- AUTO_INCREMENT for table `borrow`
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- --------------------------------------------------------

-- Constraints for dumped tables

-- Constraints for table `borrow`
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

-- ----------------------------------------------
-- Book Return Logic:
-- To handle the return of a book, you will need to:
-- 1. Update the `borrow` table with the return date.
-- 2. Update the `books` table to increment the available copies of the returned book.

-- Example SQL to process a book return:
-- 1. Updating the `borrow` table to set the return date
UPDATE `borrow`
SET `return_date` = CURDATE()  -- Set the current date as the return date
WHERE `borrow_id` = 1;  -- Specify the borrow record id

-- 2. Updating the `books` table to increase the available copies
UPDATE `books`
SET `available_copies` = `available_copies` + 1  -- Increase available copies by 1
WHERE `book_id` = 2;  -- Specify the book id

COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
