-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 05:15 AM
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
  `education_level` enum('Certificate','Diploma','Bachelor','Master','PhD') DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `institution_name` varchar(100) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `claims_info`
--

CREATE TABLE `claims_info` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `claim_type` enum('Tuition Fee','Allowance') DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `program` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `id_card_number` varchar(20) DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `status`, `created_at`) VALUES
(2, 'syaza', '', 'juwons@gmail.com', '$2y$10$7fA/Mu/YQT6PPKCbR4i/EeWgvE68Hdq1LTn.bxvcf/bCxnmmPtKMK', '', '2025-01-25 15:40:25'),
(3, 'heejo', '', 'heeejo@gmail.com', '$2y$10$8LS.ymeIiruhnkbTPPxuo.uZ/nHLCROLdpusImCdo16CL2SsJFjNK', '', '2025-01-25 15:41:22'),
(4, 'amira', '', 'mira@gmail.com', '$2y$10$xazQguAvyHbExDb85zRWcOY3LQkslykem1YCuZfd2ZWArndx7vXLe', '', '2025-01-25 15:45:26'),
(6, 'NUR SABRINA SYAZA BINTI MOHAMAD NASHIR', '', 'ssabrinasyaza@gmail.com', '$2y$10$8Dfi6.mi8zwIrJngxRzrEeXbojjzOXXOdGvcZr7EYV6ztQVuCaY0q', '', '2025-01-25 16:17:01'),
(7, 'jiminpark', 'jimim', 'jimim@gmail.com', '$2y$10$/A61gPw8FSmbcdrwkZn3EOY26gowYsMcNLK.50GjeIdPytwhPC13y', '', '2025-01-25 17:18:09'),
(8, 'amirahh', 'miraaa', 'milykyess@gmail.com', '$2y$10$EhEeqs5MNbcNOxRUzLVkzuto.ST82CgWxoJhdKizDI.l.SNHzKSdK', '', '2025-01-25 17:19:42'),
(9, 'sabrinasyaza', 'sabby', 'sabby@gmail.com', '$2y$10$/in6v2cTA9v5jr3wkRJ1MexhuoPWL3DoeTvfgGT/gFPmtwLZqt7zK', '', '2025-01-28 03:36:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_info`
--
ALTER TABLE `academic_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claims_info`
--
ALTER TABLE `claims_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_info`
--
ALTER TABLE `academic_info`
  ADD CONSTRAINT `academic_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `personal_info` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `claims_info`
--
ALTER TABLE `claims_info`
  ADD CONSTRAINT `claims_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `personal_info` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
