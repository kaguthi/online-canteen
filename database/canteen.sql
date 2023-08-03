-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 10:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(3, 'breakfast', 'cup.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_image` varchar(100) NOT NULL,
  `food_price` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_image`, `food_price`, `category`, `description`) VALUES
(2, 'tea', 'tea.jpeg', 20, 'breakfast', 'made from 100% cow milk and tea leaves from the steeps slope of mt.kenya '),
(3, 'coffee', 'coffee.jpeg', 20, 'breakfast', 'made from 100% pure arabic coffee'),
(4, 'apple', 'apple.jpg', 30, 'breakfast', 'apple fruit');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `payment_mode` varchar(100) NOT NULL DEFAULT 'mpesa',
  `total_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `payment_mode`, `total_price`, `user_id`, `Created_At`) VALUES
(1, '68498', 'mpesa', 0, 1, '2023-03-28 17:38:59'),
(2, '88190', 'mpesa', 0, 1, '2023-03-28 17:38:59'),
(3, '34531', 'mpesa', 0, 1, '2023-03-28 17:38:59'),
(4, '29854', 'mpesa', 0, 1, '2023-03-28 17:58:45'),
(5, '3945', 'mpesa', 80, 1, '2023-03-28 18:56:58'),
(6, '44752', 'mpesa', 80, 1, '2023-03-28 18:57:33'),
(7, '27586', 'mpesa', 80, 1, '2023-03-28 19:13:39'),
(8, '97007', 'mpesa', 80, 1, '2023-03-28 19:14:03'),
(9, '62033', 'mpesa', 50, 2, '2023-03-30 06:33:00'),
(10, '44561', 'mpesa', 20, 3, '2023-04-11 12:02:43'),
(11, '56666', 'mpesa', 35, 3, '2023-04-11 15:06:43'),
(12, '95245', 'mpesa', 30, 3, '2023-04-11 15:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`id`, `order_id`, `prod_id`, `qty`, `price`, `userid`) VALUES
(1, 6, 2, 1, 20, 1),
(2, 6, 3, 3, 20, 1),
(3, 7, 2, 1, 20, 1),
(4, 7, 3, 3, 20, 1),
(5, 8, 2, 1, 20, 1),
(6, 8, 3, 3, 20, 1),
(7, 9, 3, 1, 20, 2),
(8, 9, 4, 1, 30, 2),
(9, 10, 2, 1, 20, 3),
(10, 11, 5, 1, 35, 3),
(11, 12, 4, 1, 30, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `telephone`, `password`) VALUES
(1, 'ngugi', 'jones', 'jones@gmail.com', 796452313, '1234'),
(3, 'jones', 'reddington', 'petergmail.com', 712345678, '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
