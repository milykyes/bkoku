-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2025 at 07:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkoku`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_info`
--

CREATE TABLE `academic_info` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `education_level` varchar(50) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `institution_name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `current_semester` int(11) DEFAULT NULL,
  `study_duration` int(11) DEFAULT NULL,
  `months_per_semester` int(11) DEFAULT NULL,
  `study_mode` enum('Full-Time','Part-Time','Distance Learning','Online') DEFAULT NULL,
  `cgpa` decimal(4,2) DEFAULT NULL,
  `funding_source` enum('Scholarship','Employer Sponsorship','Loan','Self-funded','Others') DEFAULT NULL,
  `sponsor_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_info`
--

INSERT INTO `academic_info` (`id`, `student_id`, `education_level`, `course_name`, `institution_name`, `start_date`, `end_date`, `current_semester`, `study_duration`, `months_per_semester`, `study_mode`, `cgpa`, `funding_source`, `sponsor_name`) VALUES
(9, 2021455478, 'Diploma', 'DIPLOMA IN INFORMATION SYSTEM', 'uitm', '2025-01-31', '2025-01-20', 5, 5, 3, '', 5.00, 'Scholarship', 'pypy'),
(14, 2021455487, 'Diploma', 'SARJANA MUDA SAINS MAKLUMAT PENGURUSAN SISTEM MAKLUMAT', 'UiTM', '2022-02-22', '2025-02-06', 4, 3, 6, 'Full-Time', 3.60, 'Scholarship', 'ptptn'),
(15, 2021455479, 'Master', 'MASTER OF EDUCATION', 'UiTM', '2025-01-07', '2025-10-24', 3, 3, 6, 'Full-Time', 3.50, 'Scholarship', 'JAIZ');

-- --------------------------------------------------------

--
-- Table structure for table `claims_info`
--

CREATE TABLE `claims_info` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `claim_type` enum('Tuition Fee','Allowance') DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claims_info`
--

INSERT INTO `claims_info` (`id`, `student_id`, `claim_type`, `amount`) VALUES
(7, 2147483647, 'Tuition Fee', 600.05),
(8, 2021455487, 'Allowance', 2000.08),
(10, 2021455479, 'Allowance', 2000.00),
(12, 2147483647, 'Tuition Fee', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `program` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `jkm_number` varchar(20) DEFAULT NULL,
  `race` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `disability` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `home_phone` varchar(15) DEFAULT NULL,
  `mobile_phone` varchar(15) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `program`, `full_name`, `student_id`, `birth_date`, `age`, `jkm_number`, `race`, `gender`, `disability`, `address`, `home_phone`, `mobile_phone`, `bank_account_number`, `email`) VALUES
(2, 'Q', 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 1234569, '2025-01-01', 5, '123456789', 'MELAYU', 'Male', 'FIZIKAL', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com'),
(3, 'FPM', 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 2147483647, '2025-01-29', 21, '1234567890', 'MELAYU', 'Female', 'FIZIKAL', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com'),
(4, 'KPPIM', 'NURUL AMIRAH BINTI SUHAIMI', 2024554345, '2025-01-24', 20, 'PH12478745', 'MELAYU', 'Male', 'FIZIKAL', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '789456', '01111484332', '1234567890', 'amirah@gmail.com'),
(5, 'FSKP', 'NUR ATIKAH HAZRAH BINTI MOHAMAD NASHIR', 1234567890, '2025-01-29', 25, '345678IK', 'MELAYU', 'Male', 'FIZIKAL', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'atikah@gmail.com'),
(6, 'FPM', 'sabrinasyaza', 789456123, '2025-01-29', 20, '82', 'MELAYU', 'Female', 'FIZIKAL', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com'),
(8, 'FSPKK', 'AQIF HAIKAL RAZAK', 2021455478, '2025-01-29', 21, 'PH12478745', 'MELAYU', 'Male', 'HEARING', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com'),
(9, 'KPP', 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 987456, '2025-01-29', 8, '56565', 'MELAYU', 'Male', 'EYES', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com'),
(10, 'KPP', 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 123456, '2025-01-30', 15, 'D14578', 'MELAYU', 'Male', 'HEARING', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com'),
(11, 'DIPLOMA IN ACCOUNTANCY', 'WAN NUR AKRIEMA BINTI WAN MOHAMAD KHOLUDDIN', 202569698, '2004-03-30', 20, 'LD965656234', 'MELAYU', 'Female', 'HEARING', 'Taman 13 Bukit Perdana, Setiu Terengganu', '609854655', '0111184332', '1234567890', 'ssabrinasyaza@gmail.com'),
(13, 'FSPKK', 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 2021455487, '2025-02-06', 20, '1234567890', 'MELAYU', 'Female', 'FIZIKAL', '53-C KAMPUNG CHALOK LAMA\r\nSETIU TERENGGANU', '01111484332', '01111484332', '', 'ssabrinasyaza@gmail.com'),
(14, 'FSPKK', 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 20007854, '2025-02-06', 20, 'PH12345676', 'MELAYU', 'Male', 'HEARING', '53-C KAMPUNG CHALOK LAMA', '01111484332', '01111484332', '123332278', 'ssabrinasyaza@gmail.com'),
(16, 'KPPIM', 'KAMARUDDIN', 2021455479, '2025-02-06', 20, 'KL12345', 'MELAYU', 'Male', 'FIZIKAL', 'JALAN ENDAU MUTIARA 2 ', '0124588', '01111484332', '1234567890', 'ssabrinasyaza@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `status`, `created_at`, `admin_key`) VALUES
(30, 'julia', 'julianim', 'julia@gmail.com', '$2y$10$IKbRVDxA7a4DpLShe0lO2OB0Otb4qGXdEQzPaWA0TQQJP3fJpb53W', 'admin', '2025-01-28 14:57:50', ''),
(31, 'qw', 'qw', 'qw@gmail.com', '$2y$10$Xx8Pe3b1mp4w7mHBBqF2deMr11PiRJZaqlYfXaYuBOIJaER7t5w.C', 'user', '2025-01-28 15:24:15', ''),
(32, 'wara', 'wara', 'wara@gmail.com', '$2y$10$.BfAjJLqasMOZjCP6xOGfukCBrs6Ukeckl2Ue6Nth8ykVVsbrseUq', 'admin', '2025-01-28 17:20:46', ''),
(33, 'shawn', 'shawn', 'shawn@gmail.com', '$2y$10$ONJDtvKJM3mZJ3Q4S3cjKeExDfY/CsU5rjErw6V/x3bgezMbCU2QS', 'admin', '2025-01-30 13:06:27', ''),
(34, 'ty', 'tyara', 'ty@gmail.com', '$2y$10$4TojU8dkhV/18tR2ITaqzOwMYg.I5VQFPkQeLXzd3rDvbRugzBm5e', 'admin', '2025-01-30 13:19:23', ''),
(35, 'miraafi', 'amirae', 'amirae@gmail.com', '$2y$10$co2wsoATJQlvaVGVEcHoputBqZKOoSvVC2FnYMNdgcEmNTTpQiMWm', 'user', '2025-02-02 16:14:26', ''),
(36, 'cajanim', 'cajaa', 'caja@gmail.com', '$2y$10$BK.pbvRrKVcYrMs.60yXkuRpQ3xBAMnkrAdOH.saq2WcH.7H1xdFW', 'admin', '2025-02-02 16:41:20', 'admin123'),
(37, 'jackson', 'sseuni', 'sseuni@gmail.com', '$2y$10$l9wesPH3ukugR2SGBG9h/.eB3SLqdzwSKqyrUJhjvrmtGfVBuu0ki', 'user', '2025-02-03 05:48:37', ''),
(38, 'mark', 'markk', 'mark@gmial.com', '$2y$10$c02S1L1b5WZztT8ax5/oWOzei3cNAyzTBFag/Z9QW/zMAovDtSbPC', 'user', '2025-02-03 09:29:20', ''),
(44, 'brina', 'brina', 'brina@gmail.com', '$2y$10$pdoP3y16FYeomabRTKgBT.dhTFo8kjtkiXY0kgwbaplUohNt3hDfy', 'user', '2025-02-06 12:25:39', ''),
(47, 'heejo', 'hejoo12', 'heejo@gmail.com', '$2y$10$Hb/cLJee3xa.sS4CelOPIOKJlLtVDQRpuxYgCHeJy7wh6D5oN4fvi', 'user', '2025-02-06 12:52:01', ''),
(48, 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', 'sabby', 'Bres43b@turniti.com', '$2y$10$AeE.OaKLgly64BpPjoXMS.XhqIdHlqYJvBOru7mrcikLtpLKmGAg.', 'user', '2025-02-06 13:17:53', ''),
(49, 'norhasnah', 'ciknah', 'ciknah@gmail.com', '$2y$10$UuvZT3XhM8265r517XRbyOFa9yrX4qPf5sDuqwCJwXEgo8HNZZ.Z.', 'user', '2025-02-06 13:21:20', ''),
(50, 'hasiah', 'hasiah', 'hasiah@gmail.com', '$2y$10$a/TOwOgQqShYpqIWIEK3LOwQZDfiMt6DnezrSlijH6.6hOI1cAeiS', 'user', '2025-02-06 14:42:14', ''),
(51, 'cobra', 'cobra', 'cobra@gmail.com', '$2y$10$gUiAK3yyWcn1M/qtOqrDru9SULlR27k3uo6DaU7db3JvDZxtXXXjK', 'user', '2025-02-06 15:06:52', ''),
(52, 'kamal', 'kamal', 'kamal@gmail.com', '$2y$10$gcNt3OZw//QzdYPkksHl4u2/xhkNtbxe8YkagELnDm2NOScBKfXcq', 'user', '2025-02-06 15:26:24', ''),
(53, 'melati', 'melati', 'melati@gmail.com', '$2y$10$vpvHBYw/idUac3mcDXHeweLNfeXXUsVn7ph71cAXUfdagl.NAepx2', 'admin', '2025-02-06 15:28:16', '$2y$10$hrkpa2XRCadXSuakpYXyEOoYw.JuId/jn52TnDKPxWoH2ZdPXNSzG'),
(54, 'mawarose', 'mawarosee', 'mawarose@gmail.com', '$2y$10$jPvYZC3TzQJo0EqpPF6GDePh/FsRf2kF8Q8XSyDXDMk0MP7kS.ksO', 'user', '2025-02-06 16:01:06', ''),
(55, 'faiz', 'faiz', 'faiz@gmail.com', '$2y$10$GXvaE46QATI8msybmGiEQuT91w82d.Hm49BzogGDS3vm1gmJPsP5u', 'admin', '2025-02-09 05:27:03', '$2y$10$ir.xuH8m8QWq.5LcW0cg7O.oXpaszmcxON7n8bGSyl.xI8zJU0UIC'),
(56, 'ddee', 'deen', 'deeen@gmail.com', '$2y$10$YaBmiB3TlgYiqjZQa72xje4gm4urYnXVP6wd8lnUmY7MEWcMg.Lnm', 'user', '2025-02-09 05:43:45', ''),
(57, 'aiman', 'aiman', 'aiman@gmail.com', '', 'admin', '2025-02-09 05:56:40', 'admin123'),
(58, 'haziq', 'haziq', 'haziq@gmail.com', '$2y$10$I./Ad.etT3rXSn04P8SwpuMQOgXMGZZRRrtgOMiFat5Jyp54G45ca', 'user', '2025-02-09 06:31:12', ''),
(59, 'keeni', 'kenii', 'kenni@gmail.com', '', 'admin', '2025-02-09 06:33:06', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_info`
--
ALTER TABLE `academic_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `claims_info`
--
ALTER TABLE `claims_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `student_id_2` (`student_id`),
  ADD UNIQUE KEY `student_id_3` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_info`
--
ALTER TABLE `academic_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `claims_info`
--
ALTER TABLE `claims_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_info`
--
ALTER TABLE `academic_info`
  ADD CONSTRAINT `academic_info_fk` FOREIGN KEY (`student_id`) REFERENCES `personal_info` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `academic_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `personal_info` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `claims_info`
--
ALTER TABLE `claims_info`
  ADD CONSTRAINT `claims_info_fk` FOREIGN KEY (`student_id`) REFERENCES `personal_info` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
