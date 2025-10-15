-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2025 at 09:09 AM
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
-- Database: `scms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `shopkeeper_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `categoryCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `shopkeeper_id`, `product_id`, `quantity`, `categoryCode`) VALUES
(86, 15, 1, 9, 'H');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderId` varchar(10) NOT NULL,
  `shopkeeper_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `total` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderId`, `shopkeeper_id`, `product_id`, `quantity`, `status`, `total`, `created_at`) VALUES
(29, '15H29', 19, 1, 9, 'pending', 0, '2025-09-26 12:21:33'),
(30, '15H29', 19, 2, 6, 'pending', 0, '2025-09-26 12:21:33'),
(31, '15H31', 15, 1, 6, 'processing', 1886, '2025-09-28 03:01:45'),
(32, '15IH32', 15, 6, 7, 'pending', 21828, '2025-10-04 04:28:54'),
(33, '15IH32', 15, 12, 6, 'processing', 21828, '2025-10-04 04:28:54'),
(34, '15H34', 15, 1, 6, 'pending', 5029, '2025-10-04 12:57:20'),
(35, '15H34', 15, 2, 6, 'pending', 5029, '2025-10-04 12:57:20'),
(36, '15H36', 15, 1, 6, 'cancelled', 1886, '2025-10-06 02:49:19'),
(37, '28RR37', 28, 1, 7, 'delivered', 7863, '2025-10-12 01:57:55'),
(38, '28RR37', 28, 3, 6, 'delivered', 7863, '2025-10-12 01:57:55'),
(39, '28IH39', 28, 1, 6, 'delivered', 11959, '2025-10-13 12:06:02'),
(40, '28IH39', 28, 12, 6, 'delivered', 11959, '2025-10-13 12:06:02'),
(41, '28RR41', 28, 3, 7, 'processing', 9873, '2025-10-13 22:21:20'),
(42, '28RR41', 28, 1, 6, 'processing', 9873, '2025-10-13 22:21:20'),
(43, '28RR41', 28, 14, 6, 'processing', 9873, '2025-10-13 22:21:20'),
(44, '28H44', 28, 1, 9, 'processing', 2828, '2025-10-13 22:25:57'),
(45, '28H45', 28, 11, 6, 'pending', 13219, '2025-10-14 23:19:24'),
(46, '28H45', 28, 2, 6, 'pending', 13219, '2025-10-14 23:19:24'),
(47, '29H47', 29, 22, 9, 'pending', 5215, '2025-10-15 00:26:09'),
(48, '29H47', 29, 2, 6, 'pending', 5215, '2025-10-15 00:26:09'),
(49, '29IH49', 29, 11, 6, 'pending', 10076, '2025-10-15 00:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(512) NOT NULL,
  `category` varchar(255) NOT NULL,
  `categoryCode` varchar(5) NOT NULL,
  `moq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `category`, `categoryCode`, `moq`) VALUES
(1, 'Orange Kream', 'PRIME', 299.00, 100, 'https://drinkprime.com/cdn/shop/files/OrangeKream_Web_DropBanner_PDP_Front_2000x2000_8b5dd6e8-169d-4332-84ef-e4028707c470_2000x.png?v=1752250151', 'HYDRATION', 'H', 6),
(2, 'Prime Collector Series', 'PRIME', 499.00, 100, 'https://drinkprime.com/cdn/shop/files/PRIME_hydration_1serve_16.9oz_US_CollectorSeries_00000_2000x.png?v=1748550723', 'HYDRATION', 'H', 6),
(3, 'Ocean Cherry', 'PRIME', 899.00, 85, 'https://drinkprime.com/cdn/shop/files/PR_RapidRehydration_OC_Web_PDP_Side_2000x2000_786d1b43-79a1-4895-b52d-e37ddd8ad633_1200x.png?v=1747401501', 'RAPID REHYDRATION', 'RR', 6),
(4, 'Sournova', 'PRIME', 249.00, 500, 'https://drinkprime.com/cdn/shop/files/Sournova_Web_DropBanner_PDP_Front_2000x2000_ffba587e-02f2-491a-a375-5f5b3e7f2eb8_2000x.png?v=1744126206', 'HYDRATION', 'H', 6),
(5, 'Future Freeze', 'PRIME', 1799.00, 65, 'https://drinkprime.com/cdn/shop/files/PrimeHydration_US_1serve_FutureFreeze_00000_2000x.png?v=1738603072', 'HYDRATION', 'H', 6),
(6, 'Cherry Limeade', 'PRIME', 1599.00, 42, 'https://drinkprime.com/cdn/shop/files/CherryLimeade-Front_2000x.png?v=1738165075', 'ENERGY', 'E', 6),
(11, 'Blue Chill', 'PRIME', 1599.00, 42, 'https://drinkprime.com/cdn/shop/files/PrimeHydration_US_1serve_16oz_ICE_Blue_00000_2_2000x.png?v=1735830966', 'ICE HYDRATION', 'IH', 6),
(12, 'Red Chill', 'PRIME', 1599.00, 42, 'https://drinkprime.com/cdn/shop/files/PRIME_hydration_1serve_16.9oz_US_RedChill_00000-2_3_2000x.png?v=1735831398', 'ICE HYDRATION', 'IH', 6),
(13, 'Orange', 'PRIME', 1599.00, 42, 'https://drinkprime.com/cdn/shop/files/PrimeHydration_US_1serve_16.9oz_ICE_Orange_00000_2_2000x.png?v=1735836301', 'ICE HYDRATION', 'IH', 6),
(14, 'Berry Citrus Rush', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/PR_RapidRehydration_CBR_Web_PDP_Side_2000x2000_f9811d34-4858-43f8-ac43-ad92ab8d5ea8_1200x.png?v=1747401390', 'RAPID REHYDRATION', 'RR', 6),
(15, 'Glacier Orange', 'PRIME', 211.00, 100, 'https://drinkprime.com/cdn/shop/files/PR_RapidRehydration_GO_Web_PDP_Side_2000x2000_51e17361-62a1-4224-b0e8-a3ec32035f8c_1200x.png?v=1747400971', 'RAPID REHYDRATION', 'RR', 6),
(16, 'Dripsicle', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/PRIME_energy_1serve_16oz_US_Drpsicle_00000_2000x.png?v=1738164974', 'ENERGY', 'E', 6),
(17, 'Dream Pop', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/PE-Dream_V2_2000x.png?v=1738170814', 'ENERGY', 'E', 6),
(19, 'Ice Pop', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/icepopcombo_1200x.png?v=1689355860', 'HYDRATION PLUS STICKS', 'HPS', 6),
(20, 'Cherry Freeze', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/CherryFreezeSticks-Side_1200x.png?v=1703014281', 'HYDRATION PLUS STICKS', 'HPS', 6),
(21, 'Strawberry Banana', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/SBSticksSide_1200x.png?v=1708725353', 'HYDRATION PLUS STICKS', 'HPS', 6),
(22, 'Tropical Punch', 'PRIME', 219.00, 100, 'https://drinkprime.com/cdn/shop/files/tropicalpunchcombo_1200x.png?v=1689355979', 'HYDRATION PLUS STICKS', 'HPS', 6);

-- --------------------------------------------------------

--
-- Table structure for table `shopkeeper`
--

CREATE TABLE `shopkeeper` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shop_location` text NOT NULL,
  `agreed_terms` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL,
  `role` varchar(50) DEFAULT 'shopkeeper'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopkeeper`
--

INSERT INTO `shopkeeper` (`id`, `shop_name`, `owner_name`, `mobile_number`, `email`, `password`, `shop_location`, `agreed_terms`, `created_at`, `status`, `role`) VALUES
(15, 'A Main Store', 'Nihar Patel', '122112213443', 'admin@google.com', '$2y$10$19q2anzxjQ2dlsaPco4YHOoqKBTAFrtRA6XpHwM5QJ33Sm7J1CizO', 'Jamnagar\r\n', 0, '2025-07-20 19:14:08', 'pending', 'admin'),
(17, 'Hitulal Rajwadi', 'Nihar Koyani', '8320336499', 'ok1@gmail.com', '$2y$10$OQ.H2UtnALJyksUhXA0dRuV31PLQu6MuaoYMsGo4sn/mmwnKcziWu', 'jamnagar', 0, '2025-07-23 07:56:14', 'pending', 'shopkeeper'),
(18, 'c', 'cc', 'c', 'v@gmail.com', '$2y$10$zO.AkPsSzttUGEk1EBGNLeeMhp2b4HrXkArpQGPP469WNFYvn6BMO', 'v', 0, '2025-07-23 08:02:51', 'pending', 'shopkeeper'),
(19, 'Tame Kiyo ee', 'Ram bharose', '1122113344', 'igxredits1@gmail.com', '$2y$10$ygtUSHse3LyVPMwqgDEkeOrdGf1JBdkK8EbXk44LHNwZbpH1jE5Sq', 'Jamnagar', 0, '2025-07-24 17:45:16', 'pending', 'shopkeeper'),
(21, 'Hitulal Rajwadi', 'Nihar Koyani', '8320336410', 'igxredits@gmail.com', '$2y$10$k9dA.E96oAmOkUACQ5IOOeRmtenqBVNIXm2xNP8Z2o3rN3nJcNX1.', 'jamnagar', 0, '2025-08-05 08:06:46', 'pending', 'shopkeeper'),
(22, 'Hitulal Rajwadi', 'Nihar Koyani', '8320336418', 'raj@google.com', '$2y$10$p4T0ebb9EMRuwKS120cF4ecGAzy7GlafgDkcdL/KOHqfwRys5ra.y', 'jamnagar', 0, '2025-08-06 07:23:38', 'pending', 'shopkeeper'),
(25, 'Hitulal Rajwadi12', 'Nihar Koyani', '8320336419', 'igxredits1221@gmail.com', '$2y$10$yG8idU7YGmNyzjFmw6.aGOrR2f/LspmTXg7Q3j5ZZujG7XATydeNq', 'jamnagar', 0, '2025-09-25 07:12:36', 'pending', 'shopkeeper'),
(28, 'Main Shop', 'Nihar Patel', '83203111111', 'nihar@google.com', '$2y$10$19q2anzxjQ2dlsaPco4YHOoqKBTAFrtRA6XpHwM5QJ33Sm7J1CizO', 'Jamnagar', 1, '2025-10-11 19:16:27', 'active', 'shopkeeper'),
(29, 'Happy Hours', 'Meet A', '8345339915', 'meet1221@google.com', '$2y$10$ytX/LsiotZ4Bo8/i0wZ4veReIe5EZ9f5VJRxxY0s2U5fOR75KP91G', 'Jamnagar', 0, '2025-10-14 18:46:39', 'inactive', 'shopkeeper');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_shopkeeper` (`shopkeeper_id`),
  ADD KEY `fk_orders_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `shopkeeper`
--
ALTER TABLE `shopkeeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_orders_shopkeeper` FOREIGN KEY (`shopkeeper_id`) REFERENCES `shopkeeper` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
