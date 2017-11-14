-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2017 at 09:20 PM
-- Server version: 5.5.50-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team6`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answers`
--

CREATE TABLE IF NOT EXISTS `Answers` (
  `QuestionId` int(11) NOT NULL,
  `AnswerText` text NOT NULL,
  `Correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Instructors`
--

CREATE TABLE IF NOT EXISTS `Instructors` (
  `InstructorId` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `HashPassword` varchar(64) NOT NULL,
  `PasswordChanges` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `LastLogout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Keywords`
--

CREATE TABLE IF NOT EXISTS `Keywords` (
  `QuestionId` int(11) NOT NULL,
  `Keyword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE IF NOT EXISTS `Questions` (
  `QuestionId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `QuestionType` varchar(255) NOT NULL,
  `QuestionText` text NOT NULL,
  `PointsAvailable` int(11) NOT NULL,
  `Section` int(11) NOT NULL,
  `ActivationStart` datetime NOT NULL,
  `ActivationEnd` datetime NOT NULL,
  `ClassAverage` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Scores`
--

CREATE TABLE IF NOT EXISTS `Scores` (
  `QuestionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE IF NOT EXISTS `Status` (
  `StatusId` int(11) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Status`
--

INSERT INTO `Status` (`StatusId`, `StatusName`) VALUES
(1, 'Draft'),
(2, 'NeverActivated'),
(3, 'Active'),
(4, 'Deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `StudentId` int(11) NOT NULL,
  `Username` varchar(50) CHARACTER SET ascii NOT NULL,
  `FirstName` varchar(50) CHARACTER SET ascii NOT NULL,
  `LastName` varchar(50) CHARACTER SET ascii NOT NULL,
  `Email` varchar(50) CHARACTER SET ascii NOT NULL,
  `HashPassword` varchar(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `PasswordChanges` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `LastLogout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answers`
--
ALTER TABLE `Answers`
  ADD KEY `QuestionId` (`QuestionId`);

--
-- Indexes for table `Instructors`
--
ALTER TABLE `Instructors`
  ADD PRIMARY KEY (`InstructorId`);

--
-- Indexes for table `Keywords`
--
ALTER TABLE `Keywords`
  ADD KEY `QuestionId` (`QuestionId`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`QuestionId`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Status_2` (`Status`);

--
-- Indexes for table `Scores`
--
ALTER TABLE `Scores`
  ADD KEY `QuestionId` (`QuestionId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`StatusId`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Instructors`
--
ALTER TABLE `Instructors`
  MODIFY `InstructorId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `QuestionId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `StatusId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Students`
--
ALTER TABLE `Students`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answers`
--
ALTER TABLE `Answers`
  ADD CONSTRAINT `Questions_Answers_Relation` FOREIGN KEY (`QuestionId`) REFERENCES `Questions` (`QuestionId`);

--
-- Constraints for table `Keywords`
--
ALTER TABLE `Keywords`
  ADD CONSTRAINT `Questions_Keywords_Relation` FOREIGN KEY (`QuestionId`) REFERENCES `Questions` (`QuestionId`);

--
-- Constraints for table `Questions`
--
ALTER TABLE `Questions`
  ADD CONSTRAINT `Status_Questions_Relation` FOREIGN KEY (`Status`) REFERENCES `Status` (`StatusId`);

--
-- Constraints for table `Scores`
--
ALTER TABLE `Scores`
  ADD CONSTRAINT `Students_Score_Relation` FOREIGN KEY (`UserId`) REFERENCES `Students` (`StudentId`),
  ADD CONSTRAINT `Questions_Score_Relation` FOREIGN KEY (`QuestionId`) REFERENCES `Questions` (`QuestionId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
