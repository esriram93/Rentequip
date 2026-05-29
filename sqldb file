-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 12:43 PM
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
-- Database: `rent_equip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'admin@rentequip.com', 'admin123', '2026-01-05 03:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `equipment_id`, `check_in_date`, `check_out_date`, `total_amount`, `advance_amount`, `status`, `created_at`) VALUES
(1, 2, 1, '2026-01-05', '2026-01-06', 18000.00, 5000.00, 'booked', '2026-01-02 07:41:50'),
(2, 2, 1, '2026-01-07', '2026-01-08', 18000.00, 0.00, 'booked', '2026-01-02 08:09:10'),
(3, 2, 1, '2026-01-07', '2026-01-08', 18000.00, 0.00, 'booked', '2026-01-02 08:09:10'),
(4, 2, 1, '2026-01-03', '2026-01-04', 18000.00, 9000.00, 'booked', '2026-01-02 09:00:34'),
(5, 3, 1, '2026-05-30', '2026-05-31', 18000.00, 9000.00, 'paid', '2026-05-29 08:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `email`, `phone`, `created_at`) VALUES
(1, 66, 'vijay', 'vijay9@gmail.com', '9384693009', '2026-01-09 04:08:38'),
(2, 67, 'SRIRAM E', 'esriram46@gmail.com', '8754939272', '2026-01-09 04:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `highlights` text DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `category` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `availability` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `description`, `highlights`, `price_per_day`, `image_url`, `is_available`, `category`, `location`, `availability`) VALUES
(1, 'JCB-Backhoe Loader', 'Versatile JCB for digging and loading Operations', '- 4WD / 2WD\n- Hydraulic System\n- Multiple Attachements', 9000.00, 'jcb_backhoe_loader_real_image.webp', 0, 'Earthmoving', NULL, 1),
(2, 'Tractor', 'Powerful tractor suitable for heavy construction work', '- 50 HP Engine\n- Air Conditioned Cabin\n- Fuel Efficient', 5000.00, 'tractor_real_image.webp', 1, 'Agriculture', NULL, 1),
(3, 'Self Loading Concrete Mixer', 'Capable of automatically loading raw materials into concrete mixer', '- 6000 Litre concrete mixer\n- High Pressure cleaning\n- Easy to operate', 12000.00, 'self_loading_concerete_mixer_real_image.webp', 1, 'Concrete', NULL, 1),
(4, 'Excavator', 'Heavy-duty steel tracks or rubber tracks provide stability and mobility on rough or uneven surfaces.', '- Rotates 360 degree\n- High Pressure in working system\n- Provides vertical reach and lift.\n- High Demand', 15000.00, 'excavator_real_image.jpg', 1, 'Earthmoving', NULL, 0),
(5, 'Mini Excavator', 'Lightweight version of a standard excavator,', '- Utility and Pipeline Work\n- Compact size and easy transport\n- Easy to operate and maintain\n- Can work in confined or indoor areas', 9000.00, 'mini_excavator_real_image.webp', 1, 'Earthmoving', NULL, 1),
(6, 'Tipper Lorry', 'High-capacity tipper for material transportation', '- 10 Ton Capacity\n- Hydraulic Tipper', 10000.00, 'tipper_lorry_real_image.jpg', 1, 'Transport', NULL, 1),
(7, 'Water tanker', 'A vehicle designed to store, transport, and distribute water', '- 6000 Liters Capacity Tanker\n- Anti-corrosive paint (inside & outside)\n- Front spray nozzles for road washing\n- Rear sprinklers for dust suppression', 2000.00, 'water_tanker_real_image.webp', 1, 'Transport', NULL, 1),
(8, 'Skid Loader', 'Lift arms that can attach to a wide variety of a tools or attachments.', '- Easy to control\n- Easy transport between sites\n- Durable and low maintenance', 12000.00, 'skid_loader_real_image.webp', 1, 'Earthmoving', NULL, 1),
(9, 'Ready Mix Concrete Truck', 'Transport pre-mixed concrete from batch plant to construction site', '- keeping it agitated in its rotating drum to prevent setting until it\'s discharged for use in foundations\n- Saves time and labor compared to site-mixed concrete.\n- Ensures consistent mix design and quality control.', 15000.00, 'rmc_truck_real_image.jpg', 1, 'Concrete', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment2`
--

CREATE TABLE `equipment2` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `created_at`) VALUES
(1, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:01:56'),
(2, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:02:07'),
(3, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:04:16'),
(4, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:04:27'),
(5, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:05:37'),
(6, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:05:37'),
(7, 0, 'Booking Approved', 'Your booking for  has been approved by admin.', 0, '2026-01-05 05:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `user_id`, `amount`, `payment_method`, `payment_status`, `created_at`, `transaction_id`) VALUES
(1, 5, 2, 1500.00, 'credit card', 'paid', '2026-01-02 09:12:53', 'TXN_1'),
(2, 5, 3, 9000.00, 'UPI', 'paid', '2026-05-29 08:33:08', 'TXN_6a194f44c65b2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `mobile`) VALUES
(1, 'Sriram', 'sri@test.com', '$2y$10$AZ40Ez0B0M3IOl7D2WdR0.e.U6YaQpLl7lnn4AYlQXu86F58eMQTm', 'user', ''),
(2, '', 'test@gmail.com', '', 'user', '9876543210'),
(3, 'Sriram', 'esriram93@gmail.com', '$2y$10$bOQ7YLj9l3naLw4ityOCDurxZVffe6zDPQ0haMk9qTKoqrUb0c2Ri', 'user', '8754939272'),
(4, 'Sriram', 'sriram_new@gmail.com', '$2y$10$IgtS0eEsRYkP7UoOQssf7elOIPxCpbkXPSknOUyTjtAqJ.JwwN8yC', 'user', '9876543210'),
(5, 'Sriram', 'sriram_test_2026@gmail.com', '$2y$10$u00P3K40HaC6nNfkmnqvxe12JtaORxKf5I93.ONFXNR4/qV9KMx.K', 'user', '9876543210'),
(65, 'Test User', 'testuser987@gmail.com', '$2y$10$idIUp5RIhMrYVucmDaKIkuZSckHSFa7Y0hYWkVKYFkI0I4XtgcjrW', 'user', '9999999999'),
(66, 'vijay', 'vijay9@gmail.com', '$2y$10$VOWDbH2iRa0vgWYcdGDYhe22Ycc6FJp207cCkl2ODB4uChCx7E/cK', 'user', '9384693009'),
(67, 'SRIRAM E', 'esriram46@gmail.com', '$2y$10$9tE97y5E5f5fOmIQ2ZqRB.f6BuLzUeW6pvVDHTvyaMoAsPFXQZVeO', 'user', '8754939272');

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
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment2`
--
ALTER TABLE `equipment2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `equipment2`
--
ALTER TABLE `equipment2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
