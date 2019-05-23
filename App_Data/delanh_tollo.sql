-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2019 at 09:35 AM
-- Server version: 5.7.25
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delanh_tollo`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `fullname`, `age`, `gender`, `bio`, `user_id`) VALUES
(36, 'j', 0, '', '', 9),
(37, 'Justin', 23, 'Male', 'Rock climbing enthusiast', 5),
(38, '', 0, '', '', 12),
(39, 'bev', 30, 'f', 'I&#39;m a webdev and my name is bev. Gucci gang fam.', 13),
(40, 'John Doe', 23, 'M', 'Hi my name is John Doe!', 17);

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
(5, 'Power Clean Day', 1),
(6, 'Bench Day 2', 1),
(8, 'Chest Day', 3),
(9, 'Chest Day', 3),
(14, 'Test Add Day', 4),
(15, 'TestDay1', 6),
(16, 'Test3 Add Day', 6),
(17, '2312', 7),
(18, 'TYrafa', 8),
(19, 'Test', 6);

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
(13, 5, 1, 1, 3, 5),
(14, 5, 5, 2, 3, 5),
(15, 5, 4, 3, 5, 3),
(16, 6, 1, 1, 3, 5),
(17, 6, 2, 2, 3, 5),
(18, 6, 3, 3, 3, 8),
(21, 8, 2, 1, 8, 12),
(22, 8, 9, 2, 8, 12),
(23, 9, 2, 1, 12, 12),
(24, 9, 9, 2, 12, 12),
(28, 14, 3, 0, 5, 7),
(29, 14, 6, 1, 1, 5),
(30, 14, 5, 1, 5, 5),
(31, 15, 2, 0, 4, 5),
(32, 15, 8, 1, 4, 3),
(33, 16, 1, 0, 2, 2),
(34, 16, 8, 1, 3, 3),
(36, 15, 9, 1, 77, 77),
(37, 14, 1, 1, 1, 5),
(38, 14, 1, 1, 3, 3),
(39, 17, 1, 0, 2, 2),
(40, 17, 2, 1, 2, 2),
(41, 18, 1, 0, 0, 0),
(42, 18, 1, 1, 0, 0),
(43, 19, 2, 0, 2, 2),
(44, 19, 4, 1, 2, 4),
(45, 18, 8, 1, 3, 3);

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

--
-- Dumping data for table `diaries`
--

INSERT INTO `diaries` (`id`, `title`, `date`, `content`, `userid`) VALUES
(1, 'dear diary', '2019-04-19', 'this project was hard', 5);

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
(9, 'Bicep Curls', 'Isolation exercises targeting the biceps on the arm.', 1),
(10, 'Ok', 'Up\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `complete_by` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `name`, `description`, `type`, `status`, `complete_by`, `user_id`) VALUES
(34, 'testing', 'Heloooo!', 'longterm', 0, '2019-04-19', 10),
(35, 'Ok', NULL, 'daily', 0, NULL, 2),
(36, 'Ok', 'ok', 'longterm', 0, '2019-04-19', 2),
(37, 'Testing', '123', 'longterm', 0, '2019-04-19', 2),
(38, 'Drink 5L Of Water', NULL, 'daily', 1, NULL, 17);

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
  `weight` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `date`, `exerciseid`, `sets`, `reps`, `weight`, `user`) VALUES
(1, '2019-03-20', 4, 3, 5, 315, 1),
(2, '2019-03-20', 5, 3, 5, 145, 1),
(3, '2019-03-20', 6, 1, 5, 295, 1),
(4, '2019-03-15', 1, 3, 5, 260, 1),
(5, '2019-03-15', 2, 3, 5, 225, 1),
(6, '2019-03-15', 3, 3, 8, 0, 1),
(7, '2019-03-13', 1, 3, 5, 255, 1),
(8, '2019-03-13', 5, 3, 5, 160, 1),
(9, '2019-03-13', 6, 1, 5, 285, 1),
(10, '2019-03-21', 4, 5, 3, 225, 1),
(11, '2019-03-27', 1, 5, 5, 275, 1),
(12, '2019-04-07', 1, 8, 8, 225, 1),
(13, '2019-04-18', 4, 5, 3, 225, 1),
(14, '2019-04-18', 1, 5, 5, 225, 1),
(15, '2019-04-19', 1, 3, 3, 333, 1),
(27, '2019-04-19', 1, 5, 5, 55, 1),
(28, '2019-04-19', 8, 5, 5, 5, 1),
(30, '2019-04-19', 4, 5, 3, 135, 1),
(31, '2019-04-19', 8, 9, 9, 100, 1),
(32, '2019-04-19', 1, 3, 13, 180, 5);

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `current` float NOT NULL,
  `goal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `user_id`, `name`, `current`, `goal`) VALUES
(10, 16, 'Sleeve', 33, 35);

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
  `goal_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `reminder_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `name`, `message`, `status`, `time`, `date`, `goal_id`, `user_id`, `reminder_id`) VALUES
(1, 'Reminder', 'add to log', 'unread', '18:18:00', '2019-04-06 00:00:00', NULL, 4, 24),
(2, 'Reminder', 'eat food', 'unread', '18:21:00', '2019-04-06 00:00:00', NULL, 4, 25),
(3, 'Reminder', 'meal prep', 'unread', '18:19:00', '2019-04-06 00:00:00', NULL, 4, 26),
(4, 'Reminder', 'test', 'unread', '18:50:00', '2019-04-06 00:00:00', NULL, 4, 27),
(5, 'Reminder', 'test', 'unread', '11:11:00', '2019-04-06 00:00:00', NULL, 4, 28),
(6, 'Reminder', 'test123', 'unread', '11:11:00', '2019-04-06 00:00:00', NULL, 4, 29),
(9, 'Reminder', '<h1>ahhhh</h1>', 'unread', '00:12:00', '2019-04-17 00:00:00', NULL, 9, 3),
(16, 'Reminder', 'test', 'unread', '11:11:00', '2019-04-19 00:00:00', NULL, 5, 12),
(23, 'Goal reached', 'testing', 'unread', '12:00:00', '2019-04-19 00:00:00', 34, 10, NULL),
(24, 'Reminder', 'test', 'unread', '00:22:00', '2019-04-19 00:00:00', NULL, 9, 18),
(25, 'Reminder', 'test', 'unread', '11:11:00', '2019-04-19 00:00:00', NULL, 9, 19),
(26, 'Goal reached', 'Ok', 'unread', '12:00:00', '2019-04-19 00:00:00', 36, 2, NULL),
(27, 'Goal reached', 'Testing', 'unread', '12:00:00', '2019-04-19 00:00:00', 37, 2, NULL),
(28, 'Reminder', 'hello', 'unread', '14:22:00', '2019-04-19 00:00:00', NULL, 10, 15),
(29, 'Reminder', 'hello', 'unread', '14:22:00', '2019-04-19 00:00:00', NULL, 10, 16),
(34, 'Reminder', 'Drink a glass of water ', 'unread', '02:30:00', '2019-04-20 00:00:00', NULL, 17, 20),
(36, 'Reminder', 'Drink a glass of water ', 'unread', '02:10:00', '2019-04-20 00:00:00', NULL, 17, 22);

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
(3, '6-Week Magic Biceps and Abs', 1, 'TURBO BLAST your arms for the beach.'),
(4, 'Test', 1, 'Test'),
(6, 'FInal Test', 1, 'Testing all CRUD operations for programs. Test Edit Program again2'),
(7, 'Testing Auth and Path', 1, 'Testing Auth and Path'),
(8, 'FInal Test', 1, 'Testing with validation');

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
(2, 2, 1, 1),
(3, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `date`, `user_id`, `time`, `title`) VALUES
(5, '2019-04-24', 2, '23:02:00', 'helloooo'),
(12, '2019-04-19', 5, '11:11:00', 'test1231123'),
(15, '2019-04-19', 10, '14:22:00', 'hello'),
(16, '2019-04-19', 10, '14:22:00', 'hello'),
(18, '2019-04-19', 9, '00:22:00', 'test123'),
(19, '2019-04-19', 9, '11:11:00', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `title` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(200) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `title`, `date`, `content`, `userid`) VALUES
(6, 5, 'This app is great!', '2019-04-17 07:29:24', 'Testing app', 10),
(7, 1, 'Oh', '2019-04-17 07:34:04', 'Feels', 10),
(8, 5, 'y the fade in so long for this', '2019-04-18 22:54:49', 'just trollin', 5);

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
(1, 'delan', '$2y$10$15r29PBYBPZK9qsIJPih8.ChIe.zj84AHsjyXyW37ZBTd6dpWHRGK', 'd.hamasoor@gmail.com', '../img/tenor.gif', 1, NULL, NULL),
(2, 'beverly', '$2y$10$Yc9VEzeAnoV/vltmHimc6OSFrmSs78IfSZAx0GNLF/VbYzo46/ue6', 'bev@live.com', '../img/bev.png', NULL, NULL, NULL),
(3, 'beverly', '$2y$10$B0O40jheykg4QaJ9IH8y3.WWSg7gsbeuEbB5.FRQY9eP9M1OQ3ZZq', 'beverly.li@live.com', '../img/DesktopDesign.png', NULL, NULL, NULL),
(4, 'justi666', '$2y$10$n.pa9FBK64swq58GB0hBbe1l1CzAA4uNXddh1UeQ6wGYIS1UGAAhq', 'bustijusti@gmail.com', '../img/deadpool.jpg', NULL, NULL, NULL),
(5, 'busti', '$2y$10$xaEeGAAQAiG22U1JlPW98u0GT4BrR2JGKJPVlULIQ05WhT7WKBW/y', 'jc@live.ca', '../img/deadpool.jpg', NULL, NULL, NULL),
(6, 'justi666', '$2y$10$VImP5zD.8Si6GkhSf.yjGOefhha3Yy8ca8hQnqfXcDr4v6cA4ZbKm', 'bj@live.ca', '../img/deadpool.jpg', NULL, NULL, NULL),
(7, 'justi666', '$2y$10$yrzXVNaAvaYbG61Y1L7Sq.uy.daoVP5p4PN8vwQWw1CiO0LPy951K', 'bj@live.ca', '../img/deadpool.jpg', NULL, NULL, NULL),
(8, 'bustiJ', '$2y$10$IXu6ddlbbQCT8aXImkpEBer6dzwOVJvD9GM8ssSTitGBUEFnAoT2m', 'bustijusti@gmail.com', '../img/deadpool.jpg', NULL, NULL, NULL),
(9, 'jc', '$2y$10$GeyRyTceEzQbF894VzW0QeghhhCx6Q0Fdktfx5J0N1PICQ.snjk6e', 'jc@live.ca', '../img/deadpool.jpg', NULL, NULL, NULL),
(10, 'jing', '$2y$10$cQV83g3xjqHSrNgg3g9FH.h8EOVREcEKludHgwjk7VTB/sGI.1zlS', 'jing@hotmail.com', '../img/hi.gif', NULL, NULL, NULL),
(11, 'delan', '$2y$10$15r29PBYBPZK9qsIJPih8.ChIe.zj84AHsjyXyW37ZBTd6dpWHRGK', 'd.hamasoor@gmail.com', '../img/tenor.gif', NULL, NULL, NULL),
(12, 'Jong', '$2y$10$HBoLL2zdBMXGKXOc4..SseIA8UMXEHer//rINzVlF.uWpUa89y2XS', 'jonguscheng@kek.com', '../img/youknownothing.png', NULL, NULL, NULL),
(13, 'webdevbev', '$2y$10$.XccLus.IciDj022ajj1puynuKOn0PJPq/pc4Xb9M3QqUKzUg9UyS', 'webdevbev@devbev.ca', '../img/Caitlyn-Jenner-arrives-at-Heathrow-Airport-from-Los-Angeles.png', NULL, NULL, NULL),
(14, 'Justin', '$2y$10$CEeSw0rEUm0XGXpa7LyIV.M/FXJGfy6lifTko0AOnMX982TlYcLxK', 'jc@live.ca', '../img/cssisawesome.jpg', NULL, NULL, NULL),
(15, 'Nithya', '$2y$10$E6uTIoasoh6mzRbi7nU3MOO0jCnEUTszGh4wYFiMMj0G/31bYoC2S', 'nithya@humber.com', '../img/download (2).jpg', NULL, NULL, NULL),
(16, 'John Doe', '$2y$10$o7IIdQrX2A/tCed.Dq1Zn.KpCajm16OfHsZOsKQ4sgZEkL1kiqOZG', '1234@live.com', '../img/download (2).jpg', NULL, NULL, NULL),
(17, 'johndoe', '$2y$10$uaJ0FbGxi7CydbZ9WkiapeBopvipYtXBBel7anmXgvCNLN/YyshbO', 'johndoe@live.com', '../img/download (2).jpg', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `traininglog_fk_exercises` (`exerciseid`),
  ADD KEY `logs_fk_users` (`user`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notifications_fk_goals` (`goal_id`),
  ADD KEY `reminder_id` (`reminder_id`);

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_fk_users` (`userid`);

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
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `days_exercises`
--
ALTER TABLE `days_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `diaries`
--
ALTER TABLE `diaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `programs_users`
--
ALTER TABLE `programs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_fk_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_fk_goals` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`),
  ADD CONSTRAINT `notifications_fk_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_fk_users` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_fk_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

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
