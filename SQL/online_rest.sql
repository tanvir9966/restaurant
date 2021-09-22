-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 12:36 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_rest`
--
CREATE DATABASE IF NOT EXISTS `online_rest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `online_rest`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adm_id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', '', '2018-04-09 07:36:18'),
(9, 'biplob', 'e10adc3949ba59abbe56e057f20f883e', 'tanvir@mail.com', 'QFE6ZM', '2021-09-22 10:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE IF NOT EXISTS `admin_codes` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `codes` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codes` (`codes`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(2, 'QFE6ZM'),
(6, 'QMTZ2J'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(1, 'QX5ZMN');

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

CREATE TABLE IF NOT EXISTS `chef` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chef`
--

INSERT INTO `chef` (`id`, `name`, `address`, `phone`) VALUES
(4, 'habib9', 'dhaka', 2147483647),
(9, 'habib', 'poi', 456987123);

-- --------------------------------------------------------

--
-- Table structure for table `del-boy`
--

CREATE TABLE IF NOT EXISTS `del-boy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `del-boy`
--

INSERT INTO `del-boy` (`id`, `username`, `name`, `phone`, `pass`, `address`, `email`) VALUES
(8, 'dip', 'Miadul Dip', 1834263335, '123456', 'dhaka\r\ndhanmondi', 'bhy49796@cjpeg.com'),
(9, 'habib', 'Habib', 1869589654, '123456', 'dhaka', 'habib@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
  `d_id` int(222) NOT NULL AUTO_INCREMENT,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(11, 57, 'Bonefish', 'Three ounces of lightly seasoned fresh tilapia ', '400.00', '5f170038bf273.jpg'),
(12, 58, 'Hard Rock Cafe', 'A mix of chopped lettuces, shredded cheese, chicken cubes', '500.00', '5f16f72f7ccf9.jpg'),
(13, 59, 'Uno Pizzeria & Grill', 'Kids can choose their pasta shape, type of sauce, favorite veggies (like broccoli or mushrooms)', '400.00', '5f17001188072.jpg'),
(14, 50, 'Red Robins Chick on a Stick', 'Plain grilled chicken breast? Blah.', '34.99', '5ad759e1546fc.jpg'),
(15, 51, 'Lyfe Kitchens Tofu Taco', 'This chain, known for a wide selection of vegetarian and vegan choices', '11.99', '5ad75a1869e93.jpg'),
(16, 52, 'Houlihans Mini Cheeseburger', 'Creekstone Farms, where no antibiotics or growth hormones are used', '22.55', '5ad75a5dbb329.jpg'),
(17, 53, 'jklmno', 'great taste great whatever', '17.99', '5ad79fcf59e66.jpg'),
(18, 57, 'Kacchi', 'So tasty.', '180.00', '5f14952ed1be2.jpg'),
(19, 57, 'Mutton leg roast', 'Popular', '100.00', '5f1542e74c637.jpg'),
(20, 58, 'Chicken Burger', 'Popular', '100.00', '5f15477d3ba35.jpg'),
(21, 58, 'Beef burger', 'tasty.', '150.00', '5f1547ada2ae8.jpg'),
(22, 59, 'Rice bowl', 'nice rice', '450.00', '5f1549b41c659.jpg'),
(23, 59, 'french fry', 'Popular', '150.00', '5f154a837aedf.jpg'),
(24, 60, 'mutton chap', 'Popular', '300.00', '5f154bcd0f1ce.jpg'),
(25, 60, 'tanduri chicken', 'So tasty.', '500.00', '5f154c2f316c1.jpg'),
(26, 61, 'special naan', 'Popular', '50.00', '5f154e3464049.jpg'),
(28, 61, 'khasir kala vuna', 'Popular', '300.00', '5f154ecb21459.jpg'),
(29, 61, 'Lacchi', 'good', '200.00', '5f5f780da13cc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE IF NOT EXISTS `remark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(62, 32, 'in process', 'hi', '2018-04-18 17:35:52'),
(63, 32, 'closed', 'cc', '2018-04-18 17:36:46'),
(64, 32, 'in process', 'fff', '2018-04-18 18:01:37'),
(65, 32, 'closed', 'its delv', '2018-04-18 18:08:55'),
(66, 34, 'in process', 'on a way', '2018-04-18 18:56:32'),
(67, 35, 'closed', 'ok', '2018-04-18 18:59:08'),
(68, 37, 'in process', 'on the way!', '2018-04-18 19:50:06'),
(69, 37, 'rejected', 'if admin cancel for any reason this box is for remark only for buter perposes', '2018-04-18 19:51:19'),
(70, 37, 'closed', 'delivered success', '2018-04-18 19:51:50'),
(71, 39, 'closed', 'test', '2020-06-14 18:37:35'),
(72, 38, 'rejected', 'test', '2020-06-14 18:50:52'),
(73, 0, 'closed', 't', '2020-06-15 21:00:45'),
(74, 38, 'in process', 'test', '2020-06-15 21:02:45'),
(75, 38, 'closed', 't', '2020-06-15 21:03:20'),
(76, 44, 'closed', 'test', '2020-06-27 11:09:14'),
(77, 63, 'closed', 'te', '2020-06-30 18:20:49'),
(78, 60, 'in process', 'in progress', '2020-07-15 15:02:56'),
(79, 60, 'closed', 'done', '2020-07-15 15:04:18'),
(80, 72, 'in process', 'test', '2020-08-18 15:32:28'),
(81, 68, 'closed', 'delivered.', '2020-09-14 14:03:38'),
(82, 81, 'closed', 'delivered.', '2020-09-14 14:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `rs_id` int(222) NOT NULL AUTO_INCREMENT,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(57, 5, 'Sultans Dine', 'sultan@gmail.com', '01845698745', 'www.facebook.com', '10am', '8pm', 'mon-sat', 'dhaka\r\ndhanmondi', '5f1494459bd3a.jpg', '2020-07-19 18:43:17'),
(58, 8, 'Chillox', 'chillox@gmail.com', '01776707158', 'www.qq.com', '9am', '7pm', 'mon-fri', 'Level 3, AMM Center, Road 3A, Dhanmondi\r\nDhaka, Bangladesh 1209', '5f1544482049d.jpg', '2020-07-20 07:14:16'),
(59, 10, 'Takeout 2.O Cafe & Restaurant', '2.0@gmail.com', '1834263335', 'www.facebook.com', '9am', '6pm', 'mon-fri', 'Ahmed and Kazi Tower, Level 2, House:35 Dhanmondi 2 (Next to Riffles/Shimanto Square)\r\nDhaka, Bangladesh 1209', '5f1548ea0c5d9.png', '2020-07-20 07:34:02'),
(60, 7, 'Nawabi Voj', 'nawabi@gmail.com', '01953557056', 'www.facebook.com', '10am', '6pm', 'mon-sat', '15,New baily Road.Dhaka\r\nDhaka, Bangladesh 1000', '5f154b552ff7b.jpg', '2020-07-20 07:44:21'),
(61, 5, 'Star Kabab', 'kabab@gmail.com', '814-678-6689', 'www.facebook.com', '11am', '8pm', 'mon-sat', '22, House 16, Road No. 2 (Old), Dhanmondi R/A, Dhaka 1209', '5f154d831f491.jpg', '2020-07-20 07:53:39'),
(62, 11, 'Biriany house', 'res@mail.com', '01869589654', 'example.com', '8am', '8pm', 'mon-tue', 'Mohammadpur, dhaka.', '5f5f779c3262e.jpg', '2020-09-14 14:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE IF NOT EXISTS `res_category` (
  `c_id` int(222) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(5, 'grill', '2018-04-14 18:45:28'),
(6, 'pizza', '2018-04-14 18:44:56'),
(7, 'pasta', '2018-04-14 18:45:13'),
(8, 'thaifood', '2018-04-14 18:32:56'),
(9, 'fish', '2018-04-14 18:44:33'),
(10, 'Burger', '2020-07-20 07:23:58'),
(11, 'kacchi', '2020-09-14 13:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(35, 'ariful', 'Ariful', 'Islam', 'ariful@gmail.com', '01845698745', 'e10adc3949ba59abbe56e057f20f883e', 'dhaka\r\ndhanmondi', 1, '2021-09-22 10:21:30'),
(36, 'biplob', 'Sazidul', 'Biplob', 'biplob@mail.com', '01869589654', 'e10adc3949ba59abbe56e057f20f883e', 'dhaka.', 1, '2021-09-22 10:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE IF NOT EXISTS `users_orders` (
  `o_id` int(222) NOT NULL AUTO_INCREMENT,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `date` date NOT NULL,
  `time` int(2) NOT NULL,
  `state` varchar(2) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `address`, `lat`, `lng`, `date`, `time`, `state`) VALUES
(68, 35, 'Hard Rock Cafe', 1, '500.00', 'closed', 'dhaka', NULL, NULL, '2020-08-18', 1, 'pm'),
(72, 35, 'Hard Rock Cafe', 1, '500.00', 'in process', NULL, 23.656158200000004, 90.4972422, '2020-08-19', 10, 'am'),
(81, 35, 'Chicken Burger', 1, '100.00', 'closed', NULL, 23.656158200000004, 90.4972422, '2020-08-22', 8, 'pm'),
(82, 35, 'Uno Pizzeria & Grill', 1, '400.00', NULL, 'west razabazr, dhanmondi, dhaka.', NULL, NULL, '2020-09-15', 1, 'pm'),
(83, 35, 'Chicken Burger', 1, '100.00', NULL, 'west razabazr, dhanmondi, dhaka.', NULL, NULL, '2020-09-15', 1, 'pm'),
(84, 35, 'Bonefish', 1, '400.00', NULL, 'west razabazar, dhanmondi, dhaka.', NULL, NULL, '2020-09-15', 1, 'pm'),
(85, 35, 'Bonefish', 1, '400.00', NULL, NULL, 23.6562739, 90.4974451, '2020-09-16', 10, 'am'),
(86, 35, 'khasir kala vuna', 1, '300.00', NULL, NULL, 23.65639, 90.4974451, '2020-09-19', 10, 'am'),
(87, 35, 'Hard Rock Cafe', 1, '500.00', NULL, 'n ganj.', NULL, NULL, '2021-09-10', 1, 'pm'),
(88, 35, 'Kacchi', 1, '180.00', NULL, NULL, 23.6553812, 90.5003416, '2021-09-11', 3, 'pm');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
