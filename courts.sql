-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 03:41 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courts`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `tracking_id`, `payment_method`, `name`, `email`, `address`, `created_at`, `order_status`, `total_price`) VALUES
(22, 'MYKHHWZVYK', 'credit_card', 'aiman', 'aiman@gmail.com', 'No 74.asd2', '2023-07-15 13:39:03', 'Pending', '1868.00'),
(23, 'MYYAGPETOO', 'credit_card', 'Asyraf', 'asdas@asda.com', 'asdasd', '2023-07-15 14:21:41', 'Pending', '2996.00'),
(26, 'MY8H5PJVCY', 'paypal', 'asdasd', 'asd@asd', 'carsik', '2023-07-15 18:32:08', 'Pending', '3395.00'),
(27, 'MY5L1YMZVF', 'credit_card', 'ASYRAF SALIHIN BIN ZAMRI ', 'asyrafsalihin@gmail.com', 'No 59, Taman Paramount, 02600 Arau, Perlis', '2023-07-15 21:23:05', 'Pending', '7147.00'),
(28, 'MY48VT0U46', 'Card', 'raf', 'asad@gmail.com', 'no 23, sds', '2023-07-15 22:47:48', 'Pending', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `img`) VALUES
(1, 'Gembira 2 Sofa Set 3/2/1 Pvc - Black', 'Brand: Gembira\nType: 3/2/1 set\nMaterial: PVC\nColour: Black', '2299.00', 'Sofa', 'img1.jpeg'),
(2, 'Marina Sofa Sydyan 3 Seater Fabric - Green', 'Brand: Marina\nType: 3 seater\nMaterial: Fabric\nColour: Green', '1699.00', 'Sofa', 'img2.jpeg'),
(3, 'Huxley Sofa 3/2/1 Pvc - Sand', 'Brand: Huxley\nType: 3/2/1 set\nMaterial: PVC\nColour: Sand', '3699.00', 'Sofa', 'img3.jpeg'),
(4, 'Golnaz Sofa Ocean Blue 3/2/1 Fabric - Ocean Blue', 'Brand: Golnaz\r\nType: 3/2/1 set\r\nMaterial: Fabric\r\nColour: OceanBlue', '2899.00', 'Sofa', 'img4.jpeg'),
(5, 'YG Sofa 3/2/1 Fabric - Denim Blue ', 'Brand: YG\nType: 3/2/1 set\nMaterial: Fabric\nColour: Denim Blue', '2699.00', 'Sofa', 'img5.jpeg'),
(6, 'Milado Sofa 1 Fabric - Blue', 'Brand: Milado\nType: 1 seater\nMaterial: Fabric\nColour: Blue', '999.00', 'Sofa', 'img6.jpeg'),
(7, 'Nicollo Sofa 3/2 Pvc - Dark Brown', 'Brand: Nicollo\nType: 3/2/1 set\nMaterial: PVC\nColour: Dark Brown', '2399.00', 'Sofa', 'img7.jpeg'),
(8, 'Everum Sofa L Shape Fabric - Grey', 'Brand: Everum\nType: L-shaped\nMaterial: Fabric\nColour: Grey', '1899.00', 'Sofa', 'img8.jpeg'),
(9, 'Better2moro Single Metal', 'Brand: Better2moro\nType: single bed', '499.00', 'Bed', 'img9.jpeg'),
(10, 'Kingkoil Queen Bed', 'Brand: Kingkoil\nType: Queen Bed', '799.00', 'Bed', 'img10.jpeg'),
(11, 'Mentari Queen Bed', 'Brand: Mentari\nType: Queen Bed', '1939.00', 'Bed', 'img11.jpeg'),
(12, 'Mikko Queen Bed', 'Brand: Mikko\nType: Queen Bed', '2899.00', 'Bed', 'img12.jpeg'),
(13, 'Comfort Queen Bed', 'Brand: Kingkoil\nType: Queen Bed', '1399.00', 'Bed', 'img13.jpeg'),
(14, 'Mikko King Bed', 'Brand: Mikko\nType: King Bed', '4699.00', 'Bed', 'img14.jpeg'),
(15, 'Mason Single Bed', 'Brand: Mason\nType: single Bed', '699.00', 'Bed', 'img15.jpeg'),
(16, 'Mentari King Bed', 'Brand: Mentari\nType: Queen Bed', '4599.00', 'Bed', 'img16.jpeg'),
(17, 'Veronica Console Table', 'Brand: Veronica\nType: Console Table', '599.00', 'Table', 'img17.jpeg'),
(18, 'Renato Coffee Table', 'Brand: Renato\nType: Coffee Table', '899.00', 'Table', 'img18.jpeg'),
(19, 'Su Office Table', 'Brand: SU\nType: Office Table', '169.00', 'Table', 'img19.jpeg'),
(20, 'Kino Coffee Table', 'Brand: Kino\nType: Coffee Table', '149.00', 'Table', 'img20.jpeg'),
(21, 'Zara Study Table', 'Brand: Zara\nType: Study Table', '199.00', 'Table', 'img21.jpeg'),
(22, 'Jayden Coffee Table', 'Brand: Jayden\nType: Coffee Table', '149.00', 'Table', 'img22.jpeg'),
(23, 'Daisy Round Tray Table', 'Brand: Daisy\nType: Round Tray Table', '99.00', 'Table', 'img23.jpeg'),
(24, 'Kayla Round Tray Table', 'Brand: Kayla\nType: Round Tray Table', '69.00', 'Table', 'img24.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
