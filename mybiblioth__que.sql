-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 27 mai 2023 à 21:23
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mybibliothèque`
--

-- --------------------------------------------------------

--
-- Structure de la table `emprunter`
--

CREATE TABLE `emprunter` (
  `idPeronne` int(11) NOT NULL,
  `idEmprunt` int(11) NOT NULL,
  `livres` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunter`
--

INSERT INTO `emprunter` (`idPeronne`, `idEmprunt`, `livres`) VALUES
(19, 43, 'sage guid'),
(19, 44, 'sage guid'),
(19, 45, 'sage guid'),
(19, 46, 'cypher guide');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `idEmprunt` int(11) NOT NULL,
  `date_emprunt` date NOT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'emprunté'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`idEmprunt`, `date_emprunt`, `statut`) VALUES
(43, '2023-04-01', 'rendu'),
(44, '2023-05-15', 'emprunté'),
(45, '2023-03-01', 'emprunté'),
(46, '2023-03-01', 'emprunté');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `idLivre` int(11) NOT NULL,
  `Titre` varchar(45) NOT NULL,
  `Auteurs` varchar(45) NOT NULL,
  `Maison_edition` varchar(45) NOT NULL,
  `Nbr_pages` int(11) NOT NULL,
  `Nbr_exemplaires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`idLivre`, `Titre`, `Auteurs`, `Maison_edition`, `Nbr_pages`, `Nbr_exemplaires`) VALUES
(2, 'Gai savoir2', 'nietzsh fredrik2', 'prepa2', 1000000, 22),
(3, 'cypher guide', 'Ace', 'Vanguard', 100, 52),
(4, 'sage guid', 'Ace', 'Vanguard', 57, 28);

-- --------------------------------------------------------

--
-- Structure de la table `livre_emprunté`
--

CREATE TABLE `livre_emprunté` (
  `idLivre` int(11) NOT NULL,
  `idemprunt` int(11) NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre_emprunté`
--

INSERT INTO `livre_emprunté` (`idLivre`, `idemprunt`, `date_retour`) VALUES
(3, 46, '2023-03-10'),
(4, 43, '2023-04-09'),
(4, 44, '2023-05-24'),
(4, 45, '2023-03-24');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `idPersonne` int(11) NOT NULL,
  `Nom` varchar(45) NOT NULL,
  `Prénom` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Adress` varchar(45) NOT NULL,
  `Statut` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `Nom`, `Prénom`, `Email`, `Adress`, `Statut`) VALUES
(14, 'a', 'a', 'aa@aa', 'a', 'Etudiant'),
(15, 'b', 'b', 'bb@bb', 'b', 'Etudiant'),
(16, 'c', 'c', 'cc@cc', 'c', 'Ensignat'),
(17, 'cypher', 'britge', 'cypher@gmail.com', 'split map', 'Ensignat'),
(18, 'sage', 'viper', 'sage@gmail.com', 'haven', 'Etudiant'),
(19, 'yassine', 'ko', 'yassine@gmail.com', 'rashidya', 'Etudiant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emprunter`
--
ALTER TABLE `emprunter`
  ADD PRIMARY KEY (`idPeronne`,`idEmprunt`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`idEmprunt`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`idLivre`);

--
-- Index pour la table `livre_emprunté`
--
ALTER TABLE `livre_emprunté`
  ADD PRIMARY KEY (`idLivre`,`idemprunt`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`idPersonne`,`Email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `idEmprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `idLivre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `idPersonne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
