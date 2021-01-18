-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2019 at 06:30 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` char(10) NOT NULL,
  `nip` char(18) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `nip`, `nilai`, `tahun`) VALUES
('cgaHby2Dq9', '126123172486436444', 53.51, '2019'),
('e4XVjzF6e8', '144653421534213413', 82.84, '2019'),
('EUlnk5OiGb', '153812638126318233', 16.09, '2019'),
('HnHkYKqrVQ', '111245352352654643', 22.02, '2019'),
('iQHupX4ojT', '121321372136274537', 64.1, '2019'),
('MRwvsSyXSD', '112453454656565653', 50.98, '2019'),
('RBw8fccef9', '113215346374637437', 36.02, '2019'),
('soxBm9mNn1', '131263781275124512', 81.13, '2019'),
('UCWPPzm4Ah', '127351275371351235', 59.65, '2019'),
('YhQClcdMC1', '125163421312653412', 39, '2019'),
('zq6WfR8pzC', '123131374574562542', 6.25, '2019');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(3) NOT NULL,
  `nama_kriteria` varchar(30) DEFAULT NULL,
  `bobot` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
('K01', 'Sasaran Kerja', 30),
('K02', 'Disiplin', 20),
('K03', 'Integritas', 15),
('K04', 'Komitmen', 15),
('K05', 'Orientasi Pelayanan', 10),
('K06', 'Kerjasama', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` char(3) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `bln` char(2) DEFAULT NULL,
  `thn` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id_notif`, `ket`, `bln`, `thn`) VALUES
('U01', 'Jgn lupa isi penilaian yaaa', '07', '2019');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `tempat_lahir` varchar(40) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `pangkat_gol` varchar(10) DEFAULT NULL,
  `pangkat_tmt` date DEFAULT NULL,
  `jabatan_nama` varchar(40) DEFAULT NULL,
  `jabatan_kls` int(3) DEFAULT NULL,
  `jabatan_tmt` date DEFAULT NULL,
  `mkj_thn` int(2) DEFAULT NULL,
  `mkj_bln` int(2) DEFAULT NULL,
  `eselon` varchar(10) DEFAULT NULL,
  `tmt_cpns` date DEFAULT NULL,
  `mk_thn` int(2) DEFAULT NULL,
  `mk_bln` int(2) DEFAULT NULL,
  `usia_thn` int(2) DEFAULT NULL,
  `usia_bln` int(2) DEFAULT NULL,
  `ljs_nama` varchar(40) DEFAULT NULL,
  `ljs_thn` int(4) DEFAULT NULL,
  `pdk_nama` varchar(100) DEFAULT NULL,
  `pdk_lulus` int(4) DEFAULT NULL,
  `pdk_ti` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `tempat_lahir`, `tgllahir`, `pangkat_gol`, `pangkat_tmt`, `jabatan_nama`, `jabatan_kls`, `jabatan_tmt`, `mkj_thn`, `mkj_bln`, `eselon`, `tmt_cpns`, `mk_thn`, `mk_bln`, `usia_thn`, `usia_bln`, `ljs_nama`, `ljs_thn`, `pdk_nama`, `pdk_lulus`, `pdk_ti`) VALUES
('111245352352654643', 'A1-Fatiyani Alyensi', 'Pekanbaru', '1990-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('112453454656565653', 'A2-Zedthi Fitriani', 'Pekanbaru', '1989-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('113215346374637437', 'A3-Yuspermai', 'Pekanbaru', '1984-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('121321372136274537', 'A4-Mas Ayu Viona', 'Pekanbaru', '1985-08-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('123131374574562542', 'A5-Angelia Safitri', 'Pekanbaru', '1975-07-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('125163421312653412', 'A6-Essa Nita Ceria', 'Pekanbaru', '1977-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('126123172486436444', 'A7-Mohd Irman S', 'Pekanbaru', '1977-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('127351275371351235', 'A8-Sumarni', 'Pekanbaru', '1977-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('131263781275124512', 'A9-Lihasna', 'Pekanbaru', '1977-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('144653421534213413', 'A10-Minastiti', 'Pekanbaru', '1977-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('153812638126318233', 'A11-Ita Viriani', 'Pekanbaru', '1977-07-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` char(10) NOT NULL,
  `nip` char(18) DEFAULT NULL,
  `id_kriteria` char(3) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `nip`, `id_kriteria`, `nilai`, `tahun`) VALUES
('1jXWYUEpFV', '126123172486436444', 'K03', 80, '2019'),
('2m96K4NoDh', '127351275371351235', 'K06', 78, '2019'),
('334fxCgOHF', '153812638126318233', 'K05', 81, '2019'),
('3Ovewgkx8G', '123131374574562542', 'K06', 83, '2019'),
('4HA4OiSCRq', '113215346374637437', 'K03', 80, '2019'),
('a5hxTESjKc', '112453454656565653', 'K06', 80, '2019'),
('aCY7wrwRp5', '131263781275124512', 'K03', 77.5, '2019'),
('AgP68HDC7V', '131263781275124512', 'K05', 78, '2019'),
('ah7RcZ2U6T', '153812638126318233', 'K06', 81, '2019'),
('Aqm4qMeYzB', '113215346374637437', 'K02', 80, '2019'),
('bL1pB5a7Kk', '131263781275124512', 'K01', 80.8, '2019'),
('bub87pb6Ch', '111245352352654643', 'K06', 82, '2019'),
('CxuMhfixFQ', '144653421534213413', 'K04', 90, '2019'),
('d8CNWlOc7z', '121321372136274537', 'K05', 78.5, '2019'),
('DjtVCo95tr', '125163421312653412', 'K04', 91, '2019'),
('dLh522xFDD', '131263781275124512', 'K06', 77.5, '2019'),
('dRkv7NswjZ', '111245352352654643', 'K02', 81, '2019'),
('eqdUB1qgcI', '126123172486436444', 'K04', 91, '2019'),
('FvMtfrj8WR', '127351275371351235', 'K05', 78, '2019'),
('G5uNQDa7c6', '121321372136274537', 'K02', 77, '2019'),
('GnaI7uSMp2', '113215346374637437', 'K06', 78, '2019'),
('H3nXTKPdJN', '127351275371351235', 'K04', 91, '2019'),
('hFhLeSFfv4', '125163421312653412', 'K01', 83.5, '2019'),
('HhKqZYAqOx', '112453454656565653', 'K02', 77, '2019'),
('iBk8uXV3wV', '123131374574562542', 'K02', 84, '2019'),
('ikFfKAKiCT', '121321372136274537', 'K01', 82.6, '2019'),
('IvQFy6vfYa', '112453454656565653', 'K01', 83.9, '2019'),
('jJPYlSZjR5', '111245352352654643', 'K05', 81.5, '2019'),
('jWWAmSLvOc', '125163421312653412', 'K03', 80, '2019'),
('jyM4kh6WN5', '131263781275124512', 'K04', 91, '2019'),
('kd4khUE9aS', '111245352352654643', 'K03', 81, '2019'),
('mODDcR4Ufx', '121321372136274537', 'K03', 78, '2019'),
('N5q8qVWmtZ', '112453454656565653', 'K03', 78.5, '2019'),
('nq2tzFnhrW', '123131374574562542', 'K01', 84.3, '2019'),
('nRj2rszA3B', '111245352352654643', 'K04', 91, '2019'),
('oGc65jBLDX', '131263781275124512', 'K02', 76, '2019'),
('ONyVX5FXfj', '121321372136274537', 'K06', 78, '2019'),
('P9e6Sd4A1Z', '127351275371351235', 'K01', 81.4, '2019'),
('pct5Nn1783', '125163421312653412', 'K06', 82, '2019'),
('PHuRqIKRMS', '144653421534213413', 'K05', 77, '2019'),
('qrbBjcx8M4', '153812638126318233', 'K04', 91, '2019'),
('qRP48ONs9i', '125163421312653412', 'K02', 78.5, '2019'),
('QWR1BqroNU', '153812638126318233', 'K03', 81, '2019'),
('RLELsZpgvq', '123131374574562542', 'K05', 82, '2019'),
('rpCypbCXVd', '111245352352654643', 'K01', 84.3, '2019'),
('S5IM3XVLIT', '126123172486436444', 'K06', 80, '2019'),
('TkuJUCRetr', '123131374574562542', 'K03', 83, '2019'),
('Tn9mlVmDiO', '126123172486436444', 'K01', 81.4, '2019'),
('TnR8jdNJG5', '125163421312653412', 'K05', 80, '2019'),
('TR3CKzLpwe', '121321372136274537', 'K04', 91, '2019'),
('Tss6JG6Rv8', '112453454656565653', 'K05', 78.5, '2019'),
('UJa9KdeYas', '113215346374637437', 'K04', 91, '2019'),
('UnLBc4AbrB', '126123172486436444', 'K05', 80.5, '2019'),
('V9sPSVbKbe', '127351275371351235', 'K03', 80, '2019'),
('vTqBAjKESR', '144653421534213413', 'K02', 80.5, '2019'),
('W9NGRuc3MK', '112453454656565653', 'K04', 91, '2019'),
('WgXMTerROq', '153812638126318233', 'K01', 85.3, '2019'),
('wTReUYV2ju', '126123172486436444', 'K02', 79, '2019'),
('WvNVMn1KiV', '153812638126318233', 'K02', 82, '2019'),
('wwOOPgR617', '127351275371351235', 'K02', 80, '2019'),
('XdnjBkWbJz', '144653421534213413', 'K06', 80, '2019'),
('yePK9u8agz', '144653421534213413', 'K03', 78, '2019'),
('YuFSpTpScr', '113215346374637437', 'K01', 83.9, '2019'),
('Z4nvZofRiW', '144653421534213413', 'K01', 80.5, '2019'),
('ZkXiwLmEdd', '123131374574562542', 'K04', 91, '2019'),
('zYMGS7DUNh', '113215346374637437', 'K05', 82, '2019');

-- --------------------------------------------------------

--
-- Table structure for table `sasaran_kerja`
--

CREATE TABLE `sasaran_kerja` (
  `id_sk` char(10) NOT NULL,
  `nama_sk` varchar(100) DEFAULT NULL,
  `ak1` varchar(30) DEFAULT NULL,
  `target_kuant` int(3) DEFAULT NULL,
  `target_kual` int(3) DEFAULT NULL,
  `target_waktu` int(2) DEFAULT NULL,
  `target_biaya` double DEFAULT NULL,
  `ak2` varchar(30) DEFAULT NULL,
  `real_kuant` int(3) DEFAULT NULL,
  `real_kual` int(3) DEFAULT NULL,
  `real_waktu` int(2) DEFAULT NULL,
  `real_biaya` double DEFAULT NULL,
  `nip` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sasaran_kerja`
--

INSERT INTO `sasaran_kerja` (`id_sk`, `nama_sk`, `ak1`, `target_kuant`, `target_kual`, `target_waktu`, `target_biaya`, `ak2`, `real_kuant`, `real_kual`, `real_waktu`, `real_biaya`, `nip`) VALUES
('AqsQfiMYU8', 'Menyusun laporan pelaksanaan tugas', '-', 1, 100, 12, 0, '-', 1, 90, 12, 0, '111245352352654643');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(3) NOT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `level` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
('U01', 'admin', 'admin', 'Admin'),
('U02', 'kepala', 'kepala', 'Kepala Bagian'),
('U03', 'direktur', 'direktur', 'Direktur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `sasaran_kerja`
--
ALTER TABLE `sasaran_kerja`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
