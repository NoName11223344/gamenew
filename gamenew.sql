-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 29, 2023 lúc 01:10 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `gamenew`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `agency`
--

CREATE TABLE `agency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `agency`
--

INSERT INTO `agency` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Đại lý 1', '2023-04-18 22:29:04', '2023-04-19 17:02:20'),
(3, 'Đại lý 2', '2023-04-18 22:29:11', '2023-04-19 17:02:11'),
(4, 'Đại lý 3', '2023-04-18 22:29:17', '2023-04-20 10:55:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(10) UNSIGNED NOT NULL,
  `bank_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `bank_short_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_no`, `bank_name`, `status`, `bank_short_name`, `created_at`, `updated_at`) VALUES
(2, '970423', 'Ngân hàng TMCP Tiên Phong', 1, 'TPBANK', '2019-01-04 13:54:55', '2020-12-30 08:16:01'),
(3, '970437', 'Ngân hàng TMCP Phát Triển Thành Phố Hồ Chí Minh', 1, 'HDBANK', '2019-01-04 13:55:27', '2020-12-30 08:16:00'),
(4, '970408', 'Ngân hàng TM TNHH MTV Dầu Khí Toàn Cầu', 1, 'GPBANK', '2019-01-04 13:55:59', '2020-12-30 08:16:01'),
(5, '970407', 'Ngân hàng TMCP Kỹ thương Việt Nam', 1, 'TECHCOMBANK', '2019-01-04 13:56:34', '2020-12-30 08:16:00'),
(6, '970442', 'Ngân hàng TNHH MTV Hongleong Việt Nam', 1, 'HONGLEONGBANK', '2019-01-04 13:59:56', '2020-12-30 08:16:00'),
(7, '970414', 'Ngân hàng TMCP Đại Dương', 1, 'OCEANBANK', '2019-01-04 14:00:44', '2020-12-30 08:16:00'),
(8, '970438', 'Ngân hàng TMCP Bảo Việt', 1, 'BAOVIET', '2019-01-04 14:01:57', '2020-12-30 08:16:00'),
(9, '970422', 'Ngân hàng TMCP Quân Đội', 1, 'MBBANK', '2019-01-04 14:02:30', '2020-12-30 08:16:00'),
(10, '970432', 'Ngân hàng TMCP Việt Nam Thịnh Vương', 1, 'VPBANK', '2019-01-04 14:03:19', '2020-12-30 08:16:01'),
(11, '970439', 'Ngân hàng TNHH MTV Public Việt Nam', 1, 'PUBLICBANK', '2019-01-04 14:03:53', '2020-12-30 08:16:00'),
(12, '970415', 'Ngân hàng TMCP Công Thương Việt Nam', 1, 'VIETINBANK', '2019-01-04 14:04:14', '2020-12-30 08:16:01'),
(13, '970431', 'Ngân hàng TMCP Xuất nhập khẩu Việt Nam', 1, 'EXIMBANK', '2019-01-04 14:04:52', '2020-12-30 08:16:01'),
(14, '970440', 'Ngân hàng TMCP Đông Nam Á', 1, 'SEABANK', '2019-01-04 14:05:16', '2020-12-30 08:16:01'),
(15, '970429', 'Ngân hàng TMCP Sài Gòn', 1, 'SCB', '2019-01-04 14:05:45', '2020-12-30 08:16:01'),
(16, '970448', 'Ngân hàng TMCP Phương Đông', 1, 'OCB', '2019-01-04 14:06:54', '2020-12-30 08:16:02'),
(17, '970425', 'Ngân hàng TMCP An Bình', 1, 'ABBANK', '2019-01-04 14:07:53', '2020-12-30 08:16:00'),
(18, '970426', 'Ngân hàng TMCP Hàng Hải Việt Nam', 1, 'MSB', '2019-01-04 14:08:22', '2020-12-30 08:16:01'),
(19, '970427', 'Ngân hàng TMCP Việt Á', 1, 'VIETABANK', '2019-01-04 14:09:41', '2020-12-30 08:16:00'),
(20, '970419', 'Ngân hàng TMCP Quốc Dân', 1, 'NCB', '2019-01-04 14:10:03', '2020-12-30 08:16:01'),
(21, '970418', 'Ngân hàng TMCP Đầu tư và Phát triển Việt Nam', 1, 'BIDV', '2019-01-04 14:10:40', '2020-12-30 08:16:00'),
(22, '970443', 'Ngân hàng TMCP Sài Gòn - Hà Nội', 1, 'SHB', '2019-01-04 14:11:08', '2020-12-30 08:16:01'),
(23, '970406', 'Ngân hàng TMCP Đông Á', 1, 'DONGABANK', '2019-01-04 14:11:31', '2020-12-30 08:16:01'),
(24, '970441', 'Ngân hàng TMCP Quốc Tế', 1, 'VIB', '2019-01-04 14:11:58', '2020-12-30 08:16:00'),
(25, '970424', 'Ngân hàng TNHH MTV Shinhan Việt Nam', 1, 'SHINHANBANK', '2019-01-04 14:12:33', '2020-12-30 08:16:01'),
(26, '970433', 'Ngân hàng TMCP Việt Nam Thương Tín', 1, 'VIETBANK', '2019-01-04 14:12:56', '2020-12-30 08:16:01'),
(27, '970454', 'Ngân hàng TMCP Bản Việt', 1, 'VIETCAPITALBANK', '2019-01-04 14:14:49', '2020-12-30 08:16:01'),
(28, '970452', 'Ngân hàng TMCP Kiên Long', 1, 'KIENLONGBANK', '2019-01-04 14:15:08', '2020-12-30 08:16:01'),
(29, '970430', 'Ngân hàng TMCP Xăng Dầu Petrolimex', 1, 'PGBANK', '2019-01-04 14:18:08', '2020-12-30 08:16:00'),
(30, '970400', 'Ngân hàng TMCP Sài Gòn Công Thương', 1, 'SAIGONBANK', '2019-01-04 14:18:33', '2020-12-30 08:16:01'),
(31, '970405', 'Ngân hàng Nông Nghiệp và Phát triển Nông Thôn Việt Nam', 1, 'AGRIBANK', '2019-01-04 14:19:20', '2020-12-30 08:16:01'),
(32, '970403', 'Ngân hàng TMCP Sài Gòn Thương Tín', 1, 'SACOMBANK', '2019-01-04 14:19:44', '2020-12-30 08:16:01'),
(33, '970412', 'Ngân hàng TMCP Đại Chúng Việt Nam', 1, 'PVCOMBANK', '2019-01-04 14:20:05', '2020-12-30 08:16:00'),
(34, '970421', 'Ngân hàng Liên Doanh Việt Nga', 1, 'VRB', '2019-01-04 14:20:29', '2020-12-30 08:16:00'),
(35, '970428', 'Ngân hàng TMCP Nam Á', 1, 'NAMABANK', '2019-01-04 14:20:50', '2020-12-30 08:16:01'),
(36, '970434', 'Ngân hàng TNHH Indovina', 1, 'IVB', '2019-01-04 14:21:32', '2020-12-30 08:16:01'),
(37, '970449', 'Ngân hàng TMCP Bưu Điện Liên Việt', 1, 'LIENVIETPOSTBANK', '2019-01-04 14:21:58', '2020-12-30 08:16:00'),
(38, '970436', 'Ngân hàng TMCP Ngoại thương Việt Nam', 1, 'VIETCOMBANK', '2019-01-04 14:22:22', '2020-12-30 08:16:01'),
(39, '970416', 'Ngân hàng TMCP Á Châu', 1, 'ACB', '2019-01-04 14:23:13', '2020-12-30 08:16:00'),
(40, '970458', 'Ngân hàng TNHH MTV United Overseas Bank', 1, 'UOB', '2019-01-04 14:23:53', '2020-12-30 08:16:00'),
(41, '970446', 'Ngân hàng Co-op Bank', 1, 'COOPBANK', '2019-01-04 14:26:25', '2020-12-30 08:16:00'),
(42, '970455', 'Ngân hàng IBK - chi nhánh Hà Nội', 1, 'IBK', '2019-01-04 14:28:08', '2020-12-30 08:16:00'),
(45, '970409', 'Ngân hàng TMCP Bắc Á', 1, 'BACA', '2019-04-23 08:55:07', '2020-12-30 08:16:00'),
(46, '422589', 'Ngân hàng TNHH MTV CIMB', 1, 'CIMB', '2020-10-01 11:33:30', '2020-12-30 08:16:01'),
(47, '796500', 'Ngân hàng DBS - Chi nhánh Hồ Chí Minh', 1, 'DBS', NULL, NULL),
(48, '458761', 'TNHH MTV HSBC Việt Nam ', 1, 'HSBC', NULL, NULL),
(49, '970410', 'TNHH MTV Standard Chartered Việt Nam', 1, 'SCVN', NULL, NULL),
(50, '801011', 'Nonghuyp - Chi nhánh Hà Nội', 1, 'NHB', NULL, NULL),
(51, '970444', 'TM TNHH MTV Xây Dựng Việt Nam ', 1, 'CBBANK', '2022-04-13 14:25:03', '2022-04-13 14:25:06'),
(52, '970456', ' IBK - chi nhánh HCM', 1, 'IBK - HCM', '2022-04-13 14:25:55', '2022-04-13 14:25:58'),
(53, '970462', 'Kookmin - Chi nhánh Hà Nội', 1, 'KBHN', '2022-04-13 14:26:29', '2022-04-13 14:26:32'),
(54, '970463', 'Kookmin - Chi nhánh Thành phố Hồ Chí Minh', 1, 'KBHCM', '2022-04-13 14:27:21', '2022-04-13 14:27:24'),
(55, '546034', 'Ngân hàng số CAKE by VPBank', 1, 'CAKE', '2022-04-13 14:27:58', '2022-04-13 14:28:00'),
(56, '546035', 'Ngân hàng số Ubank by VPBank', 1, 'UBANK', '2022-04-13 14:28:20', '2022-05-05 16:47:52'),
(58, '970457', 'TNHH MTV Woori Việt Nam', 1, 'WOORIBANK', '2022-05-09 16:03:41', '2022-05-10 14:21:55'),
(59, '999888', 'Chính sách Xã hội', 1, 'VBSP', '2022-05-10 14:22:24', '2022-05-16 08:31:03'),
(60, '970467', 'NGÂN HÀNG KEB HANA - CHI NHÁNH HÀ NỘI', 1, 'KEB Hana HN', '2022-10-20 14:42:20', '2022-10-20 14:42:23'),
(61, '971011', 'Trung tâm dịch vụ tài chính số VNPT – Chi nhánh Tổng công ty truyền thông', 1, 'VNPT Money', '2022-10-20 14:43:18', '2022-10-20 14:43:22'),
(62, '971005', 'Tổng Công ty Dịch vụ Số Viettel – Chi nhánh Tập đoàn Công nghiệp Viễn thông Quân đội', 1, 'Viettel Money', '2022-10-20 14:44:37', '2022-10-20 14:44:39'),
(63, '970466', 'NGÂN HÀNG KEB HANA - CHI NHÁNH THÀNH PHỐ HỒ CHÍ MINH', 1, 'KEB Hana HCM', '2022-10-20 14:46:20', '2022-10-20 14:46:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_admin`
--

CREATE TABLE `bank_admin` (
  `id` int(11) NOT NULL,
  `bank_no` varchar(255) DEFAULT NULL,
  `acc_no` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `acc_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bank_admin`
--

INSERT INTO `bank_admin` (`id`, `bank_no`, `acc_no`, `created_at`, `updated_at`, `acc_name`) VALUES
(3, '970415', '106878194208', '2023-04-18 21:12:14', NULL, 'PHAM NGOC LAM'),
(4, '970407', '19036001623015', '2023-04-18 21:12:47', NULL, 'PHAM NGOC LAM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_user`
--

CREATE TABLE `bank_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `information`
--

INSERT INTO `information` (`id`, `title`, `content`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Link chơi game', 'https://www.scv388.com/', 'link-choi-game', '2023-04-19 12:19:31', '2023-04-19 12:19:31'),
(3, 'Số điện thoại', '+84 3938 333 27', 'so-dien-thoai', '2023-04-19 18:05:42', '2023-04-19 18:05:42'),
(4, 'Telegram', 'https://t.me/cskhalowin247', 'telegram', '2023-04-19 16:38:49', '2023-04-19 16:38:49'),
(5, 'Zalo', 'https://zalo.me/0977352404', 'zalo', '2023-04-19 18:01:01', '2023-04-19 18:01:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripiton` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `promotion`
--

INSERT INTO `promotion` (`id`, `code`, `name`, `descripiton`, `image`, `status`, `time_start`, `time_end`, `rate`, `updated_at`, `created_at`) VALUES
(1, 'MTP1200', 'Khuyến mãi 1', 'Hãy thử khuyến mãi đặc biệt này', 'https://www.shutterstock.com/image-vector/promotion-square-sticker-sign-banner-260nw-1427755229.jpg', 1, '2023-04-13 22:34:31', '2023-04-28 22:34:35', 20, '2023-04-15 22:34:42', '2023-04-15 22:34:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `acc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0 nạp tiền 1 rút tiền ',
  `status` int(11) DEFAULT 0 COMMENT '0 chờ duyệt\r\n1 Đã duyệt\r\n2 hủy',
  `memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nội dung',
  `request_time` datetime DEFAULT NULL COMMENT 'Thời gian yêu cầu ',
  `update_end_status_at` datetime DEFAULT NULL COMMENT 'Thời gian cập nhật trạng thái',
  `user_update` int(11) DEFAULT NULL COMMENT 'Người cập nhật ',
  `promotion_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã khuyến mãi',
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Note',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `agency_id` int(11) DEFAULT NULL COMMENT 'Mã Đại lý '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` int(11) DEFAULT NULL COMMENT '3 : 1đ = 100.000đ \r\n2 : 1đ = 50.000đ \r\n1 : 1đ = 25.000đ',
  `code` int(11) DEFAULT NULL COMMENT 'Mã code đăng nhập',
  `status` int(11) DEFAULT 0 COMMENT '0: Chờ kích hoạt\r\n1: Đã kích hoạt',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` datetime DEFAULT NULL,
  `role` int(11) DEFAULT 0 COMMENT '0: user thường 1:user admin 2:Đại lý',
  `sale_id` int(11) DEFAULT NULL COMMENT 'Tên người phụ trách',
  `zalo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Số zalo',
  `agency_id` int(11) DEFAULT NULL COMMENT 'Đại lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `phone`, `rate`, `code`, `status`, `updated_at`, `created_at`, `role`, `sale_id`, `zalo`, `agency_id`) VALUES
(4, 'admin', 'eyJpdiI6Im1USXI5VnZYeUlCNUJxbDAwUkdIcHc9PSIsInZhbHVlIjoiNW96ZVJLZlhqVUtiY0JzSmEwWW1pQT09IiwibWFjIjoiYWFhZDgzZmQ4MjVhNjM5YjA2MzEzNTg3OTg3ZThhNzZjOGEwZWFmOWRiMGJmNTU1YTEzNDliMmFlZTExMDJkNSJ9', 'admin', '0357147884', 2, NULL, 1, '2023-04-30 16:02:30', '2023-04-16 22:48:16', 0, NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `bank`
--
ALTER TABLE `bank`
  ADD UNIQUE KEY `bank_id_bank_no` (`bank_id`,`bank_no`) USING BTREE;

--
-- Chỉ mục cho bảng `bank_admin`
--
ALTER TABLE `bank_admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `bank_user`
--
ALTER TABLE `bank_user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`) USING BTREE;

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `agency`
--
ALTER TABLE `agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `bank_admin`
--
ALTER TABLE `bank_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bank_user`
--
ALTER TABLE `bank_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
