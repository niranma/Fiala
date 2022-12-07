-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 03:51 AM
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
-- Database: `beer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `id`) VALUES
('21232f297a57a5a743894a0e4a801fc3', '5f4dcc3b5aa765d61d8327deb882cf99', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID` int(10) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Picture` varchar(50) DEFAULT NULL,
  `description` varchar(700) DEFAULT NULL,
  `Link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `Name`, `Price`, `Picture`, `description`, `Link`) VALUES
(1, 'Grown Up Grilled Cheese', 6, 'GrownUpGrilledCheese.jpg', 'Artisan sourdough, havarti, cheddar, bacon & tomato\r\n\r\n', ''),
(6, 'Philly', 7, 'philly.jpg', 'Artisan sourdough, steak, peppers, onions, mozzarella & provolone.\r\n\r\n', ''),
(7, 'Portobella', 7, 'portobella.jpg', 'Artisan Italian bread, roasted portobella, fire roasted peppers, spinach/arugula, provolone & goat cheese.\r\n', ''),
(8, 'Meatball Parm', 6, 'meatballparm.jpg', 'Artisan Italian bread, meatballs, marinara, mozzarella, provolone & parmesan.', ''),
(9, 'Cuban', 7, 'cuban.jpg', 'Artisan sourdough, pulled pork, ham, pickled red onions, pickles, havarti, monterrey jack & stone mustard.', ''),
(10, 'Itlain', 6, 'italian.jpg', 'Artisan Italian bread, ham, salami, pepperoni, mozzarella, provolone & giardiniera.', ''),
(11, 'Italian Beef', 7, 'italianbeef.jpg', 'Artisan Italian bread, Italian beef, mozzarella, provolone & giardiniera\r\n\r\n', ''),
(12, 'Buffalo Chicken', 7, 'buffalochicken.jpg', 'Artisan sourdough, grilled chicken, buffalo sauce, mozzarella, provolone & a drizzle of Ranch.', ''),
(13, 'Everyday Grilled Cheese', 5, 'EverydayGrilledCheese.jpg', 'Artisan Italian bread, havarti, cheddar & monterrey jack.', ''),
(14, 'Memphis', 7, 'memphis.jpg', 'Artisan sourdough, cheddar, pulled pork, BBQ sauce & slaw to top sandwich\r\n\r\n', ''),
(15, 'Caprese', 7, 'caprese.jpg', 'Paesano Bread, Fresh Mozzarella, Provolone, Tomato, Fresh Basil\r\n\r\n', ''),
(16, 'Chicken Bacon Ranch', 7, 'chickenbaconranch.jpg', 'Sourdough Bread topped with Grilled Chicken, Sliced Bacon, Provolone, Swiss, and a drizzle of Ranch.', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
