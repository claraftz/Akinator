-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mar. 17 fév. 2026 à 13:14
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clarafritz_sprint_akinator`
--

-- --------------------------------------------------------

--
-- Structure de la table `Answer`
--

CREATE TABLE `Answer` (
  `id` int(11) NOT NULL,
  `type_answer` varchar(255) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_character` int(11) DEFAULT NULL,
  `id_next_question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Answer`
--

INSERT INTO `Answer` (`id`, `type_answer`, `id_question`, `id_character`, `id_next_question`) VALUES
(1, 'OUI', 1, NULL, 2),
(2, 'NON', 1, NULL, 3),
(3, 'OUI', 2, NULL, 4),
(4, 'NON', 2, NULL, 5),
(5, 'OUI', 3, NULL, 6),
(6, 'NON', 3, NULL, 7),
(7, 'OUI', 4, NULL, 8),
(8, 'NON', 4, NULL, 9),
(9, 'OUI', 5, NULL, 10),
(10, 'NON', 5, NULL, 11),
(11, 'OUI', 6, NULL, 12),
(12, 'NON', 6, NULL, 13),
(13, 'OUI', 7, NULL, 14),
(14, 'NON', 7, NULL, 15),
(15, 'OUI', 8, 1, NULL),
(16, 'NON', 8, 2, NULL),
(17, 'OUI', 9, 3, NULL),
(18, 'NON', 9, 4, NULL),
(19, 'OUI', 10, 5, NULL),
(20, 'NON', 10, 6, NULL),
(21, 'OUI', 11, 7, NULL),
(22, 'NON', 11, 8, NULL),
(23, 'OUI', 12, 9, NULL),
(24, 'NON', 12, 10, NULL),
(25, 'OUI', 13, 11, NULL),
(26, 'NON', 13, 12, NULL),
(27, 'OUI', 14, 13, NULL),
(28, 'NON', 14, 14, NULL),
(29, 'OUI', 15, 15, NULL),
(30, 'NON', 15, 16, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Character`
--

CREATE TABLE `Character` (
  `id` int(11) NOT NULL,
  `name_character` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Character`
--

INSERT INTO `Character` (`id`, `name_character`, `description`, `picture`) VALUES
(1, 'Dark Vador', 'Seigneur Sith, père de Luke', 'vador.png'),
(2, 'Kylo Ren', 'Fils de Han et Leia', 'kylo.png'),
(3, 'Palpatine', 'L\'Empereur Sith', 'palpatine.png'),
(4, 'Dark Maul', 'Apprenti de Sidious au sabre double', 'maul.png'),
(5, 'Yoda', 'Grand Maître Jedi', 'yoda.png'),
(6, 'Grogu', 'L\'Enfant (Baby Yoda)', 'grogu.png'),
(7, 'Obi-wan Kenobi', 'Maître Jedi d\'Anakin et Luke', 'obiwan.png'),
(8, 'Luke Skywalker', 'Le dernier Jedi', 'luke.png'),
(9, 'Boba Fett', 'Chasseur de primes', 'boba.png'),
(10, 'Han solo', 'Contrebandier et pilote du Faucon', 'han.png'),
(11, 'Princesse Leia', 'Leader de la Rébellion', 'leia.png'),
(12, 'Padmé Amidala', 'Sénatrice de Naboo', 'padme.png'),
(13, 'R2D2', 'Petit droïde astromécano bleu', 'r2d2.png'),
(14, 'C3PO', 'Droïde de protocole doré', 'c3po.png'),
(15, 'Chewbacca', 'Copilote Wookiee', 'chewie.png'),
(16, 'Jabba le Hutt', 'Seigneur du crime sur Tatooine', 'jabba.png');

-- --------------------------------------------------------

--
-- Structure de la table `Game`
--

CREATE TABLE `Game` (
  `id` int(11) NOT NULL,
  `date_game` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_character` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Player`
--

CREATE TABLE `Player` (
  `id` int(11) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Question`
--

CREATE TABLE `Question` (
  `id` int(11) NOT NULL,
  `text_question` varchar(255) NOT NULL,
  `is_first` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Question`
--

INSERT INTO `Question` (`id`, `text_question`, `is_first`) VALUES
(1, 'Est ce que ton personnage utilise la Force ?', 1),
(2, 'A t\'il sombré du côté obscur ?', 0),
(3, 'Est-ce un humain ?', 0),
(4, 'Porte t\'il un masque pour respirer ?', 0),
(5, 'Est-il de petite taille (< 1 mètre) ?', 0),
(6, 'Est-il un hors la loi / criminel ?', 0),
(7, 'Est-il fait de métal ?', 0),
(8, 'Est il le père du héros ?', 0),
(9, 'Est il l\'Empereur ?', 0),
(10, 'Est-il de couleur verte ?', 0),
(11, 'A-t-il connu la guerre des Clones ?', 0),
(12, 'Porte-t-il un casque mandalorien ?', 0),
(13, 'Est-elle une dirigeante politique ?', 0),
(14, 'Est-il de forme cylindrique ?', 0),
(15, 'Est-il un copilote poilu ?', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_question` (`id_question`),
  ADD KEY `id_character` (`id_character`),
  ADD KEY `id_next_question` (`id_next_question`);

--
-- Index pour la table `Character`
--
ALTER TABLE `Character`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Game`
--
ALTER TABLE `Game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_character` (`id_character`);

--
-- Index pour la table `Player`
--
ALTER TABLE `Player`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Answer`
--
ALTER TABLE `Answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `Character`
--
ALTER TABLE `Character`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Game`
--
ALTER TABLE `Game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Player`
--
ALTER TABLE `Player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Question`
--
ALTER TABLE `Question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `Answer_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `Question` (`id`),
  ADD CONSTRAINT `fk_answer_character` FOREIGN KEY (`id_character`) REFERENCES `Character` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_next_question` FOREIGN KEY (`id_next_question`) REFERENCES `Question` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `Game`
--
ALTER TABLE `Game`
  ADD CONSTRAINT `Game_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Player` (`id`),
  ADD CONSTRAINT `Game_ibfk_2` FOREIGN KEY (`id_character`) REFERENCES `Character` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
