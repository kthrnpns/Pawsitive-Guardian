-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 09:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawsitive_guardians`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `target_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adopt`
--

CREATE TABLE `adopt` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `residence_type` varchar(50) DEFAULT NULL,
  `housing_status` varchar(50) DEFAULT NULL,
  `landlord_info` varchar(255) DEFAULT NULL,
  `years_at_address` varchar(50) DEFAULT NULL,
  `has_yard` varchar(10) DEFAULT NULL,
  `yard_fenced` varchar(10) DEFAULT NULL,
  `had_pets` varchar(10) DEFAULT NULL,
  `past_pets` text DEFAULT NULL,
  `current_pets` varchar(10) DEFAULT NULL,
  `current_pets_info` text DEFAULT NULL,
  `adoption_reason` text DEFAULT NULL,
  `hear_about` varchar(100) DEFAULT NULL,
  `living_arrangement` text DEFAULT NULL,
  `primary_caregiver` varchar(100) DEFAULT NULL,
  `rehoming_plan` text DEFAULT NULL,
  `vet_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adoption_agreements`
--

CREATE TABLE `adoption_agreements` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `adopter_name` varchar(100) NOT NULL,
  `adopter_email` varchar(100) NOT NULL,
  `adopter_phone` varchar(20) NOT NULL,
  `adopter_address` text NOT NULL,
  `adopter_occupation` varchar(100) DEFAULT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_color` varchar(50) NOT NULL,
  `pet_gender` varchar(10) NOT NULL,
  `neuter_date` date DEFAULT NULL,
  `last_vaccine_date` date DEFAULT NULL,
  `other_vaccines` varchar(3) DEFAULT NULL,
  `vaccine_types` varchar(255) DEFAULT NULL,
  `signature_path` varchar(255) NOT NULL,
  `adoption_date` date NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `NAME` varchar(8) DEFAULT NULL,
  `AGE` varchar(6) DEFAULT NULL,
  `GENDER` varchar(6) DEFAULT NULL,
  `COLOR` varchar(13) DEFAULT NULL,
  `NEUTER STATUS` varchar(8) DEFAULT NULL,
  `ADOPTION` varchar(16) DEFAULT NULL,
  `MEDICAL_NOTES` varchar(11) DEFAULT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `neuter_date` date DEFAULT NULL,
  `last_vaccine_date` date DEFAULT NULL,
  `other_vaccines` varchar(3) DEFAULT 'no',
  `vaccine_types` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `NAME`, `AGE`, `GENDER`, `COLOR`, `NEUTER STATUS`, `ADOPTION`, `MEDICAL_NOTES`, `description`, `image_path`, `created_at`, `neuter_date`, `last_vaccine_date`, `other_vaccines`, `vaccine_types`) VALUES
(1, 'Tola Jr.', 'Adult', 'Male', 'White-Orange', 'Neuter', 'N/A', '', '', 'tola-jr.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(2, 'Tyler', 'Adult', 'Male', 'Tabby Gray', 'Neuter', 'N/A', '', '', 'tyler.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(3, 'Kazamir', 'Adult', 'Male', 'White', 'Neuter', 'N/A', '', '', 'kazamir.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(4, 'Cali', 'Adult', 'Female', 'White-Orange', 'Spayed', 'N/A', '', '', 'cali.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(5, 'Minggoy', 'Adult', 'Male', 'Tabby & White', 'Neuter', 'N/A', '', '', 'minggoy.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(6, 'Tuff', 'Adult', 'Female', 'Brown Tabby', 'Spayed', 'N/A', '', '', 'tuff.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(7, 'Tuffy', 'Adult', 'Male', 'Brown Tabby', 'Neuter', 'N/A', '', '', 'tuffy.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(8, 'Tux', 'Adult', 'Male', 'Tuxedo', 'Neuter', 'N/A', '', '', 'tux.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(9, 'Nyx', 'Adult', 'Female', 'Black', 'Spayed', 'N/A', '', '', 'nyx.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(10, 'Tokyo', 'Adult', 'Male', 'Black', 'Unneuter', 'N/A', '', '', 'tokyo.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(11, 'Rinring', 'Adult', 'Female', 'Black & White', 'Spayed', 'N/A', '', '', 'rinring.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(12, 'Forbie', 'Adult', 'Female', 'Orange Ginger', 'Unspay', 'N/A', '', '', 'forbie.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(13, 'Lafoo', 'Adult', 'Male', 'White-Orange', 'Neuter', 'Pending Adoption', '', 'Lafoo was brought to the vet today. After a thorough check-up, they found that the wound on his body was caused by hotspots, which are painful skin infections usually triggered by excessive scratching or licking.\r\nThey also discovered mouth ulcers, which explain the bleeding around his mouth. Because of his symptoms, the vet recommended a test for Feline Herpesvirus and sadly, Lafoo tested positive for FHV-1.\r\nHe’ll be going back to the vet for a follow-up check-up on June 8 to monitor his healing and response to the treatment.\r\nPlease keep Lafoo in your thoughts as he continues to fight through this. Your support whether through prayers, shares, or donations means everything ?', 'lafoo.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(14, 'Muning', 'Kitten', 'Female', 'Tabby & White', 'Unspay', 'Foster Care', 'Eye Problem', '', 'muning.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(15, 'Milky', 'Kitten', 'Female', 'Calico', 'Unspay', 'Foster Care', 'Eye Problem', '', 'milky.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(16, 'Carlota', 'Adult', 'Female', 'Black', 'Spayed', 'N/A', '', '', 'carlota.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(17, 'Sugar', 'Adult', 'Male', 'Orange Ginger', 'Neuter', 'N/A', '', '', 'sugar.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(18, 'Puraa', 'Adult', 'Female', 'White-Orange', 'Spayed', 'N/A', '', '', 'puraa.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(19, 'Kira', 'Adult', 'Female', 'White-Orange', 'Spayed', 'N/A', '', '', 'kira.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(20, 'Puti', 'Adult', 'Male', 'White', 'Neuter', 'N/A', '', '', 'puti.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(21, 'Bangs', 'Adult', 'Male', 'Tabby & White', 'Neuter', 'N/A', '', '', 'bangs.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(22, 'Lucy', 'Adult', 'Male', 'White', 'Neuter', 'N/A', '', '', 'lucy.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(23, 'Sky', 'Adult', 'Male', 'White', 'Neuter', 'Pending Adoption', '', '', 'sky.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL),
(24, 'Ashtro', 'Adult', 'Male', 'White', 'Neuter', 'N/A', '', '', 'ashtro.jpg', '2025-08-01 12:15:41', NULL, NULL, 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `remember_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_notes` text DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `is_admin`, `remember_token`, `token_expiry`, `reset_token`, `reset_expiry`, `created_at`, `admin_notes`, `profile_pic`, `bio`) VALUES
(2, 'Kathrena', 'Panes', 'kspkatren@gmail.com', '$2y$10$VPfOeJtZFEZeDnWQJUaOTOQn3lLk6NWY2ZM7QiREYncWALcfn/9/6', '09396533609', 'Bently Park Subd. ANtipolo City, Rizal', 0, '0ebc7470dcbfa46d43184dd1140710a6a4d8a18abac54617f01ac0d616c781a7', '2025-08-31 19:20:50', NULL, NULL, '2025-08-01 11:32:00', NULL, 'profile_2_1754192297.jpeg', 'meoww'),
(5, 'Admin', 'User', 'admin@pawsitive.com', '$2y$10$xR.c89QuAHmOZXWYF3AVM.9VQni1PNVW.Z0eMHBevsAjw1oaFabei', NULL, NULL, 1, '611504d12e500db3f4de39511fbdf31fbd252e50f780ac610bb482f77aaf644e', '2025-09-02 02:51:11', NULL, NULL, '2025-08-03 00:24:41', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `target_user_id` (`target_user_id`);

--
-- Indexes for table `adopt`
--
ALTER TABLE `adopt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption_agreements`
--
ALTER TABLE `adoption_agreements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adopt`
--
ALTER TABLE `adopt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adoption_agreements`
--
ALTER TABLE `adoption_agreements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `admin_logs_ibfk_2` FOREIGN KEY (`target_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `adoption_agreements`
--
ALTER TABLE `adoption_agreements`
  ADD CONSTRAINT `adoption_agreements_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `cats` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
