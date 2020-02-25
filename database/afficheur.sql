-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 20 fév. 2020 à 02:12
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `afficheur`
--

-- --------------------------------------------------------

--
-- Structure de la table `filliere`
--

CREATE TABLE `filliere` (
  `fil_id` int(11) NOT NULL,
  `fil_name` varchar(255) NOT NULL,
  `fil_nb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `filliere`
--

INSERT INTO `filliere` (`fil_id`, `fil_name`, `fil_nb`) VALUES
(1, 'TSSR', 8),
(2, 'DWWM', 12),
(3, 'SAMS', 18),
(4, 'GP', 12),
(5, 'GP2', 10),
(6, 'CA', 9),
(7, 'GCF', 14),
(8, 'ASCA', 18),
(9, 'ASCOM', 13),
(10, 'PCIE', 0),
(11, 'VAE', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `mes_id` int(11) NOT NULL,
  `mes_content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `occupation`
--

CREATE TABLE `occupation` (
  `fil_id` int(11) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `tra_id` int(11) NOT NULL,
  `occ_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `sal_id` int(11) NOT NULL,
  `sal_name` int(11) NOT NULL,
  `typ_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `sec_id` int(11) NOT NULL,
  `sec_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`sec_id`, `sec_name`) VALUES
(1, 'GRETA'),
(2, 'LYCEE HONORE');

-- --------------------------------------------------------

--
-- Structure de la table `tranche_horaire`
--

CREATE TABLE `tranche_horaire` (
  `tra_id` int(11) NOT NULL,
  `tra_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tranche_horaire`
--

INSERT INTO `tranche_horaire` (`tra_id`, `tra_name`) VALUES
(1, 'Matin'),
(2, 'Après-midi');

-- --------------------------------------------------------

--
-- Structure de la table `type_salle`
--

CREATE TABLE `type_salle` (
  `typ_id` int(11) NOT NULL,
  `typ_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL,
  `usr_email` varchar(250) NOT NULL,
  `usr_password` varchar(250) NOT NULL,
  `usr_date_connexion` varchar(250) NOT NULL,
  `usr_role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`usr_id`, `usr_email`, `usr_password`, `usr_date_connexion`, `usr_role`) VALUES
(1, 'dudeck.adrien@laposte.net', '$2y$10$pV3j7YjV4zlWoX/JiJClcOA39P3iQO4LrU8/sGxsfmIE7QRzXu.TC', 'Ydhl779#', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `filliere`
--
ALTER TABLE `filliere`
  ADD PRIMARY KEY (`fil_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mes_id`);

--
-- Index pour la table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`fil_id`,`sal_id`,`tra_id`,`occ_date`),
  ADD KEY `fk_sal_id` (`sal_id`),
  ADD KEY `fk_tra_id` (`tra_id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`sal_id`),
  ADD KEY `fk_sec_id` (`sec_id`),
  ADD KEY `fk_typ_id` (`typ_id`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`sec_id`);

--
-- Index pour la table `tranche_horaire`
--
ALTER TABLE `tranche_horaire`
  ADD PRIMARY KEY (`tra_id`);

--
-- Index pour la table `type_salle`
--
ALTER TABLE `type_salle`
  ADD PRIMARY KEY (`typ_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `filliere`
--
ALTER TABLE `filliere`
  MODIFY `fil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `mes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tranche_horaire`
--
ALTER TABLE `tranche_horaire`
  MODIFY `tra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_salle`
--
ALTER TABLE `type_salle`
  MODIFY `typ_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `occupation`
--
ALTER TABLE `occupation`
  ADD CONSTRAINT `fk_fil_id` FOREIGN KEY (`fil_id`) REFERENCES `filliere` (`fil_id`),
  ADD CONSTRAINT `fk_sal_id` FOREIGN KEY (`sal_id`) REFERENCES `salle` (`sal_id`),
  ADD CONSTRAINT `fk_tra_id` FOREIGN KEY (`tra_id`) REFERENCES `tranche_horaire` (`tra_id`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `fk_sec_id` FOREIGN KEY (`sec_id`) REFERENCES `secteur` (`sec_id`),
  ADD CONSTRAINT `fk_typ_id` FOREIGN KEY (`typ_id`) REFERENCES `type_salle` (`typ_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
