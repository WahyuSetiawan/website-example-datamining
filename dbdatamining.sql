-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2014 at 08:53 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `800835`
--

-- --------------------------------------------------------

--
-- Table structure for table `atribut`
--

CREATE TABLE IF NOT EXISTS `atribut` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `atribut` varchar(100) NOT NULL,
  `nilai_atribut` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `atribut`
--

INSERT INTO `atribut` (`id`, `atribut`, `nilai_atribut`) VALUES
(1, 'total', 'total'),
(2, 'jenis_kelamin', 'L'),
(3, 'jenis_kelamin', 'P'),
(4, 'tahun', '2011'),
(5, 'tahun', '2012'),
(6, 'semester', 'Ganjil'),
(7, 'semester', 'Genap'),
(8, 'agama', 'Islam'),
(9, 'agama', 'Budha'),
(10, 'agama', 'Katolik'),
(11, 'agama', 'Protestan'),
(12, 'mk_prasyarat', 'E-Commerce'),
(13, 'mk_prasyarat', 'Jarkom'),
(14, 'mk_prasyarat', 'Jarkom II'),
(15, 'mk_prasyarat', 'Metopen'),
(16, 'mk_prasyarat', 'MML'),
(17, 'mk_prasyarat', 'Multimedia'),
(18, 'mk_prasyarat', 'PBD'),
(19, 'mk_prasyarat', 'PW'),
(20, 'mk_prasyarat', 'SBD');

-- --------------------------------------------------------

--
-- Table structure for table `data_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `data_mahasiswa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nim` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `mk_prasyarat` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `data_mahasiswa`
--

INSERT INTO `data_mahasiswa` (`id`, `nim`, `tahun`, `semester`, `jenis_kelamin`, `agama`, `mk_prasyarat`, `nilai`, `class`) VALUES
(2, '11.11.5401', '2011', 'Ganjil', 'L', 'Islam', 'Jarkom', 'A', 'Ya'),
(3, '11.11.', '2011', 'Ganjil', 'L', 'Islam', 'SBD', 'D', 'Tidak'),
(4, '12.11.', '2012', 'Ganjil', 'L', 'Islam', 'Multimedia', 'B', 'Ya'),
(5, '11.11', '2011', 'Genap', 'L', 'Katolik', 'Jarkom II', 'B', 'Ya'),
(6, '11.11.', '2011', 'Genap', 'L', 'Islam', 'MML', 'C', 'Tidak'),
(7, '11.11.', '2011', 'Genap', 'L', 'Katolik', 'PW', 'A', 'Ya'),
(8, '12.11.', '2012', 'Ganjil', 'L', 'Budha', 'Jarkom', 'C', 'Tidak'),
(9, '11.11', '2011', 'Ganjil', 'L', 'Islam', 'Metopen', 'A', 'Tidak'),
(10, '11.11.', '2011', 'Ganjil', 'L', 'Protestan', 'SBD', 'B', 'Ya'),
(11, '11.11.', '2011', 'Genap', 'P', 'Islam', 'Jarkom II', 'E', 'Tidak'),
(12, '12.11.', '2012', 'Ganjil', 'P', 'Islam', 'Multimedia', 'A', 'Ya'),
(13, '11.11.', '2011', 'Ganjil', 'P', 'Katolik', 'E-Commerce', 'E', 'Tidak'),
(14, '11.11.', '2011', 'Ganjil', 'P', 'Protestan', 'PBD', 'B', 'Tidak'),
(15, '11.11.', '2011', 'Genap', 'L', 'Budha', 'PW', 'A', 'Tidak'),
(16, '11.11.', '2011', 'Genap', 'P', 'Islam', 'Jarkom II', 'C', 'Tidak'),
(17, '11.11', '2011', 'Ganjil', 'L', 'Islam', 'Jarkom', 'A', 'Ya'),
(18, '11.11', '2011', 'Ganjil', 'L', 'Islam', 'SBD', 'D', 'Tidak'),
(19, '12.11', '2012', 'Ganjil', 'L', 'Islam', 'Multimedia', 'B', 'Ya'),
(20, '11.11', '2011', 'Genap', 'L', 'Katolik', 'Jarkom II', 'B', 'Ya'),
(21, '11.11', '2011', 'Genap', 'L', 'Islam', 'MML', 'C', 'Tidak'),
(22, '11.11', '2011', 'Genap', 'L', 'Katolik', 'PW', 'A', 'Ya'),
(23, '12.11', '2012', 'Ganjil', 'L', 'Budha', 'Jarkom', 'C', 'Tidak'),
(24, '11.11.', '2011', 'Ganjil', 'L', 'Islam', 'Metopen', 'A', 'Tidak'),
(25, '11.11.', '2011', 'Ganjil', 'L', 'Protestan', 'SBD', 'B', 'Ya'),
(26, '11.11.', '2011', 'Genap', 'P', 'Islam', 'Jarkom II', 'E', 'Tidak'),
(27, '12.11', '2012', 'Ganjil', 'P', 'Islam', 'Multimedia', 'A', 'Ya'),
(28, '11.11', '2011', 'Ganjil', 'P', 'Katolik', 'E-Commerce', 'E', 'Tidak'),
(29, '11.11', '2011', 'Ganjil', 'P', 'Protestan', 'PBD', 'B', 'Tidak'),
(30, '11.11', '2011', 'Genap', 'L', 'Budha', 'PW', 'A', 'Tidak'),
(31, '11.11', '2011', 'Genap', 'P', 'Islam', 'Jarkom II', 'C', 'Tidak'),
(32, '11.11', '2011', 'Genap', 'L', 'Katolik', 'Jarkom II', 'B', 'Ya'),
(33, '11.11', '2011', 'Genap', 'L', 'Islam', 'MML', 'C', 'Tidak'),
(34, '11.11', '2011', 'Genap', 'L', 'Katolik', 'PW', 'A', 'Ya'),
(35, '12.11', '2012', 'Ganjil', 'L', 'Budha', 'Jarkom', 'C', 'Tidak'),
(36, '11.11', '2011', 'Ganjil', 'L', 'Islam', 'Metopen', 'A', 'Tidak'),
(37, '11.11', '2011', 'Ganjil', 'L', 'Protestan', 'SBD', 'B', 'Ya'),
(38, '11.11', '2011', 'Genap', 'P', 'Islam', 'Jarkom II', 'E', 'Tidak'),
(39, '12.11', '2012', 'Ganjil', 'P', 'Islam', 'Multimedia', 'A', 'Ya'),
(40, '11.11', '2011', 'Ganjil', 'P', 'Katolik', 'E-Commerce', 'E', 'Tidak'),
(41, '11.11', '2011', 'Ganjil', 'P', 'Protestan', 'PBD', 'B', 'Tidak'),
(42, '11.11', '2011', 'Genap', 'L', 'Budha', 'PW', 'A', 'Tidak'),
(43, '11.11', '2011', 'Genap', 'P', 'Islam', 'Jarkom II', 'C', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `mining_c45`
--

CREATE TABLE IF NOT EXISTS `mining_c45` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atribut` varchar(100) NOT NULL,
  `nilai_atribut` varchar(100) NOT NULL,
  `jml_kasus_total` varchar(5) NOT NULL,
  `jml_kasus_tidak` varchar(5) NOT NULL,
  `jml_kasus_ya` varchar(5) NOT NULL,
  `entropy` varchar(10) NOT NULL,
  `inf_gain` varchar(10) NOT NULL,
  `inf_gain_temp` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `mining_c45`
--

INSERT INTO `mining_c45` (`id`, `atribut`, `nilai_atribut`, `jml_kasus_total`, `jml_kasus_tidak`, `jml_kasus_ya`, `entropy`, `inf_gain`, `inf_gain_temp`) VALUES
(1, 'Total', 'Total', '11', '3', '8', '0.8454', '', ''),
(2, 'jenis_kelamin', 'L', '8', '0', '8', '0', '0.8454', '0'),
(3, 'jenis_kelamin', 'P', '3', '3', '0', '0', '0.8454', '0'),
(4, 'tahun', '2011', '9', '3', '6', '0.9183', '0.0941', '-0.7513363'),
(5, 'tahun', '2012', '2', '0', '2', '0', '0.0941', '0'),
(6, 'semester', 'Ganjil', '8', '3', '5', '0.9544', '0.1513', '-0.6941090'),
(7, 'semester', 'Genap', '3', '0', '3', '0', '0.1513', '0'),
(8, 'agama', 'Islam', '2', '0', '2', '0', '0.2999', '0'),
(9, 'agama', 'Budha', '0', '0', '0', '0', '0.2999', '0'),
(10, 'agama', 'Katolik', '3', '0', '3', '0', '0.2999', '0'),
(11, 'agama', 'Protestan', '6', '3', '3', '1', '0.2999', '-0.5454545'),
(12, 'mk_prasyarat', 'E-Commerce', '0', '0', '0', '0', '0.8454', '0'),
(13, 'mk_prasyarat', 'Jarkom', '0', '0', '0', '0', '0.8454', '0'),
(14, 'mk_prasyarat', 'Jarkom II', '3', '0', '3', '0', '0.8454', '0'),
(15, 'mk_prasyarat', 'Metopen', '0', '0', '0', '0', '0.8454', '0'),
(16, 'mk_prasyarat', 'MML', '0', '0', '0', '0', '0.8454', '0'),
(17, 'mk_prasyarat', 'Multimedia', '2', '0', '2', '0', '0.8454', '0'),
(18, 'mk_prasyarat', 'PBD', '3', '3', '0', '0', '0.8454', '0'),
(19, 'mk_prasyarat', 'PW', '0', '0', '0', '0', '0.8454', '0'),
(20, 'mk_prasyarat', 'SBD', '3', '0', '3', '0', '0.8454', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_temp`
--

CREATE TABLE IF NOT EXISTS `nilai_temp` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nilai` varchar(100) NOT NULL,
  `mk_prasyarat` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `nilai_temp`
--

INSERT INTO `nilai_temp` (`id`, `nilai`, `mk_prasyarat`, `jumlah`) VALUES
(1, 'A', 'Jarkom', '2'),
(2, 'D', 'SBD', '2'),
(3, 'A', 'Metopen', '3'),
(4, 'B', 'SBD', '3'),
(5, 'E', 'E-Commerce', '3'),
(6, 'B', 'PBD', '3'),
(7, 'A', 'Jarkom', '2'),
(8, 'D', 'SBD', '2'),
(9, 'A', 'Metopen', '3'),
(10, 'B', 'SBD', '3'),
(11, 'E', 'E-Commerce', '3'),
(12, 'B', 'PBD', '3'),
(13, 'A', 'Metopen', '3'),
(14, 'B', 'SBD', '3'),
(15, 'E', 'E-Commerce', '3'),
(16, 'B', 'PBD', '3');

-- --------------------------------------------------------

--
-- Table structure for table `pohon_keputusan_c45`
--

CREATE TABLE IF NOT EXISTS `pohon_keputusan_c45` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `atribut` varchar(100) NOT NULL,
  `nilai_atribut` varchar(100) NOT NULL,
  `id_parent` char(3) DEFAULT NULL,
  `jml_kasus_tidak` varchar(5) NOT NULL,
  `jml_kasus_ya` varchar(5) NOT NULL,
  `keputusan` varchar(100) NOT NULL,
  `diproses` varchar(10) NOT NULL,
  `kondisi_atribut` varchar(255) NOT NULL,
  `looping_kondisi` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pohon_keputusan_c45`
--

INSERT INTO `pohon_keputusan_c45` (`id`, `atribut`, `nilai_atribut`, `id_parent`, `jml_kasus_tidak`, `jml_kasus_ya`, `keputusan`, `diproses`, `kondisi_atribut`, `looping_kondisi`) VALUES
(1, 'nilai', 'A', '0', '6', '8', '?', 'Sudah', 'AND nilai = ~A~', 'Belum'),
(2, 'nilai', 'B', '0', '3', '8', '?', 'Sudah', 'AND nilai = ~B~', 'Belum'),
(3, 'nilai', 'C', '0', '9', '0', 'Tidak', 'Belum', 'AND nilai = ~C~', 'Belum'),
(4, 'nilai', 'D', '0', '2', '0', 'Tidak', 'Belum', 'AND nilai = ~D~', 'Belum'),
(5, 'nilai', 'E', '0', '6', '0', 'Tidak', 'Belum', 'AND nilai = ~E~', 'Belum'),
(6, 'mk_prasyarat', 'E-Commerce', '1', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~E-Commerce~', 'Sudah'),
(7, 'mk_prasyarat', 'Jarkom', '1', '0', '2', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~Jarkom~', 'Sudah'),
(8, 'mk_prasyarat', 'Jarkom II', '1', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~Jarkom II~', 'Sudah'),
(9, 'mk_prasyarat', 'Metopen', '1', '3', '0', 'Tidak', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~Metopen~', 'Sudah'),
(10, 'mk_prasyarat', 'MML', '1', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~MML~', 'Sudah'),
(11, 'mk_prasyarat', 'Multimedia', '1', '0', '3', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~Multimedia~', 'Sudah'),
(12, 'mk_prasyarat', 'PBD', '1', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~PBD~', 'Sudah'),
(13, 'mk_prasyarat', 'PW', '1', '3', '3', '?', 'Sudah', 'AND nilai = ~A~ AND mk_prasyarat = ~PW~', 'Sudah'),
(14, 'mk_prasyarat', 'SBD', '1', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~SBD~', 'Sudah'),
(15, 'agama', 'Islam', '13', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~PW~ AND agama = ~Islam~', 'Sudah'),
(16, 'agama', 'Budha', '13', '3', '0', 'Tidak', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~PW~ AND agama = ~Budha~', 'Sudah'),
(17, 'agama', 'Katolik', '13', '0', '3', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~PW~ AND agama = ~Katolik~', 'Sudah'),
(18, 'agama', 'Protestan', '13', '0', '0', 'Ya', 'Belum', 'AND nilai = ~A~ AND mk_prasyarat = ~PW~ AND agama = ~Protestan~', 'Sudah'),
(19, 'jenis_kelamin', 'L', '2', '0', '8', 'Ya', 'Belum', 'AND nilai = ~B~ AND jenis_kelamin = ~L~', 'Sudah'),
(20, 'jenis_kelamin', 'P', '2', '3', '0', 'Tidak', 'Belum', 'AND nilai = ~B~ AND jenis_kelamin = ~P~', 'Sudah');

-- --------------------------------------------------------

--
-- Table structure for table `rule_c45`
--

CREATE TABLE IF NOT EXISTS `rule_c45` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_parent` int(4) NOT NULL,
  `rule` varchar(255) NOT NULL,
  `keputusan` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `rule_c45`
--

INSERT INTO `rule_c45` (`id`, `id_parent`, `rule`, `keputusan`) VALUES
(2, 0, 'nilai == A AND mk_prasyarat == E-Commerce', 'Ya'),
(3, 0, 'nilai == A AND mk_prasyarat == Jarkom', 'Ya'),
(4, 0, 'nilai == A AND mk_prasyarat == Jarkom II', 'Ya'),
(5, 0, 'nilai == A AND mk_prasyarat == Metopen', 'Tidak'),
(6, 0, 'nilai == A AND mk_prasyarat == MML', 'Ya'),
(7, 0, 'nilai == A AND mk_prasyarat == Multimedia', 'Ya'),
(8, 0, 'nilai == A AND mk_prasyarat == PBD', 'Ya'),
(10, 0, 'nilai == A AND mk_prasyarat == PW AND agama == Islam', 'Ya'),
(11, 0, 'nilai == A AND mk_prasyarat == PW AND agama == Budha', 'Tidak'),
(12, 0, 'nilai == A AND mk_prasyarat == PW AND agama == Katolik', 'Ya'),
(13, 0, 'nilai == A AND mk_prasyarat == PW AND agama == Protestan', 'Ya'),
(14, 0, 'nilai == A AND mk_prasyarat == SBD', 'Ya'),
(16, 0, 'nilai == B AND jenis_kelamin == L', 'Ya'),
(17, 0, 'nilai == B AND jenis_kelamin == P', 'Tidak'),
(18, 0, 'nilai == C', 'Tidak'),
(19, 0, 'nilai == D', 'Tidak'),
(20, 0, 'nilai == E', 'Tidak');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
