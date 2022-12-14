-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2022 at 05:24 PM
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
(22, 1, 2, 'Hi Shania', '2022-09-22 22:50:00', '2022-09-22 22:50:00'),
(23, 1, 3, 'Test', '2022-09-22 22:56:52', '2022-09-22 22:56:52'),
(24, 2, 1, 'Open this', '2022-09-22 23:18:33', '2022-09-22 23:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `message_id`, `user_id`, `comment`, `created`, `modified`) VALUES
(23, 22, 2, 'Hi Kevin', '2022-09-22 23:15:57', '2022-09-22 23:15:57'),
(24, 22, 1, 'Hi Shania', '2022-09-22 23:16:21', '2022-09-22 23:16:21'),
(25, 22, 2, 'How was your week?', '2022-09-22 23:17:41', '2022-09-22 23:17:41'),
(26, 24, 1, 'What about it?', '2022-09-22 23:18:47', '2022-09-22 23:18:47'),
(27, 24, 2, 'Open it idiot', '2022-09-22 23:19:00', '2022-09-22 23:19:00'),
(28, 24, 1, 'Cash me outside how bout that?', '2022-09-22 23:19:11', '2022-09-22 23:19:11'),
(29, 24, 2, 'What are you talking about?', '2022-09-22 23:20:10', '2022-09-22 23:20:10'),
(30, 24, 2, 'Open it now', '2022-09-22 23:21:45', '2022-09-22 23:21:45');

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
(1, '306322263_10222502687700883_8722099290144767695_n.jpg', 'Kevin Dale Tabayocyoc', 'fdc.ktabayocyoc@gmail.com', '09363088069', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', '2022-09-22 04:43:40', '2022-09-22 23:15:13', '::1', '::1'),
(2, 'download.jpeg', 'Shania Baay', 'fdc.sbaay@gmail.com', '555-5555', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', '2022-09-22 04:48:58', '2022-09-22 23:15:46', '::1', '::1'),
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
-- Indexes for table `replies`
--
ALTER TABLE `replies`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
