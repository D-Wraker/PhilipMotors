-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 03:48 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoinventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Admin_Name` varchar(255) NOT NULL,
  `Admin_Contact_Number` varchar(20) DEFAULT NULL,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Address` varchar(255) DEFAULT NULL,
  `Admin_Status` enum('Active','Inactive','Deleted') DEFAULT 'Active',
  `Admin_RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_Name`, `Admin_Contact_Number`, `Admin_Email`, `Admin_Address`, `Admin_Status`, `Admin_RegDate`) VALUES
(1, 'tt', 'tt', 'tt@gg.gh', 'tt', 'Deleted', '2023-12-29 20:33:35'),
(2, 'tt', 'tt', 'tt@gg.gh', 'tt', 'Deleted', '2023-12-29 20:39:17'),
(3, 'yy', 'yy', 'yy@fef.rrg', 'yy', 'Deleted', '2023-12-29 20:39:53'),
(4, 'Admin', '0773265442', 'admin@gmail.com', '45 Main Street Colombo', 'Active', '2024-01-02 17:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(11) NOT NULL,
  `Customer_Name` varchar(255) DEFAULT NULL,
  `Customer_Contact_Number` varchar(20) DEFAULT NULL,
  `Customer_Email` varchar(255) DEFAULT NULL,
  `Customer_Address` varchar(255) DEFAULT NULL,
  `Customer_Status` varchar(10) DEFAULT 'Active',
  `Customer_RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Customer_Name`, `Customer_Contact_Number`, `Customer_Email`, `Customer_Address`, `Customer_Status`, `Customer_RegDate`) VALUES
(1, '$this->Customer_Name', '$this->Customer_Cont', '$this->Customer_Email', '$this->Customer_Address', 'deleted', '2023-12-07 20:00:41'),
(2, '2', '2', 'd@gmail.com', 'eded', 'deleted', '2023-12-07 20:28:37'),
(3, 'hi', '$this->Customer_Cont', 'g@gmail.com', '$this->Customer_Address', 'deleted', '2023-12-14 04:43:29'),
(4, 'John', '07745297777', 'jhone@gmail.com', '544 Main Street Matale', 'Active', '2023-12-22 11:16:39'),
(5, 'Ram', '0114268221', 'ram@gmail.com', '6546 Main street', 'Active', '2023-12-29 21:15:29'),
(6, 'Ram', '0114268221', 'ram@gmail.com', '6546 Main street', 'deleted', '2023-12-29 21:15:51'),
(7, 'Ram', '0114268221', 'ram@gmail.com', '6546 Main street', 'deleted', '2023-12-29 21:15:55'),
(8, 'Ram', '0114268221', 'ram@gmail.com', '6546 Main street', 'deleted', '2023-12-29 21:16:12'),
(9, 'Kiran', '04455296772', 'kiran@gmail.com', '12 Main street', 'Active', '2023-12-29 21:17:08'),
(10, 'Kiran', '04455296772', 'kiran@gmail.com', '12 Main street', 'deleted', '2023-12-29 21:17:37'),
(11, 'Kiran', '04455296772', 'kiran@gmail.com', '12 Main street', 'deleted', '2023-12-29 21:18:02'),
(12, 'Fin james', '0551264228', 'fin@gmail.com', '45 Main St', 'Active', '2023-12-29 21:18:44'),
(13, 'Fin', '04455296772', 'fin@gmail.com', '12 Main street', 'deleted', '2023-12-29 21:19:13'),
(14, 'sdsd', 'wsdd', '', '', 'deleted', '2024-01-09 20:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `grn`
--

CREATE TABLE `grn` (
  `grn_Id` int(11) NOT NULL,
  `grn_supplierId` int(11) DEFAULT NULL,
  `grn_receiptDate` date DEFAULT NULL,
  `grn_bill_total` decimal(10,2) DEFAULT NULL,
  `grn_added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `grn_status` varchar(50) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grn`
--

INSERT INTO `grn` (`grn_Id`, `grn_supplierId`, `grn_receiptDate`, `grn_bill_total`, `grn_added_date`, `grn_status`) VALUES
(4, 1, NULL, '144.00', '2024-01-01 18:30:00', 'Active'),
(5, 1, NULL, '275.00', '2024-01-01 18:30:00', 'Active'),
(6, 1, NULL, '156.00', '2024-01-01 18:30:00', 'Active'),
(7, 1, NULL, '792.00', '2024-01-01 18:30:00', 'Active'),
(8, 1, NULL, '23.00', '0000-00-00 00:00:00', 'Active'),
(9, 1, NULL, '7920.00', '0000-00-00 00:00:00', 'Active'),
(10, 1, NULL, '500.00', '2024-01-01 18:30:00', 'Active'),
(11, 1, NULL, '144.00', '2024-01-01 18:30:00', 'Active'),
(12, 1, NULL, '288.00', '2024-01-01 18:30:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `grn_items`
--

CREATE TABLE `grn_items` (
  `grn_item_id` int(11) NOT NULL,
  `grn_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `received_quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `received_amount` decimal(10,2) DEFAULT NULL,
  `item_status` varchar(50) DEFAULT NULL,
  `item_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grn_items`
--

INSERT INTO `grn_items` (`grn_item_id`, `grn_id`, `product_id`, `received_quantity`, `unit_price`, `received_amount`, `item_status`, `item_timestamp`) VALUES
(1, 1, 3, 120, '12.00', '1440.00', NULL, '2024-01-02 12:56:19'),
(2, 2, 3, 120, '12.00', '1440.00', NULL, '2024-01-02 12:56:41'),
(3, 3, 3, 67, '67.00', '4489.00', NULL, '2024-01-02 13:10:35'),
(4, 4, 4, 12, '12.00', '144.00', NULL, '2024-01-02 13:14:11'),
(5, 5, 4, 55, '5.00', '275.00', NULL, '2024-01-02 13:16:20'),
(6, 6, 3, 13, '12.00', '156.00', NULL, '2024-01-02 13:16:51'),
(7, 7, 3, 88, '9.00', '792.00', NULL, '2024-01-02 13:18:32'),
(8, 8, 4, 23, '1.00', '23.00', NULL, '2024-01-02 13:20:47'),
(9, 9, 3, 120, '66.00', '7920.00', NULL, '2024-01-02 13:25:53'),
(10, 10, 3, 100, '1.00', '100.00', NULL, '2024-01-02 16:07:05'),
(11, 10, 6, 200, '2.00', '400.00', NULL, '2024-01-02 16:07:05'),
(12, 11, 0, 12, '12.00', '144.00', NULL, '2024-01-02 16:14:30'),
(13, 12, 3, 12, '12.00', '144.00', NULL, '2024-01-02 16:15:26'),
(14, 12, 4, 12, '12.00', '144.00', NULL, '2024-01-02 16:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `statusreg_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `login_status` varchar(12) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `user_name`, `user_email`, `user_role`, `user_id`, `user_password`, `statusreg_time`, `login_status`) VALUES
(1, 'tt ', 'tt@gg.gh', '2', '2', 'd41d8cd98f00b204e9800998ecf8427e', '2023-12-29 20:39:17', 'deleted'),
(2, 'yy ', 'yy@fef.rrg', '2', '3', '202cb962ac59075b964b07152d234b70', '2023-12-29 20:39:53', 'deleted'),
(3, 'Admin ', 'admin@gmail.com', '2', '4', '202cb962ac59075b964b07152d234b70', '2024-01-02 17:46:15', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `transaction_type` enum('purchase','sales') NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `transaction_type`, `transaction_id`, `payment_amount`, `payment_date`, `payment_status`) VALUES
(1, 'sales', 75, '900.00', '2023-12-30 20:06:00', 'completed'),
(2, 'sales', 76, '1.00', '2023-12-30 20:14:29', 'completed'),
(3, '', 0, '1221.00', '2023-12-30 20:30:24', ''),
(4, '', 0, '1221.00', '2023-12-30 20:30:34', ''),
(5, '', 0, '1212.00', '2023-12-30 20:30:38', ''),
(6, 'sales', 0, '1212.00', '2023-12-30 20:33:00', ''),
(7, 'sales', 0, '0.00', '2023-12-30 20:33:04', ''),
(8, 'sales', 76, '0.00', '2023-12-30 20:34:15', ''),
(9, 'sales', 76, '1221.00', '2023-12-30 20:37:39', ''),
(10, 'sales', 76, '1221.00', '2023-12-30 20:38:06', ''),
(11, 'sales', 66, '9687.03', '2023-12-30 20:53:36', ''),
(12, 'sales', 70, '100000.00', '2023-12-30 20:57:01', ''),
(13, 'sales', 70, '1000.00', '2023-12-30 21:00:34', ''),
(14, 'sales', 70, '1000.00', '2023-12-30 21:05:39', ''),
(15, 'sales', 70, '1000.00', '2023-12-30 21:09:00', ''),
(16, '', 0, '0.00', '2023-12-30 21:42:16', ''),
(17, '', 0, '0.00', '2023-12-30 21:42:22', ''),
(18, '', 0, '0.00', '2023-12-30 21:43:56', ''),
(19, 'purchase', 1, '99999999.99', '2023-12-30 21:45:09', ''),
(20, 'purchase', 1, '99999999.99', '2023-12-30 21:45:50', ''),
(21, 'purchase', 1, '99999999.99', '2023-12-30 21:46:16', ''),
(22, 'sales', 77, '12.00', '2024-01-01 21:36:14', 'completed'),
(23, 'sales', 78, '12.00', '2024-01-01 21:37:28', 'completed'),
(24, 'sales', 79, '4.00', '2024-01-01 21:43:50', 'completed'),
(25, 'sales', 80, '0.00', '2024-01-01 21:44:04', 'completed'),
(26, 'sales', 81, '0.00', '2024-01-01 21:45:05', 'completed'),
(27, 'purchase', 6, '2222222.00', '2024-01-01 21:53:00', ''),
(28, 'sales', 82, '4.00', '2024-01-01 22:25:53', 'completed'),
(29, 'sales', 83, '2.00', '2024-01-01 22:32:12', 'completed'),
(30, 'sales', 84, '8.00', '2024-01-01 22:40:58', 'completed'),
(31, 'sales', 85, '70.00', '2024-01-01 22:48:09', 'completed'),
(32, 'sales', 86, '12.00', '2024-01-09 13:32:41', 'completed'),
(33, 'sales', 84, '4.00', '2024-01-09 17:12:35', ''),
(34, 'sales', 84, '4.00', '2024-01-09 17:12:52', ''),
(35, 'purchase', 7, '20.00', '2024-01-09 21:05:15', ''),
(36, 'purchase', 7, '50.00', '2024-01-09 21:05:48', ''),
(37, 'sales', 87, '55.00', '2024-01-10 14:39:27', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_id` int(11) NOT NULL,
  `Product_Name` varchar(255) NOT NULL,
  `Product_Description` text DEFAULT NULL,
  `Product_Model` varchar(50) DEFAULT NULL,
  `Product_Price` decimal(10,2) NOT NULL,
  `Product_QuantityInStock` int(11) NOT NULL,
  `Product_Supplier` varchar(100) DEFAULT NULL,
  `Product_Category` int(11) DEFAULT NULL,
  `Product_reorder_level` int(12) NOT NULL,
  `ProductStatus` varchar(20) DEFAULT 'Active',
  `Product_Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `Product_Name`, `Product_Description`, `Product_Model`, `Product_Price`, `Product_QuantityInStock`, `Product_Supplier`, `Product_Category`, `Product_reorder_level`, `ProductStatus`, `Product_Timestamp`) VALUES
(3, 'Nut', 'good', '112rr', '0.00', 100, '1', 1, 10, 'Active', '2024-01-01 22:25:04'),
(4, 'wheel', 'nice', '12', '0.00', 100, '1', 1, 5, 'Active', '2024-01-01 22:47:07'),
(6, 'oill2', 'no 2', '2', '0.00', 5, '1', 1, 1, 'deleted', '2024-01-02 13:31:12'),
(10, '34', '34', '34', '0.00', 34, '1', 2, 34, 'deleted', '2024-01-05 19:32:30'),
(11, 'Cable', '1m long', '11eee', '0.00', 10, '1', 2, 5, 'deleted', '2024-01-09 17:01:39'),
(12, 'Rubber', '12', '12', '0.00', 12, '4', 3, 1, 'Active', '2024-01-09 20:58:49'),
(13, 'Mini ', '12', '12', '0.00', 12, '1', 2, 1, 'Active', '2024-01-10 14:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `Category_id` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL,
  `Category_Description` text DEFAULT NULL,
  `Category_Status` varchar(20) DEFAULT 'Active',
  `Category_Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`Category_id`, `Category_Name`, `Category_Description`, `Category_Status`, `Category_Timestamp`) VALUES
(1, 'tttt5t5', '', 'Active', '2023-12-14 05:33:40'),
(2, 'oooooooo', '', 'Active', '2023-12-14 18:28:03'),
(3, 'qw', 'qwe', 'Active', '2023-12-14 18:34:58'),
(4, 'qw', 'qwe', 'Active', '2023-12-14 18:36:30'),
(5, 'new', '12212', 'deleted', '2024-01-09 21:21:11'),
(6, 'new', '12212', 'deleted', '2024-01-09 21:21:15'),
(7, '111', '111', 'deleted', '2024-01-09 21:21:50'),
(8, 'fef', 'efe', 'deleted', '2024-01-09 21:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `Purchase_id` int(11) NOT NULL,
  `Supplier_id` int(11) DEFAULT NULL,
  `purchase_balance` decimal(10,2) DEFAULT NULL,
  `purchase_paid_amount` decimal(10,2) DEFAULT NULL,
  `Purchase_Date` date DEFAULT NULL,
  `bill_total` decimal(10,2) DEFAULT NULL,
  `Purchase_Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `purchase_status` varchar(255) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`Purchase_id`, `Supplier_id`, `purchase_balance`, `purchase_paid_amount`, `Purchase_Date`, `bill_total`, `Purchase_Timestamp`, `purchase_status`) VALUES
(4, 4, '267.20', '1000.00', '0000-00-00', '1267.20', '2024-01-03 08:29:24', 'deleted'),
(5, 2, '114.72', '12.00', '2024-01-18', '126.72', '2024-01-03 08:32:23', 'deleted'),
(6, 2, '-2222107.28', '12.00', '2024-01-18', '126.72', '2024-01-03 08:29:09', 'deleted'),
(7, 1, '62.00', '12.00', '2024-01-02', '144.00', '2024-01-09 21:05:48', 'Active'),
(8, 1, '130.56', '12.00', '2024-01-02', '142.56', '2024-01-02 16:42:24', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `purchase_item_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `item_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`purchase_item_id`, `purchase_id`, `product_id`, `quantity`, `item_price`, `discount`, `item_amount`) VALUES
(1, 1, 0, 0, '0.00', '0.00', '0.00'),
(2, 1, 3, 12, '12.00', '1.00', '142.56'),
(3, 2, 2, 45, '45.00', '3.00', '1964.25'),
(4, 3, 7, 100, '12.00', '12.00', '1056.00'),
(5, 4, 11, 120, '12.00', '12.00', '1267.20'),
(6, 5, 4, 12, '12.00', '12.00', '126.72'),
(7, 6, 4, 12, '12.00', '12.00', '126.72'),
(8, 7, 3, 12, '12.00', '0.00', '144.00'),
(9, 8, 4, 12, '12.00', '1.00', '142.56');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Sale_id` int(11) NOT NULL,
  `Customer_id` int(11) DEFAULT NULL,
  `sales_balance` decimal(10,2) DEFAULT NULL,
  `sales_paid_amount` decimal(10,2) DEFAULT NULL,
  `Sales_Date` date DEFAULT NULL,
  `bill_total` decimal(10,2) DEFAULT NULL,
  `Sale_Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `sales_status` varchar(50) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Sale_id`, `Customer_id`, `sales_balance`, `sales_paid_amount`, `Sales_Date`, `bill_total`, `Sale_Timestamp`, `sales_status`) VALUES
(51, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:08:54', 'Active'),
(52, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:10:43', 'Active'),
(53, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:12:46', 'Active'),
(54, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:21:04', 'Active'),
(55, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:23:15', 'Active'),
(56, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:23:34', 'Active'),
(57, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:24:05', 'Active'),
(58, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:25:19', 'Active'),
(59, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:25:43', 'Active'),
(60, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:27:49', 'Active'),
(61, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:29:57', 'Active'),
(62, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:42:27', 'Active'),
(63, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:48:09', 'Active'),
(64, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 13:48:42', 'Active'),
(65, 0, '0.00', '0.00', '0000-00-00', '0.00', '2023-12-21 17:09:13', 'Active'),
(66, 2, '0.00', '12.00', '2023-12-21', '9699.03', '2023-12-21 17:18:00', 'deleted'),
(67, -1, '6962.00', '233.00', '2023-12-15', '7195.00', '2023-12-21 23:34:22', 'Active'),
(68, -1, '6962.00', '233.00', '2023-12-15', '7195.00', '2023-12-22 09:40:01', 'Active'),
(69, -1, '6962.00', '233.00', '2023-12-15', '7195.00', '2023-12-22 09:40:14', 'Active'),
(70, 4, '-2000.00', '111.00', '2023-12-28', '1013.76', '2023-12-28 13:51:40', 'deleted'),
(71, 4, '37.28', '100.00', '2023-12-07', '137.28', '2023-12-29 17:24:48', 'Active'),
(72, 4, '336.32', '1000.00', '2023-12-06', '1336.32', '2023-12-29 17:33:44', 'deleted'),
(73, 4, '241377.00', '123.00', '0000-00-00', '241500.00', '2023-12-29 17:39:10', 'deleted'),
(74, 4, '4833.00', '900.00', '2023-12-31', '5733.00', '2023-12-30 20:04:17', 'deleted'),
(75, 4, '4833.00', '900.00', '2023-12-31', '5733.00', '2023-12-30 20:06:00', 'deleted'),
(76, 4, '0.00', '1.00', '2023-11-30', '1.00', '2023-12-30 20:14:29', 'Active'),
(77, -1, '114.72', '12.00', '0000-00-00', '126.72', '2024-01-01 21:36:14', 'Active'),
(78, -1, '114.72', '12.00', '0000-00-00', '126.72', '2024-01-01 21:37:28', 'Active'),
(79, 5, '122.72', '4.00', '0000-00-00', '126.72', '2024-01-01 21:43:50', 'deleted'),
(80, -1, '0.00', '0.00', '0000-00-00', '0.00', '2024-01-01 21:44:04', 'Active'),
(81, -1, '0.00', '0.00', '0000-00-00', '221.76', '2024-01-01 21:45:05', 'Active'),
(82, 4, '6.00', '4.00', '2024-01-02', '10.00', '2024-01-01 22:25:53', 'deleted'),
(83, 4, '2.00', '2.00', '2024-01-05', '4.00', '2024-01-01 22:32:12', 'deleted'),
(84, 4, '-4.00', '8.00', '2024-01-12', '12.00', '2024-01-01 22:40:58', 'deleted'),
(85, 4, '20.00', '70.00', '2024-01-02', '90.00', '2024-01-01 22:48:09', 'deleted'),
(86, 5, '114.72', '12.00', '2024-01-09', '126.72', '2024-01-09 13:32:41', 'Active'),
(87, 12, '43.94', '55.00', '2024-01-10', '98.94', '2024-01-10 14:39:27', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `Sales_Product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `item_amount` decimal(10,2) DEFAULT NULL,
  `item_status` varchar(50) DEFAULT 'Active',
  `item_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`sale_item_id`, `sale_id`, `Sales_Product_id`, `quantity`, `item_price`, `discount`, `item_amount`, `item_status`, `item_timestamp`) VALUES
(1, 0, 0, 0, '0.00', '0.00', '0.00', 'Active', '2023-12-20 19:36:32'),
(2, 0, 0, 0, '0.00', '0.00', '0.00', 'Active', '2023-12-21 12:24:58'),
(3, 36, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-12-21 12:37:01'),
(4, 37, 0, 0, '0.00', '0.00', '0.00', 'Active', '2023-12-21 12:37:59'),
(5, 56, 2, 3, '3.00', '2.00', '8.82', 'Active', '2023-12-21 13:23:34'),
(6, 57, 3, 11, '11.00', '11.00', '107.69', 'Active', '2023-12-21 13:24:05'),
(7, 57, 0, 222, '22.00', '22.00', '3809.52', 'Active', '2023-12-21 13:24:05'),
(8, 58, 3, 11, '11.00', '11.00', '107.69', 'Active', '2023-12-21 13:25:19'),
(9, 58, 0, 222, '22.00', '22.00', '3809.52', 'Active', '2023-12-21 13:25:19'),
(10, 59, 3, 11, '11.00', '11.00', '107.69', 'Active', '2023-12-21 13:25:43'),
(11, 59, 0, 222, '22.00', '22.00', '3809.52', 'Active', '2023-12-21 13:25:43'),
(12, 60, 3, 11, '11.00', '11.00', '107.69', 'Active', '2023-12-21 13:27:49'),
(13, 60, 0, 222, '22.00', '22.00', '3809.52', 'Active', '2023-12-21 13:27:49'),
(14, 61, 2, 12, '12.00', '12.00', '126.72', 'Active', '2023-12-21 13:29:57'),
(15, 61, 3, 12, '1.00', '1.00', '11.88', 'Active', '2023-12-21 13:29:57'),
(16, 62, 4, 12, '12.00', '1.00', '142.56', 'Active', '2023-12-21 13:42:27'),
(17, 63, 4, 12, '12.00', '1.00', '142.56', 'Active', '2023-12-21 13:48:09'),
(18, 64, 4, 12, '12.00', '1.00', '142.56', 'Active', '2023-12-21 13:48:42'),
(19, 65, 1, 12, '1.00', '1.00', '11.88', 'Active', '2023-12-21 17:09:13'),
(20, 66, 3, 3333, '3.00', '3.00', '9699.03', 'Active', '2023-12-21 17:18:00'),
(21, 67, 1, 23, '23.00', '0.00', '529.00', 'Active', '2023-12-21 23:34:22'),
(22, 67, 7, 3333, '2.00', '0.00', '6666.00', 'Active', '2023-12-21 23:34:22'),
(23, 68, 1, 23, '23.00', '0.00', '529.00', 'Active', '2023-12-22 09:40:01'),
(24, 68, 7, 3333, '2.00', '0.00', '6666.00', 'Active', '2023-12-22 09:40:01'),
(25, 69, 1, 23, '23.00', '0.00', '529.00', 'Active', '2023-12-22 09:40:14'),
(26, 69, 7, 3333, '2.00', '0.00', '6666.00', 'Active', '2023-12-22 09:40:14'),
(27, 70, 4, 12, '12.00', '12.00', '126.72', 'Active', '2023-12-28 13:51:40'),
(28, 70, 8, 21, '44.00', '4.00', '887.04', 'Active', '2023-12-28 13:51:40'),
(29, 71, 3, 12, '12.00', '12.00', '126.72', 'Active', '2023-12-29 17:24:48'),
(30, 71, 8, 12, '1.00', '12.00', '10.56', 'Active', '2023-12-29 17:24:48'),
(31, 72, 6, 112, '12.00', '10.00', '1209.60', 'Active', '2023-12-29 17:33:44'),
(32, 72, 4, 12, '12.00', '12.00', '126.72', 'Active', '2023-12-29 17:33:44'),
(33, 73, 11, 1000, '525.00', '54.00', '241500.00', 'Active', '2023-12-29 17:39:10'),
(34, 74, 3, 70, '90.00', '9.00', '5733.00', 'Active', '2023-12-30 20:04:17'),
(35, 75, 3, 70, '90.00', '9.00', '5733.00', 'Active', '2023-12-30 20:06:00'),
(36, 76, 3, 1, '1.00', '0.00', '1.00', 'Active', '2023-12-30 20:14:29'),
(37, 77, 3, 12, '12.00', '12.00', '126.72', 'Active', '2024-01-01 21:36:14'),
(38, 78, 3, 12, '12.00', '12.00', '126.72', 'Active', '2024-01-01 21:37:28'),
(39, 79, 7, 12, '12.00', '12.00', '126.72', 'Active', '2024-01-01 21:43:50'),
(40, 81, 6, 21, '12.00', '12.00', '221.76', 'Active', '2024-01-01 21:45:05'),
(41, 82, 3, 10, '1.00', '0.00', '10.00', 'Active', '2024-01-01 22:25:53'),
(42, 83, 3, 2, '2.00', '0.00', '4.00', 'Active', '2024-01-01 22:32:12'),
(43, 84, 3, 12, '1.00', '0.00', '12.00', 'Active', '2024-01-01 22:40:58'),
(44, 85, 4, 10, '9.00', '0.00', '90.00', 'Active', '2024-01-01 22:48:09'),
(45, 86, 3, 12, '12.00', '12.00', '126.72', 'Active', '2024-01-09 13:32:41'),
(46, 87, 13, 3, '34.00', '3.00', '98.94', 'Active', '2024-01-10 14:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(12) NOT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `reorder_level` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `stock_status` varchar(50) DEFAULT 'Active',
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_id`, `quantity_in_stock`, `reorder_level`, `product_name`, `stock_status`, `added_date`) VALUES
(1, 4, 5, 5, 'wheel', 'Active', '2024-01-01 22:47:07'),
(3, 3, 287, 10, 'Nut', 'Active', '2024-01-01 22:25:04'),
(4, 6, 5, 5, 'oill2', 'remover', '2024-01-02 13:31:12'),
(10, 11, 10, 5, 'Cable', 'remover', '2024-01-09 17:01:39'),
(11, 12, 12, 1, 'Rubber', 'Active', '2024-01-09 20:58:49'),
(12, 13, 9, 1, 'Mini ', 'Active', '2024-01-10 14:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Supplier_id` int(11) NOT NULL,
  `Supplier_name` varchar(255) DEFAULT NULL,
  `Supplier_contact_person` varchar(255) DEFAULT NULL,
  `Supplier_contact_person_phoneNO` varchar(20) DEFAULT NULL,
  `Supplier_Address` varchar(50) NOT NULL,
  `Supplier_RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Supplier_status` varchar(40) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Supplier_id`, `Supplier_name`, `Supplier_contact_person`, `Supplier_contact_person_phoneNO`, `Supplier_Address`, `Supplier_RegDate`, `Supplier_status`) VALUES
(1, 'New Lanka Enterprices ', 'Kumar', '0774215442', 'ht', '0000-00-00 00:00:00', 'Active'),
(2, 'wd', '', '', '', '2023-12-07 21:12:25', 'deleted'),
(4, 'sq', 'qs', 'qss', 'qs', '2023-12-07 21:14:27', 'deleted'),
(5, 'wd', 'wd', 'dw', 'wd', '2023-12-08 20:09:51', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `grn`
--
ALTER TABLE `grn`
  ADD PRIMARY KEY (`grn_Id`);

--
-- Indexes for table `grn_items`
--
ALTER TABLE `grn_items`
  ADD PRIMARY KEY (`grn_item_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`Purchase_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Sale_id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`sale_item_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `grn`
--
ALTER TABLE `grn`
  MODIFY `grn_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grn_items`
--
ALTER TABLE `grn_items`
  MODIFY `grn_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `Purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `sale_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
