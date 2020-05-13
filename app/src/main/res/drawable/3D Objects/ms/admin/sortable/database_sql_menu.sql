-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Vert: localhost
-- Generert den: 05. Jul, 2012 17:32 PM
-- Tjenerversjon: 5.5.8
-- PHP-Versjon: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sortable`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rang` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dataark for tabell `menu`
--

INSERT INTO `menu` (`id`, `rang`, `parent_id`, `name`, `description`) VALUES
(1, 0, 0, 'About us', ''),
(2, 0, 1, 'Person 1', ''),
(3, 0, 1, 'Person 2', ''),
(4, 0, 2, 'My CV', ''),
(5, 0, 0, 'Gallery', ''),
(6, 0, 0, 'Contact us', ''),
(7, 0, 2, 'My pictures', ''),
(8, 0, 2, 'Contactinfo', '');
