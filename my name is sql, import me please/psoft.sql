-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2015 at 03:10 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `psoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `article_rating`
--

CREATE TABLE IF NOT EXISTS `article_rating` (
  `id` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `ratings` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_rating`
--

INSERT INTO `article_rating` (`id`, `article`, `ratings`) VALUES
(3, 8, 3),
(3, 7, 2),
(4, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Cellphones'),
(2, 'House and Lot'),
(3, 'Clothings');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`commentID` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `id`, `post_id`, `comment`, `time_added`) VALUES
(137, 7, 8, 'heyy', '2015-05-17 12:38:48'),
(138, 8, 8, 'hahahhha nice', '2015-05-17 12:39:56'),
(139, 7, 8, 'hahah', '2015-05-17 12:50:06'),
(140, 8, 8, 'hahahh', '2015-05-17 13:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
`notifNo` int(20) NOT NULL,
  `id` int(20) NOT NULL,
  `post_id` int(10) NOT NULL,
  `convo_user` int(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unread',
  `type` varchar(30) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notifNo`, `id`, `post_id`, `convo_user`, `status`, `type`, `time_added`) VALUES
(1, 7, 8, 1, 'unread', 'comment', '2015-05-17 12:38:48'),
(2, 8, 8, 7, 'read', 'comment', '2015-05-17 12:45:50'),
(3, 8, 8, 1, 'unread', 'comment', '2015-05-17 12:39:56'),
(4, 7, 8, 8, 'read', 'comment', '2015-05-17 13:07:47'),
(5, 7, 8, 1, 'unread', 'comment', '2015-05-17 12:50:06'),
(6, 8, 8, 7, 'read', 'comment', '2015-05-17 13:09:05'),
(7, 8, 8, 1, 'unread', 'comment', '2015-05-17 13:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `image_location` text NOT NULL,
  `name` text NOT NULL,
  `category` text NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `image_location`, `name`, `category`, `price`, `description`, `date`, `id`) VALUES
(1, 'uploads/burn.jpg', 'BNY', 'Clothings', 12, 'Test', '2014-02-12 17:09:29', 0),
(2, 'uploads/burn.jpg', 'Valentina Girl', 'House and Lot', 10000, 'Available for Valentine''s!', '2014-02-12 17:09:36', 0),
(3, 'uploads/burn.jpg', 'Chicken for Sale', 'Clothings', 2345, 'Tu.ara gi kawat sa manok!', '2014-02-12 17:09:38', 0),
(4, 'uploads/burn.jpg', 'Be Funky bebe', 'Clothings', 98677, 'Come and get me, baby I''m yours!', '2014-02-12 17:09:41', 0),
(5, 'uploads/burn.jpg', 'Minola', 'House and Lot', 6543, 'Fiesta Oil!', '2014-02-12 17:09:44', 0),
(6, 'uploads/burn.jpg', 'Tu ara', 'Clothings', 23123, 'Gi kawat sa manok!', '2014-02-12 17:09:46', 2),
(7, 'uploads/burn.jpg', 'Picturi ko', 'Clothings', 12312, 'Picturi ko ba, please!', '2014-02-12 17:09:51', 2),
(8, 'uploads/burn.jpg', 'Rosie', 'Clothings', 81231, 'Rosie mo diha!', '2014-02-12 17:09:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(18) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `middle_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `bio` text NOT NULL,
  `image_location` varchar(125) NOT NULL DEFAULT 'avatars/default_avatar.jpg',
  `password` varchar(512) NOT NULL,
  `email` varchar(512) NOT NULL,
  `email_code` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `confirmed` int(11) NOT NULL,
  `generated_string` varchar(35) NOT NULL,
  `ip` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `middle_name`, `last_name`, `gender`, `bio`, `image_location`, `password`, `email`, `email_code`, `time`, `confirmed`, `generated_string`, `ip`) VALUES
(1, 'rosiejaneenomar', 'rosie jane', 'r', 'enomar', '', '', 'avatars/default_avatar.png', '$2y$12$081808076352d3dec6636OpYw8hncsW6GMJ2vIKq0vNPUWPyRxU02', 'jane2_cute_143@yahoo.com', 'code_52d3dec6632c83.02527019', 1389616838, 0, '', '::1'),
(2, 'Adriann', 'Adriann', 'Gimenez', 'Alipar', 'undisclosed', 'The database is given!', 'avatars/BeFunky_1377600_10200852144405453_1099643161_n.jpg_0.jpg', '$2y$12$77771429652f9d44f9de5u3BaJFshvo2wBPcqle0sHGEYE9Gi.YgS', 'dummy.ada@gmail.com', 'code_52f9d44f9de591.71078249', 1392104527, 0, '', '::1'),
(3, 'aidylbaylon', 'Aidyl', 'Cardona', 'Baylon', '', '', 'avatars/default_avatar.jpg', '$2y$12$14774020025559711cb6cOnn3d9IuoDU37fIvCFseqlTc0j0f9TdK', 'aidyl@gmail.com', 'code_5559711cb6c393.29212631', 1431925020, 0, '', '::1'),
(4, 'KentHarvey', 'Kent', 'pinca', 'abrio', '', '', 'avatars/default_avatar.jpg', '$2y$12$04630128155597868e9a8OYderTkTQO9bLsQqLM.IUqqXv4ogTvJq', 'kentabrio@gmail.com', 'code_55597868e9a3a0.95611989', 1431926888, 0, '', '::1'),
(7, 'knightmoverchan', 'ssf', 'hjhg', 'gfhghh', '', '', 'avatars/default_avatar.jpg', '$2y$12$320826320555884bfadc7uKcUQXEB1CMMMYr8bewFsTGagE.tHnv.', 'knightmoverchan@gmail.com', 'code_555884bfadc597.93467153', 1431864511, 0, '', '::1'),
(8, 'sample', 'adfas', 'hhj', 'gfhhj', '', '', 'avatars/default_avatar.jpg', '$2y$12$46813853555588c03af58OgxvJtp.hV5q74xAfXwVU2puvnWNyqJu', 'sample@gmail.com', 'code_55588c03af5712.43500207', 1431866371, 0, '', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`notifNo`), ADD KEY `id` (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `date` (`date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `commentID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `notifNo` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--

--
-- Constraints for table `notification`
--

