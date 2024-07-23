-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 03, 2023 lúc 04:13 PM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `smsdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`acc_id`, `email`, `password`) VALUES
(1, 'email@admin.com', '$2y$10$u5tKSHZdDY4Ji1lnKOst6.rYeVPw196aDpGNhyFjKNsmYGWcf.rjK'),
(2, 'study1@student.edu.vn', '$2y$10$iC2o1N6Cd34r4SMr4VZFdOtrrvVxpmMJYXzIgOABWWx0zrUuVE0f2'),
(3, 'study2@student.edu.vn', '$2y$10$einEFB9W9Kyw1aqJOHLJA.K54uF.4ev1n939RfSaYgSJCaQz3u8vm'),
(5, 'study3@student.edu.vn', '$2y$10$2WsbnyfLJjfOy7UBj5HNAOWaE7tIvKVAgx6aIxGyIG.XZMNuXdGpK'),
(6, 'teach1@teacher.edu.vn', '$2y$10$9amVY.7.JoMKIkLBQUBYI.ab91eodV5KudFRoesKxNxdWo4FgHoBi'),
(7, 'teach2@teacher.edu.vn', '$2y$10$tmvGoDVqRjZu0FBZlmWUVOZoJwCV4d/sfTB3aL.5UdN1g1RV/23JS'),
(8, 'teach3@teacher.edu.vn', '$2y$10$QyhE4HCjHIRn7zlxJYrEwuDouwN61seiqBA3VXXBkbHF4bMfiqgn2'),
(9, 'teach4@teacher.edu.vn', '$2y$10$4iV.U3VYkgSypfdWrpdpDuQCVDopgsrgWLEdBSMCCwJ5xZIOTCf9a'),
(10, 'study4@student.edu.vn', '$2y$10$3CQkPJhz5a382t1Q7o6bVO9tXEpUD7QuR4o4ZnfmoodT1S7L53ZVO'),
(51, 'thai@teacher.edu.vn', '$2y$10$hx0sQTc83HcVfVY02KFuDeTNgtwveWbrmPSS5FW2yeC051R3sNiT.'),
(52, 'Peter@study.edu.vn', '$2y$10$eHoenicAaWYk7grnKXzcb.aCn9G4GHSGtc6ZzOz79DXOm0Ftutkji');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `section`, `date_created`, `teacher_id`) VALUES
(1, '12', 'A', '2022-10-11 21:21:11', 9),
(2, '12', 'B', '2022-10-11 21:21:11', 4),
(3, '12', 'C', '2022-10-11 21:21:11', 8),
(4, '12', 'D', '2022-10-11 21:21:11', 7),
(7, '8', 'B', '2022-11-02 15:57:47', 6),
(6, '10', 'F', '2022-10-20 23:15:14', 4),
(8, '11', 'D', '2023-04-03 23:00:47', 51);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classroom_student`
--

DROP TABLE IF EXISTS `classroom_student`;
CREATE TABLE IF NOT EXISTS `classroom_student` (
  `classroom_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attend_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classroom_student`
--

INSERT INTO `classroom_student` (`classroom_id`, `student_id`, `attend_day`) VALUES
(1, 2, '2023-03-22 21:53:21'),
(2, 10, '2022-10-29 10:38:04'),
(2, 5, '2022-10-29 10:38:04'),
(7, 3, '2023-03-23 19:01:47'),
(8, 52, '2023-04-03 23:10:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class_notices`
--

DROP TABLE IF EXISTS `class_notices`;
CREATE TABLE IF NOT EXISTS `class_notices` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `notice_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notice_body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class_notices`
--

INSERT INTO `class_notices` (`notice_id`, `acc_id`, `class_id`, `notice_title`, `notice_body`, `date_created`) VALUES
(9, 1, 7, 'New timetable for grade 8B', 'Please visit the system\'s moodle website for details', '2023-04-03 22:52:49'),
(7, 9, 1, 'Opening class 12A', 'Opening class 12A on 15/4/2023', '2023-03-21 15:40:21'),
(8, 1, 7, 'Opening class 8B', 'Opening class 8B on 5/4/2023', '2023-04-03 22:51:18'),
(10, 51, 8, 'Opening class 11D', 'Opening class 11D on 5/04/2023', '2023-04-03 23:11:36'),
(11, 51, 8, 'Notice of school leave on 6/4/2023', 'The teacher has an unexpected job, so the students are off on 6/4/2023', '2023-04-03 23:12:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homework`
--

DROP TABLE IF EXISTS `homework`;
CREATE TABLE IF NOT EXISTS `homework` (
  `hw_id` int(11) NOT NULL AUTO_INCREMENT,
  `hw_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hw_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due` datetime NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`hw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `homework`
--

INSERT INTO `homework` (`hw_id`, `hw_title`, `hw_description`, `date_created`, `due`, `teacher_id`, `class_id`) VALUES
(1, 'Mid Term exam online', 'Build a meme website using MVC pattern', '2022-11-09 12:30:00', '2023-11-17 12:30:00', 6, 7),
(8, 'Homework 22222', 'Homework 22222Homework 22222Homework 22222Homework 22222Homework 22222', '2023-03-22 15:50:28', '2023-03-31 19:54:00', 9, 1),
(3, 'Assignment 2: Reflective report', 'Write about what went well and what is not went so well. Recommend solution for the course.', '2022-11-09 16:06:32', '2022-11-30 16:00:00', 6, 7),
(21, 'Exercise 1', 'Do about an article about scientific research. Request to submit in pdf file', '2023-04-03 23:08:27', '2023-04-14 23:08:00', 51, 8),
(22, 'IT Report', 'Write a report about a business that needs help from an IT consultant', '2023-04-03 23:09:40', '2023-04-11 23:09:00', 51, 8),
(20, 'Test123123', 'Test123123Test123123Test123123Test123123', '2023-04-01 22:44:11', '2023-04-09 22:44:00', 9, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `public_notices`
--

DROP TABLE IF EXISTS `public_notices`;
CREATE TABLE IF NOT EXISTS `public_notices` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `notice_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notice_body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `public_notices`
--

INSERT INTO `public_notices` (`notice_id`, `acc_id`, `notice_title`, `notice_body`, `date_created`) VALUES
(5, 1, 'Upcoming new Semester', 'The new semester will start on April 17, 2023', '2023-04-03 22:47:13'),
(6, 1, 'Holiday April 30, 2023', 'The combined classes will have 2 days off for Hung Vuong\'s death anniversary on April 30 and International Labor Day on May 1.', '2023-04-03 22:49:01'),
(7, 1, 'Award ceremony for the 2020', 'The award ceremony will start on April 10, everyone is welcome to participate in the award ceremony', '2023-04-03 22:50:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `hw_id` int(11) NOT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `submissions`
--

INSERT INTO `submissions` (`sub_id`, `student_id`, `hw_id`, `file_url`, `sub_date`, `size`, `type`, `grade`) VALUES
(8, 2, 15, 'Untitled Diagram2.drawio.png', '2023-03-24 16:53:48', '16924', 'image/png', NULL),
(7, 2, 8, 'Taran_Dave.pdf', '2023-03-24 16:48:27', '410797', 'application/pdf', NULL),
(9, 3, 1, '2059026_2059039_ReviewExercies.pdf', '2023-03-26 22:16:10', '103674', 'application/pdf', NULL),
(17, 2, 20, '2059026_2059039_HW03 (1).pdf', '2023-04-01 22:46:00', '488032', 'application/pdf', NULL),
(18, 52, 21, '2022-CS300-19BIT-FinalExam.pdf', '2023-04-03 23:10:29', '417138', 'application/pdf', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `Fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DoB` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `phone_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `Fname`, `Lname`, `DoB`, `image`, `gender`, `phone_num`, `role`, `date_created`, `last_login_date`) VALUES
(1, 'Cat', 'Noir', '2022-09-28 00:00:00', '../../images/itec_642afb1e58187.png', 1, '99840763', 0, '2022-10-11 21:43:49', '2023-04-03 11:13:12'),
(2, 'Chad', 'Man', '2022-11-25 00:00:00', '', 1, '113', 2, '2022-10-11 21:43:49', '2023-04-01 10:44:17'),
(3, 'Doja', 'Cat', '2022-10-26 00:00:00', '', 1, '985931589', 2, '2022-10-11 21:43:49', '2023-03-31 11:44:15'),
(5, 'Shawn', 'Mendes', '2022-10-27 00:00:00', '', 0, '99922558', 2, '2022-10-11 21:43:49', '2022-10-11 21:43:49'),
(6, 'Charlie', 'Puth', '2022-11-30 00:00:00', '../../images/itec_641d4d44a640c.png', 0, '999882176', 1, '2022-10-11 21:43:49', '2023-04-01 10:43:42'),
(7, 'Peppa', 'Pig', '2022-11-10 00:00:00', '', 1, '95333286', 1, '2022-10-11 21:43:49', '2022-10-11 21:43:49'),
(8, 'Trinh', 'Lan', '2022-11-22 00:00:00', '', 0, '96668351', 1, '2022-10-11 21:43:49', '2022-10-11 21:43:49'),
(9, 'Lady', 'Gaga', '2023-03-16 00:00:00', '../../images/itec_641d4d5b8434e.png', 1, '98837480', 1, '2022-10-11 21:43:49', '2023-04-01 10:46:52'),
(10, 'Adam', 'Levine', '2022-10-28 00:00:00', '', 1, '91236377', 2, '2022-10-11 21:43:49', '2022-10-11 21:43:49'),
(44, 'Number', 'One', '2022-10-01 00:00:00', '', 1, '6436435948', 2, '2022-10-22 00:16:34', '2022-10-22 00:16:34'),
(45, 'Number', 'Two', '2022-10-02 00:00:00', '', 0, '09808798708', 2, '2022-10-22 00:16:34', '2022-10-22 00:16:34'),
(47, 'Number', 'Four', '2022-10-04 00:00:00', '', 0, '46546547547', 2, '2022-10-22 00:16:34', '2022-10-22 00:16:34'),
(51, 'Thai', 'Nguyen', '2002-11-20 00:00:00', '../../images/itec_642afb0cb3822.png', 0, '12312312312', 1, '2023-04-03 22:58:57', '2023-04-03 11:10:49'),
(52, 'Peter', 'Nguyen', '2006-02-03 00:00:00', '', 1, '12312312312', 2, '2023-04-03 23:03:34', '2023-04-03 11:10:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
