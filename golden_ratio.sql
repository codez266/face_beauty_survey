-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2014 at 08:24 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `golden_ratio`
--

-- --------------------------------------------------------

--
-- Table structure for table `face`
--

CREATE TABLE IF NOT EXISTS `face` (
  `face_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`face_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `face`
--

INSERT INTO `face` (`face_id`, `name`, `url`) VALUES
(1, 'anne_hathaway', 'images/anneh.jpg'),
(2, 'emma lawrence', 'images/emma_lawrence.jpg'),
(3, 'Diana Argon', 'images/dianna_agron.jpg'),
(4, 'Nina Dobreva', 'images/nina_dobreva.jpg'),
(5, 'Megan Fox', 'images/megan_fox.jpg'),
(6, 'Emma Watson', 'images/emma_watson.jpg'),
(7, 'Scarlett Johanson', 'images/scarlett_johansson.jpg'),
(8, 'Victoria Justice', 'images/victoria_justice1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faceratio`
--

CREATE TABLE IF NOT EXISTS `faceratio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `face_id` tinyint(4) NOT NULL,
  `ratio_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ratio`
--

CREATE TABLE IF NOT EXISTS `ratio` (
  `ratio_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`ratio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `f1` tinyint(4) NOT NULL,
  `f2` tinyint(4) NOT NULL,
  `f3` tinyint(4) NOT NULL,
  `f4` tinyint(4) NOT NULL,
  `f5` tinyint(4) NOT NULL,
  `f6` tinyint(4) NOT NULL,
  `f7` tinyint(4) NOT NULL,
  `f8` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f1`, `f2`, `f3`, `f4`, `f5`, `f6`, `f7`, `f8`) VALUES
(1, 3, 4, 3, 3, 3, 3, 3, 3),
(2, 3, 4, 3, 3, 3, 3, 3, 3),
(3, 3, 4, 3, 3, 3, 3, 3, 3),
(4, 3, 4, 3, 3, 3, 3, 3, 3),
(5, 3, 4, 3, 3, 3, 3, 3, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
