-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 07 déc. 2019 à 17:15
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `surface`
--
CREATE DATABASE IF NOT EXISTS `surface` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `surface`;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) NOT NULL,
  `log_nom` varchar(250) NOT NULL,
  `log_adresse` varchar(250) NOT NULL,
  `log_cp` varchar(5) NOT NULL,
  `vil_id` int(11) NOT NULL,
  `typ_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_usr_id` (`usr_id`),
  KEY `fk_typ_id` (`typ_id`),
  KEY `fk_logement_ville1_idx` (`vil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `pce_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `pce_nom` varchar(250) NOT NULL,
  `pce_long` decimal(4,2) NOT NULL,
  `pce_larg` decimal(4,2) NOT NULL,
  PRIMARY KEY (`pce_id`),
  KEY `fk_log_id` (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type_logement`
--

DROP TABLE IF EXISTS `type_logement`;
CREATE TABLE IF NOT EXISTS `type_logement` (
  `typ_id` int(11) NOT NULL AUTO_INCREMENT,
  `typ_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`typ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_email` varchar(250) NOT NULL,
  `usr_password` varchar(250) NOT NULL,
  `usr_date_connexion` varchar(8) NOT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_email` (`usr_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `vil_id` int(11) NOT NULL AUTO_INCREMENT,
  `vil_desc` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`vil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `logement`
--
ALTER TABLE `logement`
  ADD CONSTRAINT `fk_logement_ville1` FOREIGN KEY (`vil_id`) REFERENCES `ville` (`vil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_typ_id` FOREIGN KEY (`typ_id`) REFERENCES `type_logement` (`typ_id`),
  ADD CONSTRAINT `fk_usr_id` FOREIGN KEY (`usr_id`) REFERENCES `user` (`usr_id`);

--
-- Contraintes pour la table `piece`
--
ALTER TABLE `piece`
  ADD CONSTRAINT `fk_log_id` FOREIGN KEY (`log_id`) REFERENCES `logement` (`log_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
