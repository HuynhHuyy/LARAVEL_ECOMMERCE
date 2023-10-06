-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2022 lúc 04:43 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `soa_final`
--
CREATE DATABASE IF NOT EXISTS `soa_final` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soa_final`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_11_04_121743_create_tbl_admin', 1),
(3, '2022_11_04_122144_create_tbl_category', 1),
(4, '2022_11_04_122447_create_tbl_gallery', 1),
(5, '2022_11_05_133422_create_tbl_customer', 1),
(6, '2022_11_08_131901_create_tbl_brand', 1),
(7, '2022_11_10_134017_create_tbl_product', 1),
(10, '2022_11_14_024503_create_tbl_receipt', 2),
(11, '2022_11_15_080252_create_tbl_receipt', 3),
(12, '2022_11_16_014356_create_tbl_receipt', 4),
(13, '2022_11_16_150242_create_tbl_receipt', 5),
(15, '2022_11_17_042809_create_tbl_receipt', 6),
(18, '2022_11_17_143632_create_tbl_receipt', 7),
(25, '2022_11_17_155740_create_tbl_warranty', 8),
(26, '2022_11_19_101405_create_tbl_warranty', 9),
(27, '2022_11_19_161532_create_tbl_receipt', 10),
(28, '2022_11_20_060242_create_tbl_product', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '0781145235'),
(2, 'admin1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin1', '0898745258');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 1, '2022-11-11 07:48:08', NULL),
(2, 'Dell', 1, '2022-11-11 07:48:14', '2022-11-11 07:49:17'),
(3, 'Asus', 1, '2022-11-11 07:48:22', NULL),
(4, 'Hp', 1, '2022-11-11 07:48:29', NULL),
(5, 'Samsung', 1, '2022-11-11 07:48:35', NULL),
(6, 'Kingston', 1, '2022-11-11 07:48:41', NULL),
(7, 'LG', 1, '2022-11-11 07:48:48', NULL),
(8, 'MSI', 1, '2022-11-11 07:48:53', NULL),
(9, 'Western Digital', 1, '2022-11-11 07:49:00', NULL),
(10, 'Acer', 1, '2022-11-11 07:49:06', NULL),
(11, 'Toshiba', 0, '2022-11-11 07:49:11', '2022-11-15 08:57:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 1, '2022-11-11 07:47:05', NULL),
(2, 'Màn hình', 1, '2022-11-11 07:47:21', NULL),
(3, 'Ram', 1, '2022-11-11 07:47:28', NULL),
(4, 'SSD', 1, '2022-11-11 07:47:34', NULL),
(5, 'HDD', 1, '2022-11-11 07:47:40', '2022-11-11 07:47:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `customer_address`, `created_at`, `updated_at`) VALUES
(1, 'Huỳnh Quang Huy', 'hqhhuy00@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0789856541', 'Quận 7, TP HCM', '2022-11-11 07:52:40', '2022-11-11 07:54:35'),
(2, 'Trần Minh Kha', 'minhkha123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0925232178', 'Quận 4, TPHCM', '2022-11-11 07:53:12', NULL),
(3, 'Trương Tấn Hùng', 'tanhung114@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0856553231', 'Quận 1, TPHCM', '2022-11-11 07:53:46', NULL),
(4, 'Nguyễn Văn Đạt', 'datnguyen2001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0745654789', 'Quận 2, TPHCM', '2022-11-11 07:54:23', NULL),
(5, 'Lê Bảo Dũng', 'dungdung123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0714159512', 'Quận 3, TPHCM', '2022-11-11 07:55:29', NULL),
(6, 'Cao Bá Tuấn', 'khaikhai123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0778958525', 'Quận 6, TPHCM', '2022-11-11 07:56:11', '2022-11-11 07:58:33'),
(7, 'Nguyễn Hoàng Long', 'doraemon102@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0911745623', 'Quận 8, TPHCM', '2022-11-11 07:56:47', NULL),
(8, 'Lê Hồng Đức', 'nobita102@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0945625231', 'Quận 9, TPHCM', '2022-11-11 07:57:35', NULL),
(9, 'Đặng Minh Tâm', 'megafox123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0945612455', 'Quận 10, TPHCM', '2022-11-11 07:58:11', NULL),
(10, 'Nguyễn Văn An', 'nguyenan102@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0788963256', 'Bình Thạnh, TPHCM', '2022-11-18 00:20:43', NULL),
(11, 'Nguyễn Minh Phú', 'phunguyen2001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0989852657', 'Quận 1, TPHCM', '2022-11-18 00:49:13', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_sold` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_content` text COLLATE utf8_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_quantity`, `product_sold`, `category_id`, `brand_id`, `product_desc`, `product_content`, `product_price`, `product_image`, `weight`, `created_at`, `updated_at`) VALUES
(2, 'HP Probook 450 G9', 5, 0, 1, 4, 'Laptop HP Probook 450 G9 6M107PA mang đến vẻ bề ngoài thanh lịch và cực kỳ hiện đại với tông màu sang trọng. Bên cạnh màu sắc đẹp mắt, laptop khiến người dùng ấn tượng bởi thiết kế siêu mỏng và nhẹ mang đến tính di động hơn bao giờ hết.', 'Thông số kĩ thuật\r\nNhà sản xuất	HP\r\nModel	6M107PA\r\nHệ điều hành	Windows 11 Home\r\nCPU	Intel Core i7-1260P (3.4GHz~4.7GHz) 12 Cores 16 Threads\r\nCard VGA	Intel Iris Xe Graphics\r\nMemory	16GB (1 x 16GB) DDR4 3200MHz, 2 slot\r\nỔ cứng	\r\n512GB SSD M.2 PCIe\r\n\r\nBàn phím	Keyboard Backlit, touch pad cảm ứng đa điểm\r\nMàn hình	15.6 Inch FHD (1920 x 1080), IPS, anti-glare, 250 nits\r\nLan	Realtek 10/100/1000 GbE\r\nWLAN	Intel AX201 Wi-Fi 6E (2x2) + Bluetooth 5.2\r\nMàu sắc	Silver\r\nCổng kết nối	\r\n3 x USB 3.2 Gen1 Type-A\r\n1 x USB 3.2 Gen1 Type-C\r\n1 x HDMI 2.1b\r\n1 x RJ45\r\n1 x Mic-in/ Headphone-out combo jack\r\nWebcam	720P HD Camera\r\nAudilo	Stereo speakers\r\nPin	45Wh\r\nHỗ trợ Finger Print Reader	Có\r\nTrọng lượng	1.74 kg\r\nKích thước	359.4 x 233.9 x 19.9 mm\r\nBảo hành	1 năm', '27500000', '6478257621347859961.jpg', 1900, '2022-11-11 01:00:00', NULL),
(3, 'Asus Vivobook 15 X1502ZA-EJ129W', 5, 0, 1, 3, 'Laptop Asus Vivobook 15 X1502ZA-EJ129W mang tới cho bạn hiệu năng tuyệt đỉnh nhờ bộ vi xử lý Intel Core thế hệ 12th tới màn hình trong trẻo, sắc nét cùng bản lề mở 180° và thiết kế thanh lịch giúp bạn chinh phục mọi trải nghiệm.', 'Thông số kĩ thuật\r\nNhà sản xuất	Asus\r\nModel	X1502ZA-EJ129W\r\nHệ điều hành	Windows 11 Home\r\nCPU	Intel Core i7-1260P (2.1GHz~4.7GHz) 12 Cores 16 Threads\r\nCard VGA	Iris UHD Graphics\r\nMemory	8GB DDR4 onboard, 1 slot Ram trống (tối đa tổng 16GB)\r\nỔ cứng	\r\n512GB SSD M.2 PCIe Gen 3.0 (Hỗ trợ Gen 4.0)\r\n\r\nBàn phím	Backlit Chiclet Keyboard, touch pad cảm ứng đa điểm\r\nMàn hình	15.6 inch FHD (1920 x 1080) 220nits, Anti-glare\r\nLan	None\r\nWLAN	Intel Wi-Fi 6 802.11ax + Bluetooth 5.0\r\nMàu sắc	Quiet Blue\r\nCổng kết nối	\r\n2 x USB 3.2 Gen1 Type-A \r\n1 x USB 3.2 Gen1 Type-C\r\n1 x USB 2.0\r\n1 x HDMI 1.4\r\n1 x Audio 3.5mm jack\r\nWebcam	720P HD Camera With privacy shutter\r\nAudilo	SonicMaster\r\nHỗ trợ Finger Print Reader	Có\r\nPin	42Wh\r\nTrọng lượng	1.70 kg\r\nKích thước	359.7 x 232.5 x 19.9 mm\r\nBảo hành	2 năm', '20000000', '7448023111656383751.jpg', 1600, '2022-11-11 01:01:24', NULL),
(4, 'MacBook Pro 2020', 10, 0, 1, 1, 'Apple M1 - dòng chip mạnh nhất mà Apple thiết kế cho Macbook\r\nLaptop APPLE MacBook Pro 2020 MYDC2SA/A sở hữu dòng chip Apple M1 - thế hệ chip tiên tiến và mạnh nhất mà Apple từng thiết kế cho Macbook, mang đến hiệu suất và hiệu năng cao gấp nhiều lần các dòng sản phẩm trước đây.\r\n\r\nVới chip Apple M1, thiết bị sở hữu 8 lõi CPU, trong đó có 4 lõi hiệu suất cao và 4 lõi tiết kiệm điện. Trong trường hợp khách hàng thực hiện những tác vụ nặng thì thiết bị sẽ tận dụng tối đa các lõi hiệu suất cao và ngược lại, đối với những thao tác đơn giản, máy sẽ tự động chuyển sang sử dụng lõi tiết kiệm điện.', '- CPU: Apple M1\r\n- Màn hình: 13.3\" IPS (2560 x 1600)\r\n- RAM: 8GB Onboard LPDDR4 3733MHz\r\n- Đồ họa: Onboard\r\n- Lưu trữ: 512GB SSD /\r\n- Hệ điều hành: macOS\r\n- Pin liền\r\n- Khối lượng: 1.4kg', '36000000', '9231115501184722183.jpg', 1800, '2022-11-11 01:03:14', NULL),
(5, 'Màn hình LCD ACER K222HQL', 5, 0, 2, 10, 'Màn hình LCD Acer K222HQL có độ phân giải đạt chuẩn Full-HD 1920 x 1080 mang đến cho người dùng chất lượng hình ảnh sắc nét và màu sắc chân thật hơn. Sử dụng các công nghệ Led giúp cho người dùng đỡ mỏi mắt trong tình trạng sử dụng máy tính lâu dài. Đều thích hợp cho làm việc lẫn giải trí, có các cổng kết nối thông dụng tiện lợi.', '- Kích thước: 21.5\" (1920 x 1080), Tỷ lệ 16:9\r\n- Tấm nền TN, Góc nhìn: 90 (H) / 65 (V)\r\n- Tần số quét: 60Hz , Thời gian phản hồi 5 ms\r\n- HIển thị màu sắc: 16.7 triệu màu\r\n- Cổng hình ảnh: , 1 x HDMI, 1 x DVI-D, 1 x VGA/D-sub', '2500000', '903239201162519061.png', 3000, '2022-11-15 01:40:37', NULL),
(6, 'Màn hình Samsung', 10, 0, 2, 5, 'Sơ lược về Màn hình LCD Samsung 23.5\'\' LS24F350FHEXXV\r\n-Xem hoàn hảo từ mọi góc nhìn\r\n\r\n-Chơi game hấp dẫn, mượt mà\r\n\r\n-Thiết kế cong cho vẻ ngoài ấn tượng', '- Kích thước: 23.5\"\r\n- Độ phân giải: 1920 x 1080 ( 16:9 )\r\n- Công nghệ tấm nền: PLS\r\n- Góc nhìn: 178 (H) / 178 (V)\r\n- Tần số quét: 60Hz\r\n- Thời gian phản hồi: 4 ms', '5490000', '335465596853397834.jpg', 2500, '2022-11-11 01:06:19', NULL),
(7, 'Ram ddr3', 5, 0, 3, 6, 'Dung lượng: 4 GB\r\nChuẩn: DDR3L\r\nBus: 1600 MHz\r\nĐiện áp: 1.35v\r\nBảo hành: 3 năm', 'Thông số kĩ thuật\r\nNhà sản xuất	Kingston\r\nModel	F3-1600C111S-4GRSL\r\nChuẩn RAM	DDR3L SODIMM (Hỗ trợ DDR3 1.5v 1600MHz)\r\nBus hỗ trợ	1600 MHz\r\nDung lượng	4GB (1x4GB)\r\nĐiện áp	1.35v\r\nLatency	CL 11-11-11-28\r\nOverClock	Yes\r\nBảo hành	36 tháng', '500000', '338573601997671059.jpg', 500, '2022-11-11 01:08:37', NULL),
(8, 'SSD Kingston A400 2.5-Inch SATA III', 10, 0, 4, 6, 'Chuẩn SSD: 2.5 inches\r\nTốc độ đọc: 500 MB/s\r\nTốc độ ghi: 450 MB/s\r\nBảo hành 3 năm', 'Chuẩn SSD: 2.5 inches\r\nTốc độ đọc: 500 MB/s\r\nTốc độ ghi: 450 MB/s\r\nBảo hành 3 năm', '999000', '412032423305902159.jpg', 500, '2022-11-11 01:09:52', NULL),
(9, 'HDD WD Blue 1TB 3.5 inch SATA III 64MB', 10, 0, 5, 9, 'Chuẩn HDD: 3.5\" Inches SATA III \r\nSố vòng: 7200RPM\r\nTốc độ đọc: ~100 MB/s\r\nTốc độ ghi: ~100 MB/s\r\nBảo hành chính hãng 2 năm 1 đổi 1', 'Chuẩn HDD: 3.5\" Inches SATA III \r\nSố vòng: 7200RPM\r\nTốc độ đọc: ~100 MB/s\r\nTốc độ ghi: ~100 MB/s\r\nBảo hành chính hãng 2 năm 1 đổi 1', '950000', '3573883271594558482.jpg', 500, '2022-11-11 01:11:32', NULL),
(10, 'SSDnvme Kingston', 10, 0, 4, 6, 'Chuẩn SSD: M.2 NVMe Gen4 x4\r\nTốc độ đọc: 7000 MB/s\r\nTốc độ ghi: 3900 MB/s\r\nBảo hành chính hãng 5 năm 1 đổi 1', 'Chuẩn SSD: M.2 NVMe Gen4 x4\r\nTốc độ đọc: 7000 MB/s\r\nTốc độ ghi: 3900 MB/s\r\nBảo hành chính hãng 5 năm 1 đổi 1', '2000000', '125237218559077763.jpg', 500, '2022-11-11 01:13:33', NULL),
(13, 'Màn Hình Acer Nitro 27\" VG270', 10, 0, 2, 10, 'Thiết kế\r\nLà phiên bản mình hình rộng hơn so với người anh em cùng series Acer Nitro VG270 , màn hình LCD Acer 27\" VG270 giữ nguyên ngoại trang phong cách gaming chủ đạo của Nitro brand và có kích thước màn hình 27 ”, với 3 chân đứng vững chãi không chiếm nhiều diện tích, bạn có thể đặt sản phẩm trên bàn như một vậy tô điểm cho góc chơi game. Với thiết kế ZeroFrame, sản phẩm gần như loại bỏ đi viền màn hình, tăng tối đa không gian hiển thị. \r\n\r\nĐược thiết kế hướng tới đối tượng game thủ, LCD Acer 27\" VG270 có vẻ ngoài khá ngầu, góc cạnh, với chân đế sơn đỏ đặc sắc đem lại một ấn tượng khó cưỡng. Để giảm thiểu việc mỏi mệt khi chơi game, LCD Acer 27\" VG270 có thể chỉnh góc nhìn từ -5 độ đến 20 độ, tạo điều kiện tốt nhất cho các game thủ giữ được phong độ. Mặt sau cạnh trái là các nút tắt/bật và điều chỉnh.', '- Kích thước: 27\"\r\n- Độ phân giải: 1920 x 1080 ( 16:9 )\r\n- Công nghệ tấm nền: IPS\r\n- Góc nhìn: 178 (H) / 178 (V)\r\n- Tần số quét: 75Hz\r\n- Thời gian phản hồi: 1 ms.', '4500000', '449511228453074039.png', 3000, '2022-11-15 01:39:36', NULL),
(14, 'Laptop HP VICTUS 16-e0168AX 4R0U6PA', 5, 0, 1, 4, 'HP VICTUS 16-e0168AX (4R0U6PA) sở hữu cấu hình mạnh mẽ, đáp ứng nhu cầu hiệu năng cao trong công việc và giải trí của nhiều người dùng. Nằm ở phân khúc cao cấp, chiếc laptop HP hứa hẹn sẽ mang đến cho bạn những trải nghiệm mượt mà ấn tượng, xứng đáng với sự đầu tư.\r\nThiết kế nguyên khối sang trọng, trải nghiệm hình ảnh sống động\r\nHP VICTUS 16-e0168AX đảm bảo gọn gàng với kích thước 37 x 26 x 2.35 cm và trọng lượng 2.4 kg, cho phép người dùng thoải mái cho laptop vào balo, túi xách và mang đến bất kỳ đâu. Laptop HP cao cấp khoác lên một vẻ đẹp nguyên khối sang trọng với gam màu đen hiện đại và thu hút.', '- CPU: Ryzen 7 5800H\r\n- Màn hình: 16.1\" IPS (1920 x 1080),144Hz\r\n- RAM: 2 x 4GB DDR4 3200MHz\r\n- Đồ họa: RTX 3050Ti 4GB GDDR6 / AMD Radeon Graphics\r\n- Lưu trữ: 512GB SSD M.2 NVMe /\r\n- Hệ điều hành: Windows 11 Home SL\r\n- Pin: 4 cell 70 Wh\r\n- Khối lượng: 2.4kg', '20800000', '213259735649606090.jpg', 2400, '2022-11-15 01:44:10', NULL),
(15, 'Laptop HP OMEN 16-b0176TX 5Z9Q7PA', 10, 0, 1, 4, 'HP OMEN 16-b0176TX (5Z9Q7PA) thuộc phân khúc cao cấp, khai thác tiềm năng sức mạnh từ vi xử lý i7 thế hệ 11, kết hợp thiết kế hiện đại gọn gàng sẵn sàng để đồng hành cùng người dùng trong mọi trải nghiệm làm việc, giải trí ở bất kỳ đâu. \r\nKiểu dáng hoàn thiện cao cấp, khả năng di động linh hoạt \r\nLaptop HP OMEN 16-b0176TX gây ấn tượng bởi vẻ đẹp hoàn thiện từ các đường nét gọn gàng, kết hợp tông màu đen chủ đạo tạo nên tổng thể hiện đại và sang trọng. Chất liệu cấu tạo cao cấp tạo nên phiên bản laptop HP bền bỉ, đảm bảo trải nghiệm lâu dài.', '- CPU: Intel Core i7-11800H\r\n- Màn hình: 16.1\" IPS (1920 x 1080),144Hz\r\n- RAM: 2 x 8GB DDR4 3200MHz\r\n- Đồ họa: RTX 3060 6GB GDDR6 / Intel UHD Graphics\r\n- Lưu trữ: 1TB SSD M.2 NVMe /\r\n- Hệ điều hành: Windows 11 Home\r\n- Pin: 6 cell 83 Wh Pin liền\r\n- Khối lượng: 2.3kg', '46500000', '1669019841120708719.jpg', 2300, '2022-11-15 01:45:53', NULL),
(16, 'Laptop Dell Inspiron 14 5420', 10, 0, 1, 2, '- CPU: Intel Core i7-1255U\r\n- Màn hình: 14\" WVA (1920 x 1200)\r\n- RAM: 1 x 8GB DDR4 3200MHz\r\n- Đồ họa: Onboard Intel Iris Xe Graphics\r\n- Lưu trữ: 512GB SSD M.2 NVMe /\r\n- Hệ điều hành: Windows 11 Home SL + Office Home & Student 2021\r\n- Pin: 4 cell 54 Wh Pin liền\r\n- Khối lượng: 1.5kg', '- CPU: Intel Core i7-1255U\r\n- Màn hình: 14\" WVA (1920 x 1200)\r\n- RAM: 1 x 8GB DDR4 3200MHz\r\n- Đồ họa: Onboard Intel Iris Xe Graphics\r\n- Lưu trữ: 512GB SSD M.2 NVMe /\r\n- Hệ điều hành: Windows 11 Home SL + Office Home & Student 2021\r\n- Pin: 4 cell 54 Wh Pin liền\r\n- Khối lượng: 1.5kg', '22000000', '496756324882149244.jpg', 1500, '2022-11-15 01:49:37', NULL),
(17, 'Màn Hình LG 23.8\" 24MP88HV-S', 5, 0, 2, 7, 'Sơ lược\r\nTrong những năm gần đây, các hãng sản xuất màn hình đều tung ra thị trường các dòng sản phẩm hàng trung-cao cấp nổi bật với thiết kế không viền 3 cạnh rất được công đồng gamer và render chào đón bởi cảm quan hiển thị cực “chất”.\r\n\r\nDòng màn hình IPS là dòng màn hình giá rẻ nhưng vẫn có được chất lượng tốt dành cho người dùng. Sau đây, Phong Vũ xin được giới thiệu đến các bạn chiếc màn hình là IPS LG 24\'\' 24MP88HV-S, một sản phẩm đến từ thương hiệu nổi tiếng - LG Electronics. Màn hình mỏng cùng với thiết kế vuông vắn, IPS LG 24\'\' 24MP88HV-S mang lại một không gian rộng và đem đến cảm giác “tràn ngập” khi nhìn vào chiếc màn hình này.\r\n\r\n\r\nSơ qua về LG thì đây là một tập đoàn đến từ Hàn Quốc, được thành lập năm 1958 và cho đến nay, tập đoàn này luôn dẫn đầu trong kỷ nguyên kĩ thuật số nhờ vào những công nghệ tiên tiến. Và mới đây Gã khổng lồ LG đã trình làng một sản phẩm cực kỳ độc đáo. Đó là màn hình LCD LG 24\'\' 24MP88HV-S với đột phá rõ rệt về thiết kế -  không viền 4 cạnh. Chiếc màn hình hứa hẹn sẽ mang lại không gian làm việc ấn tượng và rất ít đụng hàng . Hãy cùng Phong vũ tìm hiểu nhé!', '- Kích thước: 23.8\"\r\n- Độ phân giải: 1920 x 1080 ( 16:9 )\r\n- Công nghệ tấm nền: IPS\r\n- Góc nhìn: 178 (H) / 178 (V)\r\n- Tần số quét: 60Hz\r\n- Thời gian phản hồi: 5 ms', '5100000', '4060621051336900154.jpg', 2000, '2022-11-15 01:51:58', NULL),
(18, 'Màn hình LCD MSI G272', 5, 0, 2, 8, 'MSI 27\" G272 là màn hình gaming có thiết kế viền siêu hẹp -  một trong những thiết kế hiện đại cao cấp hàng đầu hiện nay có thể giúp người dùng được tận hưởng cảm giác đắm chìm tốt nhất. Hơn nữa, màn hình còn sở hữu các thông số và công nghệ xử lí ấn tượng, mang đến hình ảnh hiển thị sắc nét, sống động đỉnh cao.\r\nHiển thị màu sắc chính xác, hình ảnh chân thực, rõ nét\r\nSở hữu kích thước 27 inch, độ phân giải FHD cùng khả năng hiển thị màu sắc lên đến 16,7 triệu màu, màn hình Optix G272 chắc chắn sẽ mang đến những hình ảnh sáng rõ, chi tiết và độ chính xác cực cao trong từng dải màu. Giúp bạn có thêm nhiều trải nghiệm hình ảnh sống động và chân thực.', '- Kích thước: 27\" (1920 x 1080), Tỷ lệ 16:9\r\n- Tấm nền IPS, Góc nhìn: 178 (H) / 178 (V)\r\n- Tần số quét: 144Hz , Thời gian phản hồi 1 ms\r\n- HIển thị màu sắc: 16.7 triệu màu\r\n- Công nghệ đồng bộ: Adaptive Sync\r\n- Cổng hình ảnh: 1 x DisplayPort 1.2a, 2 x HDMI 1.4', '30189000', '241269523908417998.jpg', 2800, '2022-11-15 01:56:08', NULL),
(19, 'Asus ROG Strix SCAR 15', 10, 0, 1, 3, 'Laptop Gaming Asus ROG Strix SCAR 15 G533ZS-LN036W mạnh mẽ với CPU Intel Core i9 thế hệ 12 Alder Lake mới nhất với hiệu năng vượt bật giúp phát huy hiệu suất tối đa trong việc xử lý dữ liệu và GPU GeForce RTX giúp bạn thoải mái trải nghiệm các ứng dụng và trò chơi khắt khe nhất. Màn hình cho màu sắc sống động như thật đã được chứng nhận Pantone cùng hệ thống âm thanh sống động giúp mọi thứ của bạn được xử lý dễ dàng hơn bao giờ hết.', 'Nhà sản xuất:	Asus\\r\\nModel:	G533ZS-LN036W\\r\\nHệ điều hành:	Windows 11 Home\\r\\nCPU:	Intel Core i9-12900H (Up to 5.0GHz) 14 Cores 20 Threads\\r\\nCard VGA:	\\r\\nNVIDIA GeForce RTX 3080 Laptop GPU 8GB GDDR6\\r\\n\\r\\nMemory	:\\r\\n32GB (16GB x 2) DDR5 4800MHz, 2 khe Ram nâng tối đa 64GB\\r\\n\\r\\nỔ cứng	:\\r\\n2TB SSD M.2 PCIe Gen4 x4\\r\\n\\r\\n1 x slot M.2 PCIe Gen4 x4\\r\\n\\r\\nBàn phím:	RGB Per-key, TouchPad cảm ứng đa điểm\\r\\nMàn hình:	ROG Nebula: 15.6 inch WQHD (2560 x 1440), IPS, 240Hz, 300Nits, MUX Switch + Optimus, 100% DCI-P3\\r\\nLan	Killer Gb LAN\\r\\nWLAN:	Intel Wi-Fi 6E 802.11ax + Bluetooth 5.2\\r\\nMàu sắc	Đen', '78000000', '8488572701332898906.jpg', 2300, '2022-11-19 23:16:20', NULL),
(20, 'Ram Laptop Kingston DDR4', 10, 0, 3, 6, 'Loại sản phẩm: Ram Laptop\r\nDung lượng: 16GB\r\nChuẩn: DDR4\r\nBus: 3200Mhz\r\nĐiện áp: 1.2v\r\nBảo hành: 3 năm', 'Loại sản phẩm: Ram Laptop\r\nDung lượng: 16GB\r\nChuẩn: DDR4\r\nBus: 3200Mhz\r\nĐiện áp: 1.2v\r\nBảo hành: 3 năm', '1215000', '589725600635689252.jpg', 500, '2022-11-20 20:07:21', NULL),
(21, 'Ram Laptop Kingston DDR4 8GB 3200MHz', 5, 0, 3, 6, 'Loại sản phẩm: Ram Laptop\r\nDung lượng: 8GB\r\nChuẩn: DDR4\r\nBus: 3200Mhz\r\nĐiện áp: 1.2v\r\nBảo hành: 3 năm', 'Loại sản phẩm: Ram Laptop\r\nDung lượng: 8GB\r\nChuẩn: DDR4\r\nBus: 3200Mhz\r\nĐiện áp: 1.2v\r\nBảo hành: 3 năm', '600000', '314037901509865745.jpg', 450, '2022-11-20 20:09:32', NULL),
(22, 'HDD WD Purple 1TB 3.5 inch SATA III 64MB Cache 5400RPM WD10PURZ', 10, 0, 5, 9, 'Chuẩn HDD: 3.5\" Inches SATA III\r\nSố vòng: 5400RPM\r\nTốc độ đọc: ~100 MB/s\r\nTốc độ ghi: ~100 MB/s\r\nBảo hành chính hãng 3 năm 1 đổi 1', 'Chuẩn HDD: 3.5\" Inches SATA III\r\nSố vòng: 5400RPM\r\nTốc độ đọc: ~100 MB/s\r\nTốc độ ghi: ~100 MB/s\r\nBảo hành chính hãng 3 năm 1 đổi 1', '999000', '62250197683285805.jpg', 700, '2022-11-20 20:11:49', NULL),
(23, 'SSD Samsung 870 Qvo 2TB 2.5-Inch SATA III MZ-77Q2T0', 5, 0, 4, 5, 'Chuẩn SSD: 2.5 inches\r\nTốc độ đọc: 560 MB/s\r\nTốc độ ghi: 530 MB/s', 'Chuẩn SSD: 2.5 inches\r\nTốc độ đọc: 560 MB/s\r\nTốc độ ghi: 530 MB/s', '4000000', '337642724659907744.jpg', 550, '2022-11-20 20:14:56', NULL),
(24, 'MacBook Pro 2022 13 inch Z16S00034 (M2/ 16GB/ SSD 512GB)', 10, 0, 1, 1, '- CPU: Apple M2\r\n- Màn hình: 13.3\" IPS (2560 x 1600)\r\n- RAM: 1 x 16GB\r\n- Đồ họa: Onboard\r\n- Lưu trữ: 512GB SSD /\r\n- Hệ điều hành: macOS\r\n- 58 Wh Pin liền\r\n- Khối lượng: 1.4kg', 'Pro 13 inch Z16S00034 của nhà Apple sở hữu một thiết kế thời thượng, sang trọng cùng với tính di động và gọn nhẹ. Máy được trang bị bộ vi xử lý độc quyền Apple M2 có hiệu năng hoạt động tối ưu, giúp xử lý tốt mọi tác vụ hàng ngày hay chỉnh sửa đồ họa. Không những thế, chiếc máy này còn đảm bảo đáp ứng đủ dải nhu cầu sử dụng từ cơ bản đến nâng cao hứa hẹn sẽ làm hài lòng đến mọi khách hàng.', '42000000', '307277743594147108.jpg', 1400, '2022-11-20 20:17:35', NULL),
(25, 'Laptop Gaming Acer Nitro 5 AN515-45-R86D NH.QBCSV.005', 5, 0, 1, 10, 'CPU: Ryzen 7 5800H (3.2GHz~4.4GHz) 8 Cores 16 Threads\r\nVGA: GeForce RTX 3060 6GB\r\nRam: 8GB DDR4 3200 MHz\r\nỔ cứng: 512GB SSD M.2 PCIe\r\nMàn hình: 15.6\'\' IPS 144Hz FHD\r\nBảo hành 1 năm.', 'CPU: Ryzen 7 5800H (3.2GHz~4.4GHz) 8 Cores 16 Threads\r\nVGA: GeForce RTX 3060 6GB\r\nRam: 8GB DDR4 3200 MHz\r\nỔ cứng: 512GB SSD M.2 PCIe\r\nMàn hình: 15.6\'\' IPS 144Hz FHD\r\nBảo hành 1 năm.', '27000000', '3512059491102836081.jpg', 2700, '2022-11-20 20:19:54', NULL),
(26, 'Laptop Dell XPS 13 Plus 9320 5CG56', 10, 0, 1, 2, 'CPU: i7-1260P (Up to 4.7GHz) 12 Cores 16 Threads\r\nVGA: Iris Xe Graphics\r\nRam: 16GB LPDDR5 5200MHz\r\nỔ cứng: 512GB SSD M.2 PCIe Gen4\r\nMàn hình: 13.4\" OLED 3.5K TouchScreen\r\nBảo hành 1 năm.', 'CPU: i7-1260P (Up to 4.7GHz) 12 Cores 16 Threads\r\nVGA: Iris Xe Graphics\r\nRam: 16GB LPDDR5 5200MHz\r\nỔ cứng: 512GB SSD M.2 PCIe Gen4\r\nMàn hình: 13.4\" OLED 3.5K TouchScreen\r\nBảo hành 1 năm.', '59000000', '607502031496182830.jpg', 1700, '2022-11-20 20:22:50', NULL),
(27, 'Laptop Gaming MSI Bravo 15 B5DD-276VN', 10, 0, 1, 8, 'CPU: Ryzen 5 5600H (3.3GHz~4.2GHz) 6 Cores 12 Threads\r\nVGA: AMD Radeon RX 5500M 4GB\r\nRam: 8GB DDR4 3200MHz\r\nỔ cứng: 512GB SSD M.2 PCIe NVMe Gen3 x4\r\nMàn hình: 15.6\'\' IPS FHD\r\nBảo hành 1 năm.', 'CPU: Ryzen 5 5600H (3.3GHz~4.2GHz) 6 Cores 12 Threads\r\nVGA: AMD Radeon RX 5500M 4GB\r\nRam: 8GB DDR4 3200MHz\r\nỔ cứng: 512GB SSD M.2 PCIe NVMe Gen3 x4\r\nMàn hình: 15.6\'\' IPS FHD\r\nBảo hành 1 năm.', '27000000', '783874578361987090.jpg', 2700, '2022-11-20 20:30:52', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_receipt`
--

CREATE TABLE `tbl_receipt` (
  `receipt_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `receipt_product` text COLLATE utf8_unicode_ci NOT NULL,
  `receipt_status` int(11) DEFAULT NULL,
  `shipping_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_money` bigint(20) NOT NULL,
  `receipt_date` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_warranty`
--

CREATE TABLE `tbl_warranty` (
  `warranty_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `warranty_status` int(11) NOT NULL DEFAULT 0,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `warranty_date` date NOT NULL,
  `return_date` date NOT NULL,
  `product_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Chỉ mục cho bảng `tbl_warranty`
--
ALTER TABLE `tbl_warranty`
  ADD PRIMARY KEY (`warranty_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
  MODIFY `receipt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_warranty`
--
ALTER TABLE `tbl_warranty`
  MODIFY `warranty_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
