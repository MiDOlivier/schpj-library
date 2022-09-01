-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2022 at 03:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_code` int(11) NOT NULL,
  `book_name` varchar(150) NOT NULL,
  `book_desc` varchar(2000) NOT NULL,
  `book_cover` varchar(150) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_code`, `book_name`, `book_desc`, `book_cover`, `created_at`) VALUES
(1, 'book1', 'book1 is a test book', '/asset/cover/book1.png', '2022-05-29'),
(2, 'book2', 'book2 is a test book', '/asset/cover/book2.png', '2022-05-29'),
(3, 'book3', 'This is a test Book', 'assets/cover/book3', '2022-05-30'),
(15, 'bookEnder', 'A test book', 'assets/cover/bookender.png', '2022-05-30'),
(16, '3', '2', '15', '2022-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_cost` decimal(10,2) NOT NULL,
  `is_returned` tinyint(1) NOT NULL,
  `rented_date` date NOT NULL DEFAULT current_timestamp(),
  `returned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rental_id`, `user_id`, `book_id`, `book_cost`, `is_returned`, `rented_date`, `returned_date`) VALUES
(1, 3, 15, '4.00', 1, '2022-04-05', NULL),
(2, 3, 2, '0.00', 1, '2022-06-05', NULL),
(3, 3, 2, '0.00', 1, '2022-06-05', NULL),
(4, 3, 1, '0.00', 1, '2022-06-05', NULL),
(5, 3, 1, '0.00', 1, '2022-06-05', NULL),
(6, 3, 1, '0.00', 1, '2022-06-05', NULL),
(7, 3, 1, '0.00', 1, '2022-06-05', NULL),
(8, 3, 1, '0.00', 1, '2022-06-05', NULL),
(9, 3, 1, '0.00', 1, '2022-06-05', NULL),
(10, 3, 1, '0.00', 1, '2022-06-05', NULL),
(11, 3, 1, '0.00', 1, '2022-06-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_code` int(11) NOT NULL,
  `role_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_code`, `role_name`) VALUES
(1, 'admin'),
(2, 'student'),
(3, 'teacher'),
(4, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `storage_id` int(11) NOT NULL,
  `book_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`storage_id`, `book_code`) VALUES
(1, 1),
(2, 2),
(5, 3),
(8, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `active_rentals` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `user_name`, `pass`, `balance`, `active_rentals`, `created_at`) VALUES
(1, 1, 'admin', 'admin', '1000.00', 0, '2022-05-31'),
(3, 2, 'anon', 'anon', '96.00', 0, '2022-06-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_code`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_book_id` (`book_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_code`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`storage_id`),
  ADD KEY `fk_book_code` (`book_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_user_type` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `storage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_book_code` FOREIGN KEY (`book_code`) REFERENCES `book` (`book_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type`) REFERENCES `role` (`role_code`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
