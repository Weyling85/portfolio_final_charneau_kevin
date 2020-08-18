-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 août 2020 à 23:43
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio_kevin`
--

-- --------------------------------------------------------

--
-- Structure de la table `recommandations`
--

DROP TABLE IF EXISTS `recommandations`;
CREATE TABLE IF NOT EXISTS `recommandations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enterprise` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_message` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandations`
--

INSERT INTO `recommandations` (`id`, `last_name`, `first_name`, `email`, `enterprise`, `message`, `date_message`) VALUES
(12, 'Gates', 'Bill', 'billgates.microsoft@hotmail.com', 'Microsoft Industries', 'J’ai été particulièrement impressionné par la capacité de Kévin à traiter même les clients les plus difficiles, et avec le sourire . Cette compétence prend souvent des années à se développer chez les professionnels des services à la clientèle , mais il semblait parfaitement naturel chez lui. ', '2020-02-18'),
(11, 'Cook', 'Tim', 'timcook@gmail.com', 'Apple', 'Kévin est un esprit brillant, créatif, et rien au monde ne le sied plus que le challenge et l\'excitation de pouvoir découvrir et créer. Je songe plus tard le nommer CEO de mon entreprise. ', '2020-02-18'),
(13, 'Montluc', 'Etienne', 'etiennemonluc@gmail.com', 'Montlucindustries', 'Très bon élément ! Kévin s\'intègre parfaitement et s\'adapte rapidement à toutes les situations pour offrir une solution efficace aux problèmes ! Je recommande ! ', '2020-08-13');

-- --------------------------------------------------------

--
-- Structure de la table `user_message`
--

DROP TABLE IF EXISTS `user_message`;
CREATE TABLE IF NOT EXISTS `user_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enterprise` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_message` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_message`
--

INSERT INTO `user_message` (`id`, `first_name`, `last_name`, `email`, `enterprise`, `message`, `date_message`) VALUES
(25, 'Etienne', 'Montluc', 'Montlucetienne@gmail.com', 'Montlucindustries', 'Bonjour Kévin, \r\nPourrions nous nous rencontrer afin de discuter d\'un éventuel emploi ?\r\n\r\nCordialement,\r\n\r\nEtienne Montluc\r\n', '2020-08-13'),
(24, 'Gerard', 'Manvusa', 'gerardmanvusa@gmail.com', 'LeCamTechno', 'BONJOUR MONSEIGNEUR !', '2020-02-17'),
(23, 'Gerard', 'Manvusa', 'gerardmanvusa@gmail.com', 'LeCamTechno', 'BONJOUR MONSEIGNEUR !', '2020-02-17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
