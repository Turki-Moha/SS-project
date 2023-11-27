-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 10:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `course_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_description`, `course_credits`) VALUES
(1, 'Web Development', 'Learn how to build a website', 6),
(2, 'Database Management', 'Learn how to manage a database', 3),
(3, 'Software Engineering', 'Learn how to build software', 3),
(4, 'Computer Networks', 'Learn how to build a network', 3),
(5, 'Computer Architecture', 'Learn how to build a computer', 3),
(6, 'Operating Systems', 'Learn how to build an operating system', 3),
(7, 'Computer Security', 'Learn how to secure a computer', 3),
(8, 'Software Security', 'Learn how to secure a computer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_semester` varchar(255) NOT NULL,
  `enrollment_year` int(11) NOT NULL,
  `enrollment_grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `user_id`, `course_id`, `enrollment_semester`, `enrollment_year`, `enrollment_grade`) VALUES
(5, 2, 6, 'second', 2019, 'A'),
(6, 1, 2, 'second', 2020, 'B'),
(7, 1, 1, 'first', 2000, 'A'),
(8, 1, 8, 'second', 2016, 'A'),
(9, 12, 1, 'first', 2000, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`) VALUES
(1, '1', '1@1.1', '11', 'user'),
(2, '1234', '123@123.123', '111', 'user'),
(3, '111', '111@111.111', '', 'user'),
(4, '123', '11@11.11', '$2y$10$xC.AF95dQhanW90h53AsVeQxXmX.FD0ammlXXxHCXq62BnH/4dvVC', 'user'),
(5, '123', '1@1.1', '$2y$10$1RDadTtz1yK39wPKgXN9JOuMNs3MTGJDjmOqsqXnyrW90E5Ue1etW', 'user'),
(6, '111', '1@2.3', '$2y$10$84y6.fWi9M256j9ls2QhTuOHDdtyWz7qQHBzIOvmFO7NHGEY6rM4G', 'user'),
(7, '111', '111@111.111', '$2y$10$1cyPRCtE2vWFRKtKKRaFYOiJqtfeAaGHUDXuNmnEbw2SOtdOwVzLa', 'user'),
(8, '1tt', '1tt@1tt.1tt', '$2y$10$eTWT3rilHB9sJhbtQ7e1CerbMNTGNDPdsGGGksDkEoS6/cgNnKNhi', 'user'),
(9, '1234', '12344@12344.12344', '$2y$10$R8RM.GzEhS0vNq/PUA5oe.uXbiFUR22.G9zhvU5Ialwae2ectPvEC', 'user'),
(10, 'turki', 'turki@t.com', 'turki', 'admin'),
(11, '101010', '101010@101010.101010', '$2y$10$2/hlALawr2kggS0qZUjzZu7wZCUAn2/avBtSlKD6HTNGTx.gOyAou', 'user'),
(12, '1q1q', '1q1q@1q1q.1q1q', '1q1q', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
