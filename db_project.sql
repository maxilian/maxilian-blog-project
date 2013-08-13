-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2013 at 07:09 PM
-- Server version: 5.5.10
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `kategori_deskripsi` varchar(123) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_deskripsi`) VALUES
(0, 'sdasdasd', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `table_post`
--

CREATE TABLE IF NOT EXISTS `table_post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `web_title` varchar(1000) NOT NULL,
  `web_description` varchar(1000) NOT NULL,
  `web_post` varchar(1000) NOT NULL,
  `web_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `web_keyword` varchar(1234) NOT NULL,
  `nama_kategori` varchar(1234) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `table_post`
--

INSERT INTO `table_post` (`id_post`, `web_title`, `web_description`, `web_post`, `web_tanggal`, `web_keyword`, `nama_kategori`, `id_kategori`) VALUES
(2, 'asdsadsadsad', 'asdasd', '<p>asdasdasdasdasfwfwefwef</p>', '2013-02-21 19:07:47', 'asdsadasd', 'sdasdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(15) NOT NULL,
  `user_password` varchar(15) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_username`, `user_password`) VALUES
(1, 'maxilian', 'adalah');
