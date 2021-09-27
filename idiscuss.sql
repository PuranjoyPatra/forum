-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 06:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10
-- all the tables of 'idiscuss' database for forum website  related queries are here. idiscuss forum developed by Puranjoy Patra

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idiscuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`, `created`) VALUES
(1, 'Python', 'Python is a object oriented language', '2021-09-27 16:59:19'),
(2, 'Java', 'it is an amazing language', '2021-09-27 17:00:02'),
(3, 'JavaScript', 'it is great for web devlopment', '2021-09-27 17:00:49'),
(4, 'C++', 'cool language', '2021-09-27 17:01:11'),
(5, 'C', 'Cis procedural programming language', '2021-09-27 20:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `comment_by_user` int(10) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by_user`, `comment_time`) VALUES
(1, 'go to oracle official website and download latest  jdk version and install it. after that set path and start to run java programming.', 2, 2, '2021-09-27 20:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_title` text NOT NULL,
  `thread_desc` varchar(255) NOT NULL,
  `thread_cat_id` int(10) NOT NULL,
  `thread_user` int(10) NOT NULL,
  `thread_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user`, `thread_created`) VALUES
(1, 'how to install python', 'python installation error in windows', 1, 2, '2021-09-27 18:38:08'),
(2, 'how to install java in windows 10', 'i want to execute java program in my machine. ', 2, 1, '2021-09-27 20:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `create_date`) VALUES
(1, 'puran@123', '$2y$10$KnyYvMoLrW/0iZ1waOmOhOh/5pR8wJjH/Ou6Q1.Fc/vv1.eZrGxlm', '2021-09-27 20:03:35'),
(2, 'ram@123', '$2y$10$.D8SdQlZ4qZf.hdD/tfUSebRyouyHwV32mKWUznuwUdm6gHYnrt0O', '2021-09-27 20:20:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
