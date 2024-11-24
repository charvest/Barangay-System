-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 07:42 AM
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
-- Database: `baranggay_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `profile_picture`, `fullname`, `username`, `email`, `address`, `created_at`) VALUES
(1, '../uploads/672a0cfff26e2_462964500_1955964674870616_925921412955339252_n.jpg', 'sato jeremy', 'jrmysto', 'jeremysato6@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-04 18:33:45'),
(3, '../uploads/profile_pictures/672a13940b674.webp', 'Jeremy Sato Bisnar', 'kopalogs', 'jeremysato2@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-04 18:54:15'),
(5, NULL, 'Jeremy Sato Bisnar', 'Guest', 'jeremysato71@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-04 19:06:30'),
(8, 'uploads/67291b5374b53_436202161_1140222430742155_235950264055455527_n.jpg', 'Jeremy Sato Bisnar', 'jrmy', 'jeremysato11@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-04 19:06:59'),
(11, NULL, 'jrmmtt', 'borat', 'jeremysato9@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-04 19:28:52'),
(14, '../uploads/profile_pictures/672a12f4342d7.jpg', 'Jeremy Sato Bisnar', 'jeremysato', 'jeremysato7@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-05 12:35:24'),
(15, '../uploads/profile_pictures/672a5bf99bd03.webp', 'kenji pascual', 'kenji pascual', 'kenjipascual@28gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-05 17:54:36'),
(16, '../uploads/profile_pictures/672a6f9e40062.webp', 'jeremysatobisnar', 'jeremysato21', 'jeremysato21@gmail.com', '163 samar street blk 13 kenneth pinagbuhatan pasig', '2024-11-05 19:18:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
