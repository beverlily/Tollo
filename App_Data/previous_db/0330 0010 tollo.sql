-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 03:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tollo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `type`) VALUES
(1, 'strength'),
(2, 'endurance');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `program`) VALUES
(1, 'Day 1', 2),
(2, 'Day 2', 2),
(3, 'Deadlift Day', 1),
(4, 'Bench Day 1', 1),
(5, 'Power Clean Day', 1),
(6, 'Bench Day 2', 1),
(7, 'Chest Day', 3),
(8, 'Chest Day', 3),
(9, 'Chest Day', 3);

-- --------------------------------------------------------

--
-- Table structure for table `days_exercises`
--

CREATE TABLE `days_exercises` (
  `id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days_exercises`
--

INSERT INTO `days_exercises` (`id`, `day_id`, `exercise_id`, `sequence`, `sets`, `reps`) VALUES
(1, 1, 1, 1, 5, 5),
(2, 1, 2, 2, 5, 5),
(3, 1, 8, 3, 5, 5),
(4, 2, 1, 1, 5, 5),
(5, 2, 5, 2, 5, 5),
(6, 2, 6, 3, 1, 5),
(7, 3, 1, 1, 3, 5),
(8, 3, 5, 2, 3, 5),
(9, 3, 6, 3, 1, 5),
(10, 4, 1, 1, 3, 5),
(11, 4, 2, 2, 3, 5),
(12, 4, 3, 3, 3, 8),
(13, 5, 1, 1, 3, 5),
(14, 5, 5, 2, 3, 5),
(15, 5, 4, 3, 5, 3),
(16, 6, 1, 1, 3, 5),
(17, 6, 2, 2, 3, 5),
(18, 6, 3, 3, 3, 8),
(19, 7, 2, 1, 5, 12),
(20, 7, 9, 2, 5, 12),
(21, 8, 2, 1, 8, 12),
(22, 8, 9, 2, 8, 12),
(23, 9, 2, 1, 12, 12),
(24, 9, 9, 2, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `diaries`
--

CREATE TABLE `diaries` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `description`, `category_id`) VALUES
(1, 'Barbell Squat', 'A full barbell squat, low-bar or high-bar.', 1),
(2, 'Barbell Bench Press', 'A standard barbell bench press.', 1),
(3, 'Chin-ups', 'Regular bodyweight chin-ups.', 1),
(4, 'Power Cleans', 'Barbell power cleans from the floor.', 1),
(5, 'Overhead Press', 'aka Military Press, the Press', 1),
(6, 'Deadlift', 'Barbell deadlift from the floor.', 1),
(7, 'treadmill', 'Running on a treadmill.', 2),
(8, 'Bent-Over Rows', 'aka Pendlay Rows', 1),
(9, 'Bicep Curls', 'Isolation exercises targeting the biceps on the arm.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `exerciseid` int(11) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `date`, `exerciseid`, `sets`, `reps`, `weight`) VALUES
(1, '2019-03-20', 1, 3, 5, 315),
(2, '2019-03-20', 5, 3, 5, 145),
(3, '2019-03-20', 6, 1, 5, 295),
(4, '2019-03-15', 1, 3, 5, 260),
(5, '2019-03-15', 2, 3, 5, 225),
(6, '2019-03-15', 3, 3, 8, 0),
(7, '2019-03-13', 1, 3, 5, 255),
(8, '2019-03-13', 5, 3, 5, 160),
(9, '2019-03-13', 6, 1, 5, 285),
(10, '2019-03-21', 4, 5, 3, 225),
(11, '2019-03-27', 1, 3, 5, 275);

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `current` int(11) NOT NULL,
  `goal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `time` time NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `message`, `status`, `time`, `date`, `user_id`) VALUES
(11, '', 'You\'re almost there!', '', '00:00:00', '2019-03-03 00:00:00', 1),
(13, '', 'Goal Reached!', '', '00:00:00', '2004-03-19 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `authorid` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `authorid`, `description`) VALUES
(1, 'Starting Strength', 1, 'Mark Rippetoe\'s famous beginner bulking program.'),
(2, 'Stronglifts', 1, 'A good 5x5 strength program for beginners.'),
(3, '6-Week Magic Biceps and Abs', 1, 'TURBO BLAST your arms for the beach.');

-- --------------------------------------------------------

--
-- Table structure for table `programs_users`
--

CREATE TABLE `programs_users` (
  `id` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs_users`
--

INSERT INTO `programs_users` (`id`, `program`, `user`, `active`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `msg` varchar(300) COLLATE utf8_bin NOT NULL,
  `send_email` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `date`, `msg`, `send_email`, `user_id`, `time`, `title`) VALUES
(1, '2019-03-27', 'test', 0, 0, '02:22:00', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `factor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `factor`) VALUES
(1, 'lb', 0.453592),
(2, 'kg', 2.20462);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `measurement_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `unit_id`, `goal_id`, `measurement_id`) VALUES
(1, 'jdoe', 'Password', 'test@test.com', '', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `days_fk_programs` (`program`);

--
-- Indexes for table `days_exercises`
--
ALTER TABLE `days_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_id` (`day_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `diaries`
--
ALTER TABLE `diaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diaries_fk_users` (`userid`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exercises_fk_categories` (`category_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traininglog_fk_exercises` (`exerciseid`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_fk_users` (`authorid`);

--
-- Indexes for table `programs_users`
--
ALTER TABLE `programs_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_fk_programs` (`program`),
  ADD KEY `users_fk_users` (`user`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `measurement_id` (`measurement_id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `days_exercises`
--
ALTER TABLE `days_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `diaries`
--
ALTER TABLE `diaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programs_users`
--
ALTER TABLE `programs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `days_fk_programs` FOREIGN KEY (`program`) REFERENCES `programs` (`id`);

--
-- Constraints for table `diaries`
--
ALTER TABLE `diaries`
  ADD CONSTRAINT `diaries_fk_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_fk_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_fk_users` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `goal_id` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`),
  ADD CONSTRAINT `measurement_id	` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`id`),
  ADD CONSTRAINT `unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
