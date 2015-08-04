-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Avril 2014 à 13:19
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `appli_pharma`
--
CREATE DATABASE IF NOT EXISTS `appli_pharma` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `appli_pharma`;

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE IF NOT EXISTS `annee` (
  `lib_annee` int(11) NOT NULL,
  PRIMARY KEY (`lib_annee`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `annee`
--

INSERT INTO `annee` (`lib_annee`) VALUES
(2013),
(2014),
(2015),
(2016),
(2017),
(2018),
(2019),
(2020),
(2021),
(2022),
(2023),
(2024),
(2025),
(2026),
(2027),
(2028),
(2029),
(2030),
(2031);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `id_etat` int(11) NOT NULL AUTO_INCREMENT,
  `lib_etat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_etat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id_etat`, `lib_etat`) VALUES
(1, 'EN COURS'),
(2, 'FERME-ATTENTE REMBOURSEMENT'),
(3, 'CLOTURE');

-- --------------------------------------------------------

--
-- Structure de la table `etatligne`
--

CREATE TABLE IF NOT EXISTS `etatligne` (
  `id_etatligne` int(11) NOT NULL AUTO_INCREMENT,
  `lib_etatligne` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_etatligne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `etatligne`
--

INSERT INTO `etatligne` (`id_etatligne`, `lib_etatligne`) VALUES
(1, 'VALIDE'),
(2, 'NON TRAITE'),
(3, 'REFUSE');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE IF NOT EXISTS `fichefrais` (
  `id_fichefrais` int(11) NOT NULL AUTO_INCREMENT,
  `montantvalide` float DEFAULT NULL,
  `datemodif` varchar(100) DEFAULT NULL,
  `id_etat` int(11) NOT NULL,
  `id_vis` int(11) NOT NULL,
  `lib_annee` int(11) DEFAULT NULL,
  `id_mois` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fichefrais`),
  KEY `FK_fichefrais_id_etat` (`id_etat`),
  KEY `FK_fichefrais_id_vis` (`id_vis`),
  KEY `FK_fichefrais_lib_annee` (`lib_annee`),
  KEY `FK_fichefrais_id_mois` (`id_mois`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `fichefrais`
--

INSERT INTO `fichefrais` (`id_fichefrais`, `montantvalide`, `datemodif`, `id_etat`, `id_vis`, `lib_annee`, `id_mois`) VALUES
(4, 1418, '2014-04-14', 1, 1, 2014, 4),
(5, 295, '2008-04-20', 1, 5, 2014, 4),
(6, 40, '2014-04-14', 1, 7, 2014, 4),
(7, 150, '2014-04-14', 1, 6, 2014, 4),
(8, 300, '2014-04-14', 2, 4, 2014, 3),
(9, 306, '2014-04-14', 3, 4, 2014, 2),
(10, 145, '2014-04-14', 1, 8, 2014, 4),
(11, 45, '2014-04-14', 1, 3, 2014, 4);

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE IF NOT EXISTS `fraisforfait` (
  `id_ff` int(11) NOT NULL AUTO_INCREMENT,
  `lib_ff` varchar(20) DEFAULT NULL,
  `mont_ff` float DEFAULT NULL,
  PRIMARY KEY (`id_ff`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id_ff`, `lib_ff`, `mont_ff`) VALUES
(1, 'Repas Midi', 15),
(2, 'Relais Etape', 50),
(3, 'Nuit seul', 40),
(4, 'Frais Kilometrique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE IF NOT EXISTS `lignefraisforfait` (
  `id_lff` int(11) NOT NULL AUTO_INCREMENT,
  `quantite_lff` int(11) DEFAULT NULL,
  `montanttotal_lff` float DEFAULT NULL,
  `montvalid_lff` float DEFAULT NULL,
  `justiffourni_lff` tinyint(1) DEFAULT NULL,
  `datetrait_lff` date DEFAULT NULL,
  `id_ff` int(11) NOT NULL,
  `id_vis` int(11) NOT NULL,
  `id_etatligne` int(11) NOT NULL,
  `lib_annee` int(11) DEFAULT NULL,
  `id_mois` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lff`),
  KEY `FK_lignefraisforfait_id_ff` (`id_ff`),
  KEY `FK_lignefraisforfait_id_vis` (`id_vis`),
  KEY `FK_lignefraisforfait_id_etatligne` (`id_etatligne`),
  KEY `FK_lignefraisforfait_lib_annee` (`lib_annee`),
  KEY `FK_lignefraisforfait_id_mois` (`id_mois`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`id_lff`, `quantite_lff`, `montanttotal_lff`, `montvalid_lff`, `justiffourni_lff`, `datetrait_lff`, `id_ff`, `id_vis`, `id_etatligne`, `lib_annee`, `id_mois`) VALUES
(7, 3, 150, 60, 1, NULL, 2, 1, 1, 2014, 2),
(8, 60, 60, 40, 1, NULL, 4, 1, 1, 2014, 2),
(9, 10, 500, 400, 1, NULL, 2, 1, 1, 2013, 3),
(10, 3, 45, 45, 1, NULL, 1, 5, 1, 2014, 2),
(11, 6, 300, 250, 1, NULL, 2, 5, 1, 2013, 4),
(12, 4, 200, 200, 1, NULL, 2, 1, 1, 2014, 2),
(13, 4, 60, 60, 1, NULL, 1, 1, 1, 2013, 1),
(14, 3, 45, 45, 1, NULL, 1, 1, 1, 2013, 1),
(15, 3, 150, 120, 1, NULL, 2, 1, 1, 2013, 2),
(16, 3, 45, 40, 1, NULL, 1, 1, 1, 2013, 1),
(17, 2, 30, 30, 1, NULL, 1, 1, 1, 2013, 1),
(18, 3, 45, 13, 1, NULL, 1, 1, 1, 2013, 1),
(19, 3, 150, 150, 1, NULL, 2, 6, 1, 2014, 3),
(20, 2, 30, 0, 0, NULL, 1, 7, 3, 2014, 2),
(21, 3, 45, 40, 1, NULL, 1, 7, 1, 2013, 1),
(22, 4, 60, 0, 0, NULL, 1, 6, 3, 2013, 1),
(23, 3, 45, 0, 0, NULL, 1, 1, 3, 2013, 1),
(24, 3, 150, 100, 1, '2014-04-14', 2, 8, 1, 2013, 1),
(25, 3, 45, 45, 1, '2014-04-14', 1, 3, 1, 2014, 4);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE IF NOT EXISTS `lignefraishorsforfait` (
  `id_lfhf` int(11) NOT NULL AUTO_INCREMENT,
  `lib_lfhf` varchar(100) DEFAULT NULL,
  `mont_lfhf` float DEFAULT NULL,
  `montvalid_lfhf` float DEFAULT NULL,
  `justiffourni_lfhf` tinyint(1) DEFAULT NULL,
  `datetrait_lfhf` date DEFAULT NULL,
  `id_vis` int(11) NOT NULL,
  `id_etatligne` int(11) NOT NULL,
  `lib_annee` int(11) DEFAULT NULL,
  `id_mois` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lfhf`),
  KEY `FK_lignefraishorsforfait_id_vis` (`id_vis`),
  KEY `FK_lignefraishorsforfait_id_etatligne` (`id_etatligne`),
  KEY `FK_lignefraishorsforfait_lib_annee` (`lib_annee`),
  KEY `FK_lignefraishorsforfait_id_mois` (`id_mois`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id_lfhf`, `lib_lfhf`, `mont_lfhf`, `montvalid_lfhf`, `justiffourni_lfhf`, `datetrait_lfhf`, `id_vis`, `id_etatligne`, `lib_annee`, `id_mois`) VALUES
(1, 'Essence', 120, 50, 1, NULL, 5, 1, 2013, 1),
(2, 'tgv', 60, 60, 1, NULL, 1, 1, 2013, 1),
(3, 'TGV', 60, 50, 1, NULL, 1, 1, 2014, 2),
(4, 'Escort', 80, 80, 1, NULL, 1, 1, 2013, 1),
(5, 'Train', 60, 0, 1, NULL, 1, 3, 2013, 1),
(6, 'Essence', 60, 40, 0, '2014-04-14', 1, 2, 2014, 5),
(7, 'fsfdd', 52, 52, 1, NULL, 1, 1, 2013, 1),
(8, 'Essence', 230, 0, 0, NULL, 6, 3, 2014, 2),
(9, 'fvfdsdsf', 30, 0, 0, NULL, 1, 3, 2014, 2),
(10, 'hdjshjkdsjvnkls', 60, 45, 1, NULL, 1, 1, 2014, 2),
(11, 'fvsd', 45, 20, 1, '0000-00-00', 1, 1, 2013, 2),
(12, 'rzff', 60, 0, 1, '2014-04-14', 1, 3, 2013, 2),
(13, 'gregrs', 60, 0, 0, NULL, 7, 3, 2013, 1),
(14, 'dfssdf', 30, 30, 1, NULL, 1, 1, 2013, 1),
(15, 'vvsddsv', 65, 45, 1, '2014-04-14', 8, 1, 2014, 2),
(16, 'bvhhg', 40, 0, 0, '0000-00-00', 3, 2, 2014, 4);

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE IF NOT EXISTS `mois` (
  `id_mois` int(11) NOT NULL,
  `lib_mois` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_mois`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mois`
--

INSERT INTO `mois` (`id_mois`, `lib_mois`) VALUES
(1, 'Janvier'),
(2, 'Fevrier'),
(3, 'Mars'),
(4, 'Avril'),
(5, 'Mai'),
(6, 'Juin'),
(7, 'Juillet'),
(8, 'Aout'),
(9, 'Septembre'),
(10, 'Octobre'),
(11, 'Novembre'),
(12, 'Decembre');

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
  `id_vis` int(11) NOT NULL AUTO_INCREMENT,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` char(20) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `date_embauche` date DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_vis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id_vis`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `date_embauche`, `Type`) VALUES
(1, 'Ribeiro', 'Johnny', 'joe', 'joe', '7 rue des luzernes', '95580', 'Jouy le moutier', '2009-11-29', 'visiteur'),
(2, 'Baudry', 'Johan', 'johan', 'johan', '136 rue salvador allende', '92000', 'NANTERRE', '2012-09-20', 'comptable'),
(3, 'Kelleoglu', 'Karl', 'karl', 'karl', '13 rue Pasteur', '92400', 'Courbevoie', '2013-12-06', 'visiteur'),
(4, 'Jacqueline', 'Johnny', 'jo', 'jo', '136 hbdjqjkncdsknkc,', '94526', ',bvsdhbncbds;:', '2014-03-12', 'visiteur'),
(5, 'moi', 'moi', 'moi', 'moi', '14 rue du chien', '94724', 'Fontenay-sous-Bois', '2014-02-10', 'visiteur'),
(6, 'Cavani', 'Edinson', 'edinson', 'edinson', 'bois de boulogne', '75018', 'Boubou', '2014-02-02', 'visiteur'),
(7, 'gfdgfdgf', 'gfbfnhhg', 'root', 'root', '515 dffdf', '75152', 'jkhdkjskdf', '2014-02-01', 'visiteur'),
(8, 'bibi', 'bibo', 'bibi', 'bibi', 'jknjnjknkj', '75014', 'sfdvdsd', '2014-11-29', 'visiteur');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `FK_fichefrais_id_etat` FOREIGN KEY (`id_etat`) REFERENCES `etat` (`id_etat`),
  ADD CONSTRAINT `FK_fichefrais_id_mois` FOREIGN KEY (`id_mois`) REFERENCES `mois` (`id_mois`),
  ADD CONSTRAINT `FK_fichefrais_id_vis` FOREIGN KEY (`id_vis`) REFERENCES `visiteur` (`id_vis`),
  ADD CONSTRAINT `FK_fichefrais_lib_annee` FOREIGN KEY (`lib_annee`) REFERENCES `annee` (`lib_annee`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `FK_lignefraisforfait_id_etatligne` FOREIGN KEY (`id_etatligne`) REFERENCES `etatligne` (`id_etatligne`),
  ADD CONSTRAINT `FK_lignefraisforfait_id_ff` FOREIGN KEY (`id_ff`) REFERENCES `fraisforfait` (`id_ff`),
  ADD CONSTRAINT `FK_lignefraisforfait_id_mois` FOREIGN KEY (`id_mois`) REFERENCES `mois` (`id_mois`),
  ADD CONSTRAINT `FK_lignefraisforfait_id_vis` FOREIGN KEY (`id_vis`) REFERENCES `visiteur` (`id_vis`),
  ADD CONSTRAINT `FK_lignefraisforfait_lib_annee` FOREIGN KEY (`lib_annee`) REFERENCES `annee` (`lib_annee`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `FK_lignefraishorsforfait_id_etatligne` FOREIGN KEY (`id_etatligne`) REFERENCES `etatligne` (`id_etatligne`),
  ADD CONSTRAINT `FK_lignefraishorsforfait_id_mois` FOREIGN KEY (`id_mois`) REFERENCES `mois` (`id_mois`),
  ADD CONSTRAINT `FK_lignefraishorsforfait_id_vis` FOREIGN KEY (`id_vis`) REFERENCES `visiteur` (`id_vis`),
  ADD CONSTRAINT `FK_lignefraishorsforfait_lib_annee` FOREIGN KEY (`lib_annee`) REFERENCES `annee` (`lib_annee`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
