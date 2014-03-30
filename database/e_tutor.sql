-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2014 at 08:19 PM
-- Server version: 5.6.16
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e_tutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_admin`
--

CREATE TABLE IF NOT EXISTS `cms_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_admin`
--

INSERT INTO `cms_admin` (`admin_id`, `username`, `password`, `fullname`, `email`, `role_id`) VALUES
(1, 'Admin', 'admin123', 'Mikeal Steveson', 'long.nd144@gmail.com', 1),
(2, 'Staff', 'admin123', 'Caroline Swan', 'nd307@gre.ac.uk', 1),
(3, 'Manager', 'admin123', 'Theodore Bagwell', 'nd307@gre.ac.uk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_message`
--

CREATE TABLE IF NOT EXISTS `cms_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `tutor_id` varchar(100) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `cms_message`
--

INSERT INTO `cms_message` (`message_id`, `title`, `content`, `created_date`, `student_id`, `tutor_id`, `type_id`) VALUES
(1, 'Project Progress', 'Can we have a meeting next week?\r\n', '2014-03-04', 'nd307', 'CD409', 2),
(2, 'Coursework1', 'Meeting at 12am', '2014-03-01', 'nd307', 'CD409', 2),
(3, 'Coursework2', 'Meeting at 1pm', '2014-03-02', 'nd307', 'CD409', 2),
(4, 'Coursework3', 'Meeting at 12am', '2014-03-06', 'nd307', 'CD409', 2),
(8, 'Coursework4', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(9, 'Coursework5', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(10, 'Coursework6', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(11, 'Coursework7', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(12, 'Coursework8', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(13, 'Coursework9', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(14, 'Coursework10', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(15, 'Coursework11', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(16, 'Coursework12', 'Meeting at 12am', '2014-01-16', 'nd307', 'CD409', 2),
(17, 'Coursework13', 'Meeting at 12am', '2014-01-25', 'nd307', 'CD409', 2),
(18, 'Coursework14', 'Meeting at 12am', '2014-02-01', 'nd307', 'CD409', 2),
(19, 'Coursework15', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(20, 'Coursework16', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(21, 'Coursework17', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(22, 'Coursework18', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(23, 'Coursework19', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(24, 'Coursework20', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(25, 'Coursework21', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(26, 'Coursework22', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(27, 'Coursework23', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(28, 'Coursework24', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(29, 'Coursework25', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(30, 'Coursework26', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(31, 'Coursework27', 'Meeting at 12am', '2014-03-04', 'nd307', 'CD409', 2),
(32, 'Blog', 'Testing blog', '2014-02-03', 'nd307', 'CD409', 1),
(34, 'Design Prototype', 'Testing prototype', '2014-03-20', 'nd307', 'CD409', 3),
(35, 'Design Prototype1', 'Testing prototype1', '2014-03-22', 'nd307', 'CD409', 3),
(36, 'Design Prototype1', 'Testing prototype1', '2014-03-21', 'nd307', 'CD409', 3),
(37, 'Test Plan', 'Testing plan', '2014-03-19', 'nd307', 'CD409', 4),
(38, 'Test Plan1', 'Testing plan1', '2014-03-19', 'nd307', 'CD409', 4),
(39, 'Test Plan2', 'Testing plan2', '2014-03-19', 'nd307', 'CD409', 4),
(40, 'Test Plan3', 'Testing plan3', '2014-03-19', 'nd307', 'CD409', 4),
(41, 'Test Plan4', 'Testing plan4', '2014-03-19', 'nd307', 'CD409', 4),
(42, 'Test Plan5', 'Testing plan5', '2014-03-19', 'nd307', 'CD409', 4),
(43, 'Test Plan6', 'Testing plan6', '2014-03-19', 'nd307', 'CD409', 4),
(44, 'Project Progress1', 'Testing', '2014-03-09', 'nd307', 'CD409', 2),
(45, 'Project Testing', 'Meeting 3pm - 15th March', '2014-03-09', 'nd307', 'CD409', 2),
(46, 'Framework', 'Testing Framework', '2014-03-09', 'nd307', 'CD409', 3),
(47, 'Blog Testing', 'Today is 09.03.2014', '2014-03-09', 'nd307', 'CD409', 1),
(48, 'Coursework2', 'Testing Reply', '2014-03-10', 'nd307', 'CD409', 4),
(50, 'Presentation', 'KingWilliam 015', '2014-03-11', 'zarnihtay77', 'CD409', 4),
(51, 'Presentation', 'KingWilliam 015', '2014-03-11', 'km070', 'CD409', 4),
(52, 'Presentation', 'KingWilliam 015', '2014-03-11', 'gillian0916', 'CD409', 4),
(53, 'Presentation', 'KingWilliam 015', '2014-03-11', 'ms272', 'CD409', 4),
(54, 'Presentation', 'KingWilliam 015', '2014-03-11', 'nd307', 'CD409', 4),
(55, 'Presentation', 'KingWilliam 015', '2014-03-11', 'gl319', 'CD409', 4),
(56, 'Project Meeting', 'Testing blog', '2014-03-02', 'nd307', 'CD409', 1),
(57, 'hello', 'test', '2014-03-11', 'gillian0916', 'CD409', 4),
(58, 'Testing Blog 123', 'Blog123', '2014-03-01', 'nd307', 'CD409', 1),
(59, 'Presentation', 'Testing Presentation', '2014-03-11', 'nd307', 'CD409', 2),
(60, 'Today is 11.03.2014', 'Testing', '2014-03-11', 'gl319', 'CD409', 4),
(61, 'Today is 11.03.2014', 'Testing', '2014-03-11', 'gillian0916', 'CD409', 4),
(62, 'Test Mail', 'Test Mail', '2014-03-11', 'nd307', 'CD409', 2),
(63, 'Web Enterprise', 'Demostration today', '2014-03-11', 'nd307', 'CD409', 1),
(64, 'Testing today', 'Very good', '2014-03-13', 'nd307', 'CD409', 1),
(65, 'Yolo', 'Very good', '2014-03-13', 'nd307', 'CD409', 1),
(66, 'Yow', 'Yow', '2014-03-13', 'nd307', 'CD409', 4),
(67, 'Today is good', 'very good', '2014-03-13', 'nd307', 'CD409', 1),
(68, 'Test', '123', '2014-03-18', 'ms272', 'CD409', 4),
(69, 'Test', '123', '2014-03-18', 'zarnihtay77', 'CD409', 4),
(70, 'Test', '123', '2014-03-18', 'nd307', 'CD409', 4),
(71, 'Test 30 March', 'Blog now', '2014-03-30', 'nd307', 'RS366', 1),
(72, '', 'Detail information of location and time', '2014-03-30', 'nd307', 'RS366', 2),
(73, 'Abc', 'Abc', '2014-03-30', 'nd307', 'RS366', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cms_message_type`
--

CREATE TABLE IF NOT EXISTS `cms_message_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms_message_type`
--

INSERT INTO `cms_message_type` (`type_id`, `name`, `description`) VALUES
(1, 'blog', 'Blog'),
(2, 'meeting', 'Meeting Request'),
(3, 'message_to_tutor', 'Message to tutor'),
(4, 'message_from_tutor', 'Message from tutor');

-- --------------------------------------------------------

--
-- Table structure for table `cms_role`
--

CREATE TABLE IF NOT EXISTS `cms_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_role`
--

INSERT INTO `cms_role` (`role_id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'tutor', 'Tutor'),
(3, 'student', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `cms_student`
--

CREATE TABLE IF NOT EXISTS `cms_student` (
  `student_id` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` text,
  `address` text,
  `imageUrl` text,
  `isHomeStudent` text,
  `Course` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `tutor_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_student`
--

INSERT INTO `cms_student` (`student_id`, `username`, `password`, `firstname`, `surname`, `dob`, `email`, `address`, `imageUrl`, `isHomeStudent`, `Course`, `role_id`, `tutor_id`) VALUES
('gillian0916', 'gillian0916', 'admin123', 'Yang', 'Yang', '1990-02-17', 'gillian0916@gmail.com', NULL, NULL, 'false', 'BSc Digital Media Technology', 3, 'RS366'),
('gl319', 'gl319', 'admin123', 'Lesley', NULL, '1988-03-14', 'gl319@gre.ac.uk', NULL, NULL, 'true', 'BSc Computing', 3, 'MK330'),
('km070', 'km070', 'admin123', 'Matthew', NULL, '1990-07-24', 'km070@gre.ac.uk', NULL, NULL, 'false', 'BSc Computing', 3, 'RS366'),
('ms272', 'ms272', 'admin123', 'Satyajit Rai', NULL, '1991-05-22', 'ms272@gre.ac.uk', NULL, NULL, 'false', 'BSc Computer Science', 3, 'CD409'),
('nd307', 'nd307', 'admin123', 'Long', 'Nguyen', '2014-02-25', 'nd307@gre.ac.uk', '100 Low Road str', 'https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-frc3/t1/1394790_10151947190934675_336283526_n.jpg', 'false', 'BSc Computing', 3, 'RS366'),
('zarnihtay77', 'zarnihtay77', 'admin123', 'Zarni', 'Htay', '1991-09-27', 'zarnihtay77@gmail', '11 Park Row', NULL, 'false', 'BSc Computer Science', 3, 'CD409');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tutor`
--

CREATE TABLE IF NOT EXISTS `cms_tutor` (
  `tutor_id` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `position` text,
  `email` text,
  `imageUrl` text,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tutor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_tutor`
--

INSERT INTO `cms_tutor` (`tutor_id`, `username`, `password`, `firstname`, `surname`, `position`, `email`, `imageUrl`, `role_id`) VALUES
('CD409', 'CD409', 'admin123', 'Christine', 'Du Toit', 'Senior Lecturer', 'c.dutoit@gre.ac.uk', 'cd0364h.jpg', 2),
('EM309', 'EM309', 'admin123', 'Elaine', 'Major', 'Principal Lecturer', 'e.f.major@gre.ac.uk', 'me05.jpg', 2),
('KJ362', 'KJ362', 'admin123', 'Keeran', 'Jamil', 'Senior Lecturer', 'k.jamil@gre.ac.uk', 'jk26.jpg', 2),
('KM413', 'KM413', 'admin123', 'Kevin', 'McManus', 'Senior Lecturer', 'k.mcmanus@gre.ac.uk', 'mk05.jpg', 2),
('MK330', 'MK330', 'admin123', 'Mary', 'Kiernan', 'Principal Lecturer', 'm.kiernan@gre.ac.uk', 'km42.jpg', 2),
('PC336', 'PC336', 'admin123', 'Phil', 'Clipsham', 'Principal Lecturer', 'p.s.clipsham@gre.ac.uk', 'cp08.jpg', 2),
('RS366', 'RS366', 'admin123', 'Ray', 'Stoneham', 'Principal Lecturer', 'r.j.stoneham@gre.ac.uk	', 'sr65.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cms_upload`
--

CREATE TABLE IF NOT EXISTS `cms_upload` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) DEFAULT NULL,
  `file_path` text,
  `student_id` varchar(100) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `comment` text,
  `comment_by` varchar(100) DEFAULT NULL,
  `comment_date` date DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `cms_upload`
--

INSERT INTO `cms_upload` (`file_id`, `file_name`, `file_path`, `student_id`, `upload_date`, `comment`, `comment_by`, `comment_date`) VALUES
(1, 'Comp1649-Coursework-Jan2014', '/uploads/Comp1649-Coursework-Jan2014.pdf', 'nd307', '2014-03-19', 'Very Good', 'CD409', '2014-03-19'),
(2, 'Example from a course with different Learning Outocmes', '/uploads/Example from a course with different Learning Outocmes.pdf', 'nd307', '2014-03-19', NULL, 'CD409', NULL),
(3, 'Example1', '/uploads/Example1.pdf', 'nd307', '2014-03-19', 'Failed', 'CD409', '2014-03-30'),
(4, 'Example2', '/uploads/Example2.pdf', 'nd307', '2014-03-19', NULL, 'CD409', NULL),
(5, 'LongNguyen_nd307_Coursework_Final', '/uploads/LongNguyen_nd307_Coursework_Final.pdf', 'nd307', '2014-03-19', NULL, 'CD409', NULL),
(6, 'University-of-Greenwich-Portal-Calendar-staff-and-students', '/uploads/University-of-Greenwich-Portal-Calendar-staff-and-students.pdf', 'nd307', '2014-03-19', NULL, 'CD409', NULL),
(7, 'D6546-11-International_fees_web', '/uploads/D6546-11-International_fees_web.pdf', 'nd307', '2014-03-19', NULL, 'CD409', NULL),
(8, 'EstimateBurndownPage', '/uploads/EstimateBurndownPage.pdf', 'nd307', '2014-03-30', 'Good Job', 'CD409', '2014-03-30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
