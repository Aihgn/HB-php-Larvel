-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 30, 2019 lúc 07:23 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_hotelbooking`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `id_user`, `name`, `email`, `phone_number`, `address`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'nghia nguyễn', 'nghia@g', '450002', 'Hoan kiem, Hanoi', 'do not ', '2019-04-23 05:19:53', '2019-04-22 22:19:53'),
(2, 2, 'mm', 'nghia@gm', '084321654889', '222-jn k', NULL, '2019-05-09 08:21:07', '2019-05-09 01:21:07'),
(3, NULL, 'cuong', 'cuong@g', '123', '123', 'x', '2019-05-06 10:57:29', '0000-00-00 00:00:00'),
(4, NULL, 'Cong', 'cong@g', '222', '126', '55', '2019-05-06 10:57:29', '0000-00-00 00:00:00'),
(10, 8, 'i', 'i@i', NULL, NULL, NULL, '2019-05-06 22:41:39', '2019-05-06 22:41:39'),
(11, 9, 'e2', '33@3', NULL, NULL, NULL, '2019-05-06 22:43:09', '2019-05-06 22:43:09'),
(12, 10, '12@23', 't@q', NULL, NULL, NULL, '2019-05-06 22:49:50', '2019-05-06 22:49:50'),
(13, 11, 're@', 'u@r', NULL, NULL, NULL, '2019-05-06 22:54:59', '2019-05-06 22:54:59'),
(14, NULL, 'ccxz', 'zxczx@w', 'zxc', NULL, NULL, '2019-05-20 23:44:28', '2019-05-20 23:44:28'),
(15, NULL, 'minux', 'mmi@i', '9898987', NULL, NULL, '2019-05-20 23:48:09', '2019-05-20 23:48:09'),
(16, NULL, 'opi', 'r@t', '1456', NULL, NULL, '2019-05-21 00:46:12', '2019-05-21 00:46:12'),
(17, NULL, 'f', 'r@r', '12123', NULL, NULL, '2019-05-21 00:47:08', '2019-05-21 00:47:08'),
(18, NULL, 'ee', 'e@4', '23', NULL, NULL, '2019-05-21 00:47:43', '2019-05-21 00:47:43'),
(19, NULL, 'ee', 'e@4', '23', NULL, NULL, '2019-05-21 00:47:43', '2019-05-21 00:47:43'),
(20, NULL, 'ee', 'e@4', '23', NULL, NULL, '2019-05-21 00:47:43', '2019-05-21 00:47:43'),
(21, NULL, 'c', 'c@r', '2131', NULL, NULL, '2019-05-21 00:52:07', '2019-05-21 00:52:07'),
(22, NULL, 'df', '2@4', '1231', NULL, NULL, '2019-05-21 00:52:45', '2019-05-21 00:52:45'),
(23, NULL, 'dsf', 'f@f', 'saf', NULL, NULL, '2019-05-21 00:53:33', '2019-05-21 00:53:33'),
(24, NULL, 'dsf', 'f@f', 'saf', NULL, NULL, '2019-05-21 00:53:42', '2019-05-21 00:53:42'),
(25, NULL, 'ksak1', 'q@e', '123456', NULL, NULL, '2019-05-21 01:32:42', '2019-05-21 01:32:42'),
(26, NULL, 'uj', 'uu@j', '123456', NULL, NULL, '2019-05-21 01:34:46', '2019-05-21 01:34:46'),
(27, NULL, 'n', 'n2J@W', '12132', NULL, NULL, '2019-05-21 01:36:27', '2019-05-21 01:36:27'),
(28, NULL, 'jjh', 'j@j', '3434', NULL, NULL, '2019-05-21 01:36:53', '2019-05-21 01:36:53'),
(29, NULL, 'jjh', 'j@j', '3434', NULL, NULL, '2019-05-21 01:37:39', '2019-05-21 01:37:39'),
(30, NULL, 'nghia', 'nghia@gmail', '1245', NULL, NULL, '2019-05-21 02:25:45', '2019-05-21 02:25:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(10) UNSIGNED DEFAULT NULL,
  `total` double NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0:Pending, 1:Done, 2:Cancel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reservation`
--

INSERT INTO `reservation` (`id`, `id_customer`, `total`, `date_in`, `date_out`, `status`) VALUES
(1, 2, 300, '2019-05-21', '2019-05-24', 1),
(2, 4, 500, '2019-05-24', '2019-05-24', 1),
(3, 5, 200, '2019-05-24', '2019-05-24', 0),
(4, 2, 1000, '2019-05-24', '2019-05-25', 2),
(5, 14, 1, '2019-05-30', '2019-06-08', 0),
(6, 15, 1, '2019-05-23', '2019-05-31', 0),
(7, 16, 1, '2019-05-23', '2019-05-30', 0),
(8, 17, 1, '1970-01-01', '1970-01-01', 0),
(9, 18, 1, '2019-05-22', '2019-05-24', 1),
(10, 19, 1, '2019-05-22', '2019-05-24', 0),
(11, 20, 1, '2019-05-22', '2019-05-24', 0),
(12, 21, 1, '2019-05-22', '2019-05-23', 0),
(13, 22, 1, '2019-05-24', '2019-05-25', 0),
(14, 24, 600, '1970-01-01', '1970-01-01', 0),
(15, 26, 600, '2019-05-24', '2019-05-24', 0),
(16, 27, 3500, '2019-05-30', '2019-06-04', 0),
(17, 29, 2400, '1970-01-01', '1970-01-01', 0),
(18, 2, 600, '2019-05-22', '2019-05-23', 0),
(19, 30, 650, '2019-05-23', '2019-05-24', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reservation_detail`
--

CREATE TABLE `reservation_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_reservation` int(10) UNSIGNED NOT NULL,
  `id_room` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_type` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0: empty, 1:used',
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`id`, `id_type`, `status`, `expiry_date`) VALUES
(2001, 1, 1, '0000-00-00'),
(2002, 1, 0, '0000-00-00'),
(2003, 2, 0, '0000-00-00'),
(2004, 2, 0, '0000-00-00'),
(2005, 2, 0, '0000-00-00'),
(2006, 3, 0, '0000-00-00'),
(2007, 3, 0, '0000-00-00'),
(2008, 4, 0, '0000-00-00'),
(2009, 4, 0, '0000-00-00'),
(2010, 4, 0, '0000-00-00'),
(3001, 1, 0, '0000-00-00'),
(3002, 1, 0, '0000-00-00'),
(3003, 2, 0, '0000-00-00'),
(3004, 2, 0, '0000-00-00'),
(3005, 2, 0, '0000-00-00'),
(3006, 3, 0, '0000-00-00'),
(3007, 3, 0, '0000-00-00'),
(3008, 4, 0, '0000-00-00'),
(3009, 4, 0, '0000-00-00'),
(3010, 4, 0, '0000-00-00'),
(4001, 1, 0, '0000-00-00'),
(4002, 1, 0, '0000-00-00'),
(4003, 2, 0, '0000-00-00'),
(4004, 2, 0, '0000-00-00'),
(4005, 2, 0, '0000-00-00'),
(4006, 3, 0, '0000-00-00'),
(4007, 3, 0, '0000-00-00'),
(4008, 4, 0, '0000-00-00'),
(4009, 4, 0, '0000-00-00'),
(4010, 4, 0, '0000-00-00'),
(5001, 1, 0, '0000-00-00'),
(5002, 1, 0, '0000-00-00'),
(5003, 2, 0, '0000-00-00'),
(5004, 2, 0, '0000-00-00'),
(5005, 2, 0, '0000-00-00'),
(5006, 3, 0, '0000-00-00'),
(5007, 3, 0, '0000-00-00'),
(5008, 4, 0, '0000-00-00'),
(5009, 4, 0, '0000-00-00'),
(5010, 4, 0, '0000-00-00'),
(6001, 1, 0, '0000-00-00'),
(6002, 1, 0, '0000-00-00'),
(6003, 2, 0, '0000-00-00'),
(6004, 2, 0, '0000-00-00'),
(6005, 2, 0, '0000-00-00'),
(6006, 3, 0, '0000-00-00'),
(6007, 3, 0, '0000-00-00'),
(6008, 4, 0, '0000-00-00'),
(6009, 4, 0, '0000-00-00'),
(6010, 4, 0, '0000-00-00'),
(7001, 1, 0, '0000-00-00'),
(7002, 1, 0, '0000-00-00'),
(7003, 2, 0, '0000-00-00'),
(7004, 2, 0, '0000-00-00'),
(7005, 2, 0, '0000-00-00'),
(7006, 3, 0, '0000-00-00'),
(7007, 3, 0, '0000-00-00'),
(7008, 4, 0, '0000-00-00'),
(7009, 4, 0, '0000-00-00'),
(7010, 4, 0, '0000-00-00'),
(8001, 1, 0, '0000-00-00'),
(8002, 1, 0, '0000-00-00'),
(8003, 2, 0, '0000-00-00'),
(8004, 2, 0, '0000-00-00'),
(8005, 2, 0, '0000-00-00'),
(8006, 3, 0, '0000-00-00'),
(8007, 3, 0, '0000-00-00'),
(8008, 4, 0, '0000-00-00'),
(8009, 4, 0, '0000-00-00'),
(8010, 4, 0, '0000-00-00'),
(9001, 1, 0, '0000-00-00'),
(9002, 1, 0, '0000-00-00'),
(9003, 2, 0, '0000-00-00'),
(9004, 2, 0, '0000-00-00'),
(9005, 2, 0, '0000-00-00'),
(9006, 3, 0, '0000-00-00'),
(9007, 3, 0, '0000-00-00'),
(9008, 4, 0, '0000-00-00'),
(9009, 4, 0, '0000-00-00'),
(9010, 4, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_room`
--

CREATE TABLE `type_room` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_adult` int(11) NOT NULL,
  `number_of_child` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_room`
--

INSERT INTO `type_room` (`id`, `name`, `image`, `price`, `description`, `number_of_adult`, `number_of_child`) VALUES
(1, 'Family Room', 'room1.jpg', 300, 'The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.', 2, 3),
(2, 'Luxury room\r\n', 'room2.jpg', 350, 'The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.', 3, 3),
(3, 'Couple room', 'room3.jpg', 250, 'The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty  $200/case.', 2, 1),
(4, 'Standard room', 'room4.jpg', 200, 'The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.', 2, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nghia nguyễn', 'nghia@g', NULL, '$2y$10$wVkH.WeyBDXpXx3.XXou4e.KqYHwm7uDNxNvwSO/3B70pOIV61muq', NULL, '2019-03-22 09:05:56', '2019-04-22 23:02:25'),
(2, 'mm', 'nghia@gm', NULL, '$2y$10$wYcrorUohNje7gyVnFyHVO9.r2Ip.eJudDi71GtlPgg/NjymhJ4Sy', NULL, '2019-04-08 07:19:53', '2019-05-09 01:21:07'),
(3, 'c', 'nghia@m', NULL, '$2y$10$0NwfEqdGmXx5KPiR6pZOmued9V3tDlVGFE9b3EfRWMgVTT9Tw0IM2', NULL, '2019-05-06 22:05:18', '2019-05-06 22:05:18'),
(8, 'i', 'i@i', NULL, '$2y$10$.xz8NPYq6Og8W3u8zOZC9O/JFBW85z0xkPiWAZQvaxaiQUWF.OaQa', NULL, '2019-05-06 22:41:39', '2019-05-06 22:41:39'),
(9, 'e2', '33@3', NULL, '$2y$10$1cgy8tE0foS5CVh3wqLZFere109NIZqsZ0zrgk0FDBqguDRFQ8QHa', NULL, '2019-05-06 22:43:09', '2019-05-06 22:43:09'),
(10, '12@23', 't@q', NULL, '$2y$10$zxsP/4agVZrc.xc.gSjyq.FzgO49YfXeA1YFpKaL6qN.XHT.8QRhe', NULL, '2019-05-06 22:49:50', '2019-05-06 22:49:50'),
(11, 're@', 'u@r', NULL, '$2y$10$niTfYcJnbhYfPcJq1BrXOeXDE.2ubYFoWlyS3MjidYieVUmBGKSaW', NULL, '2019-05-06 22:54:59', '2019-05-06 22:54:59');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Chỉ mục cho bảng `reservation_detail`
--
ALTER TABLE `reservation_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bill` (`id_reservation`),
  ADD KEY `id_room` (`id_room`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`);

--
-- Chỉ mục cho bảng `type_room`
--
ALTER TABLE `type_room`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `reservation_detail`
--
ALTER TABLE `reservation_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9011;

--
-- AUTO_INCREMENT cho bảng `type_room`
--
ALTER TABLE `type_room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Các ràng buộc cho bảng `reservation_detail`
--
ALTER TABLE `reservation_detail`
  ADD CONSTRAINT `reservation_detail_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `reservation_detail_ibfk_3` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`);

--
-- Các ràng buộc cho bảng `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
