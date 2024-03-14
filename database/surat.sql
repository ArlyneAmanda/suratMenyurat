-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 04:23 PM
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
-- Database: `surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `suratmasuk`
--

CREATE TABLE `suratmasuk` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `asal_surat` varchar(100) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suratmasuk`
--

INSERT INTO `suratmasuk` (`id`, `no_surat`, `tanggal_surat`, `tanggal_masuk`, `asal_surat`, `perihal`, `file_surat`) VALUES
(1, '1', '2024-03-09', '2024-03-14', 'neper', 'danaa', 'LAPORAN UJIKOM ARLYNE 2024.pdf'),
(3, '111', '2024-03-09', '2024-03-27', 'smandaa', 'event', 'SuratHibahL1.pdf'),
(5, '121', '2024-03-14', '2024-03-08', 'smaju', 'penggalangan', 'INGAT.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `namalengkap`) VALUES
(1, 'arlynear', '$2y$10$0BqlonSTcBNcFBayD4QUZ.SH4tiLZEDgXciEQOmgykDmwi2C4wdxm', 'Arlyne Amanda Raihanah'),
(2, 'nad', '$2y$10$FIb6D1kjKUDTg7iyL0ZX7e2m7pddK0YL9EjUa4jfaGIM9yuga/GDe', 'Nhadiera Amilaika'),
(3, 'kim', '$2y$10$8jlsNE1d4VTPcMJxxUFc4.BOQToXTZEXdWHA.SU2mptKG4h/LRcCa', 'qimza aulialyn'),
(4, 'alyn', '$2y$10$EaajaJK7jQYBwQpxSy2Vf.teUz7a/FKIwP5cCkC2wvLDG3m3L977.', 'Arlyne Amanda Raihanah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
