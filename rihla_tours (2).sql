-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 23 déc. 2023 à 18:10
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rihla_tours`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$K5wux4JR8tm8JfhdcmDMFOTtBWPNiPKaLF8fpIzxdbZ4K19xtczaW');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `destination_id`, `user_name`, `comment_text`, `comment_date`) VALUES
(1, 7, 'yassine ahmed', 'tooooop', '2023-12-15 23:21:44'),
(2, 7, 'yassine ahmed', 'belle', '2023-12-15 23:23:16'),
(3, 8, 'visiteur', 'toop', '2023-12-23 16:32:36');

-- --------------------------------------------------------

--
-- Structure de la table `demande_reservation_hotel`
--

CREATE TABLE `demande_reservation_hotel` (
  `id_demande` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `billet_vol` varchar(255) NOT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat` enum('en_attente','traite','annule') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_reservation_hotel`
--

INSERT INTO `demande_reservation_hotel` (`id_demande`, `id_utilisateur`, `id_hotel`, `billet_vol`, `date_reservation`, `etat`) VALUES
(6, 3, 1, '657c5173cfb4e_657b4a479d15a_screencapture-localhost-rihla-login-php-2023-12-14-12_17_22.png', '2023-12-27 23:00:00', 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `demande_reservation_vol`
--

CREATE TABLE `demande_reservation_vol` (
  `id_demande` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_vol` int(11) NOT NULL,
  `preuve_reservation` varchar(255) NOT NULL,
  `date_reservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat` enum('en_attente','traite','annule') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_reservation_vol`
--

INSERT INTO `demande_reservation_vol` (`id_demande`, `id_utilisateur`, `id_vol`, `preuve_reservation`, `date_reservation`, `etat`) VALUES
(6, 3, 4, '657b4a479d15a_screencapture-localhost-rihla-login-php-2023-12-14-12_17_22.png', '2023-12-15 23:00:00', 'en_attente'),
(7, 4, 1, '65870fd4ef972_icons8-google-48.png', '2023-12-25 23:00:00', 'traite');

-- --------------------------------------------------------

--
-- Structure de la table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `nom_destination` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `pays_region` varchar(255) DEFAULT NULL,
  `type_destination` varchar(255) DEFAULT NULL,
  `attractions_principales` text DEFAULT NULL,
  `meilleure_saison` varchar(255) DEFAULT NULL,
  `cout_moyen` decimal(10,2) DEFAULT NULL,
  `equipements` text DEFAULT NULL,
  `recommandations_securite` text DEFAULT NULL,
  `photos` text DEFAULT NULL,
  `avis_voyageurs` text DEFAULT NULL,
  `offres_speciales` text DEFAULT NULL,
  `accessibilite` varchar(255) DEFAULT NULL,
  `restrictions_conditions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `destinations`
--

INSERT INTO `destinations` (`id`, `nom_destination`, `description`, `pays_region`, `type_destination`, `attractions_principales`, `meilleure_saison`, `cout_moyen`, `equipements`, `recommandations_securite`, `photos`, `avis_voyageurs`, `offres_speciales`, `accessibilite`, `restrictions_conditions`) VALUES
(4, 'Hamamat Tunisie', 'visiter hamamat tunisi et profiter des souvenir', 'Tunisie', 'plage', 'hrissa , picsine', 'fest', 200000.00, 'tout inclus', '', 'uploads/photo_657a3115277282.85698669.png', 'TOOOP', 'profiter de sejour a partirr de 130000 da ', 'tous', 'armé, non visa'),
(6, 'Paris', 'Ville lumière, ville des amoureux, Paris inspire et attire', 'France', 'rural', 'croissante', 'fest', 12000.00, 'tout inclus', '', 'uploads/657ab8459667e9.56503944.jpg', 'top', 'profiter de sejour a partirr de 130000 da ', '', ''),
(7, 'Cairo', 'Comme l’Égypte est une destination que plusieurs personnes rêvent de visiter', 'Egypte', 'plage', 'pyramids', 'fest', 30000.00, 'tout inclus', '', 'uploads/657aba608724e4.37293967.jpeg', 'topp', 'profiter de sejour a partirr de 130000 da ', 'tous', ''),
(8, 'tabarka', 'belle place ', 'Tunisie', 'aventure', 'hrissa , picsine', 'festival', 12000.00, 'PC , WIFI , GARAGE', '', 'uploads/65870b6dc80367.36381563.jpg', 'tooop', 'profiter de sejour a partirr de 130000 da ', 'tous', 'non fumeur');

-- --------------------------------------------------------

--
-- Structure de la table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `nom_hotel` varchar(255) NOT NULL,
  `emplacement` varchar(255) NOT NULL,
  `etoiles` int(11) DEFAULT NULL,
  `type_chambre` varchar(255) DEFAULT NULL,
  `nombre_chambres_dispo` int(11) DEFAULT NULL,
  `tarif_nuit` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `equipements` text DEFAULT NULL,
  `politique_annulation` text DEFAULT NULL,
  `options_restauration` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hotels`
--

INSERT INTO `hotels` (`id`, `nom_hotel`, `emplacement`, `etoiles`, `type_chambre`, `nombre_chambres_dispo`, `tarif_nuit`, `description`, `equipements`, `politique_annulation`, `options_restauration`) VALUES
(1, 'ROYAL PALMS', 'Tunisie', 5, 'F4', 222, 5000.00, 'Lorem ipsum dolor', 'PC , WIFI , GARAGE', 'NON', 'TOUT INCLUS'),
(3, 'dar ismaeil', 'Tunisie', 5, 'f3', 500, 32000.00, 'TOOP', 'tout inclus', '2 JRS AVANTS', 'TOUT INCLUS');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `etat` enum('en_attente','traite','annule') NOT NULL DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `destination_id`, `reservation_date`, `etat`) VALUES
(1, 3, 4, '2023-12-15 15:17:25', 'en_attente'),
(2, 3, 6, '2023-12-15 15:20:19', 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` enum('Homme','Femme') NOT NULL,
  `addres` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_naissance`, `genre`, `addres`, `telephone`) VALUES
(3, 'koriche', 'haithem', 'koriche@tabiblib-services.com', '$2y$10$2kfogUJuXHIPhb3N5SQefejXGbFQoRiInkH8D2kD.dip8jD/HuQOS', '2003-06-25', 'Homme', 'Rue rahmania douera', '0796139346'),
(4, 'Koriche ', 'haithem', 'koriche@gmail.com', '$2y$10$qv0vSCfmkA5fmzbDJAtzLetYuJnMxS0fcaNIkObJQcCMXJhIQhkKO', '2003-02-23', 'Homme', 'Rue rahmania douera', '0796130346');

-- --------------------------------------------------------

--
-- Structure de la table `vols`
--

CREATE TABLE `vols` (
  `id` int(11) NOT NULL,
  `nom_vol` varchar(255) NOT NULL,
  `compagnie` varchar(255) NOT NULL,
  `numero_vol` varchar(100) DEFAULT NULL,
  `origine` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `depart` datetime NOT NULL,
  `arrivee` datetime NOT NULL,
  `duree` varchar(100) NOT NULL,
  `classe` enum('Économique','Affaires','Première classe') NOT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `places_disponibles` int(11) NOT NULL,
  `statut` enum('Planifié','Retardé','Annulé') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vols`
--

INSERT INTO `vols` (`id`, `nom_vol`, `compagnie`, `numero_vol`, `origine`, `destination`, `depart`, `arrivee`, `duree`, `classe`, `tarif`, `places_disponibles`, `statut`) VALUES
(1, 'alg-354', 'Air algerie', '12', 'Alger', 'Dubai', '2023-12-13 01:17:00', '2023-12-13 02:14:00', '2', 'Économique', 35000.00, 30, 'Planifié'),
(4, 'fr-234', 'Air France', '13', 'Alger', 'France', '2023-12-14 11:37:00', '2023-12-14 12:37:00', '1', 'Première classe', 12000.00, 100, 'Planifié');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Index pour la table `demande_reservation_hotel`
--
ALTER TABLE `demande_reservation_hotel`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Index pour la table `demande_reservation_vol`
--
ALTER TABLE `demande_reservation_vol`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_vol` (`id_vol`);

--
-- Index pour la table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_ibfk_1` (`user_id`),
  ADD KEY `reservations_ibfk_2` (`destination_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `vols`
--
ALTER TABLE `vols`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `demande_reservation_hotel`
--
ALTER TABLE `demande_reservation_hotel`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `demande_reservation_vol`
--
ALTER TABLE `demande_reservation_vol`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vols`
--
ALTER TABLE `vols`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`);

--
-- Contraintes pour la table `demande_reservation_hotel`
--
ALTER TABLE `demande_reservation_hotel`
  ADD CONSTRAINT `demande_reservation_hotel_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_reservation_hotel_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande_reservation_vol`
--
ALTER TABLE `demande_reservation_vol`
  ADD CONSTRAINT `demande_reservation_vol_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_reservation_vol_ibfk_2` FOREIGN KEY (`id_vol`) REFERENCES `vols` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
