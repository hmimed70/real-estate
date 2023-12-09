-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 08 jan. 2023 à 18:09
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `realestate`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `pass_admin` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `fullName`, `pass_admin`, `email`, `phone`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.com', '0358666886'),


-- --------------------------------------------------------

--
-- Structure de la table `homes`
--

CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `addresse` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `price` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `homes`
--

INSERT INTO `homes` (`id`, `title`, `addresse`, `type`, `user`, `price`) VALUES
(20, 'Beatuiful Home', 'Algiers, Algeria', 'Rent', 9, '96'),
(21, 'Amazing Home', 'Oran, Algeria', 'Sell', 10, '45');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `home` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_image`, `imgName`, `home`) VALUES
(50, 'cover.jpg', 20),
(51, 'cover1.jpg', 20),
(52, 'home.jpg', 20),
(53, 'shutterstock_294150572.jpg', 21),
(54, 'interiorblink-3d4ececa6969410281855c139a0b6806.png', 21),
(55, 'download.jpg', 21);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `pass_user` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `blocked` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `fullName`, `pass_user`, `email`, `phone`, `blocked`) VALUES
(9, 'User user', 'e10adc3949ba59abbe56e057f20f883e', 'user@test.com', '057656556', 'false'),
(10, 'faress Ch', 'e10adc3949ba59abbe56e057f20f883e', 'hmimed@test1.com', '053565', 'false');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `home` (`home`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `homes`
--
ALTER TABLE `homes`
  ADD CONSTRAINT `homes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_home` FOREIGN KEY (`home`) REFERENCES `homes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
