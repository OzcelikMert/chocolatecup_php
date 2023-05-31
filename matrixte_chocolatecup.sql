-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2020 at 06:53 PM
-- Server version: 10.3.24-MariaDB-cll-lve
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matrixte_chocolatecup`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `row` int(11) NOT NULL,
  `id` varchar(6) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `person_name` varchar(30) NOT NULL,
  `permission` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `is_active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`row`, `id`, `user_name`, `password`, `person_name`, `permission`, `date`, `is_active`) VALUES
(7, '48edd6', 'mertoz', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Mert ÖZÇELİK', 2, '2020-03-05 18:50:23', '1'),
(8, '41df6e', 'buraksunel', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Burak SUNEL', 2, '2020-03-05 18:50:24', '1'),
(9, '85g69e', 'cihanozen', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Cihan ÖZEN', 2, '2020-03-05 18:50:25', '1'),
(10, '7d5e6g', 'mucahitci', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Mücahit ÇİMİÇ', 3, '2020-03-05 18:50:26', '1'),
(11, '2f5d7e', 'genccicek', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Genç Halil ÇİÇEK', 3, '2020-03-05 18:50:27', '0'),
(12, '123456', 'admin', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Admin Bey', 1, '2020-03-05 18:50:20', '1'),
(13, '98cc5f', 'akifbas', '5a2e54ee57e5b7273b9a8fed78c1ebd8', 'Akif BAŞORMANCI', 3, '2020-03-05 18:50:19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `row` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `seo_name` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`row`, `name`, `seo_name`, `rank`) VALUES
(1, 'Yetkili', 'admin', 1),
(2, 'Jüri', 'jury', 2),
(3, 'Yarışmacı', 'contestant', 3);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `row` int(11) NOT NULL,
  `point_giver` varchar(6) NOT NULL,
  `point_receiver` varchar(6) NOT NULL,
  `point` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `date` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`row`, `point_giver`, `point_receiver`, `point`, `question`, `date`) VALUES
(172, '85g69e', '7d5e6g', 5, 1, '2020-03'),
(173, '85g69e', '7d5e6g', 3, 2, '2020-03'),
(174, '85g69e', '7d5e6g', 2, 3, '2020-03'),
(175, '85g69e', '7d5e6g', 7, 4, '2020-03'),
(176, '85g69e', '7d5e6g', 5, 5, '2020-03'),
(177, '85g69e', '7d5e6g', 6, 6, '2020-03'),
(178, '85g69e', '7d5e6g', 3, 7, '2020-03'),
(179, '85g69e', '7d5e6g', 5, 8, '2020-03'),
(180, '85g69e', '2f5d7e', 6, 1, '2020-03'),
(181, '85g69e', '2f5d7e', 1, 2, '2020-03'),
(182, '85g69e', '2f5d7e', 1, 3, '2020-03'),
(183, '85g69e', '2f5d7e', 4, 4, '2020-03'),
(184, '85g69e', '2f5d7e', 3, 5, '2020-03'),
(185, '85g69e', '2f5d7e', 3, 6, '2020-03'),
(186, '85g69e', '2f5d7e', 3, 7, '2020-03'),
(187, '85g69e', '2f5d7e', 1, 8, '2020-03'),
(188, '48edd6', '7d5e6g', 10, 1, '2020-03'),
(189, '48edd6', '7d5e6g', 4, 2, '2020-03'),
(190, '48edd6', '7d5e6g', 10, 3, '2020-03'),
(191, '48edd6', '7d5e6g', 3, 4, '2020-03'),
(192, '48edd6', '7d5e6g', 9, 5, '2020-03'),
(193, '48edd6', '7d5e6g', 8, 6, '2020-03'),
(194, '48edd6', '7d5e6g', 20, 7, '2020-03'),
(195, '48edd6', '7d5e6g', 3, 8, '2020-03'),
(196, '48edd6', '2f5d7e', 2, 1, '2020-03'),
(197, '48edd6', '2f5d7e', 1, 2, '2020-03'),
(198, '48edd6', '2f5d7e', 1, 3, '2020-03'),
(199, '48edd6', '2f5d7e', 1, 4, '2020-03'),
(200, '48edd6', '2f5d7e', 3, 5, '2020-03'),
(201, '48edd6', '2f5d7e', 1, 6, '2020-03'),
(202, '48edd6', '2f5d7e', 15, 7, '2020-03'),
(203, '48edd6', '2f5d7e', 20, 8, '2020-03'),
(204, '41df6e', '7d5e6g', 10, 1, '2020-03'),
(205, '41df6e', '7d5e6g', 6, 2, '2020-03'),
(206, '41df6e', '7d5e6g', 4, 3, '2020-03'),
(207, '41df6e', '7d5e6g', 11, 4, '2020-03'),
(208, '41df6e', '7d5e6g', 19, 5, '2020-03'),
(209, '41df6e', '7d5e6g', 15, 6, '2020-03'),
(210, '41df6e', '7d5e6g', 15, 7, '2020-03'),
(211, '41df6e', '7d5e6g', 20, 8, '2020-03'),
(212, '41df6e', '2f5d7e', 1, 1, '2020-03'),
(213, '41df6e', '2f5d7e', 10, 2, '2020-03'),
(214, '41df6e', '2f5d7e', 10, 3, '2020-03'),
(215, '41df6e', '2f5d7e', 11, 4, '2020-03'),
(216, '41df6e', '2f5d7e', 1, 5, '2020-03'),
(217, '41df6e', '2f5d7e', 15, 6, '2020-03'),
(218, '41df6e', '2f5d7e', 12, 7, '2020-03'),
(219, '41df6e', '2f5d7e', 20, 8, '2020-03'),
(220, '41df6e', '98cc5f', 10, 1, '2020-03'),
(221, '41df6e', '98cc5f', 15, 6, '2020-03'),
(222, '41df6e', '98cc5f', 5, 8, '2020-03'),
(223, '41df6e', '98cc5f', 6, 2, '2020-03'),
(224, '41df6e', '98cc5f', 4, 3, '2020-03'),
(225, '41df6e', '98cc5f', 11, 4, '2020-03'),
(226, '41df6e', '98cc5f', 19, 5, '2020-03'),
(227, '41df6e', '98cc5f', 15, 7, '2020-03'),
(228, '48edd6', '98cc5f', 10, 1, '2020-03'),
(229, '48edd6', '98cc5f', 4, 2, '2020-03'),
(230, '48edd6', '98cc5f', 4, 3, '2020-03'),
(231, '48edd6', '98cc5f', 6, 4, '2020-03'),
(232, '48edd6', '98cc5f', 4, 5, '2020-03'),
(233, '48edd6', '98cc5f', 9, 6, '2020-03'),
(234, '48edd6', '98cc5f', 7, 7, '2020-03'),
(235, '48edd6', '98cc5f', 12, 8, '2020-03'),
(236, '85g69e', '98cc5f', 10, 1, '2020-03'),
(237, '85g69e', '98cc5f', 6, 2, '2020-03'),
(238, '85g69e', '98cc5f', 4, 3, '2020-03'),
(239, '85g69e', '98cc5f', 5, 4, '2020-03'),
(240, '85g69e', '98cc5f', 6, 5, '2020-03'),
(241, '85g69e', '98cc5f', 6, 6, '2020-03'),
(242, '85g69e', '98cc5f', 6, 7, '2020-03'),
(243, '85g69e', '98cc5f', 20, 8, '2020-03');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `row` int(11) NOT NULL,
  `question` text NOT NULL,
  `max_point` int(11) NOT NULL,
  `is_active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`row`, `question`, `max_point`, `is_active`) VALUES
(1, 'Temizlik', 10, '1'),
(2, 'Tat', 6, '1'),
(3, 'Koku', 4, '1'),
(4, 'Sıcaklık', 11, '1'),
(5, 'Kıvam', 19, '1'),
(6, 'Şekil', 15, '1'),
(7, 'Renk', 15, '1'),
(8, 'Genel', 20, '1');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `row` int(11) NOT NULL,
  `interval` int(11) NOT NULL,
  `sort` varchar(10) NOT NULL,
  `is_active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`row`, `interval`, `sort`, `is_active`) VALUES
(1, 25, 'point', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`row`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`row`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
