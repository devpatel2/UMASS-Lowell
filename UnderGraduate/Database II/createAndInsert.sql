--
-- Database: `database_phase_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `SID` int(7) NOT NULL,
  `CID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`SID`, `CID`) VALUES
(1010101, 914040),
(1010103, 911020),
(1010103, 914040),
(1010105, 911020),
(1010108, 914040),
(1010109, 911020),
(1010109, 914040);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CID` int(6) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `credits` int(1) DEFAULT NULL,
  `groupID` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CID`, `name`, `credits`, `groupID`) VALUES
(911020, 'Computing II', 3, 0),
(913080, 'Operating Systems I', 3, 0),
(914040, 'Analysis of Algorithms', 3, 0),
(915000, 'Fundamentals of Computer Scien', 3, 1),
(915030, 'Algorithms', 3, 1),
(915130, 'Internet & Web Systems I', 3, 4),
(915140, 'Internet & Web Systems II', 3, 4),
(915150, 'Operating Systems I', 3, 2),
(915160, 'Operating Systems II', 3, 2),
(915300, 'Special Topics', 3, 3),
(915440, 'Data Mining', 3, 3),
(915450, 'Machine Learning', 3, 3),
(915460, 'Computer Graphics I', 3, 3),
(915470, 'Computer Graphics II', 3, 3),
(915610, 'Computer & Network Security I', 3, 2),
(915630, 'Data Communications I', 3, 2),
(915640, 'Data Communications II', 3, 2),
(915730, 'Data Base I', 3, 4),
(915740, 'Data Base II', 3, 4),
(915800, 'Topics in Computer Science', 3, 4),
(916730, 'Advanced Database Systems', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `SID` int(7) NOT NULL,
  `CID` int(6) NOT NULL,
  `SecID` int(3) NOT NULL,
  `yearID` int(4) NOT NULL,
  `semesterID` varchar(1) NOT NULL,
  `grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`SID`, `CID`, `SecID`, `yearID`, `semesterID`, `grade`) VALUES
(1010101, 914040, 201, 2014, '0', 'A-'),
(1010101, 915000, 201, 2014, '0', 'B+'),
(1010101, 915030, 201, 2015, '0', 'A-'),
(1010101, 915130, 201, 2014, '0', 'B'),
(1010101, 915140, 201, 2015, '0', 'A'),
(1010101, 915150, 201, 2015, '0', 'B+'),
(1010101, 915300, 202, 2015, '0', 'B+'),
(1010101, 915450, 201, 2015, '0', 'A-'),
(1010101, 915460, 201, 2015, '0', 'B+'),
(1010101, 915470, 201, 2016, '0', 'A'),
(1010101, 915610, 201, 2016, '0', 'A-'),
(1010102, 915000, 201, 2014, '0', 'B+'),
(1010102, 915030, 201, 2014, '0', 'B-'),
(1010102, 915300, 202, 2015, '0', 'A-'),
(1010102, 915460, 201, 2015, '0', 'A'),
(1010102, 915610, 201, 2015, '0', 'B-'),
(1010102, 915630, 201, 2015, '0', 'B'),
(1010102, 915730, 201, 2015, '0', 'A-'),
(1010102, 915740, 201, 2016, '0', 'A'),
(1010102, 915800, 201, 2015, '0', 'A-'),
(1010102, 916730, 201, 2014, '0', 'B-'),
(1010103, 911020, 201, 2014, '0', 'A'),
(1010103, 914040, 201, 2014, '0', 'A'),
(1010103, 915030, 201, 2015, '0', 'B'),
(1010103, 915300, 201, 2015, '0', 'C-'),
(1010103, 915450, 201, 2015, '0', 'B+'),
(1010103, 915460, 201, 2014, '0', 'B'),
(1010103, 915610, 201, 2015, '0', 'B+'),
(1010103, 915630, 201, 2015, '0', 'B'),
(1010103, 915640, 201, 2016, '0', 'B'),
(1010103, 915730, 201, 2015, '0', 'B-'),
(1010103, 915740, 201, 2016, '0', 'B'),
(1010103, 915800, 201, 2016, '0', 'B'),
(1010104, 915030, 201, 2014, '0', 'A'),
(1010104, 915150, 201, 2015, '0', 'A-'),
(1010104, 915160, 201, 2016, '0', 'A-'),
(1010104, 915300, 201, 2015, '0', 'A'),
(1010104, 915450, 201, 2015, '0', 'A'),
(1010104, 915610, 201, 2015, '0', 'A'),
(1010104, 915630, 201, 2014, '0', 'A'),
(1010104, 915640, 201, 2015, '0', 'A'),
(1010104, 915730, 201, 2014, '0', 'A'),
(1010104, 915740, 201, 2015, '0', 'A'),
(1010105, 915000, 201, 2014, '0', 'B+'),
(1010105, 915030, 201, 2015, '0', 'A-'),
(1010105, 915130, 201, 2014, '0', 'A-'),
(1010105, 915140, 201, 2015, '0', 'A-'),
(1010105, 915150, 201, 2014, '0', 'B+'),
(1010105, 915160, 201, 2015, '0', 'A-'),
(1010105, 915460, 201, 2015, '0', 'A-'),
(1010105, 915610, 201, 2016, '0', 'A-'),
(1010105, 915740, 201, 2015, '0', 'A-'),
(1010105, 915800, 201, 2015, '0', 'B'),
(1010106, 915000, 201, 2015, '0', 'A'),
(1010106, 915030, 201, 2014, '0', 'A'),
(1010106, 915150, 201, 2014, '0', 'A'),
(1010106, 915160, 201, 2015, '0', 'A-'),
(1010106, 915450, 201, 2015, '0', 'A'),
(1010106, 915460, 201, 2015, '0', 'B+'),
(1010106, 915470, 201, 2016, '0', 'B+'),
(1010106, 915610, 201, 2015, '0', 'A-'),
(1010106, 915630, 201, 2014, '0', 'A'),
(1010106, 915640, 201, 2015, '0', 'A-'),
(1010107, 915000, 201, 2014, '0', 'B+'),
(1010107, 915030, 201, 2014, '0', 'A'),
(1010107, 915150, 201, 2014, '0', 'A'),
(1010107, 915160, 201, 2015, '0', 'A-'),
(1010107, 915300, 202, 2015, '0', 'A-'),
(1010107, 915440, 201, 2015, '0', 'B'),
(1010107, 915460, 201, 2015, '0', 'A-'),
(1010107, 915610, 201, 2015, '0', 'B+'),
(1010107, 915730, 201, 2015, '0', 'A-'),
(1010107, 915740, 201, 2016, '0', 'A-'),
(1010108, 914040, 201, 2014, '0', 'A'),
(1010108, 915000, 201, 2014, '0', 'B+'),
(1010108, 915300, 202, 2015, '0', 'A-'),
(1010108, 915460, 201, 2015, '0', 'A'),
(1010108, 915470, 201, 2016, '0', 'A-'),
(1010108, 915610, 201, 2015, '0', 'A-'),
(1010108, 915630, 201, 2015, '0', 'A-'),
(1010108, 915640, 201, 2016, '0', 'A'),
(1010108, 915730, 201, 2015, '0', 'B-'),
(1010108, 915740, 201, 2016, '0', 'B+'),
(1010109, 914040, 201, 2014, '0', 'A'),
(1010109, 915030, 201, 2015, '0', 'B'),
(1010109, 915150, 201, 2015, '0', 'B+'),
(1010109, 915300, 201, 2015, '0', 'C-'),
(1010109, 915460, 201, 2014, '0', 'B'),
(1010109, 915610, 201, 2015, '0', 'B+'),
(1010109, 915630, 201, 2015, '0', 'A'),
(1010109, 915640, 201, 2016, '0', 'B'),
(1010109, 915730, 201, 2015, '0', 'A-'),
(1010109, 915740, 201, 2016, '0', 'A'),
(1010109, 915800, 201, 2014, '0', 'A'),
(1010110, 915000, 201, 2014, '0', 'A'),
(1010110, 915030, 201, 2014, '0', 'A-'),
(1010110, 915130, 201, 2014, '0', 'A'),
(1010110, 915140, 201, 2015, '0', 'A'),
(1010110, 915150, 201, 2015, '0', 'A-'),
(1010110, 915300, 201, 2015, '0', 'A'),
(1010110, 915440, 201, 2015, '0', 'A'),
(1010110, 915460, 201, 2015, '0', 'A'),
(1010110, 915470, 201, 2016, '0', 'B'),
(1010110, 915610, 201, 2015, '0', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `IID` int(3) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `rank` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`IID`, `name`, `rank`) VALUES
(1, 'Tingjian Ge', 'Associate Professor'),
(2, 'Haim Levkowitz', 'Associate Professor'),
(3, 'William Moloney Jr', 'Associate Professor'),
(4, 'Anna Rumshisky', 'Assistant Professor'),
(5, 'Xinwen Fu', 'Associate Professor'),
(6, 'Ekaterina Saenko', 'Assistant Professor'),
(7, 'Jie Wang', 'Professor'),
(8, 'Benyuan Liu', 'Associate Professor'),
(9, 'Cindy Chen', 'Associate Professor'),
(10, 'Guanling Chen', 'Associate Professor'),
(11, 'Byung Kim', 'Associate Professor'),
(12, 'David Adams', 'Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisite`
--

CREATE TABLE `prerequisite` (
  `PCID` int(6) NOT NULL,
  `CID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prerequisite`
--

INSERT INTO `prerequisite` (`PCID`, `CID`) VALUES
(911020, 915450),
(914040, 915030),
(914040, 915610),
(915130, 915140),
(915150, 915160),
(915460, 915470),
(915630, 915640),
(915730, 915740);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `CID` int(6) NOT NULL,
  `SecID` int(3) NOT NULL,
  `IID` int(3) DEFAULT NULL,
  `yearID` int(4) NOT NULL,
  `semesterID` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`CID`, `SecID`, `IID`, `yearID`, `semesterID`) VALUES
(915030, 201, 1, 2014, 'F'),
(915030, 201, 1, 2015, 'F'),
(915030, 201, 1, 2015, 'S'),
(915030, 201, 1, 2016, 'S'),
(916730, 201, 1, 2014, 'F'),
(916730, 201, 1, 2015, 'F'),
(915000, 201, 2, 2014, 'F'),
(915000, 201, 2, 2015, 'F'),
(915130, 201, 2, 2014, 'F'),
(915130, 201, 2, 2015, 'F'),
(915140, 201, 2, 2015, 'S'),
(915140, 201, 2, 2016, 'S'),
(915460, 201, 2, 2014, 'F'),
(915460, 201, 2, 2015, 'F'),
(915470, 201, 2, 2015, 'S'),
(915470, 201, 2, 2016, 'S'),
(913080, 201, 3, 2015, 'S'),
(913080, 201, 3, 2016, 'S'),
(915150, 201, 3, 2014, 'F'),
(915150, 201, 3, 2015, 'F'),
(915160, 201, 3, 2015, 'S'),
(915160, 201, 3, 2016, 'S'),
(915300, 201, 4, 2014, 'F'),
(915300, 201, 4, 2015, 'F'),
(915300, 201, 4, 2015, 'S'),
(915300, 201, 4, 2016, 'S'),
(915300, 202, 5, 2014, 'F'),
(915300, 202, 5, 2015, 'F'),
(915300, 202, 5, 2015, 'S'),
(915300, 202, 5, 2016, 'S'),
(915450, 201, 6, 2014, 'F'),
(915450, 201, 6, 2015, 'F'),
(915450, 201, 6, 2015, 'S'),
(915450, 201, 6, 2016, 'S'),
(915610, 201, 7, 2015, 'S'),
(915610, 201, 7, 2016, 'S'),
(914040, 201, 8, 2014, 'F'),
(914040, 201, 8, 2015, 'F'),
(914040, 201, 8, 2015, 'S'),
(914040, 201, 8, 2016, 'S'),
(915630, 201, 8, 2014, 'F'),
(915630, 201, 8, 2015, 'F'),
(915640, 201, 8, 2015, 'S'),
(915640, 201, 8, 2016, 'S'),
(915440, 201, 9, 2014, 'F'),
(915440, 201, 9, 2015, 'F'),
(915730, 201, 9, 2014, 'F'),
(915730, 201, 9, 2015, 'F'),
(915740, 201, 9, 2015, 'S'),
(915740, 201, 9, 2016, 'S'),
(915800, 201, 10, 2014, 'F'),
(915800, 201, 10, 2015, 'F'),
(915800, 201, 10, 2015, 'S'),
(915800, 201, 10, 2016, 'S'),
(915800, 202, 11, 2014, 'F'),
(915800, 202, 11, 2015, 'F'),
(915800, 202, 11, 2015, 'S'),
(915800, 202, 11, 2016, 'S'),
(911020, 201, 12, 2014, 'F'),
(911020, 201, 12, 2015, 'F'),
(911020, 301, 12, 2015, 'S'),
(911020, 301, 12, 2016, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `SID` int(7) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `IID` int(3) DEFAULT NULL,
  `major` varchar(5) DEFAULT NULL,
  `degreeHeld` varchar(15) DEFAULT NULL,
  `career` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`SID`, `name`, `IID`, `major`, `degreeHeld`, `career`) VALUES
(1010101, 'James', 1, 'cs', 'bachelor', 'graduate'),
(1010102, 'John', 2, 'cs', 'bachelor', 'graduate'),
(1010103, 'Robert', 3, 'cs', 'bachelor', 'graduate'),
(1010104, 'Michael', 4, 'cs', 'bachelor', 'graduate'),
(1010105, 'william', 5, 'cs', 'bachelor', 'graduate'),
(1010106, 'Mary', 6, 'cs', 'bachelor', 'graduate'),
(1010107, 'Linda', 7, 'cs', 'bachelor', 'graduate'),
(1010108, 'Jennifer', 8, 'cs', 'bachelor', 'graduate'),
(1010109, 'Susan', 9, 'cs', 'bachelor', 'graduate'),
(1010110, 'Lisa', 9, 'cs', 'bachelor', 'graduate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`SID`,`CID`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`SID`,`CID`,`SecID`,`yearID`,`semesterID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`IID`);

--
-- Indexes for table `prerequisite`
--
ALTER TABLE `prerequisite`
  ADD PRIMARY KEY (`PCID`,`CID`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`CID`,`SecID`,`yearID`,`semesterID`),
  ADD KEY `IID` (`IID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `IID` (`IID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conditions`
--
ALTER TABLE `conditions`
  ADD CONSTRAINT `conditions_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `students` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conditions_ibfk_2` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prerequisite`
--
ALTER TABLE `prerequisite`
  ADD CONSTRAINT `prerequisite_ibfk_1` FOREIGN KEY (`PCID`) REFERENCES `courses` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prerequisite_ibfk_2` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `courses` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`IID`) REFERENCES `instructors` (`IID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`IID`) REFERENCES `instructors` (`IID`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
