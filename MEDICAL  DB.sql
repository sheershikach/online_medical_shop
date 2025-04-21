-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2024 at 06:13 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop_db`
--
CREATE DATABASE `shop_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shop_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `available_quantity` int(255) NOT NULL,
  `customer_quantity` int(255) NOT NULL,
  `mfg_date` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id_4` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90097 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `available_quantity`, `customer_quantity`, `mfg_date`, `exp_date`, `company_name`) VALUES
(1, 'amruthanjana', '35', 'amruthanjan.jpg', 5, 0, '2024-04-08', '2024-04-08', 'vova'),
(2, 'thyronormal tablets', '12', 'thyronorm.jpg', 2, 0, '2022-02-01', '2024-05-03', 'oppo'),
(3, 'serup', '75', 'serup.jpg', 2, 0, '2021-03-04', '2024-05-02', 'vivo');

-- --------------------------------------------------------

--
-- Table structure for table `cartt`
--

CREATE TABLE IF NOT EXISTS `cartt` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `available_quantity` int(255) NOT NULL,
  `customer_quantity` int(255) NOT NULL,
  `mfg_date` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `cartt`
--

INSERT INTO `cartt` (`id`, `name`, `price`, `image`, `available_quantity`, `customer_quantity`, `mfg_date`, `exp_date`, `company_name`) VALUES
(1, 'amruthanjana', '35', 'amruthanjan.jpg', 80, 0, '2024-04-08', '2024-04-08', 'vova'),
(2, 'thyronormal tablets', '12', 'thyronorm.jpg', 23, 0, '2022-02-01', '2024-05-03', 'oppo'),
(3, 'serup', '75', 'serup.jpg', 68, 0, '2021-03-04', '2024-05-02', 'vivo'),
(4, 'sugar tablets (2mg)', '40', 'sugar tablets.jpg', 400, 0, '2024-04-16', '2024-05-11', 'redmi'),
(90, 'zandu ', '78', 'bp tablets.jpg', 10, 0, '2024-04-04', '2024-05-04', 'vovo'),
(101, 'zandu bam', '70', 'zandubalm.jpg', 40, 0, '2024-04-03', '2024-05-10', 'vov');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `available_quantity` int(255) NOT NULL,
  `mfg_date` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123457 ;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `price`, `image`, `available_quantity`, `mfg_date`, `exp_date`, `company_name`) VALUES
(1, 'amruthanjana', '35', 'amruthanjan.jpg', 80, '2024-04-08', '2024-04-08', 'vova'),
(2, 'thyronormal tablets', '12', 'thyronorm.jpg', 13, '2022-02-01', '2024-05-03', 'oppo'),
(3, 'serup', '75', 'serup.jpg', 55, '2021-03-04', '2024-05-02', 'vivo'),
(4, 'sugar tablets (2mg)', '40', 'sugar tablets.jpg', 399, '2024-04-16', '2024-05-11', 'redmi'),
(5, 'bp tablets(5mg)', '20', 'bp tablets.jpg', 0, '2023-01-11', '2024-05-11', 'MINE'),
(6, 'zandu balm', '12', 'zandubalm.jpg', 0, '2022-01-31', '2024-05-10', 'SANDA'),
(90, 'zandu ', '78', 'bp tablets.jpg', 0, '2024-04-04', '2024-05-04', 'vovo'),
(101, 'zandu bam', '70', 'zandubalm.jpg', 40, '2024-04-03', '2024-05-10', 'vov');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pin_code` int(10) NOT NULL,
  `dob` varchar(23) NOT NULL,
  `alnumber` varchar(10) NOT NULL,
  `total_medicines` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'New Order',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=221 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin_code`, `dob`, `alnumber`, `total_medicines`, `total_price`, `Status`) VALUES
(214, 'prerana sudeep m', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577005, '2024-04-09', '', 'amruthanjana (1) , thyronormal tablets (5) , serup (1) , zandu  (50) ', '4125', 'Delivered'),
(215, 'prerana sudeep m', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577005, '2024-04-09', '', 'amruthanjana (5) , zandu  (5) ', '840', 'New Order'),
(216, 'M prerana', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577004, '2024-04-09', '', 'serup (8) ', '600', 'New Order'),
(217, 'M prerana', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577004, '2024-04-09', '', 'zandu bam (1) ', '70', 'Delivered'),
(218, 'M prerana sudeeo', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577004, '2024-04-09', '', 'zandu bam (9) ', '630', 'Delivered'),
(219, 'M prerana sudeeo', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577004, '2024-04-09', '9008839315', 'amruthanjana (5) , thyronormal tablets (5) , serup (5) , sugar tablets (2mg) (1) ', '925', 'New Order'),
(220, 'Pratisha', '8050129315', 'sheershikach7022@gmail.com', 'cash on delivery', 'Industrial area, Lokikere Road, Shiramagondanahalli, Davangere-577005.', 'ghtrh', 'Davangere', 'karnataka', 'India', 577004, '2024-04-09', '9008839315', 'zandu  (5) ', '390', 'New Order');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`name`, `email`, `number`, `message`) VALUES
('siri', 'sheershikach7022@gmail.com', '9008839315', 'hello ,This is sudeep i have fewer since 2days please suggest me any medicines'),
('sudeep', 'sudeepsarthak21@gmail.com', '9008839315', 'hh vbvbv hghgc'),
('prerana m ', 'sudeepsarthak@gmail.com', '9008839315', 'this sudeep');
