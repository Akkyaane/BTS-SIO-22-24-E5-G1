-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 08 déc. 2023 à 11:02
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
-- Base de données : `db_gsb`
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

--
-- Déchargement des données de la table `expensesheets`
--

INSERT INTO `expensesheets` (`id`, `user_id`, `receipts_id`, `start_date`, `end_date`, `request_date`, `transport_category`, `kilometers_number`, `transport_expense`, `nights_number`, `accommodation_expense`, `food_expense`, `other_expense`, `message`) VALUES
(3, 3, 5, '2023-12-03', '2023-12-03', '2023-12-04', 2, NULL, 23, NULL, NULL, NULL, NULL, NULL),
(4, 3, 6, '2023-12-18', '2023-12-20', '2023-12-20', 4, 233, NULL, 2, 56, 23.89, 67, 'Participation à un évènement'),
(5, 3, 7, '2023-12-05', '2023-12-06', '2023-12-07', 2, NULL, 78, NULL, NULL, 14.89, NULL, NULL),
(6, 3, 9, '2023-12-04', '2023-12-06', '2023-12-07', 2, NULL, 128, 2, 34.47, NULL, NULL, NULL),
(7, 3, 12, '2023-11-30', '2023-11-29', '2023-12-01', 2, NULL, 210, 1, 45, 23.92, 57, 'BLABLA'),
(8, 3, 14, '2023-12-13', '2023-12-14', '2023-12-15', 4, 220, NULL, 2, 34, 12, 21, 'FRGGTGTRGT'),
(9, 3, 15, '2023-11-30', '2023-12-01', '2023-12-02', 4, 220, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 5, 17, '2023-12-02', '2023-12-04', '2023-12-01', 4, 220, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, 19, '2023-12-02', '2023-12-03', '2023-12-01', 4, 220, NULL, 2, 24, 21, 24, 'efrffzefezfe');

-- --------------------------------------------------------

--
-- Structure de la table `kilometer_costs`
--

CREATE TABLE `kilometer_costs` (
  `id` int(11) NOT NULL,
  `horsepower` int(1) NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `kilometer_costs`
--

INSERT INTO `kilometer_costs` (`id`, `horsepower`, `cost`) VALUES
(1, 3, 0.529),
(2, 4, 0.606),
(3, 5, 0.636),
(4, 6, 0.665),
(5, 7, 0.697);

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

--
-- Déchargement des données de la table `receipts`
--

INSERT INTO `receipts` (`id`, `transport_expense`, `accommodation_expense`, `food_expense`, `other_expense`) VALUES
(1, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL),
(4, '../../../content/uploads/transport_expense_4_6569aa413d231train-invoice.jpg', NULL, NULL, NULL),
(5, '../../../content/uploads/transport_expense_5_6569aa9eb7947train-invoice.jpg', NULL, NULL, NULL),
(6, NULL, '../../../content/uploads/accommodation_expense_6_6569ac1ff1e05hotel-invoice.png', '../../../content/uploads/food_expense_6_6569ac1ff1e0cfood-receipt.png', '../../../content/uploads/other_expense_6_6569ac1ff1e0fevent-invoice.webp'),
(7, '../../../content/uploads/transport_expense_7_6569ac886fc76train-invoice.jpg', NULL, '../../../content/uploads/food_expense_7_6569ac886fc81food-receipt.png', NULL),
(8, '../../../content/uploads/transport_expense_8_6569ad44591batrain-invoice.jpg', '../../../content/uploads/accommodation_expense_8_6569ad44591c6hotel-invoice.png', '../../../content/uploads/food_expense_8_6569ad44591cafood-receipt.png', '../../../content/uploads/other_expense_8_6569ad44591cdevent-invoice.webp'),
(9, '../../../content/uploads/transport_expense_9_6569afddcb5b5train-invoice.jpg', '../../../content/uploads/accommodation_expense_9_6569afddcb5c0hotel-invoice.png', NULL, NULL),
(10, '../../../content/uploads/transport_expense_10_6569b022f10eetrain-invoice.jpg', '../../../content/uploads/accommodation_expense_10_6569b022f10f8hotel-invoice.png', '../../../content/uploads/food_expense_10_6569b022f10fcfood-receipt.png', '../../../content/uploads/other_expense_10_6569b022f10ffevent-invoice.webp'),
(11, '../../../content/uploads/transport_expense_11_6569e1ae683d0train-invoice.jpg', '../../../content/uploads/accommodation_expense_11_6569e1ae683e9hotel-invoice.png', '../../../content/uploads/food_expense_11_6569e1ae683edfood-receipt.png', '../../../content/uploads/other_expense_11_6569e1ae683f0event-invoice.webp'),
(12, '../../../content/uploads/transport_expense_12_6569e2204b908train-invoice.jpg', '../../../content/uploads/accommodation_expense_12_6569e2204b91fhotel-invoice.png', '../../../content/uploads/food_expense_12_6569e2204b922food-receipt.png', '../../../content/uploads/other_expense_12_6569e2204b926event-invoice.webp'),
(13, NULL, '../../../content/uploads/accommodation_expense_13_6569f55873765hotel-invoice.png', '../../../content/uploads/food_expense_13_6569f55873780food-receipt.png', '../../../content/uploads/other_expense_13_6569f55873783event-invoice.webp'),
(14, NULL, '../../../content/uploads/accommodation_expense_14_6569f5835f186hotel-invoice.png', '../../../content/uploads/food_expense_14_6569f5835f19cfood-receipt.png', '../../../content/uploads/other_expense_14_6569f5835f19fevent-invoice.webp'),
(15, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, NULL),
(18, NULL, '../../../content/uploads/accommodation_expense_18_656a02369cbf4hotel-invoice.png', '../../../content/uploads/food_expense_18_656a02369cc0efood-receipt.png', '../../../content/uploads/other_expense_18_656a02369cc11event-invoice.webp'),
(19, NULL, '../../../content/uploads/accommodation_expense_19_656a02b43c624hotel-invoice.png', '../../../content/uploads/food_expense_19_656a02b43c640food-receipt.png', '../../../content/uploads/other_expense_19_656a02b43c643event-invoice.webp');

-- --------------------------------------------------------

--
-- Structure de la table `treatment`
--

CREATE TABLE `treatment` (
  `id` int(11) NOT NULL,
  `expense_sheet_id` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `treatment`
--

INSERT INTO `treatment` (`id`, `expense_sheet_id`, `status`, `remark`) VALUES
(1, 3, 1, NULL),
(2, 4, 2, 'rehoirgjgir'),
(3, 5, 1, NULL),
(4, 6, 2, '\"rrt\'(t\'t(t(\'t'),
(5, 7, 1, NULL),
(6, 8, 1, NULL),
(7, 9, 1, NULL),
(8, 11, 1, NULL),
(9, 10, 2, 'egrgrgtr');

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
  `role` varchar(15) NOT NULL,
  `horsepower` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `horsepower`, `status`) VALUES
(1, 'Harry', 'Potter', 'harrypotter@gmail.com', '$2y$10$HWBQPuhfG74TTW5XsDZLHuqaZsvpz5P/8cijdofKXRXjj12Qab4oS', 'administrator', 0, 1),
(2, 'Hermione', 'Granger', 'hermionegranger@gmail.com', '$2y$10$Cervu8riKn640Xi6q7AjT.XyGA4rHovKJls2Zq85hKo355lOCsGr.', 'accountant', 0, 1),
(3, 'Ron', 'Weasley', 'ronweasley@gmail.com', '$2y$10$yCnkGwQSxFHp6iTzifhPBesfbEBczfGBSFcC8smGohbO3WCFDe0HO', 'visitor', 0, 1),
(4, 'Albus', 'Dumbledore', 'albusdumbledore@gmail.com', '$2y$10$WfcYuqe0TgLjb2woEKqu/uQq0pgHwJPGTobSH0V8b9Bvl1eNnkSy.', 'visitor', 0, 1),
(5, 'Minerva', 'McGonagall', 'minervamcgonagall@gmail.com', '$2y$10$qxiVTx.MR9yJDexKOs6.fO5nTQ5EdE0QbaiAVUz0MwVHmaV1ZACHG', 'visitor', 0, 1);

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
-- Index pour la table `kilometer_costs`
--
ALTER TABLE `kilometer_costs`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `kilometer_costs`
--
ALTER TABLE `kilometer_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
