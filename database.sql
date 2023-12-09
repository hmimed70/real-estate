-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 avr. 2022 à 17:06
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

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
-- Structure de la table `homes`
--

CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `addresse` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `price` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `homes`
--

INSERT INTO `homes` (`id`, `title`, `addresse`, `type`, `user`, `price`) VALUES
(1, 'Cool Home in Lebanon', 'Center ville', 'Sell', 1, '75000'),
(2, 'Amazing Home in Beireut', 'exemple city', 'Rent', 1, '4500'),
(3, 'Home of Happiness', 'exemple cityee', 'Sell', 2, '55000'),
(4, 'Home of your Dreams', 'my city', 'Rent', 2, '3600');

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
(1, 'living-room-g67f7e0977_1280.jpg', 1),
(2, 'architecture-gdbf6a2285_1280.jpg', 1),
(3, 'bedroom-g613189b6d_1280.jpg', 1),
(4, 'bedroom-g613189b6d_1280.jpg', 2),
(5, 'bed-gec9122cb6_1280.jpg', 2),
(6, 'bedroom-ge25f01ed5_1280.jpg', 3),
(7, 'furniture-gf182828e8_1280.jpg', 3),
(8, 'cover.jpg', 3),
(9, 'architecture-gdbf6a2285_1280.jpg', 4),
(10, 'bedroom-g613189b6d_1280.jpg', 4),
(11, 'bed-gec9122cb6_1280.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `fullName` int(50) NOT NULL,
  `pass_user` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `fullName`, `pass_user`, `email`, `phone`) VALUES
(1, 0, '16d7a4fca7442dda3ad93c9a726597e4', 'test@user.com', '0096112345678'),
(2, 0, '16d7a4fca7442dda3ad93c9a726597e4', 'user@test.com', '0096198765432');

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`home`) REFERENCES `homes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
