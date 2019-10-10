-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 oct. 2019 à 22:08
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_projet6`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(93, 'Flip', 'Its a backflip trick snow, you can learn this on all condition. Please take picture if you make this trick'),
(94, 'Grab', 'Its a hard trick snow, you can learn this on all condition. Please take picture if you make this trick'),
(95, 'Slides', 'This is a Air Tricks'),
(96, 'One Foot Tricks', 'category for beginners');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tricks_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C3B153154` (`tricks_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `tricks_id`, `user_id`, `content`, `created_at`) VALUES
(83, 305, 48, 'Great Tricks', '2019-10-09 21:59:46'),
(84, 306, 48, 'Go to prepare this tricks in holliday !!', '2019-10-09 21:59:46'),
(85, 307, 48, 'nice !! i try this after ', '2019-10-09 21:59:46'),
(86, 308, 48, 'nice !! i try this after ', '2019-10-09 21:59:46'),
(87, 309, 48, 'Excellent, more information please', '2019-10-09 21:59:46'),
(88, 310, 48, 'Funny', '2019-10-09 21:59:46'),
(89, 311, 48, 'good but its not easy', '2019-10-09 21:59:46'),
(90, 312, 48, 'Picture is attractive <3', '2019-10-09 21:59:46'),
(91, 313, 48, 'Go to prepare this tricks in holliday !!', '2019-10-09 21:59:46'),
(92, 314, 48, 'cool ', '2019-10-09 21:59:46');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tricks_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_6A2CA10C3B153154` (`tricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `tricks_id`, `path`, `type`, `texte`, `thumbnail`) VALUES
(270, 305, 'demo/0.jpg', 'Picture', 'Hello World1', 1),
(271, 306, 'demo/4.jpg', 'Picture', 'Hello World2', 1),
(272, 307, 'demo/6.jpg', 'Picture', 'Hello World3', 1),
(273, 308, 'demo/7.jpg', 'Picture', 'Hello World4', 1),
(274, 309, 'demo/5.jpg', 'Picture', 'Hello World5', 1),
(275, 310, 'demo/0.jpg', 'Picture', 'Hello World6', 1),
(276, 311, 'demo/3.jpg', 'Picture', 'Hello World7', 1),
(277, 312, 'demo/7.jpg', 'Picture', 'Hello World8', 1),
(278, 313, 'demo/3.jpg', 'Picture', 'Hello World9', 1),
(279, 314, 'demo/7.jpg', 'Picture', 'Hello World10', 1),
(280, 315, 'demo/1.jpg', 'Picture', 'Hello World11', 1),
(281, 316, 'demo/3.jpg', 'Picture', 'Hello World12', 1),
(282, 317, 'demo/2.jpg', 'Picture', 'Hello World13', 1),
(283, 318, 'demo/4.jpg', 'Picture', 'Hello World14', 1),
(284, 319, 'demo/1.jpg', 'Picture', 'Hello World15', 1),
(285, 320, 'demo/6.jpg', 'Picture', 'Hello World16', 1),
(286, 321, 'demo/7.jpg', 'Picture', 'Hello World17', 1),
(287, 322, 'demo/1.jpg', 'Picture', 'Hello World18', 1),
(288, 323, 'demo/2.jpg', 'Picture', 'Hello World19', 1),
(289, 324, 'demo/5.jpg', 'Picture', 'Hello World20', 1),
(290, 325, 'demo/7.jpg', 'Picture', 'Hello World21', 1),
(291, 326, 'demo/5.jpg', 'Picture', 'Hello World22', 1),
(292, 327, 'demo/5.jpg', 'Picture', 'Hello World23', 1),
(293, 328, 'demo/7.jpg', 'Picture', 'Hello World24', 1),
(294, 329, 'demo/6.jpg', 'Picture', 'Hello World25', 1),
(295, 330, 'demo/7.jpg', 'Picture', 'Hello World26', 1),
(296, 331, 'demo/7.jpg', 'Picture', 'Hello World27', 1),
(297, 331, 'apply-5d9e5868f21b3.png', 'Picture', 'mm', 0),
(298, 329, 'apply-5d9e588671aa9.png', 'Picture', 'll', 0),
(299, 328, 'capture-5d9e597ca60f2.png', 'Picture', 'Set Texte Valid 2', 0),
(300, 327, 'apply-5d9e59ddbf0cb.png', 'Picture', 'sss', 0);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190923212323', '2019-09-23 21:23:46');

-- --------------------------------------------------------

--
-- Structure de la table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `category_tricks_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1D902C1F675F31B` (`author_id`),
  KEY `IDX_E1D902C1FC75E364` (`category_tricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tricks`
--

INSERT INTO `tricks` (`id`, `author_id`, `category_tricks_id`, `name`, `description`) VALUES
(305, 48, 93, 'Japan Air', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.'),
(306, 48, 93, 'Flip', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(307, 48, 93, 'Tail Slide', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.'),
(308, 48, 93, '630 Back Flip', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(309, 48, 93, 'Indie Slide', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series'),
(310, 48, 93, 'Tail Slide', 'Les figures de snowboard sont toutes compliquées, mais celle-ci ne devrait pas vous posez trop de probleme. Même si vous débutez dans cette discipline.'),
(311, 48, 93, 'Truck Driver', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.'),
(312, 48, 93, 'Nose Grab', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(313, 48, 93, 'Hakon Flip', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(314, 48, 93, 'Sad Flip', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(315, 48, 93, 'Japan Air', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.'),
(316, 48, 93, 'Hakon Flip', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(317, 48, 93, 'Tail Slide', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(318, 48, 93, 'Mac Twist', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(319, 48, 93, 'Japan Air', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(320, 48, 93, 'Back Flip', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(321, 48, 93, 'Mute', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(322, 48, 93, 'Tail Slide', 'Les figures de snowboard sont toutes compliquées, mais celle-ci ne devrait pas vous posez trop de probleme. Même si vous débutez dans cette discipline.'),
(323, 48, 93, 'Sad Flip', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(324, 48, 93, 'Nose Slide', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(325, 48, 93, 'Nose Grab', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(326, 48, 93, 'Old School Flip', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.'),
(327, 48, 93, 'Grab Line', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(328, 48, 93, '630 Back Flip', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(329, 48, 93, 'Indie Slide', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.'),
(330, 48, 93, 'Back Flip', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(331, 48, 93, 'Nose Grab', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `token`, `picture`) VALUES
(47, 'helloaloha@gmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$mRGl3HrZDVp09XuiKzJTuuBLkB21UOoFRnioVKoyO3Wv4EsB/s84e', 'aloa', NULL, '0.jpg'),
(48, 'sacha6623@gmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$uLxYwo2rHzOfJ0VFl9ppoumdUOwskywdLrV9/zZGKYUoR61r/kEsO', 'sacha', NULL, '0.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C3B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C3B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `FK_E1D902C1F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E1D902C1FC75E364` FOREIGN KEY (`category_tricks_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
