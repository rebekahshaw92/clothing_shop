-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 02, 2021 at 11:29 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ClothingShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
    `BrandName` varchar(50) NOT NULL,
  `ItemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemType` varchar(50) NOT NULL,
  `BrandID` varchar(50) NOT NULL,
  `Colour` varchar(50) NOT NULL,
  `Size` varchar(5) NOT NULL,
  `Price` double(9,2) NOT NULL,
  `Stock` varchar(20) NOT NULL,
  `Code` varchar(100) NOT NULL,
  `ItemImage` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `ItemName`, `ItemType`, `BrandID`, `Colour`, `Size`, `Price`, `Stock`, `Code`, `ItemImage`) VALUES
(1, 'top', 'Mr', 'Mr', 'blue', '14', 20.45, 'Mr', '', 'pexels-simple-models-3873503.jpg'),
(2, 'Top', 'Mr', 'Mr', 'blue', '14', 30.00, 'Mr', '', 'pexels-simple-models-3873503.jpg'),
(7, 'Dress', 'Mr', 'Mr', 'white', '12', 45.00, 'Mr', '', 'pexels-simple-models-3873503.jpg'),
(8, 'Dress', 'Mr', 'Mr', 'blue', '16', 24.99, 'Mr', '', 'pexels-simple-models-3873503.jpg'),
(9, 'Coat', 'Mr', 'Mr', 'Green', '18', 50.99, 'Mr', '', 'pexels-simple-models-3873503.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderDetails`
--

CREATE TABLE `orderDetails` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderPersonID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderItem`
--

CREATE TABLE `OrderItem` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderPerson`
--
CREATE TABLE `OrderPerson` (
  `OrderPersonID` int(11) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OrderPerson`
--

INSERT INTO `OrderPerson` (`OrderPersonID`, `Email`, `FirstName`, `LastName`) VALUES
(1, 'bob@yahoo.co.uk', 'bob', 'brown'),
(4, 'emma@yahoo.co.uk', 'emma', 'black'),
(5, 'bob@yahoo.co.uk', 'bob', 'brown'),
(23, 'bob23@yahoo.com', 'bob', 'brown'),
(24, 'emma@yahoo.co.uk', 'emma', 'brown'),
(25, 'emma@yahoo.co.uk', 'emma', 'brown'),
(26, 'emma@yahoo.co.uk', 'emma', 'brown'),
(27, 'emma@yahoo.co.uk', 'emma', 'brown');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `OrderNumber` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `UserID` varchar(11) NOT NULL,
  `PaymentID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CardNumber` varchar(50) NOT NULL,
  `ExpDate` varchar(20) NOT NULL,
  `CardHolder` varchar(50) NOT NULL,
  `DatePayed` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `UserID`, `CardNumber`, `ExpDate`, `CardHolder`, `DatePayed`) VALUES
(7, 23, '123456789', '11/12/2022', 'Bob brown', '2021-04-29'),
(8, 24, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30'),
(9, 25, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30'),
(10, 25, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30'),
(11, 26, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30'),
(12, 26, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30'),
(13, 27, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30'),
(14, 27, '123456789', '11/12/2023', 'Emma Brown', '2021-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `PersonAddress`
--

CREATE TABLE `PersonAddress` (
  `PersonAddressID` int(11) NOT NULL,
 `OrderPersonID` int(11) NOT NULL,
  `Address1` varchar(256) NOT NULL,
  `Address2` varchar(256) NOT NULL,
  `Country` varchar(256) NOT NULL,
  `State` varchar(256) NOT NULL,
  `Postcode` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PersonAddress`
--

INSERT INTO `PersonAddress` (`PersonAddressID`, `OrderPersonID`, `Address1`, `Address2`, `Country`, `State`, `Postcode`) VALUES
(8, 23, '1234 Main Street', '', 'United States', 'Califormia', 'bt67 8pq'),
(9, 24, '1234 Main Street', '', 'United States', 'Califormia', 'bt67 8pq'),
(10, 25, '1234 Main Street', '', 'United States', 'Califormia', 'bt67 8pq'),
(11, 26, '1234 Main Street', '', 'United States', 'Califormia', 'bt67 8pq'),
(12, 27, '1234 Main Street', '', 'United States', 'Califormia', 'bt67 8pq');

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE `Transactions` (
  `TransactionsID` int(11) NOT NULL,
  `Type` smallint(11) NOT NULL,
  `Total` varchar(256) NOT NULL,
  `Status` smallint(1) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Title` varchar(5) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `DataOfBirth` varchar(10) NOT NULL,
  `ContactNumber` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Address2` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Postcode` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Title`, `FirstName`, `LastName`, `Email`, `Password`, `DataOfBirth`, `ContactNumber`, `Address`, `Address2`, `Country`, `Postcode`) VALUES
(2, 'miss', 'Emma', 'Black', 'emma@yahoo.co.uk', 'Password1', '09/09/1990', '+44 5342 234567', '1 Bubble', 'Road', 'Antrim', 'BT65 8QA'),
(4, 'Mr', 'John', 'Brown', 'johnb@yahoo.com', 'Password1', '09/08/1990', '+44 5342 234567', '11 Bubble', 'Road', 'Antrim', 'BT65 1QA'),
(5, 'Miss', 'Jane', 'White', 'Jane123@yahoo.com', 'Password123', '01/09/1994', '+44 5342 234567', '11 Bubble', 'Road', 'Antrim', 'BT65 6RD'),
(6, 'Mrs', 'Sam', 'Green', 'sam34@yahoo.com', 'Password123', '02/09/1994', '+44 5342 234567', '9 Brown', 'Road', 'Ballymena', 'BT67 8DF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `orderDetails`
--
ALTER TABLE `orderDetails`
  ADD PRIMARY KEY (`OrderDetailID`);

--
-- Indexes for table `OrderItem`
--
ALTER TABLE `OrderItem`
  ADD PRIMARY KEY (`OrderItemID`);

--
-- Indexes for table `OrderPerson`
--
ALTER TABLE `OrderPerson`
  ADD PRIMARY KEY (`OrderPersonID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `PersonAddress`
--
ALTER TABLE `PersonAddress`
  ADD PRIMARY KEY (`PersonAddressID`);

--
-- Indexes for table `Transactions`
--
ALTER TABLE `Transactions`
  ADD PRIMARY KEY (`TransactionsID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `orderDetails`
--
ALTER TABLE `orderDetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `OrderItem`
--
ALTER TABLE `OrderItem`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `OrderPerson`
--
ALTER TABLE `OrderPerson`
  MODIFY `OrderPersonID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `PersonAddress`
--
ALTER TABLE `PersonAddress`
  MODIFY `PersonAddressID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Transactions`
--
ALTER TABLE `Transactions`
  MODIFY `TransactionsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
