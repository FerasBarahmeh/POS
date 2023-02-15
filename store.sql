-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 05:01 PM
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
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `CategoryId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Image` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_list`
--

CREATE TABLE `products_list` (
  `ProductId` int(10) UNSIGNED NOT NULL,
  `CategoryId` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` varchar(30) DEFAULT NULL,
  `Quantity` smallint(5) UNSIGNED NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `BarCode` char(20) DEFAULT NULL,
  `unit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `TransferedTo` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_invoices`
--

CREATE TABLE `sales_invoices` (
  `InvoiceId` int(10) UNSIGNED NOT NULL,
  `ClientId` int(10) UNSIGNED NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL,
  `Created` date NOT NULL,
  `Discount` decimal(8,2) DEFAULT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `TransferedTo` varchar(30) DEFAULT NULL,
  `created` date NOT NULL,
  `UserId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subset_information_users`
--

CREATE TABLE `subset_information_users` (
  `UserId` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(10) NOT NULL,
  `LastName` varchar(10) NOT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `BOD` date DEFAULT NULL,
  `Image` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(49, 'admin', '$2a$07$yeNCSNwRpYopOhv0TrrReO.CgBLQTGn6YYr1a96YlnBHx6bYBpe7.', 'feras@feras.com', '2023-02-15 14:12:51', '2023-02-15 15:36:16', 7, '0785102996', 1),
(50, 'accountant', '$2a$07$yeNCSNwRpYopOhv0TrrReO.CgBLQTGn6YYr1a96YlnBHx6bYBpe7.', 'feras@f.com', '2023-02-15 14:49:33', '2023-02-15 15:37:02', 9, '0785102996', 1),
(56, 'ferasbarahme', '$2a$07$yeNCSNwRpYopOhv0TrrReO.CgBLQTGn6YYr1a96YlnBHx6bYBpe7.', 'feras345@gmail.com', '2023-02-15 16:53:19', '2023-02-15 16:53:19', 9, '0785102996', 1);

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
(42, 9, 38);

-- --------------------------------------------------------

--
-- Table structure for table `users_privileges`
--

CREATE TABLE `users_privileges` (
  `PrivilegeId` tinyint(3) UNSIGNED NOT NULL,
  `Privilege` varchar(20) NOT NULL,
  `PrivilegeTitle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_privileges`
--

INSERT INTO `users_privileges` (`PrivilegeId`, `Privilege`, `PrivilegeTitle`) VALUES
(36, 'privileges\\add', 'Add privileges'),
(38, 'reports\\add', 'Add reports'),
(40, 'products\\delete', 'Delete Product'),
(41, 'suppliers\\add', 'create new supplier'),
(42, 'suppliers\\edit', 'Edit information supplier'),
(43, 'suppliers\\delete', 'delete supplier'),
(44, 'users\\add', 'Add new user'),
(45, 'users\\delete', 'Delete use'),
(46, 'users\\edit', 'Edit user information');

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
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `products_list`
--
ALTER TABLE `products_list`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `CategoryId` (`CategoryId`);

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
  MODIFY `ClientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `CategoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_list`
--
ALTER TABLE `products_list`
  MODIFY `ProductId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases_invoices`
--
ALTER TABLE `purchases_invoices`
  MODIFY `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases_invoices_details`
--
ALTER TABLE `purchases_invoices_details`
  MODIFY `Id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases_invoices_receipts`
--
ALTER TABLE `purchases_invoices_receipts`
  MODIFY `ReceiptId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_invoices`
--
ALTER TABLE `sales_invoices`
  MODIFY `InvoiceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_invoices_details`
--
ALTER TABLE `sales_invoices_details`
  MODIFY `Id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_invoices_receipts`
--
ALTER TABLE `sales_invoices_receipts`
  MODIFY `ReceiptId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subset_information_users`
--
ALTER TABLE `subset_information_users`
  MODIFY `UserId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SupplierId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `GroupId` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  MODIFY `Id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users_privileges`
--
ALTER TABLE `users_privileges`
  MODIFY `PrivilegeId` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
-- Constraints for table `products_list`
--
ALTER TABLE `products_list`
  ADD CONSTRAINT `products_list_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `products_categories` (`CategoryId`);

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
  ADD CONSTRAINT `purchases_invoices_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products_list` (`ProductId`),
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
  ADD CONSTRAINT `sales_invoices_details_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `products_list` (`ProductId`),
  ADD CONSTRAINT `sales_invoices_details_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `purchases_invoices` (`InvoiceId`);

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
  ADD CONSTRAINT `subset_information_users_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

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
