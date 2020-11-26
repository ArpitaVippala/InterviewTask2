-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 09:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interviewtask`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_users_posts`
--

CREATE TABLE `banned_users_posts` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `createdDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banned_users_posts`
--

INSERT INTO `banned_users_posts` (`id`, `userId`, `postId`, `status`, `createdDateTime`) VALUES
(1, 2, 2, '1', '2020-11-26 06:49:58'),
(2, 2, 1, '1', '2020-11-26 06:49:58'),
(3, 3, 3, '1', '2020-11-26 07:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `commentDesc` longtext NOT NULL,
  `userId` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `createdDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `postId`, `commentDesc`, `userId`, `status`, `createdDateTime`) VALUES
(1, 1, 'Hi, I\'m daksha, hw r u arpita?', 4, '0', '2020-11-25 12:59:15'),
(2, 1, 'Hi, I\'m daksha, hw r u arpita?', 4, '1', '2020-11-25 13:03:02'),
(3, 1, 'Hello, I\'m Aswini, How r u?', 3, '0', '2020-11-25 13:30:33'),
(4, 2, 'Hello, I\'m Kishu.. I\'m fine and good.', 2, '1', '2020-11-25 14:44:20'),
(5, 1, 'Hello i\'m aswini', 3, '1', '2020-11-26 08:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empId` int(11) NOT NULL,
  `empName` varchar(30) NOT NULL,
  `empEmail` varchar(50) NOT NULL,
  `empMobile` varchar(15) NOT NULL,
  `empDesg` varchar(20) NOT NULL,
  `empSalary` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `postTitle` varchar(100) NOT NULL,
  `postDesc` longtext NOT NULL,
  `userId` int(11) NOT NULL,
  `comments` enum('0','1') NOT NULL DEFAULT '1',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `createdDatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `postTitle`, `postDesc`, `userId`, `comments`, `status`, `createdDatetime`) VALUES
(1, 'My First Post', 'My post is so nice', 2, '1', '1', '2020-11-25 09:50:16'),
(2, 'My Second Post', 'Second post is unnecessary and will delete them later', 3, '1', '1', '2020-11-25 14:43:30'),
(3, 'My 3rd post on 26-11', 'Nice', 3, '1', '1', '2020-11-26 07:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `emailId` varchar(50) NOT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `restrict_comments` enum('0','1') NOT NULL DEFAULT '0',
  `restrict_post_del` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `emailId`, `pwd`, `mobile`, `role`, `restrict_comments`, `restrict_post_del`, `created_at`) VALUES
(1, 'Arpita', 'varpi.537@gmail.com', '123456789', '8121712027', 'admin', '1', '1', '2020-11-25 06:06:35'),
(2, 'Kishu', 'kishu@gmail.com', '123456789', '9885364334', 'user', '1', '1', '2020-11-25 06:07:06'),
(3, 'Aswini', 'aswin@gmail.com', '896532147', '9235728572', 'user', '0', '1', '2020-11-25 07:49:40'),
(4, 'Daska', 'daksha@gmail.com', '123456789', '1234895632', 'user', '1', '1', '2020-11-25 07:50:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_users_posts`
--
ALTER TABLE `banned_users_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned_users_posts`
--
ALTER TABLE `banned_users_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `empId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
