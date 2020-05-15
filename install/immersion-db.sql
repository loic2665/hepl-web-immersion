-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 15 Mai 2020 à 17:21
-- Version du serveur :  8.0.19-0ubuntu0.19.10.3
-- Version de PHP :  7.2.30-1+ubuntu19.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hepl-immersion`
--

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id` int NOT NULL,
  `id_cours` int NOT NULL,
  `id_enseignants` int NOT NULL,
  `id_type_cours` int NOT NULL,
  `date_cours` date NOT NULL,
  `id_tranches_horaires` int NOT NULL,
  `id_locaux` int NOT NULL,
  `inscription_max` int NOT NULL,
  `inscription` int NOT NULL,
  `indus` tinyint(1) NOT NULL,
  `gestion` tinyint(1) NOT NULL,
  `reseau` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `horaires`
--

INSERT INTO `horaires` (`id`, `id_cours`, `id_enseignants`, `id_type_cours`, `date_cours`, `id_tranches_horaires`, `id_locaux`, `inscription_max`, `inscription`, `indus`, `gestion`, `reseau`, `visible`, `archive`) VALUES
(3, 1, 1, 2, '2020-05-21', 4, 5, 2, 2, 0, 1, 0, 1, 0),
(5, 5, 2, 3, '2020-05-28', 9, 9, 2, 0, 0, 0, 1, 1, 0),
(6, 2, 2, 2, '2020-05-14', 1, 1, 2, 0, 0, 0, 1, 1, 0),
(7, 5, 5, 2, '2020-05-14', 2, 8, 2, 0, 0, 1, 0, 1, 0),
(8, 7, 1, 2, '2020-05-14', 4, 7, 2, 0, 0, 1, 0, 1, 0),
(9, 7, 4, 1, '2020-05-14', 7, 7, 2, 0, 0, 1, 0, 0, 0),
(10, 4, 6, 2, '2020-05-28', 4, 14, 2, 0, 1, 1, 1, 1, 0),
(11, 4, 2, 1, '2020-05-28', 4, 2, 2, 0, 1, 1, 1, 1, 0),
(12, 3, 2, 1, '2020-05-28', 7, 5, 2, 0, 1, 1, 1, 1, 0),
(13, 2, 5, 1, '2020-05-28', 2, 2, 2, 0, 1, 1, 1, 1, 0),
(14, 1, 5, 2, '2020-05-21', 1, 1, 2, 0, 0, 1, 0, 1, 0),
(15, 7, 2, 1, '2020-05-21', 7, 6, 2, 0, 0, 1, 0, 1, 0),
(16, 6, 2, 2, '2020-05-21', 9, 3, 2, 0, 0, 1, 0, 1, 0),
(17, 4, 3, 2, '2020-06-13', 3, 3, 2, 0, 1, 1, 0, 1, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_HORAIRES_ID_COURS` (`id_cours`),
  ADD KEY `FK_HORAIRES_ID_ENSEIGNANT` (`id_enseignants`),
  ADD KEY `FK_HORAIRES_ID_TYPE_COURS` (`id_type_cours`),
  ADD KEY `FK_HORAIRES_ID_TRANCHE_HORAIRE` (`id_tranches_horaires`),
  ADD KEY `FK_HORAIRES_ID_LOCAL` (`id_locaux`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `FK_HORAIRES_ID_COURS` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HORAIRES_ID_ENSEIGNANT` FOREIGN KEY (`id_enseignants`) REFERENCES `enseignants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HORAIRES_ID_LOCAL` FOREIGN KEY (`id_locaux`) REFERENCES `locaux` (`id`),
  ADD CONSTRAINT `FK_HORAIRES_ID_TRANCHE_HORAIRE` FOREIGN KEY (`id_tranches_horaires`) REFERENCES `tranches_horaires` (`id`),
  ADD CONSTRAINT `FK_HORAIRES_ID_TYPE_COURS` FOREIGN KEY (`id_type_cours`) REFERENCES `type_cours` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
