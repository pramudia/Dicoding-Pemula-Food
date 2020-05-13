-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2017 at 05:42 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `kd_dosen` char(5) NOT NULL,
  `nm_dosen` varchar(30) default NULL,
  `no_telp` char(15) default NULL,
  `email` varchar(70) NOT NULL,
  PRIMARY KEY  (`kd_dosen`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`kd_dosen`, `nm_dosen`, `no_telp`, `email`) VALUES
('AAS', 'Achmadi Agus Sunanto', '85123456789', 'achmadi.ti@gmail.com'),
('DS', 'Deni Sutaji', '851234567890', 'asep@gmail.com'),
('A', 'Aditya, S.Kom', NULL, ''),
('AIM', 'Achmad Irfan Muzni, M.Psii', '081994420024', 'sayamasihgoblog@gmail.com'),
('ASW', 'Awang Setiawan Wicaksono, M.Ps', NULL, ''),
('DNS', 'Dian Nur Santi, S.Kom', NULL, ''),
('DTH', 'Dian Tri Harsa, S.Kom', NULL, ''),
('EP', 'Eko Prasetyo, S.Kom., M.Kom', NULL, ''),
('YP', 'Yulianti Pratiwi, S.Kom., M.Ko', '0', '0'),
('I', 'Ilham, S.Kom., M.Kom', NULL, ''),
('KZ', 'Drs. Khoiruz Zimam, Msi', NULL, ''),
('MA', 'M. Arif, SPd.,MPd', NULL, ''),
('MFA', 'M Farid Armiansyah, S.Kom', NULL, ''),
('MFR', 'M Fakhrul Rozy', NULL, ''),
('MJ', 'M Jazuli Ismail, S.Kom', NULL, ''),
('MSU', 'DR. H. M Syaifuddin Umar, M.H', NULL, ''),
('MT', 'M. Thohar, S.Kom', NULL, ''),
('MTQ', 'M Taufiqullah, M.Pdi I', NULL, ''),
('MY', 'Muyasaroh, S.Ag.,M.Pdi I', NULL, ''),
('NH', 'Nur Hakim, S.Kom', NULL, ''),
('RD', 'Rohman Dijaya, S.Kom', NULL, ''),
('RI', 'Rudi Ihwono, S.Kom', NULL, ''),
('RNS', 'Rima Noor Syafitri, S.Kom', NULL, ''),
('SA', 'Soffiana Agustin, S.Kom.,M.Kom', NULL, ''),
('TS', 'Tanfaus Sakinah, S.Kom', NULL, ''),
('TW', 'Titit Yuniarti, M.Pd', NULL, ''),
('UC', 'Umi Chotijah, S.Kom', NULL, ''),
('UH', 'Ubaidillah Husni, S.Kom', NULL, ''),
('WS', 'Wasis Supeno', NULL, ''),
('ASDS', 'Asisten Dosen', NULL, ''),
('D1_BI', 'D1 B. INGGRIS', NULL, ''),
('HR', 'HARUNUR ROSYID', '0', '0'),
('NS', 'NAUFAL SYAUQI SIIP', '085733662408', 'naufal.syauqi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL auto_increment,
  `kd_matkul` char(7) default NULL,
  `kd_dosen` char(5) default NULL,
  `kd_ruang` char(10) default NULL,
  `jam` char(5) default NULL,
  `hari` char(10) default NULL,
  `kelas` char(2) default NULL,
  `waktu` varchar(10) NOT NULL,
  `thn_ajaran` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=203 ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `kd_matkul`, `kd_dosen`, `kd_ruang`, `jam`, `hari`, `kelas`, `waktu`, `thn_ajaran`) VALUES
(1, 'SIM', 'HR', 'D3.20', 'I', 'SENIN', 'A', 'SORE', '2013/2014 GANJIL'),
(2, 'BIG', 'UC', 'D3.19', 'I', 'SENIN', 'A', 'SORE', '2013/2014 GANJIL'),
(3, 'SK', 'MA', 'F3.13', 'I', 'SENIN', 'A', 'SORE', '2013/2014 GANJIL'),
(4, 'PBO', 'RD', 'F3.14', 'I', 'SENIN', 'B', 'SORE', '2013/2014 GANJIL'),
(195, 'PJ', 'NH', 'Lap RPL', 'II', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(196, 'PPTI', 'ASDS', 'Lap ALGO', 'I', 'SENIN', 'B1', 'SORE', '2013/2014 GANJIL'),
(8, 'LI', 'DNS', 'D3.19', 'II', 'SENIN', 'B', 'SORE', '2013/2014 GANJIL'),
(9, 'SIM', 'HR', 'D3.20', 'II', 'SENIN', 'B', 'SORE', '2013/2014 GANJIL'),
(10, 'SK', 'MA', 'F3.13', 'II', 'SENIN', 'B', 'SORE', '2013/2014 GANJIL'),
(11, 'PBO', 'RD', 'F3.14', 'II', 'SENIN', 'A', 'SORE', '2013/2014 GANJIL'),
(197, 'PPTI', 'ASDS', 'Lap RPL', 'I', 'SENIN', 'B2', 'SORE', '2013/2014 GANJIL'),
(15, 'ED', 'RI', 'D3.19', 'I', 'SELASA', 'A', 'SORE', '2013/2014 GANJIL'),
(16, 'PCD', 'MFR', 'D3.20', 'I', 'SELASA', 'A', 'SORE', '2013/2014 GANJIL'),
(17, 'KAP', 'AIM', 'F3.14', 'I', 'SELASA', 'A', 'SORE', '2013/2014 GANJIL'),
(18, 'RPL', 'I', 'Lap SBC', 'I', 'SELASA', 'B', 'SORE', '2013/2014 GANJIL'),
(19, 'PPBO', 'ASDS', 'Lap ALGO', 'I', 'SELASA', 'B1', 'SORE', '2013/2014 GANJIL'),
(20, 'PPBO', 'ASDS', 'Lap RPL', 'I', 'SELASA', 'B2', 'SORE', '2013/2014 GANJIL'),
(21, 'LI', 'DNS', 'D3.19', 'II', 'SELASA', 'A', 'SORE', '2013/2014 GANJIL'),
(22, 'GK', 'SA', 'F3.13', 'II', 'SELASA', 'A', 'SORE', '2013/2014 GANJIL'),
(23, 'KM', 'AAS', 'F3.14', 'II', 'SELASA', 'A', 'SORE', '2013/2014 GANJIL'),
(24, 'PJ', 'NH', 'Lap SBC', 'II', 'SELASA', 'B', 'SORE', '2013/2014 GANJIL'),
(25, 'ED', 'RI', 'D3.19', 'I', 'RABU', 'B', 'SORE', '2013/2014 GANJIL'),
(26, 'KA_I', 'YP', 'D3.20', 'I', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(27, 'SD', 'RD', 'F3.13', 'I', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(28, 'IMK', 'MU', 'F3.14', 'I', 'RABU', 'B', 'SORE', '2013/2014 GANJIL'),
(29, 'IR', 'MFA', 'Lap SBC', 'I', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(30, 'PPW', 'ASDS', 'Lap ALGO', 'I', 'RABU', 'B1', 'SORE', '2013/2014 GANJIL'),
(31, 'PPW', 'ASDS', 'Lap RPL', 'I', 'RABU', 'B2', 'SORE', '2013/2014 GANJIL'),
(32, 'PPKN', 'KZ', 'D3.19', 'II', 'RABU', 'B', 'SORE', '2013/2014 GANJIL'),
(33, 'PTI', 'DTH', 'D3.20', 'II', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(34, 'SD', 'RI', 'F3.13', 'II', 'RABU', 'B', 'SORE', '2013/2014 GANJIL'),
(35, 'IMK', 'I', 'F3.14', 'II', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(36, 'IR', 'MFA', 'Lap SBC', 'II', 'RABU', 'B', 'SORE', '2013/2014 GANJIL'),
(37, 'PJ', 'NH', 'Lap PRL', 'II', 'RABU', 'A', 'SORE', '2013/2014 GANJIL'),
(38, 'BIG', 'UC', 'D3.19', 'I', 'KAMIS', 'B', 'SORE', '2013/2014 GANJIL'),
(39, 'PAI', 'MTQ', 'D3.20', 'I', 'KAMIS', 'A', 'SORE', '2013/2014 GANJIL'),
(40, 'SPK', 'DS', 'F3.13', 'I', 'KAMIS', 'B', 'SORE', '2013/2014 GANJIL'),
(41, 'KAP', 'ASW', 'F3.14', 'I', 'KAMIS', 'B', 'SORE', '2013/2014 GANJIL'),
(42, 'DWDM', 'EP', 'Lap SBC', 'I', 'KAMIS', 'A', 'SORE', '2013/2014 GANJIL'),
(43, 'PPBO', 'ASDS', 'Lap ALGO', 'I', 'KAMIS', 'A1', 'SORE', '2013/2014 GANJIL'),
(44, 'PPBO', 'ASDS', 'Lap RPL', 'I', 'KAMIS', 'A2', 'SORE', '2013/2014 GANJIL'),
(45, 'GK', 'SA', 'D3.19', 'II', 'KAMIS', 'B', 'SORE', '2013/2014 GANJIL'),
(46, 'PAI', 'MTQ', 'D3.20', 'II', 'KAMIS', 'B', 'SORE', '2013/2014 GANJIL'),
(47, 'SPK', 'DS', 'F3.13', 'II', 'KAMIS', 'A', 'SORE', '2013/2014 GANJIL'),
(48, 'KM', 'AAS', 'F3.14', 'II', 'KAMIS', 'B', 'SORE', '2013/2014 GANJIL'),
(49, 'PCD', 'MFR', 'D3.19', 'I', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(50, 'KA_I', 'YP', 'D3.20', 'I', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(51, 'MN', 'UH', 'F3.13', 'I', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(52, 'AIK_II', 'AM', 'F3.14', 'I', 'JUMAT', 'A', 'SORE', '2013/2014 GANJIL'),
(53, 'PW', 'DS', 'Lap SBC', 'I', 'JUMAT', 'A', 'SORE', '2013/2014 GANJIL'),
(54, 'PPKN', 'KZ', 'D3.19', 'II', 'JUMAT', 'A', 'SORE', '2013/2014 GANJIL'),
(55, 'PTI', 'DTH', 'D3.20', 'II', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(56, 'MN', 'UH', 'F3.13', 'II', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(57, 'AIK_II', 'AM', 'F3.14', 'II', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(58, 'PPW', 'ASDS', 'Lap ALGO', 'II', 'JUMAT', 'A1', 'SORE', '2013/2014 GANJIL'),
(59, 'PPW', 'ASDS', 'Lap RPL', 'II', 'JUMAT', 'A2', 'SORE', '2013/2014 GANJIL'),
(60, 'D1_BIG', 'D1_BI', 'D3.19', 'I', 'SENIN', 'A', 'PAGI', '2013/2014 GANJIL'),
(61, 'D1_BIG', 'D1_BI', 'D3.20', 'I', 'SENIN', 'B', 'PAGI', '2013/2014 GANJIL'),
(62, 'KAP', 'ASW', 'F3.13', 'I', 'SENIN', 'B', 'PAGI', '2013/2014 GANJIL'),
(63, 'SD', 'RD', 'F3.14', 'I', 'SENIN', 'A', 'PAGI', '2013/2014 GANJIL'),
(64, 'DWDM', 'EP', 'Lap SBC', 'I', 'SENIN', 'A', 'PAGI', '2013/2014 GANJIL'),
(65, 'PJ', 'WS', 'D3.19', 'II', 'SENIN', 'B', 'PAGI', '2013/2014 GANJIL'),
(66, 'LI', 'TS', 'D3.20', 'II', 'SENIN', 'A', 'PAGI', '2013/2014 GANJIL'),
(67, 'SD', 'RD', 'F3.14', 'II', 'SENIN', 'B', 'PAGI', '2013/2014 GANJIL'),
(68, 'DWDM', 'EP', 'Lap SBC', 'II', 'SENIN', 'B', 'PAGI', '2013/2014 GANJIL'),
(69, 'PPBO', 'ASDS', 'Lap ALGO', 'II', 'SENIN', 'A1', 'PAGI', '2013/2014 GANJIL'),
(70, 'PPBO', 'ASDS', 'Lap PRL', 'II', 'SENIN', 'A2', 'PAGI', '2013/2014 GANJIL'),
(71, 'PJ', 'WS', 'D3.19', 'III', 'SENIN', 'A', 'PAGI', '2013/2014 GANJIL'),
(72, 'LI', 'TS', 'D3.20', 'III', 'SENIN', 'B', 'PAGI', '2013/2014 GANJIL'),
(73, 'PPBO', 'ASDS', 'Lap ALGO', 'III', 'SENIN', 'B1', 'PAGI', '2013/2014 GANJIL'),
(74, 'PPBO', 'ASDS', 'Lap PRL', 'III', 'SENIN', 'B2', 'PAGI', '2013/2014 GANJIL'),
(75, 'D1_BIG', 'D1_BI', 'D3.19', 'I', 'SELASA', 'A', 'PAGI', '2013/2014 GANJIL'),
(76, 'D1_BIG', 'D1_BI', 'D3.20', 'I', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(77, 'MN', 'UC', 'F3.13', 'I', 'SELASA', 'A', 'PAGI', '2013/2014 GANJIL'),
(78, 'IMK', 'I', 'F3.14', 'I', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(79, 'PPW', 'ASDS', 'Lap ALGO', 'I', 'SELASA', 'A1', 'PAGI', '2013/2014 GANJIL'),
(80, 'PPW', 'ASDS', 'Lap RPL', 'I', 'SELASA', 'A2', 'PAGI', '2013/2014 GANJIL'),
(81, 'PAI', 'MY', 'D3.19', 'II', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(82, 'KA_I', 'YP', 'D3.20', 'II', 'SELASA', 'A', 'PAGI', '2013/2014 GANJIL'),
(83, 'AIK_II', 'AM', 'F3.13', 'II', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(84, 'KM', 'AAS', 'F3.14', 'II', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(85, 'RPL', 'I', 'Lap SBC', 'II', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(86, 'PAI', 'MY', 'D3.19', 'III', 'SELASA', 'A', 'PAGI', '2013/2014 GANJIL'),
(87, 'KA_I', 'YP', 'D3.20', 'III', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(88, 'SIM', 'HR', 'F3.13', 'III', 'SELASA', 'A', 'PAGI', '2013/2014 GANJIL'),
(89, 'SPK', 'MFA', 'Lap SBC', 'III', 'SELASA', 'B', 'PAGI', '2013/2014 GANJIL'),
(90, 'D1_BIG', 'D1_BI', 'D3.19', 'I', 'RABU', 'A', 'PAGI', '2013/2014 GANJIL'),
(91, 'D1_BIG', 'D1_BI', 'D3.20', 'I', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(92, 'PBO', 'RD', 'F3.14', 'I', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(93, 'IR', 'RNS', 'Lap SBC', 'I', 'RABU', 'A', 'PAGI', '2013/2014 GANJIL'),
(94, 'PPW', 'ASDS', 'Lap ALGO', 'I', 'RABU', 'B1', 'PAGI', '2013/2014 GANJIL'),
(95, 'PPW', 'ASDS', 'Lap RPL', 'I', 'RABU', 'B2', 'PAGI', '2013/2014 GANJIL'),
(96, 'PTI', 'MT', 'D3.19', 'II', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(97, 'ED', 'MJ', 'D3.20', 'II', 'RABU', 'A', 'PAGI', '2013/2014 GANJIL'),
(98, 'SK', 'YP', 'F3.13', 'II', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(99, 'PBO', 'RD', 'F3.14', 'II', 'RABU', 'A', 'PAGI', '2013/2014 GANJIL'),
(100, 'IR', 'RNS', 'Lap SBC', 'II', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(101, 'PTI', 'MT', 'D3.19', 'III', 'RABU', 'A', 'PAGI', '2013/2014 GANJIL'),
(102, 'ED', 'MJ', 'D3.20', 'III', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(103, 'SK', 'YP', 'F3.13', 'III', 'RABU', 'A', 'PAGI', '2013/2014 GANJIL'),
(104, 'SIM', 'HR', 'F3.14', 'III', 'RABU', 'B', 'PAGI', '2013/2014 GANJIL'),
(105, 'D1_BIG', 'D1_BI', 'D3.19', 'I', 'KAMIS', 'A', 'PAGI', '2013/2014 GANJIL'),
(106, 'D1_BIG', 'D1_BI', 'D3.20', 'I', 'KAMIS', 'B', 'PAGI', '2013/2014 GANJIL'),
(107, 'MN', 'UC', 'F3.13', 'I', 'KAMIS', 'B', 'PAGI', '2013/2014 GANJIL'),
(108, 'IMK', 'I', 'F3.14', 'I', 'KAMIS', 'A', 'PAGI', '2013/2014 GANJIL'),
(109, 'PPKN', 'MSU', 'D3.19', 'II', 'KAMIS', 'A', 'PAGI', '2013/2014 GANJIL'),
(110, 'GK', 'SA', 'F3.13', 'II', 'KAMIS', 'A', 'PAGI', '2013/2014 GANJIL'),
(111, 'KM', 'AAS', 'F3.14', 'II', 'KAMIS', 'B', 'PAGI', '2013/2014 GANJIL'),
(112, 'RPL', 'I', 'Lap SBC', 'II', 'KAMIS', 'A', 'PAGI', '2013/2014 GANJIL'),
(113, 'PPKN', 'MSU', 'D3.19', 'III', 'KAMIS', 'B', 'PAGI', '2013/2014 GANJIL'),
(114, 'GK', 'SA', 'F3.13', 'III', 'KAMIS', 'B', 'PAGI', '2013/2014 GANJIL'),
(115, 'SPK', 'RNS', 'Lap SBC', 'III', 'KAMIS', 'A', 'PAGI', '2013/2014 GANJIL'),
(116, 'D1_BIG', 'D1_BI', 'D3.19', 'I', 'JUMAT', 'A', 'PAGI', '2013/2014 GANJIL'),
(117, 'D1_BIG', 'D1_BI', 'D3.20', 'I', 'JUMAT', 'B', 'PAGI', '2013/2014 GANJIL'),
(118, 'PW', 'DS', 'F3.13', 'I', 'JUMAT', 'B', 'PAGI', '2013/2014 GANJIL'),
(119, 'AIK_II', 'AM', 'F3.14', 'I', 'JUMAT', 'A', 'PAGI', '2013/2014 GANJIL'),
(120, 'PCD', 'A', 'Lap SBC', 'I', 'JUMAT', 'A', 'PAGI', '2013/2014 GANJIL'),
(121, 'KAP', 'AIM', 'D3.20', 'III', 'JUMAT', 'A', 'PAGI', '2013/2014 GANJIL'),
(122, 'PW', 'DS', 'F3.13', 'III', 'JUMAT', 'A', 'PAGI', '2013/2014 GANJIL'),
(123, 'PCD', 'A', 'Lap SBC', 'III', 'JUMAT', 'B', 'PAGI', '2013/2014 GANJIL'),
(124, 'PPTI', 'ASDS', 'Lap ALGO', 'II', 'JUMAT', 'A1', 'PAGI', '2013/2014 GANJIL'),
(125, 'PPTI', 'ASDS', 'Lap RPL', 'II', 'JUMAT', 'A2', 'PAGI', '2013/2014 GANJIL'),
(126, 'PPTI', 'ASDS', 'Lap ALGO', 'III', 'JUMAT', 'B1', 'PAGI', '2013/2014 GANJIL'),
(127, 'PPTI', 'ASDS', 'Lap RPL', 'III', 'JUMAT', 'B2', 'PAGI', '2013/2014 GANJIL'),
(194, 'DWDM', 'MFR', 'Lap SBC', 'I', 'SENIN', 'B', 'SORE', '2013/2014 GANJIL'),
(193, 'RPL', 'I', 'Lap SBC', 'II', 'SENIN', 'A', 'SORE', '2013/2014 GANJIL'),
(198, 'PPTI', 'ASDS', 'Lap ALGO', 'II', 'SENIN', 'A1', 'SORE', '2013/2014 GANJIL'),
(200, 'PW', 'DS', 'Lap SBC', 'II', 'JUMAT', 'B', 'SORE', '2013/2014 GANJIL'),
(199, 'PPTI', 'ASDS', 'Lap RPL', 'II', 'SENIN', 'A2', 'SORE', '2013/2014 GANJIL'),
(192, 'GK', 'SA', 'F3.13', 'II', 'SELASA', 'B', 'SORE', 'UAS GANJIL 2013/2014'),
(191, 'LI', 'DNS', 'D3.19', 'II', 'SELASA', 'A', 'SORE', 'UAS GANJIL 2013/2014'),
(190, 'RPL', 'I', 'Lap SBC', 'I', 'SELASA', 'B', 'SORE', 'UAS GANJIL 2013/2014'),
(189, 'PCD', 'MFR', 'F3.13', 'I', 'SELASA', 'A', 'SORE', 'UAS GANJIL 2013/2014'),
(187, 'PW', 'DS', 'Lap SBC', 'II', 'SENIN', 'A', 'SORE', 'UAS GANJIL 2013/2014'),
(186, 'SIM', 'HR', 'F3.13', 'II', 'SENIN', 'B', 'SORE', 'UAS GANJIL 2013/2014'),
(185, 'LI', 'DNS', 'D3.19', 'II', 'SENIN', 'B', 'SORE', 'UAS GANJIL 2013/2014'),
(184, 'PW', 'DS', 'Lap SBC', 'I', 'SENIN', 'B', 'SORE', 'UAS GANJIL 2013/2014'),
(183, 'SIM', 'HR', 'F3.13', 'I', 'SENIN', 'A', 'SORE', 'UAS GANJIL 2013/2014'),
(182, 'BIG', 'UC', 'D3.19', 'I', 'SENIN', 'A', 'SORE', 'UAS GANJIL 2013/2014'),
(188, 'ED', 'RI', 'D3.19', 'I', 'SELASA', 'A', 'SORE', 'UAS GANJIL 2013/2014'),
(202, 'ADSI', 'AAS', 'D3.19', 'I', 'SENIN', 'A1', 'PAGI', '2016/ 2017');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kd_matkul` char(7) NOT NULL,
  `nm_matkul` varchar(100) default NULL,
  `semester` char(5) default NULL,
  `sks` tinyint(3) NOT NULL,
  `jml_pngambil` int(5) default NULL,
  PRIMARY KEY  (`kd_matkul`),
  UNIQUE KEY `kd_matkul` (`kd_matkul`,`nm_matkul`,`semester`,`sks`,`jml_pngambil`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kd_matkul`, `nm_matkul`, `semester`, `sks`, `jml_pngambil`) VALUES
('ADSI', 'ANALISIS DAN DESAIN SISTEM INFORMASI', '2', 3, 44),
('AIK_I', 'AL ISLAM DAN KEMUHAMMADIYAHAN  I', '2', 2, 40),
('AIK_II', 'AL ISLAM DAN KEMUHAMMADIYAHAN  II', '1', 2, 30),
('AIK_III', 'AL ISLAM DAN KEMUHAMMADIYAHAN  III', '1', 2, 33),
('ALM', 'ALJABAR LINIER DAN MATRIK', '2', 3, NULL),
('ATI', 'AUDIT TEKNOLOGI INFORMASI', '1', 3, 30),
('BBD', 'BERKAS DAN BASIS DATA', '1', 3, 22),
('BIG', 'BAHASA INGGRIS', '1', 3, NULL),
('BIN', 'BAHASA INDONESIA', '2', 3, NULL),
('CV', 'COMPUTER VISION', '2', 3, 33),
('D1_BIG', 'D1 B. INGGRIS', '1', 3, 40),
('DWDM', 'DATA WAREHOUSE DAN DATA MINING', 'MP', 3, 30),
('ECEB', 'E-COMMERCE DAN E-BUSINESS', '6', 3, NULL),
('ED', 'ELEKTRONIKA DIGITAL', '1', 3, NULL),
('EP', 'ETIKA PROFESI', '6', 2, NULL),
('ERP', 'ENTERPRISE RESOURCE PLANNING', '7', 3, NULL),
('GK', 'GRAFIKA KOMPUTER', '3', 3, NULL),
('IMK', 'INTERAKSI MANUSIA DAN KOMPUTER', '5', 3, NULL),
('IR', 'INFORMATION RETRIEVAL', 'MP', 3, 30),
('ISBD', 'ILMU SOSIAL DAN BUDAYA DASAR', '4', 3, NULL),
('JK', 'JARINGAN KOMPUTER', '4', 3, NULL),
('JNKB', 'JARINGAN NIRKABEL DAN KOMPUTAS', '6', 3, NULL),
('KAP', 'KECAKAPAN ANTAR PERSONAL', '3', 2, NULL),
('KA_I', 'KALKULUS I', '1', 3, NULL),
('KA_II', 'KALKULUS II', '2', 3, NULL),
('KM', 'KOMPUTER DAN MASYARAKAT', '5', 2, NULL),
('LF', 'LOGIKA FUZZY', '7', 3, NULL),
('LI', 'LOGIKA INFORMATIKA I', '1', 3, NULL),
('MD', 'MATEMATIKA DISKRIT', '2', 3, NULL),
('MJK', 'MANAJEMEN JARINGAN KOMPUTER', '7', 3, NULL),
('MN', 'METODE NUMERIK', '3', 3, NULL),
('MPTI', 'MANAJEMEN PROYEK TEKNOLOGI INFORMASI', '7', 3, NULL),
('MS', 'MANAJEMEN SAINS', '4', 3, NULL),
('OAK', 'ORGANISASI DAN ARSITEKTUR KOMPUTER', '2', 3, NULL),
('PAI', 'PENDIDIKAN AGAMA ISLAM', '1', 2, NULL),
('PAP', 'PRAKTIKUM ALGORITMA DAN PEMROGRAMAN', '2', 1, NULL),
('PBO', 'PEMROGRAMAN BERORIENTASI OBYEK', '3', 3, NULL),
('PCD', 'PENGOLAHAN CITRA DIGITAL', 'MP', 3, 30),
('PJ', 'PEMROGRAMAN JARINGAN', 'MP', 3, 30),
('PJK', 'PRAKTIKUM JARINGAN KOMPUTER', '4', 1, NULL),
('PKB', 'PENGANTAR KECERDASAN BUATAN', '4', 3, NULL),
('PP', 'PENGENALAN POLA', '7', 3, NULL),
('PPBO', 'PRAKTIKUM PEMROGRAMAN BERORIENTASI OBJEK', '3', 1, NULL),
('PPKN', 'PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN', '1', 3, NULL),
('PPTI', 'PRAKTIKUM PENGANTAR TEKNOLOGI INFORMASI', '1', 1, NULL),
('PPW', 'PRAKTIKUM PEMROGRAMAN WEB', '5', 1, NULL),
('PSBD', 'PRAKTIKUM SISTEM BASIS DATA', '4', 1, NULL),
('PTI', 'PENGANTAR TEKNOLOGI INFORMASI', '1', 3, NULL),
('PW', 'PEMROGRAMAN WEB', '5', 3, NULL),
('RK', 'REKAYASA KEBUTUHAN', '8', 3, NULL),
('RPL', 'REKAYASA PERANGKAT LUNAK', '5', 3, NULL),
('RTI', 'RISET TEKNOLOGI INFORMASI', '6', 3, NULL),
('SBD', 'Sistem Basisi Data', '3', 3, 35),
('SD', 'STRUKTUR DATA', '3', 3, NULL),
('SIG', 'SISTEM INFORMASI GEOGRAFIS', '7', 3, NULL),
('SIM', 'SISTEM INFORMASI MANAJEMEN', '5', 3, NULL),
('SK', 'STATISTIK KOMPUTASI', '3', 3, NULL),
('SMBD', 'SISTEM MANAJEMEN BASIS DATA', '7', 3, NULL),
('SO', 'SISTEM OPERASI', '4', 3, NULL),
('SP', 'SISTEM PAKAR', '7', 3, NULL),
('SPK', 'SISTEM PENDUKUNG KEPUTUSAN', 'MP', 3, 20),
('ST', 'SISTEM TERDISTRIBUSI', '7', 3, NULL),
('TBA', 'TEORI BAHASA DAN AUTOMATA', '6', 3, NULL),
('TM', 'TEKNIK MULTIMEDIA', '8', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `kd_ruang` char(10) NOT NULL,
  `kapasitas` int(10) default NULL,
  PRIMARY KEY  (`kd_ruang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`kd_ruang`, `kapasitas`) VALUES
('D3.19', 30),
('D3.20', 30),
('F3.13', 30),
('F3.14', 30),
('Lap SBC', 30),
('Lap ALGO', 30),
('Lap RPL', 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) default NULL,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `deskripsi`) VALUES
('admin', 'admin', 'admin');
