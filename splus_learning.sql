-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2020 at 06:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `splus_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `answer` varchar(10) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `answer`, `question_id`) VALUES
(1, 'c', 1),
(2, 'b', 2),
(3, 'c', 3),
(4, 'a', 4),
(5, 'd', 5),
(6, 'c', 6),
(7, 'b', 7),
(8, 'c', 8),
(9, 'c', 9),
(10, 'a', 10),
(11, 'b', 11),
(12, 'c', 12),
(13, 'd', 13);

-- --------------------------------------------------------

--
-- Table structure for table `exam_result_manage`
--

CREATE TABLE `exam_result_manage` (
  `question_solve` int(11) DEFAULT NULL,
  `true_answer` int(11) DEFAULT NULL,
  `false_answer` int(11) DEFAULT NULL,
  `perentage_gain` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_result_manage`
--

INSERT INTO `exam_result_manage` (`question_solve`, `true_answer`, `false_answer`, `perentage_gain`) VALUES
(0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_status`
--

CREATE TABLE `exam_status` (
  `exam_id` int(11) NOT NULL,
  `exam_status` varchar(50) DEFAULT 'start',
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_status`
--

INSERT INTO `exam_status` (`exam_id`, `exam_status`, `topic_id`, `user_id`) VALUES
(1, 'restart', 1, 1),
(2, 'restart', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `opt1` varchar(100) DEFAULT NULL,
  `opt2` varchar(100) DEFAULT NULL,
  `opt3` varchar(100) DEFAULT NULL,
  `opt4` varchar(100) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `opt1`, `opt2`, `opt3`, `opt4`, `question_id`) VALUES
(1, 'computer since arcitecuter', 'computer software and automachine', 'computer system and architecture', 'none of above', 1),
(2, '3 ', '8', '1', '4', 2),
(3, 'database manager system', 'database most system', 'database management system', 'none of above', 3),
(4, 'structure query language', 'stand query language', 'storage query language', 'none of these', 4),
(5, '1', '4', '3', '7', 5),
(6, 'object created project', 'object oriented programming', 'data structure', 'b and c', 6),
(7, 'network is net is called network', 'network of network is called network', 'all of above', 'none of these', 7),
(8, 'java data breach connection', 'java developer bounty connection', 'java database connectivity', 'all option true', 8),
(9, 'software', 'system software', 'operating system', 'web application name', 9),
(10, 'print current working directory', 'print last working directore', 'a and b', 'none of these', 10),
(11, 'root/user/shadow', 'root/etc/shadow', 'root/temp/shadow', 'none of above', 11),
(12, 'cd', 'mv', 'cp', 'ls', 12),
(13, 'cd', 'mv', 'cp', 'ls', 13);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(200) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `topic_id`) VALUES
(1, 'full form of csa', 1),
(2, '1 byte = ____ bit', 1),
(3, 'full form of dbms', 2),
(4, 'full form of sql', 2),
(5, 'how many phases on life cycle in ssad', 3),
(6, 'cpp belongs to', 4),
(7, 'what is network', 5),
(8, 'full form of jdbc', 6),
(9, 'what is unix', 7),
(10, '$pwd command does', 7),
(11, 'where store password in linux', 7),
(12, 'which command is use to copy file', 7),
(13, 'which command is use to show list ', 7);

-- --------------------------------------------------------

--
-- Table structure for table `question_history`
--

CREATE TABLE `question_history` (
  `user_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `q_id` int(11) DEFAULT NULL,
  `answer` varchar(10) DEFAULT NULL,
  `c_time` time NOT NULL DEFAULT current_timestamp(),
  `c_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_history`
--

INSERT INTO `question_history` (`user_id`, `t_id`, `q_id`, `answer`, `c_time`, `c_date`) VALUES
(1, 1, 1, 'c', '09:23:35', '2020-07-23'),
(1, 1, 2, 'b', '09:23:38', '2020-07-23'),
(2, 1, 1, 'd', '09:25:08', '2020-07-23'),
(2, 1, 2, 'b', '09:25:11', '2020-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `percentage` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`percentage`, `user_id`) VALUES
(100, 1),
(50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `review` varchar(200) DEFAULT NULL,
  `likes` varchar(50) DEFAULT NULL,
  `dislike` varchar(50) DEFAULT NULL,
  `heart` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `rating`, `review`, `likes`, `dislike`, `heart`) VALUES
(1, '5', 'Wow that&#39;s awesome... ', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `discription` varchar(200) DEFAULT NULL,
  `tag` varchar(200) DEFAULT NULL,
  `c_time` time DEFAULT current_timestamp(),
  `c_date` date DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `name`, `discription`, `tag`, `c_time`, `c_date`, `status`) VALUES
(1, 'CSA', 'this is most popular topic which is include more awesome chapter..', 'csa,computer and system architecture,computer since', '09:09:50', '2020-07-23', 'active'),
(2, 'DBMS', 'dbms is most popular management system which is use to manage our files..', 'dbms,database conectivity,database management system', '22:17:43', '2020-07-23', 'active'),
(3, 'SSAD', 'this is system software analysis and design which is use to analyzing any project and create more effective software ', 'sad,structure query language', '05:02:09', '2020-07-24', 'active'),
(4, 'C++', 'data structure is very useful topic on IT WORLD. which is help to creating oops programming', 'cpp,object oriented, oops concept', '05:05:11', '2020-07-24', 'active'),
(5, 'DCN', 'networking is most usable method in the world', 'dcn,networking', '05:07:43', '2020-07-24', 'active'),
(6, 'JAVA', 'java language is most popular language.', 'java,oop programing', '05:10:36', '2020-07-24', 'active'),
(7, 'UNIX', 'unix is operating system which is used on server.', 'unix,linux,hacking operating system', '05:18:15', '2020-07-24', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `account_type` varchar(10) DEFAULT 'user',
  `status` varchar(10) DEFAULT 'active',
  `c_time` time NOT NULL DEFAULT current_timestamp(),
  `c_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `country_code`, `mobile`, `email`, `password`, `account_type`, `status`, `c_time`, `c_date`) VALUES
(1, 'satya', 'mishra', '+91', '9120829055', 'satyamishra559@gmail.com', '$2y$10$50ILejolhuxSmRCOyEWfr.udlO9uJAxKTODTfPmTW.qRiFebf48mC', 'admin', 'active', '08:49:00', '2020-07-23'),
(2, 'md.asif', 'khan', '+91', '1234567890', 'asif@example.com', '$2y$10$50ILejolhuxSmRCOyEWfr.udlO9uJAxKTODTfPmTW.qRiFebf48mC', 'user', 'active', '08:50:04', '2020-07-23'),
(3, 'admin', 'admin', '+91', '1234567890', 'admin@admin.com', '$2y$10$ZAcbfvUp/kj5uKoz9SHC3.ec5rr/IbeBez8BZYPdi8XaytvbuZeHC', 'admin', 'active', '09:06:15', '2020-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `visiter`
--

CREATE TABLE `visiter` (
  `num_visiter` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visiter`
--

INSERT INTO `visiter` (`num_visiter`) VALUES
('1636');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `exam_status`
--
ALTER TABLE `exam_status`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `question_history`
--
ALTER TABLE `question_history`
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `review` (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exam_status`
--
ALTER TABLE `exam_status`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `exam_status`
--
ALTER TABLE `exam_status`
  ADD CONSTRAINT `exam_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`);

--
-- Constraints for table `question_history`
--
ALTER TABLE `question_history`
  ADD CONSTRAINT `question_history_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `topics` (`topic_id`);

--
-- Constraints for table `ranks`
--
ALTER TABLE `ranks`
  ADD CONSTRAINT `ranks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
