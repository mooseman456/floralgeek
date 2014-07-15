-- File name: floralgeek_creation.sql
-- File author: Joe St. Angelo
-- 
-- File is to be used for the Floralgeek Sales Database

DROP DATABASE IF EXISTS floralgeek;
CREATE DATABASE floralgeek;
USE floralgeek;

--
-- Database: `floralgeek`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contactID` int(10) AUTO_INCREMENT,
  `businessName` varchar(100) DEFAULT 'N/A', 
  `businessType` varchar(2) DEFAULT 'H',
  `addressOne` varchar(50) DEFAULT 'N/A',
  `addressTwo` varchar(50) DEFAULT 'N/A',
  `city` varchar(50) DEFAULT 'N/A',
  `state` varchar(50) DEFAULT 'N/A',
  `zip` varchar(50) DEFAULT 'N/A',
  `country` varchar(50) DEFAULT 'N/A',
  `countryCode` varchar(10) DEFAULT 'N/A',
  `phone` varchar(50) DEFAULT 'N/A',
  `numLocations` int(11) DEFAULT 1,
  `numRooms` int(11) DEFAULT 0,
  `rate` float DEFAULT 0.0,
  `GDS` varchar(50) DEFAULT 'N/A',
  `mngtCo` varchar(50) DEFAULT 'N/A',
  `PMS` varchar(50) DEFAULT 'N/A',
  `contactPerson` varchar(50) DEFAULT 'N/A',
  `personTitle` varchar(50) DEFAULT 'N/A',
  `personPhone` varchar(50) DEFAULT 'N/A',
  `personEmail` varchar(50) DEFAULT 'N/A',
  `SPAssigned` varchar(3) DEFAULT 'N/A',
  `interestLvl` int(1) DEFAULT 0,
  `dateOfNext` varchar(50) DEFAULT 'N/A',
  `dateOfLast` varchar(50) DEFAULT 'N/A',
  INDEX(`businessName`),
  INDEX(`businessType`),
  INDEX(`city`),
  INDEX(`state`),
  INDEX(`addressTwo`),
  INDEX(`numRooms`),
  INDEX(`rate`),
  INDEX(`GDS`),
  INDEX(`mngtCo`),
  INDEX(`interestLvl`),
  PRIMARY KEY (`contactID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
  `conversationID` int(10) AUTO_INCREMENT,
  `contactID` int(10) NOT NULL,
  `date` varchar(50) NOT NULL,
  `SP` varchar(3) NOT NULL,
  `followUp` varchar(50) NOT NULL,
  `interestLvl` int(1) DEFAULT 0,
  `conversation` text NOT NULL,
  INDEX(`date`),
  PRIMARY KEY(`conversationID`),
  FOREIGN KEY (`contactID`) REFERENCES contacts(contactID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
