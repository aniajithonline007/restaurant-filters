-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2022 at 03:50 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `res`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `area` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`) VALUES
(1, 'thiruvarur'),
(2, 'thanjavur');

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

DROP TABLE IF EXISTS `catagory`;
CREATE TABLE IF NOT EXISTS `catagory` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `catagory` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `catagory`) VALUES
(1, 'indian'),
(2, 'chinese'),
(3, 'spanish'),
(4, 'italian');

-- --------------------------------------------------------

--
-- Table structure for table `reslist`
--

DROP TABLE IF EXISTS `reslist`;
CREATE TABLE IF NOT EXISTS `reslist` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `ratings` int(5) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `area_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reslist`
--

INSERT INTO `reslist` (`id`, `name`, `ratings`, `cat_id`, `area_id`) VALUES
(1, 'bagavathy', 4, 2, 1),
(2, 'suvai', 5, 3, 1),
(3, 'allail', 4, 4, 2),
(4, 'metro', 5, 3, 2),
(5, 'aadhi', 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tags` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tags`) VALUES
(1, 'spicy'),
(2, 'non-veg'),
(3, 'veg'),
(4, 'indian'),
(5, 'halal'),
(6, 'biriyani');

-- --------------------------------------------------------

--
-- Table structure for table `tag_res`
--

DROP TABLE IF EXISTS `tag_res`;
CREATE TABLE IF NOT EXISTS `tag_res` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag_res`
--

INSERT INTO `tag_res` (`id`, `res_id`, `tag_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 4),
(4, 2, 3),
(5, 3, 3),
(6, 3, 1),
(7, 4, 1),
(8, 4, 4),
(9, 5, 3),
(10, 5, 4),
(11, 5, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
