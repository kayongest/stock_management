-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 23, 2024 at 06:18 PM
-- Server version: 8.0.35
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `av_event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `academia`
--

CREATE TABLE `academia` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `board_id` int NOT NULL,
  `board_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`) VALUES
(1, 'Apple'),
(2, 'HP'),
(3, 'DEL'),
(4, 'LENOVO'),
(5, 'SAMSUNG'),
(6, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `card_id` int NOT NULL,
  `list_id` int NOT NULL,
  `card_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `card_description` text COLLATE utf8mb4_general_ci,
  `position` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci,
  `tag` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `Description`, `tag`) VALUES
(1, 'Laptop', 'HDD: 500GB, RAM: 8GB, Screen: 13Inch', 'OTHER'),
(2, 'PROJECTOR', '1800HD', 'VIDEO'),
(3, 'KEYBOARD', 'APPLE MAGIC KEYS 2024', 'OTHER'),
(4, 'LAPTOP', 'SSD: 500GB, RAM: M2, Screen: 13Inch', 'OTHER'),
(5, 'MOUSE', 'Apple Magic Mouse', 'OTHER'),
(6, 'Phone', 'Iphone 13', 'OTHER'),
(7, 'Test Product', 'Testing the product with the name', 'VIDEO');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `label_class` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int NOT NULL,
  `event_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `event_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `event_type` enum('Anniversary','Conference','Forum','Fashion_Event','Webinar','Hybrid','Concert','Exhibition','Sport_Event','Training_Session','Other') COLLATE utf8mb4_general_ci NOT NULL,
  `event_status` enum('Active','Ongoing','Completed','Pending','Waived') COLLATE utf8mb4_general_ci NOT NULL,
  `event_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `created_at`, `updated_at`, `event_location`, `event_description`, `event_type`, `event_status`, `event_image`) VALUES
(2, 'Stock Take', '2024-08-28', '2024-08-28 18:34:51', '2024-08-29 13:26:57', 'Rugando', 'All Stocks', 'Webinar', 'Completed', '66d073e406637.png'),
(3, 'Stock Take Kedjani', '2024-08-28', '2024-08-28 18:38:07', '2024-08-29 15:23:29', 'Kandahar', '-+*%=', 'Conference', 'Active', '66d0927158e87.jpg'),
(5, 'Masamba LIVE', '2024-08-31', '2024-08-31 14:46:52', '2024-08-31 14:46:52', 'Masamba LIVE', 'LIVE SHOW', 'Concert', 'Active', '66d32cdc9cdd3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `item_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `serial_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `item_status` enum('New','Working','Faulty','Needs Repair','Repaired','Leased') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` date DEFAULT NULL,
  `item_type` enum('New','Existing') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Existing',
  `qr_code_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_code`, `category_id`, `brand_id`, `serial_number`, `item_status`, `date_added`, `update_date`, `item_type`, `qr_code_url`) VALUES
(1, '#0UHVOQ', 3, 10, '#123wew', 'New', '2024-12-17 12:43:32', NULL, 'Existing', NULL),
(2, '#X4BRYZ', 4, 1, 'CW64GP6N4H', 'New', '2024-12-17 13:44:55', NULL, 'Existing', NULL),
(7, '#BAQ6OP', 6, 4, '776659', 'New', '2024-12-21 07:14:47', NULL, 'Existing', NULL),
(8, '#HMKQVN', 5, 3, 'gergf', 'New', '2024-12-21 07:29:18', NULL, 'Existing', NULL),
(9, '#PMCTZ8', 3, 5, '#76876576578', 'New', '2024-12-21 08:07:08', NULL, 'Existing', NULL),
(10, '#F1Y9DE', 7, 6, '#65656', 'New', '2024-12-21 08:11:13', NULL, 'Existing', NULL),
(11, '#Y15GQ8', 4, 4, '#898923', 'New', '2024-12-23 16:48:10', NULL, 'Existing', NULL),
(12, '#UG3X4R', 6, 5, 'test', 'New', '2024-12-23 16:55:41', NULL, 'Existing', NULL),
(13, '#SP72YG', 5, 4, '#4455ksdj', 'New', '2024-12-23 16:57:16', NULL, 'Existing', NULL),
(14, '#QPE509', 2, 2, '#vdkn', 'New', '2024-12-23 16:59:08', NULL, 'Existing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lease`
--

CREATE TABLE `lease` (
  `lease_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `item_category` enum('VIDEO','IT','SOUND','SIS','LIGHTS','OTHER') COLLATE utf8mb4_general_ci NOT NULL,
  `stock_location` enum('Masoro','KCC','BK Arena','Ndera','Rugando') COLLATE utf8mb4_general_ci NOT NULL,
  `lease_venue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lessee_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lease_start_date` date NOT NULL,
  `lease_end_date` date NOT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `requested_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lease`
--

INSERT INTO `lease` (`lease_id`, `item_id`, `item_name`, `item_category`, `stock_location`, `lease_venue`, `lessee_name`, `lease_start_date`, `lease_end_date`, `comments`, `requested_date`, `return_date`) VALUES
(1, 2, '', 'VIDEO', 'Masoro', '', 'Rugema', '2024-09-28', '2024-10-12', 'Demo1', '2024-09-07 18:29:53', NULL),
(2, 2, '', 'VIDEO', 'Masoro', '', 'Rugema Arafat', '2024-09-14', '2024-09-28', 'Demo 2', '2024-09-07 18:44:57', NULL),
(3, 10, '', 'VIDEO', 'Masoro', '', 'Rugema Arafat', '2024-09-28', '2024-10-12', 'Demo 3', '2024-09-07 18:45:46', NULL),
(4, 236, '', 'VIDEO', 'Masoro', '', 'qwq', '2024-09-19', '2024-09-25', 'Demo4', '2024-09-07 18:52:40', NULL),
(5, 237, '', 'VIDEO', 'Masoro', '', 'Kayonga Raul', '2024-09-10', '2024-09-13', 'For internet connectivity.', '2024-09-10 09:00:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `list_id` int NOT NULL,
  `board_id` int NOT NULL,
  `list_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `position` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `model_id` int NOT NULL,
  `model_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int NOT NULL,
  `stock_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `stock_name`) VALUES
(1, 'UNASSIGNED'),
(2, 'KCC'),
(3, 'UNASSIGNED'),
(4, 'MASORO'),
(5, 'BK Arena'),
(6, 'NDERA'),
(8, 'Rugando');

-- --------------------------------------------------------

--
-- Table structure for table `stock_managers`
--

CREATE TABLE `stock_managers` (
  `manager_id` int NOT NULL,
  `manager_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int NOT NULL,
  `event_id` int NOT NULL,
  `technician_id` int DEFAULT NULL,
  `task_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','In Progress','Completed') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `event_id`, `technician_id`, `task_name`, `status`, `due_date`, `created_at`, `updated_at`, `description`) VALUES
(1, 2, 1, '3', 'Pending', '2024-09-14', '2024-09-09 16:50:04', '2024-09-09 16:50:04', '3'),
(2, 2, 1, '34', '', '2024-09-10', '2024-09-09 17:01:57', '2024-09-09 17:01:57', '34');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE `task_comments` (
  `comment_id` int NOT NULL,
  `task_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `technician_id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` enum('NID','Passport') COLLATE utf8mb4_general_ci NOT NULL,
  `id_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `department` enum('IT','Video','Sound','Lights','SIS','Electrical','Other','Stock','ManPower') COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionId` int NOT NULL,
  `itemId` int NOT NULL,
  `locationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionId`, `itemId`, `locationId`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 7, 4),
(4, 8, 6),
(5, 9, 5),
(6, 10, 1),
(7, 11, 1),
(8, 12, 1),
(9, 13, 1),
(10, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` enum('User','Admin','Manager','Technician') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `phone`, `email`, `password_hash`, `photo`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Technician2', '07885252201', 'tech2@ability.io1', '$2y$10$cCTqfw/REow7T3euqVr2GO9V3WgNn1QFm.er28bS4.UAQ4VFsH0CW', 'uploads/bgCode.jpg', '2024-12-06 19:07:15', '2024-12-06 19:07:15', 'User'),
(2, 'Kayonga', '0788700870', 'ability@gmail.vom', '$2y$10$.NdwUBtyzJGUTn3/GREAr.oVT9o9tQTnRqDMzC5r0TyMuFAe8NAgK', NULL, '2024-12-15 14:38:52', '2024-12-15 14:38:52', 'User'),
(3, 'Mayor', '0012345678', 'mayor@gmail.vom', '$2y$10$b2xMD5TEmnzJeXujR2WtdeFpNWc6PEMKgxd1GtfzmQ0jfa2JvTkPm', NULL, '2024-12-15 14:42:11', '2024-12-15 14:42:11', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academia`
--
ALTER TABLE `academia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexes for table `lease`
--
ALTER TABLE `lease`
  ADD PRIMARY KEY (`lease_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `board_id` (`board_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_managers`
--
ALTER TABLE `stock_managers`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `technician_id` (`technician_id`);

--
-- Indexes for table `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`technician_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academia`
--
ALTER TABLE `academia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lease`
--
ALTER TABLE `lease`
  MODIFY `lease_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `model_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_managers`
--
ALTER TABLE `stock_managers`
  MODIFY `manager_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `technician_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boards`
--
ALTER TABLE `boards`
  ADD CONSTRAINT `boards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`) ON DELETE CASCADE;

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`board_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
