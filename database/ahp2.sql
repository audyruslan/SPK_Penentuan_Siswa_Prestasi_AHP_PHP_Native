-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 07:29 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisa_alternatif`
--

CREATE TABLE `analisa_alternatif` (
  `alternatif_pertama` varchar(4) NOT NULL,
  `nilai_analisa_alternatif` double NOT NULL,
  `hasil_analisa_alternatif` double NOT NULL,
  `alternatif_kedua` varchar(4) NOT NULL,
  `id_kriteria` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisa_alternatif`
--

INSERT INTO `analisa_alternatif` (`alternatif_pertama`, `nilai_analisa_alternatif`, `hasil_analisa_alternatif`, `alternatif_kedua`, `id_kriteria`) VALUES
('A001', 1, 0.57692307692308, 'A001', 'C1'),
('A001', 1, 0.5607476635514, 'A001', 'C2'),
('A001', 1, 0.42857142857143, 'A001', 'C3'),
('A001', 1, 0.52173913043478, 'A001', 'C4'),
('A001', 5, 0.76530612244898, 'A002', 'C1'),
('A001', 3, 0.65454545454545, 'A002', 'C2'),
('A001', 2, 0.52173913043478, 'A002', 'C3'),
('A001', 2, 0.53333333333333, 'A002', 'C4'),
('A001', 3, 0.32608695652174, 'A003', 'C1'),
('A001', 4, 0.48, 'A003', 'C2'),
('A001', 3, 0.46153846153846, 'A003', 'C3'),
('A001', 4, 0.53333333333333, 'A003', 'C4'),
('A001', 5, 0.35714285714286, 'A004', 'C1'),
('A001', 5, 0.38461538461538, 'A004', 'C2'),
('A001', 2, 0.25, 'A004', 'C3'),
('A001', 6, 0.46153846153846, 'A004', 'C4'),
('A002', 0.2, 0.11538461538462, 'A001', 'C1'),
('A002', 0.33333333333333, 0.18691588785047, 'A001', 'C2'),
('A002', 0.5, 0.21428571428571, 'A001', 'C3'),
('A002', 0.5, 0.26086956521739, 'A001', 'C4'),
('A002', 1, 0.1530612244898, 'A002', 'C1'),
('A002', 1, 0.21818181818182, 'A002', 'C2'),
('A002', 1, 0.26086956521739, 'A002', 'C3'),
('A002', 1, 0.26666666666667, 'A002', 'C4'),
('A002', 5, 0.54347826086957, 'A003', 'C1'),
('A002', 3, 0.36, 'A003', 'C2'),
('A002', 2, 0.30769230769231, 'A003', 'C3'),
('A002', 2, 0.26666666666667, 'A003', 'C4'),
('A002', 3, 0.21428571428571, 'A004', 'C1'),
('A002', 4, 0.30769230769231, 'A004', 'C2'),
('A002', 3, 0.375, 'A004', 'C3'),
('A002', 4, 0.30769230769231, 'A004', 'C4'),
('A003', 0.33333333333333, 0.19230769230769, 'A001', 'C1'),
('A003', 0.25, 0.14018691588785, 'A001', 'C2'),
('A003', 0.33333333333333, 0.14285714285714, 'A001', 'C3'),
('A003', 0.25, 0.1304347826087, 'A001', 'C4'),
('A003', 0.2, 0.030612244897959, 'A002', 'C1'),
('A003', 0.33333333333333, 0.072727272727272, 'A002', 'C2'),
('A003', 0.5, 0.1304347826087, 'A002', 'C3'),
('A003', 0.5, 0.13333333333333, 'A002', 'C4'),
('A003', 1, 0.10869565217391, 'A003', 'C1'),
('A003', 1, 0.12, 'A003', 'C2'),
('A003', 1, 0.15384615384615, 'A003', 'C3'),
('A003', 1, 0.13333333333333, 'A003', 'C4'),
('A003', 5, 0.35714285714286, 'A004', 'C1'),
('A003', 3, 0.23076923076923, 'A004', 'C2'),
('A003', 2, 0.25, 'A004', 'C3'),
('A003', 2, 0.15384615384615, 'A004', 'C4'),
('A004', 0.2, 0.11538461538462, 'A001', 'C1'),
('A004', 0.2, 0.11214953271028, 'A001', 'C2'),
('A004', 0.5, 0.21428571428571, 'A001', 'C3'),
('A004', 0.16666666666667, 0.086956521739132, 'A001', 'C4'),
('A004', 0.33333333333333, 0.051020408163265, 'A002', 'C1'),
('A004', 0.25, 0.054545454545455, 'A002', 'C2'),
('A004', 0.33333333333333, 0.08695652173913, 'A002', 'C3'),
('A004', 0.25, 0.066666666666667, 'A002', 'C4'),
('A004', 0.2, 0.021739130434783, 'A003', 'C1'),
('A004', 0.33333333333333, 0.04, 'A003', 'C2'),
('A004', 0.5, 0.076923076923077, 'A003', 'C3'),
('A004', 0.5, 0.066666666666667, 'A003', 'C4'),
('A004', 1, 0.071428571428571, 'A004', 'C1'),
('A004', 1, 0.076923076923077, 'A004', 'C2'),
('A004', 1, 0.125, 'A004', 'C3'),
('A004', 1, 0.076923076923077, 'A004', 'C4');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_kriteria`
--

CREATE TABLE `analisa_kriteria` (
  `kriteria_pertama` varchar(2) NOT NULL,
  `nilai_analisa_kriteria` double NOT NULL,
  `hasil_analisa_kriteria` double NOT NULL,
  `kriteria_kedua` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisa_kriteria`
--

INSERT INTO `analisa_kriteria` (`kriteria_pertama`, `nilai_analisa_kriteria`, `hasil_analisa_kriteria`, `kriteria_kedua`) VALUES
('C1', 1, 0.57931034482759, 'C1'),
('C1', 3, 0.65454545454545, 'C2'),
('C1', 4, 0.48, 'C3'),
('C1', 7, 0.46666666666667, 'C4'),
('C2', 0.33333333333333, 0.19310344827586, 'C1'),
('C2', 1, 0.21818181818182, 'C2'),
('C2', 3, 0.36, 'C3'),
('C2', 4, 0.26666666666667, 'C4'),
('C3', 0.25, 0.1448275862069, 'C1'),
('C3', 0.33333333333333, 0.072727272727272, 'C2'),
('C3', 1, 0.12, 'C3'),
('C3', 3, 0.2, 'C4'),
('C4', 0.14285714285714, 0.082758620689654, 'C1'),
('C4', 0.25, 0.054545454545455, 'C2'),
('C4', 0.33333333333333, 0.04, 'C3'),
('C4', 1, 0.066666666666667, 'C4');

-- --------------------------------------------------------

--
-- Table structure for table `data_alternatif`
--

CREATE TABLE `data_alternatif` (
  `id_alternatif` varchar(4) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nis` char(18) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kelamin` varchar(256) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hasil_akhir` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_alternatif`
--

INSERT INTO `data_alternatif` (`id_alternatif`, `id_kelas`, `nis`, `nama`, `tempat_lahir`, `tanggal_lahir`, `kelamin`, `alamat`, `hasil_akhir`) VALUES
('A001', 2, '2007', 'AAN ANUGRAH', 'LOMBONGA', '2002-04-04', 'Laki-laki', 'LABEAN', 0.5035833756308891),
('A002', 2, '2163', 'ADI PUTRA', 'LABEAN', '2002-07-07', 'Laki-laki', 'BOSA', 0.26102709314948697),
('A003', 2, '2173', 'AISYA', 'POMOLULU', '2002-09-09', 'Perempuan', 'BALAESANG TANJUNG', 0.1655553889099483),
('A004', 2, '2177', 'ALDIANSYAH', 'LABEAN', '2002-01-21', 'Laki-laki', 'SIDANG SARI', 0.0698341423096845);

-- --------------------------------------------------------

--
-- Table structure for table `data_kriteria`
--

CREATE TABLE `data_kriteria` (
  `id_kriteria` varchar(2) NOT NULL,
  `nama_kriteria` varchar(45) NOT NULL,
  `jumlah_kriteria` double NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kriteria`
--

INSERT INTO `data_kriteria` (`id_kriteria`, `nama_kriteria`, `jumlah_kriteria`, `bobot_kriteria`) VALUES
('C1', 'Akademik', 1.7261904761904698, 0.5451306165099274),
('C2', 'Ekstrakulikuler', 4.58333333333333, 0.2594879832810875),
('C3', 'Sikap', 8.33333333333333, 0.13438871473354302),
('C4', 'Absensi', 15, 0.06099268547544401);

-- --------------------------------------------------------

--
-- Table structure for table `jum_alt_kri`
--

CREATE TABLE `jum_alt_kri` (
  `id_alternatif` varchar(4) NOT NULL,
  `id_kriteria` varchar(2) NOT NULL,
  `jumlah_alt_kri` double NOT NULL,
  `skor_alt_kri` double NOT NULL,
  `hasil_alt_kri` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jum_alt_kri`
--

INSERT INTO `jum_alt_kri` (`id_alternatif`, `id_kriteria`, `jumlah_alt_kri`, `skor_alt_kri`, `hasil_alt_kri`) VALUES
('A001', 'C1', 1.7333333333333298, 0.506364753259165, 0.27603493012307),
('A001', 'C2', 1.7833333333333299, 0.5131709394686113, 0.13316169216117),
('A001', 'C3', 2.33333333333333, 0.4806013780244633, 0.064587401491877),
('A001', 'C4', 1.91666666666667, 0.48857254968334124, 0.029799351854772),
('A002', 'C1', 6.5333333333333306, 0.25655245375742497, 0.13985459728392),
('A002', 'C2', 4.58333333333333, 0.2623749785942875, 0.06808315405885),
('A002', 'C3', 3.83333333333333, 0.2714039513291425, 0.036473628192729),
('A002', 'C4', 3.75, 0.2724214138870469, 0.016615713613988),
('A003', 'C1', 9.2, 0.17218961163060476, 0.093865829144797),
('A003', 'C2', 8.33333333333333, 0.15655523323834636, 0.040624201745119),
('A003', 'C3', 6.5, 0.16079832876823008, 0.021609480734464),
('A003', 'C4', 7.5, 0.15503297177126693, 0.0094558772855683),
('A004', 'C1', 14, 0.06489318135280975, 0.035375259958148),
('A004', 'C2', 13, 0.06789884869875637, 0.017618935315948),
('A004', 'C3', 8, 0.08719634187816401, 0.011718204314473),
('A004', 'C4', 13, 0.08397306465834446, 0.0051217427211155),
('A005', 'C1', 9.2, 0.17218961163060476, 0.093865829144797),
('A005', 'C2', 8.33333333333333, 0.15655523323834636, 0.040624201745119),
('A005', 'C3', 6.5, 0.16079832876823008, 0.021609480734464),
('A005', 'C4', 7.5, 0.15503297177126693, 0.0094558772855683),
('A006', 'C1', 14, 0.06489318135280975, 0.035375259958148),
('A006', 'C2', 13, 0.06789884869875637, 0.017618935315948),
('A006', 'C3', 8, 0.08719634187816401, 0.011718204314473),
('A006', 'C4', 13, 0.08397306465834446, 0.0051217427211155);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Kelas Satu'),
(2, 'Kelas Dua'),
(3, 'Kelas Tiga');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `jum_nilai` double NOT NULL,
  `ket_nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `jum_nilai`, `ket_nilai`) VALUES
(2, 9, 'Mutlak sangat penting dari'),
(3, 8, 'Mendekati mutlak dari'),
(8, 7, 'Sangat penting dari'),
(9, 6, 'Mendekati sangat penting dari'),
(10, 5, 'Lebih penting dari'),
(11, 4, 'Mendekati lebih penting dari'),
(12, 3, 'Sedikit lebih penting dari'),
(13, 2, 'Mendekati sedikit lebih penting dari'),
(14, 1, 'Sama penting dengan'),
(15, 0.5, '1 bagi mendekati sedikit lebih penting dari'),
(16, 0.333, '1 bagi sedikit lebih penting dari'),
(17, 0.25, '1 bagi mendekati lebih penting dari'),
(18, 0.2, '1 bagi lebih penting dari'),
(19, 0.167, '1 bagi mendekati sangat penting dari'),
(20, 0.143, '1 bagi sangat penting dari'),
(21, 0.125, '1 bagi mendekati mutlak dari'),
(22, 0.1, '1 bagi mutlak sangat penting dari');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_awal`
--

CREATE TABLE `nilai_awal` (
  `id_nilai_awal` int(11) NOT NULL,
  `id_alternatif` varchar(4) NOT NULL,
  `nilai` varchar(5) NOT NULL,
  `keterangan` enum('B','C','K') NOT NULL,
  `periode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_awal`
--

INSERT INTO `nilai_awal` (`id_nilai_awal`, `id_alternatif`, `nilai`, `keterangan`, `periode`) VALUES
(34, 'A001', '85.25', 'B', '2022'),
(35, 'A002', '81', 'B', '2022'),
(36, 'A003', '85.25', 'B', '2022'),
(37, 'A004', '82', 'B', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_awal_detail`
--

CREATE TABLE `nilai_awal_detail` (
  `id_nilai_awal_detail` int(11) NOT NULL,
  `id_nilai_awal` int(11) NOT NULL,
  `id_kriteria` varchar(2) NOT NULL,
  `nilai` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_awal_detail`
--

INSERT INTO `nilai_awal_detail` (`id_nilai_awal_detail`, `id_nilai_awal`, `id_kriteria`, `nilai`) VALUES
(146, 30, 'C1', 80),
(147, 30, 'C2', 80),
(148, 30, 'C3', 80),
(149, 30, 'C4', 80),
(150, 31, 'C1', 80),
(151, 31, 'C2', 80),
(152, 31, 'C3', 80),
(153, 31, 'C4', 80),
(154, 32, 'C1', 80),
(155, 32, 'C2', 80),
(156, 32, 'C3', 80),
(157, 32, 'C4', 80),
(158, 33, 'C1', 80),
(159, 33, 'C2', 80),
(160, 33, 'C3', 80),
(161, 33, 'C4', 80),
(162, 34, 'C1', 82),
(163, 34, 'C2', 86),
(164, 34, 'C3', 88),
(165, 34, 'C4', 85),
(166, 35, 'C1', 81),
(167, 35, 'C2', 80),
(168, 35, 'C3', 83),
(169, 35, 'C4', 80),
(170, 36, 'C1', 83),
(171, 36, 'C2', 85),
(172, 36, 'C3', 85),
(173, 36, 'C4', 88),
(174, 37, 'C1', 80),
(175, 37, 'C2', 87),
(176, 37, 'C3', 81),
(177, 37, 'C4', 80);

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `kriteria` varchar(2) NOT NULL,
  `skor_bobot` double NOT NULL,
  `alternatif` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jabatan` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `img_dir` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama_lengkap`, `jabatan`, `role_id`, `img_dir`, `password`) VALUES
(5, 'fadli', 'Fadli Nur Zaman', 'Guru ', 2, 'image/1650293546.png', '$2y$10$XH6WNaiFjbnNV6oRO6lLEO3qBUYZz5M7sVt5ndRxRd9Io4VMACHxm'),
(6, 'audy', 'Audy Ruslan', 'Kepala Sekolah', 1, 'image/1650293713.png', '$2y$10$STshDAwmQJdW7FdQFozLDe7yYSAeYs4S8axZA6qNT9JGbVLDJR6Uy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisa_alternatif`
--
ALTER TABLE `analisa_alternatif`
  ADD PRIMARY KEY (`alternatif_pertama`,`alternatif_kedua`,`id_kriteria`),
  ADD KEY `alternatif_kedua` (`alternatif_kedua`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `analisa_kriteria`
--
ALTER TABLE `analisa_kriteria`
  ADD PRIMARY KEY (`kriteria_pertama`,`kriteria_kedua`),
  ADD KEY `kriteria_kedua` (`kriteria_kedua`);

--
-- Indexes for table `data_alternatif`
--
ALTER TABLE `data_alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `data_kriteria`
--
ALTER TABLE `data_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `jum_alt_kri`
--
ALTER TABLE `jum_alt_kri`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_awal`
--
ALTER TABLE `nilai_awal`
  ADD PRIMARY KEY (`id_nilai_awal`,`id_alternatif`),
  ADD KEY `alternatif` (`id_alternatif`);

--
-- Indexes for table `nilai_awal_detail`
--
ALTER TABLE `nilai_awal_detail`
  ADD PRIMARY KEY (`id_nilai_awal_detail`,`id_nilai_awal`),
  ADD KEY `alternatif` (`id_nilai_awal`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`kriteria`,`alternatif`),
  ADD KEY `alternatif` (`alternatif`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nilai_awal`
--
ALTER TABLE `nilai_awal`
  MODIFY `id_nilai_awal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `nilai_awal_detail`
--
ALTER TABLE `nilai_awal_detail`
  MODIFY `id_nilai_awal_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
