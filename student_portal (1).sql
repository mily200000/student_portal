-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 07 juin 2025 à 12:31
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `student_portal`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `full_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `full_name`) VALUES
(1, 'abc@gmail.com', 'abc', 'abc');

-- --------------------------------------------------------

--
-- Structure de la table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `display` enum('general','computer_science','physics','chemistry','math') NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `display`, `datetime`) VALUES
(11, 'general', 'generallllllllll', 'general', '2025-06-07 13:28:07'),
(12, 'info', 'informatique', 'computer_science', '2025-06-07 13:28:37'),
(13, 'ph', 'physiqueeeee', 'physics', '2025-06-07 13:29:01');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`) VALUES
(1, 'projet1', 'ppppppppppppp'),
(2, 'prj2', 'prjjjj2'),
(3, 'prj3', 'prjjjj3'),
(4, '3', '33333333333333\r\n'),
(5, '4', '44444444444'),
(6, '5', '5555555');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'ali', 'orara', 'ali@gmail.com', 'ali');

-- --------------------------------------------------------

--
-- Structure de la table `student_project_wishlist`
--

DROP TABLE IF EXISTS `student_project_wishlist`;
CREATE TABLE IF NOT EXISTS `student_project_wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `project_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id_index` (`student_id`),
  KEY `project_id_index` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `student_project_wishlist`
--

INSERT INTO `student_project_wishlist` (`id`, `student_id`, `project_id`) VALUES
(8, 1, 3),
(10, 1, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `student_project_wishlist`
--
ALTER TABLE `student_project_wishlist`
  ADD CONSTRAINT `student_project_wishlist_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_project_wishlist_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
