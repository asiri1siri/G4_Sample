-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2018 at 06:58 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `DELETED` int(1) NOT NULL,
  `ID` int(3) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `ITEMTYPE` varchar(255) NOT NULL,
  `COND` varchar(255) NOT NULL,
  `IS_CONTAINER` int(1) NOT NULL,
  `PARENT_ID` int(3) NOT NULL,
  `ENTERED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`DELETED`, `ID`, `NAME`, `DESCRIPTION`, `ITEMTYPE`, `COND`, `IS_CONTAINER`, `PARENT_ID`, `ENTERED`, `UPDATED`) VALUES
(1, 2, 'Pen', 'does not write', 'Stationary', 'Good', 0, 0, '0000-00-00 00:00:00', '2018-10-01 20:05:23'),
(0, 3, 'Table', '4 Legs', 'Furniture', 'New', 1, 0, '0000-00-00 00:00:00', '2018-10-01 20:48:48'),
(0, 4331, 'Chair', 'You sit on it', 'Furniture', 'New', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(0, 6, 'Pen2', 'Write2s', 'Stationary2', 'Bad', 0, 3, '0000-00-00 00:00:00', '2018-10-01 20:42:20'),
(0, 56, 'Laptop', 'Computer', 'Electronics', 'Old', 0, 0, '0000-00-00 00:00:00', '2018-10-01 20:42:29'),
(0, 7979, 'Chicken', 'Yum', 'Food', 'Fresh', 0, 0, '0000-00-00 00:00:00', '2018-10-01 20:10:13'),
(0, 7331, 'Cheese', 'Cheddar', 'Food', 'Fresh', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(0, 69, 'Fish', 'Swim Swim Swim', 'Animal', 'Young', 0, 0, '2018-10-01 20:49:44', '2018-10-01 20:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ENABLED` int(1) NOT NULL,
  `ID` int(3) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `USERTYPE` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ENABLED`, `ID`, `NAME`, `USERNAME`, `USERTYPE`, `EMAIL`) VALUES
(1, 5, 'Spongebob', 'BBaker', 'User', 'BBB@gmail.com'),
(1, 7, 'Rachel', 'RRoberts', 'Admin', 'RRR@yahoo.com'),
(0, 8, 'Sam', 'SSmith', 'User', 'SSS@msn.com'),
(1, 10, 'Asiri', '--Asiri--', 'Admin', 'Asiri@Myself.com'),
(0, 123, 'George', 'GCHan', 'Admin', 'ljakjfafa@gmail.com'),
(1, 112, 'SOmeone', 'qwerty', 'admin', 'admin@gmail.com'),
(3, 8989, 'Kapeesh', 'SomeWhatConfused', 'Idiot', 'LMNOP@gmail.com'),
(1, 456, 'SomeUser', 'USerSome', 'Admin', 'CHeesecake@yahoo.com'),
(1, 12, 'Name', 'Username', 'Usertype', 'Email'),
(1, 55, 'Dude', 'Bro', 'User', 'DudeBro@gmail.com'),
(1, 41, 'Random', 'Rdom', 'Admin', 'gmail@gmail.com'),
(1, 41, 'Random', 'Rdom', 'Admin', 'gmail@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
