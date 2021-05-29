-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 22 nov. 2020 à 21:48
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_annuaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `annuaire`
--

DROP TABLE IF EXISTS `annuaire`;
CREATE TABLE IF NOT EXISTS `annuaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(500) CHARACTER SET latin1 NOT NULL,
  `acceptation` varchar(20) CHARACTER SET latin1 NOT NULL,
  `user` varchar(500) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(500) CHARACTER SET latin1 NOT NULL,
  `lienretour` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `observations` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `datemodif` date DEFAULT NULL,
  `refsite` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `auteur` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=344 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure de la table `init_password`
--

DROP TABLE IF EXISTS `init_password`;
CREATE TABLE IF NOT EXISTS `init_password` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `token` varchar(1000) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `texte` mediumtext CHARACTER SET latin1 NOT NULL,
  `motcle` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER` varchar(20) CHARACTER SET latin1 NOT NULL,
  `MDP` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Email` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `niveaudroit` int(1) NOT NULL,
  `NOMPROFIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `PRENOMPROFIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


