-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 mai 2024 à 12:02
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aminproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `apply`
--

CREATE TABLE `apply` (
  `jobid` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `companyname` varchar(50) NOT NULL,
  `cv_name` varchar(255) DEFAULT NULL,
  `cv_data` longblob DEFAULT NULL,
  `resume_name` varchar(255) DEFAULT NULL,
  `resume_data` longblob DEFAULT NULL,
  `apply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobsproject`
--

CREATE TABLE `jobsproject` (
  `jobid` int(11) NOT NULL,
  `jobname` varchar(255) DEFAULT NULL,
  `companyname` varchar(255) DEFAULT NULL,
  `jobtype` varchar(50) DEFAULT NULL,
  `remote` varchar(10) DEFAULT NULL,
  `jobdesc` text DEFAULT NULL,
  `image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `webuser`
--

CREATE TABLE `webuser` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `phone` varchar(8) DEFAULT NULL,
  `type1` varchar(50) DEFAULT NULL,
  `companyname` varchar(100) DEFAULT NULL,
  `pic` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`apply`);

--
-- Index pour la table `jobsproject`
--
ALTER TABLE `jobsproject`
  ADD PRIMARY KEY (`jobid`);

--
-- Index pour la table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apply`
--
ALTER TABLE `apply`
  MODIFY `apply` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobsproject`
--
ALTER TABLE `jobsproject`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `webuser`
--
ALTER TABLE `webuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
