-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 12:14 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(3) NOT NULL,
  `car_name` varchar(30) NOT NULL,
  `brand_id` int(3) NOT NULL,
  `type_id` int(3) NOT NULL,
  `color` varchar(20) NOT NULL,
  `model` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_name`, `brand_id`, `type_id`, `color`, `model`, `description`) VALUES
(5, 'Audi', 1, 1, 'Blue', 'Audi 2021', 'A new German Machine with Efficiency and Manual Transmission'),
(6, 'Mercedes', 2, 2, 'White', 'Mercedes 2021', 'A new China Machine with Efficiency and Manual Transmission'),
(7, 'Nissan GTR', 3, 11, 'Yellow', 'GTR 2020', 'A new German Machine with Efficiency and Manual Transmission'),
(8, 'Auris', 6, 10, 'White', 'Auris 2020', 'A new Machine with Efficiency and Manual Transmission'),
(9, 'Richard', 4, 9, 'Black', '2020', 'Air Conditioner Anti-Lock Braking System Power Steering Power Windows CD Player Leather Seats Centra'),
(10, 'LandCruiser', 11, 12, 'Grey', '2021', 'Air Conditioner Anti-Lock Braking System Power Steering Power Windows CD Player Leather Seats Centra');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `brand_id` int(3) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`brand_id`, `brand_name`, `brand_image`) VALUES
(1, 'Audi', '69149_20130101_002221.jpg'),
(2, 'Mercedes', '51956_reservation-bg.jpg'),
(3, 'Nissan GTR', '25933_20130101_001451.jpg'),
(4, 'Lamborghini', '63492_home_bg.jpg'),
(5, 'Honda', '55487_20130101_001451.jpg'),
(6, 'Auris', '1406_20130101_002404.jpg'),
(7, 'Bantos', '44025_cab_me_logo.png'),
(11, 'Richard', '52673_reservation-banner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `car_types`
--

CREATE TABLE `car_types` (
  `type_id` int(3) NOT NULL,
  `type_label` varchar(50) NOT NULL,
  `type_description` varchar(250) NOT NULL,
  `type_image` varchar(255) NOT NULL,
  `price_per_day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_types`
--

INSERT INTO `car_types` (`type_id`, `type_label`, `type_description`, `type_image`,`price_per_day`) VALUES
(1, 'Audi', 'Air Conditioner	\r\nAnti-Lock Braking System	\r\nPower Steering	\r\nPower Windows	\r\nCD Player	\r\nLeather Seats	\r\nCentral Locking	\r\nPower Door Locks	\r\nBrake Assist	\r\nDriver Airbag	\r\nPassenger Airbag	\r\nCrash Sensor', '29932_Audi-A4-Avant-1.jpg','KSh 1,000'),
(2, 'Mercedes', '\r\nAir Conditioner	\r\nAnti-Lock Braking System	\r\nPower Steering	\r\nPower Windows	\r\nCD Player	\r\nLeather Seats	\r\nCentral Locking	\r\nPower Door Locks	\r\nBrake Assist	\r\nDriver Airbag	\r\nPassenger Airbag	\r\nCrash Sensor', 'Mercedes-C-Class-Estate-1.jpg','KSh 5,000'),
(9, 'Lamborghini', '\r\nAir Conditioner	\r\nAnti-Lock Braking System	\r\nPower Steering	\r\nPower Windows	\r\nCD Player	\r\nLeather Seats	\r\nCentral Locking	\r\nPower Door Locks	\r\nBrake Assist	\r\nDriver Airbag	\r\nPassenger Airbag	\r\nCrash Sensor', '63492_home_bg.jpg','KSh 3,000'),
(10, 'Auris', '\r\nAir Conditioner	\r\nAnti-Lock Braking System	\r\nPower Steering	\r\nPower Windows	\r\nCD Player	\r\nLeather Seats	\r\nCentral Locking	\r\nPower Door Locks	\r\nBrake Assist	\r\nDriver Airbag	\r\nPassenger Airbag	\r\nCrash Sensor', '53109_ToyotaCelica.jpg','KSh 10,000'),
(11, 'Nissan GTR', '\r\nAir Conditioner	\r\nAnti-Lock Braking System	\r\nPower Steering	\r\nPower Windows	\r\nCD Player	\r\nLeather Seats	\r\nCentral Locking	\r\nPower Door Locks	\r\nBrake Assist	\r\nDriver Airbag	\r\nPassenger Airbag	\r\nCrash Sensor', 'bmw-3-series-sedan.jpg','KSh 7,000'),
(12, 'Benz', '\r\nAir Conditioner	\r\nAnti-Lock Braking System	\r\nPower Steering	\r\nPower Windows	\r\nCD Player	\r\nLeather Seats	\r\nCentral Locking	\r\nPower Door Locks	\r\nBrake Assist	\r\nDriver Airbag	\r\nPassenger Airbag	\r\nCrash Sensor', '40550_bmw-3-series-sedan.jpg','KSh 15,000'),
(40, 'Maruti', '\r\nAir Conditioner \r\nAnti-Lock Braking System \r\nPower Steering \r\nPower Windows \r\nCD Player \r\nLeather Seats \r\nCentral Locking \r\nPower Door Locks \r\nBrake Assist \r\nDriver Airbag \r\nPassenger Airbag \r\nCrash Sensor', '80054_home_bg.jpg','KSh 2,000'),
(41, 'Nissan', '\r\nAir Conditioner \r\nAnti-Lock Braking System \r\nPower Steering \r\nPower Windows \r\nCD Player \r\nLeather Seats \r\nCentral Locking \r\nPower Door Locks \r\nBrake Assist \r\nDriver Airbag \r\nPassenger Airbag \r\nCrash Sensor', '87108_20130101_002135.jpg','KSh 1,000'),
(42, 'Landcruiser', '\r\nAir Conditioner \r\nAnti-Lock Braking System \r\nPower Steering \r\nPower Windows \r\nCD Player \r\nLeather Seats \r\nCentral Locking \r\nPower Door Locks \r\nBrake Assist \r\nDriver Airbag \r\nPassenger Airbag \r\nCrash Sensor', '68054_Honda.jpg','KSh 5,000');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(10) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `full_name`, `client_email`, `client_phone`) VALUES
(1, 'Thomas Kiluu', 'haime@gmail.com', '07404583198'),
(6, 'Richard M', 'haime@gmail.com', '07123456789'),
(7, 'Richard M', 'haime@gmail.com', '07123456789'),
(8, 'Richard M', 'haime@gmail.com', '07123456789'),
(9, 'Richard M', 'haime@gmail.com', '07123456789'),
(11, 'Richard M', 'haime@gmail.com', '07123456789'),
(12, 'Jack', 'jack@gmail.com', '321036160330'),
(13, 'Jack', 'jack@gmail.com', '321036160330'),
(14, 'Jack', 'jack@gmail.com', '321036160330'),
(15, 'Jack', 'jack@gmail.com', '321036160330');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `car_id` int(3) NOT NULL,
  `pickup_date` date NOT NULL,
  `return_date` date NOT NULL,
  `pickup_location` varchar(50) NOT NULL,
  `return_location` varchar(50) NOT NULL,
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `client_id`, `car_id`, `pickup_date`, `return_date`, `pickup_location`, `return_location`, `canceled`, `cancellation_reason`) VALUES
(6, 6, 5, '2021-08-05', '2021-08-07', 'Tala', 'Tala', 1, ''),
(7, 7, 6, '2021-08-05', '2021-08-07', 'q', 'q', 1, ''),
(8, 8, 7, '2021-08-05', '2021-08-07', 'q', 'q', 1, ''),
(9, 9, 8, '2021-08-05', '2021-08-07', 'q', 'q', 1, ''),
(10, 11, 5, '2021-08-05', '2021-08-07', 'q', 'q', 1, ''),
(11, 12, 5, '2021-08-06', '2021-08-12', 'tala', 'tala', 0, NULL),
(12, 13, 5, '2021-08-06', '2021-08-12', 'tala', 'tala', 0, NULL),
(13, 14, 5, '2021-08-06', '2021-08-12', 'tala', 'tala', 0, NULL),
(14, 15, 5, '2021-08-06', '2021-08-12', 'tala', 'tala', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicles`
--

CREATE TABLE `tblvehicles` (
  `id` int(11) NOT NULL,
  `VehiclesTitle` varchar(150) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext DEFAULT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `FuelType` varchar(100) DEFAULT NULL,
  `ModelYear` int(6) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `AirConditioner` int(11) DEFAULT NULL,
  `PowerDoorLocks` int(11) DEFAULT NULL,
  `AntiLockBrakingSystem` int(11) DEFAULT NULL,
  `BrakeAssist` int(11) DEFAULT NULL,
  `PowerSteering` int(11) DEFAULT NULL,
  `DriverAirbag` int(11) DEFAULT NULL,
  `PassengerAirbag` int(11) DEFAULT NULL,
  `PowerWindows` int(11) DEFAULT NULL,
  `CDPlayer` int(11) DEFAULT NULL,
  `CentralLocking` int(11) DEFAULT NULL,
  `CrashSensor` int(11) DEFAULT NULL,
  `LeatherSeats` int(11) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvehicles`
--

INSERT INTO `tblvehicles` (`id`, `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `AirConditioner`, `PowerDoorLocks`, `AntiLockBrakingSystem`, `BrakeAssist`, `PowerSteering`, `DriverAirbag`, `PassengerAirbag`, `PowerWindows`, `CDPlayer`, `CentralLocking`, `CrashSensor`, `LeatherSeats`, `RegDate`, `UpdationDate`) VALUES
(1, 'ytb rvtr', 2, 'vtretrvet', 345345, 'Petrol', 3453, 7, 'knowledge_base_bg.jpg', 'jaguar_xf_1280x800.jpg', 'lamborgini-105134_1920.jpg', 'suzuki_kizashi_front-1280x800-966641.jpeg', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2017-06-19 11:46:23', '2021-07-20 10:40:46'),
(2, 'Test Demoy', 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilisis eros. Sed erat. In in velit quis arcu ornare laoreet. Curabitur adipiscing luctus massa. Integer ut purus ac augue commodo commodo. Nunc nec mi eu justo tempor consectetuer. Etiam vitae nisl. In dignissim lacus ut ante. Cras elit lectus, bibendum a, adipiscing vitae, commodo et, dui. Ut tincidunt tortor. Donec nonummy, enim in lacinia pulvinar, velit tellus scelerisque augue, ac posuere libero urna eget neque. Cras ipsum. Vestibulum pretium, lectus nec venenatis volutpat, purus lectus ultrices risus, a condimentum risus mi et quam. Pellentesque auctor fringilla neque. Duis eu massa ut lorem iaculis vestibulum. Maecenas facilisis elit sed justo. Quisque volutpat malesuada velit. ', 859, 'CNG', 2015, 4, 'car_755x430.png', 'looking-used-car.png', 'banner-image.jpg', 'about_services_faq_bg.jpg', '', 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, NULL, '2017-06-19 16:16:17', '2017-06-21 16:57:11'),
(3, 'Lorem ipsum', 4, 'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 563, 'CNG', 2012, 5, 'featured-img-3.jpg', 'dealer-logo.jpg', 'img_390x390.jpg', 'listing_img3.jpg', '', 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, NULL, NULL, '2017-06-19 16:18:20', '2017-06-20 18:40:11'),
(4, 'Lorem ipsum', 1, 'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 5636, 'CNG', 2012, 5, 'featured-img-3.jpg', 'featured-img-1.jpg', 'featured-img-1.jpg', 'featured-img-1.jpg', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2017-06-19 16:18:43', '2017-06-20 18:44:12'),
(5, 'ytb rvtr', 5, 'vtretrvet', 345345, 'Petrol', 3453, 7, 'car_755x430.png', NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2017-06-20 17:57:09', '2017-06-21 16:56:43'),
(6, 'Waganor Taxi', 8, 'Its Well matintaied', 10, 'Petrol', 2017, 4, 'Koala.jpg', 'Desert.jpg', 'Hydrangeas.jpg', 'Jellyfish.jpg', '', 1, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, NULL, 1, '2017-07-05 11:04:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `full_name`, `password`, `group_id`) VALUES
(1, 'Richard', 'haimestoneritchie@gmail.com', 'Richard Musyoka', '7c222fb2927d828af22f592134e8932480637c0d', 0),
(2, 'Ricky', 'haimestoneritchie11@gmail.com', 'Richard Musyoka', '25d55ad283aa400af464c76d713c07ad', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `car_types`
--
ALTER TABLE `car_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
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
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `brand_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `car_types`
--
ALTER TABLE `car_types`
  MODIFY `type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblvehicles`
--
ALTER TABLE `tblvehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
