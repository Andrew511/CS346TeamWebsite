-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2017 at 10:05 PM
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
  `Correct` tinyint(1) NOT NULL,
  `ShortAnswer` varchar(25) DEFAULT NULL,
  `NumberCorrect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Answers`
--

INSERT INTO `Answers` (`QuestionId`, `AnswerText`, `Correct`, `ShortAnswer`, `NumberCorrect`) VALUES
(1, 'True', 0, NULL, 1),
(1, 'False', 1, NULL, 1),
(5, '', 0, '0', 0),
(5, '', 0, 'zero', 0),
(6, '$_GET', 1, NULL, 4),
(6, '$_SERVER', 1, NULL, 4),
(6, '$_PUT', 0, NULL, 4),
(6, '$_DOC', 0, NULL, 4),
(6, '$_SESSION', 1, NULL, 4),
(6, '$_REQUIRED', 0, NULL, 4),
(6, '$_COOKIE', 1, NULL, 4),
(7, '', 0, 'breadcrumbs', 0),
(2, 'True', 1, NULL, 1),
(2, 'False', 0, NULL, 1),
(4, '''visibility: hidden'' still uses space on the page, while ''display: none'' does not use space on the page.', 1, NULL, 1),
(4, '''display: none'' still uses space on the page, while ''visibility: hidden'' does not use space on the page.', 0, NULL, 1),
(4, 'Both ''visibility: hidden'' and ''display: none'' have the same functionality.', 0, NULL, 1),
(8, 'GET', 1, NULL, 4),
(8, 'POST', 1, NULL, 4),
(8, 'PUT', 1, NULL, 4),
(8, 'HEAD', 1, NULL, 4),
(3, 'Verdana', 0, NULL, 4),
(3, 'cursive', 1, NULL, 4),
(3, 'Times New Roman', 0, NULL, 4),
(3, 'sans-serif', 0, NULL, 4);

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
  `Salt` varchar(255) NOT NULL,
  `PasswordChanges` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `LastLogout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Instructors`
--

INSERT INTO `Instructors` (`InstructorId`, `Username`, `FirstName`, `LastName`, `Email`, `HashPassword`, `Salt`, `PasswordChanges`, `LastLogin`, `LastLogout`) VALUES
(138455, 'lackn', 'Netalia', 'Lackless', 'lackn@uwosh.edu', '4k69IpfZIEiZ2', '4kin0M', 3, '2017-12-10 14:54:27', '2017-12-10 14:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `Keywords`
--

CREATE TABLE IF NOT EXISTS `Keywords` (
  `QuestionId` int(11) NOT NULL,
  `Keyword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Keywords`
--

INSERT INTO `Keywords` (`QuestionId`, `Keyword`) VALUES
(1, 'HTTP'),
(5, 'PHP'),
(5, 'falsy values'),
(5, 'boolean'),
(6, 'PHP'),
(6, 'superglobal'),
(7, 'design'),
(7, 'navigation'),
(7, 'links'),
(8, 'HTTP'),
(4, 'CSS'),
(2, 'CSS'),
(3, 'CSS'),
(3, '    pseudo-selector'),
(3, '    font-declaration');

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE IF NOT EXISTS `Questions` (
  `QuestionId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `QuestionType` varchar(255) NOT NULL,
  `QuestionText` text NOT NULL,
  `PointsAvailable` float NOT NULL,
  `Section` varchar(255) NOT NULL,
  `ActivationStart` datetime DEFAULT NULL,
  `ActivationEnd` datetime DEFAULT NULL,
  `ClassAverage` float DEFAULT NULL,
  `CorrectSubmissions` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`QuestionId`, `Status`, `QuestionType`, `QuestionText`, `PointsAvailable`, `Section`, `ActivationStart`, `ActivationEnd`, `ClassAverage`, `CorrectSubmissions`, `Description`) VALUES
(1, 4, 'multiple', 'The HTTP command PUT sends form information to the server.', 2, '1.2.3', '2017-12-10 03:57:05', '2017-12-10 03:57:14', 2, 1, 'The set of commands a computer can send to a server'),
(2, 4, 'multiple', 'True or False: an inline element must be nested inside a block element?', 2, '2.1.4', '2017-12-10 03:42:08', '2017-12-10 03:42:13', 0, 1, 'Inline and Block element syntax.'),
(3, 4, 'multiple', '			  Given the index.html and styles.css files below, what font type will the word "The Hundred Thousand Kingdoms" be? <pre><code>\n        <!DOCTYPE html>\n        <html>\n          <head>\n            <meta charset="utf-8">\n            <title>My Books </title>\n            <link rel="stylesheet" href="styles.css" />\n          </head>\n\n          <body>\n            <ul>\n              <li>"Name of the Wind"</li>\n              <li>"The Fifth Season"</li>\n              <li>"To Kill a Mocking Bird"</li>\n              <li>"Before the Fall"</li>\n              <li>"The Fireman"</li>\n              <li>"The Hundred Thousand Kingdoms"</li>\n            </ul>\n          </body>\n        </html>\n        <br/>\n        body {\n          background-color: white;\n          font-family: "Arial", monospace;\n        }\n\n        ul {\n          font-size: 14pt;\n          font-family: "Verdana", sans-serif;\n        }\n\n        li:last-child {\n          font-family: Times New Roman;\n        }\n\n        li:nth-child(2n+2) {\n          font-family: cursive;\n        }\n      </code></pre>			  ', 2, '3.2.1', '2017-12-10 03:42:17', '2017-12-10 03:42:23', 0, 0, 'Font-declaration and pseudo-selectors'),
(4, 4, 'multiple', 'What is the difference between the CSS attributes ''display: none'' and ''visibility: hidden'' ?', 2, '4.4.4', '2017-12-10 03:42:27', '2017-12-10 03:42:33', NULL, 0, 'Difference between the CSS attributes display and visibility. '),
(5, 4, 'short', '<p>Given the index.php file below, how many times will the the statement\n        "count++" in the loop execute?\n</p>\n<pre><code>\n  &lt;!DOCTYPE html&gt;\n  &lt;html&gt;\n  &lt;head&gt;\n  &lt;meta charset=&quot;utf-8&quot;&gt;\n            &lt;title&gt;PHP&lt;/title&gt;\n  &lt;/head&gt;\n  &lt;body&gt;\n  &lt;?php\n    $a = "0";\n    $x = $a;\n    $count = 0;\n\n    while($x){\n      $count++;\n    }\n    ?&gt;\n    &lt;/body&gt;\n    &lt;/html&gt;\n</code></pre>', 3, '5.2.6', '2017-12-10 03:42:38', '2017-12-10 03:42:45', NULL, 1, 'PHP falsy values'),
(6, 4, 'checkbox', 'Select all the valid PHP superglobal array variables. Leave all invalid options unchecked.', 5, '6.4.1', '2017-12-10 03:42:48', '2017-12-10 03:42:57', NULL, 1, 'PHP superglobal array variables'),
(7, 4, 'short', 'Fill in the blank <strong>(Do not include quotation marks!)</strong>: __________ show a clickable path from the top level of the web site hierarchy to the current page and can add unobtrusive usability to your site but are not usually a form of main navigation.', 3, '7.2.3', '2017-12-10 03:43:02', '2017-12-10 03:43:18', NULL, 0, 'Navigation and links'),
(8, 4, 'checkbox', '<p >Select all HTTP commands: </p>\r\n	', 2, '1.2.3', '2017-12-10 03:43:28', '2017-12-10 03:43:37', 0, 0, 'HTTP commands');

-- --------------------------------------------------------

--
-- Table structure for table `Scores`
--

CREATE TABLE IF NOT EXISTS `Scores` (
  `QuestionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Score` float(11,2) NOT NULL,
  `StudentAnswer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Scores`
--

INSERT INTO `Scores` (`QuestionId`, `UserId`, `Score`, `StudentAnswer`) VALUES
(1, 565813, 2.00, 'False'),
(2, 565813, 2.00, 'True'),
(3, 565813, 1.00, 'Times New Roman'),
(4, 565813, 1.00, '''display: none'' still uses space on the page, while ''visibility: hidden'' does not use space on the page.'),
(5, 565813, 3.00, '0'),
(6, 565813, 5.00, '$_GET|$_SERVER|$_SESSION|$_COOKIE|'),
(7, 565813, 1.00, 'breadscrumbs'),
(8, 565813, 1.75, 'GET|POST|PUT|');

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
  `Username` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `HashPassword` varchar(64) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `PasswordChanges` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `LastLogout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`StudentId`, `Username`, `FirstName`, `LastName`, `Email`, `HashPassword`, `Salt`, `PasswordChanges`, `LastLogin`, `LastLogout`) VALUES
(489792, 'ruhk92', 'Kvothe', 'Ruh', 'ruhk92@uwosh.edu', '1uxUpUyOo5MQk', '1urY', 4, '2017-12-10 14:28:18', '2017-12-10 14:54:07'),
(565813, 'alvel13', 'Lerand', 'Alveron', 'alverl13@uwosh.edu', 'ik3ZdvCwuitHw', 'iku57aN', 7, '2017-12-10 15:56:49', '2017-12-10 15:57:21');

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
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `StatusId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
  ADD CONSTRAINT `Questions_Score_Relation` FOREIGN KEY (`QuestionId`) REFERENCES `Questions` (`QuestionId`),
  ADD CONSTRAINT `Students_Score_Relation` FOREIGN KEY (`UserId`) REFERENCES `Students` (`StudentId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
