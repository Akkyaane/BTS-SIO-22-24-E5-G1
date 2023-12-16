-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 16 déc. 2023 à 14:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `expensesheets`
--

DROP TABLE IF EXISTS `expensesheets`;
CREATE TABLE IF NOT EXISTS `expensesheets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `receipts_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `request_date` date NOT NULL,
  `transport_category` int DEFAULT NULL,
  `kilometers_number` int DEFAULT NULL,
  `kilometer_expense` float DEFAULT NULL,
  `kilometer_expense_refund` float DEFAULT NULL,
  `kilometer_expense_unrefund` float DEFAULT NULL,
  `transport_expense` float DEFAULT NULL,
  `transport_expense_refund` float DEFAULT NULL,
  `transport_expense_unrefund` float DEFAULT NULL,
  `nights_number` int DEFAULT NULL,
  `accommodation_expense` float DEFAULT NULL,
  `accommodation_expense_refund` float DEFAULT NULL,
  `accommodation_expense_unrefund` float DEFAULT NULL,
  `food_expense` float DEFAULT NULL,
  `food_expense_refund` float DEFAULT NULL,
  `food_expense_unrefund` float DEFAULT NULL,
  `other_expense` float DEFAULT NULL,
  `other_expense_refund` float DEFAULT NULL,
  `other_expense_unrefund` float DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `total_amount_refund` float DEFAULT NULL,
  `total_amount_unrefund` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`user_id`),
  KEY `receipts_id` (`receipts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `kilometercosts`
--

DROP TABLE IF EXISTS `kilometercosts`;
CREATE TABLE IF NOT EXISTS `kilometercosts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `horsepower` int NOT NULL,
  `cost` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `kilometercosts`
--

INSERT INTO `kilometercosts` (`id`, `horsepower`, `cost`) VALUES
(1, 3, 0.529),
(2, 4, 0.606),
(3, 5, 0.636),
(4, 6, 0.665),
(5, 7, 0.697);

-- --------------------------------------------------------

--
-- Structure de la table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
CREATE TABLE IF NOT EXISTS `receipts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transport_expense` varchar(255) DEFAULT NULL,
  `accommodation_expense` varchar(255) DEFAULT NULL,
  `food_expense` varchar(255) DEFAULT NULL,
  `other_expense` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `treatment`
--

DROP TABLE IF EXISTS `treatment`;
CREATE TABLE IF NOT EXISTS `treatment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `expense_sheet_id` int NOT NULL,
  `status` int DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_sheet_id` (`expense_sheet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL,
  `horsepower` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `horsepower`, `status`) VALUES
(1, 'Harry', 'Potter', 'harrypotter@gmail.com', '$2y$10$HWBQPuhfG74TTW5XsDZLHuqaZsvpz5P/8cijdofKXRXjj12Qab4oS', 'administrator', 0, 1),
(2, 'Hermione', 'Granger', 'hermionegranger@gmail.com', '$2y$10$Cervu8riKn640Xi6q7AjT.XyGA4rHovKJls2Zq85hKo355lOCsGr.', 'accountant', 0, 1),
(3, 'Ron', 'Weasley', 'ronweasley@gmail.com', '$2y$10$yCnkGwQSxFHp6iTzifhPBesfbEBczfGBSFcC8smGohbO3WCFDe0HO', 'visitor', 5, 1),
(4, 'Albus', 'Dumbledore', 'albusdumbledore@gmail.com', '$2y$10$WfcYuqe0TgLjb2woEKqu/uQq0pgHwJPGTobSH0V8b9Bvl1eNnkSy.', 'visitor', 6, 1),
(5, 'Minerva', 'McGonagall', 'minervamcgonagall@gmail.com', '$2y$10$qxiVTx.MR9yJDexKOs6.fO5nTQ5EdE0QbaiAVUz0MwVHmaV1ZACHG', 'visitor', 7, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `expensesheets`
--
ALTER TABLE `expensesheets`
  ADD CONSTRAINT `expensesheets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expensesheets_ibfk_3` FOREIGN KEY (`receipts_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`expense_sheet_id`) REFERENCES `expensesheets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
