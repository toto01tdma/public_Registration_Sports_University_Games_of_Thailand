-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 08:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `sport_type`
--

CREATE TABLE `sport_type` (
  `sport_id` int(11) NOT NULL,
  `sport_eng_name` varchar(30) NOT NULL,
  `sport_thai_name` varchar(30) NOT NULL,
  `sport_type_image` varchar(16) NOT NULL COMMENT 'ชื่อรูป',
  `max_number_people` int(11) NOT NULL,
  `min_number_people` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sport_type`
--

INSERT INTO `sport_type` (`sport_id`, `sport_eng_name`, `sport_thai_name`, `sport_type_image`, `max_number_people`, `min_number_people`) VALUES
(1, 'airobic_dance', 'แอโรบิกดานซ์', 'arobicdance.jpg', 9, 2),
(2, 'gateball', 'เกทบอล', 'getball.jpg', 8, 1),
(3, 'corvball', 'คอร์ฟบอล', 'corfball.jpg', 16, 1),
(4, 'stack', 'สแต็ค', 'stack.jpg', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_image`
--

CREATE TABLE `sub_image` (
  `image_id` int(11) NOT NULL,
  `cover` varchar(25) NOT NULL,
  `card` varchar(25) NOT NULL,
  `card_student` varchar(25) NOT NULL,
  `grade` varchar(25) NOT NULL,
  `team` int(11) NOT NULL,
  `contestant_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_image`
--

INSERT INTO `sub_image` (`image_id`, `cover`, `card`, `card_student`, `grade`, `team`, `contestant_name`) VALUES
(242, '185cover1.png', '185card1.png', '185card_student1.png', '185grade1.png', 185, 'เด็ก A'),
(243, '185cover2.png', '185card2.png', '185card_student2.png', '185grade2.png', 185, 'เด็ก B');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sport_type_of_stack`
--

CREATE TABLE `sub_sport_type_of_stack` (
  `type_of_stack_id` int(11) NOT NULL,
  `type_of_stack_name` varchar(30) NOT NULL COMMENT 'ประเภท (เดี่ยวหรือคู่)',
  `min_number_people_of_sub_stack` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_sport_type_of_stack`
--

INSERT INTO `sub_sport_type_of_stack` (`type_of_stack_id`, `type_of_stack_name`, `min_number_people_of_sub_stack`) VALUES
(0, '', ''),
(1, 'ประเภทเดี่ยวบุคคลชาย 3-3-3', ''),
(2, 'ประเภทเดี่ยวบุคคลชาย 3-6-3', ''),
(3, 'ประเภทเดี่ยวบุคคลชาย Cycle', ''),
(4, 'ประเภทเดี่ยวบุคคลหญิง 3-3-3', ''),
(5, 'ประเภทเดี่ยวบุคคลหญิง 3-6-3', ''),
(6, 'ประเภทเดี่ยวบุคคลหญิง Cycle', ''),
(7, 'ประเภทคู่', '2'),
(8, 'ประเภททีมผสม', '4');

-- --------------------------------------------------------

--
-- Table structure for table `team_lists`
--

CREATE TABLE `team_lists` (
  `team_id` int(11) NOT NULL COMMENT 'รหัสทีม',
  `team_name` varchar(100) NOT NULL COMMENT 'ชื่อทีม',
  `number_people` int(11) NOT NULL COMMENT 'จำนวนคนที่เข้าแข่งขัน',
  `sport_type` int(11) NOT NULL COMMENT 'ประเภทกีฬา',
  `sport_type_detail` varchar(255) NOT NULL COMMENT 'รายละเอียดกีฬา(สำหรับสแต็ค)',
  `team_manager_01` varchar(100) NOT NULL COMMENT 'ชื่อเจ้าหน้าที่ของทีมคนที่ 1',
  `team_manager_02` varchar(100) NOT NULL COMMENT 'ชื่อเจ้าหน้าที่ของทีมคนที่ 2',
  `team_manager_03` varchar(100) NOT NULL COMMENT 'ชื่อเจ้าหน้าที่ของทีมคนที่ 3',
  `team_manager_04` varchar(100) NOT NULL COMMENT 'ชื่อเจ้าหน้าที่ของทีมคนที่ 4',
  `coordinator_name` varchar(60) NOT NULL COMMENT 'ชื่อผู้ประสานงาน',
  `coordinator_email` varchar(240) NOT NULL COMMENT 'อีเมลผู้ประสานงาน',
  `coordinator_phonenumber` varchar(10) NOT NULL COMMENT 'เบอร์โทรติดต่อผู้ประสานงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `team_lists`
--

INSERT INTO `team_lists` (`team_id`, `team_name`, `number_people`, `sport_type`, `sport_type_detail`, `team_manager_01`, `team_manager_02`, `team_manager_03`, `team_manager_04`, `coordinator_name`, `coordinator_email`, `coordinator_phonenumber`) VALUES
(185, 'มหาวิทยาลัยหลายใจ', 2, 1, '', 'ชื่อ รัชชา สุดหล่อ หน้าที่ ผู้จัดการทีม', '', '', '', 'ดุจดาว', 'dujdao5555@gmai.com', '0889998888'),
(350, 'มหาวิทยาลัยทักษิณ', 8, 2, '', 'ชื่อ นาย คัชชา ศิริรัตรพันธ์ หน้าที่ ผู้ฝึกสอน', 'ชื่อ ดร.อภิรัตน์ดา ทองแกมแก้ว หน้าที่ ผู้จัดการทีม', '', '', 'นาย ณัฐพงศ์ นาคเกลี้ยง', '641031298@TSU.ac.th', '0984839340'),
(432, 'มหาวิทยาลัยราชภัฎอุดรธานี', 5, 2, '', 'ชื่อ ผศ.ดร.วิรดี  เอกรณรงค์ชัย หน้าที่ ผู้จัดการทีม', 'ชื่อ นางสาวกัญญาณัฐ  แก้วสียา หน้าที่ ผู้ฝึกสอน', 'ชื่อ นางสาววาชินี  ชาลี หน้าที่ ผู้ช่วยผู้ฝึกสอน', '', 'นายยุทธนา วงษ์พุฒ', 'soop84@hotmail.com', '0887355502'),
(2016, 'มหาวิทยาลัยการกีฬาแห่งชาติ', 16, 3, '', 'ชื่อ ผู้ช่วยศาสตราจารย์จุไรรัตน์ อุดมวิโรจน์สิน หน้าที่ ผู้จัดการทีม', 'ชื่อ นายภาษา ทะรังสี หน้าที่ ผู้ฝึกสอน', 'ชื่อ นายภัทรดนัย ประสานตรี หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'ชื่อ ว่าที่ร้อยตรีปัณณวิชญ์ เด่นสุมิตร หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'นางสาวเมธ์วดี ชอบทำกิจ', 'sportoffice.ipe@gmail.com', '0943511043'),
(2109, 'มหาวิทยาลัยราชภัฏยะลา', 8, 1, '', 'ชื่อ ผู้ช่วยศาสตราจารย์อำพล บัวแก้ว หน้าที่ ผู้จัดการทีม', 'ชื่อ อาจารย์ ดร.พิชามญช์ จันทุรส หน้าที่ ผู้ฝึกสอน', 'ชื่อ อาจารย์สาริศา โตะหะ หน้าที่ ผู้ช่วยผู้ฝึกสอน', '', 'อาจารย์ ดร.พิชามญช์ จันทุรส', 'pichamon.j@yru.ac.th', '0925323642'),
(2203, 'มหาวิทยาลัยเทคโนโลยีราชมงคลธัญบุรี', 9, 1, '', 'ชื่อ ผศ.ดร.สังวร จันทรกร หน้าที่ ผู้จัดการทีม', 'ชื่อ ดร.ณัฏฐกิตติ์ เอี่ยมสมบูรณ์ หน้าที่ ผู้ฝึกสอน', 'ชื่อ อาจารย์อินทรา ทับคล้าย หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'ชื่อ ผศ.อนงค์ รักษ์วงศ์ หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'ผศ.ดร.สังวร จันทรกร', 'sangworn@rmutt.ac.th', '0926145661'),
(4433, 'มหาวิทยาลัยศรีนครินทรวิโรฒ', 15, 3, '', 'ชื่อ ผู้ช่วยศาสตราจารย์ ดร.ภาคภูมิ ศรีรมรื่น หน้าที่ ผู้จัดการทีม', 'ชื่อ ผู้ช่วยศาสตราจารย์ ดร.พิชญาวีร์ ภานุรัชต์ฐนนท์  หน้าที่ ผู้ฝึกสอน', 'ชื่อ นางสาวพิกุล ภูจักหิน หน้าที่ ผู้ช่วยผู้ฝึกสอน', '', 'นางสาวพิกุล ภูจักหิน', 'pikulp@g.swu.ac.th', '0839736373'),
(6014, 'มหาวิทยาลัยการกีฬาแห่งชาติ', 9, 1, '', 'ชื่อ นายพีรพงษ์ หาญทนงค์ หน้าที่ ผู้จัดการทีม', 'ชื่อ นางสาวไอรดา ปานท้าว หน้าที่ ผู้ฝึกสอน', 'ชื่อ นางสาวยุพวัลย์ ภูษณะพงษ์ หน้าที่ ผู้ช่วยผู้ฝึกสอน', '', 'นางสาวเมธ์วดี ชอบทำกิจ', 'sportoffice.tnsu@gmail.com', '0943511043'),
(7430, 'มหาวิทยาลัยราชภัฏอุดรธานี', 7, 3, '', 'ชื่อ ดร.จิรเดช อย่าเสียสัตย์ หน้าที่ ผู้จัดการทีม', 'ชื่อ นางสาววารุณี กิจรักษา หน้าที่ ผู้ฝึกสอน', 'ชื่อ ดร. นฤปวรรต์ พรหมมาวัย หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'ชื่อ ผศ.ดร.วิวรรธน์ แสงภักดี หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'ดร.จิรเดช อย่าเสียสัตย์', 'jiradech.ya@udru.ac.th', '0869834339'),
(8012, 'มหาวิทยาลัยเกษตรศาสตร์', 16, 3, '', 'ชื่อ รศ.ดร.สมบุญ ศิลป์รุ่งธรรม หน้าที่ ผู้จัดการทีม', 'ชื่อ ผศ.ดร.ศุภวรรณ วงศ์สร้างทรัพย์ หน้าที่ ผู้ฝึกสอน', 'ชื่อ อ.ดร.วิชนนท์ พูลศรี หน้าที่ ผู้ช่วยผู้ฝึกสอน', 'ชื่อ นายอริยะ ส่องแสงจันทร์ หน้าที่ นักกายภาพบำบัด', 'ผศ.ดร.ศุภวรรณ วงศ์สร้างทรัพย์', 'suppawan.v@ku.th', '0989545938'),
(9240, 'มหาวิทยาลัยราชภัฏเลย', 9, 1, '', 'ชื่อ ว่าที่เรือโทชวิศ วงษ์เขียว หน้าที่ ผู้จัดการทีม', 'ชื่อ ผศ.ดร.ยรรยงค์ พานเพ็ง หน้าที่ ผู้ฝึกสอน', 'ชื่อ นายสมใจ  อับไพชา หน้าที่ ผู้ช่วยผู้ฝึกสอน', '', 'นายขวัญชัย นพรัตน์', 'one7759@hotmail.com', '0844207759'),
(9302, 'มหาวิทยาลัยนอร์ทกรุงเทพ', 13, 3, '', 'ชื่อ ดร.วรเชษฐ์ สิงห์ลอ หน้าที่ ผู้จัดการทีม', '', '', '', 'นายสุริยา จันทนกูล', 'suriya.ch@northbkk.ac', '0853266336');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sport_type`
--
ALTER TABLE `sport_type`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `sub_image`
--
ALTER TABLE `sub_image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `sub_sport_type_of_stack`
--
ALTER TABLE `sub_sport_type_of_stack`
  ADD PRIMARY KEY (`type_of_stack_id`);

--
-- Indexes for table `team_lists`
--
ALTER TABLE `team_lists`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `sport_type` (`sport_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sport_type`
--
ALTER TABLE `sport_type`
  MODIFY `sport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_image`
--
ALTER TABLE `sub_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `sub_sport_type_of_stack`
--
ALTER TABLE `sub_sport_type_of_stack`
  MODIFY `type_of_stack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `team_lists`
--
ALTER TABLE `team_lists`
  ADD CONSTRAINT `team_lists_ibfk_1` FOREIGN KEY (`sport_type`) REFERENCES `sport_type` (`sport_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
