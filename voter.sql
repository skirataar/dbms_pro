-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2024 at 08:54 AM
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
-- Database: `voter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Candidates`
--

CREATE TABLE `Candidates` (
  `CandidateName` varchar(30) NOT NULL,
  `PartyID` varchar(3) NOT NULL,
  `ConsName` varchar(3) NOT NULL,
  `VoteCount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Candidates`
--

INSERT INTO `Candidates` (`CandidateName`, `PartyID`, `ConsName`, `VoteCount`) VALUES
('Ramalinga Reddy', 'INC', 'BTM', 1),
('Sowmya R', 'INC', 'JAY', 0),
('M Krishnamppa', 'INC', 'VIJ', 0),
('Kusuma H', 'INC', 'RRN', 0),
('U B Venkatesh', 'INC', 'BVG', 0),
('B N Vijay Kumar', 'BJP', 'JAY', 0),
('K N Subbareddy', 'BJP', 'BVG', 2),
('Munirathna Naidu', 'BJP', 'RRN', 0),
('H Raveendra', 'BJP', 'VIJ', 0),
('Sridhar Reddy', 'BJP', 'BTM', 0),
('Anantha Subash Chandra', 'AAP', 'RRN', 0),
('Dr Ramesh Bellamkonda', 'AAP', 'VIJ', 0),
('Sathyalakshmi Rao', 'AAP', 'BVG', 0),
('Srinivas Reddy', 'AAP', 'BTM', 0),
('Mahalakshmi', 'AAP', 'JAY', 0),
('Dr Narayanswamy', 'JDS', 'RRN', 0),
('Aramane Shankar', 'JDS', 'BVG', 0),
('Venkatesh', 'JDS', 'BTM', 0),
('Kalegowda', 'JDS', 'JAY', 0),
('Mohammed Musthafa', 'JDS', 'VIJ', 0),
('N Nagaraju', 'BSP', 'RRN', 0),
('Gulshan Banu', 'BSP', 'VIJ', 0),
('Thyagaraj', 'BSP', 'BTM', 0),
('R Selvakumar', 'BSP', 'JAY', 0),
('Narasimha Murthy', 'BSP', 'BVG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Constituency`
--

CREATE TABLE `Constituency` (
  `ConsName` varchar(3) NOT NULL,
  `WinParty` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Constituency`
--

INSERT INTO `Constituency` (`ConsName`, `WinParty`) VALUES
('BTM', ''),
('BVG', ''),
('JAY', ''),
('RRN', ''),
('VIJ', '');

-- --------------------------------------------------------

--
-- Table structure for table `Parties`
--

CREATE TABLE `Parties` (
  `PartyName` varchar(30) NOT NULL,
  `PartyID` varchar(3) NOT NULL,
  `PresidentName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Parties`
--

INSERT INTO `Parties` (`PartyName`, `PartyID`, `PresidentName`) VALUES
('Aam Aadmi Party', 'AAP', 'Arvind Kejriwal'),
('Bharatiya Janata Party', 'BJP', 'J P Nadda'),
('Bahujan Samaj Party', 'BSP', 'Mayawati'),
('Indian National Congress', 'INC', 'Mallikarjun Kharge'),
('Janata Dal (Secular)', 'JDS', 'H D Deve Gowda');

-- --------------------------------------------------------

--
-- Table structure for table `Results`
--

CREATE TABLE `Results` (
  `WinParty` varchar(30) NOT NULL,
  `WinCand` varchar(30) NOT NULL,
  `ConsName` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Voter`
--

CREATE TABLE `Voter` (
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `ConsName` varchar(3) NOT NULL,
  `VoterID` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `DidVote` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Voter`
--

INSERT INTO `Voter` (`FirstName`, `LastName`, `Address`, `DOB`, `ConsName`, `VoterID`, `Password`, `DidVote`) VALUES
('Aneesh', 'Gunari', '117', '2002-05-16', 'BVG', 'VGF7070404', 'Aneesh@123', 0),
('Chinmayi', 'U', '119', '2002-10-20', 'RRN', 'VKN6834995', 'Chinmin@123', 0),
('Ritheesh', 'RM', '1216', '2003-06-18', 'JAY', 'VOM1586677', 'Ritheesh@123', 0),
('Aditya', 'Shetty', '118', '2003-01-20', 'VIJ', 'VSV9455681', 'Aditya@123', 0),
('Ankith', 'GB', '117', '2003-04-05', 'BVG', 'VTE6705446', 'Ankith@55', 1),
('Divyesh', 'Reddy', '121', '2002-09-11', 'BTM', 'VUI6444456', 'Divyesh@123', 1),
('Anirudh', 'KN', '122', '2003-10-30', 'VIJ', 'VVR6708049', 'Anirush@123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Candidates`
--
ALTER TABLE `Candidates`
  ADD KEY `fk2` (`ConsName`),
  ADD KEY `fk3` (`PartyID`);

--
-- Indexes for table `Constituency`
--
ALTER TABLE `Constituency`
  ADD PRIMARY KEY (`ConsName`);

--
-- Indexes for table `Parties`
--
ALTER TABLE `Parties`
  ADD PRIMARY KEY (`PartyID`);

--
-- Indexes for table `Results`
--
ALTER TABLE `Results`
  ADD KEY `fk5` (`ConsName`);

--
-- Indexes for table `Voter`
--
ALTER TABLE `Voter`
  ADD PRIMARY KEY (`VoterID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Candidates`
--
ALTER TABLE `Candidates`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`ConsName`) REFERENCES `Constituency` (`ConsName`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`PartyID`) REFERENCES `Parties` (`PartyID`);

--
-- Constraints for table `Results`
--
ALTER TABLE `Results`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`ConsName`) REFERENCES `Constituency` (`ConsName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
