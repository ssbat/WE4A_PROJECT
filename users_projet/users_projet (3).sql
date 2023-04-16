-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 01:24 PM
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
-- Database: `users_projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`) VALUES
(103, 43, 34, 'dakhil rabak asli'),
(104, 43, 35, 'kifak ya bro'),
(105, 41, 34, 'hala ya hala'),
(106, 41, 34, 'jhkhk'),
(107, 44, 34, 'hi kif lchabebz'),
(108, 44, 37, 'mnih enta kif'),
(109, 44, 37, 'tamenni 3anna 3annak'),
(110, 41, 38, '3yuni akhi lkbir'),
(111, 41, 38, 'nchalla kelchi bkheir?'),
(112, 41, 38, 'tamenni'),
(113, 41, 38, 'sli'),
(114, 41, 36, 'kelchi tamem khayi?'),
(115, 41, 36, 'enta bas tamenni'),
(116, 41, 34, 'LIEBHERR'),
(117, 41, 34, 'csc'),
(118, 41, 40, 'oui'),
(119, 41, 40, 'non'),
(120, 41, 40, 'dklfjls'),
(121, 41, 41, 'gdgdg'),
(122, 41, 42, 'saad');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `post_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `post_id`, `user_id`, `date`) VALUES
(49, 41, 41, 2147483647),
(56, 36, 41, 2147483647),
(59, 42, 41, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `date`) VALUES
(321, 36, 40, '2023-04-08 01:00:39'),
(330, 35, 40, '2023-04-08 01:41:50'),
(331, 34, 42, '2023-04-08 18:38:46'),
(332, 38, 44, '2023-04-09 21:36:09'),
(333, 34, 44, '2023-04-09 21:36:13'),
(338, 41, 41, '2023-04-12 00:49:36'),
(378, 42, 41, '2023-04-16 13:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(5) NOT NULL,
  `Titre` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `photo` varchar(80) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `Titre`, `content`, `photo`, `user_id`, `date`) VALUES
(34, 'hi', 'salut les gars', NULL, 41, '2023-04-08 00:54:24'),
(35, 'jk', 'jkkl', NULL, 40, '2023-04-08 00:59:39'),
(36, 'kjk', 'jhkk', NULL, 40, '2023-04-08 01:00:11'),
(37, 'ya bro', 'kifak', NULL, 43, '2023-04-09 21:09:00'),
(38, 'sa', 'dakhil rabak asli', NULL, 44, '2023-04-09 21:35:59'),
(39, 'saad', 'sadsd', NULL, 41, '2023-04-09 23:58:53'),
(40, 'saad', 'am i the future internee in liebherr', NULL, 41, '2023-04-11 10:54:57'),
(41, 'aa', 'DAKHIL RABAK', NULL, 41, '2023-04-12 00:49:25'),
(42, 'hi', 'my future home!', 'tre.jpg', 41, '2023-04-16 00:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(20) NOT NULL,
  `First_Name` varchar(88) NOT NULL,
  `Last_Name` varchar(88) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PASSWORD` varchar(300) NOT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Specialite` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `First_Name`, `Last_Name`, `Email`, `PASSWORD`, `profile`, `Gender`, `Specialite`) VALUES
(40, 'Saad', 'Sbat', 'saad_sbat3@hotmail.com', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '', 'female', 'Génie informatique'),
(41, 'Saad', 'Sbat', 'saad_sbat@hotmail.com', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '', 'male', 'Génie mécanique'),
(42, 'Noura', 'Hamad', 'noura_sbat@hotmail.com', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '', 'female', 'Génie industriel'),
(43, 'Ali', 'Jeha', 'ali@utbm.fr', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'Screenshot 2023-04-06 161334.png', 'male', 'Génie mécanique'),
(44, 'Nathan', 'Cuenot', 'nathan@crunch.fr', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'DataExcel.png', 'male', 'Génie énergie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Who Commented` (`user_id`),
  ADD KEY `Which Post` (`post_id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`user_id`),
  ADD KEY `Who disliked` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`user_id`),
  ADD KEY `userid` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `WhoPosted` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Which Post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Who Commented` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `WhichPost` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Who disliked` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `postid` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `WhoPosted` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
