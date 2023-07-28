-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 10:44 PM
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
(25, 8, 14.990, 'égsrgdrh', 1, '168/6 Trường Chinh, Phường 13, quận Tân Bình, TP Hồ Chí Minh', '0901284412', '2023-07-28 12:45:00'),
(26, 19, 58.480, '', 0, 'Hồ Chí Minh', '0102030405', '2023-07-29 02:52:34');

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
(25, 20, '1', 14.990),
(26, 82, '1', 25.990),
(26, 84, '1', 32.490);

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
(56, 'Laptop ASUS VivoBook Pro 15 OLED K6502VU MA089W', 'laptop7.jpg', '100', 37.990, 34.990, 3, 'hoc-tap-van-phong', 'Intel® Core™ i5-13500H Processor 2.6 GHz (18MB Cache, up to 4.7 GHz, 12 cores, 16 Threads)', '16GB DDR5 (8GB Onboard + 8GB Sodimm, up to 24GB SDRAM)', '512GB M.2 NVMe™ PCIe® 4.0 SSD', 'NVIDIA® Geforce RTX™ 4050 6GB GDDR6 + Intel® Iris Xe Graphics', '1.8kg', 'Cool Silver ', '35.63 x 23.53 x 1.99 ~ 2.00 cm', 1),
(57, 'Laptop Dell Vostro 3520 V5I3614W1 Gray', 'laptop8.jpg', '100', 15.490, 12.990, 4, 'hoc-tap-van-phong', 'Intel Core i3 - 1215U (Up to 4.4 Ghz, 12Mb)', '8GB (8x1) DDR4 2666MHz (2x SO-DIMM socket, up to 16GB SDRAM)', '256GB SSD M.2 PCIE', 'Intel UHD Graphics', '1.66 kg', 'Black', '358.5 x 235.56 x 16.96mm', 1),
(58, 'Laptop MSI Modern 15 B7M 099VN', 'laptop9.jpg', '100', 14.490, 14.490, 6, 'hoc-tap-van-phong', 'AMD Ryzen 5-7530U 2.0GHz up to 4.5GHz 16MB', '8GB DDR4 3200Mhz Onboard (Không nâng cấp)', '512GB PCIe NVMe™ M.2 SSD (1 slot)', ' AMD Radeon™ Graphics', '1.75 kg', 'Classic Black', '359 x 241 x 19.9 mm', 1),
(59, 'Laptop ASUS Zenbook 14 OLED UX3402VA KM085W', 'laptop10.jpg', '100', 27.990, 24.990, 3, 'hoc-tap-van-phong', 'Intel® Core™ i5-1340P Processor 1.9 GHz (12MB Cache, up to 4.6 GHz, 12 cores, 16 Threads)', '16GB LPDDR5 Onboard 4800 MHz (Không nâng cấp)', '512GB M.2 NVMe™ PCIe® 4.0 SSD', 'Intel Iris Xe Graphics', '1.39 kg', 'Ponder Blue', '31.36 x 22.06 x 1.69 ~ 1.69 (cm)', 1),
(60, 'Laptop Lenovo ThinkPad E14 21E300E3VN', 'laptop11.jpg', '100', 27.990, 23.990, 1, 'hoc-tap-van-phong', 'Intel® Core™ i7-1255U, 10 Cores (2P + 8E) / 12 Threads, P-core 1.7 / 4.7GHz, E-core 1.2 / 3.5GHz, 12MB', '8GB Soldered DDR4-3200 (Trống 1 slot  Sodimm, nâng cấp tối đa 40GB)', '512GB SSD M.2 2242 PCIe® 4.0x4 NVMe® Opal 2.0 (Còn trống 1 Slot M.2 2242 PCIe 3.0 x4)', 'Intel Iris Xe Graphics (with dual channel memory), Intel® UHD Graphics (with single channel memory)', '1.64 kg', 'Black', '324 x 220.7 x 17.9 mm', 1),
(62, 'Laptop Asus Vivobook OLED M1503QA L1044W', 'laptop12.jpg', '100', 19.290, 16.490, 3, 'hoc-tap-van-phong', 'AMD Ryzen™ 7 5800H Mobile Processor (8-core/16-thread, 20MB cache, up to 4.4 GHz max boost)', '8GB (Onboard) DDR4 3200MHz (Còn 1 slot SO-DIMM, nâng cấp tối đa 16GB)\r\n', '512GB SSD M.2 NVMe PCIe 3.0 (1 Slot)\r\n', 'AMD Radeon Graphics\r\n', '1.70 kg', 'Transparent Silver', '35.68 x 22.76 x 1.99 ~ 1.99 cm', 1),
(63, 'Laptop Dell Latitude 3520 P108F001 70280543', 'laptop13.jpg', '100', 18.990, 14.990, 4, 'hoc-tap-van-phong', 'Intel Core i5-1135G7 2.4GHz up to 4.2GHz 8MB\r\n', '8GB (1x8) DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '256GB SSD M.2 PCI-E (1x slot SATA 3 trống)\r\n', 'Intel Iris Xe Graphics (with dual channel memory), Intel® UHD Graphics', '1.79 kg', 'Carbon Black', '361 x 241 x 18 mm', 1),
(64, 'Laptop HP Pavilion 15 EG2036TX 6K782PA', 'laptop14.jpg', '100', 20.590, 19.490, 5, 'hoc-tap-van-phong', 'Intel Core i5-1235U 1.3GHz up to 4.4GHz 12MB\r\n', '8GB (4x2) DDR4 3200MHz (2x SO-DIMM socket, up to 16GB SDRAM)\r\n', '512GB PCIe NVMe M.2 SSD (1 slot)\r\n', 'NVIDIA GeForce MX550 2GB GDDR6 + Intel Iris Xe Graphics\r\n', '1.74 kg', 'Natural Silver', '36.02 x 23.4 x 1.79 cm', 1),
(65, 'Laptop Dell Inspiron 5430 N5430I58W1 Silver', 'laptop15.jpg', '100', 20.990, 19.990, 4, 'hoc-tap-van-phong', 'Intel® Core™ i5-1335U upto 4.60GHz, 10 cores 12 threads, 12MB Cache\r\n', '8GB LPDDR5 4800MHz Onboard\r\n', '512GB SSD M.2 PCIE \r\n', 'Intel Iris Xe Graphics (Khi chạy Dual Ram), Intel UHD Graphics', '1.53 kg', 'Silver', '314.00 x 226.6 x 15.74 - 17.67mm', 1),
(66, 'Laptop Gaming MSI Katana 15 B13VEK 1205VN', 'laptop16.jpg', '100', 28.990, 26.990, 6, 'gaming', 'Intel Core i5-13420H (3.40GHz~4.60GHz) 8 Cores 12 Threads, 12 MB Intel® Smart Cache\r\n', '8GB (1 x 8GB) DDR5 5200MHz (2x SO-DIMM socket, up to 64GB SDRAM)\r\n', '512GB NVMe PCIe Gen 4 SSD (2 slots, Liên hệ nhân viên GearVN để upgade SSD)\r\n', 'NVIDIA GeForce RTX 4050 Laptop GPU 6GB GDDR6 + MUX Switch\r\n', '2.25 kg', 'Đen', '359 x 259 x 24.9 mm', 1),
(67, 'Laptop gaming Acer Predator Helios 300 PH315 55 76KG', 'laptop17.jpg', '100', 33.990, 48.490, 2, 'gaming', 'Intel® Core™ i7-12700H (up to 4.7Ghz, 24MB cache)\r\n', '16GB DDR5 4800Mhz (2x8GB) (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB NVMe PCIe Gen3x4 SSD (2 slot)\r\n', 'NVIDIA GeForce RTX 3060 6GB GDDR6\r\n', '2.4 kg', 'Đen', '359.4 x 276.4 x 25.55 mm', 1),
(68, 'Laptop Gaming Acer Aspire 7 A715 42G R05G', 'laptop18.jpg', '100', 22.990, 14.990, 2, 'gaming', 'AMD Ryzen 5 – 5500U (6 nhân 12 luồng)\r\n', '8GB DDR4 (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB PCIe® NVMe™ M.2 SSD\r\n', 'NVIDIA GeForce GTX 1650 4GB GDDR6\r\n', '2.1 kg', 'Đen, Có đèn bàn phím', '363.4 x 254.5 x 23.25 (mm)', 1),
(70, 'Laptop Asus TUF FX506HC HN144W', 'laptop19.jpg', '100', 25.990, 18.990, 3, 'gaming', 'Intel® Core™ i5-11400H Processor 2.7 GHz (12M Cache, up to 4.5 GHz, 6 Cores)\r\n', '8GB DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB SSD M.2 PCIE G3X2, 1x slot M.2\r\n', 'NVIDIA® GeForce RTX™ 3050 Laptop GPU + Intel® UHD Graphics\r\n', '2.3 kg', 'Graphite Black', '35.9 x 25.6 x 2.28 ~ 2.43 cm', 1),
(71, 'Laptop Gaming MSI Katana GF66 11UE 836VN', 'laptop20.jpg', '100', 32.990, 24.490, 6, 'gaming', 'Intel Core i7-11800H 2.3GHz up to 4.6GHz 24MB\r\n', '16GB (8x2) DDR4 3200MHz (2x SO-DIMM socket, up to 64GB SDRAM)\r\n', '512GB NVMe PCIe Gen3x4 SSD (2 slot)\r\n', 'NVIDIA GeForce RTX 3060 6GB GDDR6, Up to 1485MHz Boost Clock, 85W Maximum Graphics Power.\r\n', '2.1 kg', 'Đen', '359 x 259 x 24.9 mm', 1),
(72, 'Laptop gaming ASUS ROG Strix G16 G614JU N3777W', 'laptop21.jpg', '100', 43.990, 39.990, 3, 'gaming', 'Intel® Core™ i7-13650HX Processor 2.6 GHz 24M  Cache, up to 4.9 GHz, 14 cores: 6 P-cores and 8 E-cores)\r\n', '16GB (2x8GB) DDR5 4800MHz  (2x slots, up to 32GB)\r\n', '512GB M.2 NVMe PCIe 4.0 SSD (Trống 1 slot M.2 NVMe)\r\n', 'NVIDIA® GeForce RTX™ 4050 Laptop GPU 6GB GDDR6, MUX Switch + Optimus, ROG Boost: 2420MHz* at 140W (2370MHz Boost Clock+50MHz OC, 115W+25W Dynamic Boost)\r\n', '2.5 kg', 'Eclipse Gray', '35.4 x 26.4 x 2.26 ~ 3.04 cm', 1),
(73, 'Laptop gaming ASUS TUF Gaming F15 FX506HF HN014W', 'laptop22.jpg', '100', 21.990, 16.990, 3, 'gaming', 'Intel® Core™ i5-11400H Processor 2.7 GHz (12M Cache, up to 4.5 GHz, 6 Cores)\r\n', '8GB DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB SSD M.2 PCIE G3X2, 1x slot M.2\r\n', 'NVIDIA® GeForce RTX™ 2050 Laptop GPU\r\n', '2.3 kg', 'Graphite Black', '35.9 x 25.6 x 2.28 ~ 2.45 cm', 1),
(74, 'Laptop gaming ASUS TUF A15 FA506ICB HN355W', 'laptop23.jpg', '100', 21.990, 16.990, 3, 'gaming', 'AMD Ryzen 5 4600H 3.0GHz up to 4.0GHz 11MB, 6-core/ 12-thread\r\n', '8GB DDR4 3200MHzHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB SSD M.2 PCIE G3X2 (2 Slot M2 PCIE, 1 Slot trống) \r\n', 'NVIDIA® GeForce RTX™ 3050 Laptop GPU 4GB GDDR6, up to 1600Mhz at 60W ( 75W with Dynamic Boost)\r\n', '2.3 kg', 'Graphite Black', '25.9 x 25.6 x 2.25 ~ 2.45 cm', 1),
(75, 'Laptop Gaming MSI Cyborg 15 A12UCX 281VN', 'laptop24.jpg', '100', 21.990, 18.290, 6, 'gaming', 'Intel Core i5-12450H (3.3GHz~4.4GHz) 8 Cores 12 Threads\r\n', '8GB (1 x 8GB) DDR5 4800MHz (2x SO-DIMM socket, up to 64GB SDRAM)\r\n', '512GB NVMe PCIe Gen 4 SSD \r\n', 'NVIDIA GeForce RTX 2050 4GB\r\n', '1.98 kg', 'Translucent Black', '359.36 x 250.34 x 21.95~22.9 mm', 1),
(76, 'Laptop Gaming Asus ROG Strix G15 G513RC HN090W', 'laptop25.jpg', '100', 30.990, 22.990, 3, 'gaming', 'AMD Ryzen™ 7-6800H (3.2GHz up to 4.7GHz, 16MB Cache)\r\n', '8GB DDR5-4800Mhz (2x SO-DIMM slots)\r\n', '512GB M.2 NVMe PCIe 4.0 SSD\r\n', 'NVIDIA® GeForce RTX™ 3050 4GB GDDR6\r\n', '2.10 kg', 'Electro Punk', '35.4 x 25.9 x 2.26 ~ 2.72 (cm)', 1),
(77, 'Laptop gaming MSI GF63 Thin 12VE 460VN', 'laptop26.jpg', '100', 22.490, 21.190, 6, 'gaming', 'Intel Core i5-12450H 3.3GHz up to 4.40GHz 12MB, 8 nhân, 12 luồng\r\n', '8GB (8x1) DDR4 3200MHz (2x SO-DIMM socket, up to 64GB SDRAM)\r\n', '512GB NVMe PCIe Gen 4x4 SSD ( Còn trống 1 khe 2.5\" SATA)\r\n', 'NVIDIA GeForce RTX 4050, 6GB GDDR6\r\n', '1.86 kg', 'Đen', '359 x 254 x 21.7 mm', 1),
(78, 'Laptop gaming ASUS ROG Strix G15 G513IE HN246W', 'laptop27.jpg', '100', 26.990, 21.990, 3, 'gaming', 'AMD Ryzen 7 4800H 2.9GHz up to 4.2GHz 8MB\r\n', '8GB (8x1) DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB M.2 NVMe PCIe 3.0 SSD (Còn trống 1 khe SSD M.2 PCIE)\r\n', 'NVIDIA GeForce RTX 3050Ti 4GB GDDR6 With With ROG Boost up to 1795MHz at 80W (95W with Dynamic Boost)\r\n', '2.1 kg', 'Eclipse Gray', '35.4(W) x 25.9(D) x 2.26 ~ 2.72(H) cm', 1),
(79, 'Laptop gaming MSI Katana GF66 12UCK 804VN', 'laptop28.jpg', '100', 26.990, 21.790, 6, 'gaming', 'Intel Core i7-12650H 3.5 GHz up to 4.7 GHz, 10 Cores 16 Threads, 24MB Cache\r\n', '8GB DDR4 3200MHz (2x SO-DIMM socket, up to 64GB SDRAM)\r\n', '512GB NVMe PCIe Gen 4 SSD (1 slot)\r\n', 'NVIDIA® GeForce RTX™ 3050 4GB GDDR6 Up to 1550MHz Boost Clock, 60W Maximum Graphics Power.\r\n', '2.25 kg', 'Đen', '359 x 259 x 24.9 mm', 1),
(80, 'Laptop gaming Acer Nitro 5 AN515 58 52SP', 'laptop29.jpg', '100', 27.990, 22.990, 2, 'gaming', 'Intel Core i5-12500H 3.3GHz up to 4.5GHz 18MB\r\n', '8GB DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB SSD M.2 PCIE (nâng cấp tối đa 1TB SSD PCIe Gen3, 8 Gb/s, NVMe và 2TB HDD 2.5-inch 5400 RPM) (Còn trống 1 khe SSD M.2 PCIE và 1 khe 2.5\" SATA)\r\n', 'NVIDIA® GeForce RTX™ 3050 4GB GDDR6\r\n', '2.5 kg', 'Obsidian Black', '360.4 x 271.09 x 25.9 mm', 1),
(81, 'Laptop gaming Acer Nitro 5 Tiger AN515 58 769J', 'laptop30.jpg', '100', 30.990, 25.490, 2, 'gaming', 'Intel Core i7-12700H up to 4.7GHz, 24MB Cache\r\n', '8GB DDR4 3200MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB PCIe NVMe SED SSD (Còn trống 1 khe SSD M.2 PCIE và 1 khe 2.5\" SATA)\r\n', 'NVIDIA® GeForce RTX™ 3050 4GB GDDR6\r\n', '2.5 kg', 'Obsidian Black', '360.4 x 271.09 x 25.9 mm', 1),
(82, 'Laptop gaming Dell G15 5525 R7H165W11GR3060', 'laptop31.jpg', '100', 27.490, 25.990, 4, 'gaming', 'AMD Ryzen 7 6800H (8C / 16T, 3.2 / 4.7GHz, 4MB L2 / 16MB L3)\r\n', '16GB (2x8GB) DDR5 4800MHz (2x SO-DIMM socket, up to 32GB SDRAM)\r\n', '512GB SSD M.2 PCIe PCIE G4X4\r\n', 'NVIDIA® GeForce RTX™ 3060 6GB GDDR6\r\n', '2.72 kg', 'Dark Shadow Grey', '357.26 x 272.11 x 26.90 (mm)', 1),
(83, 'MacBook Air M1 7GPU 8GB 256GB - Gold', 'laptop32.jpg', '100', 28.490, 18.690, 7, 'macbook', 'M1  8CPU 7GPU\r\n', '8GB', '256GB SSD\r\n', 'M1  8CPU 7GPU\r\n', '1.4 kg', 'Vàng', '304 x 212 x 4.1 mm', 1),
(84, 'Macbook Air M2 10GPU 8GB 512GB - Midnight', 'laptop33.jpg', '100', 41.990, 32.490, 7, 'macbook', 'M2 8CPU 10GPU\r\n', '8GB\r\n', '512GB', 'M2 8CPU 10GPU\r\n', '1.24 kg', 'Midnight', '30.41 x 21.5 x 1.13 cm', 1);

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
(8, 1, 'admin', 'Admin', 'admin@gmail.com', '$2y$10$tp0dlGHCvTmKluJ76Sp7hu2KGHX08P4vG.i1xezRW/75WNZf11.LK', '168/6 Trường Chinh, Phường 13, quận Tân Bình, TP Hồ Chí Minh', '0901284412', 'be7.jpg', 1, '2023-07-29 03:04:42'),
(19, 0, 'trolface', 'Tuấn Đẹt', 'trolface@gmail.com', '$2y$10$KnoUgOIwRhZ4qt07O9pSu.sox7AffcwqWy1Sy/hjYR6KOemRbFggG', 'Hồ Chí Minh', '0102030405', 'be7.jpg', 0, '2023-07-29 03:04:32');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

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
