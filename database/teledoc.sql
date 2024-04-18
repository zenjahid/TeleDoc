-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 18, 2024 at 08:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teledoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `IndexNumber` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Degree` varchar(50) DEFAULT NULL,
  `Speciality` varchar(100) DEFAULT NULL,
  `Division` varchar(50) DEFAULT NULL,
  `ChamberNumber` varchar(20) DEFAULT NULL,
  `Hospital` varchar(255) DEFAULT NULL,
  `ChamberLocation` varchar(255) DEFAULT NULL,
  `TimeStart` time DEFAULT NULL,
  `TimeEnd` time DEFAULT NULL,
  `VisitCharge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`IndexNumber`, `Name`, `Email`, `Password`, `Degree`, `Speciality`, `Division`, `ChamberNumber`, `Hospital`, `ChamberLocation`, `TimeStart`, `TimeEnd`, `VisitCharge`) VALUES
(1, 'Dr. S. M. Shahidul Islam', 'shahidulislam@gmail.com', 'shahidulislam', 'MBBS', 'Acupuncture', 'Dhaka', '8809613100600', 'SUO XI Hospital', '24/1, Shaan Tower (Lift 5), Chamelibagh, Shantinagar, Dhaka', '08:00:00', '20:00:00', 1500),
(2, 'Dr. Satyajit Dhar', 'satyajitdhar@gmail.com', 'satyajitdhar', 'MBBS', 'Pain', 'Chittagong', '8801984499600', 'Epic Healthcare, Chittagong', '19, K.B. Fazlul Kader Road, Panchlish, Chattogram', '07:30:00', '22:00:00', 1600),
(3, 'Dr. Rawshan Ara Khatun', 'rawshanarakhatun@gmail.com', 'rawshankhatun', 'MBBS', 'Cancer', 'Rajshahi', '8801732688664', 'Shapla Diagnostic Complex, Rajshahi', 'Greater Road, Laxmipur, Kazihata, Rajshahi', '16:00:00', '21:00:00', 1700),
(4, 'Dr. Md. Abdus Samad Azad', 'abdussamadazad@gmail.com', 'abdussamad', 'MBBS', 'Cardiovascullar', 'Sylhet', '8801711905035', 'Stadium Market, Sylhet', '38, Stadium Market, Rikabi Bazar, Sylhet - 3100', '18:00:00', '20:00:00', 1800),
(5, 'Dr. Taposh Bose', 'taposhbose@gmail.com', 'taposhbose', 'MBBS', 'Chest', 'Rangpur', '8801971555555', 'Update Diagnostic, Rangpur', 'Dhap (Opposite to Police Fari), Jail Road, Rangpur', '16:00:00', '21:00:00', 1900),
(6, 'Prof. Dr. Khan Golam Mostafa', 'golammostafa@gmail.com', 'golammostafa', 'MBBS', 'Child', 'Khulna', '8801720004100', 'Khulna City Medical College & Hospital', '25/26, KDA Avenue, Moilapota Square, Khulna Sadar, Khulna', '20:30:00', '23:00:00', 2000),
(7, 'Dr. Md. Abdur Rahim', 'abdurrahim@gmail.com', 'abdurrahim', 'MBBS', 'Piles', 'Barisal', '8809613787819', 'Popular Diagnostic Center, Barisal', '955 & 109, Shahid Nazrul Islam Road, Alekanda, Banglabazar, Barisal', '14:00:00', '19:00:00', 1500),
(8, 'Dr. Md. Ashek Mahmud Ferdaus', 'ashekmahamusferdaus@gmail.com', 'ashekferdaus', 'MBBS', 'Breast', 'Mymensingh', '8801796586561', 'Nexus Hospital, Mymensingh', '29, Sehora, Mymensingh Sadar, Mymensingh – 2200', '17:00:00', '21:00:00', 1600),
(9, 'Dr. AKM Serajul Alam Rakib', 'serajulalamrakib@gmail.com', 'serajulalam', 'BDS', 'Dental', 'Pabna', '8801725115906', 'Dentosave Dental Clinic, Pabna', 'Thana Mor, South Side of Thana Gate, Shalgaria, Pabna', '16:00:00', '21:00:00', 1700),
(10, 'Dr. Samir Kumar Talukder', 'samirkumartalukder@gmail.com', 'samirtalukder', 'MBBS', 'Diabetes', 'Bogura', '8809613787813', 'Popular Diagnostic Center, Rangpur', '77/1, Jail Road, Dhap, Rangpur - 5400, Bangladesh', '15:00:00', '22:00:00', 1800),
(11, 'Dr. Md. Sajibur Rashid', 'sajibutrashid@gmail.com', 'sajiburrashid', 'MBBS', 'ENT', 'Comilla', '8801711144786', 'Cumilla Medical Center Pvt. Ltd. (Tower Hospital)', 'Comilla Tower, Laksam Road, Kandirpar, Cumilla - 3500', '15:00:00', '20:00:00', 1900),
(12, 'Prof. Dr. Bebakananda Biswas', 'bebakanandabiswas@gmail.com', 'bebakanandabiswas', 'MBBS', 'Phaco', 'Narayanganj', '8809666787804', 'Popular Diagnostic Center, Narayanganj', '231/4, Bangabandhu Road, Chashara, Narayanganj – 1400', '09:00:00', '13:30:00', 2000),
(13, 'Dr. ATM Ataur Rahman (Hiron)', 'ataurrahmanhiron@gmail.com', 'ataurrahman', 'MBBS', 'Gastroenterology', 'Kushtia', '8809666787817', 'Popular Diagnostic Centre, Kushtia', 'City Tower, House # 01, Mir Mosharraf Hossain Road, Coart Para, Kushtia', '10:00:00', '18:00:00', 1500),
(14, 'Prof. Dr. Narayan Chandra Saha', 'narayanchandrasaha@gmail.com', 'narayanchandra', 'MBBS', 'Autism', 'Dhaka', '8801731956033', 'Comfort Diagnostic Center, Dhanmondi', '167/B, Green Road, Dhanmondi, Dhaka - 1205', '18:00:00', '22:00:00', 1600),
(15, 'Dr. Priti Barua', 'pritibarua@gmail.com', 'pritibarua', 'MBBS', 'Gynecologist', 'Chittagong', '8801713123100', 'Belle Vue Hospital, Chittagong', 'Prabartak Hill, 12/12, O.R. Nizam Road, Panchlaish, Chattogram', '17:00:00', '20:00:00', 1700),
(16, 'Dr. Morsed Zaman Miah', 'morsedzamanmiah@gmail.com', 'morsedzaman', 'MBBS', 'Blood', 'Rajshahi', '8809613787811', 'Popular Diagnostic Center, Rajshahi', 'House # 474, Chowdhury Tower, Laxmipur, Rajshahi', '15:00:00', '21:00:00', 1800),
(17, 'Dr. Alamgir Chowdhury', 'alamgirchowdhury@gmail.com', 'alamgirchowdhury', 'MBBS', 'Kidney', 'Sylhet', '8801713328577', 'Mount Adora Hospital, Akhalia, Sylhet', 'Sylhet-Sunamganj Highway, Akhalia, Sylhet - 3100', '15:00:00', '17:00:00', 1900),
(21, 'dsds', 'dsad@gmail.com', 'zxcvbnm', 'jahid', 'den', 'Sylhet', 'sdisdsd', 'qwqq', 'qwqw', '01:34:00', '16:34:00', 100),
(22, 'dsds', 'dsad@gmail.com', 'zxcvbnm', 'jahid', 'den', 'Sylhet', 'sdisdsd', 'qwqq', 'qwqw', '01:34:00', '16:34:00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_availablity`
--

CREATE TABLE `doctor_availablity` (
  `app_id` int(11) NOT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_availablity`
--

INSERT INTO `doctor_availablity` (`app_id`, `doc_id`, `user_id`, `appointment_time`, `date`, `cost`) VALUES
(7, 1, 5, '08:00:00', '2024-04-16', 1500),
(8, 3, 4, '16:00:00', '2024-04-16', 1700),
(9, 10, 4, '15:00:00', '2024-04-16', 1800),
(10, 1, 4, '16:00:00', '2024-04-17', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `email` varchar(99) DEFAULT NULL,
  `name` varchar(99) DEFAULT NULL,
  `pass` varchar(99) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `email`, `name`, `pass`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin', 0),
(3, 'prasantasarker4@gmail.com', 'Prashanta', 'Sarker_603', 2),
(4, 'niloy@gmail.com', 'niloy', 'niloy', 2),
(5, 'agelawmow@f5.si', 'admin', 'Mnbvcxz1@', 2),
(6, 'adminx@gmail.com', 'adminx', 'Mnbvcxz1@', 2),
(7, 'agelawmow@f5.six', 'niloyxx', 'Zaq12#', 2),
(8, 'agelawmow@f5.siz', 'laptwtwo', 'Zaq12#', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`IndexNumber`);

--
-- Indexes for table `doctor_availablity`
--
ALTER TABLE `doctor_availablity`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `IndexNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctor_availablity`
--
ALTER TABLE `doctor_availablity`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_availablity`
--
ALTER TABLE `doctor_availablity`
  ADD CONSTRAINT `doctor_availablity_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`IndexNumber`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
