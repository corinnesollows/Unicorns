-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2015 at 08:10 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pocket_unicorns`
--

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `breed_id` int(2) NOT NULL,
  `breed_name` varchar(20) NOT NULL,
  `breed_desc` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breed_id`, `breed_name`, `breed_desc`) VALUES
(1, 'Weather', 'Can control small amount of weather, such as a tiny storm cloud or a spark of lightning.'),
(2, 'Emotional', 'Can control your emotions making you even happier when they are happy, or more sad when they are more sad.'),
(3, 'Alicorn', 'Is a unicorn with wings. A mixed breed, half unicorn and half Pegasus.'),
(4, 'Cyborg', 'A unicorn with integrated technological components');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(5) NOT NULL,
  `unicorn_id` int(5) DEFAULT NULL,
  `item_id` int(5) DEFAULT NULL,
  `inventory_qoh` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `unicorn_id`, `item_id`, `inventory_qoh`) VALUES
(3, NULL, 1, 5),
(4, NULL, 2, 13),
(5, NULL, 3, 1),
(6, NULL, 4, 21),
(7, NULL, 8, 30),
(8, NULL, 9, 30),
(10, NULL, 13, 2),
(11, 1, NULL, 1),
(12, 4, NULL, 1),
(13, 5, NULL, 0),
(14, 6, NULL, 1),
(15, 7, NULL, 1),
(16, 10, NULL, 1),
(17, 11, NULL, 1),
(18, 12, NULL, 0),
(19, 14, NULL, 1),
(21, NULL, 14, 28);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(5) NOT NULL,
  `item_name` varchar(40) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  `item_color` varchar(20) DEFAULT NULL,
  `item_price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_type`, `item_color`, `item_price`) VALUES
(1, 'Glittered Water', 'Food', '', '15.00'),
(2, 'Horn Sharpener', 'Accessories', 'Multi	', '40.00'),
(3, 'Miniature Barn', 'Habitat', 'Red', '100.00'),
(4, 'Sparkles	', 'Food	', 'Multi', '20.00'),
(8, 'Comb', 'Accessories', 'Silver', '15.00'),
(9, 'Comb', 'Accessories', 'Gold', '15.00'),
(13, 'Comb', 'Accessories', 'Gold', '15.00'),
(14, 'Cloud', 'Food', 'White', '35.00');

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `add_inventory_item` AFTER INSERT ON `item` FOR EACH ROW insert into inventory (item_id, inventory_qoh) values (NEW.item_id, 1)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `message_desc` varchar(300) NOT NULL,
  `message_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message_desc`, `message_date`) VALUES
(1, 'My unicorn Silver has been very healthy and happy since our adoption. She loves swimming in glittered water!! ', '2015-11-03'),
(2, 'Johnny-Boi is the greatest unicorn a man could have!! So happy he''s gotten over his uni-flu last week. He''s healthier and happier than before!', '2015-11-30'),
(3, 'Pengis is a really hard worker, he''s always cleaning his wings.', '2015-11-22'),
(4, 'What''s the best kind of food for an alicorn?', '2015-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `pdate` date NOT NULL,
  `payment_id` int(5) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `pdate`, `payment_id`, `total`, `user_id`) VALUES
(17, '2015-11-27', 2, '30.00', 18),
(18, '2015-11-27', 2, '30.00', 18),
(19, '2015-11-27', 4, '760.00', 1),
(20, '2015-11-27', 4, '10560.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `order_id` int(11) NOT NULL,
  `inventory_id` int(5) NOT NULL,
  `order_line_quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`order_id`, `inventory_id`, `order_line_quantity`) VALUES
(17, 8, 2),
(18, 8, 2),
(19, 4, 19),
(20, 13, 1),
(20, 21, 16);

-- --------------------------------------------------------

--
-- Table structure for table `payment_card`
--

CREATE TABLE `payment_card` (
  `payment_id` int(5) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `cc_number` bigint(16) NOT NULL,
  `cc_name` varchar(40) NOT NULL,
  `cc_expiration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_card`
--

INSERT INTO `payment_card` (`payment_id`, `payment_method`, `customer_id`, `cc_number`, `cc_name`, `cc_expiration_date`) VALUES
(1, 'MasterCard', 9, 5104346812117209, 'Elsa Cato', '2016-02-19'),
(2, 'Visa', 18, 4716103597840320, 'Elizabeth Campbell', '2016-02-01'),
(3, 'MasterCard', 17, 4532199202894357, 'Harvey Tobler', '2015-10-18'),
(4, 'Visa', 1, 4929442128446717, 'Melanie Damilig', '2017-05-03'),
(5, 'MasterCard', 3, 5219317911856411, 'Corinne Jones-Hoyland', '2017-10-08'),
(6, 'Visa', 4, 4532978646007274, 'Claude Durand', '2019-08-23'),
(7, 'Visa', 5, 4916534105969763, 'Aubrey Compagnon', '2018-11-04'),
(8, 'Visa', 6, 4532916672659428, 'Madelene Demers', '2020-12-16'),
(9, 'Visa', 7, 4716268965349293, 'Denis Vincken', '2018-08-10'),
(10, 'Visa', 10, 4532519799311095, 'Michael Floyd', '2017-10-17'),
(11, 'MasterCard', 11, 5189743258078937, 'Elisa Parker', '2019-06-23'),
(12, 'MasterCard', 12, 5145587620000118, 'Michelle Eggleston', '2017-09-11'),
(13, 'MasterCard', 13, 5344693771608169, 'Donna Elrod', '2017-03-14'),
(14, 'Visa', 14, 4556669345405783, 'Heather Halliday', '2017-11-11'),
(15, 'MasterCard', 15, 5259980980106017, 'Jason Highland', '2017-02-12'),
(16, 'Visa', 16, 4539255301409464, 'Michel Paquette', '2017-06-16'),
(18, 'MasterCard', 26, 5551860070287213, 'Sue M. Pinney', '2020-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `unicorn`
--

CREATE TABLE `unicorn` (
  `u_id` int(5) NOT NULL,
  `u_name` varchar(40) NOT NULL,
  `u_gender` varchar(1) NOT NULL,
  `u_breed_id` int(2) NOT NULL,
  `u_age` int(5) DEFAULT NULL,
  `u_color` varchar(20) NOT NULL,
  `u_fee` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unicorn`
--

INSERT INTO `unicorn` (`u_id`, `u_name`, `u_gender`, `u_breed_id`, `u_age`, `u_color`, `u_fee`) VALUES
(1, 'Fred', 'M', 2, 874, 'Orange', '8000.00'),
(4, 'Cookie', 'F', 1, 12, 'Purple', '4000.00'),
(5, 'Larry', 'F', 3, 401, 'Silver', '10000.00'),
(6, 'Glittery', 'M', 3, 896, 'Gold', '10000.00'),
(7, 'Blue', 'M', 1, 532, 'Blue', '3000.00'),
(10, 'Porche', 'F', 2, 433, 'Grey', '10.00'),
(11, 'Matticolo', 'M', 3, 27, 'White', '99999.99'),
(12, 'Comb', 'M', 1, 17, 'Alizarin Crimson', '4320.50'),
(14, 'Zayn', 'M', 4, 222, 'Bronze', '50000.00');

--
-- Triggers `unicorn`
--
DELIMITER $$
CREATE TRIGGER `add_inventory_unicorn` AFTER INSERT ON `unicorn` FOR EACH ROW insert into inventory (unicorn_id, inventory_qoh) values (NEW.u_id, 1)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(8) NOT NULL,
  `address` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(40) NOT NULL,
  `province` varchar(2) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `phone_number` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `password`, `user_type`, `address`, `city`, `province`, `postal_code`, `phone_number`) VALUES
(1, 'Melanie-Joy', 'Damilig', 'melanie@email.com', '$2y$10$KJb/w60FsgdIvMKTKW6xSe8auAT9ILL5gKUAzJUGIQ6Vg067ikSbK', 'admin', '81 Papineau Avenue', 'Montreal', 'QC', 'H2G2X7', '514-577-7050'),
(3, 'Corinne', 'Jones-Hoyland', 'corinne@email.com', '$2y$10$YfFiG6LEh0E/CRn6mFmKuu5WLyvaQAEXACKFaswRtG4g1hwJnd6dS', 'admin', '351 Ste. Catherine Ouest', 'Montreal', 'QC', 'H2A2Z3', '514-777-7912'),
(4, 'Claude', 'Durand', 'claudedurand@teleworm.us', '$2y$10$3Hpq/VqB9kWYv2rXdeTADu3i/x.vTsaJ0oRIiHvjS/4PooXkS3bZa', 'customer', '3377 rue Levy', 'Montreal', 'QC', 'H3C5K4', '514-891-7395'),
(5, 'Aubrey', 'Compagnon', 'aubreycompagnon@armyspy.com', '$2y$10$yZlpuCGrsF7fUv5K..x0.OdKwTvwM2nLi6JehnAOnORz0mTizav4.', 'customer', '2854 avenue Royale', 'Quebec', 'QC', 'G1S1C1', '418-948-9473'),
(6, 'Madelene', 'Demers', 'madelenedemers@dayrep.com', '$2y$10$RTtQllQM.In2BSRXRLZN2upjYwzPRxD3cSmxOZmk1SCzYaLx8JO1q', 'customer', '4144 Rue King', 'Sherbrooke', 'QC', 'J1H1R4', '819-564-3003'),
(7, 'Denis', 'Vincken', 'DenisVincken@dayrep.com', '$2y$10$LEbCEs2UkBAbwEjA684A2ONal0TfVy9IN96E50hQQk5ae7VMKSfma', 'customer', '4082 avenue Royale', 'Ste Foy', 'QC', 'G1V2L2', '418-380-3553'),
(9, 'Elsa', 'Cato', 'ElsaRCato@teleworm.us', '$2y$10$sZc0i/7wAILkvDH2Z5cd.uKPV/3ryb4ztJcTdCbWN2IwncT0dCFcq', 'customer', '4957 rue des Églises Est', 'Ste Cecile De Masham', 'QC', 'J0X2W0', '819-456-3309'),
(10, 'Michael', 'Floyd', 'mfloyd@rhyta.com', '$2y$10$WKFm1UEaflx14RsdaOXR9eqAmqD.O8del/9NBEiRph85C4/sQEq9G', 'customer', '882 rue Parc', 'Sherbrooke', 'QC', 'J1H1R6', '819-571-1357'),
(11, 'Elisa', 'Parker', 'SandraHCaldwell@dayrep.com', '$2y$10$cV8ky/Q/Fp8uBFTOpsS.fu0Gf1PVZP398IwOz2DPMpSjD.43oWagG', 'customer', '1683 rue Boulay', 'St Hugues', 'QC', 'J0H1N0', '450-794-7668'),
(12, 'Michelle', 'Eggleston', 'MichelleEggleston@teleworm.us', '$2y$10$6ajTaAgWgcNwvF3rA037Du6fv7S32VteOcf/QrNAFgiIQmGFexb5a', 'customer', '3200 Scarth Street', 'Montreal', 'QC', 'S4P3Y2', '514-369-6843'),
(13, 'Donna', 'Elrod', 'DonnaDElrod@rhyta.com', '$2y$10$3TuiWZbfNYOKlwk6.bo0e.4p.NAmgIKFC6IQrY.9ku61vqwjZb4ZS', 'customer', '1864 Papineau Avenue', 'Montreal', 'QC', 'H2K4J5', '514-827-9216'),
(14, 'Heather ', 'Halliday', 'HeatherHalliday@gmail.com', '$2y$10$W4cScl8iQNSPG2L8w9/XM./cYg6ckm3cNH1dURGmwlG6.3Conh8Ym', 'customer', '2956 Terry Fox Dr', 'Fillmore', 'SK', 'S4P3Y2', '306-722-0988'),
(15, 'Jason', 'Highland', 'jland@jourrapide.com', '$2y$10$MkEkMidFGb9jUtO3EeLUe.DaG7w2ibqjcmLkxIhThRVFC4P1apXq.', 'customer', '2552 49th Avenue', 'Clyde River', 'NU', 'X0A0E0', '867-924-0687'),
(16, 'Michelle', 'Paquette', 'glitter4ever@pocketunicorns.ca', '$2y$10$ib7mQ4Wo0u15mPXDNsQSyeVOszmfwl4PR/fAKPaTZE4lf2HdVQmHu', 'admin', '821 Sainte-Croix', 'Saint Laurent', 'QC', 'H4L3X9', '514-744-7500'),
(17, 'Harvey', 'Tobler', 'HarveyDTobler@rhyta.com', '$2y$10$sAhTbVwlBKTKCOuaOkAuyOgnvJh7kHD7speesessb0CQEQaBFM1zS', 'customer', '2918 René-Lévesque Blvd', 'Montreal', 'QC', 'H3B4W8', '5145777050'),
(18, 'Elizabeth', 'Campbell', 'elizabethcampbell@hotmail.com', '$2y$10$JcAog9SvzR1V7YrU00ex6O6/kMKOiya6q1a3f9Q85WtDCDcgJmxzi', 'customer', '1798 St Marys Rd', 'Winnipeg', 'MB', 'R2X2Y7', '204-399-7320'),
(26, 'Sue', 'Pinney', 'sue-pinney@yahoo.ca', '$2y$10$ChmI3Ouxl5R..6f5cEvAXebbUP1A0DS.m7XPLEEgvKKUzoeTZoSMO', 'customer', '4879 Yonge Street', 'Toronto', 'ON', 'M4W1J7', '416-355-6480');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breed_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `unicorn_id` (`unicorn_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_id`,`inventory_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `payment_card`
--
ALTER TABLE `payment_card`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `unicorn`
--
ALTER TABLE `unicorn`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_breed_id` (`u_breed_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `CUSTOMER_EMAIL_UK` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breed_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `payment_card`
--
ALTER TABLE `payment_card`
  MODIFY `payment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `unicorn`
--
ALTER TABLE `unicorn`
  MODIFY `u_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`unicorn_id`) REFERENCES `unicorn` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment_card` (`payment_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_card`
--
ALTER TABLE `payment_card`
  ADD CONSTRAINT `payment_card_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `unicorn`
--
ALTER TABLE `unicorn`
  ADD CONSTRAINT `unicorn_ibfk_1` FOREIGN KEY (`u_breed_id`) REFERENCES `breed` (`breed_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
