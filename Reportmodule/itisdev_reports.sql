-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 05:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itisdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--


-- --------------------------------------------------------

--
-- Table structure for table `expired`
--
--
-- Dumping data for table `expired`
--

INSERT INTO `expired` (`expiredID`, `ingredientID`, `quantity`, `expiredDate`, `updatedBy`) VALUES
(1, 2001, 2, '2023-06-12 00:00:00', NULL),
(2, 2002, 2, '2023-06-13 00:00:00', NULL),
(3, 2003, 1, '2023-06-14 00:00:00', NULL),
(4, 2004, 3, '2023-06-19 00:00:00', NULL),
(5, 2001, 4, '2023-06-13 00:00:00', NULL),
(6, 2002, 3, '2023-06-19 00:00:00', NULL),
(7, 2003, 2, '2023-06-12 00:00:00', NULL),
(8, 2004, 5, '2023-06-14 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

--
-- Dumping data for table `ingredient`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
--
-- Dumping data for table `orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--
--
-- Dumping data for table `order_item`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

--
-- Dumping data for table `recipe`
--



-- --------------------------------------------------------

--
-- Table structure for table `replenish`
--

--
-- Dumping data for table `replenish`
--

INSERT INTO `replenish` (`transactionID`, `ingredientID`, `quantity`, `boughtDate`, `createBy`) VALUES
(11, 2001, 4, '2023-06-12 00:00:00', NULL),
(12, 2002, 7, '2023-06-13 00:00:00', NULL),
(13, 2003, 3, '2023-06-13 00:00:00', NULL),
(14, 2004, 6, '2023-06-14 00:00:00', NULL),
(15, 2003, 8, '2023-06-14 00:00:00', NULL),
(16, 2001, 10, '2023-06-18 00:00:00', NULL),
(17, 2002, 10, '2023-06-18 00:00:00', NULL),
(19, 2004, 10, '2023-06-18 00:00:00', NULL),
(20, 2003, 10, '2023-06-18 00:00:00', NULL),
(21, 2001, 5, '2023-06-19 00:00:00', NULL),
(22, 2001, 5, '2023-06-19 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`dishID`);

--
-- Indexes for table `expired`
--
ALTER TABLE `expired`
  ADD PRIMARY KEY (`expiredID`),
  ADD KEY `fk_02` (`ingredientID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredientID`),

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `order_item_ibfk_1` (`orderID`),
  ADD KEY `order_item_ibfk_2` (`dishID`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `fk01` (`ingredientID`),
  ADD KEY `fk02` (`dishID`);

--
-- Indexes for table `replenish`
--
ALTER TABLE `replenish`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `fk_01` (`ingredientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `dishID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `expired`
--
ALTER TABLE `expired`
  MODIFY `expiredID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2005;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3005;

--
-- AUTO_INCREMENT for table `replenish`
--
ALTER TABLE `replenish`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expired`
--
ALTER TABLE `expired`
  ADD CONSTRAINT `fk_02` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`);

--
-- Constraints for table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `fk01` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`),
  ADD CONSTRAINT `fk02` FOREIGN KEY (`dishID`) REFERENCES `dish` (`dishID`);

--
-- Constraints for table `replenish`
--
ALTER TABLE `replenish`
  ADD CONSTRAINT `fk_01` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
