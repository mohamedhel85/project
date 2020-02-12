-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 12, 2020 at 03:03 PM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ischool`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `id_club` int(11) NOT NULL AUTO_INCREMENT,
  `nom_club` varchar(255) NOT NULL,
  `desc_club` varchar(255) NOT NULL,
  `logo_club` varchar(255) NOT NULL,
  PRIMARY KEY (`id_club`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `Id_note` varchar(10) NOT NULL,
  `Id_user` int(10) NOT NULL,
  `Id_matiere` int(10) NOT NULL,
  `note` float NOT NULL,
  PRIMARY KEY (`Id_note`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `ID_session` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  PRIMARY KEY (`ID_session`),
  KEY `ID_user` (`ID_user`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`ID_session`, `ID_user`) VALUES
(19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_user` int(8) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Num_tel` int(11) NOT NULL,
  `Role_user` varchar(30) NOT NULL,
  `Etat` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_user`, `Nom`, `Prenom`, `Email`, `Mdp`, `Num_tel`, `Role_user`, `Etat`) VALUES
(1, 'mohamed', 'helali', 'mohamed.helali@esprit.tn', 'test', 55151858, 'STAFF', 'UNLOCKED'),
(2, 'Ali', 'Nait', 'ali@gmail.com', 'azerty', 9587641, 'ELEVE', 'LOCKED'),
(3, 'azer', 'abidi', 'azer.abidi@gmail.com', '46zaer', 25468451, 'ELEVE', 'UNLOCKED');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
