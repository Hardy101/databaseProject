-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2022 at 04:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `loginform`
--

CREATE TABLE `loginform` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginform`
--

INSERT INTO `loginform` (`id`, `user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_action`
--

CREATE TABLE `user_action` (
  `id` int(11) NOT NULL,
  `transact_type` varchar(255) NOT NULL,
  `transact_desc` varchar(255) NOT NULL,
  `transact_amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_action`
--

INSERT INTO `user_action` (`id`, `transact_type`, `transact_desc`, `transact_amount`, `created_at`) VALUES
(1, 'expense', 'food', '200', '2022-10-16 02:40:34'),
(2, 'expense', 'drugs', '300', '2022-10-16 03:08:48'),
(3, 'expense', 'Bills', '500', '2022-10-16 03:26:53'),
(5, 'income', 'salary', '500', '2022-10-16 03:27:37'),
(6, 'income', 'Salary', '300', '2022-10-16 11:33:51'),
(7, 'expense', 'Fowl', '200', '2022-10-16 18:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_balance` int(255) NOT NULL,
  `user_income` int(255) NOT NULL,
  `user_expense` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_balance`, `user_income`, `user_expense`, `name`) VALUES
(1, 100, 100, 0, 'Peter'),
(4, 500, 1000, 500, 'Eghosa'),
(6, 400, 300, 200, 'Eseose'),
(7, 0, 0, 0, 'Peter'),
(9, 0, 0, 0, 'emma'),
(10, 0, 0, 0, 'Ighodaro');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `fname`, `lname`) VALUES
(1, 'Peters', 'egh@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'Peters', 'Anders'),
(4, 'Eghosa', 'Eghordia@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'Eghosa', 'Ordia'),
(6, 'Eseose', 'eseose@yahoo.com', '9ee70b7987a735c046ac30a1556272c8', 'user', 'Eseose', 'Peters'),
(7, 'Peter', 'Peters@gmail.com', 'fed33392d3a48aa149a87a38b875ba4a', 'user', 'Peter', 'Hale'),
(8, 'emma', 'ab@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'emma', 'osazee'),
(9, 'Ighodaro', 'dynamicheartphotography@gmail.com', 'b72f3bd391ba731a35708bfd8cd8a68f', 'admin', 'Ighodaro', 'Nadia');

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `transact_type` varchar(255) NOT NULL,
  `transact_desc` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `name`, `transact_type`, `transact_desc`, `amount`, `created_at`) VALUES
(1, 'Peters', 'expense', 'Bills', 300, '2022-10-17 09:40:55'),
(1, 'Peters', 'expense', 'Dog Feed', 100, '2022-10-17 09:40:55'),
(4, 'Eghosa', 'expense', 'Utility Bill', 100, '2022-10-17 09:55:28'),
(6, 'Eseose', 'income', 'Web design', 100, '2022-10-17 10:07:56'),
(6, 'Eseose', 'expense', 'Manga', 50, '2022-10-17 10:09:39'),
(1, 'Peters', 'expense', 'Pigeon Feed', 200, '2022-10-17 10:31:01'),
(4, 'Eghosa', 'income', 'Salary', 400, '2022-10-17 10:48:07'),
(4, 'Eghosa', 'income', 'Brick Laying', 500, '2022-10-17 11:00:26'),
(4, 'Eghosa', 'expense', 'school fees', 20000, '2022-10-17 12:21:23'),
(8, 'emma', 'income', 'sold a car', 20000, '2022-10-17 12:25:45'),
(8, 'emma', 'expense', 'bought a house', 10000, '2022-10-17 12:26:22'),
(8, 'emma', 'income', 'transportation', 80, '2022-10-17 12:34:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginform`
--
ALTER TABLE `loginform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_action`
--
ALTER TABLE `user_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loginform`
--
ALTER TABLE `loginform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_action`
--
ALTER TABLE `user_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
