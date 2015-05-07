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
  `my_id`   int(11) NOT NULL,
  `title`   varchar(50) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `first_name`  varchar(25) NOT NULL,
  `other_names` varchar(25) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `month`  varchar(25) NOT NULL,
  `date_of_birth` varchar(25) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `fellowship` varchar(15) NOT NULL,
  `occupation` varchar(25) NOT NULL,
  `fellowship_center` varchar(25) NOT NULL,
  `date_joined` varchar(25) NOT NULL,
  `baptised` varchar(5) NOT NULL,
  `discipled` varchar(5) NOT NULL,
  `area_of_interest` varchar(25) NOT NULL,
  `marital_status` varchar(15) NOT NULL,
  `contact_address` text NOT NULL,
  `department` varchar(25) NOT NULL,
  `society` varchar(25) NOT NULL,
  `userfile` varchar(15) NOT NULL,
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

;
