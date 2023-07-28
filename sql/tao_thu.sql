-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 09:10 AM
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
  `id_users` int(11) NOT NULL,
  `total_price` float(10,3) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(255) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `time_order` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_users`, `total_price`, `note`, `status`, `address`, `sdt`, `time_order`) VALUES
(25, 8, 14.990, 'égsrgdrh', 1, '168/6 Trường Chinh, Phường 13, quận Tân Bình, TP Hồ Chí Minh', '0901284412', '2023-07-28 12:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` text NOT NULL,
  `price` float(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_order`, `id_product`, `quantity`, `price`) VALUES
(25, 20, '1', 14.990);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` text DEFAULT NULL,
  `quantity` text DEFAULT NULL,
  `price` float(10,3) DEFAULT 0.000,
  `sale_price` float(10,3) DEFAULT 0.000,
  `id_hang` int(11) DEFAULT NULL,
  `category` text NOT NULL,
  `cpu` text DEFAULT NULL,
  `ram` text DEFAULT NULL,
  `o_cung` text DEFAULT NULL,
  `card_do_hoa` text DEFAULT NULL,
  `trong_luong` text DEFAULT NULL,
  `mau_sac` text DEFAULT NULL,
  `kich_thuoc` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `quantity`, `price`, `sale_price`, `id_hang`, `category`, `cpu`, `ram`, `o_cung`, `card_do_hoa`, `trong_luong`, `mau_sac`, `kich_thuoc`, `status`) VALUES
(11, 'Laptop Gaming Legion 5 15ARH7H 82RE0036VN', 'laptop1.png', '100', 43.990, 27.990, 1, 'gaming', 'AMD Ryzen 7 6800H (8C / 16T, 3.2 / 4.7GHz, 4MB L2 / 16MB L3)', '16GB (8x2) DDR5 4800MHz (2x SO-DIMM socket, up to 16GB SDRAM)', '512GB SSD M.2 2280 PCIe 4.0x4 NVMe (2 slots)', 'NVIDIA GeForce RTX 3050 Ti 4GB GDDR6, Boost Clock 1695MHz, TGP 95W', '2.35 kg', 'Storm Grey', '358.8 x 262.35 x 19.99 mm', 1),
(12, 'Laptop gaming ASUS ROG Strix G16 G614JU N3135W', 'laptop2.jpg', '100', 39.990, 37.990, 3, 'gaming', 'Intel® Core™ i5-13450HX Processor 2.4 GHz (20M  Cache, up to 4.6 GHz, 10 cores: 6 P-cores and 4 E-cores)', '8GB (1x8GB) DDR5 4800MHz  (2x slots, up to 32GB)', '512GB M.2 NVMe PCIe 4.0 SSD (Trống 1 slot M.2 NVMe)', 'NVIDIA® GeForce RTX™ 4050 Laptop GPU 6GB GDDR6,MUX Switch + Optimus, ROG Boost: 2420MHz* at 140W (2370MHz Boost Clock+50MHz OC, 115W+25W Dynamic Boost)', '2.5 kg', 'Eclipse Gray', '35.4 x 26.4 x 2.26 ~ 3.04 cm', 1),
(13, 'Laptop ASUS Vivobook 14X OLED A1403ZA KM066W', 'laptop3.jpg', '100', 20.490, 16.990, 3, 'gaming', 'Intel® Core™ i5-12500H Processor 2.5 GHz (18M Cache, up to 4.5 GHz, 4P+8E cores)', '8GB (Onboard) DDR4 3200MHz (Còn 1 slot SO-DIMM, nâng cấp tối đa 16GB)', '512GB M.2 NVMe™ PCIe® 3.0 SSD (1 slot, support M.2 2280 PCIe 3.0x4)', 'Intel Iris Xe Graphics (with dual channel memory), Intel® UHD Graphics', '1.6 kg', 'Quiet Blue', '31.71 x 22.20 x 1.99 cm', 1),
(15, 'Laptop Lenovo Ideapad Gaming 3 15IAH7 82S9006YVN', 'laptop4.jpg', '100', 26.990, 18.990, 1, 'gaming', 'Intel Core i5-12500H, 12C (4P + 8E) / 16T, P-core 2.5 / 4.5GHz, E-core 1.8 / 3.3GHz, 18MB', '1 x 8GB DDR4 3200MHz (2x SO-DIMM socket, up to 16GB SDRAM)', '512GB SSD M.2 2242 PCIe 4.0x4 NVMe (2 Slots)', 'NVIDIA GeForce RTX 3050 4GB GDDR6, Boost Clock 1740MHz, TGP 85W', '2.315 kg', 'Onyx Grey', '359.6 x 266.4 x 21.8 mm', 1),
(17, 'Laptop Gaming Acer Nitro 5 Eagle AN515 57 53F9', 'laptop5.jpg', '100', 25.990, 19.990, 2, 'gaming', 'Intel® Core i5-11400H upto 4.50 GHz, 6 nhân 12 luồng', '8GB DDR4 3200MHz (2 slot SO-DIMM socket, nâng cấp tối đa 32GB SDRAM)', '512GB SSD M.2 PCIE (nâng cấp tối đa 1TB SSD PCIe Gen3, 8 Gb/s, NVMe và 2TB HDD 2.5-inch 5400 RPM) (Còn trống 1 khe SSD M.2 PCIE và 1 khe 2.5\" SATA)', 'NVIDIA® GeForce RTX™ 3050 4GB GDDR6', '2.20 kg', 'Black', '363.4 x 255 x 23.9 mm', 1),
(20, 'Laptop gaming MSI GF63 Thin 11SC 664VN', 'laptop6.jpg', '100', 21.990, 14.990, 6, 'gaming', 'Intel Core i5-11400H 2.2GHz up to 4.5GHz 12MB', '8GB (8x1) DDR4 3200MHz (2x SO-DIMM socket, up to 64GB SDRAM)', '512GB NVMe PCIe Gen3x4 SSD (1 slot)', 'NVIDIA GeForce GTX1650 4GB GDDR6 with Max-Q Design + Intel UHD Graphics', '1.86 kg', 'Black', '359 x 254 x 21.7 mm', 1),
(56, 'Laptop ASUS VivoBook Pro 15 OLED K6502VU MA089W', 'laptop7.jpg', '100', 34.990, 37.990, 3, 'hoc-tap-van-phong', 'Intel® Core™ i5-13500H Processor 2.6 GHz (18MB Cache, up to 4.7 GHz, 12 cores, 16 Threads)', '16GB DDR5 (8GB Onboard + 8GB Sodimm, up to 24GB SDRAM)', '512GB M.2 NVMe™ PCIe® 4.0 SSD', 'NVIDIA® Geforce RTX™ 4050 6GB GDDR6 + Intel® Iris Xe Graphics', '1.8kg', 'Cool Silver ', '35.63 x 23.53 x 1.99 ~ 2.00 cm', 1);

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
  `avatar` text DEFAULT NULL,
  `is_online` int(1) DEFAULT 0,
  `last_activity` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `user_name`, `name`, `email`, `password`, `address`, `sdt`, `avatar`, `is_online`, `last_activity`) VALUES
(8, 1, 'admin', 'Admin', 'admin@gmail.com', '$2y$10$okTUmsrA1B.TRAFOBP9XEec../.pdZpz9jFYXrOz6diQv5K0/IJoW', '168/6 Trường Chinh, Phường 13, quận Tân Bình, TP Hồ Chí Minh', '0901284412', 'be7.jpg', 1, '2023-07-28 14:07:24'),
(19, 0, 'trolface', 'Tuấn Đẹt', 'trolface@gmail.com', '$2y$10$KnoUgOIwRhZ4qt07O9pSu.sox7AffcwqWy1Sy/hjYR6KOemRbFggG', 'Hồ Chí Minh', '0102030405', 'be7.jpg', 0, '2023-07-28 02:17:37');

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
  ADD KEY `FK_orders_id_users` (`id_users`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id_order`,`id_product`),
  ADD KEY `FK_product_id` (`id_product`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_id_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `FK_orders_id` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `FK_product_id` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_id_hang` FOREIGN KEY (`id_hang`) REFERENCES `hang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
