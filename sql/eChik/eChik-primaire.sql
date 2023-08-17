-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sas-primaire
CREATE DATABASE IF NOT EXISTS `sas-primaire` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sas-primaire`;

-- Dumping structure for table sas-primaire.annee_scolaires
CREATE TABLE IF NOT EXISTS `annee_scolaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `annee_scolaires_nom_unique` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.annee_scolaires: ~4 rows (approximately)
/*!40000 ALTER TABLE `annee_scolaires` DISABLE KEYS */;
INSERT INTO `annee_scolaires` (`id`, `nom`, `date_debut`, `date_fin`, `selected`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '2022-2023', '2022-09-02', '2023-07-02', 0, '2022-08-24 14:55:26', '2022-11-17 18:33:09', NULL),
	(2, '2023-2024', '2023-09-02', '2024-07-02', 0, '2022-08-29 19:21:58', '2023-07-18 12:45:32', '2023-08-15 18:50:22'),
	(3, '2024-2025', '2024-09-02', '2025-07-02', 0, '2022-09-15 14:02:08', '2023-05-09 16:13:38', '2023-05-09 16:13:38'),
	(4, '2021-2022', '2021-09-22', '2022-07-02', 0, '2023-05-09 16:26:55', '2023-05-09 16:26:55', NULL);
/*!40000 ALTER TABLE `annee_scolaires` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_article_id` bigint(20) unsigned DEFAULT NULL,
  `unite_article_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_categorie_article_id_foreign` (`categorie_article_id`),
  KEY `articles_unite_article_id_foreign` (`unite_article_id`),
  CONSTRAINT `articles_categorie_article_id_foreign` FOREIGN KEY (`categorie_article_id`) REFERENCES `categorie_articles` (`id`),
  CONSTRAINT `articles_unite_article_id_foreign` FOREIGN KEY (`unite_article_id`) REFERENCES `unite_articles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.articles: ~4 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `num_serie`, `nom`, `categorie_article_id`, `unite_article_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '001', 'Chaise', 1, 1, '2023-08-12 17:55:33', '2023-08-12 17:55:34', NULL),
	(6, '002', 'Table de Bureau', 1, 1, '2023-08-14 09:45:02', '2023-08-14 09:45:04', NULL),
	(7, '1236588', 'Ordinateur Portable HP 250', 1, 1, '2023-08-15 09:26:57', '2023-08-15 09:26:57', NULL),
	(9, '0015', 'Ruban Rouge', 2, 2, '2023-08-15 12:00:25', '2023-08-15 12:30:33', NULL);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.categorie_articles
CREATE TABLE IF NOT EXISTS `categorie_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.categorie_articles: ~2 rows (approximately)
/*!40000 ALTER TABLE `categorie_articles` DISABLE KEYS */;
INSERT INTO `categorie_articles` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Materiel de Bureau', '2023-08-12 17:54:58', '2023-08-12 17:54:58', NULL),
	(2, 'Materiel Didactiques', '2023-08-15 11:31:47', '2023-08-15 11:31:47', NULL);
/*!40000 ALTER TABLE `categorie_articles` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.categorie_cours
CREATE TABLE IF NOT EXISTS `categorie_cours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.categorie_cours: ~8 rows (approximately)
/*!40000 ALTER TABLE `categorie_cours` DISABLE KEYS */;
INSERT INTO `categorie_cours` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'MATHEMATIQUES', '2022-08-24 15:03:01', '2023-04-13 17:13:51', NULL),
	(2, 'FRANÇAIS', '2022-08-24 15:03:13', '2023-04-13 17:21:06', NULL),
	(3, 'CIVISME ET RELIGION', '2022-09-03 09:28:23', '2023-04-13 17:22:00', NULL),
	(4, 'Pornographie', '2022-09-03 09:34:47', '2022-09-03 09:34:49', '2022-09-03 09:34:49'),
	(5, 'ACTIVITES D\'EVEIL SCIENTIFIQUE', '2022-09-03 09:51:39', '2023-04-13 17:12:57', NULL),
	(6, 'ACTIVITES INSTRUMENTALES', '2023-04-13 17:08:59', '2023-04-13 17:08:59', NULL),
	(7, 'ACTIVITES D\'EVEIL ESTHETIQUE', '2023-04-13 17:10:44', '2023-04-13 17:10:44', NULL),
	(8, 'LANGUES NATIONALES', '2023-07-06 21:59:20', '2023-07-06 21:59:41', NULL);
/*!40000 ALTER TABLE `categorie_cours` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_niveau_id_foreign` (`niveau_id`),
  CONSTRAINT `classes_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.classes: ~13 rows (approximately)
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` (`id`, `nom`, `niveau_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'A', 5, '2022-08-24 14:54:36', '2022-08-24 14:54:37', NULL),
	(2, 'A', 6, '2022-08-31 10:53:08', '2022-08-31 10:53:09', NULL),
	(3, 'B', 5, '2022-09-03 07:58:32', '2022-09-03 07:58:32', NULL),
	(4, 'B', 6, '2022-09-03 08:02:21', '2022-09-03 08:02:21', NULL),
	(5, 'A', 7, '2022-09-03 08:40:20', '2022-09-03 08:40:20', NULL),
	(6, 'C', 7, '2022-09-03 08:40:43', '2022-09-03 08:41:21', '2022-09-03 08:41:21'),
	(7, 'B', 7, '2022-09-03 08:41:32', '2022-09-03 08:41:32', NULL),
	(8, 'A', 4, '2022-09-03 08:41:40', '2022-11-23 21:54:33', NULL),
	(9, 'B', 4, '2022-09-03 08:41:47', '2023-07-11 17:42:23', NULL),
	(10, 'A', 8, '2023-01-31 10:30:58', '2023-01-31 10:30:58', NULL),
	(14, 'B', 8, '2023-04-13 15:55:25', '2023-04-13 15:55:25', NULL),
	(15, 'B', 8, '2023-04-13 15:58:39', '2023-04-13 15:58:46', '2023-04-13 15:58:46'),
	(16, 'A', 9, '2023-04-13 15:58:57', '2023-04-13 15:58:57', NULL);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.conduites
CREATE TABLE IF NOT EXISTS `conduites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.conduites: ~5 rows (approximately)
/*!40000 ALTER TABLE `conduites` DISABLE KEYS */;
INSERT INTO `conduites` (`id`, `nom`, `abbreviation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'EXCELLENTE', 'E', '2023-04-07 16:18:12', '2023-04-07 16:18:12', NULL),
	(2, 'TRES BONNE', 'TB', '2023-04-07 16:18:38', '2023-04-07 16:18:38', NULL),
	(3, 'BONNE', 'B', '2023-04-07 16:19:17', '2023-04-07 16:19:17', NULL),
	(4, 'ACCES BONNE', 'AB', '2023-04-07 16:19:26', '2023-04-07 16:19:27', NULL),
	(5, 'MAUVAISE', 'M', '2023-04-07 16:19:40', NULL, NULL);
/*!40000 ALTER TABLE `conduites` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.cours
CREATE TABLE IF NOT EXISTS `cours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_periode` int(11) NOT NULL,
  `max_examen` int(11) NOT NULL,
  `categorie_cours_id` bigint(20) unsigned DEFAULT NULL,
  `niveau_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_categorie_cours_id_foreign` (`categorie_cours_id`),
  KEY `cours_niveau_id_foreign` (`niveau_id`),
  CONSTRAINT `cours_categorie_cours_id_foreign` FOREIGN KEY (`categorie_cours_id`) REFERENCES `categorie_cours` (`id`),
  CONSTRAINT `cours_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.cours: ~31 rows (approximately)
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` (`id`, `nom`, `max_periode`, `max_examen`, `categorie_cours_id`, `niveau_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Algebre', 40, 80, 1, 5, '2022-08-24 15:03:38', '2022-08-24 15:03:39', NULL),
	(2, 'Redaction', 20, 40, 2, 5, '2022-08-24 15:04:11', '2023-04-13 17:23:31', NULL),
	(3, 'Correspondance', 20, 40, 2, 5, '2022-09-01 02:56:14', '2022-09-03 14:40:59', NULL),
	(4, 'Geometrie', 20, 40, 1, 5, '2022-09-01 02:56:12', '2022-09-03 10:47:42', NULL),
	(6, 'Geographie', 20, 40, 5, 5, '2022-09-03 10:09:49', '2022-09-03 10:09:49', NULL),
	(7, 'Histoire', 20, 40, 5, 5, '2022-09-03 10:11:08', '2022-09-03 11:28:16', NULL),
	(8, 'botanique', 20, 40, 5, 7, '2022-10-25 14:51:53', '2022-10-25 14:51:53', NULL),
	(9, 'ECM', 10, 20, 3, 5, '2023-04-13 14:46:22', '2023-04-13 14:46:23', NULL),
	(10, 'Religion', 10, 20, 3, 9, '2023-07-06 22:01:22', '2023-07-06 22:01:22', NULL),
	(11, 'ECM', 10, 20, 3, 9, '2023-07-06 22:01:54', '2023-07-06 22:01:54', NULL),
	(12, 'Gram.Conj-Analy', 7, 14, 8, 9, '2023-07-06 22:03:15', '2023-07-06 23:32:17', NULL),
	(13, 'Elo.Voc.Récit', 6, 12, 8, 9, '2023-07-06 22:03:50', '2023-07-06 22:03:50', NULL),
	(14, 'Redact.Orthograp.', 4, 8, 8, 9, '2023-07-06 22:05:23', '2023-07-06 22:05:23', NULL),
	(15, 'Lecture', 3, 6, 8, 9, '2023-07-06 22:05:42', '2023-07-06 22:05:42', NULL),
	(16, 'Gram.Conj-Analy', 20, 40, 2, 9, '2023-07-06 22:06:39', '2023-07-06 22:06:39', NULL),
	(17, 'Elo.Voc.Récit', 25, 50, 2, 9, '2023-07-06 22:06:57', '2023-07-06 22:06:57', NULL),
	(18, 'Redact.Orthograp.', 15, 30, 2, 9, '2023-07-06 22:07:14', '2023-07-06 22:07:14', NULL),
	(19, 'Lecture', 10, 20, 2, 9, '2023-07-06 22:07:28', '2023-07-06 22:07:28', NULL),
	(20, 'Num.Opérations', 20, 40, 1, 9, '2023-07-06 22:07:58', '2023-07-06 22:07:58', NULL),
	(21, 'Grand.F.Géomét', 30, 60, 1, 9, '2023-07-06 22:08:41', '2023-07-06 22:08:41', NULL),
	(22, 'Problemes', 20, 40, 1, 9, '2023-07-06 22:09:03', '2023-07-06 22:09:03', NULL),
	(23, 'Ed.Santé & Envir', 10, 20, 5, 9, '2023-07-06 22:09:36', '2023-07-06 22:09:36', NULL),
	(24, 'Histoire', 10, 20, 5, 9, '2023-07-06 22:09:59', '2023-07-06 22:09:59', NULL),
	(25, 'Géographie', 10, 20, 5, 9, '2023-07-06 22:10:23', '2023-07-06 22:10:23', NULL),
	(26, 'Sciences Naturel', 20, 40, 5, 9, '2023-07-06 22:11:12', '2023-07-06 22:11:12', NULL),
	(27, 'Dessin', 10, 20, 7, 9, '2023-07-06 22:11:51', '2023-07-06 22:11:51', NULL),
	(28, 'Calligraphie', 10, 20, 7, 9, '2023-07-06 22:12:22', '2023-07-06 22:12:22', NULL),
	(29, 'Chant/Musique', 10, 20, 7, 9, '2023-07-06 22:12:46', '2023-07-06 22:12:46', NULL),
	(30, 'Ed.Phys & Sports', 10, 20, 7, 9, '2023-07-06 22:13:20', '2023-07-06 22:13:20', NULL),
	(31, 'Travail Manuel', 10, 20, 7, 9, '2023-07-06 22:13:39', '2023-07-06 22:13:39', NULL),
	(32, 'Dedicace', 20, 40, 2, 9, '2023-08-04 15:44:49', '2023-08-04 15:44:49', NULL);
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.eleves
CREATE TABLE IF NOT EXISTS `eleves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `nom_pere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_mere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parrain_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleves_parrain_id_foreign` (`parrain_id`),
  CONSTRAINT `eleves_parrain_id_foreign` FOREIGN KEY (`parrain_id`) REFERENCES `parrains` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.eleves: ~39 rows (approximately)
/*!40000 ALTER TABLE `eleves` DISABLE KEYS */;
INSERT INTO `eleves` (`id`, `matricule`, `nom`, `prenom`, `sexe`, `lieu_naissance`, `date_naissance`, `nom_pere`, `nom_mere`, `adresse`, `parrain_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'E269/2022', 'Keaton', 'Paucek', 'M', 'Greentown', '1986-01-20', 'Dr. Peyton Schimmel', 'Mrs. Gina Strosin I', '77497 Tromp Dale\nStephonborough, MO 39691', NULL, '2022-08-24 13:01:17', '2022-09-05 10:48:16', '2022-09-05 10:48:16'),
	(2, 'E455/2022', 'Laila', 'Del Minor', 'F', 'South Elmer', '2009-01-10', 'Zane Crona', 'Nelle Schneider', '4626 Kuhic RanchStephenstad, ME 09963', NULL, '2022-08-24 13:01:17', '2022-09-06 08:19:16', NULL),
	(3, 'E428/2022', 'Jalon', 'Wiegand', 'M', 'Port Kellenfurt', '1998-01-24', 'Giovani Effertz', 'Fae Jones', '823 Adelle PlaceLake Daniellastad, NV 62133', NULL, '2022-08-24 13:01:17', '2023-03-22 20:14:38', NULL),
	(4, 'E480/2022', 'Korbin', 'Kshlerin', 'F', 'North Ottomouth', '1981-05-17', 'Mr. Troy Kshlerin DVM', 'Prof. Elinore Ritchie I', '7516 Muller Summit Apt. 197\nLake Chloe, CT 79149-3041', NULL, '2022-08-24 13:01:17', '2022-09-09 15:16:57', '2022-09-09 15:16:57'),
	(5, 'E464/2022', 'Carli', 'Rutherford', 'F', 'Candidafort', '2004-12-20', 'Seamus Runte', 'Frieda Hamill', '2401 Nienow Squares Suite 503\nSouth Robbie, MO 79972-3885', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(6, 'E493/2022', 'Otilia', 'Collier', 'F', 'Funkbury', '1979-11-11', 'Dr. Laurel Funk', 'Ms. Myrtis Leffler', '55071 Morissette Loaf\nHanefort, OK 95998', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(7, 'E102/2022', 'Cole', 'Lowe', 'M', 'New Afton', '2022-04-09', 'Dr. Darien Larkin', 'Miss Maddison Gusikowski DDS', '938 Nadia Road Apt. 825\nNorth Dianna, NV 19446', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(8, 'E460/2022', 'Alison', 'Braun', 'F', 'Paucekfurt', '2009-02-01', 'Antone Schmidt', 'Nina Berge', '848 Garry Street Apt. 802\nLake Ephraim, MD 65470', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(9, 'E112/2022', 'Clarissa', 'Langosh', 'F', 'Lake Kolbyside', '1989-09-22', 'Luigi Stark', 'Asa Cormier', '384 Schmeler Squares Suite 724\nWest Eudorahaven, MO 33504-1676', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(10, 'E406/2022', 'Eloise', 'Volkman', 'M', 'Kalliestad', '2002-04-12', 'Jaylon Fahey', 'Madaline Nader', '245 Stoltenberg Road Apt. 403\nNew Sheldonberg, RI 88277', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(11, 'E417/2022', 'Brendan', 'Klocko', 'F', 'North Adolphborough', '1978-12-24', 'Brenden Klein', 'Ms. Kaya Wintheiser III', '873 Emard Mills\nFeilville, IA 51926-3163', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(12, 'E447/2022', 'Jailyn', 'Kuhlman', 'M', 'East Frances', '2005-08-21', 'Randall Witting', 'Aditya Mertz', '96138 Alvis Mews\nNorth Jaydenchester, NE 96346-4794', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(13, 'E406/2022', 'Kadin', 'Veum', 'F', 'Llewellynside', '1998-12-06', 'Kayleigh Treutel', 'Carolyn Erdman', '90885 Mac Keys Suite 448\nHomenickchester, NY 21611-5955', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(14, 'E537/2022', 'Carey', 'Rempel', 'M', 'North Foster', '1993-10-13', 'Jacey Stoltenberg', 'Dr. Eulah Larson', '489 Borer Walks\nVirgilport, IN 33464-5620', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(15, 'E443/2022', 'Esmeralda', 'Osinski', 'F', 'Delphiafurt', '2015-08-02', 'Rocio Harvey', 'Ms. Jaqueline Hermiston', '95557 Kirlin Valley Apt. 860\nLake Luella, MD 74754', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(16, 'E227/2022', 'Gabriel', 'Botsford', 'M', 'New Gailview', '2008-06-11', 'Rylan Rutherford', 'Berenice Treutel', '383 Ferry Trail Apt. 432\nLangmouth, VT 50517', NULL, '2022-08-24 13:01:17', '2023-02-04 11:18:51', '2023-02-04 11:18:51'),
	(17, 'E440/2022', 'Palma', 'Romaguera', 'F', 'North Jerry', '2002-07-31', 'Dr. Horace Crist IV', 'Prof. Daphney Lubowitz Sr.', '2182 Ferry Villages Suite 928\nFidelchester, MA 19385-8539', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(18, 'E480/2022', 'Nickolas', 'Hoeger', 'M', 'Altenwerthborough', '1988-12-21', 'Dr. Sidney Howell PhD', 'Casandra Frami', '7815 Ulises Drives Apt. 785\nSouth Briaport, NC 53976', NULL, '2022-08-24 13:01:17', '2022-08-28 23:42:33', '2022-08-28 23:42:33'),
	(19, 'E402/2022', 'Candace', 'Schowalter', 'F', 'Ressiemouth', '1977-01-20', 'Heber Lehner', 'Delphia Wisoky', '14799 Anne Ways\nEast Julius, UT 07524', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(20, 'E579/2022', 'Gilda', 'Keebler', 'F', 'East Luisaville', '1985-03-31', 'Prof. Cordelia Hahn', 'Natalie Abshire', '15863 Abernathy Meadow Suite 163\nNorth Brielle, MD 53461-7406', NULL, '2022-08-24 13:01:17', '2022-08-24 13:01:17', NULL),
	(21, 'E580/2022', 'Bartime Mulindi', 'MHD', 'M', 'Bukavu', '2006-01-12', 'Mulindi Kabanga', 'Luguvi Antoinette', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', 3, '2022-08-28 21:41:00', '2023-07-06 22:21:11', NULL),
	(22, 'E581/2022', 'Atosha Molisho', 'Nickel', 'F', 'Bujumbura', '2022-08-10', 'Beau-Pere', 'Belle-Mere', '121 Gihosha, Gihosha, Bujumbura-Merie', 6, '2022-08-28 23:38:04', '2023-06-27 10:17:56', NULL),
	(23, 'E582/2022', 'Brayant', 'Kobe', 'M', 'New York', '1559-12-12', 'Bryant Jackson', 'Alida Jackson', 'Kinindo', NULL, '2022-08-31 08:49:56', '2022-11-19 10:48:39', NULL),
	(24, 'E583/2022', 'Bintu Rutakaza', 'Teddy', 'M', 'Kinshasa', '1993-12-12', 'Rutakaza Sr', 'Mme Rutakaza', 'Bujumbura', NULL, '2022-09-09 15:01:38', '2022-11-19 10:48:20', NULL),
	(25, 'E584/2022', 'Christian', 'Jerry', 'M', 'Lemera', '1993-01-08', 'Mulindi', 'Antoinette', 'Bukavu', NULL, '2022-09-15 13:15:15', '2022-11-19 10:46:29', NULL),
	(26, 'E585/2022', 'Enseignant', 'Gouver', 'M', 'Bukavu', '2022-09-25', 'Rutakaza Sr', 'Belle-Mere', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', NULL, '2022-09-15 13:34:44', '2023-04-13 21:39:28', '2023-04-13 21:39:28'),
	(27, 'E586/2022', 'Ndioni Tonobunu', 'Jeannot', 'M', 'Goma', '1995-10-10', 'Tonobunu', 'Mme Tonobunu', '19 Nyakabiga 2, Mukaza, Bujumbura-Merie', NULL, '2022-11-19 10:07:14', '2023-01-31 10:32:04', NULL),
	(28, 'E587/2023', 'Ingenieur', 'Jascript', 'M', 'Bukavu', '2023-02-03', 'Rutakaza Sr', 'Belle-Mere', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', NULL, '2023-02-03 14:04:05', '2023-02-04 09:23:54', '2023-02-04 09:23:54'),
	(29, 'E588/2023', 'Enseignant', 'Gouver', 'M', 'Bukavu', '2023-02-04', 'Rutakaza Sr', 'Belle-Mere', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', NULL, '2023-02-03 14:06:27', '2023-02-04 09:23:47', '2023-02-04 09:23:47'),
	(30, 'E587/2023', 'KIZA KABANGA', 'Sebastien', 'M', 'Lemera', '1995-10-05', 'KIZA KABANGA', 'BAHATI KABANGA', 'Bujumbura, Cibitoke', 3, '2023-04-02 09:49:52', '2023-04-12 11:02:53', NULL),
	(31, 'E588/2023', 'Cirhuza Masumbuko', 'Chrispin', 'M', 'Bukavu', '2002-12-12', 'Jean Mado', 'Kyala', 'PZ Route Panzi', 4, '2023-04-12 22:29:08', '2023-04-13 21:53:40', NULL),
	(32, 'E589/2023', 'Cithona jerome', 'fabrice', 'M', 'Bukavu', '2000-11-01', 'Cithona', 'Antoinette', 'av. Jean miruho', 4, '2023-04-13 12:27:28', '2023-04-13 12:38:19', NULL),
	(33, 'E590/2023', 'cubaka mirhimeluga', 'rodrigue', 'M', 'bukavu', '2000-12-04', 'mirhimeluga', 'Soise', 'route panzi', NULL, '2023-04-13 15:34:02', '2023-04-13 15:34:02', NULL),
	(34, 'E591/2023', 'Zawadi Lubala', 'Jeanne D\'Arc', 'F', 'Bukavu', '2000-04-12', 'Lubala Chibuzi', 'Madame Chibuzi', 'Mushununu', NULL, '2023-04-13 21:55:41', '2023-04-13 21:55:41', NULL),
	(35, 'E592/2023', 'julie prisca', 'julia', 'F', 'Goma', '1999-08-12', 'lucien', 'mireille', 'asiatique', 5, '2023-06-05 13:17:11', '2023-06-27 10:17:01', NULL),
	(36, 'E593/2023', 'Marie Charlotte Molisho', 'Furaha Nathalie', 'F', 'Bujumbura', '2014-12-15', 'Molisho le pere', 'Marie Furaha', 'Gihosha', NULL, '2023-06-06 11:45:31', '2023-06-29 17:49:59', NULL),
	(37, 'E594/2023', 'Abraham Mulindi', 'Tommy', 'M', 'Bukavu', '2001-01-12', 'Mulindi Kabanga', 'Luguvi Antoinette', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', 3, '2023-07-06 22:22:00', '2023-07-14 13:35:38', NULL),
	(38, 'E595/2023', 'Aristote', 'Angek', 'M', 'Bujumbura', '2023-07-07', 'Aristo le Pere', 'Angele La mere', '19 Nyakabiga 2, Mukaza, Bujumbura-Merie', NULL, '2023-07-07 23:18:29', '2023-07-07 23:18:29', NULL),
	(39, 'E596/2023', 'MUhizirwa', 'jean', 'M', 'Bukavu', '2008-01-08', 'Muhizirwa Alex', 'Jeanne Muhizirwa', '19 Nyakabiga 2, Mukaza, Bujumbura-Merie', NULL, '2023-07-08 08:21:25', '2023-07-08 08:21:25', NULL);
/*!40000 ALTER TABLE `eleves` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.eleve_conduites
CREATE TABLE IF NOT EXISTS `eleve_conduites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned DEFAULT NULL,
  `conduite_id` bigint(20) unsigned DEFAULT NULL,
  `periode_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_conduites_eleve_id_foreign` (`eleve_id`),
  KEY `eleve_conduites_conduite_id_foreign` (`conduite_id`),
  KEY `eleve_conduites_periode_id_foreign` (`periode_id`),
  CONSTRAINT `eleve_conduites_conduite_id_foreign` FOREIGN KEY (`conduite_id`) REFERENCES `conduites` (`id`),
  CONSTRAINT `eleve_conduites_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `eleve_conduites_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.eleve_conduites: ~15 rows (approximately)
/*!40000 ALTER TABLE `eleve_conduites` DISABLE KEYS */;
INSERT INTO `eleve_conduites` (`id`, `eleve_id`, `conduite_id`, `periode_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 21, 1, 1, '2023-04-07 20:23:05', '2023-04-07 20:23:06', NULL),
	(2, 21, 2, 2, '2023-04-09 19:49:41', '2023-04-09 19:49:41', NULL),
	(3, 31, 4, 6, '2023-04-13 14:21:03', '2023-04-13 14:21:04', NULL),
	(4, 21, 2, 3, '2023-04-14 18:43:45', '2023-06-11 22:40:32', NULL),
	(5, 21, 5, 4, '2023-04-14 19:08:49', '2023-04-14 19:08:49', NULL),
	(6, 21, 3, 5, '2023-04-30 16:49:36', '2023-04-30 16:49:36', NULL),
	(7, 21, 3, 6, '2023-04-30 16:50:02', '2023-04-30 16:50:02', NULL),
	(8, 37, 2, 1, '2023-07-07 22:19:33', '2023-07-07 22:19:33', NULL),
	(9, 37, 3, 2, '2023-07-14 12:35:46', '2023-07-14 12:35:46', NULL),
	(10, 37, 2, 3, '2023-07-14 12:36:25', '2023-07-14 12:36:25', NULL),
	(11, 37, 3, 4, '2023-07-14 12:36:50', '2023-07-14 12:36:50', NULL),
	(12, 37, 4, 5, '2023-07-14 12:37:04', '2023-07-14 12:37:04', NULL),
	(13, 37, 4, 5, '2023-07-14 12:37:35', '2023-07-14 12:37:35', NULL),
	(14, 37, 4, 5, '2023-07-14 12:43:55', '2023-07-14 12:43:55', NULL),
	(15, 37, 2, 6, '2023-07-14 12:44:10', '2023-07-14 12:44:10', NULL);
/*!40000 ALTER TABLE `eleve_conduites` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.eleve_evaluation
CREATE TABLE IF NOT EXISTS `eleve_evaluation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned NOT NULL,
  `evaluation_id` bigint(20) unsigned NOT NULL,
  `note_obtenu` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_evaluation_eleve_id_foreign` (`eleve_id`),
  KEY `eleve_evaluation_evaluation_id_foreign` (`evaluation_id`),
  CONSTRAINT `eleve_evaluation_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `eleve_evaluation_evaluation_id_foreign` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.eleve_evaluation: ~32 rows (approximately)
/*!40000 ALTER TABLE `eleve_evaluation` DISABLE KEYS */;
INSERT INTO `eleve_evaluation` (`id`, `eleve_id`, `evaluation_id`, `note_obtenu`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 8, 1, 1, NULL, '2023-08-07 23:40:45', NULL),
	(2, 22, 1, 10, NULL, '2023-08-03 10:35:04', NULL),
	(3, 21, 1, 0, NULL, NULL, NULL),
	(4, 23, 1, 0, NULL, NULL, NULL),
	(5, 5, 1, 0, NULL, NULL, NULL),
	(6, 25, 1, 0, NULL, NULL, NULL),
	(7, 31, 1, 0, NULL, NULL, NULL),
	(8, 9, 1, 0, NULL, NULL, NULL),
	(9, 7, 1, 0, NULL, NULL, NULL),
	(10, 10, 1, 0, NULL, NULL, NULL),
	(11, 3, 1, 0, NULL, NULL, NULL),
	(12, 2, 1, 0, NULL, NULL, NULL),
	(13, 27, 1, 0, NULL, NULL, NULL),
	(14, 6, 1, 0, NULL, NULL, NULL),
	(15, 17, 1, 0, NULL, NULL, NULL),
	(16, 34, 1, 0, NULL, NULL, NULL),
	(17, 8, 2, 0, NULL, NULL, NULL),
	(18, 22, 2, 0, NULL, NULL, NULL),
	(19, 21, 2, 0, NULL, NULL, NULL),
	(20, 23, 2, 0, NULL, NULL, NULL),
	(21, 5, 2, 0, NULL, NULL, NULL),
	(22, 25, 2, 0, NULL, NULL, NULL),
	(23, 31, 2, 0, NULL, NULL, NULL),
	(24, 9, 2, 0, NULL, NULL, NULL),
	(25, 7, 2, 0, NULL, NULL, NULL),
	(26, 10, 2, 0, NULL, NULL, NULL),
	(27, 3, 2, 0, NULL, NULL, NULL),
	(28, 2, 2, 0, NULL, NULL, NULL),
	(29, 27, 2, 0, NULL, NULL, NULL),
	(30, 6, 2, 0, NULL, NULL, NULL),
	(31, 17, 2, 0, NULL, NULL, NULL),
	(32, 34, 2, 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `eleve_evaluation` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.eleve_examen
CREATE TABLE IF NOT EXISTS `eleve_examen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned NOT NULL,
  `examen_id` bigint(20) unsigned NOT NULL,
  `note_obtenu` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_examen_eleve_id_foreign` (`eleve_id`),
  KEY `eleve_examen_examen_id_foreign` (`examen_id`),
  CONSTRAINT `eleve_examen_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `eleve_examen_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examens` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.eleve_examen: ~16 rows (approximately)
/*!40000 ALTER TABLE `eleve_examen` DISABLE KEYS */;
INSERT INTO `eleve_examen` (`id`, `eleve_id`, `examen_id`, `note_obtenu`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 8, 1, 0, NULL, NULL, NULL),
	(2, 22, 1, 0, NULL, NULL, NULL),
	(3, 21, 1, 0, NULL, NULL, NULL),
	(4, 23, 1, 0, NULL, NULL, NULL),
	(5, 5, 1, 0, NULL, NULL, NULL),
	(6, 25, 1, 0, NULL, NULL, NULL),
	(7, 31, 1, 0, NULL, NULL, NULL),
	(8, 9, 1, 0, NULL, NULL, NULL),
	(9, 7, 1, 0, NULL, NULL, NULL),
	(10, 10, 1, 0, NULL, NULL, NULL),
	(11, 3, 1, 0, NULL, NULL, NULL),
	(12, 2, 1, 0, NULL, NULL, NULL),
	(13, 27, 1, 0, NULL, NULL, NULL),
	(14, 6, 1, 0, NULL, NULL, NULL),
	(15, 17, 1, 0, NULL, NULL, NULL),
	(16, 34, 1, 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `eleve_examen` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.employers
CREATE TABLE IF NOT EXISTS `employers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.employers: ~15 rows (approximately)
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
INSERT INTO `employers` (`id`, `nom`, `prenom`, `sexe`, `date_naissance`, `formation`, `diplome`, `niveau_etude`, `created_at`, `updated_at`, `matricule`, `deleted_at`) VALUES
	(1, 'Abraham', 'Tommy', 'M', '2000-01-12', 'Informatique', 'Licence', 'licence', '2022-08-23 20:49:59', '2023-06-01 11:42:21', 'P01/2022', NULL),
	(2, 'Lokenze', 'Nathalie', 'F', '2022-08-24', 'Aviation', 'licence', 'A0', '2022-08-24 11:28:51', '2022-09-13 05:55:41', 'P02/2022', NULL),
	(3, 'Jean-luc Mulindi', 'Gouver', 'M', '2022-04-05', 'Langue', 'Master', 'Master', '2022-08-27 03:11:47', '2023-04-13 16:56:23', 'P03/2022', NULL),
	(4, 'Tanya Molisho', 'Nickel', 'F', '2022-08-10', 'Mathematique', 'D\'Etat', 'G3', '2022-08-27 03:26:27', '2023-04-12 23:27:38', 'P04/2022', NULL),
	(5, 'Enseignant', 'Gouver', 'M', '2022-08-17', 'Droit Civile', 'Master', 'MCL', '2022-08-27 03:27:33', '2022-08-27 03:27:40', '000/20221', '2022-08-27 03:27:40'),
	(6, 'Muhoza', 'Clayton Zeptoman', 'M', '1999-06-12', 'Informatique', 'Licence', 'Master', '2022-09-13 06:21:07', '2022-09-15 13:17:44', 'P05/2022', '2022-09-15 13:17:44'),
	(8, 'Ndioni Tonobunu', 'Makunn', 'M', '2022-11-23', 'Mathematique', 'Master', 'Master', '2022-11-23 10:37:11', '2022-11-23 10:37:11', 'P06/2022', NULL),
	(9, 'Ingabire', 'Christa', 'F', '2001-05-12', 'Comptabilité', 'Licence', 'L1', '2023-04-12 23:48:13', '2023-04-12 23:48:13', 'P07/2023', NULL),
	(10, 'Kak Kakisingi', 'Charly', 'M', '1995-02-01', 'Informatique', 'Licence', 'L2', '2023-05-30 13:15:22', '2023-05-30 13:15:22', 'P08/2023', NULL),
	(11, 'Bakanyize', 'Honoré', 'M', '1960-06-02', 'Aucune', 'Aucun', 'Aucun', '2023-06-02 12:59:28', '2023-06-02 12:59:28', 'P09/2023', NULL),
	(12, 'Lucien', 'Abudu', 'M', '1989-06-23', 'Geographie', 'Licence', 'L2', '2023-06-15 19:58:40', '2023-06-15 19:58:40', 'P010/2023', NULL),
	(13, 'Nzisabira', 'Diomede', 'M', '2023-07-13', 'Informatique', 'Licence', 'L2', '2023-07-02 21:07:48', '2023-07-02 21:07:48', 'P011/2023', NULL),
	(14, 'Mastaki Akili', 'Frank', 'M', '2023-07-08', 'Pedagogie', 'Licence', 'L2', '2023-07-07 23:05:31', '2023-07-07 23:05:31', 'P012/2023', NULL),
	(15, 'Clayton Muhoza', 'Zepto', 'M', '1997-01-07', 'Informatique', 'Licence', 'L2', '2023-07-08 08:16:57', '2023-07-08 08:17:39', 'P013/2023', NULL),
	(16, 'Mapamboli', 'Akom', 'M', '2002-01-01', 'Droit Civile', 'Licence', 'G1', '2023-08-03 10:18:49', '2023-08-03 10:18:49', 'P014/2023', NULL);
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.employer_fonction
CREATE TABLE IF NOT EXISTS `employer_fonction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` bigint(20) unsigned NOT NULL,
  `fonction_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_fonction_employer_id_foreign` (`employer_id`),
  KEY `employer_fonction_fonction_id_foreign` (`fonction_id`),
  CONSTRAINT `employer_fonction_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`),
  CONSTRAINT `employer_fonction_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.employer_fonction: ~15 rows (approximately)
/*!40000 ALTER TABLE `employer_fonction` DISABLE KEYS */;
INSERT INTO `employer_fonction` (`id`, `employer_id`, `fonction_id`, `created_at`, `updated_at`) VALUES
	(5, 5, 1, NULL, NULL),
	(12, 2, 2, NULL, NULL),
	(16, 6, 9, NULL, NULL),
	(17, 8, 2, NULL, NULL),
	(19, 4, 2, NULL, NULL),
	(20, 9, 10, NULL, NULL),
	(21, 3, 11, NULL, NULL),
	(22, 10, 9, NULL, NULL),
	(29, 1, 9, NULL, NULL),
	(30, 11, 8, NULL, NULL),
	(31, 12, 2, NULL, NULL),
	(32, 13, 4, NULL, NULL),
	(33, 14, 2, NULL, NULL),
	(35, 15, 2, NULL, NULL),
	(36, 16, 2, NULL, NULL);
/*!40000 ALTER TABLE `employer_fonction` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.encadrements
CREATE TABLE IF NOT EXISTS `encadrements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `encadrements_user_id_foreign` (`user_id`),
  KEY `encadrements_classe_id_foreign` (`classe_id`),
  KEY `encadrements_annee_scolaire_id_foreign` (`annee_scolaire_id`),
  CONSTRAINT `encadrements_annee_scolaire_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`),
  CONSTRAINT `encadrements_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `encadrements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.encadrements: ~9 rows (approximately)
/*!40000 ALTER TABLE `encadrements` DISABLE KEYS */;
INSERT INTO `encadrements` (`id`, `user_id`, `classe_id`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 1, 1, '2023-04-01 13:20:12', '2023-04-01 13:20:13', NULL),
	(2, 4, 2, 1, '2023-04-01 13:20:10', '2023-04-01 13:20:11', NULL),
	(4, 6, 5, 1, '2023-04-03 06:57:59', '2023-04-03 11:03:00', NULL),
	(5, 2, 8, 1, '2023-04-13 18:34:25', '2023-04-13 16:16:00', '2023-04-13 16:16:00'),
	(6, 3, 14, 1, '2023-06-02 13:16:21', '2023-06-02 13:16:21', '2023-06-02 15:43:37'),
	(7, 4, 1, 1, '2023-06-02 13:17:05', '2023-06-02 13:17:05', '2023-06-02 15:43:10'),
	(8, 15, 16, 1, '2023-07-06 22:26:52', '2023-07-06 22:26:52', NULL),
	(9, 17, 7, 1, '2023-07-07 23:09:46', '2023-07-07 23:09:46', NULL),
	(10, 18, 10, 1, '2023-07-08 08:18:42', '2023-07-08 08:18:42', NULL);
/*!40000 ALTER TABLE `encadrements` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.entree_articles
CREATE TABLE IF NOT EXISTS `entree_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) unsigned DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `designation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double(8,2) NOT NULL,
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entree_articles_article_id_foreign` (`article_id`),
  CONSTRAINT `entree_articles_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.entree_articles: ~5 rows (approximately)
/*!40000 ALTER TABLE `entree_articles` DISABLE KEYS */;
INSERT INTO `entree_articles` (`id`, `article_id`, `quantite`, `designation`, `prix`, `devise`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 120, 'Chaises secretariat', 150.00, 'USD', '2023-08-12', '2023-08-12 18:13:39', '2023-08-12 18:13:39', NULL),
	(2, 6, 200, 'numerotation non conforme', 150.00, 'USD', '2023-08-13', '2023-08-14 21:42:23', '2023-08-14 21:42:23', NULL),
	(3, 7, 15, 'achat ordinateurs', 250.00, 'USD', '2023-08-15', '2023-08-15 09:27:43', '2023-08-15 09:27:43', NULL),
	(4, 9, 150, 'Decorqtion', 200.00, 'CDF', '2023-08-15', '2023-08-15 12:00:59', '2023-08-15 12:00:59', NULL),
	(5, 6, 12, 'achat tables', 40.00, 'USD', '2023-08-11', '2023-08-15 16:04:14', '2023-08-15 16:04:14', NULL);
/*!40000 ALTER TABLE `entree_articles` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.evaluations
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_max` int(11) NOT NULL,
  `type_evaluation_id` bigint(20) unsigned DEFAULT NULL,
  `cours_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `periode_id` bigint(20) unsigned DEFAULT NULL,
  `date_evaluation` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_type_evaluation_id_foreign` (`type_evaluation_id`),
  KEY `evaluations_cours_id_foreign` (`cours_id`),
  KEY `evaluations_classe_id_foreign` (`classe_id`),
  KEY `evaluations_periode_id_foreign` (`periode_id`),
  CONSTRAINT `evaluations_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `evaluations_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `evaluations_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`),
  CONSTRAINT `evaluations_type_evaluation_id_foreign` FOREIGN KEY (`type_evaluation_id`) REFERENCES `type_evaluations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.evaluations: ~2 rows (approximately)
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` (`id`, `note_max`, `type_evaluation_id`, `cours_id`, `classe_id`, `periode_id`, `date_evaluation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 1, 1, 1, 1, '2022-09-25', '2023-08-03 10:20:25', '2023-08-03 10:20:25', NULL),
	(2, 15, 2, 1, 1, 2, '2022-12-22', '2023-08-03 11:26:18', '2023-08-03 11:26:18', NULL);
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.examens
CREATE TABLE IF NOT EXISTS `examens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_max` int(11) NOT NULL,
  `cours_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `trimestre_id` bigint(20) unsigned DEFAULT NULL,
  `date_examen` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examens_cours_id_foreign` (`cours_id`),
  KEY `examens_classe_id_foreign` (`classe_id`),
  KEY `examens_trimestre_id_foreign` (`trimestre_id`),
  CONSTRAINT `examens_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `examens_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `examens_trimestre_id_foreign` FOREIGN KEY (`trimestre_id`) REFERENCES `trimestres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.examens: ~1 rows (approximately)
/*!40000 ALTER TABLE `examens` DISABLE KEYS */;
INSERT INTO `examens` (`id`, `note_max`, `cours_id`, `classe_id`, `trimestre_id`, `date_examen`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 40, 1, 1, 1, '2023-01-04', '2023-08-03 10:25:58', '2023-08-03 10:25:58', NULL);
/*!40000 ALTER TABLE `examens` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.fonctions
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.fonctions: ~12 rows (approximately)
/*!40000 ALTER TABLE `fonctions` DISABLE KEYS */;
INSERT INTO `fonctions` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', '2022-08-23 20:48:42', '2023-05-30 13:12:17', '2023-05-30 13:12:17'),
	(2, 'Enseignant', '2022-08-24 15:04:55', '2022-08-24 15:04:56', NULL),
	(3, 'Directeur de Discipline', '2022-08-26 10:19:10', '2023-04-12 23:11:54', '2023-04-12 23:11:54'),
	(4, 'Proviseur', '2022-08-26 10:20:36', '2022-09-03 09:38:57', NULL),
	(5, 'Prefet', '2022-08-26 10:21:09', '2023-05-30 13:10:34', '2023-05-30 13:10:34'),
	(6, 'Zamu', '2022-08-27 00:42:35', '2022-08-27 00:59:34', '2022-08-27 00:59:34'),
	(7, 'Ingenieure de son', '2022-08-27 01:00:11', '2022-08-27 01:00:15', '2022-08-27 01:00:15'),
	(8, 'Ouvrier', '2022-09-11 12:43:28', '2022-09-11 12:43:28', NULL),
	(9, 'Informaticien', '2022-09-13 06:19:48', '2022-09-13 06:19:48', NULL),
	(10, 'Secretaire', '2023-04-12 23:12:11', '2023-04-12 23:12:11', NULL),
	(11, 'Directeur', '2023-04-13 16:54:32', '2023-04-13 16:54:32', NULL),
	(12, 'Logisticien', '2023-08-15 16:52:44', '2023-08-15 16:52:44', NULL);
/*!40000 ALTER TABLE `fonctions` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.frais
CREATE TABLE IF NOT EXISTS `frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` int(11) NOT NULL,
  `niveau_id` bigint(20) unsigned DEFAULT NULL,
  `type_frais_id` bigint(20) unsigned DEFAULT NULL,
  `mode_paiement_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `frais_niveau_id_foreign` (`niveau_id`),
  KEY `frais_type_frais_id_foreign` (`type_frais_id`),
  KEY `frais_mode_paiement_id_foreign` (`mode_paiement_id`),
  CONSTRAINT `frais_mode_paiement_id_foreign` FOREIGN KEY (`mode_paiement_id`) REFERENCES `mode_paiements` (`id`),
  CONSTRAINT `frais_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`),
  CONSTRAINT `frais_type_frais_id_foreign` FOREIGN KEY (`type_frais_id`) REFERENCES `type_frais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.frais: ~36 rows (approximately)
/*!40000 ALTER TABLE `frais` DISABLE KEYS */;
INSERT INTO `frais` (`id`, `nom`, `montant`, `niveau_id`, `type_frais_id`, `mode_paiement_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Prime Scolaire', 240, 1, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(3, 'Prime Scolaire', 240, 2, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(4, 'Prime Scolaire', 240, 3, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(5, 'Prime Scolaire', 240, 4, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(6, 'Prime Scolaire', 240, 5, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(7, 'Prime Scolaire', 240, 6, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(8, 'Prime Scolaire', 240, 7, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(9, 'Prime Scolaire', 240, 8, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:03', NULL),
	(10, 'Prime Scolaire', 240, 9, 1, 2, '2023-04-17 14:37:03', '2023-04-17 14:37:04', NULL),
	(11, 'Frais Divers', 10000, 1, 2, 1, '2023-04-18 22:13:04', '2023-04-18 22:13:04', NULL),
	(12, 'Frais Divers', 10000, 2, 2, 1, '2023-04-18 22:13:04', '2023-04-18 22:13:04', NULL),
	(13, 'Frais Divers', 10000, 3, 2, 1, '2023-04-18 22:13:04', '2023-04-18 22:13:05', NULL),
	(14, 'Frais Divers', 10000, 4, 2, 1, '2023-04-18 22:13:05', '2023-04-18 22:13:05', NULL),
	(15, 'Frais Divers', 10000, 5, 2, 1, '2023-04-18 22:13:05', '2023-04-18 22:13:05', NULL),
	(16, 'Frais Divers', 10000, 6, 2, 1, '2023-04-18 22:13:05', '2023-04-18 22:13:05', NULL),
	(17, 'Frais Divers', 10000, 7, 2, 1, '2023-04-18 22:13:05', '2023-04-18 22:13:05', NULL),
	(18, 'Frais Divers', 10000, 8, 2, 1, '2023-04-18 22:13:05', '2023-04-18 22:13:05', NULL),
	(19, 'Frais Divers', 10000, 9, 2, 1, '2023-04-18 22:13:05', '2023-04-18 22:13:05', NULL),
	(20, 'FRAIS D\'INSCRIPTION', 10, 1, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(21, 'FRAIS D\'INSCRIPTION', 10, 2, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(22, 'FRAIS D\'INSCRIPTION', 10, 3, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(23, 'FRAIS D\'INSCRIPTION', 10, 4, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(24, 'FRAIS D\'INSCRIPTION', 10, 5, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(25, 'FRAIS D\'INSCRIPTION', 10, 6, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(26, 'FRAIS D\'INSCRIPTION', 10, 7, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(27, 'FRAIS D\'INSCRIPTION', 10, 8, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(28, 'FRAIS D\'INSCRIPTION', 10, 9, 1, 1, '2023-06-14 08:36:13', '2023-06-14 08:36:13', NULL),
	(29, 'FRAIS DE CONSTRUCTION', 10, 1, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(30, 'FRAIS DE CONSTRUCTION', 10, 2, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(31, 'FRAIS DE CONSTRUCTION', 10, 3, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(32, 'FRAIS DE CONSTRUCTION', 10, 4, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(33, 'FRAIS DE CONSTRUCTION', 10, 5, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(34, 'FRAIS DE CONSTRUCTION', 10, 6, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(35, 'FRAIS DE CONSTRUCTION', 10, 7, 3, 1, '2023-08-15 13:13:17', '2023-08-15 13:13:17', NULL),
	(36, 'FRAIS DE CONSTRUCTION', 10, 8, 3, 1, '2023-08-15 13:13:18', '2023-08-15 13:13:18', NULL),
	(37, 'FRAIS DE CONSTRUCTION', 10, 9, 3, 1, '2023-08-15 13:13:18', '2023-08-15 13:13:18', NULL);
/*!40000 ALTER TABLE `frais` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.frequentations
CREATE TABLE IF NOT EXISTS `frequentations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned NOT NULL,
  `classe_id` bigint(20) unsigned NOT NULL,
  `annee_scolaire_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `frequentations_eleve_id_foreign` (`eleve_id`),
  KEY `frequentations_classe_id_foreign` (`classe_id`),
  KEY `frequentations_annee_scolaire_id_foreign` (`annee_scolaire_id`),
  CONSTRAINT `frequentations_annee_scolaire_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`),
  CONSTRAINT `frequentations_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `frequentations_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.frequentations: ~36 rows (approximately)
/*!40000 ALTER TABLE `frequentations` DISABLE KEYS */;
INSERT INTO `frequentations` (`id`, `eleve_id`, `classe_id`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, '2022-08-28 22:01:16', '2022-08-28 22:01:16', NULL),
	(2, 2, 1, 1, '2022-08-28 22:01:35', '2022-08-28 22:01:35', NULL),
	(3, 3, 1, 1, '2022-08-28 22:01:45', '2022-08-28 22:01:45', NULL),
	(4, 4, 1, 1, '2022-08-28 22:01:57', '2022-08-28 22:01:57', NULL),
	(5, 5, 1, 1, '2022-08-28 22:02:04', '2022-08-28 22:02:04', NULL),
	(6, 6, 1, 1, '2022-08-28 22:02:22', '2022-08-28 22:02:26', NULL),
	(7, 7, 1, 1, '2022-08-28 22:02:48', '2022-08-28 22:02:49', NULL),
	(8, 8, 1, 1, '2022-08-28 22:02:57', '2022-08-28 22:02:57', NULL),
	(9, 9, 1, 1, '2022-08-28 22:03:04', '2022-08-28 22:03:05', NULL),
	(10, 10, 1, 1, '2022-08-28 22:03:12', '2022-08-28 22:03:12', NULL),
	(13, 22, 1, 1, '2022-08-29 00:33:16', '2022-08-29 00:33:16', NULL),
	(14, 17, 1, 1, '2022-08-29 18:50:43', '2022-08-29 18:50:45', NULL),
	(15, 23, 1, 1, '2022-08-31 08:51:13', '2022-08-31 08:51:13', NULL),
	(18, 21, 1, 1, '2022-09-03 15:17:09', '2022-09-03 15:40:10', NULL),
	(19, 20, 8, 1, '2022-09-03 15:41:16', '2022-09-03 15:41:16', NULL),
	(20, 24, 2, 1, '2022-09-09 15:02:01', '2022-09-09 15:02:01', NULL),
	(21, 25, 1, 1, '2022-09-15 13:15:34', '2022-09-15 13:15:34', NULL),
	(22, 27, 5, 3, '2022-11-19 10:22:58', '2022-11-21 05:44:54', NULL),
	(23, 27, 1, 1, '2022-11-21 05:44:24', '2022-11-21 05:44:24', NULL),
	(24, 28, 8, 1, '2023-02-03 14:04:22', '2023-02-03 14:04:22', NULL),
	(25, 29, 9, 1, '2023-02-03 14:07:11', '2023-02-03 14:07:11', NULL),
	(26, 30, 10, 1, '2023-04-02 09:50:38', '2023-04-02 09:50:38', NULL),
	(27, 31, 1, 1, '2023-04-12 22:40:07', '2023-04-12 22:40:07', NULL),
	(28, 32, 5, 1, '2023-04-13 12:29:55', '2023-04-13 12:29:55', NULL),
	(29, 33, 5, 1, '2023-04-13 21:47:46', '2023-04-13 21:47:46', NULL),
	(30, 34, 1, 1, '2023-04-13 21:55:53', '2023-04-13 21:55:53', NULL),
	(31, 15, 8, 1, '2023-04-14 13:14:34', '2023-04-14 13:14:34', NULL),
	(32, 21, 5, 3, '2023-04-18 22:57:06', '2023-05-09 17:23:51', '2023-05-09 17:23:51'),
	(33, 21, 2, 2, '2023-05-09 16:01:42', '2023-05-09 16:01:42', NULL),
	(34, 21, 8, 4, '2023-05-09 17:25:28', '2023-05-09 17:25:28', NULL),
	(35, 35, 8, 1, '2023-06-05 13:18:21', '2023-06-05 13:18:21', NULL),
	(36, 36, 4, 1, '2023-06-06 11:45:45', '2023-06-06 11:45:45', NULL),
	(39, 22, 2, 2, '2023-07-02 22:50:29', '2023-07-02 22:50:29', NULL),
	(40, 37, 16, 1, '2023-07-06 22:22:08', '2023-07-06 22:22:08', NULL),
	(41, 38, 7, 1, '2023-07-07 23:18:41', '2023-07-07 23:38:52', NULL),
	(42, 39, 10, 1, '2023-07-08 08:21:44', '2023-07-08 08:21:44', NULL);
/*!40000 ALTER TABLE `frequentations` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.heures
CREATE TABLE IF NOT EXISTS `heures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `debut` time NOT NULL,
  `fin` time NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.heures: ~7 rows (approximately)
/*!40000 ALTER TABLE `heures` DISABLE KEYS */;
INSERT INTO `heures` (`id`, `debut`, `fin`, `numerotation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '07:45:00', '08:30:00', 1, '2023-08-04 12:29:34', '2023-08-04 12:29:34', NULL),
	(2, '08:30:00', '09:15:00', 2, '2023-08-04 12:30:12', '2023-08-04 12:30:12', NULL),
	(3, '09:15:00', '10:00:00', 3, '2023-08-04 12:32:19', '2023-08-04 12:32:20', NULL),
	(4, '10:00:00', '10:15:00', 4, '2023-08-04 12:32:50', '2023-08-04 12:32:51', NULL),
	(5, '10:15:00', '11:00:00', 5, '2023-08-04 12:33:26', '2023-08-04 12:33:26', NULL),
	(6, '11:00:00', '11:45:00', 6, '2023-08-04 12:35:39', '2023-08-04 12:35:39', NULL),
	(7, '11:45:00', '12:30:00', 7, '2023-08-04 12:36:36', '2023-08-04 12:36:37', NULL);
/*!40000 ALTER TABLE `heures` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.horaires
CREATE TABLE IF NOT EXISTS `horaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cours_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `jour_id` bigint(20) unsigned DEFAULT NULL,
  `heure_id` bigint(20) unsigned DEFAULT NULL,
  `isRecreation` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `horaires_cours_id_foreign` (`cours_id`),
  KEY `horaires_classe_id_foreign` (`classe_id`),
  KEY `horaires_jour_id_foreign` (`jour_id`),
  KEY `horaires_heure_id_foreign` (`heure_id`),
  CONSTRAINT `horaires_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `horaires_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `horaires_heure_id_foreign` FOREIGN KEY (`heure_id`) REFERENCES `heures` (`id`),
  CONSTRAINT `horaires_jour_id_foreign` FOREIGN KEY (`jour_id`) REFERENCES `jours` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.horaires: ~67 rows (approximately)
/*!40000 ALTER TABLE `horaires` DISABLE KEYS */;
INSERT INTO `horaires` (`id`, `cours_id`, `classe_id`, `jour_id`, `heure_id`, `isRecreation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(17, 1, 1, 1, 1, 1, '2023-08-04 16:41:34', '2023-08-07 23:36:39', NULL),
	(18, 1, 1, 2, 1, 0, '2023-08-04 16:41:40', '2023-08-04 16:41:40', NULL),
	(19, 4, 1, 3, 1, 0, '2023-08-04 16:41:45', '2023-08-07 22:34:22', NULL),
	(20, 2, 1, 4, 1, 0, '2023-08-04 16:41:49', '2023-08-04 16:41:49', NULL),
	(21, 3, 1, 5, 1, 0, '2023-08-04 16:41:53', '2023-08-04 16:41:53', NULL),
	(22, 6, 1, 6, 1, 0, '2023-08-04 16:41:57', '2023-08-04 16:41:58', NULL),
	(24, 2, 1, 1, 7, 0, '2023-08-04 16:47:02', '2023-08-04 16:47:02', NULL),
	(25, 2, 1, 2, 7, 0, '2023-08-04 16:47:07', '2023-08-04 16:47:07', NULL),
	(26, NULL, 1, 1, 4, 1, '2023-08-04 17:01:19', '2023-08-04 17:01:19', NULL),
	(27, NULL, 1, 2, 4, 1, '2023-08-04 17:04:50', '2023-08-04 17:04:50', NULL),
	(28, NULL, 1, 3, 4, 1, '2023-08-04 17:04:51', '2023-08-04 17:04:51', NULL),
	(29, NULL, 1, 4, 4, 1, '2023-08-04 17:04:52', '2023-08-04 17:04:52', NULL),
	(30, 3, 1, 5, 3, 1, '2023-08-04 17:04:53', '2023-08-04 17:04:55', NULL),
	(31, NULL, 1, 6, 4, 1, '2023-08-04 17:04:54', '2023-08-04 17:04:54', NULL),
	(32, NULL, 1, 5, 4, 1, '2023-08-04 17:05:05', '2023-08-04 17:05:05', NULL),
	(33, 3, 1, 1, 2, 0, '2023-08-04 17:54:15', '2023-08-07 23:39:04', NULL),
	(34, 7, 1, 1, 3, 0, '2023-08-04 17:54:21', '2023-08-04 17:54:22', NULL),
	(35, 9, 1, 1, 5, 0, '2023-08-04 17:54:28', '2023-08-04 17:54:28', NULL),
	(36, 3, 1, 1, 6, 0, '2023-08-04 17:54:33', '2023-08-04 17:54:33', NULL),
	(37, 6, 1, 2, 2, 0, '2023-08-07 23:41:53', '2023-08-07 23:41:53', NULL),
	(38, 13, 16, 1, 1, 0, '2023-08-07 23:44:01', '2023-08-07 23:44:01', NULL),
	(39, 10, 16, 1, 2, 0, '2023-08-07 23:44:04', '2023-08-07 23:44:04', NULL),
	(40, 21, 16, 1, 3, 0, '2023-08-07 23:44:06', '2023-08-07 23:44:06', NULL),
	(41, NULL, 16, 1, 4, 1, '2023-08-07 23:44:09', '2023-08-07 23:44:09', NULL),
	(42, 10, 16, 2, 4, 1, '2023-08-07 23:44:42', '2023-08-07 23:49:19', NULL),
	(43, NULL, 16, 3, 4, 1, '2023-08-07 23:47:30', '2023-08-07 23:47:30', NULL),
	(44, 17, 16, 2, 2, 1, '2023-08-07 23:52:02', '2023-08-09 01:53:53', NULL),
	(45, NULL, 16, 3, 1, 1, '2023-08-07 23:56:01', '2023-08-07 23:56:01', NULL),
	(46, 27, 16, 2, 3, 1, '2023-08-07 23:56:37', '2023-08-09 01:53:57', NULL),
	(47, NULL, 16, 4, 4, 1, '2023-08-07 23:58:29', '2023-08-07 23:58:29', NULL),
	(48, NULL, 16, 5, 4, 1, '2023-08-07 23:58:30', '2023-08-07 23:58:30', NULL),
	(49, NULL, 16, 6, 4, 1, '2023-08-07 23:58:32', '2023-08-07 23:58:32', NULL),
	(50, 12, 16, 3, 2, 0, '2023-08-08 00:05:03', '2023-08-08 00:05:03', NULL),
	(51, 27, 16, 3, 3, 0, '2023-08-08 00:05:05', '2023-08-08 00:05:05', NULL),
	(52, 13, 16, 4, 2, 0, '2023-08-08 00:05:08', '2023-08-08 00:05:08', NULL),
	(53, 22, 16, 4, 1, 0, '2023-08-08 00:05:09', '2023-08-08 00:05:09', NULL),
	(54, 27, 16, 4, 3, 0, '2023-08-08 00:05:11', '2023-08-08 00:05:11', NULL),
	(55, 12, 16, 5, 1, 0, '2023-08-08 00:05:13', '2023-08-08 00:05:13', NULL),
	(56, 14, 16, 5, 2, 0, '2023-08-08 00:05:14', '2023-08-08 00:05:14', NULL),
	(57, 22, 16, 5, 3, 0, '2023-08-08 00:05:16', '2023-08-08 00:05:16', NULL),
	(58, 20, 16, 6, 1, 0, '2023-08-08 00:05:18', '2023-08-08 00:05:18', NULL),
	(59, 22, 16, 6, 2, 0, '2023-08-08 00:05:19', '2023-08-08 00:05:19', NULL),
	(60, 26, 16, 6, 3, 0, '2023-08-08 00:05:21', '2023-08-08 00:05:21', NULL),
	(61, 26, 16, 2, 5, 0, '2023-08-09 01:54:03', '2023-08-09 01:54:03', NULL),
	(62, 25, 16, 2, 6, 0, '2023-08-09 01:54:06', '2023-08-09 01:54:06', NULL),
	(63, 15, 16, 2, 7, 0, '2023-08-09 01:54:08', '2023-08-09 01:54:08', NULL),
	(64, 1, 1, 3, 2, 0, '2023-08-16 13:48:57', '2023-08-16 13:48:57', NULL),
	(65, 4, 1, 4, 2, 0, '2023-08-16 13:48:58', '2023-08-16 13:48:58', NULL),
	(66, 2, 1, 4, 5, 0, '2023-08-16 13:49:01', '2023-08-16 13:49:01', NULL),
	(67, 4, 1, 5, 5, 0, '2023-08-16 13:49:02', '2023-08-16 13:49:02', NULL),
	(68, 6, 1, 4, 6, 0, '2023-08-16 13:49:04', '2023-08-16 13:49:04', NULL),
	(69, 7, 1, 4, 7, 0, '2023-08-16 13:49:05', '2023-08-16 13:49:05', NULL),
	(70, 4, 1, 3, 7, 0, '2023-08-16 13:49:06', '2023-08-16 13:49:07', NULL),
	(71, 2, 1, 3, 6, 0, '2023-08-16 13:49:08', '2023-08-16 13:49:08', NULL),
	(72, 2, 1, 3, 5, 0, '2023-08-16 13:49:09', '2023-08-16 13:49:09', NULL),
	(73, 2, 1, 5, 6, 0, '2023-08-16 13:49:11', '2023-08-16 13:49:11', NULL),
	(74, 4, 1, 5, 7, 0, '2023-08-16 13:49:12', '2023-08-16 13:49:12', NULL),
	(75, 3, 1, 6, 5, 0, '2023-08-16 13:49:13', '2023-08-16 13:49:13', NULL),
	(76, 2, 1, 6, 6, 0, '2023-08-16 13:49:14', '2023-08-16 13:49:14', NULL),
	(77, 4, 1, 6, 7, 0, '2023-08-16 13:49:15', '2023-08-16 13:49:15', NULL),
	(78, 6, 1, 6, 3, 0, '2023-08-16 13:49:16', '2023-08-16 13:49:16', NULL),
	(79, 2, 1, 6, 2, 0, '2023-08-16 13:49:18', '2023-08-16 13:49:18', NULL),
	(80, 4, 1, 5, 2, 0, '2023-08-16 13:49:18', '2023-08-16 13:49:18', NULL),
	(81, 4, 1, 4, 3, 0, '2023-08-16 13:49:20', '2023-08-16 13:49:20', NULL),
	(82, 4, 1, 3, 3, 0, '2023-08-16 13:49:21', '2023-08-16 13:49:22', NULL),
	(83, 2, 1, 2, 5, 0, '2023-08-16 13:49:22', '2023-08-16 13:49:22', NULL),
	(84, 2, 1, 2, 6, 0, '2023-08-16 13:49:23', '2023-08-16 13:49:23', NULL);
/*!40000 ALTER TABLE `horaires` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.jours
CREATE TABLE IF NOT EXISTS `jours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.jours: ~6 rows (approximately)
/*!40000 ALTER TABLE `jours` DISABLE KEYS */;
INSERT INTO `jours` (`id`, `nom`, `numerotation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'LUNDI', 1, '2023-08-03 17:31:11', '2023-08-03 17:31:12', NULL),
	(2, 'MARDI', 2, '2023-08-03 17:31:34', '2023-08-03 17:31:34', NULL),
	(3, 'MERCREDI', 3, '2023-08-03 17:31:47', '2023-08-03 17:31:48', NULL),
	(4, 'JEUDI', 4, '2023-08-03 17:31:53', '2023-08-03 17:31:54', NULL),
	(5, 'VENDREDI', 5, '2023-08-03 17:32:12', '2023-08-03 17:32:12', NULL),
	(6, 'SAMEDI', 6, '2023-08-03 17:32:24', '2023-08-03 17:32:24', NULL);
/*!40000 ALTER TABLE `jours` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.logfiles
CREATE TABLE IF NOT EXISTS `logfiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `done_by` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=923 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.logfiles: ~905 rows (approximately)
/*!40000 ALTER TABLE `logfiles` DISABLE KEYS */;
INSERT INTO `logfiles` (`id`, `table_name`, `item_id`, `event`, `done_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'cours', '1', 'Creation', 2, NULL, '2023-06-28 22:00:55', '2023-06-28 22:00:55'),
	(2, 'eleves', '21', 'Modification', 2, NULL, '2023-06-28 22:00:55', '2023-06-28 22:00:55'),
	(3, 'evaluations', '45', 'Suppression', 2, NULL, '2023-06-28 22:00:55', '2023-06-28 22:00:55'),
	(4, 'annee_scolaires', '5', 'Creation', 2, NULL, '2023-06-28 22:37:35', '2023-06-28 22:37:35'),
	(18, 'eleves', '36', 'Modification', 9, NULL, '2023-06-29 17:49:59', '2023-06-29 17:49:59'),
	(19, 'paiement_frais', '11', 'Creation', 9, NULL, '2023-06-29 17:57:55', '2023-06-29 17:57:55'),
	(20, 'paiement_frais', '12', 'Creation', 9, NULL, '2023-06-29 18:00:13', '2023-06-29 18:00:13'),
	(21, 'paiement_frais', '13', 'Creation', 9, NULL, '2023-06-29 18:09:57', '2023-06-29 18:09:57'),
	(22, 'users', '16', 'Modification', 9, NULL, '2023-06-29 18:10:18', '2023-06-29 18:10:18'),
	(23, 'users', '16', 'Modification', 9, NULL, '2023-06-29 18:10:20', '2023-06-29 18:10:20'),
	(24, 'users', '8', 'Modification', 9, NULL, '2023-06-29 18:10:24', '2023-06-29 18:10:24'),
	(25, 'users', '8', 'Modification', 9, NULL, '2023-06-29 18:10:26', '2023-06-29 18:10:26'),
	(26, 'messages', '14', 'Creation', 5, NULL, '2023-06-29 19:00:47', '2023-06-29 19:00:47'),
	(27, 'users', '16', 'Modification', 9, NULL, '2023-06-30 07:55:46', '2023-06-30 07:55:46'),
	(28, 'parrains', '6', 'Suppression', 9, NULL, '2023-06-30 07:55:47', '2023-06-30 07:55:47'),
	(29, 'parrains', '6', 'Restoration', 2, NULL, '2023-06-30 12:53:05', '2023-06-30 12:53:05'),
	(30, 'evaluations', '45', 'Restoration', 2, NULL, '2023-06-30 12:54:57', '2023-06-30 12:54:57'),
	(31, 'users', '17', 'Creation', 5, NULL, '2023-07-02 20:45:59', '2023-07-02 20:45:59'),
	(32, 'users', '18', 'Creation', 5, NULL, '2023-07-02 20:48:30', '2023-07-02 20:48:30'),
	(33, 'users', '19', 'Creation', 5, NULL, '2023-07-02 20:49:26', '2023-07-02 20:49:26'),
	(34, 'employers', '13', 'Creation', 5, NULL, '2023-07-02 21:07:48', '2023-07-02 21:07:48'),
	(35, 'frequentations', '37', 'Creation', 9, NULL, '2023-07-02 22:40:01', '2023-07-02 22:40:01'),
	(36, 'resultats', '33', 'Creation', 9, NULL, '2023-07-02 22:40:02', '2023-07-02 22:40:02'),
	(37, 'frequentations', '38', 'Creation', 9, NULL, '2023-07-02 22:44:59', '2023-07-02 22:44:59'),
	(38, 'resultats', '34', 'Creation', 9, NULL, '2023-07-02 22:44:59', '2023-07-02 22:44:59'),
	(39, 'frequentations', '39', 'Creation', 9, NULL, '2023-07-02 22:50:29', '2023-07-02 22:50:29'),
	(40, 'resultats', '35', 'Creation', 9, NULL, '2023-07-02 22:50:29', '2023-07-02 22:50:29'),
	(41, 'evaluations', '79', 'Suppression', 3, NULL, '2023-07-02 22:54:53', '2023-07-02 22:54:53'),
	(42, 'evaluations', '79', 'Restoration', 2, NULL, '2023-07-02 22:55:05', '2023-07-02 22:55:05'),
	(43, 'categorie_cours', '8', 'Creation', 5, NULL, '2023-07-06 21:59:20', '2023-07-06 21:59:20'),
	(44, 'categorie_cours', '8', 'Modification', 5, NULL, '2023-07-06 21:59:41', '2023-07-06 21:59:41'),
	(45, 'cours', '10', 'Creation', 5, NULL, '2023-07-06 22:01:22', '2023-07-06 22:01:22'),
	(46, 'cours', '11', 'Creation', 5, NULL, '2023-07-06 22:01:54', '2023-07-06 22:01:54'),
	(47, 'cours', '12', 'Creation', 5, NULL, '2023-07-06 22:03:15', '2023-07-06 22:03:15'),
	(48, 'cours', '13', 'Creation', 5, NULL, '2023-07-06 22:03:50', '2023-07-06 22:03:50'),
	(49, 'cours', '14', 'Creation', 5, NULL, '2023-07-06 22:05:23', '2023-07-06 22:05:23'),
	(50, 'cours', '15', 'Creation', 5, NULL, '2023-07-06 22:05:42', '2023-07-06 22:05:42'),
	(51, 'cours', '16', 'Creation', 5, NULL, '2023-07-06 22:06:39', '2023-07-06 22:06:39'),
	(52, 'cours', '17', 'Creation', 5, NULL, '2023-07-06 22:06:57', '2023-07-06 22:06:57'),
	(53, 'cours', '18', 'Creation', 5, NULL, '2023-07-06 22:07:14', '2023-07-06 22:07:14'),
	(54, 'cours', '19', 'Creation', 5, NULL, '2023-07-06 22:07:28', '2023-07-06 22:07:28'),
	(55, 'cours', '20', 'Creation', 5, NULL, '2023-07-06 22:07:58', '2023-07-06 22:07:58'),
	(56, 'cours', '21', 'Creation', 5, NULL, '2023-07-06 22:08:41', '2023-07-06 22:08:41'),
	(57, 'cours', '22', 'Creation', 5, NULL, '2023-07-06 22:09:03', '2023-07-06 22:09:03'),
	(58, 'cours', '23', 'Creation', 5, NULL, '2023-07-06 22:09:36', '2023-07-06 22:09:36'),
	(59, 'cours', '24', 'Creation', 5, NULL, '2023-07-06 22:09:59', '2023-07-06 22:09:59'),
	(60, 'cours', '25', 'Creation', 5, NULL, '2023-07-06 22:10:23', '2023-07-06 22:10:23'),
	(61, 'cours', '26', 'Creation', 5, NULL, '2023-07-06 22:11:12', '2023-07-06 22:11:12'),
	(62, 'cours', '27', 'Creation', 5, NULL, '2023-07-06 22:11:51', '2023-07-06 22:11:51'),
	(63, 'cours', '28', 'Creation', 5, NULL, '2023-07-06 22:12:22', '2023-07-06 22:12:22'),
	(64, 'cours', '29', 'Creation', 5, NULL, '2023-07-06 22:12:46', '2023-07-06 22:12:46'),
	(65, 'cours', '30', 'Creation', 5, NULL, '2023-07-06 22:13:20', '2023-07-06 22:13:20'),
	(66, 'cours', '31', 'Creation', 5, NULL, '2023-07-06 22:13:39', '2023-07-06 22:13:39'),
	(67, 'eleves', '21', 'Modification', 5, NULL, '2023-07-06 22:21:11', '2023-07-06 22:21:11'),
	(68, 'eleves', '37', 'Creation', 5, NULL, '2023-07-06 22:22:00', '2023-07-06 22:22:00'),
	(69, 'frequentations', '40', 'Creation', 5, NULL, '2023-07-06 22:22:08', '2023-07-06 22:22:08'),
	(70, 'resultats', '36', 'Creation', 5, NULL, '2023-07-06 22:22:08', '2023-07-06 22:22:08'),
	(71, 'encadrements', '8', 'Creation', 5, NULL, '2023-07-06 22:26:52', '2023-07-06 22:26:52'),
	(72, 'evaluations', '80', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(73, 'evaluations', '81', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(74, 'evaluations', '82', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(75, 'evaluations', '83', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(76, 'evaluations', '84', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(77, 'evaluations', '85', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(78, 'evaluations', '86', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(79, 'evaluations', '87', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(80, 'evaluations', '88', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(81, 'evaluations', '89', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(82, 'evaluations', '90', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(83, 'evaluations', '91', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(84, 'evaluations', '92', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(85, 'evaluations', '93', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(86, 'evaluations', '94', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(87, 'evaluations', '95', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(88, 'evaluations', '96', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(89, 'evaluations', '97', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(90, 'evaluations', '98', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(91, 'evaluations', '99', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(92, 'evaluations', '100', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(93, 'evaluations', '101', 'Creation', 15, NULL, '2023-07-06 22:52:34', '2023-07-06 22:52:34'),
	(94, 'evaluations', '102', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(95, 'evaluations', '103', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(96, 'evaluations', '104', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(97, 'evaluations', '105', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(98, 'evaluations', '106', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(99, 'evaluations', '107', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(100, 'evaluations', '108', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(101, 'evaluations', '109', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(102, 'evaluations', '110', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(103, 'evaluations', '111', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(104, 'evaluations', '112', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(105, 'evaluations', '113', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(106, 'evaluations', '114', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(107, 'evaluations', '115', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(108, 'evaluations', '116', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(109, 'evaluations', '117', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(110, 'evaluations', '118', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(111, 'evaluations', '119', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(112, 'evaluations', '120', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(113, 'evaluations', '121', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(114, 'evaluations', '122', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(115, 'evaluations', '123', 'Creation', 15, NULL, '2023-07-06 22:54:46', '2023-07-06 22:54:46'),
	(116, 'evaluations', '124', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(117, 'evaluations', '125', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(118, 'evaluations', '126', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(119, 'evaluations', '127', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(120, 'evaluations', '128', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(121, 'evaluations', '129', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(122, 'evaluations', '130', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(123, 'evaluations', '131', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(124, 'evaluations', '132', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(125, 'evaluations', '133', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(126, 'evaluations', '134', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(127, 'evaluations', '135', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(128, 'evaluations', '136', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(129, 'evaluations', '137', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(130, 'evaluations', '138', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(131, 'evaluations', '139', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(132, 'evaluations', '140', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(133, 'evaluations', '141', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(134, 'evaluations', '142', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(135, 'evaluations', '143', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(136, 'evaluations', '144', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(137, 'evaluations', '145', 'Creation', 15, NULL, '2023-07-06 22:55:06', '2023-07-06 22:55:06'),
	(138, 'evaluations', '146', 'Creation', 15, NULL, '2023-07-06 22:55:28', '2023-07-06 22:55:28'),
	(139, 'evaluations', '147', 'Creation', 15, NULL, '2023-07-06 22:55:28', '2023-07-06 22:55:28'),
	(140, 'evaluations', '148', 'Creation', 15, NULL, '2023-07-06 22:55:28', '2023-07-06 22:55:28'),
	(141, 'evaluations', '149', 'Creation', 15, NULL, '2023-07-06 22:55:28', '2023-07-06 22:55:28'),
	(142, 'evaluations', '150', 'Creation', 15, NULL, '2023-07-06 22:55:28', '2023-07-06 22:55:28'),
	(143, 'evaluations', '151', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(144, 'evaluations', '152', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(145, 'evaluations', '153', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(146, 'evaluations', '154', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(147, 'evaluations', '155', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(148, 'evaluations', '156', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(149, 'evaluations', '157', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(150, 'evaluations', '158', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(151, 'evaluations', '159', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(152, 'evaluations', '160', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(153, 'evaluations', '161', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(154, 'evaluations', '162', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(155, 'evaluations', '163', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(156, 'evaluations', '164', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(157, 'evaluations', '165', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(158, 'evaluations', '166', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(159, 'evaluations', '167', 'Creation', 15, NULL, '2023-07-06 22:55:29', '2023-07-06 22:55:29'),
	(160, 'evaluations', '168', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(161, 'evaluations', '169', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(162, 'evaluations', '170', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(163, 'evaluations', '171', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(164, 'evaluations', '172', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(165, 'evaluations', '173', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(166, 'evaluations', '174', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(167, 'evaluations', '175', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(168, 'evaluations', '176', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(169, 'evaluations', '177', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(170, 'evaluations', '178', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(171, 'evaluations', '179', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(172, 'evaluations', '180', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(173, 'evaluations', '181', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(174, 'evaluations', '182', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(175, 'evaluations', '183', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(176, 'evaluations', '184', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(177, 'evaluations', '185', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(178, 'evaluations', '186', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(179, 'evaluations', '187', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(180, 'evaluations', '188', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(181, 'evaluations', '189', 'Creation', 15, NULL, '2023-07-06 22:55:48', '2023-07-06 22:55:48'),
	(182, 'evaluations', '190', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(183, 'evaluations', '191', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(184, 'evaluations', '192', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(185, 'evaluations', '193', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(186, 'evaluations', '194', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(187, 'evaluations', '195', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(188, 'evaluations', '196', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(189, 'evaluations', '197', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(190, 'evaluations', '198', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(191, 'evaluations', '199', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(192, 'evaluations', '200', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(193, 'evaluations', '201', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(194, 'evaluations', '202', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(195, 'evaluations', '203', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(196, 'evaluations', '204', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(197, 'evaluations', '205', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(198, 'evaluations', '206', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(199, 'evaluations', '207', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(200, 'evaluations', '208', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(201, 'evaluations', '209', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(202, 'evaluations', '210', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(203, 'evaluations', '211', 'Creation', 15, NULL, '2023-07-06 22:56:01', '2023-07-06 22:56:01'),
	(204, 'evaluations', '212', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(205, 'evaluations', '213', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(206, 'evaluations', '214', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(207, 'evaluations', '215', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(208, 'evaluations', '216', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(209, 'evaluations', '217', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(210, 'evaluations', '218', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(211, 'evaluations', '219', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(212, 'evaluations', '220', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(213, 'evaluations', '221', 'Creation', 15, NULL, '2023-07-06 22:56:04', '2023-07-06 22:56:04'),
	(214, 'evaluations', '222', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(215, 'evaluations', '223', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(216, 'evaluations', '224', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(217, 'evaluations', '225', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(218, 'evaluations', '226', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(219, 'evaluations', '227', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(220, 'evaluations', '228', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(221, 'evaluations', '229', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(222, 'evaluations', '230', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(223, 'evaluations', '231', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(224, 'evaluations', '232', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(225, 'evaluations', '233', 'Creation', 15, NULL, '2023-07-06 22:56:05', '2023-07-06 22:56:05'),
	(226, 'evaluations', '234', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(227, 'evaluations', '235', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(228, 'evaluations', '236', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(229, 'evaluations', '237', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(230, 'evaluations', '238', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(231, 'evaluations', '239', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(232, 'evaluations', '240', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(233, 'evaluations', '241', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(234, 'evaluations', '242', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(235, 'evaluations', '243', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(236, 'evaluations', '244', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(237, 'evaluations', '245', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(238, 'evaluations', '246', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(239, 'evaluations', '247', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(240, 'evaluations', '248', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(241, 'evaluations', '249', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(242, 'evaluations', '250', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(243, 'evaluations', '251', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(244, 'evaluations', '252', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(245, 'evaluations', '253', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(246, 'evaluations', '254', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(247, 'evaluations', '255', 'Creation', 15, NULL, '2023-07-06 22:56:07', '2023-07-06 22:56:07'),
	(248, 'evaluations', '256', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(249, 'evaluations', '257', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(250, 'evaluations', '258', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(251, 'evaluations', '259', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(252, 'evaluations', '260', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(253, 'evaluations', '261', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(254, 'evaluations', '262', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(255, 'evaluations', '263', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(256, 'evaluations', '264', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(257, 'evaluations', '265', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(258, 'evaluations', '266', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(259, 'evaluations', '267', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(260, 'evaluations', '268', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(261, 'evaluations', '269', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(262, 'evaluations', '270', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(263, 'evaluations', '271', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(264, 'evaluations', '272', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(265, 'evaluations', '273', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(266, 'evaluations', '274', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(267, 'evaluations', '275', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(268, 'evaluations', '276', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(269, 'evaluations', '277', 'Creation', 15, NULL, '2023-07-06 22:56:10', '2023-07-06 22:56:10'),
	(270, 'evaluations', '278', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(271, 'evaluations', '279', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(272, 'evaluations', '280', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(273, 'evaluations', '281', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(274, 'evaluations', '282', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(275, 'evaluations', '283', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(276, 'evaluations', '284', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(277, 'evaluations', '285', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(278, 'evaluations', '286', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(279, 'evaluations', '287', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(280, 'evaluations', '288', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(281, 'evaluations', '289', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(282, 'evaluations', '290', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(283, 'evaluations', '291', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(284, 'evaluations', '292', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(285, 'evaluations', '293', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(286, 'evaluations', '294', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(287, 'evaluations', '295', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(288, 'evaluations', '296', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(289, 'evaluations', '297', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(290, 'evaluations', '298', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(291, 'evaluations', '299', 'Creation', 15, NULL, '2023-07-06 22:56:13', '2023-07-06 22:56:13'),
	(292, 'evaluations', '300', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(293, 'evaluations', '301', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(294, 'evaluations', '302', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(295, 'evaluations', '303', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(296, 'evaluations', '304', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(297, 'evaluations', '305', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(298, 'evaluations', '306', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(299, 'evaluations', '307', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(300, 'evaluations', '308', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(301, 'evaluations', '309', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(302, 'evaluations', '310', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(303, 'evaluations', '311', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(304, 'evaluations', '312', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(305, 'evaluations', '313', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(306, 'evaluations', '314', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(307, 'evaluations', '315', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(308, 'evaluations', '316', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(309, 'evaluations', '317', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(310, 'evaluations', '318', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(311, 'evaluations', '319', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(312, 'evaluations', '320', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(313, 'evaluations', '321', 'Creation', 15, NULL, '2023-07-06 22:56:21', '2023-07-06 22:56:21'),
	(314, 'evaluations', '322', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(315, 'evaluations', '323', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(316, 'evaluations', '324', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(317, 'evaluations', '325', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(318, 'evaluations', '326', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(319, 'evaluations', '327', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(320, 'evaluations', '328', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(321, 'evaluations', '329', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(322, 'evaluations', '330', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(323, 'evaluations', '331', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(324, 'evaluations', '332', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(325, 'evaluations', '333', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(326, 'evaluations', '334', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(327, 'evaluations', '335', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(328, 'evaluations', '336', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(329, 'evaluations', '337', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(330, 'evaluations', '338', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(331, 'evaluations', '339', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(332, 'evaluations', '340', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(333, 'evaluations', '341', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(334, 'evaluations', '342', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(335, 'evaluations', '343', 'Creation', 15, NULL, '2023-07-06 23:02:33', '2023-07-06 23:02:33'),
	(336, 'evaluations', '344', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(337, 'evaluations', '345', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(338, 'evaluations', '346', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(339, 'evaluations', '347', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(340, 'evaluations', '348', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(341, 'evaluations', '349', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(342, 'evaluations', '350', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(343, 'evaluations', '351', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(344, 'evaluations', '352', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(345, 'evaluations', '353', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(346, 'evaluations', '354', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(347, 'evaluations', '355', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(348, 'evaluations', '356', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(349, 'evaluations', '357', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(350, 'evaluations', '358', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(351, 'evaluations', '359', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(352, 'evaluations', '360', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(353, 'evaluations', '361', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(354, 'evaluations', '362', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(355, 'evaluations', '363', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(356, 'evaluations', '364', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(357, 'evaluations', '365', 'Creation', 15, NULL, '2023-07-06 23:02:36', '2023-07-06 23:02:36'),
	(358, 'evaluations', '366', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(359, 'evaluations', '367', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(360, 'evaluations', '368', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(361, 'evaluations', '369', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(362, 'evaluations', '370', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(363, 'evaluations', '371', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(364, 'evaluations', '372', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(365, 'evaluations', '373', 'Creation', 15, NULL, '2023-07-06 23:02:39', '2023-07-06 23:02:39'),
	(366, 'evaluations', '374', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(367, 'evaluations', '375', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(368, 'evaluations', '376', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(369, 'evaluations', '377', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(370, 'evaluations', '378', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(371, 'evaluations', '379', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(372, 'evaluations', '380', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(373, 'evaluations', '381', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(374, 'evaluations', '382', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(375, 'evaluations', '383', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(376, 'evaluations', '384', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(377, 'evaluations', '385', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(378, 'evaluations', '386', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(379, 'evaluations', '387', 'Creation', 15, NULL, '2023-07-06 23:02:40', '2023-07-06 23:02:40'),
	(380, 'evaluations', '388', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(381, 'evaluations', '389', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(382, 'evaluations', '390', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(383, 'evaluations', '391', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(384, 'evaluations', '392', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(385, 'evaluations', '393', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(386, 'evaluations', '394', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(387, 'evaluations', '395', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(388, 'evaluations', '396', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(389, 'evaluations', '397', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(390, 'evaluations', '398', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(391, 'evaluations', '399', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(392, 'evaluations', '400', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(393, 'evaluations', '401', 'Creation', 15, NULL, '2023-07-06 23:02:42', '2023-07-06 23:02:42'),
	(394, 'evaluations', '402', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(395, 'evaluations', '403', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(396, 'evaluations', '404', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(397, 'evaluations', '405', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(398, 'evaluations', '406', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(399, 'evaluations', '407', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(400, 'evaluations', '408', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(401, 'evaluations', '409', 'Creation', 15, NULL, '2023-07-06 23:02:43', '2023-07-06 23:02:43'),
	(402, 'evaluations', '410', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(403, 'evaluations', '411', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(404, 'evaluations', '412', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(405, 'evaluations', '413', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(406, 'evaluations', '414', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(407, 'evaluations', '415', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(408, 'evaluations', '416', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(409, 'evaluations', '417', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(410, 'evaluations', '418', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(411, 'evaluations', '419', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(412, 'evaluations', '420', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(413, 'evaluations', '421', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(414, 'evaluations', '422', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(415, 'evaluations', '423', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(416, 'evaluations', '424', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(417, 'evaluations', '425', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(418, 'evaluations', '426', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(419, 'evaluations', '427', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(420, 'evaluations', '428', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(421, 'evaluations', '429', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(422, 'evaluations', '430', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(423, 'evaluations', '431', 'Creation', 15, NULL, '2023-07-06 23:02:45', '2023-07-06 23:02:45'),
	(424, 'evaluations', '432', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(425, 'evaluations', '433', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(426, 'evaluations', '434', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(427, 'evaluations', '435', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(428, 'evaluations', '436', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(429, 'evaluations', '437', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(430, 'evaluations', '438', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(431, 'evaluations', '439', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(432, 'evaluations', '440', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(433, 'evaluations', '441', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(434, 'evaluations', '442', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(435, 'evaluations', '443', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(436, 'evaluations', '444', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(437, 'evaluations', '445', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(438, 'evaluations', '446', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(439, 'evaluations', '447', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(440, 'evaluations', '448', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(441, 'evaluations', '449', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(442, 'evaluations', '450', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(443, 'evaluations', '451', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(444, 'evaluations', '452', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(445, 'evaluations', '453', 'Creation', 15, NULL, '2023-07-06 23:02:48', '2023-07-06 23:02:48'),
	(446, 'examens', '23', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(447, 'examens', '24', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(448, 'examens', '25', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(449, 'examens', '26', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(450, 'examens', '27', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(451, 'examens', '28', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(452, 'examens', '29', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(453, 'examens', '30', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(454, 'examens', '31', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(455, 'examens', '32', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(456, 'examens', '33', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(457, 'examens', '34', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(458, 'examens', '35', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(459, 'examens', '36', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(460, 'examens', '37', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(461, 'examens', '38', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(462, 'examens', '39', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(463, 'examens', '40', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(464, 'examens', '41', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(465, 'examens', '42', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(466, 'examens', '43', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(467, 'examens', '44', 'Creation', 15, NULL, '2023-07-06 23:05:03', '2023-07-06 23:05:03'),
	(468, 'examens', '45', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(469, 'examens', '46', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(470, 'examens', '47', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(471, 'examens', '48', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(472, 'examens', '49', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(473, 'examens', '50', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(474, 'examens', '51', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(475, 'examens', '52', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(476, 'examens', '53', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(477, 'examens', '54', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(478, 'examens', '55', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(479, 'examens', '56', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(480, 'examens', '57', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(481, 'examens', '58', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(482, 'examens', '59', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(483, 'examens', '60', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(484, 'examens', '61', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(485, 'examens', '62', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(486, 'examens', '63', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(487, 'examens', '64', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(488, 'examens', '65', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(489, 'examens', '66', 'Creation', 15, NULL, '2023-07-06 23:05:16', '2023-07-06 23:05:16'),
	(490, 'examens', '67', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(491, 'examens', '68', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(492, 'examens', '69', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(493, 'examens', '70', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(494, 'examens', '71', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(495, 'examens', '72', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(496, 'examens', '73', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(497, 'examens', '74', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(498, 'examens', '75', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(499, 'examens', '76', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(500, 'examens', '77', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(501, 'examens', '78', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(502, 'examens', '79', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(503, 'examens', '80', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(504, 'examens', '81', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(505, 'examens', '82', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(506, 'examens', '83', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(507, 'examens', '84', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(508, 'examens', '85', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(509, 'examens', '86', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(510, 'examens', '87', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(511, 'examens', '88', 'Creation', 15, NULL, '2023-07-06 23:05:20', '2023-07-06 23:05:20'),
	(512, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:06:42', '2023-07-06 23:06:42'),
	(513, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:06:46', '2023-07-06 23:06:46'),
	(514, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:06:49', '2023-07-06 23:06:49'),
	(515, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:06:50', '2023-07-06 23:06:50'),
	(516, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:06:53', '2023-07-06 23:06:53'),
	(517, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:07:42', '2023-07-06 23:07:42'),
	(518, 'eleve_Evaluation', '2342', 'Modification', 15, NULL, '2023-07-06 23:08:27', '2023-07-06 23:08:27'),
	(519, 'eleve_Evaluation', '2343', 'Modification', 15, NULL, '2023-07-06 23:08:33', '2023-07-06 23:08:33'),
	(520, 'eleve_Evaluation', '2344', 'Modification', 15, NULL, '2023-07-06 23:08:46', '2023-07-06 23:08:46'),
	(521, 'eleve_Evaluation', '2345', 'Modification', 15, NULL, '2023-07-06 23:08:57', '2023-07-06 23:08:57'),
	(522, 'eleve_Evaluation', '2346', 'Modification', 15, NULL, '2023-07-06 23:09:11', '2023-07-06 23:09:11'),
	(523, 'eleve_Evaluation', '2347', 'Modification', 15, NULL, '2023-07-06 23:09:22', '2023-07-06 23:09:22'),
	(524, 'eleve_Evaluation', '2348', 'Modification', 15, NULL, '2023-07-06 23:09:31', '2023-07-06 23:09:31'),
	(525, 'eleve_Evaluation', '2349', 'Modification', 15, NULL, '2023-07-06 23:09:42', '2023-07-06 23:09:42'),
	(526, 'eleve_Evaluation', '2350', 'Modification', 15, NULL, '2023-07-06 23:09:50', '2023-07-06 23:09:50'),
	(527, 'eleve_Evaluation', '2351', 'Modification', 15, NULL, '2023-07-06 23:09:59', '2023-07-06 23:09:59'),
	(528, 'eleve_Evaluation', '2352', 'Modification', 15, NULL, '2023-07-06 23:10:15', '2023-07-06 23:10:15'),
	(529, 'eleve_Evaluation', '2353', 'Modification', 15, NULL, '2023-07-06 23:10:24', '2023-07-06 23:10:24'),
	(530, 'eleve_Evaluation', '2354', 'Modification', 15, NULL, '2023-07-06 23:10:32', '2023-07-06 23:10:32'),
	(531, 'eleve_Evaluation', '2355', 'Modification', 15, NULL, '2023-07-06 23:10:41', '2023-07-06 23:10:41'),
	(532, 'eleve_Evaluation', '2356', 'Modification', 15, NULL, '2023-07-06 23:10:49', '2023-07-06 23:10:49'),
	(533, 'eleve_Evaluation', '2357', 'Modification', 15, NULL, '2023-07-06 23:10:58', '2023-07-06 23:10:58'),
	(534, 'eleve_Evaluation', '2357', 'Modification', 15, NULL, '2023-07-06 23:10:59', '2023-07-06 23:10:59'),
	(535, 'eleve_Evaluation', '2358', 'Modification', 15, NULL, '2023-07-06 23:11:30', '2023-07-06 23:11:30'),
	(536, 'eleve_Evaluation', '2359', 'Modification', 15, NULL, '2023-07-06 23:11:40', '2023-07-06 23:11:40'),
	(537, 'eleve_Evaluation', '2360', 'Modification', 15, NULL, '2023-07-06 23:11:44', '2023-07-06 23:11:44'),
	(538, 'eleve_Evaluation', '2361', 'Modification', 15, NULL, '2023-07-06 23:11:48', '2023-07-06 23:11:48'),
	(539, 'eleve_Evaluation', '2362', 'Modification', 15, NULL, '2023-07-06 23:11:54', '2023-07-06 23:11:54'),
	(540, 'eleve_Evaluation', '2363', 'Modification', 15, NULL, '2023-07-06 23:12:02', '2023-07-06 23:12:02'),
	(541, 'eleve_Evaluation', '2364', 'Modification', 15, NULL, '2023-07-06 23:14:51', '2023-07-06 23:14:51'),
	(542, 'eleve_Evaluation', '2365', 'Modification', 15, NULL, '2023-07-06 23:15:01', '2023-07-06 23:15:01'),
	(543, 'eleve_Evaluation', '2366', 'Modification', 15, NULL, '2023-07-06 23:15:08', '2023-07-06 23:15:08'),
	(544, 'eleve_Evaluation', '2367', 'Modification', 15, NULL, '2023-07-06 23:15:16', '2023-07-06 23:15:16'),
	(545, 'eleve_Evaluation', '2368', 'Modification', 15, NULL, '2023-07-06 23:15:24', '2023-07-06 23:15:24'),
	(546, 'eleve_Evaluation', '2369', 'Modification', 15, NULL, '2023-07-06 23:15:27', '2023-07-06 23:15:27'),
	(547, 'eleve_Evaluation', '2369', 'Modification', 15, NULL, '2023-07-06 23:15:34', '2023-07-06 23:15:34'),
	(548, 'eleve_Evaluation', '2370', 'Modification', 15, NULL, '2023-07-06 23:15:47', '2023-07-06 23:15:47'),
	(549, 'eleve_Evaluation', '2371', 'Modification', 15, NULL, '2023-07-06 23:15:53', '2023-07-06 23:15:53'),
	(550, 'eleve_Evaluation', '2372', 'Modification', 15, NULL, '2023-07-06 23:15:58', '2023-07-06 23:15:58'),
	(551, 'eleve_Evaluation', '2373', 'Modification', 15, NULL, '2023-07-06 23:16:01', '2023-07-06 23:16:01'),
	(552, 'eleve_Evaluation', '2374', 'Modification', 15, NULL, '2023-07-06 23:16:09', '2023-07-06 23:16:09'),
	(553, 'eleve_Evaluation', '2375', 'Modification', 15, NULL, '2023-07-06 23:16:14', '2023-07-06 23:16:14'),
	(554, 'eleve_Evaluation', '2376', 'Modification', 15, NULL, '2023-07-06 23:16:19', '2023-07-06 23:16:19'),
	(555, 'eleve_Evaluation', '2377', 'Modification', 15, NULL, '2023-07-06 23:16:23', '2023-07-06 23:16:23'),
	(556, 'eleve_Evaluation', '2378', 'Modification', 15, NULL, '2023-07-06 23:16:28', '2023-07-06 23:16:28'),
	(557, 'eleve_Evaluation', '2379', 'Modification', 15, NULL, '2023-07-06 23:16:39', '2023-07-06 23:16:39'),
	(558, 'eleve_Evaluation', '2380', 'Modification', 15, NULL, '2023-07-06 23:16:45', '2023-07-06 23:16:45'),
	(559, 'eleve_Evaluation', '2381', 'Modification', 15, NULL, '2023-07-06 23:16:49', '2023-07-06 23:16:49'),
	(560, 'eleve_Evaluation', '2382', 'Modification', 15, NULL, '2023-07-06 23:16:56', '2023-07-06 23:16:56'),
	(561, 'eleve_Evaluation', '2383', 'Modification', 15, NULL, '2023-07-06 23:17:01', '2023-07-06 23:17:01'),
	(562, 'eleve_Evaluation', '2384', 'Modification', 15, NULL, '2023-07-06 23:17:06', '2023-07-06 23:17:06'),
	(563, 'eleve_Evaluation', '2385', 'Modification', 15, NULL, '2023-07-06 23:17:13', '2023-07-06 23:17:13'),
	(564, 'eleve_Evaluation', '2366', 'Modification', 15, NULL, '2023-07-06 23:18:04', '2023-07-06 23:18:04'),
	(565, 'eleve_examen', '819', 'Modification', 15, NULL, '2023-07-06 23:20:02', '2023-07-06 23:20:02'),
	(566, 'eleve_examen', '818', 'Modification', 15, NULL, '2023-07-06 23:20:08', '2023-07-06 23:20:08'),
	(567, 'eleve_examen', '817', 'Modification', 15, NULL, '2023-07-06 23:20:15', '2023-07-06 23:20:15'),
	(568, 'eleve_examen', '816', 'Modification', 15, NULL, '2023-07-06 23:20:23', '2023-07-06 23:20:23'),
	(569, 'eleve_examen', '815', 'Modification', 15, NULL, '2023-07-06 23:20:29', '2023-07-06 23:20:29'),
	(570, 'eleve_examen', '814', 'Modification', 15, NULL, '2023-07-06 23:20:33', '2023-07-06 23:20:33'),
	(571, 'eleve_examen', '819', 'Modification', 15, NULL, '2023-07-06 23:21:14', '2023-07-06 23:21:14'),
	(572, 'eleve_examen', '819', 'Modification', 15, NULL, '2023-07-06 23:21:23', '2023-07-06 23:21:23'),
	(573, 'eleve_examen', '819', 'Modification', 15, NULL, '2023-07-06 23:21:34', '2023-07-06 23:21:34'),
	(574, 'eleve_examen', '818', 'Modification', 15, NULL, '2023-07-06 23:21:43', '2023-07-06 23:21:43'),
	(575, 'eleve_examen', '817', 'Modification', 15, NULL, '2023-07-06 23:21:55', '2023-07-06 23:21:55'),
	(576, 'eleve_examen', '816', 'Modification', 15, NULL, '2023-07-06 23:22:02', '2023-07-06 23:22:02'),
	(577, 'eleve_examen', '815', 'Modification', 15, NULL, '2023-07-06 23:22:13', '2023-07-06 23:22:13'),
	(578, 'eleve_examen', '814', 'Modification', 15, NULL, '2023-07-06 23:22:23', '2023-07-06 23:22:23'),
	(579, 'eleve_examen', '798', 'Modification', 15, NULL, '2023-07-06 23:22:31', '2023-07-06 23:22:31'),
	(580, 'eleve_examen', '799', 'Modification', 15, NULL, '2023-07-06 23:22:37', '2023-07-06 23:22:37'),
	(581, 'eleve_examen', '800', 'Modification', 15, NULL, '2023-07-06 23:22:43', '2023-07-06 23:22:43'),
	(582, 'eleve_examen', '801', 'Modification', 15, NULL, '2023-07-06 23:22:51', '2023-07-06 23:22:51'),
	(583, 'eleve_examen', '802', 'Modification', 15, NULL, '2023-07-06 23:22:56', '2023-07-06 23:22:56'),
	(584, 'eleve_examen', '803', 'Modification', 15, NULL, '2023-07-06 23:23:02', '2023-07-06 23:23:02'),
	(585, 'eleve_examen', '804', 'Modification', 15, NULL, '2023-07-06 23:23:10', '2023-07-06 23:23:10'),
	(586, 'eleve_examen', '805', 'Modification', 15, NULL, '2023-07-06 23:23:16', '2023-07-06 23:23:16'),
	(587, 'eleve_examen', '806', 'Modification', 15, NULL, '2023-07-06 23:23:22', '2023-07-06 23:23:22'),
	(588, 'eleve_examen', '807', 'Modification', 15, NULL, '2023-07-06 23:23:40', '2023-07-06 23:23:40'),
	(589, 'eleve_examen', '808', 'Modification', 15, NULL, '2023-07-06 23:23:53', '2023-07-06 23:23:53'),
	(590, 'eleve_examen', '809', 'Modification', 15, NULL, '2023-07-06 23:24:00', '2023-07-06 23:24:00'),
	(591, 'eleve_examen', '810', 'Modification', 15, NULL, '2023-07-06 23:24:05', '2023-07-06 23:24:05'),
	(592, 'eleve_examen', '811', 'Modification', 15, NULL, '2023-07-06 23:24:11', '2023-07-06 23:24:11'),
	(593, 'eleve_examen', '812', 'Modification', 15, NULL, '2023-07-06 23:24:16', '2023-07-06 23:24:16'),
	(594, 'eleve_examen', '813', 'Modification', 15, NULL, '2023-07-06 23:24:22', '2023-07-06 23:24:22'),
	(595, 'cours', '12', 'Modification', 5, NULL, '2023-07-06 23:32:17', '2023-07-06 23:32:17'),
	(596, 'eleve_Evaluation', '2386', 'Modification', 15, NULL, '2023-07-06 23:42:10', '2023-07-06 23:42:10'),
	(597, 'eleve_Evaluation', '2387', 'Modification', 15, NULL, '2023-07-06 23:42:14', '2023-07-06 23:42:14'),
	(598, 'eleve_Evaluation', '2388', 'Modification', 15, NULL, '2023-07-06 23:42:24', '2023-07-06 23:42:24'),
	(599, 'eleve_Evaluation', '2389', 'Modification', 15, NULL, '2023-07-06 23:42:29', '2023-07-06 23:42:29'),
	(600, 'eleve_Evaluation', '2390', 'Modification', 15, NULL, '2023-07-06 23:42:33', '2023-07-06 23:42:33'),
	(601, 'eleve_Evaluation', '2391', 'Modification', 15, NULL, '2023-07-06 23:42:37', '2023-07-06 23:42:37'),
	(602, 'eleve_Evaluation', '2392', 'Modification', 15, NULL, '2023-07-06 23:42:43', '2023-07-06 23:42:43'),
	(603, 'eleve_Evaluation', '2393', 'Modification', 15, NULL, '2023-07-06 23:42:49', '2023-07-06 23:42:49'),
	(604, 'eleve_Evaluation', '2394', 'Modification', 15, NULL, '2023-07-06 23:42:55', '2023-07-06 23:42:55'),
	(605, 'eleve_Evaluation', '2395', 'Modification', 15, NULL, '2023-07-06 23:42:59', '2023-07-06 23:42:59'),
	(606, 'eleve_Evaluation', '2396', 'Modification', 15, NULL, '2023-07-06 23:43:09', '2023-07-06 23:43:09'),
	(607, 'eleve_Evaluation', '2397', 'Modification', 15, NULL, '2023-07-06 23:43:15', '2023-07-06 23:43:15'),
	(608, 'eleve_Evaluation', '2398', 'Modification', 15, NULL, '2023-07-06 23:43:21', '2023-07-06 23:43:21'),
	(609, 'eleve_Evaluation', '2399', 'Modification', 15, NULL, '2023-07-06 23:43:27', '2023-07-06 23:43:27'),
	(610, 'eleve_Evaluation', '2400', 'Modification', 15, NULL, '2023-07-06 23:43:33', '2023-07-06 23:43:33'),
	(611, 'eleve_Evaluation', '2401', 'Modification', 15, NULL, '2023-07-06 23:43:41', '2023-07-06 23:43:41'),
	(612, 'eleve_Evaluation', '2402', 'Modification', 15, NULL, '2023-07-06 23:43:47', '2023-07-06 23:43:47'),
	(613, 'eleve_Evaluation', '2403', 'Modification', 15, NULL, '2023-07-06 23:43:54', '2023-07-06 23:43:54'),
	(614, 'eleve_Evaluation', '2404', 'Modification', 15, NULL, '2023-07-06 23:44:01', '2023-07-06 23:44:01'),
	(615, 'eleve_Evaluation', '2405', 'Modification', 15, NULL, '2023-07-06 23:44:08', '2023-07-06 23:44:08'),
	(616, 'eleve_Evaluation', '2406', 'Modification', 15, NULL, '2023-07-06 23:44:17', '2023-07-06 23:44:17'),
	(617, 'eleve_Evaluation', '2407', 'Modification', 15, NULL, '2023-07-06 23:44:22', '2023-07-06 23:44:22'),
	(618, 'eleve_Evaluation', '2408', 'Modification', 15, NULL, '2023-07-06 23:48:26', '2023-07-06 23:48:26'),
	(619, 'eleve_Evaluation', '2409', 'Modification', 15, NULL, '2023-07-06 23:49:34', '2023-07-06 23:49:34'),
	(620, 'eleve_Evaluation', '2410', 'Modification', 15, NULL, '2023-07-06 23:50:01', '2023-07-06 23:50:01'),
	(621, 'eleve_Evaluation', '2411', 'Modification', 15, NULL, '2023-07-06 23:50:05', '2023-07-06 23:50:05'),
	(622, 'eleve_Evaluation', '2412', 'Modification', 15, NULL, '2023-07-06 23:50:12', '2023-07-06 23:50:12'),
	(623, 'eleve_Evaluation', '2413', 'Modification', 15, NULL, '2023-07-06 23:50:24', '2023-07-06 23:50:24'),
	(624, 'eleve_Evaluation', '2414', 'Modification', 15, NULL, '2023-07-06 23:50:30', '2023-07-06 23:50:30'),
	(625, 'eleve_Evaluation', '2415', 'Modification', 15, NULL, '2023-07-06 23:50:46', '2023-07-06 23:50:46'),
	(626, 'eleve_Evaluation', '2416', 'Modification', 15, NULL, '2023-07-06 23:50:58', '2023-07-06 23:50:58'),
	(627, 'eleve_Evaluation', '2415', 'Modification', 15, NULL, '2023-07-06 23:51:14', '2023-07-06 23:51:14'),
	(628, 'eleve_Evaluation', '2417', 'Modification', 15, NULL, '2023-07-06 23:51:29', '2023-07-06 23:51:29'),
	(629, 'eleve_Evaluation', '2418', 'Modification', 15, NULL, '2023-07-06 23:51:38', '2023-07-06 23:51:38'),
	(630, 'eleve_Evaluation', '2419', 'Modification', 15, NULL, '2023-07-06 23:51:55', '2023-07-06 23:51:55'),
	(631, 'eleve_Evaluation', '2420', 'Modification', 15, NULL, '2023-07-06 23:52:05', '2023-07-06 23:52:05'),
	(632, 'eleve_Evaluation', '2421', 'Modification', 15, NULL, '2023-07-06 23:52:13', '2023-07-06 23:52:13'),
	(633, 'eleve_Evaluation', '2422', 'Modification', 15, NULL, '2023-07-06 23:52:16', '2023-07-06 23:52:16'),
	(634, 'eleve_Evaluation', '2423', 'Modification', 15, NULL, '2023-07-06 23:52:20', '2023-07-06 23:52:20'),
	(635, 'eleve_Evaluation', '2424', 'Modification', 15, NULL, '2023-07-06 23:52:25', '2023-07-06 23:52:25'),
	(636, 'eleve_Evaluation', '2425', 'Modification', 15, NULL, '2023-07-06 23:52:31', '2023-07-06 23:52:31'),
	(637, 'eleve_Evaluation', '2426', 'Modification', 15, NULL, '2023-07-06 23:52:35', '2023-07-06 23:52:35'),
	(638, 'eleve_Evaluation', '2427', 'Modification', 15, NULL, '2023-07-06 23:52:39', '2023-07-06 23:52:39'),
	(639, 'eleve_Evaluation', '2428', 'Modification', 15, NULL, '2023-07-06 23:52:44', '2023-07-06 23:52:44'),
	(640, 'eleve_Evaluation', '2429', 'Modification', 15, NULL, '2023-07-06 23:52:48', '2023-07-06 23:52:48'),
	(641, 'eleve_Evaluation', '2414', 'Modification', 15, NULL, '2023-07-06 23:54:07', '2023-07-06 23:54:07'),
	(642, 'eleve_examen', '820', 'Modification', 15, NULL, '2023-07-06 23:59:06', '2023-07-06 23:59:06'),
	(643, 'eleve_examen', '821', 'Modification', 15, NULL, '2023-07-06 23:59:10', '2023-07-06 23:59:10'),
	(644, 'eleve_examen', '822', 'Modification', 15, NULL, '2023-07-06 23:59:26', '2023-07-06 23:59:26'),
	(645, 'eleve_examen', '823', 'Modification', 15, NULL, '2023-07-06 23:59:32', '2023-07-06 23:59:32'),
	(646, 'eleve_examen', '824', 'Modification', 15, NULL, '2023-07-06 23:59:37', '2023-07-06 23:59:37'),
	(647, 'eleve_examen', '825', 'Modification', 15, NULL, '2023-07-06 23:59:40', '2023-07-06 23:59:40'),
	(648, 'eleve_examen', '826', 'Modification', 15, NULL, '2023-07-06 23:59:48', '2023-07-06 23:59:48'),
	(649, 'eleve_examen', '827', 'Modification', 15, NULL, '2023-07-06 23:59:53', '2023-07-06 23:59:53'),
	(650, 'eleve_examen', '828', 'Modification', 15, NULL, '2023-07-07 00:00:00', '2023-07-07 00:00:00'),
	(651, 'eleve_examen', '829', 'Modification', 15, NULL, '2023-07-07 00:00:24', '2023-07-07 00:00:24'),
	(652, 'eleve_examen', '830', 'Modification', 15, NULL, '2023-07-07 00:00:32', '2023-07-07 00:00:32'),
	(653, 'eleve_examen', '831', 'Modification', 15, NULL, '2023-07-07 00:00:37', '2023-07-07 00:00:37'),
	(654, 'eleve_examen', '832', 'Modification', 15, NULL, '2023-07-07 00:00:41', '2023-07-07 00:00:41'),
	(655, 'eleve_examen', '833', 'Modification', 15, NULL, '2023-07-07 00:00:52', '2023-07-07 00:00:52'),
	(656, 'eleve_examen', '834', 'Modification', 15, NULL, '2023-07-07 00:00:59', '2023-07-07 00:00:59'),
	(657, 'eleve_examen', '835', 'Modification', 15, NULL, '2023-07-07 00:01:02', '2023-07-07 00:01:02'),
	(658, 'eleve_examen', '836', 'Modification', 15, NULL, '2023-07-07 00:01:10', '2023-07-07 00:01:10'),
	(659, 'eleve_examen', '837', 'Modification', 15, NULL, '2023-07-07 00:01:18', '2023-07-07 00:01:18'),
	(660, 'eleve_examen', '838', 'Modification', 15, NULL, '2023-07-07 00:01:21', '2023-07-07 00:01:21'),
	(661, 'eleve_examen', '839', 'Modification', 15, NULL, '2023-07-07 00:01:30', '2023-07-07 00:01:30'),
	(662, 'eleve_examen', '840', 'Modification', 15, NULL, '2023-07-07 00:01:35', '2023-07-07 00:01:35'),
	(663, 'eleve_examen', '841', 'Modification', 15, NULL, '2023-07-07 00:01:39', '2023-07-07 00:01:39'),
	(664, 'eleve_Evaluation', '2430', 'Modification', 15, NULL, '2023-07-07 21:28:04', '2023-07-07 21:28:04'),
	(665, 'eleve_Evaluation', '2431', 'Modification', 15, NULL, '2023-07-07 21:28:10', '2023-07-07 21:28:10'),
	(666, 'eleve_Evaluation', '2432', 'Modification', 15, NULL, '2023-07-07 21:28:20', '2023-07-07 21:28:20'),
	(667, 'eleve_Evaluation', '2433', 'Modification', 15, NULL, '2023-07-07 21:28:23', '2023-07-07 21:28:23'),
	(668, 'eleve_Evaluation', '2434', 'Modification', 15, NULL, '2023-07-07 21:28:32', '2023-07-07 21:28:32'),
	(669, 'eleve_Evaluation', '2435', 'Modification', 15, NULL, '2023-07-07 21:28:57', '2023-07-07 21:28:57'),
	(670, 'eleve_Evaluation', '2436', 'Modification', 15, NULL, '2023-07-07 21:29:09', '2023-07-07 21:29:09'),
	(671, 'eleve_Evaluation', '2437', 'Modification', 15, NULL, '2023-07-07 21:29:13', '2023-07-07 21:29:13'),
	(672, 'eleve_Evaluation', '2438', 'Modification', 15, NULL, '2023-07-07 21:29:19', '2023-07-07 21:29:19'),
	(673, 'eleve_Evaluation', '2439', 'Modification', 15, NULL, '2023-07-07 21:29:26', '2023-07-07 21:29:26'),
	(674, 'eleve_Evaluation', '2440', 'Modification', 15, NULL, '2023-07-07 21:29:30', '2023-07-07 21:29:30'),
	(675, 'eleve_Evaluation', '2441', 'Modification', 15, NULL, '2023-07-07 21:29:35', '2023-07-07 21:29:35'),
	(676, 'eleve_Evaluation', '2442', 'Modification', 15, NULL, '2023-07-07 21:29:41', '2023-07-07 21:29:41'),
	(677, 'eleve_Evaluation', '2443', 'Modification', 15, NULL, '2023-07-07 21:29:49', '2023-07-07 21:29:49'),
	(678, 'eleve_Evaluation', '2444', 'Modification', 15, NULL, '2023-07-07 21:29:53', '2023-07-07 21:29:53'),
	(679, 'eleve_Evaluation', '2445', 'Modification', 15, NULL, '2023-07-07 21:29:56', '2023-07-07 21:29:56'),
	(680, 'eleve_Evaluation', '2446', 'Modification', 15, NULL, '2023-07-07 21:30:08', '2023-07-07 21:30:08'),
	(681, 'eleve_Evaluation', '2447', 'Modification', 15, NULL, '2023-07-07 21:30:13', '2023-07-07 21:30:13'),
	(682, 'eleve_Evaluation', '2449', 'Modification', 15, NULL, '2023-07-07 21:30:16', '2023-07-07 21:30:16'),
	(683, 'eleve_Evaluation', '2450', 'Modification', 15, NULL, '2023-07-07 21:34:47', '2023-07-07 21:34:47'),
	(684, 'eleve_Evaluation', '2451', 'Modification', 15, NULL, '2023-07-07 21:34:59', '2023-07-07 21:34:59'),
	(685, 'eleve_Evaluation', '2448', 'Modification', 15, NULL, '2023-07-07 21:35:17', '2023-07-07 21:35:17'),
	(686, 'eleve_Evaluation', '2449', 'Modification', 15, NULL, '2023-07-07 21:35:21', '2023-07-07 21:35:21'),
	(687, 'eleve_Evaluation', '2452', 'Modification', 15, NULL, '2023-07-07 21:38:12', '2023-07-07 21:38:12'),
	(688, 'eleve_Evaluation', '2453', 'Modification', 15, NULL, '2023-07-07 21:38:16', '2023-07-07 21:38:16'),
	(689, 'eleve_Evaluation', '2454', 'Modification', 15, NULL, '2023-07-07 21:38:21', '2023-07-07 21:38:21'),
	(690, 'eleve_Evaluation', '2455', 'Modification', 15, NULL, '2023-07-07 21:38:26', '2023-07-07 21:38:26'),
	(691, 'eleve_Evaluation', '2456', 'Modification', 15, NULL, '2023-07-07 21:38:29', '2023-07-07 21:38:29'),
	(692, 'eleve_Evaluation', '2457', 'Modification', 15, NULL, '2023-07-07 21:38:33', '2023-07-07 21:38:33'),
	(693, 'eleve_Evaluation', '2458', 'Modification', 15, NULL, '2023-07-07 21:38:41', '2023-07-07 21:38:41'),
	(694, 'eleve_Evaluation', '2459', 'Modification', 15, NULL, '2023-07-07 21:38:48', '2023-07-07 21:38:48'),
	(695, 'eleve_Evaluation', '2460', 'Modification', 15, NULL, '2023-07-07 21:38:52', '2023-07-07 21:38:52'),
	(696, 'eleve_Evaluation', '2461', 'Modification', 15, NULL, '2023-07-07 21:39:01', '2023-07-07 21:39:01'),
	(697, 'eleve_Evaluation', '2462', 'Modification', 15, NULL, '2023-07-07 21:39:12', '2023-07-07 21:39:12'),
	(698, 'eleve_Evaluation', '2463', 'Modification', 15, NULL, '2023-07-07 21:39:18', '2023-07-07 21:39:18'),
	(699, 'eleve_Evaluation', '2464', 'Modification', 15, NULL, '2023-07-07 21:39:25', '2023-07-07 21:39:25'),
	(700, 'eleve_Evaluation', '2465', 'Modification', 15, NULL, '2023-07-07 21:39:29', '2023-07-07 21:39:29'),
	(701, 'eleve_Evaluation', '2466', 'Modification', 15, NULL, '2023-07-07 21:39:32', '2023-07-07 21:39:32'),
	(702, 'eleve_Evaluation', '2467', 'Modification', 15, NULL, '2023-07-07 21:39:37', '2023-07-07 21:39:37'),
	(703, 'eleve_Evaluation', '2468', 'Modification', 15, NULL, '2023-07-07 21:39:42', '2023-07-07 21:39:42'),
	(704, 'eleve_Evaluation', '2469', 'Modification', 15, NULL, '2023-07-07 21:39:46', '2023-07-07 21:39:46'),
	(705, 'eleve_Evaluation', '2470', 'Modification', 15, NULL, '2023-07-07 21:39:51', '2023-07-07 21:39:51'),
	(706, 'eleve_Evaluation', '2471', 'Modification', 15, NULL, '2023-07-07 21:39:55', '2023-07-07 21:39:55'),
	(707, 'eleve_Evaluation', '2472', 'Modification', 15, NULL, '2023-07-07 21:39:58', '2023-07-07 21:39:58'),
	(708, 'eleve_Evaluation', '2473', 'Modification', 15, NULL, '2023-07-07 21:40:02', '2023-07-07 21:40:02'),
	(709, 'eleve_examen', '842', 'Modification', 15, NULL, '2023-07-07 21:53:01', '2023-07-07 21:53:01'),
	(710, 'eleve_examen', '843', 'Modification', 15, NULL, '2023-07-07 21:53:07', '2023-07-07 21:53:07'),
	(711, 'eleve_examen', '844', 'Modification', 15, NULL, '2023-07-07 21:53:12', '2023-07-07 21:53:12'),
	(712, 'eleve_examen', '845', 'Modification', 15, NULL, '2023-07-07 21:53:17', '2023-07-07 21:53:17'),
	(713, 'eleve_examen', '846', 'Modification', 15, NULL, '2023-07-07 21:53:21', '2023-07-07 21:53:21'),
	(714, 'eleve_examen', '847', 'Modification', 15, NULL, '2023-07-07 21:53:26', '2023-07-07 21:53:26'),
	(715, 'eleve_examen', '848', 'Modification', 15, NULL, '2023-07-07 21:53:29', '2023-07-07 21:53:29'),
	(716, 'eleve_examen', '849', 'Modification', 15, NULL, '2023-07-07 21:53:33', '2023-07-07 21:53:33'),
	(717, 'eleve_examen', '850', 'Modification', 15, NULL, '2023-07-07 21:53:39', '2023-07-07 21:53:39'),
	(718, 'eleve_examen', '851', 'Modification', 15, NULL, '2023-07-07 21:53:43', '2023-07-07 21:53:43'),
	(719, 'eleve_examen', '852', 'Modification', 15, NULL, '2023-07-07 21:53:47', '2023-07-07 21:53:47'),
	(720, 'eleve_examen', '853', 'Modification', 15, NULL, '2023-07-07 21:53:51', '2023-07-07 21:53:51'),
	(721, 'eleve_examen', '854', 'Modification', 15, NULL, '2023-07-07 21:53:59', '2023-07-07 21:53:59'),
	(722, 'eleve_examen', '855', 'Modification', 15, NULL, '2023-07-07 21:54:04', '2023-07-07 21:54:04'),
	(723, 'eleve_examen', '856', 'Modification', 15, NULL, '2023-07-07 21:54:08', '2023-07-07 21:54:08'),
	(724, 'eleve_examen', '857', 'Modification', 15, NULL, '2023-07-07 21:54:12', '2023-07-07 21:54:12'),
	(725, 'eleve_examen', '858', 'Modification', 15, NULL, '2023-07-07 21:54:17', '2023-07-07 21:54:17'),
	(726, 'eleve_examen', '859', 'Modification', 15, NULL, '2023-07-07 21:54:21', '2023-07-07 21:54:21'),
	(727, 'eleve_examen', '860', 'Modification', 15, NULL, '2023-07-07 21:54:25', '2023-07-07 21:54:25'),
	(728, 'eleve_examen', '861', 'Modification', 15, NULL, '2023-07-07 21:54:31', '2023-07-07 21:54:31'),
	(729, 'eleve_examen', '862', 'Modification', 15, NULL, '2023-07-07 21:54:48', '2023-07-07 21:54:48'),
	(730, 'eleve_examen', '863', 'Modification', 15, NULL, '2023-07-07 21:54:52', '2023-07-07 21:54:52'),
	(731, 'resultats', '36', 'Modification', 15, NULL, '2023-07-07 21:55:38', '2023-07-07 21:55:38'),
	(732, 'eleve_conduites', '8', 'Creation', 9, NULL, '2023-07-07 22:19:33', '2023-07-07 22:19:33'),
	(733, 'employers', '14', 'Creation', 5, NULL, '2023-07-07 23:05:31', '2023-07-07 23:05:31'),
	(734, 'users', '17', 'Creation', 5, NULL, '2023-07-07 23:06:12', '2023-07-07 23:06:12'),
	(735, 'encadrements', '9', 'Creation', 5, NULL, '2023-07-07 23:09:46', '2023-07-07 23:09:46'),
	(736, 'users', '17', 'Modification', 5, NULL, '2023-07-07 23:10:01', '2023-07-07 23:10:01'),
	(737, 'messages', '15', 'Creation', 5, NULL, '2023-07-07 23:16:59', '2023-07-07 23:16:59'),
	(738, 'messages', '16', 'Creation', 5, NULL, '2023-07-07 23:16:59', '2023-07-07 23:16:59'),
	(739, 'messages', '17', 'Creation', 5, NULL, '2023-07-07 23:16:59', '2023-07-07 23:16:59'),
	(740, 'messages', '18', 'Creation', 5, NULL, '2023-07-07 23:16:59', '2023-07-07 23:16:59'),
	(741, 'eleves', '38', 'Creation', 9, NULL, '2023-07-07 23:18:29', '2023-07-07 23:18:29'),
	(742, 'frequentations', '41', 'Creation', 9, NULL, '2023-07-07 23:18:41', '2023-07-07 23:18:41'),
	(743, 'resultats', '37', 'Creation', 9, NULL, '2023-07-07 23:18:41', '2023-07-07 23:18:41'),
	(744, 'frequentations', '41', 'Modification', 9, NULL, '2023-07-07 23:38:52', '2023-07-07 23:38:52'),
	(745, 'paiement_frais', '14', 'Creation', 9, NULL, '2023-07-07 23:40:39', '2023-07-07 23:40:39'),
	(746, 'employers', '15', 'Creation', 5, NULL, '2023-07-08 08:16:57', '2023-07-08 08:16:57'),
	(747, 'employers', '15', 'Modification', 5, NULL, '2023-07-08 08:17:39', '2023-07-08 08:17:39'),
	(748, 'users', '18', 'Creation', 5, NULL, '2023-07-08 08:18:18', '2023-07-08 08:18:18'),
	(749, 'encadrements', '10', 'Creation', 5, NULL, '2023-07-08 08:18:42', '2023-07-08 08:18:42'),
	(750, 'users', '18', 'Modification', 5, NULL, '2023-07-08 08:18:53', '2023-07-08 08:18:53'),
	(751, 'messages', '19', 'Creation', 5, NULL, '2023-07-08 08:19:23', '2023-07-08 08:19:23'),
	(752, 'eleves', '39', 'Creation', 9, NULL, '2023-07-08 08:21:25', '2023-07-08 08:21:25'),
	(753, 'frequentations', '42', 'Creation', 9, NULL, '2023-07-08 08:21:44', '2023-07-08 08:21:44'),
	(754, 'resultats', '38', 'Creation', 9, NULL, '2023-07-08 08:21:44', '2023-07-08 08:21:44'),
	(755, 'classes', '9', 'Suppression', 5, NULL, '2023-07-11 17:42:23', '2023-07-11 17:42:23'),
	(756, 'classes', '9', 'Restoration', 2, NULL, '2023-07-11 17:42:52', '2023-07-11 17:42:52'),
	(757, 'annee_scolaires', '2', 'Suppression', 5, NULL, '2023-07-14 11:19:24', '2023-07-14 11:19:24'),
	(758, 'parrains', '3', 'Modification', 9, NULL, '2023-07-14 11:20:43', '2023-07-14 11:20:43'),
	(759, 'users', '8', 'Modification', 9, NULL, '2023-07-14 11:20:44', '2023-07-14 11:20:44'),
	(760, 'eleve_conduites', '9', 'Creation', 15, NULL, '2023-07-14 12:35:46', '2023-07-14 12:35:46'),
	(761, 'eleve_conduites', '10', 'Creation', 15, NULL, '2023-07-14 12:36:25', '2023-07-14 12:36:25'),
	(762, 'eleve_conduites', '11', 'Creation', 15, NULL, '2023-07-14 12:36:50', '2023-07-14 12:36:50'),
	(763, 'eleve_conduites', '12', 'Creation', 15, NULL, '2023-07-14 12:37:04', '2023-07-14 12:37:04'),
	(764, 'eleve_conduites', '13', 'Creation', 15, NULL, '2023-07-14 12:37:35', '2023-07-14 12:37:35'),
	(765, 'eleve_conduites', '14', 'Creation', 15, NULL, '2023-07-14 12:43:55', '2023-07-14 12:43:55'),
	(766, 'eleve_conduites', '15', 'Creation', 15, NULL, '2023-07-14 12:44:10', '2023-07-14 12:44:10'),
	(767, 'annee_scolaires', '2', 'Restoration', 2, NULL, '2023-07-18 09:56:06', '2023-07-18 09:56:06'),
	(768, 'annee_scolaires', '2', 'Suppression', 5, NULL, '2023-07-18 12:45:32', '2023-07-18 12:45:32'),
	(769, 'employers', '16', 'Creation', 3, NULL, '2023-08-03 10:18:49', '2023-08-03 10:18:49'),
	(770, 'evaluations', '1', 'Creation', 3, NULL, '2023-08-03 10:20:25', '2023-08-03 10:20:25'),
	(771, 'examens', '1', 'Creation', 3, NULL, '2023-08-03 10:25:58', '2023-08-03 10:25:58'),
	(772, 'eleve_Evaluation', '2', 'Modification', 3, NULL, '2023-08-03 10:35:04', '2023-08-03 10:35:04'),
	(773, 'evaluations', '2', 'Creation', 3, NULL, '2023-08-03 11:26:19', '2023-08-03 11:26:19'),
	(774, 'resultats', '1', 'Modification', 3, NULL, '2023-08-03 11:27:33', '2023-08-03 11:27:33'),
	(775, 'cours', '32', 'Creation', 5, NULL, '2023-08-04 15:44:49', '2023-08-04 15:44:49'),
	(776, 'horaires', '1', 'Creation', 3, NULL, '2023-08-04 15:49:38', '2023-08-04 15:49:38'),
	(777, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 15:50:20', '2023-08-04 15:50:20'),
	(778, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 15:53:06', '2023-08-04 15:53:06'),
	(779, 'horaires', '4', 'Creation', 3, NULL, '2023-08-04 15:54:02', '2023-08-04 15:54:02'),
	(780, 'horaires', '1', 'Creation', 3, NULL, '2023-08-04 16:00:59', '2023-08-04 16:00:59'),
	(781, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:01:07', '2023-08-04 16:01:07'),
	(782, 'horaires', '4', 'Creation', 3, NULL, '2023-08-04 16:01:11', '2023-08-04 16:01:11'),
	(783, 'horaires', '3', 'Creation', 3, NULL, '2023-08-04 16:17:29', '2023-08-04 16:17:29'),
	(784, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:17:37', '2023-08-04 16:17:37'),
	(785, 'horaires', '9', 'Creation', 3, NULL, '2023-08-04 16:17:41', '2023-08-04 16:17:41'),
	(786, 'horaires', '7', 'Creation', 3, NULL, '2023-08-04 16:17:47', '2023-08-04 16:17:47'),
	(787, 'horaires', '1', 'Creation', 3, NULL, '2023-08-04 16:39:49', '2023-08-04 16:39:49'),
	(788, 'horaires', '6', 'Creation', 3, NULL, '2023-08-04 16:39:51', '2023-08-04 16:39:51'),
	(789, 'horaires', '7', 'Creation', 3, NULL, '2023-08-04 16:39:53', '2023-08-04 16:39:53'),
	(790, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:40:14', '2023-08-04 16:40:14'),
	(791, 'horaires', '1', 'Creation', 3, NULL, '2023-08-04 16:41:34', '2023-08-04 16:41:34'),
	(792, 'horaires', '1', 'Creation', 3, NULL, '2023-08-04 16:41:40', '2023-08-04 16:41:40'),
	(793, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:41:45', '2023-08-04 16:41:45'),
	(794, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:41:49', '2023-08-04 16:41:49'),
	(795, 'horaires', '3', 'Creation', 3, NULL, '2023-08-04 16:41:53', '2023-08-04 16:41:53'),
	(796, 'horaires', '6', 'Creation', 3, NULL, '2023-08-04 16:41:58', '2023-08-04 16:41:58'),
	(797, 'horaires', '9', 'Creation', 3, NULL, '2023-08-04 16:42:03', '2023-08-04 16:42:03'),
	(798, 'horaires', '2', 'Modification', 3, NULL, '2023-08-04 16:46:25', '2023-08-04 16:46:25'),
	(799, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:47:02', '2023-08-04 16:47:02'),
	(800, 'horaires', '2', 'Creation', 3, NULL, '2023-08-04 16:47:07', '2023-08-04 16:47:07'),
	(801, 'horaires', '26', 'Creation', 3, NULL, '2023-08-04 17:01:19', '2023-08-04 17:01:19'),
	(802, 'horaires', '27', 'Creation', 3, NULL, '2023-08-04 17:04:50', '2023-08-04 17:04:50'),
	(803, 'horaires', '28', 'Creation', 3, NULL, '2023-08-04 17:04:51', '2023-08-04 17:04:51'),
	(804, 'horaires', '29', 'Creation', 3, NULL, '2023-08-04 17:04:52', '2023-08-04 17:04:52'),
	(805, 'horaires', '30', 'Creation', 3, NULL, '2023-08-04 17:04:53', '2023-08-04 17:04:53'),
	(806, 'horaires', '31', 'Creation', 3, NULL, '2023-08-04 17:04:54', '2023-08-04 17:04:54'),
	(807, 'horaires', '30', 'Modification', 3, NULL, '2023-08-04 17:04:55', '2023-08-04 17:04:55'),
	(808, 'horaires', '32', 'Creation', 3, NULL, '2023-08-04 17:05:05', '2023-08-04 17:05:05'),
	(809, 'horaires', '33', 'Creation', 3, NULL, '2023-08-04 17:54:16', '2023-08-04 17:54:16'),
	(810, 'horaires', '34', 'Creation', 3, NULL, '2023-08-04 17:54:22', '2023-08-04 17:54:22'),
	(811, 'horaires', '35', 'Creation', 3, NULL, '2023-08-04 17:54:28', '2023-08-04 17:54:28'),
	(812, 'horaires', '36', 'Creation', 3, NULL, '2023-08-04 17:54:33', '2023-08-04 17:54:33'),
	(813, 'horaires', '19', 'Modification', 3, NULL, '2023-08-07 22:34:23', '2023-08-07 22:34:23'),
	(814, 'horaires', '17', 'Modification', 3, NULL, '2023-08-07 22:57:17', '2023-08-07 22:57:17'),
	(815, 'horaires', '17', 'Modification', 3, NULL, '2023-08-07 23:13:27', '2023-08-07 23:13:27'),
	(816, 'horaires', '17', 'Modification', 3, NULL, '2023-08-07 23:15:00', '2023-08-07 23:15:00'),
	(817, 'horaires', '17', 'Modification', 3, NULL, '2023-08-07 23:36:39', '2023-08-07 23:36:39'),
	(818, 'horaires', '17', 'Modification', 3, NULL, '2023-08-07 23:38:40', '2023-08-07 23:38:40'),
	(819, 'horaires', '33', 'Modification', 3, NULL, '2023-08-07 23:39:04', '2023-08-07 23:39:04'),
	(820, 'eleve_Evaluation', '1', 'Modification', 3, NULL, '2023-08-07 23:40:46', '2023-08-07 23:40:46'),
	(821, 'horaires', '37', 'Creation', 3, NULL, '2023-08-07 23:41:53', '2023-08-07 23:41:53'),
	(822, 'horaires', '38', 'Creation', 3, NULL, '2023-08-07 23:44:02', '2023-08-07 23:44:02'),
	(823, 'horaires', '39', 'Creation', 3, NULL, '2023-08-07 23:44:05', '2023-08-07 23:44:05'),
	(824, 'horaires', '40', 'Creation', 3, NULL, '2023-08-07 23:44:06', '2023-08-07 23:44:06'),
	(825, 'horaires', '42', 'Modification', 3, NULL, '2023-08-07 23:44:48', '2023-08-07 23:44:48'),
	(826, 'horaires', '42', 'Modification', 3, NULL, '2023-08-07 23:49:19', '2023-08-07 23:49:19'),
	(827, 'horaires', '44', 'Modification', 3, NULL, '2023-08-07 23:58:14', '2023-08-07 23:58:14'),
	(828, 'horaires', '46', 'Modification', 3, NULL, '2023-08-07 23:58:18', '2023-08-07 23:58:18'),
	(829, 'horaires', '47', 'Creation', 3, NULL, '2023-08-07 23:58:29', '2023-08-07 23:58:29'),
	(830, 'horaires', '48', 'Creation', 3, NULL, '2023-08-07 23:58:30', '2023-08-07 23:58:30'),
	(831, 'horaires', '49', 'Creation', 3, NULL, '2023-08-07 23:58:32', '2023-08-07 23:58:32'),
	(832, 'horaires', '44', 'Modification', 3, NULL, '2023-08-07 23:58:50', '2023-08-07 23:58:50'),
	(833, 'horaires', '46', 'Modification', 3, NULL, '2023-08-07 23:58:51', '2023-08-07 23:58:51'),
	(834, 'horaires', '50', 'Creation', 3, NULL, '2023-08-08 00:05:03', '2023-08-08 00:05:03'),
	(835, 'horaires', '51', 'Creation', 3, NULL, '2023-08-08 00:05:05', '2023-08-08 00:05:05'),
	(836, 'horaires', '52', 'Creation', 3, NULL, '2023-08-08 00:05:08', '2023-08-08 00:05:08'),
	(837, 'horaires', '53', 'Creation', 3, NULL, '2023-08-08 00:05:09', '2023-08-08 00:05:09'),
	(838, 'horaires', '54', 'Creation', 3, NULL, '2023-08-08 00:05:11', '2023-08-08 00:05:11'),
	(839, 'horaires', '55', 'Creation', 3, NULL, '2023-08-08 00:05:13', '2023-08-08 00:05:13'),
	(840, 'horaires', '56', 'Creation', 3, NULL, '2023-08-08 00:05:14', '2023-08-08 00:05:14'),
	(841, 'horaires', '57', 'Creation', 3, NULL, '2023-08-08 00:05:16', '2023-08-08 00:05:16'),
	(842, 'horaires', '58', 'Creation', 3, NULL, '2023-08-08 00:05:18', '2023-08-08 00:05:18'),
	(843, 'horaires', '59', 'Creation', 3, NULL, '2023-08-08 00:05:19', '2023-08-08 00:05:19'),
	(844, 'horaires', '60', 'Creation', 3, NULL, '2023-08-08 00:05:21', '2023-08-08 00:05:21'),
	(845, 'horaires', '44', 'Modification', 3, NULL, '2023-08-09 01:53:10', '2023-08-09 01:53:10'),
	(846, 'horaires', '44', 'Modification', 3, NULL, '2023-08-09 01:53:53', '2023-08-09 01:53:53'),
	(847, 'horaires', '46', 'Modification', 3, NULL, '2023-08-09 01:53:57', '2023-08-09 01:53:57'),
	(848, 'horaires', '61', 'Creation', 3, NULL, '2023-08-09 01:54:03', '2023-08-09 01:54:03'),
	(849, 'horaires', '62', 'Creation', 3, NULL, '2023-08-09 01:54:06', '2023-08-09 01:54:06'),
	(850, 'horaires', '63', 'Creation', 3, NULL, '2023-08-09 01:54:08', '2023-08-09 01:54:08'),
	(851, 'articles', '5', 'Creation', 5, NULL, '2023-08-14 09:43:07', '2023-08-14 09:43:07'),
	(852, 'articles', '6', 'Creation', 5, NULL, '2023-08-14 09:45:04', '2023-08-14 09:45:04'),
	(853, 'entree_articles', '2', 'Creation', 5, NULL, '2023-08-14 21:42:23', '2023-08-14 21:42:23'),
	(854, 'sortie_articles', '1', 'Creation', 5, NULL, '2023-08-14 21:53:26', '2023-08-14 21:53:26'),
	(855, 'sortie_articles', '2', 'Creation', 5, NULL, '2023-08-15 09:23:22', '2023-08-15 09:23:22'),
	(856, 'articles', '7', 'Creation', 5, NULL, '2023-08-15 09:26:57', '2023-08-15 09:26:57'),
	(857, 'entree_articles', '3', 'Creation', 5, NULL, '2023-08-15 09:27:43', '2023-08-15 09:27:43'),
	(858, 'categorie_articles', '2', 'Creation', 5, NULL, '2023-08-15 11:31:47', '2023-08-15 11:31:47'),
	(859, 'articles', '8', 'Creation', 5, NULL, '2023-08-15 11:58:33', '2023-08-15 11:58:33'),
	(860, 'articles', '9', 'Creation', 5, NULL, '2023-08-15 12:00:26', '2023-08-15 12:00:26'),
	(861, 'entree_articles', '4', 'Creation', 5, NULL, '2023-08-15 12:00:59', '2023-08-15 12:00:59'),
	(862, 'articles', '9', 'Modification', 5, NULL, '2023-08-15 12:30:33', '2023-08-15 12:30:33'),
	(863, 'mode_paiements', '4', 'Creation', 5, NULL, '2023-08-15 12:44:20', '2023-08-15 12:44:20'),
	(864, 'type_frais', '3', 'Creation', 5, NULL, '2023-08-15 13:08:52', '2023-08-15 13:08:52'),
	(865, 'frais', '29', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(866, 'frais', '30', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(867, 'frais', '31', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(868, 'frais', '32', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(869, 'frais', '33', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(870, 'frais', '34', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(871, 'frais', '35', 'Creation', 5, NULL, '2023-08-15 13:13:17', '2023-08-15 13:13:17'),
	(872, 'frais', '36', 'Creation', 5, NULL, '2023-08-15 13:13:18', '2023-08-15 13:13:18'),
	(873, 'frais', '37', 'Creation', 5, NULL, '2023-08-15 13:13:18', '2023-08-15 13:13:18'),
	(874, 'entree_articles', '5', 'Creation', 5, NULL, '2023-08-15 16:04:14', '2023-08-15 16:04:14'),
	(875, 'paiement_frais', '15', 'Creation', 9, NULL, '2023-08-15 16:27:25', '2023-08-15 16:27:25'),
	(876, 'messages', '20', 'Creation', 5, NULL, '2023-08-15 16:47:11', '2023-08-15 16:47:11'),
	(877, 'messages', '21', 'Creation', 5, NULL, '2023-08-15 16:47:11', '2023-08-15 16:47:11'),
	(878, 'messages', '22', 'Creation', 5, NULL, '2023-08-15 16:47:11', '2023-08-15 16:47:11'),
	(879, 'messages', '23', 'Creation', 5, NULL, '2023-08-15 16:47:11', '2023-08-15 16:47:11'),
	(880, 'messages', '24', 'Creation', 8, NULL, '2023-08-15 16:48:11', '2023-08-15 16:48:11'),
	(881, 'fonctions', '12', 'Creation', 5, NULL, '2023-08-15 16:52:44', '2023-08-15 16:52:44'),
	(882, 'horaires', '64', 'Creation', 5, NULL, '2023-08-16 13:48:57', '2023-08-16 13:48:57'),
	(883, 'horaires', '65', 'Creation', 5, NULL, '2023-08-16 13:48:58', '2023-08-16 13:48:58'),
	(884, 'horaires', '66', 'Creation', 5, NULL, '2023-08-16 13:49:01', '2023-08-16 13:49:01'),
	(885, 'horaires', '67', 'Creation', 5, NULL, '2023-08-16 13:49:02', '2023-08-16 13:49:02'),
	(886, 'horaires', '68', 'Creation', 5, NULL, '2023-08-16 13:49:04', '2023-08-16 13:49:04'),
	(887, 'horaires', '69', 'Creation', 5, NULL, '2023-08-16 13:49:06', '2023-08-16 13:49:06'),
	(888, 'horaires', '70', 'Creation', 5, NULL, '2023-08-16 13:49:07', '2023-08-16 13:49:07'),
	(889, 'horaires', '71', 'Creation', 5, NULL, '2023-08-16 13:49:09', '2023-08-16 13:49:09'),
	(890, 'horaires', '72', 'Creation', 5, NULL, '2023-08-16 13:49:10', '2023-08-16 13:49:10'),
	(891, 'horaires', '73', 'Creation', 5, NULL, '2023-08-16 13:49:11', '2023-08-16 13:49:11'),
	(892, 'horaires', '74', 'Creation', 5, NULL, '2023-08-16 13:49:12', '2023-08-16 13:49:12'),
	(893, 'horaires', '75', 'Creation', 5, NULL, '2023-08-16 13:49:13', '2023-08-16 13:49:13'),
	(894, 'horaires', '76', 'Creation', 5, NULL, '2023-08-16 13:49:14', '2023-08-16 13:49:14'),
	(895, 'horaires', '77', 'Creation', 5, NULL, '2023-08-16 13:49:16', '2023-08-16 13:49:16'),
	(896, 'horaires', '78', 'Creation', 5, NULL, '2023-08-16 13:49:17', '2023-08-16 13:49:17'),
	(897, 'horaires', '79', 'Creation', 5, NULL, '2023-08-16 13:49:18', '2023-08-16 13:49:18'),
	(898, 'horaires', '80', 'Creation', 5, NULL, '2023-08-16 13:49:19', '2023-08-16 13:49:19'),
	(899, 'horaires', '81', 'Creation', 5, NULL, '2023-08-16 13:49:20', '2023-08-16 13:49:20'),
	(900, 'horaires', '82', 'Creation', 5, NULL, '2023-08-16 13:49:22', '2023-08-16 13:49:22'),
	(901, 'horaires', '83', 'Creation', 5, NULL, '2023-08-16 13:49:22', '2023-08-16 13:49:22'),
	(902, 'horaires', '84', 'Creation', 5, NULL, '2023-08-16 13:49:23', '2023-08-16 13:49:23'),
	(907, 'presences', '5', 'Creation', 3, NULL, '2023-08-17 17:54:37', '2023-08-17 17:54:37'),
	(908, 'presences', '6', 'Creation', 3, NULL, '2023-08-17 18:01:04', '2023-08-17 18:01:04'),
	(909, 'presences', '7', 'Creation', 3, NULL, '2023-08-17 18:01:06', '2023-08-17 18:01:06'),
	(910, 'presences', '8', 'Creation', 3, NULL, '2023-08-17 18:01:11', '2023-08-17 18:01:11'),
	(911, 'presences', '9', 'Creation', 3, NULL, '2023-08-17 18:01:17', '2023-08-17 18:01:17'),
	(912, 'presences', '10', 'Creation', 3, NULL, '2023-08-17 18:01:19', '2023-08-17 18:01:19'),
	(913, 'presences', '11', 'Creation', 3, NULL, '2023-08-17 18:01:21', '2023-08-17 18:01:21'),
	(914, 'presences', '12', 'Creation', 3, NULL, '2023-08-17 18:01:26', '2023-08-17 18:01:26'),
	(915, 'presences', '13', 'Creation', 3, NULL, '2023-08-17 18:01:29', '2023-08-17 18:01:29'),
	(916, 'presences', '14', 'Creation', 3, NULL, '2023-08-17 18:01:33', '2023-08-17 18:01:33'),
	(917, 'presences', '15', 'Creation', 3, NULL, '2023-08-17 18:01:35', '2023-08-17 18:01:35'),
	(918, 'presences', '16', 'Creation', 3, NULL, '2023-08-17 18:01:37', '2023-08-17 18:01:37'),
	(919, 'presences', '17', 'Creation', 3, NULL, '2023-08-17 18:01:40', '2023-08-17 18:01:40'),
	(920, 'presences', '18', 'Creation', 3, NULL, '2023-08-17 18:01:42', '2023-08-17 18:01:42'),
	(921, 'presences', '19', 'Creation', 3, NULL, '2023-08-17 18:01:44', '2023-08-17 18:01:44'),
	(922, 'presences', '20', 'Creation', 3, NULL, '2023-08-17 18:01:48', '2023-08-17 18:01:48');
/*!40000 ALTER TABLE `logfiles` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expediteur` bigint(20) unsigned NOT NULL,
  `destinateur` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_expediteur_foreign` (`expediteur`),
  KEY `messages_destinateur_foreign` (`destinateur`),
  CONSTRAINT `messages_destinateur_foreign` FOREIGN KEY (`destinateur`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_expediteur_foreign` FOREIGN KEY (`expediteur`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.messages: ~22 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `objet`, `contenu`, `expediteur`, `destinateur`, `created_at`, `updated_at`, `read_at`, `deleted_at`) VALUES
	(3, 'Test Message', 'Dui velit libero semper lobortis ante, felis accumsan mi proin, aliquet donec phasellus sem. Malesuada primis nunc hac arcu nam suspendisse per, consequat pulvinar habitasse sociosqu eu posuere tellus id, curae donec sed lacinia tempus lobortis.', 5, 8, '2023-04-16 21:26:34', '2023-04-17 09:44:39', '2023-04-17 09:44:39', NULL),
	(4, 'Test Message', 'Dui velit libero semper lobortis ante, felis accumsan mi proin, aliquet donec phasellus sem. Malesuada primis nunc hac arcu nam suspendisse per, consequat pulvinar habitasse sociosqu eu posuere tellus id, curae donec sed lacinia tempus lobortis.', 5, 10, '2023-04-16 21:26:34', '2023-04-16 21:26:34', NULL, NULL),
	(5, 'Communication Test', 'Lorem ipsum dolor sit amet consectetur adipiscing elit lectus neque dignissim aenean, ultricies magnis tincidunt dictum class tortor sociis senectus congue cum potenti, sollicitudin arcu vel ornare tempor et imperdiet nulla at erat. Porttitor pulvinar mol', 8, 5, '2023-04-16 21:42:38', '2023-06-29 18:46:43', '2023-06-29 18:46:43', NULL),
	(6, 'Tuna sema', '<span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Messages</span>\r\n                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">10</span>', 5, 8, '2023-04-16 22:16:35', '2023-05-01 15:29:00', '2023-05-01 15:29:00', NULL),
	(7, 'Tuna sema', '<span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Messages</span>\r\n                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">10</span>', 5, 10, '2023-04-16 22:16:35', '2023-04-16 22:16:35', NULL, NULL),
	(8, 'Paiement Frais Scolaires', 'Bytes\r\nLists\r\nRich TextHTML\r\nCopy\r\nLorem ipsum dolor sit amet consectetur adipiscing elit netus semper ultricies quisque, eu eros himenaeos odio nullam vel praesent pharetra ante malesuada penatibus, accumsan elementum hac dis arcu platea nec quam aptent ', 5, 8, '2023-04-17 09:43:31', '2023-05-01 15:28:57', '2023-05-01 15:28:57', NULL),
	(9, 'Paiement Frais Scolaires', 'Bytes\r\nLists\r\nRich TextHTML\r\nCopy\r\nLorem ipsum dolor sit amet consectetur adipiscing elit netus semper ultricies quisque, eu eros himenaeos odio nullam vel praesent pharetra ante malesuada penatibus, accumsan elementum hac dis arcu platea nec quam aptent ', 5, 10, '2023-04-17 09:43:32', '2023-04-17 09:43:32', NULL, NULL),
	(10, 'Demande De Derogation', 'sagittis. Massa rhoncus sed risus primis fames non parturient, molestie scelerisque nullam nibh feugiat convallis, dictum interdum proin malesuada suspendisse sagittis. Ullamcorper', 8, 5, '2023-04-17 11:22:15', '2023-07-19 09:11:59', '2023-07-19 09:11:59', NULL),
	(11, 'Test Up Dates', 'Proin imperdiet tortor ad ridiculus maecenas lacus vehicula montes, venenatis curabitur urna aliquam rhoncus in sociis, condimentum pellentesque primis volutpat dictum dignissim eleifend. Cum sodales hac interdum cursus condimentum pretium risus parturien', 5, 8, '2023-06-02 01:34:02', '2023-06-02 23:02:11', '2023-06-02 23:02:11', NULL),
	(12, 'TEst 200k', 'Nousommes lA', 8, 5, '2023-06-02 23:02:08', '2023-07-19 09:11:55', '2023-07-19 09:11:55', NULL),
	(13, 'retard', 'Lorem ipsum dolor sit amet consectetur adipiscing elit et etiam, cum mollis diam fringilla ante bibendum interdum duis, netus enim luctus convallis sem mattis aliquet habitant. Nascetur senectus rutrum taciti sollicitudin sed aenean ac fusce litora vitae ', 5, 14, '2023-06-05 13:25:37', '2023-06-05 13:25:37', NULL, NULL),
	(14, 'Reponde A votre Messsage du 12121212', 'Ad justo nam cum natoque montes luctus ultrices cursus, mi ultricies praesent proin fusce sem sapien platea, faucibus etiam vel aenean sollicitudin varius convallis. Justo parturient aliquam vel libero sociosqu dictumst dis nullam, nunc facilisis aenean f', 5, 8, '2023-06-29 19:00:46', '2023-06-29 19:01:27', '2023-06-29 19:01:27', NULL),
	(15, 'Communication du 30 Juillet', 'Ullamcorper ante scelerisque nam tempus montes congue iaculis nunc facilisi metus placerat, netus phasellus urna odio consequat ligula hac orci turpis suspendisse cras, faucibus auctor habitant dictum magna mus at non malesuada cursus. Euismod potenti cub', 5, 8, '2023-07-07 23:16:59', '2023-07-14 14:37:48', '2023-07-14 14:37:48', NULL),
	(16, 'Communication du 30 Juillet', 'Ullamcorper ante scelerisque nam tempus montes congue iaculis nunc facilisi metus placerat, netus phasellus urna odio consequat ligula hac orci turpis suspendisse cras, faucibus auctor habitant dictum magna mus at non malesuada cursus. Euismod potenti cub', 5, 10, '2023-07-07 23:16:59', '2023-07-07 23:16:59', NULL, NULL),
	(17, 'Communication du 30 Juillet', 'Ullamcorper ante scelerisque nam tempus montes congue iaculis nunc facilisi metus placerat, netus phasellus urna odio consequat ligula hac orci turpis suspendisse cras, faucibus auctor habitant dictum magna mus at non malesuada cursus. Euismod potenti cub', 5, 14, '2023-07-07 23:16:59', '2023-07-07 23:16:59', NULL, NULL),
	(18, 'Communication du 30 Juillet', 'Ullamcorper ante scelerisque nam tempus montes congue iaculis nunc facilisi metus placerat, netus phasellus urna odio consequat ligula hac orci turpis suspendisse cras, faucibus auctor habitant dictum magna mus at non malesuada cursus. Euismod potenti cub', 5, 16, '2023-07-07 23:16:59', '2023-07-07 23:16:59', NULL, NULL),
	(19, 'Communication', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, tortor non commodo sagittis pellentesque habitant ad porta, massa pulvinar et purus vehicula tincidunt. Fermentum lacinia diam nulla ante sapien nullam tempus, senectus phasellus arcu ultrices turpis', 5, 16, '2023-07-08 08:19:23', '2023-07-08 08:19:23', NULL, NULL),
	(20, 'Communication Test', 'Lorem ipsum dolor sit amet consectetur adipiscing elit velit, id sociosqu facilisi metus tristique venenatis pharetra convallis, euismod lacinia eros cubilia in vestibulum arcu, duis elementum fermentum class sollicitudin placerat mauris. Tempus facilisi sem orci morbi hac euismod eros erat conubia, himenaeos odio quam suspendisse mi natoque mattis. Semper habitant praesent sodales tincidunt sociis bibendum dapibus, diam suspendisse himenaeos nam augue fermentum aenean, malesuada erat eget cum velit nisl. Class non eu nostra ridiculus sem mollis auctor cursus, ultrices ante pulvinar ultricies litora conubia nunc tempus porttitor, orci primis hac morbi bibendum ornare eros. Tristique quisque hac felis torquent tortor mollis, class vel libero lectus pretium massa facilisi, rutrum urna dui vitae ridiculus.', 5, 8, '2023-08-15 16:47:11', '2023-08-15 16:47:35', '2023-08-15 16:47:35', NULL),
	(21, 'Communication Test', 'Lorem ipsum dolor sit amet consectetur adipiscing elit velit, id sociosqu facilisi metus tristique venenatis pharetra convallis, euismod lacinia eros cubilia in vestibulum arcu, duis elementum fermentum class sollicitudin placerat mauris. Tempus facilisi sem orci morbi hac euismod eros erat conubia, himenaeos odio quam suspendisse mi natoque mattis. Semper habitant praesent sodales tincidunt sociis bibendum dapibus, diam suspendisse himenaeos nam augue fermentum aenean, malesuada erat eget cum velit nisl. Class non eu nostra ridiculus sem mollis auctor cursus, ultrices ante pulvinar ultricies litora conubia nunc tempus porttitor, orci primis hac morbi bibendum ornare eros. Tristique quisque hac felis torquent tortor mollis, class vel libero lectus pretium massa facilisi, rutrum urna dui vitae ridiculus.', 5, 10, '2023-08-15 16:47:11', '2023-08-15 16:47:11', NULL, NULL),
	(22, 'Communication Test', 'Lorem ipsum dolor sit amet consectetur adipiscing elit velit, id sociosqu facilisi metus tristique venenatis pharetra convallis, euismod lacinia eros cubilia in vestibulum arcu, duis elementum fermentum class sollicitudin placerat mauris. Tempus facilisi sem orci morbi hac euismod eros erat conubia, himenaeos odio quam suspendisse mi natoque mattis. Semper habitant praesent sodales tincidunt sociis bibendum dapibus, diam suspendisse himenaeos nam augue fermentum aenean, malesuada erat eget cum velit nisl. Class non eu nostra ridiculus sem mollis auctor cursus, ultrices ante pulvinar ultricies litora conubia nunc tempus porttitor, orci primis hac morbi bibendum ornare eros. Tristique quisque hac felis torquent tortor mollis, class vel libero lectus pretium massa facilisi, rutrum urna dui vitae ridiculus.', 5, 14, '2023-08-15 16:47:11', '2023-08-15 16:47:11', NULL, NULL),
	(23, 'Communication Test', 'Lorem ipsum dolor sit amet consectetur adipiscing elit velit, id sociosqu facilisi metus tristique venenatis pharetra convallis, euismod lacinia eros cubilia in vestibulum arcu, duis elementum fermentum class sollicitudin placerat mauris. Tempus facilisi sem orci morbi hac euismod eros erat conubia, himenaeos odio quam suspendisse mi natoque mattis. Semper habitant praesent sodales tincidunt sociis bibendum dapibus, diam suspendisse himenaeos nam augue fermentum aenean, malesuada erat eget cum velit nisl. Class non eu nostra ridiculus sem mollis auctor cursus, ultrices ante pulvinar ultricies litora conubia nunc tempus porttitor, orci primis hac morbi bibendum ornare eros. Tristique quisque hac felis torquent tortor mollis, class vel libero lectus pretium massa facilisi, rutrum urna dui vitae ridiculus.', 5, 16, '2023-08-15 16:47:11', '2023-08-15 16:47:11', NULL, NULL),
	(24, 'reponse', 'byamdbbjdjddjdjd', 8, 5, '2023-08-15 16:48:11', '2023-08-15 16:48:31', '2023-08-15 16:48:31', NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.migrations: ~66 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2013_08_23_182726_create_fonctions_table', 1),
	(2, '2013_08_23_183016_create_employers_table', 1),
	(3, '2013_08_23_185610_create_employer_fonction', 1),
	(4, '2014_10_12_000000_create_users_table', 1),
	(5, '2014_10_12_100000_create_password_resets_table', 1),
	(6, '2019_08_19_000000_create_failed_jobs_table', 1),
	(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(8, '2022_08_23_191112_create_table_niveau', 1),
	(9, '2022_08_23_191212_create_classes_table', 1),
	(10, '2022_08_23_191630_create_categorie_cours_table', 1),
	(11, '2022_08_23_191720_create_cours_table', 1),
	(12, '2022_08_23_194802_create_annee_scolaires_table', 1),
	(13, '2022_08_23_194907_create_eleves_table', 1),
	(14, '2022_08_23_195235_create_frequentations_table', 1),
	(15, '2022_08_23_200306_create_trimestres_table', 1),
	(16, '2022_08_23_200340_create_periodes_table', 1),
	(17, '2022_08_23_200341_create_type_evaluations_table', 1),
	(18, '2022_08_23_201355_create_evaluations_table', 1),
	(19, '2022_08_23_201737_create_table_eleve_evaluation', 1),
	(20, '2022_08_23_203051_create_examens_table', 1),
	(21, '2022_08_23_203528_create_table_eleve_examen', 1),
	(22, '2022_08_24_111435_add_column_matricule_on_employer', 1),
	(23, '2022_08_27_023021_add_softdelete_to_table_fonctions', 1),
	(24, '2022_08_27_030641_add_softdelete_to_table_fonctions', 1),
	(25, '2022_08_28_212124_add_softdeletes_to_table_eleves', 1),
	(26, '2022_08_29_015735_add_softdeletes_to_frequentations', 1),
	(27, '2022_08_29_214601_add_softdeletes_to_classe', 1),
	(28, '2022_08_29_214742_add_softdeletes_to_annee_scolaire', 1),
	(29, '2022_08_29_214848_add_softdeletes_to_trimestres', 1),
	(30, '2022_08_29_214922_add_softdeletes_to_periodes', 1),
	(31, '2022_08_29_214953_add_softdeletes_to_evaluations', 1),
	(32, '2022_08_29_215017_add_softdeletes_to_type_evaluations', 1),
	(33, '2022_08_29_215039_add_softdeletes_to_examens', 1),
	(34, '2022_08_29_215105_add_softdeletes_to_categorie_cours', 1),
	(35, '2022_08_29_215127_add_softdeletes_to_cours', 1),
	(36, '2022_08_29_215146_add_softdeletes_to_eleve_evaluation', 1),
	(37, '2022_08_29_215211_add_softdeletes_to_eleve_examen', 1),
	(38, '2022_11_23_230530_add_soft_deletes_on_table_user', 1),
	(39, '2023_04_01_122818_create_table_encadrement', 1),
	(40, '2023_04_07_154345_create_table_conduites', 1),
	(41, '2023_04_07_155226_create_table_eleve_conduite', 1),
	(42, '2023_04_10_134823_create_parent_table', 1),
	(43, '2023_04_11_074121_add_parrain_to_eleves', 1),
	(44, '2023_04_12_095545_add_id_parrain_to_user', 1),
	(45, '2023_04_16_141937_create_resultats_table', 1),
	(46, '2023_04_16_143659_create_type_frais_table', 1),
	(47, '2023_04_16_143741_create_mode_paiements_tables', 1),
	(48, '2023_04_16_143755_create_frais_table', 1),
	(49, '2023_04_16_143817_create_moyen_paiements_table', 1),
	(50, '2023_04_16_143909_create_paiement_frais_table', 1),
	(51, '2023_04_16_143945_create_messages_table', 1),
	(52, '2023_04_18_120110_add_date_id_to_paiements', 1),
	(53, '2023_04_18_133329_add_frequentation_id_to_paiements', 1),
	(54, '2023_05_22_012447_add_decisiom_on_resultats', 1),
	(55, '2023_06_28_225525_create_log_files_table', 1),
	(56, '2023_08_03_114945_create_jours_table', 1),
	(57, '2023_08_03_115031_add_heures_table', 1),
	(58, '2023_08_03_115222_create_horaires_table', 1),
	(59, '2023_08_04_164918_add_is_recreation_to_horaires', 1),
	(60, '2023_08_12_140926_create_categorie_articles_table', 2),
	(61, '2023_08_12_141116_create_unite_articles_table', 2),
	(62, '2023_08_12_141153_create_articles_table', 2),
	(63, '2023_08_12_141247_create_sortie_articles_table', 2),
	(67, '2023_08_12_141321_create_entree_articles_table', 3),
	(68, '2023_08_12_142338_create_type_presences_table', 4),
	(69, '2023_08_12_142401_create_presences_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.mode_paiements
CREATE TABLE IF NOT EXISTS `mode_paiements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.mode_paiements: ~4 rows (approximately)
/*!40000 ALTER TABLE `mode_paiements` DISABLE KEYS */;
INSERT INTO `mode_paiements` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'ANNUEL', '2023-04-16 15:47:28', '2023-04-16 15:47:29', NULL),
	(2, 'TRIMESTRIEL', '2023-04-16 15:47:38', '2023-04-16 15:47:39', NULL),
	(3, 'MENSUEL', NULL, NULL, NULL),
	(4, 'Journalier', '2023-08-15 12:44:20', '2023-08-15 12:44:20', NULL);
/*!40000 ALTER TABLE `mode_paiements` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.moyen_paiements
CREATE TABLE IF NOT EXISTS `moyen_paiements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `references` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.moyen_paiements: ~2 rows (approximately)
/*!40000 ALTER TABLE `moyen_paiements` DISABLE KEYS */;
INSERT INTO `moyen_paiements` (`id`, `nom`, `references`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'CAISSE', '', '2023-04-16 15:38:01', '2023-04-16 15:38:01', NULL),
	(2, 'BANQUE', '', '2023-04-16 15:38:42', '2023-04-16 15:38:43', NULL);
/*!40000 ALTER TABLE `moyen_paiements` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.niveaux
CREATE TABLE IF NOT EXISTS `niveaux` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.niveaux: ~9 rows (approximately)
/*!40000 ALTER TABLE `niveaux` DISABLE KEYS */;
INSERT INTO `niveaux` (`id`, `nom`, `numerotation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIERE ANNEE MATERNELLE', 1, '2023-04-01 12:46:08', '2023-04-01 12:46:09', NULL),
	(2, 'DEUXIEME ANNEE MATERNELLE', 2, '2023-04-01 12:46:26', '2023-04-01 12:46:27', NULL),
	(3, 'TROISIEME ANNEE MATERNELLE', 3, '2023-04-01 12:46:48', '2023-04-01 12:46:48', NULL),
	(4, 'PREMIERE ANNEE PRIMAIRE', 1, '2023-04-01 12:47:07', '2023-04-01 12:47:08', NULL),
	(5, 'DEUXIEME ANNEE PRIMAIRE', 2, '2023-04-01 12:47:27', '2023-04-01 12:47:28', NULL),
	(6, 'TROISIEME ANNEE PRIMAIRE', 3, '2023-04-01 13:16:44', '2023-04-01 13:16:44', NULL),
	(7, 'QUATRIEME ANNEE PRIMAIRE', 4, '2023-04-01 13:17:04', '2023-04-01 13:17:05', NULL),
	(8, 'CINQUIME ANNEE PRIMAIRE', 5, '2023-04-01 13:17:20', '2023-04-01 13:17:21', NULL),
	(9, 'SIXIEMEN ANNEE PRIMAIRE', 6, '2023-04-01 13:17:31', '2023-04-01 13:17:31', NULL);
/*!40000 ALTER TABLE `niveaux` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.paiement_frais
CREATE TABLE IF NOT EXISTS `paiement_frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `montant_paye` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `frequentation_id` bigint(20) unsigned DEFAULT NULL,
  `frais_id` bigint(20) unsigned DEFAULT NULL,
  `eleve_id` bigint(20) unsigned DEFAULT NULL,
  `moyen_paiement_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiement_frais_frais_id_foreign` (`frais_id`),
  KEY `paiement_frais_eleve_id_foreign` (`eleve_id`),
  KEY `paiement_frais_moyen_paiement_id_foreign` (`moyen_paiement_id`),
  KEY `paiement_frais_frequentation_id_foreign` (`frequentation_id`),
  CONSTRAINT `paiement_frais_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `paiement_frais_frais_id_foreign` FOREIGN KEY (`frais_id`) REFERENCES `frais` (`id`),
  CONSTRAINT `paiement_frais_frequentation_id_foreign` FOREIGN KEY (`frequentation_id`) REFERENCES `frequentations` (`id`),
  CONSTRAINT `paiement_frais_moyen_paiement_id_foreign` FOREIGN KEY (`moyen_paiement_id`) REFERENCES `moyen_paiements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.paiement_frais: ~12 rows (approximately)
/*!40000 ALTER TABLE `paiement_frais` DISABLE KEYS */;
INSERT INTO `paiement_frais` (`id`, `montant_paye`, `reference`, `date`, `frequentation_id`, `frais_id`, `eleve_id`, `moyen_paiement_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(4, 150, 'ref : 120201', '2023-04-18', 18, 6, NULL, 2, '2023-04-18 11:35:14', '2023-04-18 11:35:15', NULL),
	(5, 5000, 'ref : 120201', '2023-04-19', 18, 15, NULL, 1, '2023-04-18 22:17:30', '2023-04-18 22:17:30', NULL),
	(6, 80, 'ref : 1202058', '2023-04-19', 18, 6, NULL, 2, '2023-04-18 23:44:52', '2023-04-18 23:44:52', NULL),
	(7, 4000, '00', '2023-04-19', 18, 15, NULL, 1, '2023-04-18 23:45:25', '2023-04-18 23:45:25', NULL),
	(8, 1000, '237 Bank du congo', '2023-04-07', 18, 15, NULL, 2, '2023-05-07 14:32:06', '2023-05-07 14:32:06', NULL),
	(9, 10, '', '2021-09-02', 18, 24, NULL, 1, '2023-06-14 08:38:43', '2023-06-14 08:38:43', NULL),
	(10, 10, '', '2023-06-15', 21, 24, NULL, 1, '2023-06-15 14:04:22', '2023-06-15 14:04:22', NULL),
	(11, 10, '', '2022-09-09', 13, 24, NULL, 1, '2023-06-29 17:57:55', '2023-06-29 17:57:55', NULL),
	(12, 200, '', '2023-01-29', 13, 6, NULL, 1, '2023-06-29 18:00:13', '2023-06-29 18:00:13', NULL),
	(13, 40, '', '2023-03-15', 13, 6, NULL, 1, '2023-06-29 18:09:57', '2023-06-29 18:09:57', NULL),
	(14, 10, '', '2023-07-15', 41, 26, NULL, 1, '2023-07-07 23:40:39', '2023-07-07 23:40:39', NULL),
	(15, 6, 'liuytr4', '2023-08-16', 40, 10, NULL, 2, '2023-08-15 16:27:25', '2023-08-15 16:27:25', NULL);
/*!40000 ALTER TABLE `paiement_frais` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.parrains
CREATE TABLE IF NOT EXISTS `parrains` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.parrains: ~4 rows (approximately)
/*!40000 ALTER TABLE `parrains` DISABLE KEYS */;
INSERT INTO `parrains` (`id`, `nom`, `prenom`, `sexe`, `telephone`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'Mulindi Kabanga', 'Jean Bavon', 'M', '+243971355590', '2023-04-12 08:36:45', '2023-06-01 12:09:49', NULL),
	(4, 'masumbuko muderhwa', 'jean mado', 'M', '+243971355590', '2023-04-13 12:38:00', '2023-06-01 12:03:47', NULL),
	(5, 'lucien', 'assumani', 'M', '+25762427572', '2023-06-05 13:22:28', '2023-06-05 13:22:28', NULL),
	(6, 'Molisho', 'Molisho', 'M', '+243123456789', '2023-06-27 10:17:41', '2023-06-30 07:55:47', NULL);
/*!40000 ALTER TABLE `parrains` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.periodes
CREATE TABLE IF NOT EXISTS `periodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `trimestre_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periodes_trimestre_id_foreign` (`trimestre_id`),
  CONSTRAINT `periodes_trimestre_id_foreign` FOREIGN KEY (`trimestre_id`) REFERENCES `trimestres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.periodes: ~13 rows (approximately)
/*!40000 ALTER TABLE `periodes` DISABLE KEYS */;
INSERT INTO `periodes` (`id`, `nom`, `date_debut`, `date_fin`, `trimestre_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIERE PERIODE', '2022-09-02', '2022-10-20', 1, '2022-08-24 15:10:38', '2022-11-17 19:14:32', NULL),
	(2, 'DEUXIEME PERIODE', '2022-10-21', '2022-12-11', 1, '2022-08-24 15:10:37', '2022-11-17 20:12:17', NULL),
	(3, 'TROISIEME PERIODE', '2022-12-12', '2023-01-30', 2, '2022-08-24 15:11:07', '2022-11-17 19:19:29', NULL),
	(4, 'QUATRIEME PERIODE', '2023-01-31', '2023-03-21', 2, '2022-08-24 15:11:31', '2022-11-17 19:19:42', NULL),
	(5, 'CINQUIEME PERIODE', '2023-03-22', '2022-05-10', 3, '2022-08-24 15:11:49', '2022-11-17 19:21:47', NULL),
	(6, 'SIXIEME PERIODE', '2023-05-11', '2023-07-20', 3, '2022-08-24 15:12:04', '2022-11-17 19:22:25', NULL),
	(7, 'PREMIERE PERIODE', '2000-01-12', '2022-01-12', 7, '2022-08-30 03:30:41', '2022-11-17 20:21:21', '2022-11-17 20:21:21'),
	(8, 'PREMIERE PERIODE', '2021-09-02', '2021-10-20', 9, '2023-05-09 16:59:31', '2023-05-09 16:59:31', NULL),
	(9, 'DEUXIEME PERIODE', '2021-10-21', '2021-12-11', 9, '2023-05-09 17:00:01', '2023-05-09 17:00:01', NULL),
	(10, 'TROISIEME PERIODE', '2021-12-12', '2022-12-30', 10, '2023-05-09 17:00:57', '2023-05-09 17:05:08', NULL),
	(11, 'QUATRIEME PERIODE', '2022-01-31', '2022-03-21', 10, '2023-05-09 17:01:44', '2023-05-09 17:01:44', NULL),
	(12, 'CINQUIEME PERIODE', '2022-03-22', '2022-05-10', 11, '2023-05-09 17:02:13', '2023-05-09 17:02:39', NULL),
	(13, 'SIXIEME PERIODE', '2022-05-11', '2022-02-07', 11, '2023-05-09 17:15:32', '2023-05-09 17:15:32', NULL);
/*!40000 ALTER TABLE `periodes` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.presences
CREATE TABLE IF NOT EXISTS `presences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `frequentation_id` bigint(20) unsigned DEFAULT NULL,
  `type_presence_id` bigint(20) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `presences_frequentation_id_foreign` (`frequentation_id`),
  KEY `presences_type_presence_id_foreign` (`type_presence_id`),
  CONSTRAINT `presences_frequentation_id_foreign` FOREIGN KEY (`frequentation_id`) REFERENCES `frequentations` (`id`),
  CONSTRAINT `presences_type_presence_id_foreign` FOREIGN KEY (`type_presence_id`) REFERENCES `type_presences` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.presences: ~16 rows (approximately)
/*!40000 ALTER TABLE `presences` DISABLE KEYS */;
INSERT INTO `presences` (`id`, `frequentation_id`, `type_presence_id`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 8, 1, '2023-08-17', '2023-08-17 17:54:37', '2023-08-17 17:54:37', NULL),
	(6, 13, 1, '2023-08-17', '2023-08-17 18:01:04', '2023-08-17 18:01:04', NULL),
	(7, 15, 2, '2023-08-17', '2023-08-17 18:01:06', '2023-08-17 18:01:06', NULL),
	(8, 18, 3, '2023-08-17', '2023-08-17 18:01:10', '2023-08-17 18:01:11', NULL),
	(9, 5, 1, '2023-08-17', '2023-08-17 18:01:17', '2023-08-17 18:01:17', NULL),
	(10, 27, 2, '2023-08-17', '2023-08-17 18:01:19', '2023-08-17 18:01:19', NULL),
	(11, 21, 2, '2023-08-17', '2023-08-17 18:01:21', '2023-08-17 18:01:21', NULL),
	(12, 7, 1, '2023-08-17', '2023-08-17 18:01:25', '2023-08-17 18:01:26', NULL),
	(13, 9, 3, '2023-08-17', '2023-08-17 18:01:29', '2023-08-17 18:01:29', NULL),
	(14, 10, 2, '2023-08-17', '2023-08-17 18:01:33', '2023-08-17 18:01:33', NULL),
	(15, 3, 1, '2023-08-17', '2023-08-17 18:01:35', '2023-08-17 18:01:35', NULL),
	(16, 2, 1, '2023-08-17', '2023-08-17 18:01:37', '2023-08-17 18:01:37', NULL),
	(17, 23, 1, '2023-08-17', '2023-08-17 18:01:39', '2023-08-17 18:01:40', NULL),
	(18, 6, 1, '2023-08-17', '2023-08-17 18:01:42', '2023-08-17 18:01:42', NULL),
	(19, 14, 1, '2023-08-17', '2023-08-17 18:01:44', '2023-08-17 18:01:44', NULL),
	(20, 30, 3, '2023-08-17', '2023-08-17 18:01:47', '2023-08-17 18:01:47', NULL);
/*!40000 ALTER TABLE `presences` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.resultats
CREATE TABLE IF NOT EXISTS `resultats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode1` double(8,2) NOT NULL DEFAULT '0.00',
  `periode2` double(8,2) NOT NULL DEFAULT '0.00',
  `periode3` double(8,2) NOT NULL DEFAULT '0.00',
  `periode4` double(8,2) NOT NULL DEFAULT '0.00',
  `periode5` double(8,2) NOT NULL DEFAULT '0.00',
  `periode6` double(8,2) NOT NULL DEFAULT '0.00',
  `examen1` double(8,2) NOT NULL DEFAULT '0.00',
  `examen2` double(8,2) NOT NULL DEFAULT '0.00',
  `examen3` double(8,2) NOT NULL DEFAULT '0.00',
  `trimestre1` double(8,2) NOT NULL DEFAULT '0.00',
  `trimestre2` double(8,2) NOT NULL DEFAULT '0.00',
  `trimestre3` double(8,2) NOT NULL DEFAULT '0.00',
  `annee` double(8,2) NOT NULL DEFAULT '0.00',
  `decision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequentation_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resultats_frequentation_id_foreign` (`frequentation_id`),
  CONSTRAINT `resultats_frequentation_id_foreign` FOREIGN KEY (`frequentation_id`) REFERENCES `frequentations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.resultats: ~36 rows (approximately)
/*!40000 ALTER TABLE `resultats` DISABLE KEYS */;
INSERT INTO `resultats` (`id`, `periode1`, `periode2`, `periode3`, `periode4`, `periode5`, `periode6`, `examen1`, `examen2`, `examen3`, `trimestre1`, `trimestre2`, `trimestre3`, `annee`, `decision`, `frequentation_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 0.00, 0.00, 37.20, 60.00, 61.90, 39.80, 0.00, 55.00, 53.50, 0.00, 51.80, 52.20, 53.80, 'double', 18, '2023-04-27 20:31:23', '2023-08-03 11:27:33', NULL),
	(2, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 32, '2023-05-02 10:15:02', '2023-05-02 10:15:02', NULL),
	(3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 31, '2023-05-02 10:15:02', '2023-05-02 10:15:02', NULL),
	(4, 0.00, 0.00, 0.00, 0.00, 0.00, 7.30, 0.00, 0.00, 0.00, 0.00, 0.00, 1.80, 0.60, NULL, 30, '2023-05-02 10:15:02', '2023-05-04 09:28:41', NULL),
	(5, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 29, '2023-05-02 10:15:02', '2023-05-02 10:15:02', NULL),
	(6, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 28, '2023-05-02 10:15:02', '2023-05-02 10:15:02', NULL),
	(7, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 27, '2023-05-02 10:15:02', '2023-05-02 10:15:02', NULL),
	(8, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 26, '2023-05-02 10:15:03', '2023-05-02 10:15:03', NULL),
	(9, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 25, '2023-05-02 10:15:03', '2023-05-02 10:15:03', NULL),
	(10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 24, '2023-05-02 10:15:03', '2023-05-02 10:15:03', NULL),
	(11, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 23, '2023-05-02 10:15:03', '2023-05-02 10:15:03', NULL),
	(12, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 1, '2023-05-02 13:49:08', '2023-05-02 13:49:08', NULL),
	(13, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 2, '2023-05-02 13:49:08', '2023-05-02 13:49:08', NULL),
	(14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 3, '2023-05-02 13:49:09', '2023-05-02 13:49:09', NULL),
	(15, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 4, '2023-05-02 13:49:09', '2023-05-02 13:49:09', NULL),
	(16, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 5, '2023-05-02 13:49:09', '2023-05-02 13:49:09', NULL),
	(17, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 6, '2023-05-02 13:49:09', '2023-05-02 13:49:09', NULL),
	(18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 7, '2023-05-02 13:49:09', '2023-05-02 13:49:09', NULL),
	(19, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 8, '2023-05-02 13:49:09', '2023-05-02 13:49:09', NULL),
	(20, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 9, '2023-05-02 13:49:09', '2023-05-02 13:49:10', NULL),
	(21, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 10, '2023-05-02 13:49:10', '2023-05-02 13:49:10', NULL),
	(22, 50.10, 60.00, 62.00, 41.50, 63.10, 57.90, 79.60, 80.40, 79.60, 67.30, 66.10, 70.10, 67.80, 'passe', 13, '2023-05-02 13:49:10', '2023-06-27 10:46:04', NULL),
	(23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 14, '2023-05-02 13:49:10', '2023-05-02 13:49:10', NULL),
	(24, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 15, '2023-05-02 13:49:10', '2023-05-02 13:49:10', NULL),
	(25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 19, '2023-05-02 13:49:10', '2023-05-02 13:49:10', NULL),
	(26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 20, '2023-05-02 13:49:10', '2023-05-02 13:49:10', NULL),
	(27, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 21, '2023-05-02 13:49:11', '2023-05-02 13:49:11', NULL),
	(28, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 22, '2023-05-02 13:49:11', '2023-05-02 13:49:11', NULL),
	(29, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 33, '2023-05-09 16:01:42', '2023-05-09 16:01:42', NULL),
	(30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 34, '2023-05-09 17:25:28', '2023-05-09 17:25:28', NULL),
	(31, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 35, '2023-06-05 13:18:21', '2023-06-05 13:18:21', NULL),
	(32, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 36, '2023-06-06 11:45:45', '2023-06-06 11:45:45', NULL),
	(35, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 39, '2023-07-02 22:50:29', '2023-07-02 22:50:29', NULL),
	(36, 65.00, 69.30, 62.50, 69.60, 73.20, 90.70, 74.50, 69.30, 82.50, 70.80, 67.70, 82.20, 73.60, 'passe', 40, '2023-07-06 22:22:08', '2023-07-07 21:55:38', NULL),
	(37, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 41, '2023-07-07 23:18:41', '2023-07-07 23:18:41', NULL),
	(38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 42, '2023-07-08 08:21:44', '2023-07-08 08:21:44', NULL);
/*!40000 ALTER TABLE `resultats` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.sortie_articles
CREATE TABLE IF NOT EXISTS `sortie_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) unsigned DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `designation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sortie_articles_article_id_foreign` (`article_id`),
  CONSTRAINT `sortie_articles_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.sortie_articles: ~2 rows (approximately)
/*!40000 ALTER TABLE `sortie_articles` DISABLE KEYS */;
INSERT INTO `sortie_articles` (`id`, `article_id`, `quantite`, `designation`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 6, 156, 'numerotation non conforme', '2023-08-14', '2023-08-14 21:53:26', '2023-08-14 21:53:26', NULL),
	(2, 6, 44, 'affectation bureau secretaire', '2023-08-15', '2023-08-15 09:23:22', '2023-08-15 09:23:22', NULL);
/*!40000 ALTER TABLE `sortie_articles` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.trimestres
CREATE TABLE IF NOT EXISTS `trimestres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `annee_scolaire_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trimestres_annee_scolaire_id_foreign` (`annee_scolaire_id`),
  CONSTRAINT `trimestres_annee_scolaire_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.trimestres: ~9 rows (approximately)
/*!40000 ALTER TABLE `trimestres` DISABLE KEYS */;
INSERT INTO `trimestres` (`id`, `nom`, `date_debut`, `date_fin`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIER TRIMESTRE', '2022-09-02', '2022-12-11', 1, '2022-08-24 15:07:52', '2022-11-19 10:30:21', NULL),
	(2, 'DEUXIEME TRIMESTRE', '2022-12-12', '2023-03-21', 1, '2022-08-24 15:08:24', '2022-11-19 10:30:27', NULL),
	(3, 'TROISIEME TRIMESTRE', '2023-03-22', '2023-07-02', 1, '2022-08-24 15:09:17', '2022-11-17 19:20:10', NULL),
	(7, 'PREMIER TRIMESTRE', '2023-01-15', '2024-04-14', 2, '2022-09-02 02:29:56', '2022-11-17 19:20:34', '2023-04-13 15:31:33'),
	(8, 'PREMIER TRIMESTRE', '2024-09-15', '2025-09-15', 3, '2022-09-15 14:03:24', '2022-11-19 11:05:07', NULL),
	(9, 'PREMIER TRIMESTRE', '2021-09-02', '2021-12-11', 4, '2023-05-09 16:45:23', '2023-05-09 16:45:23', NULL),
	(10, 'DEUXIEME TRIMESTRE', '2021-12-12', '2022-03-21', 4, '2023-05-09 16:45:55', '2023-05-09 16:45:55', NULL),
	(11, 'TROISIEME TRIMESTRE', '2022-03-22', '2022-07-02', 4, '2023-05-09 16:46:47', '2023-05-09 17:07:35', NULL),
	(12, 'PREMIER TRIMESTRE', '2023-06-08', '2023-06-07', 1, '2023-06-07 03:34:39', '2023-06-07 03:41:20', '2023-06-07 03:41:20');
/*!40000 ALTER TABLE `trimestres` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.type_evaluations
CREATE TABLE IF NOT EXISTS `type_evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.type_evaluations: ~3 rows (approximately)
/*!40000 ALTER TABLE `type_evaluations` DISABLE KEYS */;
INSERT INTO `type_evaluations` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Interrogation', '2022-08-31 11:07:05', '2022-08-31 11:07:06', NULL),
	(2, 'Devoir', '2022-08-31 11:07:13', '2022-08-31 11:07:14', NULL),
	(3, 'Rattrapage', '2022-09-01 04:31:57', '2022-09-01 04:31:57', '2023-05-22 14:58:54');
/*!40000 ALTER TABLE `type_evaluations` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.type_frais
CREATE TABLE IF NOT EXISTS `type_frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.type_frais: ~3 rows (approximately)
/*!40000 ALTER TABLE `type_frais` DISABLE KEYS */;
INSERT INTO `type_frais` (`id`, `nom`, `devise`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'FRAIS SCOLAIRES', 'USD', '2023-04-16 15:48:40', '2023-04-16 15:48:40', NULL),
	(2, 'FRAIS DIVERS', 'CDF', '2023-04-16 15:48:51', '2023-08-15 14:46:21', NULL),
	(3, 'Majengo', 'USD', '2023-08-15 13:08:52', '2023-08-15 13:08:52', NULL);
/*!40000 ALTER TABLE `type_frais` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.type_presences
CREATE TABLE IF NOT EXISTS `type_presences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.type_presences: ~3 rows (approximately)
/*!40000 ALTER TABLE `type_presences` DISABLE KEYS */;
INSERT INTO `type_presences` (`id`, `nom`, `abbreviation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PRESENT', 'P', '2023-08-15 19:54:18', '2023-08-15 19:54:18', NULL),
	(2, 'ABSCENT', 'A', '2023-08-15 19:54:28', '2023-08-15 19:54:28', NULL),
	(3, 'MALADE', 'M', '2023-08-15 19:56:02', '2023-08-15 19:56:02', NULL);
/*!40000 ALTER TABLE `type_presences` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.unite_articles
CREATE TABLE IF NOT EXISTS `unite_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.unite_articles: ~5 rows (approximately)
/*!40000 ALTER TABLE `unite_articles` DISABLE KEYS */;
INSERT INTO `unite_articles` (`id`, `nom`, `abbreviation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Pieces', 'pcs', '2023-08-12 17:55:19', '2023-08-12 17:55:19', NULL),
	(2, 'Metres', 'm', '2023-08-15 11:37:21', '2023-08-15 11:37:21', NULL),
	(3, 'Kilos', 'kg', '2023-08-15 11:37:36', '2023-08-15 11:37:37', NULL),
	(4, 'Grammes', 'g', '2023-08-15 11:37:47', '2023-08-15 11:37:47', NULL),
	(5, 'Boites', 'bts', '2023-08-15 11:38:02', '2023-08-15 11:38:02', NULL);
/*!40000 ALTER TABLE `unite_articles` ENABLE KEYS */;

-- Dumping structure for table sas-primaire.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `employer_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `parrain_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_employer_id_foreign` (`employer_id`),
  KEY `users_parrain_id_foreign` (`parrain_id`),
  CONSTRAINT `users_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`),
  CONSTRAINT `users_parrain_id_foreign` FOREIGN KEY (`parrain_id`) REFERENCES `parrains` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas-primaire.users: ~14 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `isAdmin`, `isActive`, `employer_id`, `created_at`, `updated_at`, `deleted_at`, `parrain_id`) VALUES
	(2, 'dev.binmulindi6@gmail.com', NULL, '$2y$10$eiqD9nLmn36y86Sd528Gou8vAUnFV9Bsyv3vdy5de6rtsEhFfCgji', 'Uvn9zrop5aHWpCHPxtPho2NXt3QxFdEbfVN2fXXjnY4C2J0dthg02vidsuFw', 1, 1, 1, '2022-08-23 19:00:54', '2022-08-23 19:00:54', NULL, NULL),
	(3, 'nathalie@gmail.com', NULL, '$2y$10$vPNI6fyNN2Qk7CZ6ql6W.eWL.z9PPTyjy0RP/baU611dIVT8t/IMO', NULL, 0, 1, 2, '2022-08-24 10:21:20', '2023-04-12 14:08:05', NULL, NULL),
	(4, 'jaysonmakunn@gmail.com', NULL, '$2y$10$UuTz3qfW1Al8WX4vygTdPulavvANo7yKYfsYh9E.R6.r8qhBKE.vC', NULL, 0, 1, 8, '2022-11-23 10:39:12', '2023-06-02 13:19:24', NULL, NULL),
	(5, 'jeanlucmulindi@gmail.com', NULL, '$2y$10$nUsIZ36MIj95XxeCFEFdZuvoZACjj71vXzP.VU8VMpRjZ8UglUF7S', NULL, 0, 1, 3, '2023-04-02 11:58:19', '2023-04-13 16:58:36', NULL, NULL),
	(6, 'nickelmolisho@gmail.com', NULL, '$2y$10$EVTCnKc7AUzQnKj7DJeG2uuOrobT96xq2Un9NOUUiJHmZ5AFCsuma', NULL, 0, 1, 4, '2023-04-03 06:34:38', '2023-06-05 13:19:31', NULL, NULL),
	(8, 'mulindi@gmail.com', NULL, '$2y$10$WgvkjSpvbkW5Bw9d/o08.u/MO2ZEEBgLKvI4lF5H9pJW.5uH/Hm2O', NULL, 0, 1, NULL, '2023-04-12 08:36:45', '2023-07-14 11:20:44', NULL, 3),
	(9, 'christa@gmail.com', NULL, '$2y$10$1gNddZoCWRmEvdJH057YD.1Qm2pi4n65htyTqz15JPSe9YCtm4Y26', NULL, 0, 1, 9, '2023-04-12 23:48:51', '2023-04-12 23:49:10', NULL, NULL),
	(10, 'masumbukomuderhwa@gmail.com', NULL, '$2y$10$ym7/iFK9pj84EOvRkCW8yuCI4p2jhcDitVfzl6m6SONoxNrQt1/yW', NULL, 0, 1, NULL, '2023-04-13 12:38:01', '2023-04-13 12:38:24', NULL, 4),
	(13, 'charly@gmail.com', NULL, '$2y$10$av9TM7j6ldo6a2i9k7jNjeVNXx7eMRIJPwl4tnGO2Jyn6rbTBMrF.', NULL, 0, 0, 10, '2023-05-30 13:42:06', '2023-05-30 13:42:06', NULL, NULL),
	(14, 'assumani@julie.com', NULL, '$2y$10$BR.zFkA3C1KD/GBr0XJOTO8RwHQ/OgigiDcsAzHVd.Ry9TEeFMzr.', NULL, 0, 1, NULL, '2023-06-05 13:22:29', '2023-06-15 14:14:29', NULL, 5),
	(15, 'abudu@gmail.com', NULL, '$2y$10$SWZhtkPvELYP87b.w3YZw.zicPMK2tmxCWpgUx/wVFT7T9LnEGpjy', NULL, 0, 1, 12, '2023-06-15 20:06:26', '2023-06-15 20:07:42', NULL, NULL),
	(16, 'molisho@gmail.com', NULL, '$2y$10$D75s4Z/tG9c3fCXnfirEBOl9tqZSduE66Tlz7VSVTFgP7uKFEXVBu', NULL, 0, 0, NULL, '2023-06-27 10:17:42', '2023-06-30 07:55:46', NULL, 6),
	(17, 'mastaki@gmail.com', NULL, '$2y$10$497tAzyReelejG34zuxq6eNXXTa6irXQA7gpRXsZp7uhtm2rtPSTu', NULL, 0, 1, 14, '2023-07-07 23:06:12', '2023-07-07 23:10:01', NULL, NULL),
	(18, 'zepto@gmail.com', NULL, '$2y$10$aKoAENgI1r.iwoPBBKmEduIyAKFhWBROufVwV9nb8W.hkmqBRO3bi', NULL, 0, 1, 15, '2023-07-08 08:18:18', '2023-07-08 08:18:53', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
