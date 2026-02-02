-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2026 at 06:00 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `naija_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('client','surveyor') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `user_type`, `status`, `created_at`) VALUES
(1, 'johndoe@example.com', '$2y$10$PvbFsv6ByeA2XAaXXSW2ce6mrwJrKJ/SQ6f6ytz4noY9B2HV9qVQq', 'surveyor', 'active', '2026-01-28 15:29:10'),
(2, 'janedoe@example.com', '$2y$10$a66TJxz3bqFUsxZ.QuizROc1lemMVyns1GhO9dN0TF0SkVuQ0d.L6', 'client', 'active', '2026-01-29 07:47:19'),
(3, 'omoniyigodsown@gmail.com', '$2y$10$7C1PKdv/avyTlrycQB0j6eRNbXdWPDjgnHlhPLLiYZzQI0Nhe610q', 'surveyor', 'active', '2026-01-30 09:38:18'),
(4, 'samuel@gmail.com', '$2y$10$6RnICSHL89HkkxjJze0SVe0PTUHEGtn1FtxPBEe/lWbH6Ggp3iyX6', 'client', 'active', '2026-01-30 12:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `clients_profile`
--

DROP TABLE IF EXISTS `clients_profile`;
CREATE TABLE IF NOT EXISTS `clients_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `other_names` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `verification_status` enum('pending','verified','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `verified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_client_user` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients_profile`
--

INSERT INTO `clients_profile` (`id`, `account_id`, `first_name`, `surname`, `other_names`, `phone_number`, `whatsapp_number`, `bio`, `state`, `lga`, `address`, `profile_image`, `id_type`, `id_document`, `verification_status`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Jane', 'Doe', 'Jee', '09012345678', '09012345678', 'I am a client', 'Benue', 'APA', 'Just APA', 'profile_image697b0c2a465d3_1769671722.jpg', 'voters_card', 'id_697b0c2a4696a_1769671722.pdf', 'pending', '2026-01-29 08:28:42', '2026-01-29 08:28:42', '2026-01-29 08:31:23'),
(2, 4, 'Ab father', 'omoniyi', 'na we', '09165478081', '09165478081', 'de genttle', 'benue', 'otukpo', 'no 10 jimark avenue', 'profile_image697d3a3b039e5_1769814587.jpeg', 'voters_card', 'id_697d3a12239da_1769814546.jpg', 'verified', '2026-01-30 12:09:06', '2026-01-30 12:09:06', '2026-02-01 00:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `deliverables`
--

DROP TABLE IF EXISTS `deliverables`;
CREATE TABLE IF NOT EXISTS `deliverables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_to_client_id` int DEFAULT NULL,
  `request_to_surveyor_id` int DEFAULT NULL,
  `client_profile_id` int NOT NULL,
  `surveyor_profile_id` int NOT NULL,
  `coordinates` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note_to_client` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_deliverables_request_client` (`request_to_client_id`),
  KEY `fk_deliverables_request_surveyor` (`request_to_surveyor_id`),
  KEY `fk_deliverables_surveyor` (`surveyor_profile_id`),
  KEY `fk_deliverables_client` (`client_profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_profile_id` int NOT NULL,
  `job_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `proposed_budget` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_lga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_status` enum('available','taken','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_jobs_client` (`client_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `client_profile_id`, `job_title`, `job_description`, `proposed_budget`, `job_state`, `job_lga`, `job_address`, `job_status`, `created_at`) VALUES
(1, 1, 'Boundary Survey for Residential Plot', 'Boundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential PlotBoundary Survey for Residential Plot', '90000', 'Benue', 'Otukpo', 'GRA', 'available', '2026-01-29 08:48:20'),
(2, 1, 'Topographic Survey for Construction', 'Topographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for ConstructionTopographic Survey for Construction', '100000', 'Benue', 'Makurdi', 'GRA', 'available', '2026-01-29 08:51:33'),
(12, 1, 'Boundary Survey for Residential Land', 'Boundary survey required for a 2-plot residential land.', '250000', 'Lagos', 'Ikeja', 'Opebi Street', 'available', '2026-01-31 03:18:05'),
(13, 2, 'Topographic Survey for Construction', 'Topographic survey needed before construction begins.', '400000', 'Abuja', 'Gwarimpa', '3rd Avenue', 'available', '2026-01-31 03:18:05'),
(14, 1, 'GIS Mapping Project', 'GIS mapping for agricultural land documentation.', '600000', 'Benue', 'Makurdi', 'High Level Area', 'available', '2026-01-31 03:18:05'),
(15, 2, 'Site Layout Survey', 'Site layout survey for proposed shopping complex.', '350000', 'Rivers', 'Port Harcourt', 'Ada George Road', 'available', '2026-01-31 03:18:05'),
(16, 1, 'Boundary Survey – Farmland', 'Boundary survey for large farmland area.', '500000', 'Kaduna', 'Zaria', 'Samaru Road', 'available', '2026-01-31 03:18:05'),
(17, 2, 'Topographic Survey – Highway Project', 'Topographic survey for road expansion project.', '850000', 'Oyo', 'Ibadan North', 'Bodija Area', 'available', '2026-01-31 03:18:05'),
(18, 1, 'Land Verification Survey', 'Verification survey for land ownership confirmation.', '200000', 'Ogun', 'Abeokuta South', 'Sapon Area', 'available', '2026-01-31 03:18:05'),
(19, 2, 'GIS Survey – Urban Planning', 'GIS data collection for urban planning project.', '700000', 'Lagos', 'Eti-Osa', 'Lekki Phase 1', 'available', '2026-01-31 03:18:05'),
(20, 1, 'Site Layout for Residential Estate', 'Layout survey for a new residential estate.', '950000', 'Anambra', 'Awka South', 'Ifite Area', 'available', '2026-01-31 03:18:05'),
(21, 2, 'boundary survey', 'my first job', '28000', 'benue', 'otukpo', 'apka street', 'taken', '2026-02-01 00:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

DROP TABLE IF EXISTS `job_requests`;
CREATE TABLE IF NOT EXISTS `job_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `surveyor_profile_id` int NOT NULL,
  `client_profile_id` int NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `surveyor_profile_id` (`surveyor_profile_id`),
  KEY `client_profile_id` (`client_profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_to_clients`
--

DROP TABLE IF EXISTS `request_to_clients`;
CREATE TABLE IF NOT EXISTS `request_to_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `surveyor_profile_id` int NOT NULL,
  `client_profile_id` int NOT NULL,
  `request_status` enum('pending','accepted','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rtc_job` (`job_id`),
  KEY `fk_rtc_surveyor` (`surveyor_profile_id`),
  KEY `fk_rtc_client` (`client_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_to_clients`
--

INSERT INTO `request_to_clients` (`id`, `job_id`, `surveyor_profile_id`, `client_profile_id`, `request_status`, `created_at`) VALUES
(1, 1, 1, 1, 'pending', '2026-01-29 08:28:45'),
(2, 2, 1, 1, 'pending', '2026-01-29 08:50:13'),
(3, 12, 2, 1, 'pending', '2026-02-01 11:32:26'),
(4, 21, 2, 2, 'accepted', '2026-02-01 12:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `request_to_surveyors`
--

DROP TABLE IF EXISTS `request_to_surveyors`;
CREATE TABLE IF NOT EXISTS `request_to_surveyors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_profile_id` int NOT NULL,
  `surveyor_profile_id` int NOT NULL,
  `service_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `project_state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `project_lga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `project_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estimated_budget` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `project_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request_status` enum('pending','accepted','rejected','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rts_client` (`client_profile_id`),
  KEY `fk_rts_surveyor` (`surveyor_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_to_surveyors`
--

INSERT INTO `request_to_surveyors` (`id`, `client_profile_id`, `surveyor_profile_id`, `service_category`, `project_state`, `project_lga`, `project_address`, `estimated_budget`, `project_description`, `request_status`, `created_at`) VALUES
(1, 2, 2, 'Site Layout', 'benue', 'otukpo', 'jimark avenue', '50000', 'my first project test to check', 'pending', '2026-02-01 14:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `surveyors_profile`
--

DROP TABLE IF EXISTS `surveyors_profile`;
CREATE TABLE IF NOT EXISTS `surveyors_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `other_names` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `years_of_experience` int NOT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `surcon_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `specialization` enum('Land & Boundary Survey','Engineering Survey','Topographic Survey','Cadastral Survey','Hydrographic Survey','GIS Survey') COLLATE utf8mb4_general_ci NOT NULL,
  `verification_status` enum('pending','verified','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `verified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `reviews_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_surveyor_user` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveyors_profile`
--

INSERT INTO `surveyors_profile` (`id`, `account_id`, `first_name`, `surname`, `other_names`, `phone_number`, `whatsapp_number`, `years_of_experience`, `bio`, `state`, `lga`, `address`, `profile_image`, `id_type`, `id_document`, `surcon_number`, `specialization`, `verification_status`, `verified_at`, `created_at`, `updated_at`, `rating`, `reviews_count`) VALUES
(1, 1, 'John', 'Doe', 'Deed', '09123456789', '09123456789', 2, 'I am a surveyor', 'Benue', 'Otukpo', 'GRA', 'profile_697a272ee0fd8_1769613102.png', 'id_card', 'id_697a2476efc73_1769612406.pdf', '212356BN6QW', 'Land & Boundary Survey', 'verified', '2026-01-28 16:00:06', '2026-01-28 16:00:06', '2026-01-31 11:57:36', 4.8, 45),
(2, 3, 'Godsown', 'Omoniyi', 'Abraham', '09165478081', '09165478081', 5, 'I\'m a professional', 'benue', 'otukpo', 'no 10 jimark avenue', 'profile_697e95fc990a6_1769903612.png', 'surcon_slip', 'id_697e95fc997c5_1769903612.jpg', 'sur-50330', 'Engineering Survey', 'verified', '2026-01-30 09:57:45', '2026-01-30 09:57:45', '2026-01-31 12:57:27', 3.9, 19),
(21, 1, 'Samuel', 'Okoro', NULL, '08011112222', '08011112222', 10, 'Experienced land and boundary surveyor with residential and commercial projects.', 'Lagos', 'Ikeja', 'Ikeja GRA', 'samuel.png', 'surcon_slip', 'samuel_id.pdf', 'SUR-10001', 'Land & Boundary Survey', 'verified', '2026-01-31 13:52:37', '2026-01-31 13:52:37', '2026-01-31 13:52:37', 4.8, 45),
(22, 2, 'Aisha', 'Bello', NULL, '08022223333', '08022223333', 8, 'Engineering survey specialist with infrastructure and road projects experience.', 'Abuja', 'Gwagwalada', 'Phase 2', 'aisha.png', 'surcon_slip', 'aisha_id.pdf', 'SUR-10002', 'Engineering Survey', 'verified', '2026-01-31 13:52:37', '2026-01-31 13:52:37', '2026-01-31 13:52:37', 5.0, 62),
(23, 3, 'Ibrahim', 'Musa', NULL, '08033334444', '08033334444', 12, 'Topographic surveyor with advanced mapping and terrain analysis skills.', 'Kaduna', 'Chikun', 'Sabon Tasha', 'ibrahim.png', 'surcon_slip', 'ibrahim_id.pdf', 'SUR-10003', 'Topographic Survey', 'verified', '2026-01-31 13:52:37', '2026-01-31 13:52:37', '2026-01-31 13:52:37', 4.5, 38),
(24, 4, 'Chidinma', 'Okafor', NULL, '08044445555', '08044445555', 15, 'Cadastral survey expert with land registry and documentation experience.', 'Rivers', 'Obio-Akpor', 'Rumuola', 'chidinma.png', 'surcon_slip', 'chidinma_id.pdf', 'SUR-10004', 'Cadastral Survey', 'verified', '2026-01-31 13:52:37', '2026-01-31 13:52:37', '2026-01-31 13:52:37', 4.9, 71);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients_profile`
--
ALTER TABLE `clients_profile`
  ADD CONSTRAINT `fk_client_user` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_jobs_client` FOREIGN KEY (`client_profile_id`) REFERENCES `clients_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_to_clients`
--
ALTER TABLE `request_to_clients`
  ADD CONSTRAINT `fk_rtc_client` FOREIGN KEY (`client_profile_id`) REFERENCES `clients_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rtc_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rtc_surveyor` FOREIGN KEY (`surveyor_profile_id`) REFERENCES `surveyors_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_to_surveyors`
--
ALTER TABLE `request_to_surveyors`
  ADD CONSTRAINT `fk_rts_client` FOREIGN KEY (`client_profile_id`) REFERENCES `clients_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rts_surveyor` FOREIGN KEY (`surveyor_profile_id`) REFERENCES `surveyors_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surveyors_profile`
--
ALTER TABLE `surveyors_profile`
  ADD CONSTRAINT `fk_surveyor_user` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
