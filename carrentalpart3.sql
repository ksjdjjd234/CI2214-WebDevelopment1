-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2026 at 03:54 AM
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
-- Database: `carrental2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'a6850151f6d49de7162d8cc655dc0068');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `car_id`, `start_date`, `end_date`, `status`) VALUES
(2, 1, 1, '2026-10-21', '2026-10-25', 'confirmed'),
(23, 1, 1, '2026-01-05', '2026-01-08', 'confirmed'),
(24, 2, 3, '2026-01-10', '2026-01-12', 'pending'),
(25, 3, 4, '2026-01-15', '2026-01-18', 'confirmed'),
(26, 4, 5, '2026-01-20', '2026-01-23', 'cancelled'),
(27, 5, 6, '2026-02-01', '2026-02-05', 'confirmed'),
(28, 6, 7, '2026-02-08', '2026-02-10', 'pending'),
(29, 7, 8, '2026-02-12', '2026-02-15', 'confirmed'),
(30, 8, 9, '2026-02-20', '2026-02-24', 'cancelled'),
(31, 9, 10, '2026-03-01', '2026-03-04', 'confirmed'),
(32, 10, 11, '2026-03-10', '2026-03-14', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `plate` varchar(20) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `status` enum('available','rented','maintenance') DEFAULT 'available',
  `image` varchar(255) DEFAULT 'default-car.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `model`, `plate`, `year`, `status`, `image`) VALUES
(1, 'Toyota Vios', 'BAG-3084', 2020, 'available', 'toyota-vios.jpg'),
(3, 'Audi R8', 'BE-9559', 2024, 'available', 'audir8.jpg'),
(4, 'Toyota Vios', 'BA 1234', 2020, 'available', 'default-car.jpg'),
(5, 'Honda City', 'BB 5678', 2021, 'available', 'default-car.jpg'),
(6, 'Kia Sportage', 'BD 4321', 2019, 'rented', 'default-car.jpg'),
(7, 'Nissan Almera', 'BE 8765', 2022, 'available', 'default-car.jpg'),
(8, 'Hyundai Tucson', 'BF 2468', 2021, 'maintenance', 'default-car.jpg'),
(9, 'Toyota Corolla', 'BG 1357', 2020, 'available', 'default-car.jpg'),
(10, 'Mazda 3', 'BH 9753', 2018, 'rented', 'default-car.jpg'),
(11, 'Mitsubishi Attrage', 'BJ 8642', 2023, 'available', 'default-car.jpg'),
(12, 'Suzuki Swift', 'BK 1122', 2022, 'available', 'default-car.jpg'),
(13, 'Ford Ranger', 'BL 5566', 2021, 'available', 'default-car.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'Akmal', 'akmal@example.com'),
(2, 'Ahmad Rahman', 'ahmad.rahman@gmail.com'),
(3, 'Nur Aisyah', 'aisyah.nur@gmail.com'),
(4, 'Muhammad Firdaus', 'firdaus.m@gmail.com'),
(5, 'Siti Nurul', 'siti.nurul@gmail.com'),
(6, 'James Lim', 'james.lim@gmail.com'),
(7, 'Daniel Wong', 'daniel.wong@gmail.com'),
(8, 'Nurul Huda', 'nurul.huda@gmail.com'),
(9, 'Hj Azman', 'azman.hj@gmail.com'),
(10, 'Fatin Syahira', 'fatin.syahira@gmail.com'),
(11, 'Hakim Ali', 'hakim.ali@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plate` (`plate`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
