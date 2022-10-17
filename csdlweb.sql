-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 09:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csdlweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `ho_ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dt` int(20) NOT NULL,
  `ma_dinh_danh` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_tien` int(20) NOT NULL,
  `so_luong_ks` int(20) NOT NULL,
  `so_cau_ks` int(20) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `ho_ten`, `dia_chi`, `so_dt`, `ma_dinh_danh`, `email`, `mo_ta`, `gia_tien`, `so_luong_ks`, `so_cau_ks`, `trang_thai`) VALUES
(15, 'Quản Đức Thắng', 'viet tri', 348070196, 'kh123', 'quanducthang142000@gmail.com', 'ỵgjtyurr6ue6ut', 1500000, 3, 36, 0),
(42, 'trong tuan', 'ha nam', 321687864, 'kh464', 'tuan123456@gmail.com', 'rthytyhtyh', 2460000, 5, 40, 1),
(980, 'ọppj', 'kopkp', 78565764, 's434', 'nhocquan142@gmail.com', 'tydtydrtdt', 980809798, 6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `permission_group`, `delete_at`, `create_at`, `update_at`) VALUES
(1, 'Thêm nhân viên', 'Tạo tài khoản nhân viên mới', '', NULL, NULL, NULL),
(2, 'Sửa tài khoản nhân viên', 'Cập nhật, thay đổi thông tin về nhân viên', '', NULL, '2022-10-08 04:38:57', NULL),
(3, 'Xóa tài khoản nhân viên', 'Xóa tài khoản nhân viên khỏi dữ liệu', '', NULL, '2022-10-08 06:39:38', NULL),
(8, 'Thêm thông tin khách hàng', 'Nhập thêm thông tin của khách hàng vào cơ sở dữ liệu ', '', NULL, '2022-10-14 11:58:44', NULL),
(9, 'Quản lý khách hàng', 'Thêm sửa xóa, kích hoạt tài khoản khách hàng', '', NULL, '2022-10-14 13:44:55', NULL),
(10, 'Quản lý khảo sát', 'Thêm sửa xóa thông tin khảo sát', '', NULL, '2022-10-14 13:45:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reset_pass`
--

CREATE TABLE `reset_pass` (
  `id` int(10) NOT NULL,
  `m_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_token` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_time` bigint(20) NOT NULL,
  `m_numcheck` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Nhân viên', 'Nhân viên kinh doanh', NULL, '2022-10-08 06:28:09', '2022-10-14 13:47:50'),
(4, 'Kế toán', 'dsvfdbvhdfbv', NULL, '2022-10-08 06:34:02', '2022-10-08 13:34:20'),
(12, 'Trưởng nhóm', 'Trưởng nhóm kinh doanh', NULL, '2022-10-12 11:34:50', '2022-10-14 11:59:31'),
(13, 'Quản trị viên', 'Có toàn quyền trong hệ thống', NULL, '2022-10-14 14:09:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`id`, `permission_id`, `role_id`) VALUES
(12, 1, 1),
(6, 1, 2),
(14, 1, 8),
(24, 1, 11),
(32, 1, 12),
(35, 1, 13),
(13, 2, 1),
(15, 2, 8),
(25, 2, 11),
(36, 2, 13),
(21, 3, 4),
(16, 3, 8),
(17, 3, 9),
(27, 3, 10),
(26, 3, 11),
(37, 3, 13),
(22, 4, 4),
(18, 4, 9),
(33, 9, 3),
(34, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(20) NOT NULL,
  `infor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `user`, `email`, `number`, `infor`) VALUES
(9, 'khanh', 'minh@gmail.com', 1234567894, 'pi-opiop'),
(10, 'lam', 'genhayashi.zeyonichi@gmail.com', 64987564, 'iuyoiyu'),
(11, 'thang', 'quanducthang142000@gmail.com', 348070196, '54-9=o0-=op=ơp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(20) NOT NULL,
  `addr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaytao` timestamp NULL DEFAULT NULL,
  `ngaysua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `number`, `addr`, `ngaytao`, `ngaysua`) VALUES
(9, 'admin', 'admin123', 'admin@gmail.com', 1234567894, 'hung yen', NULL, NULL),
(11, 'trang', 'trang123', 'trang@gmail.com', 165464651, 'ha noi', NULL, NULL),
(16, 'minh', 'minh123', 'minh@gmail.com', 64987564, 'phu tho', NULL, NULL),
(17, 'thang', 'thang123', 'quanducthang142000@gmail.com', 179846513, 'viet tri', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_roles`
--

CREATE TABLE `user_has_roles` (
  `id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_roles`
--

INSERT INTO `user_has_roles` (`id`, `role_id`, `user_id`) VALUES
(15, 1, 3),
(6, 1, 5),
(4, 1, 6),
(11, 1, 7),
(10, 2, 1),
(5, 2, 6),
(26, 3, 11),
(28, 3, 17),
(12, 4, 8),
(16, 9, 3),
(17, 10, 3),
(27, 13, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_pass`
--
ALTER TABLE `reset_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`,`role_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id int` (`role_id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6547;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reset_pass`
--
ALTER TABLE `reset_pass`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
