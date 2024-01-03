-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 09:46 PM
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
-- Database: `ju_graduates`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `student_id`, `comment`, `created_at`) VALUES
(10, 9, 3, 'company on company', '2023-12-31 10:48:40'),
(11, 8, 3, 'company on student', '2023-12-31 10:49:00'),
(12, 7, 3, 'company on student', '2023-12-31 10:49:08'),
(13, 6, 3, 'company on student', '2023-12-31 10:49:14'),
(14, 9, 6, 'student on company', '2023-12-31 10:49:46'),
(15, 8, 6, 'student on student', '2023-12-31 10:50:04'),
(16, 7, 6, 'student on student', '2023-12-31 10:50:08'),
(17, 6, 6, 'student on student', '2023-12-31 10:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `image`, `active`, `created_at`) VALUES
(1, 'Deloitte', 'Company-images/company1.jpg', 1, '2023-10-24 00:08:46'),
(2, 'Microsoft', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:50:08'),
(3, 'Oracle', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:50:30'),
(4, 'Amazon', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:50:51'),
(5, 'Jo Aacdemy', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:51:19'),
(6, 'Watad', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:51:45'),
(7, 'KPMG', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:52:15'),
(8, 'DHL', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:52:56'),
(9, 'Royal hospital ', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:53:14'),
(10, 'Ibn al haitham hospital', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:53:27'),
(11, 'Jordan university hospital', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:53:41'),
(12, 'Drug center', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:53:54'),
(13, 'Hikma', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:54:14'),
(14, 'Arabtic', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:54:33'),
(15, 'Dar al omran', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:54:50'),
(16, 'Artica', 'Company-images/istockphoto-178447404-612x612.jpg', 1, '2023-12-30 18:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `active`, `created_at`) VALUES
(1, 'python', 1, '2023-12-26 20:04:46'),
(2, 'java', 1, '2023-12-26 20:06:00'),
(3, 'c++', 1, '2023-12-26 20:06:00'),
(4, 'Web Development tools', 1, '2023-12-30 18:57:44'),
(5, 'Angular', 1, '2023-12-30 18:58:00'),
(6, 'React js', 1, '2023-12-30 19:00:10'),
(7, 'Oracle ', 1, '2023-12-30 19:00:24'),
(8, 'Leadership', 1, '2023-12-30 19:02:16'),
(9, 'PMP', 1, '2023-12-30 19:02:43'),
(10, 'Feasibility Studies', 1, '2023-12-30 19:03:11'),
(11, 'Basic of Pricing', 1, '2023-12-30 19:03:30'),
(12, 'Project Managment', 1, '2023-12-30 19:03:50'),
(13, 'SQL', 1, '2023-12-30 19:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `active`) VALUES
(1, 'King Abdullah II Faculty for Information Technology', '2023-10-24 00:09:13', 1),
(42, 'Faculty of Arts', '2023-12-27 00:53:21', 1),
(43, 'Faculty of Business', '2023-12-27 00:53:21', 1),
(44, 'Faculty of Shari’a', '2023-12-27 00:53:21', 1),
(45, 'Faculty of Educational Sciences', '2023-12-27 00:53:21', 1),
(46, 'Faculty of Law', '2023-12-27 00:53:21', 1),
(47, 'Faculty of Physical Education', '2023-12-27 00:53:21', 1),
(48, 'Faculty of Arts and Design', '2023-12-27 00:53:21', 1),
(49, 'Faculty of International Studies & Political Sciences', '2023-12-27 00:53:21', 1),
(50, 'Faculty of Foreign Languages', '2023-12-27 00:53:21', 1),
(51, 'Faculty of Archeology & Tourism', '2023-12-27 00:53:21', 1),
(52, 'Faculty of Science', '2023-12-27 00:53:21', 1),
(53, 'Faculty of Agriculture', '2023-12-27 00:53:21', 1),
(54, 'Faculty of Engineering', '2023-12-27 00:53:21', 1),
(56, 'Faculty of Medicine', '2023-12-27 00:53:21', 1),
(57, 'Faculty of Nursing', '2023-12-27 00:53:21', 1),
(58, 'Faculty of Pharmacy', '2023-12-27 00:53:21', 1),
(59, 'Faculty of Dentistry', '2023-12-27 00:53:21', 1),
(60, 'Faculty of Rehabilitation Sciences', '2023-12-27 00:53:21', 1),
(61, 'University Requirements', '2023-12-27 00:53:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `created_at`, `active`) VALUES
(1, 'Java Developer', '2023-10-24 00:09:01', 1),
(2, 'C++ Developer', '2023-12-30 19:05:23', 1),
(3, 'Python Developer', '2023-12-30 19:05:34', 1),
(4, 'Database Specialist', '2023-12-30 19:06:03', 1),
(5, 'Web Developer', '2023-12-30 19:06:35', 1),
(6, 'Back-end Develepoer', '2023-12-30 19:09:17', 1),
(7, 'Frint-end Developer', '2023-12-30 19:09:31', 1),
(8, 'Designer', '2023-12-30 19:09:44', 1),
(9, 'Customer Service', '2023-12-30 19:10:08', 1),
(10, 'Software Developer ', '2023-12-30 19:10:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `department_id`, `name`, `created_at`, `active`) VALUES
(1, 1, 'Computer Information Systems', '2023-10-24 00:23:56', 1),
(2, 1, 'Computer Science', '2023-12-26 00:22:50', 1),
(17, 42, 'Arabic', '2023-12-27 01:00:55', 1),
(18, 42, 'Social Work', '2023-12-27 01:00:55', 1),
(19, 42, 'Geography', '2023-12-27 01:00:55', 1),
(20, 42, 'History', '2023-12-27 01:00:55', 1),
(21, 42, 'Philosophy', '2023-12-27 01:00:55', 1),
(22, 42, 'Psychology', '2023-12-27 01:00:55', 1),
(23, 42, 'Sociology', '2023-12-27 01:00:55', 1),
(24, 43, 'Accounting', '2023-12-27 01:00:55', 1),
(25, 43, 'BUSINESS ECONOMICS', '2023-12-27 01:00:55', 1),
(26, 43, 'Business Management', '2023-12-27 01:00:55', 1),
(27, 43, 'Finance', '2023-12-27 01:00:55', 1),
(28, 43, 'Management Information Systems', '2023-12-27 01:00:55', 1),
(29, 43, 'Marketing', '2023-12-27 01:00:55', 1),
(30, 43, 'Public Administration', '2023-12-27 01:00:55', 1),
(31, 44, 'Fundamental Principles Of Religion', '2023-12-27 01:01:43', 1),
(32, 45, 'Child Education', '2023-12-27 01:01:43', 1),
(33, 45, 'Library and Information Science', '2023-12-27 01:01:43', 1),
(34, 45, 'Special Education', '2023-12-27 01:01:43', 1),
(35, 46, 'Law', '2023-12-27 01:01:43', 1),
(36, 47, 'Physical Education', '2023-12-27 01:01:43', 1),
(37, 48, 'Music', '2023-12-27 01:01:43', 1),
(38, 48, 'Theater arts', '2023-12-27 01:01:43', 1),
(39, 48, 'Visual Art', '2023-12-27 01:01:43', 1),
(40, 49, 'Political Sciences', '2023-12-27 01:02:46', 1),
(41, 50, 'ENGLISH LANGUAGE', '2023-12-27 01:02:46', 1),
(42, 50, 'FRENCH LANGUAGE', '2023-12-27 01:02:46', 1),
(43, 50, 'GERMAN LANGUAGE', '2023-12-27 01:02:46', 1),
(44, 50, 'ITALIAN LANGUAGE', '2023-12-27 01:02:46', 1),
(45, 50, 'KOREAN LANGUAGE', '2023-12-27 01:02:46', 1),
(46, 50, 'SPANISH LANGUAGE', '2023-12-27 01:02:46', 1),
(47, 51, 'Archeology', '2023-12-27 01:02:46', 1),
(48, 52, 'Biological Sciences', '2023-12-27 01:02:46', 1),
(49, 52, 'Chemistry', '2023-12-27 01:02:46', 1),
(50, 52, 'GEOLOGY', '2023-12-27 01:02:46', 1),
(51, 52, 'Maths', '2023-12-27 01:02:46', 1),
(52, 52, 'Physics', '2023-12-27 01:02:46', 1),
(110, 53, 'Agricultural Economics', '2023-12-27 01:32:08', 1),
(111, 53, 'Animal Production', '2023-12-27 01:32:08', 1),
(112, 53, 'Horticulture and Crop Science', '2023-12-27 01:32:08', 1),
(113, 53, 'Land, Water and Environment', '2023-12-27 01:32:08', 1),
(114, 53, 'Nutrition and Food Technology', '2023-12-27 01:32:08', 1),
(115, 53, 'Plant Protection', '2023-12-27 01:32:08', 1),
(116, 54, 'Architectural Engineering', '2023-12-27 01:32:08', 1),
(117, 54, 'Chemical Engineering', '2023-12-27 01:32:08', 1),
(118, 54, 'Civil Engineering', '2023-12-27 01:32:08', 1),
(119, 54, 'Computer Engineering', '2023-12-27 01:32:08', 1),
(120, 54, 'Electrical Engineering', '2023-12-27 01:32:08', 1),
(121, 54, 'Industrial Engineering', '2023-12-27 01:32:08', 1),
(122, 54, 'Mechanical Engineering', '2023-12-27 01:32:08', 1),
(123, 54, 'Mechatronics Engineering', '2023-12-27 01:32:08', 1),
(124, 1, 'Business Information System', '2023-12-27 01:32:08', 1),
(127, 56, 'Medical Doctor', '2023-12-27 01:32:23', 1),
(128, 57, 'Nursing', '2023-12-27 01:32:23', 1),
(129, 58, 'Doctor Of Pharmacy', '2023-12-27 01:32:23', 1),
(130, 58, 'Pharmacy', '2023-12-27 01:32:23', 1),
(131, 59, 'Doctor Of Dental Surgery', '2023-12-27 01:32:23', 1),
(132, 60, 'Orthotics and Prosthetics', '2023-12-27 01:32:23', 1),
(133, 60, 'Physiotherapy', '2023-12-27 01:32:23', 1),
(134, 60, 'Hearing and Speech Science', '2023-12-27 01:32:23', 1),
(135, 60, 'Occupational Therapy', '2023-12-27 01:32:23', 1),
(136, 61, 'Obligatory and Elective University Requirements', '2023-12-27 01:32:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `student_id`, `title`, `description`, `image`, `active`, `created_at`) VALUES
(6, 6, 'test', 'this is test 1', 'Posts-Images/team-1.jpg', 1, '2023-12-31 10:08:59'),
(7, 6, 'test 2', 'this is test 2', 'Posts-Images/bg-signup1.jpg', 1, '2023-12-31 10:15:41'),
(8, 6, 'test 3', 'this is test 3', 'Posts-Images/blog-3.jpg', 1, '2023-12-31 10:19:10'),
(9, 3, 'company test 1', 'company test 1 (JOB OFFER!!!)\r\n', 'Posts-Images/vendor-6.jpg', 1, '2023-12-31 10:48:06'),
(10, 6, 'test', 'without photo', NULL, 1, '2024-01-02 00:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `students_cvs`
--

CREATE TABLE `students_cvs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students_cvs`
--

INSERT INTO `students_cvs` (`id`, `student_id`, `cv_file`, `created_at`) VALUES
(1, 6, 'CV-Files/FP.pdf', '2023-12-26 20:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `course_id`, `student_id`, `start_date`, `end_date`, `created_at`) VALUES
(8, 3, 6, '2023-12-26 18:22:14', '2023-12-26 18:22:14', '2023-12-26 20:22:36'),
(11, 2, 6, '2024-01-01 00:00:00', '2023-12-29 00:00:00', '2023-12-26 22:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `student_experinces`
--

CREATE TABLE `student_experinces` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_experinces`
--

INSERT INTO `student_experinces` (`id`, `company_id`, `job_id`, `student_id`, `description`, `start_date`, `end_date`, `created_at`) VALUES
(1, 1, 1, 4, 'nnbv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-12-26 11:39:54'),
(3, 16, 10, 6, 'this is my 2nd job', '2023-02-22 00:00:00', '2023-05-11 00:00:00', '2024-01-02 01:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `student_majors`
--

CREATE TABLE `student_majors` (
  `id` int(11) NOT NULL,
  `major_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `gpa` double NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_majors`
--

INSERT INTO `student_majors` (`id`, `major_id`, `student_id`, `gpa`, `start_date`, `end_date`, `created_at`) VALUES
(2, 1, 4, 4, '2023-11-27 00:00:00', '2023-12-15 00:00:00', '2023-12-26 11:11:46'),
(6, 2, 6, 4, '2020-09-15 00:00:00', '2024-02-02 00:00:00', '2024-01-02 01:09:45'),
(7, 1, 5, 4, '2020-05-09 00:00:00', '2024-05-10 00:00:00', '2024-01-02 01:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_projects`
--

CREATE TABLE `student_projects` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `main_image` text NOT NULL,
  `project_file` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_projects`
--

INSERT INTO `student_projects` (`id`, `student_id`, `title`, `description`, `main_image`, `project_file`, `created_at`) VALUES
(1, 4, 'Project 1', 'this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1', 'Projects-Images/FP.pdf', 'Projects-Images/FP.pdf', '2023-12-26 11:40:40'),
(2, 6, 'Project 1', 'this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1this is the p1', 'Projects-Images/istockphoto-178447404-612x612.jpg', 'Projects-Images/FP.pdf', '2023-12-26 20:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_researches`
--

CREATE TABLE `student_researches` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `research_image` text NOT NULL,
  `research_file` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student_researches`
--

INSERT INTO `student_researches` (`id`, `student_id`, `title`, `description`, `research_image`, `research_file`, `created_at`) VALUES
(1, 6, 'Research 1', 'this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 this is research 1 ', 'Researches_Images/istockphoto-178447404-612x612.jpg', 'Researches_Images/FP.pdf', '2023-12-26 20:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'Student-Images/userDefault.png',
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `name`, `email`, `password`, `phone`, `image`, `active`, `created_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', 'Jamal123@', '0123456789', 'Student-Images/userDefault.png', 1, '2023-10-23 23:57:47'),
(3, 3, 'Deloitte', 'Deloitte@gmail.com', 'Jamal123@', '0795256683', 'https://www.computerhope.com/jargon/g/guest-user.png', 1, '2023-12-26 00:19:52'),
(4, 2, 'Sara', 'sara@gmail.com', 'Sara123@', '0798877777', 'https://www.computerhope.com/jargon/g/guest-user.png', 1, '2023-12-26 11:10:29'),
(5, 2, 'Salma', 'salem@gmail.com', 'Salma123@', '0798888777', 'https://www.computerhope.com/jargon/g/guest-user.png', 1, '2023-12-26 11:13:54'),
(6, 2, 'Jamal Maslamani', 'jamal@gmail.com', 'Jamal123@', '0795256683', 'Student-Images/team-1.jpg', 1, '2023-12-26 19:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created_at`) VALUES
(1, 'ADMIN', '2023-10-23 23:56:42'),
(2, 'STUDENTS', '2023-10-23 23:56:42'),
(3, 'COMPANY', '2023-12-26 00:16:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students_cvs`
--
ALTER TABLE `students_cvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_experinces`
--
ALTER TABLE `student_experinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_majors`
--
ALTER TABLE `student_majors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major_id` (`major_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_researches`
--
ALTER TABLE `student_researches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students_cvs`
--
ALTER TABLE `students_cvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_experinces`
--
ALTER TABLE `student_experinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_majors`
--
ALTER TABLE `student_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_projects`
--
ALTER TABLE `student_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_researches`
--
ALTER TABLE `student_researches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `majors_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students_cvs`
--
ALTER TABLE `students_cvs`
  ADD CONSTRAINT `students_cvs_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_experinces`
--
ALTER TABLE `student_experinces`
  ADD CONSTRAINT `student_experinces_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `student_experinces_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `student_experinces_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_majors`
--
ALTER TABLE `student_majors`
  ADD CONSTRAINT `student_majors_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`),
  ADD CONSTRAINT `student_majors_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD CONSTRAINT `student_projects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_researches`
--
ALTER TABLE `student_researches`
  ADD CONSTRAINT `student_researches_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
