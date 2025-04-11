-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2025 at 08:03 AM
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
-- Database: `Accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `firstName`, `lastName`, `username`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(13, 'aegr', 'aegae', 'weafeg', 'FD@gmail.com', 'ddddddddd', '2025-04-09 23:19:42', '2025-04-10 00:56:36', 'admin'),
(14, 'dfs', 'affaefw', 'Lewis', 'testing@gmfwail.com', 'ddddddddd', '2025-04-09 23:22:05', '2025-04-09 22:22:05', 'user'),
(15, 'Alex', 'fsg', 'ddd', 'lernk@gmail.com', 'ddddddddd', '2025-04-09 23:26:43', '2025-04-09 22:26:43', 'user'),
(16, 'curtis', 'sanders', 'zdfhfj', 'sgadh@gmail.com', 'ddddddddd', '2025-04-09 23:36:25', '2025-04-09 22:36:25', 'user'),
(17, 'dg', 'sanders', 'ergah', 'sgddddadh@gmail.com', 'ddddddddd', '2025-04-09 23:40:17', '2025-04-09 22:40:17', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `title`, `content`, `created_at`, `updated_at`, `author_id`) VALUES
(3, 'df', 'helllooo', '2025-04-10 01:41:28', '2025-04-10 01:41:28', 13),
(6, 'srght', 'shtjryd', '2025-04-10 03:33:01', '2025-04-10 03:33:01', 13),
(7, 'awgs', 'agd', '2025-04-10 03:44:53', '2025-04-10 03:44:53', 16);

-- --------------------------------------------------------

--
-- Table structure for table `EnquiryForm`
--

CREATE TABLE `EnquiryForm` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `colours` varchar(100) NOT NULL,
  `design` text NOT NULL,
  `submissionDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `EnquiryForm`
--

INSERT INTO `EnquiryForm` (`id`, `firstName`, `lastName`, `email`, `contactNo`, `colours`, `design`, `submissionDate`) VALUES
(1, 'Curtis', 'Bennett', 'curtisnbennett@gmail.com', '07398338982', 'orange', 'sdgfshgjsfdgafhsgjd', '2025-04-09 23:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `review`, `created_at`) VALUES
(1, 'Curtis', 'I think it\'s great', '2025-04-09 23:36:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `EnquiryForm`
--
ALTER TABLE `EnquiryForm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `EnquiryForm`
--
ALTER TABLE `EnquiryForm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `accounts` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
