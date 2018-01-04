-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2017 at 11:50 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_setting`
--

CREATE TABLE `application_setting` (
  `id` int(11) NOT NULL,
  `expense_from_date` int(11) DEFAULT NULL,
  `expense_to_date` int(11) DEFAULT NULL,
  `custodies_from_date` int(11) DEFAULT NULL,
  `custodies_to_date` int(11) DEFAULT NULL,
  `payment_from_date` int(11) DEFAULT NULL,
  `payment_to_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `application_setting`
--

INSERT INTO `application_setting` (`id`, `expense_from_date`, `expense_to_date`, `custodies_from_date`, `custodies_to_date`, `payment_from_date`, `payment_to_date`) VALUES
(0, 60, 60, 60, 60, 60, 60);

-- --------------------------------------------------------

--
-- Table structure for table `custoder`
--

CREATE TABLE `custoder` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `notes` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flag`
--

CREATE TABLE `flag` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flag`
--

INSERT INTO `flag` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'مقدم', '2017-10-25 15:00:30', NULL),
(2, 'قسط', '2017-10-25 15:24:42', NULL),
(3, 'دفعة إستلام', '2017-10-25 15:24:42', NULL),
(4, 'مصروف خزينة', '2017-10-25 22:31:19', NULL),
(5, 'مصروف من عهده', '2017-10-25 22:31:19', NULL),
(6, 'إضافة عهده', '2017-10-25 22:31:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `months_tbl`
--

CREATE TABLE `months_tbl` (
  `id` int(11) DEFAULT NULL,
  `ar_name` varchar(45) DEFAULT NULL,
  `eng_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `months_tbl`
--

INSERT INTO `months_tbl` (`id`, `ar_name`, `eng_name`) VALUES
(1, 'يناير', 'January'),
(2, 'فبراير', 'February'),
(3, 'مارس', 'March'),
(4, 'أبريل', 'April'),
(5, 'مايو', 'May'),
(6, 'يونيو', 'June'),
(7, 'يوليه', 'July'),
(8, 'أغسطس', 'August'),
(9, 'سبتمبر', 'September'),
(10, 'أكتوبر', 'October'),
(11, 'نوفمبر', 'November'),
(12, 'ديسمبر', 'December');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `owner_has_property`
--

CREATE TABLE `owner_has_property` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `contract_date` date NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `area` varchar(45) NOT NULL,
  `price` varchar(45) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `tower_id` int(11) NOT NULL,
  `property_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `tower`
--

CREATE TABLE `tower` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `layers` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `site_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `date_1` date DEFAULT NULL,
  `date_2` date DEFAULT NULL,
  `value` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `removed` tinyint(1) DEFAULT NULL,
  `flag_id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `custoder_id` int(11) DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nickname`, `role`, `create_time`, `update_time`) VALUES
(1, '1', '1', 'العزازي', 1, '2017-10-18 10:56:57', NULL);
--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_setting`
--
ALTER TABLE `application_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custoder`
--
ALTER TABLE `custoder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flag`
--
ALTER TABLE `flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner_has_property`
--
ALTER TABLE `owner_has_property`
  ADD PRIMARY KEY (`id`,`owner_id`,`property_id`,`users_id`),
  ADD KEY `fk_owner_has_property_property1_idx` (`property_id`),
  ADD KEY `fk_owner_has_property_owner1_idx` (`owner_id`),
  ADD KEY `fk_owner_has_property_users1_idx` (`users_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`,`tower_id`,`property_type_id`),
  ADD KEY `fk_property_tower_idx` (`tower_id`),
  ADD KEY `fk_property_property_type1_idx` (`property_type_id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tower`
--
ALTER TABLE `tower`
  ADD PRIMARY KEY (`id`,`site_id`),
  ADD KEY `fk_tower_site1_idx` (`site_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaction_flag1_idx` (`flag_id`),
  ADD KEY `fk_transaction_property1_idx` (`property_id`),
  ADD KEY `fk_transaction_owner1_idx` (`owner_id`),
  ADD KEY `fk_transaction_site1_idx` (`site_id`),
  ADD KEY `fk_transaction_custoder1_idx` (`custoder_id`),
  ADD KEY `fk_transaction_users1_idx` (`users_id`),
  ADD KEY `fk_transaction_reason1_idx` (`reason_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `custoder`
--
ALTER TABLE `custoder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `flag`
--
ALTER TABLE `flag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `owner_has_property`
--
ALTER TABLE `owner_has_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `tower`
--
ALTER TABLE `tower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `owner_has_property`
--
ALTER TABLE `owner_has_property`
  ADD CONSTRAINT `fk_owner_has_property_owner1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owner_has_property_property1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owner_has_property_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `fk_property_property_type1` FOREIGN KEY (`property_type_id`) REFERENCES `property_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_property_tower` FOREIGN KEY (`tower_id`) REFERENCES `tower` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tower`
--
ALTER TABLE `tower`
  ADD CONSTRAINT `fk_tower_site1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_transaction_custoder1` FOREIGN KEY (`custoder_id`) REFERENCES `custoder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_flag1` FOREIGN KEY (`flag_id`) REFERENCES `flag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_owner1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_property1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_reason1` FOREIGN KEY (`reason_id`) REFERENCES `reason` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_site1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
