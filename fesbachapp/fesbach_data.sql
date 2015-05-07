-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2012 at 01:06 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.5-1ubuntu7.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ogo`
--

-- --------------------------------------------------------

--
-- Table structure for table `churches`
--

CREATE TABLE IF NOT EXISTS `churches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `other_names` varchar(25) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `fellowship` varchar(15) NOT NULL,
  `occupation` varchar(25) NOT NULL,
  `marital_status` varchar(15) NOT NULL,
  `contact_address` text NOT NULL,
  `department` varchar(25) NOT NULL,
  `society` varchar(25) NOT NULL,
  `userfile` datetime NOT NULL,
  `email` varchar(25) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `conf_password` varchar(15) NOT NULL,
  `verification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `churches`
--

INSERT INTO `churches` (`id`, `my_id`, `title`, `surname`, `first_name`, `other_names`, `date_of_birth`, `phone_number`, `state`, `fellowship`, `occupation`, `marital_status`, `contact_address`, `department`, `society`, `userfile`, `email`, `username`, `password`, `conf_password`, `verification`) VALUES
(8, 1, 'doctor', 'Sammyyy', 'Klmlm', 'Lmlm', '', '08099321349', 'Delta', 'Whitesands', 'Knln', 'single', '11, jihn street lagos', 'welfare', 'busybees', '2012-11-08 08:58:52', 'okehisamuel@yahoo.com', 'samuel', 'samuel', 'samuel', ''),
(9, 0, '', 'Elumeze', 'Ogochukwu', 'bernard', '', '08033098213', 'delta', 'the brigs', 'Lawyer', '0', '11, george street, lagos.', '3', '2', '0000-00-00 00:00:00', 'o.elumeze@yahoo.com', 'oelumeze', 'admin', 'admin', ''),
(10, 0, '1', 'Benny', '', '', '', '', '', '', '', '0', '', '1', '1', '0000-00-00 00:00:00', '', 'benona', 'admin', 'admin', ''),
(11, 0, '3', 'Elumeze', 'ogo', '', '', '08139538238', 'delta', 'gift', 'doctor', '1', '11, adeyinka str, lagos.', '2', '2', '0000-00-00 00:00:00', 'user@mail.com', 'username', 'password', 'password', ''),
(12, 0, '1', 'james', 'jihn', '', '', '', '', '', '', '0', '', '0', '0', '0000-00-00 00:00:00', '', 'james', 'password', 'password', ''),
(13, 0, 'chief', 'Anita', 'Baruwa', 'Simmi', '2011-11-11', '08033298761', 'Abia', 'Crest', 'Law', '1', '22, akin street, lagos.', 'choir', 'lovers of christ', '0000-00-00 00:00:00', 'anita@mail.com', 'abaruwa', 'password', 'password', 'IbdU2QETVS');
