-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 29 nov. 2023 à 14:27
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_gsb_1`
--

-- --------------------------------------------------------

--
-- Structure de la table `expensesheets`
--

CREATE TABLE `expensesheets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receipts_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `request_date` date NOT NULL,
  `transport_category` int(1) DEFAULT NULL,
  `kilometers_number` int(11) DEFAULT NULL,
  `transport_expense` float DEFAULT NULL,
  `nights_number` int(11) DEFAULT NULL,
  `accommodation_expense` float DEFAULT NULL,
  `food_expense` float DEFAULT NULL,
  `other_expense` float DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `transport_expense` varchar(255) DEFAULT NULL,
  `accommodation_expense` varchar(255) DEFAULT NULL,
  `food_expense` varchar(255) DEFAULT NULL,
  `other_expense` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `treatment`
--

CREATE TABLE `treatment` (
  `id` int(11) NOT NULL,
  `expense_sheet_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Harry', 'Potter', 'harrypotter@gmail.com', '$2y$10$HWBQPuhfG74TTW5XsDZLHuqaZsvpz5P/8cijdofKXRXjj12Qab4oS', 'administrator'),
(2, 'Hermione', 'Granger', 'hermionegranger@gmail.com', '$2y$10$Cervu8riKn640Xi6q7AjT.XyGA4rHovKJls2Zq85hKo355lOCsGr.', 'accountant'),
(3, 'Ron', 'Weasley', 'ronweasley@gmail.com', '$2y$10$yCnkGwQSxFHp6iTzifhPBesfbEBczfGBSFcC8smGohbO3WCFDe0HO', 'visitor'),
(4, 'Albus', 'Dumbledore', 'albusdumbledore@gmail.com', '$2y$10$WfcYuqe0TgLjb2woEKqu/uQq0pgHwJPGTobSH0V8b9Bvl1eNnkSy.', 'visitor'),
(5, 'Minerva', 'McGonagall', 'minervamcgonagall@gmail.com', '$2y$10$qxiVTx.MR9yJDexKOs6.fO5nTQ5EdE0QbaiAVUz0MwVHmaV1ZACHG', 'visitor');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `expensesheets`
--
ALTER TABLE `expensesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `receipts_id` (`receipts_id`);

--
-- Index pour la table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_sheet_id` (`expense_sheet_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `expensesheets`
--
ALTER TABLE `expensesheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `expensesheets`
--
ALTER TABLE `expensesheets`
  ADD CONSTRAINT `expensesheets_ibfk_1` FOREIGN KEY (`receipts_id`) REFERENCES `receipts` (`id`),
  ADD CONSTRAINT `expensesheets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`expense_sheet_id`) REFERENCES `expensesheets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
