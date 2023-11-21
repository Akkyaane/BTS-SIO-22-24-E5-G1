-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 21 nov. 2023 à 18:59
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
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nights_number` int NOT NULL,
  `request_date` date NOT NULL,
  `transport_category` int DEFAULT NULL,
  `kilometers_expense` int DEFAULT NULL,
  `transport_expense` float DEFAULT NULL,
  `accommodation_expense` float DEFAULT NULL,
  `food_expense` float DEFAULT NULL,
  `other_expense` float DEFAULT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(12, 'Minerva', 'McGonagall', 'minervamcgonagall@gmail.com', '$2y$10$qxiVTx.MR9yJDexKOs6.fO5nTQ5EdE0QbaiAVUz0MwVHmaV1ZACHG', 3),
(11, 'Albus', 'Dumbledore', 'albusdumbledore@gmail.com', '$2y$10$WfcYuqe0TgLjb2woEKqu/uQq0pgHwJPGTobSH0V8b9Bvl1eNnkSy.', 3),
(10, 'Ron', 'Weasley', 'ronweasley@gmail.com', '$2y$10$yCnkGwQSxFHp6iTzifhPBesfbEBczfGBSFcC8smGohbO3WCFDe0HO', 3),
(9, 'Hermione', 'Granger', 'hermionegranger@gmail.com', '$2y$10$Cervu8riKn640Xi6q7AjT.XyGA4rHovKJls2Zq85hKo355lOCsGr.', 2),
(8, 'Harry', 'Potter', 'harrypotter@gmail.com', '$2y$10$HWBQPuhfG74TTW5XsDZLHuqaZsvpz5P/8cijdofKXRXjj12Qab4oS', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
