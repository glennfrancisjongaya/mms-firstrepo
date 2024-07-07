-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 12:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analgesics`
--

CREATE TABLE `tbl_analgesics` (
  `ID` int(10) NOT NULL,
  `MedID` varchar(10) NOT NULL,
  `MedType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_analgesics`
--

INSERT INTO `tbl_analgesics` (`ID`, `MedID`, `MedType`) VALUES
(1, '1', 'NSAIDs'),
(2, '1', 'Acetaminophen'),
(3, '1', 'Opioids');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `ID` int(11) NOT NULL,
  `MedicineID` varchar(5) NOT NULL,
  `Quantity` varchar(5) NOT NULL,
  `Medname` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `ID` int(11) NOT NULL,
  `PatientID` int(6) NOT NULL,
  `MedicineID` varchar(20) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `DateTime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicalcondition`
--

CREATE TABLE `tbl_medicalcondition` (
  `ID` int(11) NOT NULL,
  `PatientID` varchar(10) NOT NULL,
  `MedicalCondition` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medication`
--

CREATE TABLE `tbl_medication` (
  `ID` int(11) NOT NULL,
  `PatientID` varchar(10) NOT NULL,
  `MedicineName` varchar(20) NOT NULL,
  `DosageForm` varchar(20) NOT NULL,
  `Frequency` varchar(50) NOT NULL,
  `Instructions` varchar(250) NOT NULL,
  `SideEffects` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicationreminder`
--

CREATE TABLE `tbl_medicationreminder` (
  `ID` int(11) NOT NULL,
  `PatientID` varchar(10) NOT NULL,
  `ReminderText` varchar(250) NOT NULL,
  `ReminderTime` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicine`
--

CREATE TABLE `tbl_medicine` (
  `ID` int(11) NOT NULL,
  `MedicineID` varchar(6) NOT NULL,
  `MedicineName` varchar(20) NOT NULL,
  `DosageForm` varchar(20) NOT NULL,
  `Strength` varchar(20) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `ExpirationDate` varchar(20) NOT NULL,
  `Instructions` varchar(200) NOT NULL,
  `SideEffects` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_medicine`
--

INSERT INTO `tbl_medicine` (`ID`, `MedicineID`, `MedicineName`, `DosageForm`, `Strength`, `Quantity`, `ExpirationDate`, `Instructions`, `SideEffects`) VALUES
(3, '1', 'Acetaminophen', 'Tablet', '250mg', 9, '250511', '', ''),
(4, '1', 'Ibuprofen', 'Tablet', '250mg', 10, '250512', '', ''),
(5, '1', 'Naproxen', 'Tablet', '250mg', 10, '250513', '', ''),
(6, '1', 'Aspirin', 'Tablet', '250mg', 10, '250514', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medicinetype`
--

CREATE TABLE `tbl_medicinetype` (
  `ID` int(10) NOT NULL,
  `MedID` varchar(10) NOT NULL,
  `Med` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_medicinetype`
--

INSERT INTO `tbl_medicinetype` (`ID`, `MedID`, `Med`) VALUES
(1, '1', 'Analgesics'),
(2, '2', 'Antibiotics'),
(3, '3', 'Antidepressants');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `ID` int(11) NOT NULL,
  `PatientID` varchar(6) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `DoB` int(4) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `ContactInfo` varchar(11) NOT NULL,
  `MedicineType` varchar(20) NOT NULL,
  `MedicineName` varchar(20) NOT NULL,
  `Frequency` varchar(50) NOT NULL,
  `MedicalCondition` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`ID`, `PatientID`, `Lname`, `Fname`, `DoB`, `Gender`, `ContactInfo`, `MedicineType`, `MedicineName`, `Frequency`, `MedicalCondition`) VALUES
(1, '042623', 'Jongaya', 'Glenn Francis', 2000, 'Male', '09488363702', '', 'Ibuprofen', '1 a day', 'Headache');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescriptions`
--

CREATE TABLE `tbl_prescriptions` (
  `ID` int(11) NOT NULL,
  `PatientID` varchar(20) NOT NULL,
  `MedicineName` varchar(10) NOT NULL,
  `DosageForm` varchar(10) NOT NULL,
  `ExpirationDate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system`
--

CREATE TABLE `tbl_system` (
  `AdminID` int(6) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `ContactNo` varchar(11) NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_system`
--

INSERT INTO `tbl_system` (`AdminID`, `Username`, `Password`, `Lastname`, `Firstname`, `ContactNo`, `Role`) VALUES
(1, 'admin', 'admin123', '', '', '', ''),
(2, 'newuser', 'newuser123', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_analgesics`
--
ALTER TABLE `tbl_analgesics`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_medicalcondition`
--
ALTER TABLE `tbl_medicalcondition`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_medication`
--
ALTER TABLE `tbl_medication`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_medicationreminder`
--
ALTER TABLE `tbl_medicationreminder`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_medicinetype`
--
ALTER TABLE `tbl_medicinetype`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_system`
--
ALTER TABLE `tbl_system`
  ADD PRIMARY KEY (`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_analgesics`
--
ALTER TABLE `tbl_analgesics`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_medicalcondition`
--
ALTER TABLE `tbl_medicalcondition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_medication`
--
ALTER TABLE `tbl_medication`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_medicationreminder`
--
ALTER TABLE `tbl_medicationreminder`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_medicine`
--
ALTER TABLE `tbl_medicine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_medicinetype`
--
ALTER TABLE `tbl_medicinetype`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_system`
--
ALTER TABLE `tbl_system`
  MODIFY `AdminID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
