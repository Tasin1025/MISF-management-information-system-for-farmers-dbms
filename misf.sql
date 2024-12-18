-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 10:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `misf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Chuti', 'chuti@gmail.com', 'chuti1234', '2024-12-17 23:42:39'),
(2, 'rafi', 'rafi@gmail.com', 'rafi', '2024-12-17 23:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `location` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `name`, `email`, `category`, `contact_info`, `location`, `created_at`, `password`) VALUES
(1, 'chuti', 'chuti@gmail.com', 'wholesale', '12345', 'Dhaka', '2024-12-18 01:17:28', 'chuti1234'),
(2, 'rafi', 'rafi@gmail.com', 'retail', '12345', 'Dhaka', '2024-12-18 01:54:44', 'rafi');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `name`, `price`) VALUES
(1, 'Coarse Rice', 53.00),
(2, 'Fine Rice', 69.00),
(3, 'Wheat Flour (Atta)', 64.00),
(4, 'Fine Wheat Flour (Maida)', 68.00),
(5, 'Lentils (Masoor dal)', 130.00),
(6, 'Green grams (Moong dal)', 120.00),
(7, 'Soybean Oil', 180.00),
(8, 'Mustard Oil', 230.00),
(9, 'Potatoes', 75.00),
(10, 'Onions', 110.00),
(11, 'Garlics', 220.00);

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `farm_type` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `land_size` varchar(50) DEFAULT NULL,
  `crops_grown` text DEFAULT NULL,
  `livestock` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `email`, `password`, `name`, `age`, `farm_type`, `location`, `land_size`, `crops_grown`, `livestock`, `created_at`) VALUES
(1, 'chuti@gmail.com', 'chuti1234', 'Chuti', 30, 'Poulry', 'Dhaka', '10 acres', 'Rice, Wheat', '30 Chickens, 10 Cows', '2024-12-16 21:50:50'),
(2, 'rafi@gmail.com', 'rafi', 'rafi', 40, 'Dairy', 'Dhaka', '69 acre', 'Rice', '99 Cows', '2024-12-16 22:01:14'),
(3, 'tahmid@iub.edu.bd', '123456', 'tahmid', 35, 'Mixed', 'Dhaka', '10 acres', 'Wheat', '30 cows, 20 chicken', '2024-12-16 22:07:01'),
(4, 'shorbunny@gmail.com', 'shorbunny', 'shorbunny', 20, 'dairy', 'dhaka', '10 acre', 'carrot', '10 bunny', '2024-12-17 00:08:43'),
(5, 'abcd@gmail.com', 'abcd', 'abcd', 69, 'Dairy', 'Dhaka', '100 acre', 'Rice', '20 Goats ', '2024-12-18 09:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_activities`
--

CREATE TABLE `farmer_activities` (
  `id` int(11) NOT NULL,
  `farmer_email` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `activity_description` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_activities`
--

INSERT INTO `farmer_activities` (`id`, `farmer_email`, `activity_date`, `activity_description`, `status`, `remarks`) VALUES
(1, 'chuti@gmail.com', '2024-12-12', 'Heatvest wheat', 'In Progress', 'cholteseeee'),
(2, 'shorbunny@gmail.com', '2024-12-12', 'Harvest', 'Completed', 'gajor khabo'),
(3, 'shorbunny@gmail.com', '2024-12-13', 'gajor khawano', 'Completed', 'pet bhorse'),
(4, 'rafi@gmail.com', '2024-12-13', 'Goru kinsi', 'Completed', ''),
(5, 'abcd@gmail.com', '2024-12-12', 'Bought Rafi', 'Completed', 'Bhaloi .. ');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comments` text NOT NULL,
  `suggestions` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `name`, `rating`, `comments`, `suggestions`, `submission_date`) VALUES
(1, 'chuti@gmail.com', 'Chuti', 4, 'No comments', 'No Suggestions ', '2024-12-18 09:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `seeds`
--

CREATE TABLE `seeds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seeds`
--

INSERT INTO `seeds` (`id`, `name`, `price`) VALUES
(1, 'Rice Seed', 55.00),
(2, 'Wheat Seed', 72.00),
(3, 'Corn Seed', 53.00),
(4, 'Mustard Seed', 74.00),
(5, 'Bean Seed', 90.00),
(6, 'Sunflower Seed', 115.00),
(7, 'Tomato Seed', 140.00),
(8, 'Chili Seed', 127.00),
(9, 'Carrot Seed', 85.00),
(10, 'Onion Seed', 105.00),
(11, 'Garlic Seed', 135.00);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `inputs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `password`, `contact`, `location`, `inputs`) VALUES
(1, 'chuti', 'chuti@gmail.com', 'chuti1234', '1234', 'dhaka', 'seeds weeds fartilizer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `farmer_activities`
--
ALTER TABLE `farmer_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_email` (`farmer_email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seeds`
--
ALTER TABLE `seeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `farmer_activities`
--
ALTER TABLE `farmer_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seeds`
--
ALTER TABLE `seeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farmer_activities`
--
ALTER TABLE `farmer_activities`
  ADD CONSTRAINT `farmer_activities_ibfk_1` FOREIGN KEY (`farmer_email`) REFERENCES `farmers` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
