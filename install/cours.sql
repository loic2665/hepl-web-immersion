-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 14 Mai 2020 à 13:55
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
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int NOT NULL,
  `intitule` varchar(256) NOT NULL,
  `bloc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `intitule`, `bloc`) VALUES
(1, 'Langage et logique de programmation', 1),
(2, 'Analyse et gestion de projets', 1),
(3, 'Programmation orienté objet C++', 2),
(4, 'Programmation orienté objet Java', 2),
(5, 'Programmation WEB de base', 1),
(6, 'Programmation WEB avancée', 2),
(7, 'Exploitation des données', 2);

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `id` int NOT NULL,
  `email` varchar(256) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `etablissement` varchar(256) NOT NULL,
  `indus` tinyint(1) NOT NULL,
  `gestion` tinyint(1) NOT NULL,
  `reseau` tinyint(1) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `eleves`
--

INSERT INTO `eleves` (`id`, `email`, `nom`, `prenom`, `etablissement`, `indus`, `gestion`, `reseau`, `archive`) VALUES
(1, 'azerty@gmail.com', 'Test', 'Albert', 'Je ne sais pas', 0, 1, 0, 0),
(2, 'Test@hotmail.com', 'Jean', 'Jannot', 'Far away', 1, 0, 0, 0),
(3, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(4, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(5, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(6, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(7, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(8, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(9, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(10, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(11, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(12, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(13, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0),
(14, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 0, 1, 0),
(15, 'loic.collette@gmail.com', 'collette', 'loic', '123', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `eleves_horaires`
--

CREATE TABLE `eleves_horaires` (
  `id` int NOT NULL,
  `id_horaires` int NOT NULL,
  `id_eleves` int NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `eleves_horaires`
--

INSERT INTO `eleves_horaires` (`id`, `id_horaires`, `id_eleves`, `archive`) VALUES
(1, 6, 4, 0),
(2, 8, 4, 0),
(3, 9, 4, 0),
(8, 5, 4, 0),
(10, 3, 4, 0),
(13, 6, 5, 0),
(14, 8, 5, 0),
(15, 9, 5, 0),
(17, 6, 6, 0),
(18, 8, 6, 0),
(19, 9, 6, 0),
(21, 6, 7, 0),
(22, 8, 7, 0),
(23, 9, 7, 0),
(25, 6, 8, 0),
(26, 8, 8, 0),
(27, 9, 8, 0),
(29, 6, 9, 0),
(30, 8, 9, 0),
(31, 9, 9, 0),
(33, 6, 10, 0),
(34, 8, 10, 0),
(35, 9, 10, 0),
(37, 6, 11, 0),
(38, 8, 11, 0),
(39, 9, 11, 0),
(41, 6, 12, 0),
(42, 8, 12, 0),
(43, 9, 12, 0),
(44, 13, 12, 0),
(45, 10, 12, 0),
(46, 12, 12, 0),
(47, 5, 12, 0),
(48, 14, 12, 0),
(49, 3, 12, 0),
(50, 15, 12, 0),
(51, 16, 12, 0),
(52, 6, 13, 0),
(53, 8, 13, 0),
(54, 14, 13, 0),
(55, 3, 13, 0),
(56, 15, 13, 0),
(57, 16, 13, 0),
(58, 13, 13, 0),
(59, 10, 13, 0),
(60, 12, 13, 0),
(61, 5, 13, 0),
(62, 6, 14, 0),
(63, 8, 14, 0),
(64, 14, 14, 0),
(65, 3, 14, 0),
(66, 15, 14, 0),
(67, 16, 14, 0),
(68, 13, 14, 0),
(69, 11, 14, 0),
(70, 12, 14, 0),
(71, 5, 14, 0),
(72, 6, 15, 0),
(73, 8, 15, 0),
(74, 9, 15, 0),
(75, 13, 15, 0),
(76, 10, 15, 0),
(77, 12, 15, 0),
(78, 5, 15, 0),
(79, 14, 15, 0),
(80, 3, 15, 0);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` int NOT NULL,
  `nom` varchar(256) NOT NULL,
  `prenom` varchar(256) NOT NULL,
  `sexe` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `nom`, `prenom`, `sexe`) VALUES
(1, 'Léonard', 'Anne', 'f'),
(2, 'Sagot', 'Pierre', 'm'),
(3, 'Serrhini', 'Souad', 'f'),
(4, 'Costa', 'Corrine', 'f'),
(5, 'Thiernesse', 'Cédric', 'm'),
(6, 'Vilvens', 'Claude', 'm'),
(8, 'collette', 'loic', 'm');

-- --------------------------------------------------------

--
-- Structure de la table `enseignants_cours`
--

CREATE TABLE `enseignants_cours` (
  `id` int NOT NULL,
  `id_enseignants` int NOT NULL,
  `id_cours` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `enseignants_cours`
--

INSERT INTO `enseignants_cours` (`id`, `id_enseignants`, `id_cours`) VALUES
(1, 1, 1),
(2, 2, 2);

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
  `indus` tinyint(1) NOT NULL,
  `gestion` tinyint(1) NOT NULL,
  `reseau` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `inscription` int NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `horaires`
--

INSERT INTO `horaires` (`id`, `id_cours`, `id_enseignants`, `id_type_cours`, `date_cours`, `id_tranches_horaires`, `id_locaux`, `inscription_max`, `indus`, `gestion`, `reseau`, `visible`, `inscription`, `archive`) VALUES
(3, 1, 1, 2, '2020-05-21', 4, 5, 10, 0, 1, 0, 1, 0, 0),
(5, 5, 2, 3, '2020-05-28', 9, 9, 100, 0, 0, 1, 1, 0, 0),
(6, 2, 2, 2, '2020-05-14', 1, 1, 15, 0, 0, 1, 1, 0, 0),
(7, 5, 5, 2, '2020-05-14', 2, 8, 15, 0, 1, 0, 1, 0, 0),
(8, 7, 1, 2, '2020-05-14', 4, 7, 15, 0, 1, 0, 1, 0, 0),
(9, 7, 4, 1, '2020-05-14', 7, 7, 15, 0, 1, 0, 0, 0, 0),
(10, 4, 6, 2, '2020-05-28', 4, 14, 100, 1, 1, 1, 1, 0, 0),
(11, 4, 2, 1, '2020-05-28', 4, 2, 100, 1, 1, 1, 1, 0, 0),
(12, 3, 2, 1, '2020-05-28', 7, 5, 100, 1, 1, 1, 1, 0, 0),
(13, 2, 5, 1, '2020-05-28', 2, 2, 100, 1, 1, 1, 1, 0, 0),
(14, 1, 5, 2, '2020-05-21', 1, 1, 10, 0, 1, 0, 1, 0, 0),
(15, 7, 2, 1, '2020-05-21', 7, 6, 10, 0, 1, 0, 1, 0, 0),
(16, 6, 2, 2, '2020-05-21', 9, 3, 10, 0, 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `locaux`
--

CREATE TABLE `locaux` (
  `id` int NOT NULL,
  `local` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `locaux`
--

INSERT INTO `locaux` (`id`, `local`) VALUES
(1, 'AX'),
(2, 'BX'),
(3, 'CX'),
(4, 'L01'),
(5, 'L02'),
(6, 'L03'),
(7, 'PV1.1'),
(8, 'PV1.2'),
(9, 'PV3'),
(10, 'LEO'),
(11, 'LPO1'),
(12, 'LPO2'),
(13, 'AE'),
(14, 'AN');

-- --------------------------------------------------------

--
-- Structure de la table `tranches_horaires`
--

CREATE TABLE `tranches_horaires` (
  `id` int NOT NULL,
  `heure_debut` varchar(5) NOT NULL,
  `heure_fin` varchar(5) NOT NULL,
  `tranche_horaire` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `tranches_horaires`
--

INSERT INTO `tranches_horaires` (`id`, `heure_debut`, `heure_fin`, `tranche_horaire`) VALUES
(1, '08h20', '10h20', 1),
(2, '08h50', '10h20', 1),
(3, '09h20', '10h20', 1),
(4, '10h30', '11h30', 2),
(5, '10h30', '12h00', 2),
(6, '10h30', '12h30', 2),
(7, '13h30', '15h00', 3),
(8, '13h30', '15h30', 3),
(9, '15h30', '17h30', 4);

-- --------------------------------------------------------

--
-- Structure de la table `type_cours`
--

CREATE TABLE `type_cours` (
  `id` int NOT NULL,
  `type` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type_cours`
--

INSERT INTO `type_cours` (`id`, `type`) VALUES
(1, 'Labo'),
(2, 'Théorie'),
(3, 'TFE');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleves_horaires`
--
ALTER TABLE `eleves_horaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ELEVES_HORAIRE_ID_ELEVE` (`id_eleves`),
  ADD KEY `FK_ELEVES_HORAIRE_ID_HORAIRE` (`id_horaires`);

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enseignants_cours`
--
ALTER TABLE `enseignants_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ENSEIGNANTS_COURS_ID_ENSEIGNANTS` (`id_enseignants`),
  ADD KEY `FK_ENSEIGNANTS_COURS_ID_COURS` (`id_cours`);

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
-- Index pour la table `locaux`
--
ALTER TABLE `locaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tranches_horaires`
--
ALTER TABLE `tranches_horaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_cours`
--
ALTER TABLE `type_cours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `eleves_horaires`
--
ALTER TABLE `eleves_horaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `enseignants_cours`
--
ALTER TABLE `enseignants_cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `locaux`
--
ALTER TABLE `locaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `tranches_horaires`
--
ALTER TABLE `tranches_horaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `type_cours`
--
ALTER TABLE `type_cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `eleves_horaires`
--
ALTER TABLE `eleves_horaires`
  ADD CONSTRAINT `FK_ELEVES_HORAIRE_ID_ELEVE` FOREIGN KEY (`id_eleves`) REFERENCES `eleves` (`id`),
  ADD CONSTRAINT `FK_ELEVES_HORAIRE_ID_HORAIRE` FOREIGN KEY (`id_horaires`) REFERENCES `horaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseignants_cours`
--
ALTER TABLE `enseignants_cours`
  ADD CONSTRAINT `FK_ENSEIGNANTS_COURS_ID_COURS` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENSEIGNANTS_COURS_ID_ENSEIGNANTS` FOREIGN KEY (`id_enseignants`) REFERENCES `enseignants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
