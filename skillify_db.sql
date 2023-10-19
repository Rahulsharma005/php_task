-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 07:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `assignment` varchar(255) DEFAULT NULL,
  `analytics` varchar(255) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `instructor_id`, `student_id`, `assignment`, `analytics`, `report`) VALUES
(1, 'Mathematics 101', 1, 5, 'Math Assignment 1', 'Math Analytics 1', 'Math Report 1'),
(2, 'History 101', 1, 5, 'History Assignment 1', 'History Analytics 1', 'History Report 1'),
(3, 'Science 101', 1, 3, 'Science Assignment 1', 'Science Analytics 1', 'Science Report 1'),
(4, 'Programming 101', 1, 4, 'Programming Assignment 1', 'Programming Analytics 1', 'Programming Report 1');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `totalmarks` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `examdone` tinyint(1) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `date`, `marks`, `totalmarks`, `title`, `examdone`, `course_id`, `student_id`) VALUES
(1, '0000-00-00', 95, 100, 'History1', 1, 2, 5),
(2, '2023-10-01', 90, 100, 'History Exam 1', 1, 2, 3),
(3, '2023-10-05', 85, 100, 'Math Exam 1', 1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `feedback_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `instructor_id`, `student_id`, `feedback_text`) VALUES
(1, 1, 5, 'hi you doing good'),
(2, 1, 5, 'hi studnet good'),
(3, 1, 5, 'you are bad lier'),
(4, 1, 4, 'hi s680');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `Attendance` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `Attendance`, `course_id`, `student_id`, `exam_id`) VALUES
(9, '1', 2, 5, 1),
(10, '1', 2, 3, 2),
(11, '1', 2, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `userdesc`
--

CREATE TABLE `userdesc` (
  `user_id` int(11) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdesc`
--

INSERT INTO `userdesc` (`user_id`, `age`, `address`, `about`) VALUES
(1, 30, '123 Main St, City', 'Brief description for user 1'),
(2, 25, '456 Elm St, Town', 'Brief description for user 2'),
(3, 28, '789 Oak St, Village', 'Brief description for user 3'),
(4, 22, '567 Pine St, Suburb', 'Brief description for user 4'),
(5, 24, '890 Cedar St, Town', 'Brief description for user 5'),
(6, 35, '1234 Oak St, City', 'Brief description for user 6'),
(7, 40, '5678 Elm St, Town', 'Brief description for user 7'),
(8, 27, '9876 Maple St, Village', 'Brief description for user 8'),
(20, 22, 'Near Laxmi apartment', 'i don;t know'),
(21, 22, 'newperson', 'newperson'),
(22, NULL, NULL, 'i am admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`) VALUES
(1, 'ashu', 'ashu', 'instructor', ''),
(2, 'rss', '$2y$10$/do0xXlbIY7M7y92fqaqU..rZndbLeZUiGjTVTX7diqouW9a64tX2', 'studnet', 'rss@female.com'),
(3, 'rahulsharmatiger293@gmail.com', '$2y$10$0ZwSmFXZTPrdq8A6XkorAe.v4.gpJo3YmR.noDTdwNML1r7gMupsm', 'student', 'rahulsharmatiger293@gmail.com'),
(4, 'S680', '$2y$10$VsOHPfRc46GI.gKB3AOHR.O/HqE9Rc.L79O2n/U3TroWBdheSqMGO', 'student', 'tempmail@gmail.com'),
(5, 'student', '$2y$10$RxShGBLZQxWH.VHrY1aAyuGWNq.0.RV8DijecTCo8ieaJD5FnjXPe', 'student', 'studnet@gmail.com'),
(6, 'Aashutosh002', 'Aashutosh002', 'admin', 'Aashutosh002@gmail.com'),
(7, 'ajay', 'Ajay@123', 'instructor', 'tolujugib.goqolaji@gotgel.org'),
(8, 'Heyiaditya05', 'Aditya@111222', 'coordinator', 'adityasaini3836@gmail.com'),
(19, 'hi5', '8Rtq0oJT', 'instructor', 'hi5@instructor@sklify.com'),
(20, 'newperson', '$2y$10$ZxgD5nLBSq2Mo7pRq3.9Q.d/AfW5zHN4uShKegEEJPYy731IBOGim', 'qa', 'newperson@sklify.com'),
(21, 'ashu2', 'newperson', 'instructor', 'newperson@gmail.com'),
(22, 'S682', 'Iamadmin', 'admin', 'Admin@sklifiy.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `userdesc`
--
ALTER TABLE `userdesc`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `userdesc`
--
ALTER TABLE `userdesc`
  ADD CONSTRAINT `userdesc_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
