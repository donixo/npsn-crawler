-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2011 at 02:52 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dapodik`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE IF NOT EXISTS `kabupaten` (
  `kabupaten_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(32) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  PRIMARY KEY (`kabupaten_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=499 ;

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `provinsi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `kode` varchar(32) NOT NULL,
  PRIMARY KEY (`provinsi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE IF NOT EXISTS `sekolah` (
  `sekolah_id` int(11) NOT NULL AUTO_INCREMENT,
  `npsn` varchar(255) NOT NULL,
  `nama` varchar(512) NOT NULL,
  `alamat` varchar(512) NOT NULL,
  `status` varchar(64) NOT NULL,
  `jm_siswa_l` int(11) NOT NULL,
  `jm_siswa_p` int(11) NOT NULL,
  `jm_siswa_total` int(11) NOT NULL,
  `jm_guru_l` int(11) NOT NULL,
  `jm_guru_p` int(11) NOT NULL,
  `jm_guru_total` int(11) NOT NULL,
  `jm_ruang_kelas` int(11) NOT NULL,
  `jm_operator` int(11) NOT NULL,
  `kabupaten_id` int(11) NOT NULL,
  `tipe_sekolah` int(11) NOT NULL,
  PRIMARY KEY (`sekolah_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=345227 ;
