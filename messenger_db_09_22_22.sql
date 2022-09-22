-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2022 at 11:32 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messenger_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `author`, `recipient`, `body`, `created`, `modified`) VALUES
(19, 1, 2, 'Hi Shania', '2022-09-22 17:28:39', '2022-09-22 17:28:39'),
(20, 2, 1, 'Hi Kevin', '2022-09-22 17:29:22', '2022-09-22 17:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(50) NOT NULL,
  `modified_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `email`, `phone`, `password`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(1, 'colby.jpeg', 'Kevin Dale Tabayocyoc', 'fdc.ktabayocyoc@gmail.com', '09363088069', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', '2022-09-22 04:43:40', '2022-09-22 08:11:57', '::1', '::1'),
(2, 'b76718eaeabb82478ffe5e2eb4305d0ea-e533472668sd-w260_h260_q50.jpeg', 'Shania Baay', 'fdc.sbaay@gmail.com', '555-5555', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', '2022-09-22 04:48:58', '2022-09-22 08:15:19', '::1', '::1'),
(3, 'user_none.png', 'Michelle Dickerson', 'michelle@hurdman.net', '555-5555', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', '2022-09-22 09:30:52', '2022-09-22 09:30:52', '::1', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
