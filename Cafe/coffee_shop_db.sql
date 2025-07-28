-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2025 at 12:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`, `created_at`) VALUES
(1, 'Administrator', 'admin', 'admin123', '2025-07-25 19:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `full_name`, `email`, `phone`, `password`, `status`, `created_at`) VALUES
(1, 'Abdulrahman Ahmed Abdo Rashed', 'xyz@gmail.com', '0773130247', '1234', 'Active', '2025-07-25 20:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_attempts`
--

CREATE TABLE `tbl_login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `success` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login_attempts`
--

INSERT INTO `tbl_login_attempts` (`id`, `username`, `ip_address`, `success`, `created_at`) VALUES
(1, 'zyx@gmail.com', '::1', 0, '2025-07-27 15:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_category`
--

CREATE TABLE `tbl_menu_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `featured` enum('Yes','No') DEFAULT 'No',
  `active` enum('Yes','No') DEFAULT 'Yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_menu_category`
--

INSERT INTO `tbl_menu_category` (`id`, `title`, `featured`, `active`, `created_at`) VALUES
(1, 'Coffee', 'Yes', 'Yes', '2025-07-25 19:35:02'),
(2, 'Tea', 'No', 'Yes', '2025-07-25 19:35:02'),
(3, 'Pastries', 'Yes', 'Yes', '2025-07-25 19:35:02'),
(4, 'Sandwiches', 'No', 'Yes', '2025-07-25 19:35:02'),
(5, 'Desserts', 'No', 'Yes', '2025-07-25 19:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `table_number` varchar(10) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT 'Cash',
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('Ordered','Preparing','Ready','Completed','Cancelled') DEFAULT 'Ordered',
  `notes` text DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `image_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `featured` enum('Yes','No') DEFAULT 'No',
  `active` enum('Yes','No') DEFAULT 'Yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `title`, `description`, `price`, `discount`, `image_name`, `category_id`, `featured`, `active`, `created_at`) VALUES
(10, 'Butterscotch', 'Butterscotch-Pudding-Dessert', 50000.00, 10.00, '6886545271e22.jpg', 5, 'Yes', 'Yes', '2025-07-27 16:31:14'),
(11, 'Banana Pudding', 'Banana Pudding Test the Ultimate Delight', 45000.00, 10.00, '688654d07d8b6.jpg', 5, 'Yes', 'Yes', '2025-07-27 16:33:20'),
(12, 'Chcolate Terrine', 'Chcolate Terrine,The Bitter End\'s Chocolate Terrine', 60000.00, 10.00, '68865583bf14f.jpg', 5, 'Yes', 'Yes', '2025-07-27 16:36:19'),
(13, 'France Chocolate ', 'French Chocolate,is the favorite french chocolate desserts ', 60000.00, 10.00, '688655e9a2609.jpg', 5, 'Yes', 'Yes', '2025-07-27 16:38:01'),
(14, 'Greek Baklava', 'Greek Baklava Delicious Desserts To make your Taste Buds Tingle', 60000.00, 10.00, '688656553985c.jpg', 5, 'Yes', 'Yes', '2025-07-27 16:39:49'),
(15, 'Hawaiin Desserts', 'Hawaiin Desserts Delisious and easy ', 55000.00, 10.00, '688656a88e9d5.jpg', 5, 'Yes', 'Yes', '2025-07-27 16:41:12'),
(16, 'Fried Chicken', 'Freid Chicken Sandwitch Ultimate Grilled Chicken Sandwitch ', 60000.00, 10.00, '68865b2521a21.jpeg', 4, 'Yes', 'Yes', '2025-07-27 17:00:21'),
(17, 'Burger Chicken ', 'Burger Chicken Sandwitch Ultimate Grilled Chicken Sandwitch ', 60000.00, 10.00, '68865b7803901.jpg', 4, 'Yes', 'Yes', '2025-07-27 17:01:44'),
(18, 'Chopped beef', 'Chopped beef sandwitch Best Submarine Sandwitch ', 70000.00, 10.00, '68865bf0059a4.jpg', 4, 'Yes', 'Yes', '2025-07-27 17:03:44'),
(19, 'Prosciutto Sandwitch ', 'Prosciutto Sandwitch Panino with Mozzarella,Tomato and...', 65000.00, 10.00, '68865c9474442.jpg', 4, 'Yes', 'Yes', '2025-07-27 17:06:28'),
(20, 'Rindfleisch', 'Rindfleisch Sandwitch Subways is perfect for rotisserie chicken ', 75000.00, 10.00, '68865d2c958f5.jpeg', 4, 'Yes', 'Yes', '2025-07-27 17:09:00'),
(21, 'Subway ', 'Subway Sandwitch is perfect for Rotisserie Chicken fans ', 80000.00, 10.00, '68865db27ebbe.jpg', 4, 'Yes', 'Yes', '2025-07-27 17:11:14'),
(22, 'Ambrosia Pastry', 'Ambrosia Bastry Sweet and Savory Greek Pastries ', 45000.00, 5.00, '68866196a275a.jpeg', 3, 'Yes', 'Yes', '2025-07-27 17:27:50'),
(23, 'Chocolate Pastry ', 'Chocolate Pastry sweety', 40000.00, 5.00, '68866207323a3.jpg', 3, 'Yes', 'Yes', '2025-07-27 17:29:43'),
(24, 'Chocolate Terrine', 'Chocolate terrine with strowbery ', 40000.00, 5.00, '688662606b6a5.jpg', 3, 'Yes', 'Yes', '2025-07-27 17:31:12'),
(25, 'Freesia Pastory ', 'Freesia Pastory sweet', 40000.00, 5.00, '688662b9619b1.jpeg', 3, 'Yes', 'Yes', '2025-07-27 17:32:41'),
(26, 'Greek Pastory ', 'Sweet and Savory Greek Pastories ', 40000.00, 5.00, '6886632706e5f.jpg', 3, 'Yes', 'Yes', '2025-07-27 17:34:31'),
(27, 'French Pastory', 'The best french Pastory ', 40000.00, 5.00, '6886636c1294f.jpg', 3, 'Yes', 'Yes', '2025-07-27 17:35:40'),
(28, 'imperial tea', 'Fresh imperial tea', 25000.00, 5.00, '688665a61d761.webp', 2, 'Yes', 'Yes', '2025-07-27 17:45:10'),
(29, 'Arabic Tea', 'Fresh Arabic Tea', 25000.00, 5.00, '688665d445e1a.jpg', 2, 'Yes', 'Yes', '2025-07-27 17:45:56'),
(30, 'ice tea', 'special fresh ice tea', 25000.00, 5.00, '688666266be83.jpg', 2, 'Yes', 'Yes', '2025-07-27 17:47:18'),
(31, 'fresh tea', 'special fresh tea', 25000.00, 5.00, '688666629514e.webp', 2, 'Yes', 'Yes', '2025-07-27 17:48:18'),
(32, 'lemon tea', 'fresh ice lemon tea', 25000.00, 5.00, '688666ce93692.jpg', 2, 'Yes', 'Yes', '2025-07-27 17:50:06'),
(33, 'milk tea', 'special fresh tea with milk ', 30000.00, 5.00, '68866705dcc52.jpg', 2, 'Yes', 'Yes', '2025-07-27 17:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_security_log`
--

CREATE TABLE `tbl_security_log` (
  `id` int(11) NOT NULL,
  `event` varchar(100) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_security_log`
--

INSERT INTO `tbl_security_log` (`id`, `event`, `ip_address`, `user_agent`, `details`, `created_at`) VALUES
(1, 'customer_login_failed', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'Failed login attempt for zyx@gmail.com', '2025-07-27 15:28:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu_category`
--
ALTER TABLE `tbl_menu_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_security_log`
--
ALTER TABLE `tbl_security_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_menu_category`
--
ALTER TABLE `tbl_menu_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_security_log`
--
ALTER TABLE `tbl_security_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_menu_category` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
