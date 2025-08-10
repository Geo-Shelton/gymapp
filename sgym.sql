-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 04:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgym`
--

-- --------------------------------------------------------

--
-- Table structure for table `gold_members`
--

CREATE TABLE `gold_members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `payment_status` enum('Paid','Unpaid') DEFAULT 'Unpaid',
  `workout_sessions` varchar(255) DEFAULT NULL,
  `personal_trainer_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gold_members`
--

INSERT INTO `gold_members` (`id`, `name`, `phone`, `password`, `due_date`, `payment_status`, `workout_sessions`, `personal_trainer_phone`) VALUES
(1, 'gold1', '9342962897', '$2y$10$d05FaYQGErjm4KLun4tuQuN7YDey8RLRDyw6NnFManRbPs4idJDzG', '2024-07-27', 'Paid', 'Aerobics,Zumba,Yoga,Cross Fitness,Gymnastics,Steam Bath', '4756856344'),
(2, 'gold1', '9342962402', '$2y$10$jbnJ3iGRWMXndtZ2KJzwg.G6JJ8CCx/L5VNTyJmBiqgYCtjpAJC1u', '2024-07-27', 'Unpaid', 'Cross Fitness,Gymnastics,Steam Bath', '3456345756');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `workout_sessions` varchar(255) DEFAULT NULL,
  `due_date` date NOT NULL,
  `payment_status` enum('Paid','Unpaid') DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `phone`, `password`, `workout_sessions`, `due_date`, `payment_status`) VALUES
(9, 'person2', '8264892333', '$2y$10$8yVcn8k0dve0sVABa04vlOl0c6fbwDRYhnwI2uVTNp3aA18WTGJ8i', 'Aerobics,Zumba,Cross Fitness', '2024-08-26', 'Paid'),
(11, 'person1', '7904395110', '$2y$10$Lz/CZDyRlcHYhuyW0z/DoOr0Dt/ZPynPq78kslHXxK22wnzswL1N2', 'Yoga', '2024-08-24', 'Paid'),
(13, 'person3', '7904395110', '$2y$10$eABLpUV.eE0CtOG9078o8uAIB2KMk9liUS1WqymBxjhCb8a1lQzkS', 'Zumba', '2024-08-26', 'Unpaid'),
(14, 'kjlkhsdlg', '7904395110', '$2y$10$IfAc9dT7l5GjQRATLzYC5OJYSy3VvrZr6sSJEjdPXOSJgxSh8Gy0O', 'Zumba', '2024-08-31', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `silver_members`
--

CREATE TABLE `silver_members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `payment_status` enum('Paid','Unpaid') DEFAULT 'Unpaid',
  `workout_sessions` varchar(255) DEFAULT NULL,
  `personal_trainer_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `silver_members`
--

INSERT INTO `silver_members` (`id`, `name`, `phone`, `password`, `due_date`, `payment_status`, `workout_sessions`, `personal_trainer_phone`) VALUES
(1, 'silver1', '7904395110', '$2y$10$/ADmJiiYCQatBw1WdDpKUe68jDXQr0UiI0lQXJamPzfKVXLdZRL.m', '2024-08-30', 'Unpaid', 'Zumba,Yoga,Cross Fitness', '3464567347');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `field` enum('Aerobics Trainer','Zumba Trainer','Yoga Trainer','Cross Fitness','Gymnastics Trainer') NOT NULL,
  `year_of_experience` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `time` enum('Part Time','Full Time') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `phone`, `gender`, `field`, `year_of_experience`, `age`, `time`) VALUES
(19, 'trainer6', '9784356544', 'Male', 'Aerobics Trainer', 6, 33, 'Full Time'),
(20, 'trainer7', '9567543542', 'Female', 'Cross Fitness', 12, 33, 'Part Time'),
(21, 'trainer8', '9547355446', 'Female', 'Zumba Trainer', 5, 35, 'Full Time');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_applications`
--

CREATE TABLE `trainer_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `field` varchar(50) NOT NULL,
  `year_of_experience` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_applications`
--

INSERT INTO `trainer_applications` (`id`, `name`, `phone`, `gender`, `field`, `year_of_experience`, `age`, `time`) VALUES
(2, 'trainer1', '5678595747', 'Male', 'Aerobics Trainer', 3, 22, '0'),
(4, 'trainer4', '8967856636', 'Female', 'Zumba Trainer', 4, 32, '0'),
(5, 'trainer3', '9678345654', 'Male', 'Gymnastics Trainer', 3, 27, '0'),
(6, 'trainer2', '9678363674', 'Female', 'Yoga Trainer', 4, 44, '0'),
(7, 'geo', '9999999999', 'Male', 'Gymnastics Trainer', 1, 21, '0'),
(8, 'trainer6', '9784356544', 'Male', 'Aerobics Trainer', 6, 33, '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `phone`) VALUES
(3, 'Hermann Schuster', 'herm32@gmail.com', '9874992668'),
(7, 'sooriya', 'soriya2342@gmail.com', '9894767542'),
(8, 'Mathan', 'mathan793@gmail.com', '9888726452'),
(12, 'geo', 'geo2002@gmail.com', '9342962402'),
(14, 'raj', 'raj@gmail.com', '5555555588'),
(15, 'ramlaman', 'ajhgsda@gmail.com', '4983789643');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `visit_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gold_members`
--
ALTER TABLE `gold_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `silver_members`
--
ALTER TABLE `silver_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gold_members`
--
ALTER TABLE `gold_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `silver_members`
--
ALTER TABLE `silver_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `trainer_applications`
--
ALTER TABLE `trainer_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
