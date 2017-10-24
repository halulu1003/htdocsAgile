-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2017 at 04:48 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yx`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(10) NOT NULL DEFAULT '0',
  `book_name` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`) VALUES
(11, 'c sharp 1'),
(12, 'c sharp 2'),
(71, 'agile book 1'),
(72, 'agile book2');

-- --------------------------------------------------------

--
-- Table structure for table `books0923`
--

CREATE TABLE `books0923` (
  `book_id` int(10) NOT NULL,
  `book_name` varchar(4000) NOT NULL DEFAULT '',
  `author_name` varchar(100) NOT NULL DEFAULT '',
  `yeartime` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books0923`
--

INSERT INTO `books0923` (`book_id`, `book_name`, `author_name`, `yeartime`) VALUES
(1, 'hh', 'kk', 'bx'),
(2, 'Modern Database Management (Tenth Edition)', 'Jeffrey A. Hoffer&V.Ramesh&Heikki Topi', '2011'),
(3, 'An Introduction to Database Systems', 'C.J. Date', '2004'),
(4, 'Beginning Oracle SQL For Oracle Database 12c', 'Tim Gorman& Inger Jorgensen& Melanie Caffrey', '2014'),
(5, 'Relational database design and implementation', 'Jan L. Harrington', '2016'),
(6, 'Database design application development and administration', 'Michael V Mannino', '2004'),
(7, 'Database systems : design implementation and management.', 'Carlos Coronel&Steven Morris ', '2015'),
(8, 'Database systems : a practical approach to design  implementation  and management', 'Thomas M. Connolly& Carolyn E. Beg', '2015'),
(9, 'Learning Data Mining with R', 'Bater Makhabel', '2015'),
(10, 'Social Big Data Mining', 'Hiroshi Ishikawa', '2015'),
(11, 'Data Mining for Business Applications', 'C Soares& R Ghani', '2010'),
(12, 'Proactive data mining with decision trees', 'Haim Dahan& Shahar Cohen& Lior Rokach& Oded Maimon', '2014'),
(13, 'RapidMiner Data Mining Use Cases and Business Analytics Applications', 'Markus Hofmann& Ralf Klinkenberg', '2013'),
(14, 'Data Mining In Time Series Databases', 'Mark Last& Abraham Kandel& Horst Bunke', '2004'),
(15, 'bookName', 'author', 'year'),
(16, 'Panel on design methodology', 'Smith Reid ', '1987'),
(17, 'Design Patterns in Dynamic Languages', 'Norvig Peter', '1998'),
(18, 'Design patterns : elements of reusable object-oriented software', 'Erich Gamma', '1995'),
(19, 'Head First Design Patterns', 'Freeman Eric', '2004'),
(20, 'Beginning C# game programming', 'Ron Penton', '2005');

-- --------------------------------------------------------

--
-- Table structure for table `cfield_execution_values`
--

CREATE TABLE `cfield_execution_values` (
  `field_id` int(10) NOT NULL DEFAULT '0',
  `execution_id` int(10) NOT NULL DEFAULT '0',
  `testplan_id` int(10) NOT NULL DEFAULT '0',
  `tcversion_id` int(10) NOT NULL DEFAULT '0',
  `value` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cfield_execution_values`
--

INSERT INTO `cfield_execution_values` (`field_id`, `execution_id`, `testplan_id`, `tcversion_id`, `value`) VALUES
(10, 1, 1, 1, 'qwreqwer');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(10) NOT NULL DEFAULT '0',
  `course_name` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`) VALUES
(1, 'C sharp'),
(3, 'Database Design & Development'),
(4, 'Data Mining'),
(7, 'agile');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`number`, `name`, `birthday`) VALUES
(34, '\0', '2017-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `person_courses`
--

CREATE TABLE `person_courses` (
  `person_id` int(10) NOT NULL DEFAULT '0',
  `course_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_courses`
--

INSERT INTO `person_courses` (`person_id`, `course_id`) VALUES
(1, 1),
(6, 7),
(8, 1),
(8, 7),
(15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recommend_courses_books`
--

CREATE TABLE `recommend_courses_books` (
  `person_id` int(10) NOT NULL DEFAULT '0',
  `course_id` int(10) NOT NULL DEFAULT '0',
  `book_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recommend_courses_books`
--

INSERT INTO `recommend_courses_books` (`person_id`, `course_id`, `book_id`) VALUES
(1, 1, 4),
(1, 1, 18),
(1, 1, 19),
(1, 1, 72),
(1, 3, 2),
(1, 3, 3),
(1, 7, 71),
(8, 7, 12),
(8, 7, 72);

-- --------------------------------------------------------

--
-- Table structure for table `student_books_notes`
--

CREATE TABLE `student_books_notes` (
  `note_id` int(10) NOT NULL,
  `person_id` int(10) NOT NULL DEFAULT '0',
  `book_id` int(10) NOT NULL DEFAULT '0',
  `value` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_books_notes`
--

INSERT INTO `student_books_notes` (`note_id`, `person_id`, `book_id`, `value`) VALUES
(23, 8, 71, 'page 18-19, really helpful'),
(24, 8, 71, 'page 20, section B , has to be discussed with lecturer'),
(25, 8, 71, 'page 50, can go with some examples'),
(26, 8, 71, 'this is my note welcome adding notes\r\n'),
(30, 8, 4, 'welcome adding notes\r\nnothing to say'),
(32, 8, 16, 'factory mode\r\n'),
(33, 15, 18, 'mvc'),
(34, 15, 18, 'controller highlight\r\n'),
(35, 15, 19, '\r\nctl'),
(36, 15, 19, 'why\r\n'),
(37, 15, 18, 'welcome adding notes 1147\r\n'),
(38, 15, 18, 'WELCOME ADDING NOTES 1148 '),
(39, 15, 19, 'lower case'),
(40, 15, 1, 'better'),
(41, 15, 1, 'worse');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses_books`
--

CREATE TABLE `student_courses_books` (
  `person_id` int(10) NOT NULL DEFAULT '0',
  `course_id` int(10) NOT NULL DEFAULT '0',
  `book_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_courses_books`
--

INSERT INTO `student_courses_books` (`person_id`, `course_id`, `book_id`) VALUES
(8, 1, 4),
(8, 1, 16),
(8, 1, 17),
(8, 7, 71),
(8, 7, 72),
(15, 1, 1),
(15, 1, 18),
(15, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(8) NOT NULL,
  `passcode` char(8) NOT NULL,
  `userflag` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `passcode`, `userflag`, `ID`) VALUES
('admin', '0', 0, 0),
('ben', '2', 2, 15),
('sam', '1', 1, 1),
('steven', '1', 1, 6),
('yx', '2', 2, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `books0923`
--
ALTER TABLE `books0923`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `cfield_execution_values`
--
ALTER TABLE `cfield_execution_values`
  ADD PRIMARY KEY (`field_id`,`execution_id`,`testplan_id`,`tcversion_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `person_courses`
--
ALTER TABLE `person_courses`
  ADD PRIMARY KEY (`person_id`,`course_id`);

--
-- Indexes for table `recommend_courses_books`
--
ALTER TABLE `recommend_courses_books`
  ADD PRIMARY KEY (`person_id`,`course_id`,`book_id`);

--
-- Indexes for table `student_books_notes`
--
ALTER TABLE `student_books_notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `student_courses_books`
--
ALTER TABLE `student_courses_books`
  ADD PRIMARY KEY (`person_id`,`course_id`,`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books0923`
--
ALTER TABLE `books0923`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `student_books_notes`
--
ALTER TABLE `student_books_notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
