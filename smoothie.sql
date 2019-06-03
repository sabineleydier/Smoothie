-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 15 Mai 2019 à 10:00
-- Version du serveur :  5.7.26-0ubuntu0.16.04.1
-- Version de PHP :  7.0.33-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smoothie`
--

-- --------------------------------------------------------

--
-- Structure de la table `Meal`
--

CREATE TABLE `Meal` (
  `Id` int(11) NOT NULL,
  `Name` varchar(35) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `SalePrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Meal`
--

INSERT INTO `Meal` (`Id`, `Name`, `Photo`, `Description`, `SalePrice`) VALUES
(1, 'Smothie Betterave', 'betterave.jpg', 'Faîtes le plein d\'énergie avec notre smoothie à la betterave. \r\nLa betterave est reconnue pour ses grandes valeurs nutritionnelles, elle est riche en calcium, en fer et minéraux. Elle agit comme un véritable agent détoxifiant.', 12),
(2, 'Smoothie Avocat', 'legumes verts.jpg', 'Laissez vous tenter par notre smoothie à l\'avocat. Il est très riche en vitamines E, B5 et B6... IL favorise le développement et le maintien de vos os, de votre cerveau et de votre coeur sans oublier la régénérescence des globules rouges ', 15),
(3, 'Smoothie Ananas-Orange', 'jus-ananas-orange.jpg', 'Besoin d\'un peu de soleil dans votre organisme ? Craquez pour ce délicieux smoothie rempli de vitamines.', 13),
(4, 'Smoothie aux fruits exotiques', 'Recette_CANDIA_Smoothie_exotique.jpg', 'Envie de soleil dans votre vie. Pensez à notre smoothie aux fruits exotiques qui vous apporte des vitamines et surtout un avant de goût de vacances', 14),
(5, 'Smoothie Pomme-Banane', 'shutterstock_170853497.jpg', 'Ce smoothie plein de vitamines ravira les enfants mais aussi les grands', 11),
(6, 'Smoothie Myrtilles - Lait de soja', 'Smoothie-Beeren-Breakfast-Rezepte-Blog.jpg', 'Idéal pour les personnes allergiques au lactose, voici notre smoothie plein de vitamines avec des myrtilles et surtout du lait de soja.', 16),
(7, 'Smoothie Pastèque - Pomme', 'watermelon_smoothie.jpg', 'Idéal pour se désaltérer pendant l\'été Venez goutter ce smoothie qui ravira vos papilles', 12),
(8, 'Smoothie Epinards - Kiwi', 'batido-detox-de-espinacas-kiwi-y-naranja.jpg', 'Idéal pour un régime et une peau purifiée,  venez goûter notre smoothie épinards -kiwi.', 15);

-- --------------------------------------------------------

--
-- Structure de la table `Order`
--

CREATE TABLE `Order` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `TaxRate` float NOT NULL,
  `TotalAmount` double DEFAULT NULL,
  `TaxAmount` double DEFAULT NULL,
  `CreationTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Order`
--

INSERT INTO `Order` (`Id`, `User_Id`, `TaxRate`, `TotalAmount`, `TaxAmount`, `CreationTimestamp`) VALUES
(31, 11, 20, 88, 17.6, '2019-05-14 13:23:29'),
(32, 9, 20, 65, 13, '2019-05-14 13:37:22'),
(33, 9, 20, 41, 8.2, '2019-05-14 16:30:34'),
(34, 9, 20, 41, 8.2, '2019-05-14 16:38:00');

-- --------------------------------------------------------

--
-- Structure de la table `OrderLine`
--

CREATE TABLE `OrderLine` (
  `Id` int(11) NOT NULL,
  `QuantityOrdered` int(4) NOT NULL,
  `Meal_Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL,
  `PriceEach` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `OrderLine`
--

INSERT INTO `OrderLine` (`Id`, `QuantityOrdered`, `Meal_Id`, `Order_Id`, `PriceEach`) VALUES
(31, 2, 4, 31, 14),
(32, 4, 8, 31, 15),
(33, 2, 1, 32, 12),
(34, 2, 3, 32, 13),
(35, 1, 2, 32, 15),
(36, 2, 3, 33, 13),
(37, 1, 2, 33, 15),
(38, 2, 3, 34, 13),
(39, 1, 2, 34, 15);

-- --------------------------------------------------------

--
-- Structure de la table `Recette`
--

CREATE TABLE `Recette` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Ingredients` varchar(255) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Recette`
--

INSERT INTO `Recette` (`Id`, `Name`, `Ingredients`, `Photo`, `Description`) VALUES
(1, 'Ananas-Banane et Citron-vert', 'Pour 6 personnes\r\nSucre roux : 60 g\r\nAnanas victoria : 1 pièce(s)\r\nBanane(s) : 2 pièce(s)\r\nLait 1/2 écrémé : 30 cl\r\nCitron(s) vert(s) : 1 pièce(s)\r\nGlaçon(s) : 12 pièce(s)', 'ananas-banane-et-citron-vert.jpg', 'Presser le jus d\'un citron vert.\r\nÉplucher et couper en dés l\'ananas et la banane.\r\nDans un blender, mixer les dés de fruits avec le jus du citron et la cassonade, puis ajouter le \r\nlait progressivement pour obtenir une consistance lisse.\r\nRépartir les glaçons dans les verres et verser le smoothie dessus. \r\nServir frais.'),
(2, 'Banane-Fraise et pomme', 'Pour 6 personnes : \r\nBanane(s) : 2 pièce(s)\r\nPomme(s) : 2 pièce(s)\r\nFraise(s) : 200 g\r\nGlaçon(s) : 4 pièce(s)\r\nLait 1/2 écrémé : 40 cl\r\nMiel : 20 g', 'banane-fraise-et-pomme.jpg', 'Éplucher les pommes et les couper en dés. Éplucher les bananes et les couper en rondelles. Laver les fraises et les équeuter.\r\nDisposer ensuite les fruits dans un blender et ajouter les glaçons, le lait et le miel, puis mixer pendant 1 min à puissance maximale.\r\nServir dans un grand verre avec une paille et déguster.'),
(3, 'Banane-kiwi', ' Pour 6 personnes : Kiwis: 12 pièces. Bananes : 6 pièces. 1 cuillère à café de sucre. 3 sachet de sucre vanillé. 42cl d\'eau, 24 glaçons', 'Smoothie-Banane-kiwi.jpg', 'Mixer simplement le tout et on obtient un smoothie onctueux.');

-- --------------------------------------------------------

--
-- Structure de la table `Recetteline`
--

CREATE TABLE `Recetteline` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Recette_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Recetteline`
--

INSERT INTO `Recetteline` (`Id`, `User_Id`, `Recette_Id`) VALUES
(1, 11, 2),
(2, 9, 2);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `Id` int(11) NOT NULL,
  `Admin` tinyint(1) DEFAULT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `City` varchar(40) NOT NULL,
  `ZipCode` char(5) NOT NULL,
  `Phone` char(10) NOT NULL,
  `CreationTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLoginTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`Id`, `Admin`, `FirstName`, `LastName`, `Email`, `Password`, `Address`, `City`, `ZipCode`, `Phone`, `CreationTimestamp`, `LastLoginTimestamp`) VALUES
(9, 1, 'Gérard', 'MANSOIF', 'gerard.mansoif@gmail.com', '$2y$11$014ad2592bd35d187864bO9jIoiPbyeTNwSQhYzf7kSlNyK9vkeuO', 'rue de la soif\r\n', 'Paris', '75001', '0600000000', '2019-05-10 20:55:21', '2019-05-15 09:01:27'),
(10, NULL, '', '', '', '$2y$11$453910ce157fb0ac3df87ujbeDCsfV9P/sgYvFrYkPweAoLmq39Iy', '', '', '', '', '2019-05-10 23:26:38', '2019-05-10 23:26:38'),
(11, NULL, 'lulu', 'robert', 'lulu.robert@gmail.com', '$2y$11$828e61162aaf72e4c146aObtrRA4BhoFz9S6k4VQE5/LLzIh3T9bu', '1 rue de la République', 'Lyon', '69000', '102030140', '2019-05-13 09:29:04', '2019-05-15 09:21:12');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Meal`
--
ALTER TABLE `Meal`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Index pour la table `OrderLine`
--
ALTER TABLE `OrderLine`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Meal_Id` (`Meal_Id`),
  ADD KEY `Order_Id` (`Order_Id`);

--
-- Index pour la table `Recette`
--
ALTER TABLE `Recette`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Recetteline`
--
ALTER TABLE `Recetteline`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Recette_Id` (`Recette_Id`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Meal`
--
ALTER TABLE `Meal`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `Order`
--
ALTER TABLE `Order`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `OrderLine`
--
ALTER TABLE `OrderLine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `Recette`
--
ALTER TABLE `Recette`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Recetteline`
--
ALTER TABLE `Recetteline`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `OrderLine`
--
ALTER TABLE `OrderLine`
  ADD CONSTRAINT `OrderLine_ibfk_1` FOREIGN KEY (`Order_Id`) REFERENCES `Order` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `OrderLine_ibfk_2` FOREIGN KEY (`Meal_Id`) REFERENCES `Meal` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Recetteline`
--
ALTER TABLE `Recetteline`
  ADD CONSTRAINT `RecetteLine_ibfk_1` FOREIGN KEY (`Recette_Id`) REFERENCES `Recette` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `RecetteLine_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
