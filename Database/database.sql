-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2018 at 12:28 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `article`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `category_id` int(3) DEFAULT NULL,
  `title` text,
  `description` text,
  `create_time` datetime NOT NULL,
  `edit_time` datetime DEFAULT NULL,
  `published_time` datetime DEFAULT NULL,
  `count_read` int(8) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `user_id`, `category_id`, `title`, `description`, `create_time`, `edit_time`, `published_time`, `count_read`, `status`) VALUES
(1, 1, 1, '<span style="color: rgb(29, 33, 41); font-family: ''SF Optimized'', system-ui, -apple-system, BlinkMacSystemFont, ''.SFNSText-Regular'', sans-serif; font-size: 14px; font-weight: normal; letter-spacing: -0.11999999731779099px;">บางทีการคิดบวกมากไป กลายเป็นรู้ไม่เท่าทัน และโง่ในทันที ขึ้นอยู่กับชุดประสบการณ์ล้วนๆ</span><br>', 'ซึ่งผมไม่โกรธอะไรเลยนะ จะมีก็แค่ความรู้สึกกึ่งภูมิใจว่าแบบเรามาถูกทางแล้ว ถึงขนาดที่ Product ใหม่ตัวนี้เลือกจะเอา UX แบบของเราไปทำมากกว่าที่จะก็อปปี้ Asana, Trello, Basecamp หรืออะไรก็ตามที', '2018-01-18 15:03:26', '2018-01-24 19:22:53', NULL, 0, 'draft'),
(2, 1, 1, NULL, NULL, '2018-01-18 15:04:04', NULL, NULL, 0, 'draft'),
(3, 1, 1, NULL, NULL, '2018-01-18 15:04:07', NULL, NULL, 0, 'draft'),
(4, 1, 1, NULL, NULL, '2018-01-18 15:04:15', NULL, NULL, 0, 'draft'),
(5, 1, NULL, NULL, NULL, '2018-01-24 19:03:18', NULL, NULL, 0, 'draft'),
(6, 1, NULL, NULL, NULL, '2018-01-24 19:13:45', NULL, NULL, 0, 'draft'),
(7, 1, NULL, NULL, NULL, '2018-01-24 19:16:35', NULL, NULL, 0, 'draft'),
(8, 1, NULL, NULL, NULL, '2018-01-24 19:16:46', NULL, NULL, 0, 'draft'),
(9, 1, NULL, NULL, NULL, '2018-01-24 19:17:01', NULL, NULL, 0, 'draft'),
(10, 1, NULL, NULL, NULL, '2018-01-24 19:20:53', NULL, NULL, 0, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `icon` varchar(20) DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` mediumint(9) NOT NULL,
  `user_id` int(8) NOT NULL,
  `article_id` int(8) NOT NULL,
  `topic` text,
  `body` text,
  `img_location` text,
  `img_alt` text,
  `position` float unsigned DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `user_id`, `article_id`, `topic`, `body`, `img_location`, `img_alt`, `position`, `create_time`, `type`, `status`) VALUES
(12, 1, 1, 'บางทีการคิดบวกมากไป กลายเป็นรู้ไม่เท่าทัน และโง่ในทันที ขึ้นอยู่กับชุดประสบการณ์ล้วนๆ', 'Login once and you get the access to millions of hotspots worldwide.\nGet IUNGO tokens to become a part of the global Wifi reinvention!\nContribute to IUNGO project NOW and get 15% bonus!', NULL, NULL, 5, '2018-01-20 12:09:45', 'textbox', 'active'),
(13, 1, 1, NULL, 'ซึ่งผมไม่โกรธอะไรเลยนะ จะมีก็แค่ความรู้สึกกึ่งภูมิใจว่าแบบเรามาถูกทางแล้ว ถึงขนาดที่ Product ใหม่ตัวนี้เลือกจะเอา UX แบบของเราไปทำมากกว่าที่จะก็อปปี้ Asana, Trello, Basecamp หรืออะไรก็ตามที', NULL, NULL, 6, '2018-01-20 12:10:53', 'textbox', 'active'),
(14, 1, 1, NULL, NULL, NULL, NULL, 9, '2018-01-20 12:10:56', 'image', 'active'),
(17, 1, 1, NULL, NULL, NULL, NULL, 10, '2018-01-20 12:13:42', 'textbox', 'active'),
(18, 1, 1, NULL, 'ช่วงนี้ตารางชีวิตมีอะไรให้ทำแน่นไปหมด วันนี้ยินดีอย่างยิ่งได้คนนำเที่ยว "ภูผาม่าน" มาหนึ่งท่าน เป็นอาจารย์ผมเอง', NULL, NULL, 8, '2018-01-20 12:15:00', 'textbox', 'active'),
(19, 1, 1, NULL, NULL, NULL, NULL, 7, '2018-01-20 12:15:05', 'image', 'active'),
(20, 1, 5, NULL, NULL, NULL, NULL, 1, '2018-01-24 19:03:18', 'textbox', 'active'),
(21, 1, 5, NULL, NULL, NULL, NULL, 2, '2018-01-24 19:03:18', 'image', 'active'),
(22, 1, 6, NULL, NULL, NULL, NULL, 1, '2018-01-24 19:13:45', 'textbox', 'active'),
(23, 1, 6, NULL, NULL, NULL, NULL, 2, '2018-01-24 19:13:45', 'image', 'active'),
(24, 1, 7, NULL, NULL, NULL, NULL, 1, '2018-01-24 19:16:35', 'textbox', 'active'),
(25, 1, 7, NULL, NULL, NULL, NULL, 2, '2018-01-24 19:16:35', 'image', 'active'),
(26, 1, 8, NULL, NULL, NULL, NULL, 1, '2018-01-24 19:16:46', 'textbox', 'active'),
(27, 1, 8, NULL, NULL, NULL, NULL, 2, '2018-01-24 19:16:46', 'image', 'active'),
(28, 1, 9, NULL, NULL, NULL, NULL, 1, '2018-01-24 19:17:01', 'textbox', 'active'),
(29, 1, 9, NULL, NULL, NULL, NULL, 2, '2018-01-24 19:17:01', 'image', 'active'),
(30, 1, 10, NULL, NULL, NULL, NULL, 1, '2018-01-24 19:20:53', 'textbox', 'active'),
(31, 1, 10, NULL, NULL, NULL, NULL, 2, '2018-01-24 19:20:53', 'image', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` text NOT NULL,
  `lname` text,
  `password` text NOT NULL,
  `salt` text,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `register_time` datetime NOT NULL,
  `visit_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
