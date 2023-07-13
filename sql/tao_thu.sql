-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 02:36 PM
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
-- Database: `tao_thu`
--

-- --------------------------------------------------------

--
-- Table structure for table `hang`
--

CREATE TABLE `hang` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hang`
--

INSERT INTO `hang` (`id`, `name`, `image`) VALUES
(1, 'LENOVO', 'lenovo.png'),
(2, 'ACER', 'acer.png'),
(3, 'ASUS', 'asus.png'),
(4, 'DELL', 'dell.png'),
(5, 'HP', 'hp.png'),
(6, 'MSI', 'msi.png'),
(7, 'MACBOOK', 'macbook.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` text DEFAULT NULL,
  `quantity` varchar(200) NOT NULL,
  `price` float(10,3) DEFAULT 0.000,
  `id_product` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` text DEFAULT NULL,
  `price` float(10,3) DEFAULT 0.000,
  `sale_price` float(10,3) DEFAULT 0.000,
  `id_hang` int(11) DEFAULT NULL,
  `cpu` text DEFAULT NULL,
  `ram` text DEFAULT NULL,
  `o_cung` text DEFAULT NULL,
  `card_do_hoa` text DEFAULT NULL,
  `trong_luong` text DEFAULT NULL,
  `mau_sac` text DEFAULT NULL,
  `kich_thuoc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `sale_price`, `id_hang`, `cpu`, `ram`, `o_cung`, `card_do_hoa`, `trong_luong`, `mau_sac`, `kich_thuoc`) VALUES
(11, 'Laptop Gaming Legion 5 15ARH7H 82RE0036VN', 'laptop1.png', 43.990, 27.990, 1, 'AMD Ryzen 7 6800H (8C / 16T, 3.2 / 4.7GHz, 4MB L2 / 16MB L3)', '16GB (8x2) DDR5 4800MHz (2x SO-DIMM socket, up to 16GB SDRAM)', '512GB SSD M.2 2280 PCIe 4.0x4 NVMe (2 slots)', 'NVIDIA GeForce RTX 3050 Ti 4GB GDDR6, Boost Clock 1695MHz, TGP 95W', '2.35 kg', 'Storm Grey', '358.8 x 262.35 x 19.99 mm'),
(12, 'Laptop gaming ASUS ROG Strix G16 G614JU N3135W', 'laptop2.jpg', 39.990, 37.990, 3, 'Intel® Core™ i5-13450HX Processor 2.4 GHz (20M  Cache, up to 4.6 GHz, 10 cores: 6 P-cores and 4 E-cores)', '8GB (1x8GB) DDR5 4800MHz  (2x slots, up to 32GB)', '512GB M.2 NVMe PCIe 4.0 SSD (Trống 1 slot M.2 NVMe)', 'NVIDIA® GeForce RTX™ 4050 Laptop GPU 6GB GDDR6,MUX Switch + Optimus, ROG Boost: 2420MHz* at 140W (2370MHz Boost Clock+50MHz OC, 115W+25W Dynamic Boost)', '2.5 kg', 'Eclipse Gray', '35.4 x 26.4 x 2.26 ~ 3.04 cm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `user_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `sdt` varchar(20) NOT NULL,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `user_name`, `name`, `email`, `password`, `address`, `sdt`, `avatar`) VALUES
(7, 0, 'trolface', 'Trolface Aoi', 'trolface@gmail.com', '$2y$10$WwqW7CNYQrIMNfdqC6AD5O/qsnhYuVwrgChABdpmjMuLRJ1HQdrO6', 'Viet Nam', '090923124', 'be7.jpg'),
(8, 1, 'shuna', 'Shuna', 'shuna@gmail.com', '$2y$10$21FPUm7B97gntNlv2aytAu8ausMjWQSSEa6VqUvy73LALwQzFS.u2', 'Việt Nam', '0901284412', 'be7.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hang`
--
ALTER TABLE `hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_id_product` (`id_product`),
  ADD KEY `FK_orders_id_users` (`id_users`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `FK_product_id_hang` (`id_hang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hang`
--
ALTER TABLE `hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_id_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_orders_id_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_id_hang` FOREIGN KEY (`id_hang`) REFERENCES `hang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
