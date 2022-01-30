-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2022 at 06:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `repair_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `per_id` int(11) NOT NULL,
  `per_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`per_id`, `per_name`) VALUES
(1, 'ผู้ดูแล'),
(3, 'งานป้าย'),
(4, 'หัวหน้าช่าง'),
(5, 'งานสโตร์'),
(6, 'งานโลตัส');

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `id` int(11) NOT NULL,
  `inventory_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `technician` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `call1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_name` text COLLATE utf8_unicode_ci NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'รอดำเนินการ',
  `12` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`id`, `inventory_id`, `description`, `user_id`, `technician`, `updated_at`, `created_at`, `image`, `call1`, `number`, `Address`, `Customer_name`, `date`, `status`, `12`) VALUES
(240, 'sada', 'dsdsadasd', 26, 26, '2022-01-30 05:12:24', '2022-01-30 05:11:53', '-1643519513.', '2222222222', 'sssssss', '191/2 ม.7 ต.ดอนปรู อ.ศรีประจันต์', 'ปารมิน สุภาพงษ์', '2022-01-13', 'ส่งงาน', '');

-- --------------------------------------------------------

--
-- Table structure for table `repair_detail`
--

CREATE TABLE `repair_detail` (
  `id` int(11) NOT NULL,
  `repair_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `note` varchar(210) COLLATE utf8_unicode_ci DEFAULT 'ไม่ได้ระบุ',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `call1` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bg_color` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `text_color` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#000000',
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `bg_color`, `text_color`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(1, 'กำลังดำเนินการ', '#0080ff', '#ffffff', 'Y', 'N', '2020-03-31 18:41:34', '2020-03-31 18:41:34'),
(2, 'สำเร็จ', '#008040', '#ffffff', 'Y', 'N', '2020-03-31 18:41:34', '2020-03-31 18:41:34'),
(3, 'ยกเลิก', '#ff0000', '#ffffff', 'Y', 'N', '2020-03-31 18:41:34', '2020-03-31 18:41:34'),
(12, 'ส่งซ่อมศูนย์', '#8000ff', '#ffffff', 'Y', 'N', '2020-04-01 10:48:18', '2020-04-01 10:48:18'),
(13, 'ส่งร้านนอก', '#800080', '#ffffff', 'Y', 'N', '2020-04-01 10:48:24', '2020-04-01 10:48:24'),
(14, 'แจ้งซ่อม', '#80ffff', '#000000', 'Y', 'N', '2020-04-02 05:05:30', '2020-04-02 05:05:30'),
(15, 'ไม่สำเร็จ', '#ff8000', '#000000', 'Y', 'N', '2020-04-02 05:06:04', '2020-04-02 05:06:04'),
(16, 'รออะไหล่', '#808000', '#ffffff', 'Y', 'N', '2020-04-02 05:06:12', '2020-04-02 05:06:12'),
(17, 'รอตรวจสอบ', '#ffff00', '#000000', 'Y', 'N', '2020-04-02 18:28:19', '2020-04-02 18:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `title`, `name`, `updated_at`, `created_at`) VALUES
(1, 'ระบบแจ้งซ่อม', 'ระบบแจ้งซ่อม', '2020-07-07 06:19:44', '2019-12-26 18:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `ui_language`
--

CREATE TABLE `ui_language` (
  `id` int(11) NOT NULL,
  `en` text COLLATE utf8_unicode_ci NOT NULL,
  `th` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ui_language`
--

INSERT INTO `ui_language` (`id`, `en`, `th`) VALUES
(2, 'Login', 'เข้าสู่ระบบ'),
(3, 'Thailand', 'ภาษาไทย'),
(4, 'English', 'ภาษาอังกฤษ'),
(5, 'Username', 'ชื่อผู้ใช้งาน'),
(6, 'Password', 'รหัสผ่าน'),
(7, 'Welcome', 'ยินดีต้อนรับ'),
(9, 'Dashboard', 'แดชบอร์ด'),
(10, 'Home', 'หน้าแรก'),
(11, 'Profile', 'โปรไฟล์'),
(12, 'Logout', 'ออกจากระบบ'),
(13, 'Users', 'ผู้ใช้งาน'),
(14, 'Systems', 'ระบบ'),
(15, 'Settings', 'ตั้งค่า'),
(16, 'Category', 'หมวดหมู่'),
(17, 'Type', 'ประเภท'),
(18, 'Brand', 'ยี่ห้อ'),
(19, 'Detail', 'รายละเอียด'),
(20, 'Status', 'สถานะ'),
(21, 'Topic', 'ชื่องาน'),
(22, 'Order', 'สั่งงาน'),
(23, 'Enabled', 'เปิดใช้งาน'),
(24, 'disable', 'ปิดใช้งาน'),
(25, 'Background Color', 'สีพื้นหลัง'),
(26, 'Select Color', 'เลือกสี'),
(27, 'Text Color', 'สีข้อความ'),
(28, 'Save', 'บันทึก'),
(29, 'Problem', 'ปัญหา'),
(30, 'Name', 'ชื่อ'),
(31, 'Color', 'สี'),
(32, 'Edit', 'แก้ไข'),
(33, 'Delete', 'ลบ'),
(34, 'Select All', 'เลือกทั้งหมด'),
(35, 'Trash', 'ถังขยะ'),
(36, 'No', 'ไม่'),
(37, 'Yes', 'ใช่'),
(38, 'Are you want to delete all?', 'คุณต้องการลบทั้งหมด?'),
(39, 'Do you want to delete this information?', 'คุณต้องการลบข้อมูลนี้หรือไม่?'),
(40, 'Please Enter Name', 'โปรดระบุชื่อ'),
(41, 'New Inventory', ''),
(42, 'Picture', 'รูปภาพ'),
(43, 'Send to Repair', 'ส่งซ่อม'),
(44, 'Worn out', 'ชำรุด'),
(45, 'Choose File', 'เลือกไฟล์'),
(46, 'Serial Number', 'รหัสเครื่อง'),
(48, 'Please Select Category', 'โปรดเลือกหมวดหมู่'),
(49, 'Please Select Type', 'โปรดเลือกประเภท'),
(50, 'Please Select Brand', 'โปรดเลือกยี่ห้อ'),
(51, 'Please Enter Serial Number', 'โปรดระบุรหัสเครื่อง'),
(52, 'Disabled', 'ปิดใช้งาน'),
(53, 'Extensions Support', 'การสนับสนุนส่วนขยาย'),
(54, 'Home', 'หน้าหลัก'),
(55, 'Please Enter Problem', 'โปรดระบุปัญหา'),
(56, 'Please Enter Brand', 'โปรดระบุยี่ห้อ'),
(58, 'Title', 'หัวข้อ'),
(59, 'Data update successful.', 'อัปเดตข้อมูลสำเร็จแล้ว'),
(60, 'Please Enter Title', 'โปรดระบุหัวข้อ'),
(61, 'Please Enter Type', 'โปรดระบุประเภท'),
(62, 'Please Enter Category', 'โปรดระบุหมวดหมู่'),
(64, 'New User', 'เพิ่มผู้ใช้'),
(65, 'Full Name', 'ชื่อและนามสกุล'),
(66, 'Position', 'ตำแหน่ง'),
(67, 'View', 'ดู'),
(68, 'User', 'ผู้ใช้'),
(69, 'Prolfile', 'ข้อมูลส่วนตัว'),
(70, 'Email', 'อีเมล'),
(71, 'Gender', 'เพศ'),
(72, 'BirthDay', 'วันเกิด'),
(73, 'Phone Number', 'เบอร์โทร'),
(74, 'Male', 'ชาย'),
(75, 'First Name', 'ชื่อ'),
(76, 'Last Name', 'นามสกุล'),
(77, 'Gender', 'เพศ'),
(78, 'Female', 'หญิง'),
(80, 'Upload', 'อัพโหลด'),
(81, 'Info', 'ข้อมูล'),
(82, 'Change Password', 'เปลี่ยนรหัสผ่าน'),
(83, 'Current Password', 'รหัสผ่านปัจจุบัน'),
(84, 'New Password', 'รหัสผ่านใหม่'),
(85, 'Confirm Password', 'ยืนยันรหัสผ่าน'),
(86, 'Please Enter Username', 'กรุณาใส่ชื่อผู้ใช้'),
(87, 'Please Enter First Name', 'กรุณาใส่ชื่อ'),
(88, 'Please Enter Last Name', 'กรุณาใส่นามสกุล'),
(89, 'Please Enter Email', 'กรุณาใส่อีเมล'),
(90, 'Please Enter Current Password', 'กรุณาใส่รหัสผ่านปัจจุบัน'),
(91, 'Please Enter New Password', 'กรุณาใส่รหัสผ่านใหม่'),
(92, 'Your password must be at least 6 characters long.', 'รหัสผ่านของคุณจะต้องมีความยาวอย่างน้อย 6 ตัวอักษร'),
(93, 'Please Enter Confirm Password', 'กรุณาใส่รหัสผ่านยืนยัน'),
(94, 'Please enter the same password as above.', ' กรุณาใส่รหัสผ่านเดียวกันกับด้านบน'),
(95, 'Upload', 'อัปโหลด'),
(96, 'Last Name', 'นามสกุล'),
(97, 'Order list', 'รายการสั่ง'),
(98, 'Delivery date', 'วันที่ส่ง'),
(99, 'Operator', 'ผู้สั่งงาน'),
(100, 'responsible man', 'ผู้รับผิดชอบ'),
(101, 'Please Select Inventory', 'กรุณาเลือกรายการ'),
(102, 'Please Select Problem', 'กรุณาเลือกปัญหา'),
(103, 'Description', 'ลักษณะอาการ'),
(104, 'Techician', 'ช่าง'),
(105, 'Please Select Technician', 'กรุณาเลือกช่าง'),
(106, 'No results found', 'ไม่พบผลลัพธ์'),
(107, 'Please Enter Description', 'กรุณาระบุลักษณะอาการ'),
(108, 'Successful data deletion.', 'ลบข้อมูลสำเร็จแล้ว'),
(109, 'Repair Today', 'รายการซ่อมวันนี้'),
(110, 'View More', 'ดูเพิ่มเติม'),
(111, 'Successfully saved data.', 'บันทึกข้อมูลสำเร็จแล้ว'),
(112, 'Inventory Enabled', 'เปิดใช้งานรายการ'),
(113, 'Inventory Disabled', 'ปิดใช้งานรายการ'),
(114, 'Inventory Send To Repair', 'รายการที่ส่งซ่อม'),
(115, 'Inventory Worn out', 'รายการที่เสีย'),
(116, 'Do you want to Logout?', 'คุณต้องการออกจากระบบหรือไม่'),
(117, 'Language', 'ภาษา'),
(118, 'EN', 'อังกฤษ'),
(119, 'TH', 'ไทย'),
(120, 'Detail', 'รายละเอียด'),
(121, 'Order Update', 'ปรับปรุงคำสั่ง'),
(122, 'Note', 'บันทึก'),
(123, 'Close', 'ปิด'),
(124, 'Add', 'เพิ่ม'),
(125, 'Cancel successful.', 'ยกเลิกสำเร็จ'),
(126, 'Repair Info', 'ข้อมูลซ่อม'),
(127, 'List Repair', 'รายการซ่อม'),
(128, 'Teahician', 'ช่าง'),
(129, 'List Techician', 'รายซื่อช่าง'),
(130, 'Online order system', 'ระบบสั่งงานออนไลน์'),
(131, 'Send Mail', 'ส่งอีเมล'),
(132, 'Price', 'ราคา'),
(133, 'take notes', 'จดบันทึก'),
(134, 'Subject', 'หัวข้อ'),
(135, 'detil', 'รายละเอียด'),
(136, 'Order', 'สั่งงาน'),
(137, 'Inventory', ''),
(138, 'Repair', ''),
(139, 'Repair List', ''),
(140, 'take notes', ''),
(141, 'number', 'ใบผลิตหมายเลข'),
(142, 'responsible', ''),
(143, 'Invalid Data.', ''),
(145, 'Print', 'พิมพ์'),
(146, 'Technician', ''),
(147, 'Customer name', 'ชื่อลูกค้า'),
(148, 'Address', 'ที่อยู่'),
(149, 'Date', ''),
(150, 'startus', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('M','F') COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT 2,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `is_delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `gender`, `birthdate`, `email`, `phone_number`, `profile`, `position`, `is_active`, `is_delete`, `updated_at`, `created_at`) VALUES
(26, 'admin', '$2y$10$4LF/.nmuBTQH8G6kU7DJ/ekql3cGtRZHVge7plFiN/S/2amMn.ZAq', 'ปารมิน', 'สุภาพงษ์', 'M', '1994-01-13', 'paramin@gmail.com', '0928195249', '1597245602_26.jpg', 1, 'Y', 'N', '2020-08-12 15:20:01', '2019-12-27 04:28:27'),
(56, 'user001', '$2y$10$8YMy4LuDaO0lUC3Npddfc.EctKppczwlEj6IjrJGivOUoryyEGSqy', 'mr.1', '1', 'M', '2021-04-25', 'adxc@v.com', '1234', '', 3, 'Y', 'N', '2021-04-21 23:34:25', '2021-04-21 23:34:08'),
(57, 'user002', '$2y$10$i3OouMIdJ76KRFhCVGbf7OTJGt8AN6LE1oFKlQLsowPT8F5Q2DHZ6', 'mr.2', '2', 'M', '2021-04-25', 'admidn@admin.com', '123456', '', 6, 'Y', 'N', '2021-04-21 23:35:03', '2021-04-21 23:35:03'),
(58, 'user003', '$2y$10$3fSMR1ztMSgRjpPt9.gRQOjXefJ.GwGfCEPxgGjIdLzo3wcFfCKWe', 'mr.3', '3', 'M', '2021-04-28', 'admiddn@admin.com', '156', '', 5, 'Y', 'N', '2021-04-21 23:35:42', '2021-04-21 23:35:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_id` (`repair_id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ui_language`
--
ALTER TABLE `ui_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `repair_detail`
--
ALTER TABLE `repair_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ui_language`
--
ALTER TABLE `ui_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `repair_detail`
--
ALTER TABLE `repair_detail`
  ADD CONSTRAINT `repair` FOREIGN KEY (`repair_id`) REFERENCES `repair` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
