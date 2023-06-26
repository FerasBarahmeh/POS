-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 09:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientId`, `Name`, `PhoneNumber`, `Email`, `Address`) VALUES
(1, 'Tamer Ahmad', '0785120996', 'ahmad@gmail.com', 'Amman Jordan'),
(2, 'Belal Khaled Nour', '0785102996', 'belal@gmail.com', 'Irbid Jordan');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_categories`
--

CREATE TABLE `expenses_categories` (
  `ExpenseId` tinyint(3) UNSIGNED NOT NULL,
  `ExpenseName` varchar(30) NOT NULL,
  `FixedPyment` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_daily_list`
--

CREATE TABLE `expenses_daily_list` (
  `DailyExpensesId` int(10) UNSIGNED NOT NULL,
  `ExpenseId` tinyint(3) UNSIGNED NOT NULL,
  `Payment` decimal(7,2) NOT NULL,
  `Created` datetime NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationId` int(10) UNSIGNED NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Type` tinyint(2) NOT NULL,
  `Created` datetime NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL,
  `seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(10) UNSIGNED NOT NULL,
  `CategoryId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` varchar(50) DEFAULT NULL,
  `Quantity` smallint(5) UNSIGNED NOT NULL,
  `BuyPrice` decimal(6,3) NOT NULL,
  `BarCode` char(20) DEFAULT NULL,
  `Unit` tinyint(1) NOT NULL,
  `SellPrice` decimal(6,3) NOT NULL,
  `Tax` decimal(3,2) DEFAULT 0.00,
  `Status` tinyint(2) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Rating` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `CategoryId`, `Name`, `Image`, `Quantity`, `BuyPrice`, `BarCode`, `Unit`, `SellPrice`, `Tax`, `Status`, `Description`, `Rating`) VALUES
(1, 2, 'PlayStation 5', '819b68d98d74660225f8fe8ff75821.jpg', 431, '350.000', '1589456982', 5, '400.000', '0.50', 1, NULL, NULL),
(3, 3, 'Fan', '2bf21fc83f5bbb2e7a58a9f7cf7c40.png', 1000, '15.000', '0124585292462', 5, '20.000', '0.00', 2, NULL, NULL),
(4, 4, 'HP PAVILION', 'c20820aa680e5e28f6950ee120ac35.jpg', 171, '400.000', '12458796315', 5, '500.000', '0.50', 1, 'Gaming Laptop', NULL),
(5, 5, 'SAMSUNG A23', '548017a53025b5abb1f8a3c2c47099.jpg', 165, '150.000', '0452862685', 5, '180.000', '0.20', 1, '', NULL),
(6, 5, 'Huawel Y9s', '80db229b10e160f2fa86c575ad5e15.jpeg', 61, '150.000', '0129256', 5, '180.000', '0.40', 1, 'New Phone From Huawel', NULL),
(7, 2, 'Call of Duty', 'ceee04be9ed528ee0bb3856ec5c096.jpg', 100, '25.000', '01256512546521', 5, '30.000', '0.20', 2, '', NULL),
(8, 3, 'Earbuds ', '80f33bd9304127bc4df203c12e30bb.jpg', 150, '100.000', '2568722428', 5, '110.000', '0.20', 1, 'Earbuds HUAWEI', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `CategoryId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`CategoryId`, `Name`, `Image`) VALUES
(1, 'Books', 'fcf6b380c5f2297f617f831c94e400.png'),
(2, 'Video Games', '539c770a538bd4c9963768d0196e08.jpeg'),
(3, 'Electricals', '77e1cec667706e567412dab72c734d.jpeg'),
(4, 'Laptops', 'b6d2fe2ca501d49baa47c644a99359.jpeg'),
(5, 'Phones', '91192d64d419da955e9200073e4508.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `purchases_invoices`
--

CREATE TABLE `purchases_invoices` (
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `SupplierId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL,
  `Created` date NOT NULL,
  `Discount` decimal(8,2) DEFAULT NULL,
  `UserId` int(10) UNSIGNED NOT NULL,
  `NumberProducts` int(6) NOT NULL,
  `TypeInvoice` enum('purchases','sales') DEFAULT 'purchases',
  `DiscountType` enum('percentage','value') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases_invoices`
--

INSERT INTO `purchases_invoices` (`InvoiceId`, `SupplierId`, `PaymentType`, `PaymentStatus`, `Created`, `Discount`, `UserId`, `NumberProducts`, `TypeInvoice`, `DiscountType`) VALUES
(1, 1, 0, 0, '2023-06-20', '10.00', 1, 1, 'purchases', 'percentage');

-- --------------------------------------------------------

--
-- Table structure for table `purchases_invoices_details`
--

CREATE TABLE `purchases_invoices_details` (
  `Id` smallint(5) UNSIGNED NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `ProductPrice` decimal(7,2) NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases_invoices_details`
--

INSERT INTO `purchases_invoices_details` (`Id`, `ProductId`, `ProductPrice`, `Quantity`, `InvoiceId`) VALUES
(1, 1, '400.00', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases_invoices_receipts`
--

CREATE TABLE `purchases_invoices_receipts` (
  `ReceiptId` int(10) UNSIGNED NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferredTo` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases_invoices_receipts`
--

INSERT INTO `purchases_invoices_receipts` (`ReceiptId`, `InvoiceId`, `PaymentType`, `PaymentAmount`, `PaymentLiteral`, `BankName`, `BankAccountNumber`, `CheckNumber`, `TransferredTo`, `created`, `UserId`) VALUES
(1, 1, 0, '2600.00', '400', NULL, NULL, NULL, NULL, '2023-06-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices`
--

CREATE TABLE `sales_invoices` (
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `ClientId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL,
  `Created` datetime NOT NULL,
  `Discount` decimal(8,2) DEFAULT NULL,
  `UserId` int(10) UNSIGNED NOT NULL,
  `DiscountType` enum('percentage','value') DEFAULT NULL,
  `NumberProducts` int(6) NOT NULL,
  `TypeInvoice` enum('purchases','sales') DEFAULT 'sales'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_invoices`
--

INSERT INTO `sales_invoices` (`InvoiceId`, `ClientId`, `PaymentType`, `PaymentStatus`, `Created`, `Discount`, `UserId`, `DiscountType`, `NumberProducts`, `TypeInvoice`) VALUES
(1, 2, 0, 0, '2023-06-20 13:02:31', '10.00', 1, 'value', 1, 'sales'),
(2, 1, 0, 0, '2023-06-20 13:03:16', '10.00', 1, 'percentage', 2, 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_details`
--

CREATE TABLE `sales_invoices_details` (
  `Id` smallint(5) UNSIGNED NOT NULL,
  `ProductId` int(10) UNSIGNED NOT NULL,
  `ProductPrice` decimal(7,2) NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_invoices_details`
--

INSERT INTO `sales_invoices_details` (`Id`, `ProductId`, `ProductPrice`, `Quantity`, `InvoiceId`) VALUES
(1, 1, '400.00', 1, 1),
(2, 1, '400.00', 1, 2),
(3, 4, '500.00', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices_receipts`
--

CREATE TABLE `sales_invoices_receipts` (
  `ReceiptId` int(10) UNSIGNED NOT NULL,
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferredTo` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_invoices_receipts`
--

INSERT INTO `sales_invoices_receipts` (`ReceiptId`, `InvoiceId`, `PaymentType`, `PaymentAmount`, `PaymentLiteral`, `BankName`, `BankAccountNumber`, `CheckNumber`, `TransferredTo`, `created`, `UserId`) VALUES
(1, 1, 0, '500.00', '100', NULL, NULL, NULL, NULL, '2023-06-20', 1),
(2, 2, 0, '7200.00', '900', NULL, NULL, NULL, NULL, '2023-06-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `Id` int(11) UNSIGNED NOT NULL,
  `UserId` int(11) UNSIGNED NOT NULL,
  `Language` enum('ar','en') NOT NULL DEFAULT 'en',
  `Currency` varchar(10) NOT NULL DEFAULT '$'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`Id`, `UserId`, `Language`, `Currency`) VALUES
(0, 1, 'en', 'JOD');

-- --------------------------------------------------------

--
-- Table structure for table `subset_information_users`
--

CREATE TABLE `subset_information_users` (
  `UserId` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(10) NOT NULL,
  `LastName` varchar(10) NOT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `BOD` date DEFAULT NULL,
  `Image` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subset_information_users`
--

INSERT INTO `subset_information_users` (`UserId`, `FirstName`, `LastName`, `Address`, `BOD`, `Image`) VALUES
(1, 'Feras', 'Barahmeh', 'Jordan-Zaeqa-HeShaker-behavier Forqn mosqe', '2002-06-11', NULL),
(2, 'Majd', 'Barahmeh', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `SupplierId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`SupplierId`, `Name`, `PhoneNumber`, `Email`, `Address`) VALUES
(1, 'Ahmad Mohammad', '0785102996', 'ahmad@gmail.com', 'Zarqa Jordan'),
(2, 'Mohammad Tammemi', '0785102996', 'mohammad@gmail.com', 'Zarqa Jordan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(12) NOT NULL,
  `Password` char(60) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `SubscriptionDate` datetime NOT NULL,
  `LastLogin` datetime NOT NULL,
  `GroupId` tinyint(1) UNSIGNED NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `Password`, `Email`, `SubscriptionDate`, `LastLogin`, `GroupId`, `PhoneNumber`, `Status`) VALUES
(1, 'bnzz', '$2a$07$yeNCSNwRpYopOhv0TrrReO.CgBLQTGn6YYr1a96YlnBHx6bYBpe7.', 'feras345@gmail.com', '2023-02-15 19:26:58', '2023-06-26 21:28:35', 7, '0785102996', 1),
(2, 'da7loze', '$2a$07$yeNCSNwRpYopOhv0TrrReO.CgBLQTGn6YYr1a96YlnBHx6bYBpe7.', 'majd47@gmail.com', '2023-02-15 19:28:26', '2023-02-21 14:50:49', 9, '0785102996', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `GroupId` tinyint(1) UNSIGNED NOT NULL,
  `GroupName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`GroupId`, `GroupName`) VALUES
(7, 'Admin Application'),
(9, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups_privileges`
--

CREATE TABLE `users_groups_privileges` (
  `Id` tinyint(3) UNSIGNED NOT NULL,
  `GroupId` tinyint(1) UNSIGNED NOT NULL,
  `PrivilegeId` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups_privileges`
--

INSERT INTO `users_groups_privileges` (`Id`, `GroupId`, `PrivilegeId`) VALUES
(37, 7, 36),
(38, 7, 38),
(42, 9, 38),
(53, 9, 41),
(54, 9, 42),
(58, 7, 41),
(59, 7, 42),
(60, 7, 43),
(61, 7, 44),
(62, 7, 45),
(63, 7, 46),
(64, 7, 47),
(65, 7, 48),
(66, 7, 49),
(67, 7, 51),
(68, 7, 52),
(69, 7, 53),
(70, 7, 54),
(71, 7, 55),
(72, 9, 47),
(75, 7, 56),
(76, 7, 57),
(77, 7, 58),
(78, 7, 59),
(79, 7, 60),
(80, 7, 61),
(81, 7, 62),
(82, 7, 63),
(83, 7, 64),
(84, 7, 65),
(85, 7, 66),
(86, 7, 67),
(87, 7, 68),
(88, 7, 69),
(89, 7, 70),
(90, 7, 71),
(93, 7, 74),
(95, 7, 76),
(96, 7, 77),
(97, 7, 78);

-- --------------------------------------------------------

--
-- Table structure for table `users_privileges`
--

CREATE TABLE `users_privileges` (
  `PrivilegeId` tinyint(3) UNSIGNED NOT NULL,
  `Privilege` varchar(30) NOT NULL,
  `PrivilegeTitle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_privileges`
--

INSERT INTO `users_privileges` (`PrivilegeId`, `Privilege`, `PrivilegeTitle`) VALUES
(36, '/usersprivileges/add', 'Add privileges'),
(38, '/reports/add', 'Add reports'),
(41, '/suppliers/add', 'create new supplier'),
(42, '/suppliers/edit', 'Edit information supplier'),
(43, '/suppliers/delete', 'Delete supplier'),
(44, '/users/add', 'Add new user'),
(45, '/users/delete', 'Delete user'),
(46, '/users/edit', 'Edit user information'),
(47, '/users/default', 'Users List'),
(48, '/usersprivileges/default', 'Privileges'),
(49, '/usersprivileges/delete', 'Delete Privilege'),
(51, '/usersprivileges/edit', 'Edit Privilege'),
(52, '/usersgroups/default', 'Groups List'),
(53, '/usersgroups/edit', 'Edit Group'),
(54, '/usersgroups/delete', 'Group Delete'),
(55, '/usersgroups/add', 'Add Group'),
(56, '/suppliers/default', 'Suppliers'),
(57, '/clients/default', 'Client List'),
(58, '/clients/add', 'Client Add'),
(59, '/clients/delete', 'Client Delete'),
(60, '/clients/edit', 'Client Edit'),
(61, '/productscategories/default', 'Category List'),
(62, '/productscategories/add', 'Add Category'),
(63, '/productscategories/edit', 'Edit Category'),
(64, '/productscategories/delete', 'Delete Category '),
(65, '/products/default', 'Products'),
(66, '/products/edit', 'Edit Product'),
(67, '/products/add', 'Add Product'),
(68, '/products/delete', 'Delete Product	'),
(69, '/sales/default', 'Sales'),
(70, '/sales/sellproduct', 'Sell a product'),
(71, '/sales/getInfoClientNameAjax', 'ajax '),
(74, '/transactions/default', 'Transactions'),
(76, '/purchases/default', ' Purchases'),
(77, '/transactions/purchases', 'Transactions Purchases'),
(78, '/transactions/sales', 'Transactions Sales');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientId`);

--
-- Indexes for table `expenses_categories`
--
ALTER TABLE `expenses_categories`
  ADD PRIMARY KEY (`ExpenseId`);

--
-- Indexes for table `expenses_daily_list`
--
ALTER TABLE `expenses_daily_list`
  ADD PRIMARY KEY (`DailyExpensesId`),
  ADD KEY `ExpenseId` (`ExpenseId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `products_ibfk_1` (`CategoryId`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `SupplierId` (`SupplierId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `purchases_invoices_details`
--
ALTER TABLE `purchases_invoices_details`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `InvoiceId` (`InvoiceId`);

--
-- Indexes for table `purchases_invoices_receipts`
--
ALTER TABLE `purchases_invoices_receipts`
  ADD PRIMARY KEY (`ReceiptId`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `ClientId` (`ClientId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `InvoiceId` (`InvoiceId`);

--
-- Indexes for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  ADD PRIMARY KEY (`ReceiptId`),
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subset_information_users`
--
ALTER TABLE `subset_information_users`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SupplierId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `GroupId` (`GroupId`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`GroupId`);

--
-- Indexes for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `GroupId` (`GroupId`),
  ADD KEY `PrivilegeId` (`PrivilegeId`);

--
-- Indexes for table `users_privileges`
--
ALTER TABLE `users_privileges`
  ADD PRIMARY KEY (`PrivilegeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses_categories`
--
ALTER TABLE `expenses_categories`
  MODIFY `ExpenseId` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_daily_list`
--
ALTER TABLE `expenses_daily_list`
  MODIFY `DailyExpensesId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `CategoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  MODIFY `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases_invoices_details`
--
ALTER TABLE `purchases_invoices_details`
  MODIFY `Id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases_invoices_receipts`
--
ALTER TABLE `purchases_invoices_receipts`
  MODIFY `ReceiptId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  MODIFY `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  MODIFY `Id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  MODIFY `ReceiptId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subset_information_users`
--
ALTER TABLE `subset_information_users`
  MODIFY `UserId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `GroupId` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  MODIFY `Id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `users_privileges`
--
ALTER TABLE `users_privileges`
  MODIFY `PrivilegeId` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses_daily_list`
--
ALTER TABLE `expenses_daily_list`
  ADD CONSTRAINT `expenses_daily_list_ibfk_1` FOREIGN KEY (`ExpenseId`) REFERENCES `expenses_categories` (`ExpenseId`),
  ADD CONSTRAINT `expenses_daily_list_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `products_categories` (`CategoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  ADD CONSTRAINT `purchases_invoices_ibfk_1` FOREIGN KEY (`SupplierId`) REFERENCES `suppliers` (`SupplierId`),
  ADD CONSTRAINT `purchases_invoices_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `purchases_invoices_details`
--
ALTER TABLE `purchases_invoices_details`
  ADD CONSTRAINT `purchases_invoices_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`),
  ADD CONSTRAINT `purchases_invoices_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `purchases_invoices` (`InvoiceId`);

--
-- Constraints for table `purchases_invoices_receipts`
--
ALTER TABLE `purchases_invoices_receipts`
  ADD CONSTRAINT `purchases_invoices_receipts_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `purchases_invoices` (`InvoiceId`),
  ADD CONSTRAINT `purchases_invoices_receipts_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  ADD CONSTRAINT `sales_invoices_ibfk_1` FOREIGN KEY (`ClientId`) REFERENCES `clients` (`ClientId`),
  ADD CONSTRAINT `sales_invoices_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  ADD CONSTRAINT `sales_invoices_details_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_invoices_details_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `sales_invoices` (`InvoiceId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  ADD CONSTRAINT `sales_invoices_receipts_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `sales_invoices` (`InvoiceId`),
  ADD CONSTRAINT `sales_invoices_receipts_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `subset_information_users`
--
ALTER TABLE `subset_information_users`
  ADD CONSTRAINT `subset_information_users_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`GroupId`) REFERENCES `users_groups` (`GroupId`);

--
-- Constraints for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  ADD CONSTRAINT `users_groups_privileges_ibfk_1` FOREIGN KEY (`GroupId`) REFERENCES `users_groups` (`GroupId`),
  ADD CONSTRAINT `users_groups_privileges_ibfk_2` FOREIGN KEY (`PrivilegeId`) REFERENCES `users_privileges` (`PrivilegeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
