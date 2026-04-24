-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-03-18 16:11:46
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `dentalclinic`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `adminmed`
--

CREATE TABLE `adminmed` (
  `ser` int(3) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ',
  `medcode` varchar(5) NOT NULL COMMENT 'รหัสหมายเลขยา',
  `medname` varchar(255) NOT NULL COMMENT 'ชื่อของยา',
  `unit` int(10) NOT NULL COMMENT 'จำนวนยา',
  `medtype` varchar(20) NOT NULL COMMENT 'ชนิดยา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `adminmed`
--

INSERT INTO `adminmed` (`ser`, `medcode`, `medname`, `unit`, `medtype`) VALUES
(11, '100', 'พารา', 1, 'ยาแก้ปวด');

-- --------------------------------------------------------

--
-- テーブルの構造 `appointement`
--

CREATE TABLE `appointement` (
  `ser` tinyint(4) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ',
  `userid` varchar(10) NOT NULL COMMENT 'ID ผู้จอง',
  `username` varchar(50) NOT NULL COMMENT 'ชื่อผู้จอง',
  `code` varchar(30) NOT NULL COMMENT 'หมายเลขทันตกรรม',
  `dentist` varchar(25) NOT NULL COMMENT 'ชื่อทันตแพทย์',
  `regdate` varchar(20) NOT NULL COMMENT 'วันที่จอง',
  `regtime` varchar(5) NOT NULL COMMENT 'เวลาจอง',
  `status` varchar(15) NOT NULL COMMENT 'สถานะการจอง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `appointement`
--

INSERT INTO `appointement` (`ser`, `userid`, `username`, `code`, `dentist`, `regdate`, `regtime`, `status`) VALUES
(59, '52', 'admin', 'Rs 100 - ถอนฟัน', '1 - พญ.สมศรี มีสุข', '2026-03-15', '09:00', 'ยืนยัน'),
(61, '53', 'test', 'Rs 100 - ถอนฟัน', '1 - พญ.สมศรี มีสุข', '2026-03-15', '10:00', 'ยืนยัน'),
(62, '53', 'user', 'Rs 200 - ขูดหินปูน', '1 - พญ.สมศรี มีสุข', '2026-03-17', '09:00', 'ยังไม่ได้ยืนยัน'),
(63, '52', 'admin', 'Rs 100 - ถอนฟัน', '2 - นพ.สัก ที่หลัง', '2026-03-17', '10:00', 'ยืนยัน'),
(64, '59', 'ศุภณัฐ พลยมมา', 'Rs 100 - ถอนฟัน', '1 - พญ.สมศรี มีสุข', '2026-03-18', '09:00', 'ยืนยัน'),
(66, '61', 'ศุภณัฐ พลยมมา', 'Rs 100 - ถอนฟัน', '2 - นพ.สัก ที่หลัง', '2026-03-18', '09:00', 'ยืนยัน');

-- --------------------------------------------------------

--
-- テーブルの構造 `clinic`
--

CREATE TABLE `clinic` (
  `cid` tinyint(1) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ',
  `cname` varchar(25) NOT NULL COMMENT 'ชื่อสาขา',
  `location` varchar(60) NOT NULL COMMENT 'สถานที่/ที่อยู่',
  `openhr` varchar(5) NOT NULL COMMENT 'เวลาเปิด',
  `closehr` varchar(5) NOT NULL COMMENT 'เวลาปิด',
  `rooms` tinyint(3) NOT NULL COMMENT 'จำนวนห้อง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `clinic`
--

INSERT INTO `clinic` (`cid`, `cname`, `location`, `openhr`, `closehr`, `rooms`) VALUES
(1, 'สามพราน', '79/22, อำเภอสามพราน นครปฐม 73110', '08:00', '19:00', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `dentalcode`
--

CREATE TABLE `dentalcode` (
  `id` int(3) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย อัตโนมัติ	',
  `code` varchar(7) NOT NULL COMMENT 'หมวดหมู่ทันตกรรม',
  `unitcost` smallint(5) NOT NULL COMMENT 'ราคา',
  `description` varchar(30) NOT NULL COMMENT 'รายการทันตกรรม',
  `dental_img` varchar(100) NOT NULL COMMENT 'รูปภาพรายการทันตกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `dentalcode`
--

INSERT INTO `dentalcode` (`id`, `code`, `unitcost`, `description`, `dental_img`) VALUES
(1, 'Rs 100', 900, 'ถอนฟัน', 'list_196868434920260317_181528.jpg'),
(2, 'Rs 200', 800, 'ขูดหินปูน', 'list_87695821020260317_181537.jpg'),
(3, 'Rs 300', 23000, 'ดัดฟัน', 'list_139687516420260317_181546.png'),
(6, 'Rs 400', 32000, 'ทำรากฟันเทียม', 'list_55736093320260317_181552.jpg'),
(7, 'Rs 500', 1200, 'ถอนฟันคุด', 'list_178221444420260317_181601.jpg');

-- --------------------------------------------------------

--
-- テーブルの構造 `dentist`
--

CREATE TABLE `dentist` (
  `did` smallint(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย อัตโนมัติ',
  `name` varchar(20) NOT NULL COMMENT 'ชื่อทันตเเพทย์',
  `age` tinyint(3) NOT NULL COMMENT 'อายุ',
  `sex` char(1) NOT NULL COMMENT 'เพศ',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `email` varchar(30) NOT NULL COMMENT 'อีเมล์',
  `address` text NOT NULL COMMENT 'ที่อยู่',
  `dtype` varchar(20) NOT NULL COMMENT 'ประเภทการทำงาน(เต็มเวลา/พาสไทม์)',
  `registration_date` datetime NOT NULL COMMENT 'เวลาลงทะเบียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `dentist`
--

INSERT INTO `dentist` (`did`, `name`, `age`, `sex`, `phone`, `email`, `address`, `dtype`, `registration_date`) VALUES
(1, 'พญ.สมศรี มีสุข', 42, 'F', '811234567', 'somsri_@gmail.com', '101/20 บางหว้า บางเเค', 'พนักงานประจำ', '2024-07-16 13:56:20'),
(2, 'นพ.สัก ที่หลัง', 33, 'm', '1111111111', 'dileep@gmail.com', '101/20 บางหว้า บางเเค\r\n', 'พนักงานประจำ', '2024-07-16 13:56:20'),
(4, 'พญ.สากาโมโต สังข์ทอง', 35, 'm', '9035396702', 'suyash@gmail.com', '101/20 บางหว้า บางเเค\r\n', 'พนักงานประจำ', '2024-07-16 13:56:20'),
(6, 'พญ.บาบี้ ศรีสุข', 30, 'f', '0833652255', 'dentist00@gmail.com', '101/20 บางหว้า บางเเค', 'พนักงานประจำ', '2024-07-16 13:56:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `signup`
--

CREATE TABLE `signup` (
  `userid` bigint(5) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ',
  `user_level` tinyint(1) NOT NULL COMMENT 'ระดับผู้ใช้',
  `name` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `age` tinyint(3) NOT NULL COMMENT 'อายุ',
  `address` text NOT NULL COMMENT 'ที่อยู่',
  `email` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน(hash)',
  `registration_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาสร้าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `signup`
--

INSERT INTO `signup` (`userid`, `user_level`, `name`, `phone`, `age`, `address`, `email`, `password`, `registration_date`) VALUES
(52, 1, 'admin', '0810000000', 88, 'กรุงเทพ', 'admin@gmail.com', '$2y$10$tMqh4rQNQ8kN/kt0KJZAcu6FnGizG6fCnu6NWgDsf33LaTaxhfcMW', '2026-03-14 14:15:06'),
(53, 0, 'user', '0810000000', 88, 'กรุงเทพ', 'user@gmail.com', '$2y$10$lpX32Tu3BdjN8O8CoFaaBOgzU1N0pDGqI7cRTOTtNj0UsEfT3OmvK', '2026-03-14 14:15:22'),
(61, 0, 'ศุภณัฐ พลยมมา', '0810000000', 20, 'กรุงเทพ', 'suppanut@tni.ac.th', '$2y$10$qtX9LMVB0syebH.SKwGSQehxx8gzzIXDeqftEWeLS9.bXrGJJaQ6i', '2026-03-18 21:50:25');

-- --------------------------------------------------------

--
-- テーブルの構造 `staff`
--

CREATE TABLE `staff` (
  `sid` smallint(3) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ',
  `name` varchar(20) NOT NULL COMMENT 'ชื่อ - สกุล',
  `age` tinyint(3) NOT NULL COMMENT 'อายุ',
  `sex` char(1) NOT NULL COMMENT 'เพศ',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `email` varchar(30) NOT NULL COMMENT 'อีเมล์',
  `address` text NOT NULL COMMENT 'ที่อยู่',
  `registration_date` datetime NOT NULL COMMENT 'เวลาสร้างรายการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `staff`
--

INSERT INTO `staff` (`sid`, `name`, `age`, `sex`, `phone`, `email`, `address`, `registration_date`) VALUES
(1, 'สมชาย ทองสุข', 35, 'm', '811012000', 'somchaieiei@gmail.com', '101 คลองถม อ.ประตูน้ำ จ.ปทุมธานี', '2015-11-14 00:22:16');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `adminmed`
--
ALTER TABLE `adminmed`
  ADD PRIMARY KEY (`ser`);

--
-- テーブルのインデックス `appointement`
--
ALTER TABLE `appointement`
  ADD PRIMARY KEY (`ser`);

--
-- テーブルのインデックス `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`cid`);

--
-- テーブルのインデックス `dentalcode`
--
ALTER TABLE `dentalcode`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `dentist`
--
ALTER TABLE `dentist`
  ADD PRIMARY KEY (`did`);

--
-- テーブルのインデックス `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`userid`);

--
-- テーブルのインデックス `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`sid`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `adminmed`
--
ALTER TABLE `adminmed`
  MODIFY `ser` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ', AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `appointement`
--
ALTER TABLE `appointement`
  MODIFY `ser` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ', AUTO_INCREMENT=68;

--
-- テーブルの AUTO_INCREMENT `clinic`
--
ALTER TABLE `clinic`
  MODIFY `cid` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ', AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `dentalcode`
--
ALTER TABLE `dentalcode`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย อัตโนมัติ	', AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `dentist`
--
ALTER TABLE `dentist`
  MODIFY `did` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย อัตโนมัติ', AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `signup`
--
ALTER TABLE `signup`
  MODIFY `userid` bigint(5) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ', AUTO_INCREMENT=63;

--
-- テーブルの AUTO_INCREMENT `staff`
--
ALTER TABLE `staff`
  MODIFY `sid` smallint(3) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
