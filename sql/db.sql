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


-- Dumping database structure for sas
CREATE DATABASE IF NOT EXISTS `sas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sas`;

-- Dumping structure for table sas.annee_scolaires
CREATE TABLE IF NOT EXISTS `annee_scolaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `annee_scolaires_nom_unique` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.annee_scolaires: ~3 rows (approximately)
/*!40000 ALTER TABLE `annee_scolaires` DISABLE KEYS */;
INSERT INTO `annee_scolaires` (`id`, `nom`, `date_debut`, `date_fin`, `created_at`, `updated_at`, `deleted_at`, `selected`) VALUES
	(1, '2022-2023', '2022-09-02', '2023-07-02', '2022-08-24 16:55:26', '2022-11-17 20:33:09', NULL, 0),
	(2, '2023-2024', '2023-09-02', '2024-07-02', '2022-08-29 21:21:58', '2022-11-17 20:33:34', '2022-11-18 01:09:03', 0),
	(3, '2024-2025', '2024-09-02', '2025-07-02', '2022-09-15 16:02:08', '2022-11-19 12:32:50', NULL, 0);
/*!40000 ALTER TABLE `annee_scolaires` ENABLE KEYS */;

-- Dumping structure for table sas.categorie_cours
CREATE TABLE IF NOT EXISTS `categorie_cours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.categorie_cours: ~7 rows (approximately)
/*!40000 ALTER TABLE `categorie_cours` DISABLE KEYS */;
INSERT INTO `categorie_cours` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'MATHEMATIQUES', '2022-08-24 17:03:01', '2023-04-13 19:13:51', NULL),
	(2, 'FRANÇAIS', '2022-08-24 17:03:13', '2023-04-13 19:21:06', NULL),
	(3, 'CIVISME ET RELIGION', '2022-09-03 11:28:23', '2023-04-13 19:22:00', NULL),
	(4, 'Pornographie', '2022-09-03 11:34:47', '2022-09-03 11:34:49', '2022-09-03 11:34:49'),
	(5, 'ACTIVITES D\'EVEIL SCIENTIFIQUE', '2022-09-03 11:51:39', '2023-04-13 19:12:57', NULL),
	(6, 'ACTIVITES INSTRUMENTALES', '2023-04-13 19:08:59', '2023-04-13 19:08:59', NULL),
	(7, 'ACTIVITES D\'EVEIL ESTHETIQUE', '2023-04-13 19:10:44', '2023-04-13 19:10:44', NULL);
/*!40000 ALTER TABLE `categorie_cours` ENABLE KEYS */;

-- Dumping structure for table sas.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_id` bigint(20) unsigned NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_niveau_id_foreign` (`niveau_id`),
  CONSTRAINT `classes_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.classes: ~13 rows (approximately)
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` (`id`, `nom`, `niveau_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'A', 5, '2022-08-24 16:54:36', '2022-08-24 16:54:37', NULL),
	(2, 'A', 6, '2022-08-31 12:53:08', '2022-08-31 12:53:09', NULL),
	(3, 'B', 5, '2022-09-03 09:58:32', '2022-09-03 09:58:32', NULL),
	(4, 'B', 6, '2022-09-03 10:02:21', '2022-09-03 10:02:21', NULL),
	(5, 'A', 7, '2022-09-03 10:40:20', '2022-09-03 10:40:20', NULL),
	(6, 'C', 7, '2022-09-03 10:40:43', '2022-09-03 10:41:21', '2022-09-03 10:41:21'),
	(7, 'B', 7, '2022-09-03 10:41:32', '2022-09-03 10:41:32', NULL),
	(8, 'A', 4, '2022-09-03 10:41:40', '2022-11-23 23:54:33', NULL),
	(9, 'B', 4, '2022-09-03 10:41:47', '2022-09-03 10:41:47', NULL),
	(10, 'A', 8, '2023-01-31 12:30:58', '2023-01-31 12:30:58', NULL),
	(14, 'B', 8, '2023-04-13 17:55:25', '2023-04-13 17:55:25', NULL),
	(15, 'B', 8, '2023-04-13 17:58:39', '2023-04-13 17:58:46', '2023-04-13 17:58:46'),
	(16, 'A', 9, '2023-04-13 17:58:57', '2023-04-13 17:58:57', NULL);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;

-- Dumping structure for table sas.conduites
CREATE TABLE IF NOT EXISTS `conduites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.conduites: ~5 rows (approximately)
/*!40000 ALTER TABLE `conduites` DISABLE KEYS */;
INSERT INTO `conduites` (`id`, `nom`, `abbreviation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'EXCELLENTE', 'E', '2023-04-07 18:18:12', '2023-04-07 18:18:12', NULL),
	(2, 'TRES BONNE', 'TB', '2023-04-07 18:18:38', '2023-04-07 18:18:38', NULL),
	(3, 'BONNE', 'B', '2023-04-07 18:19:17', '2023-04-07 18:19:17', NULL),
	(4, 'ACCES BONNE', 'AB', '2023-04-07 18:19:26', '2023-04-07 18:19:27', NULL),
	(5, 'MAUVAISE', 'M', '2023-04-07 18:19:40', NULL, NULL);
/*!40000 ALTER TABLE `conduites` ENABLE KEYS */;

-- Dumping structure for table sas.cours
CREATE TABLE IF NOT EXISTS `cours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_periode` int(11) NOT NULL,
  `max_examen` int(11) NOT NULL,
  `categorie_cours_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_categorie_cours_id_foreign` (`categorie_cours_id`),
  KEY `cours_classe_id_foreign` (`classe_id`),
  CONSTRAINT `cours_categorie_cours_id_foreign` FOREIGN KEY (`categorie_cours_id`) REFERENCES `categorie_cours` (`id`),
  CONSTRAINT `cours_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.cours: ~8 rows (approximately)
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` (`id`, `nom`, `max_periode`, `max_examen`, `categorie_cours_id`, `classe_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Algebre', 40, 80, 1, 1, '2022-08-24 17:03:38', '2022-08-24 17:03:39', NULL),
	(2, 'Redaction', 20, 40, 2, 1, '2022-08-24 17:04:11', '2023-04-13 19:23:31', NULL),
	(3, 'Correspondance', 20, 40, 2, 1, '2022-09-01 04:56:14', '2022-09-03 16:40:59', NULL),
	(4, 'Geometrie', 20, 40, 1, 1, '2022-09-01 04:56:12', '2022-09-03 12:47:42', NULL),
	(6, 'Geographie', 20, 40, 5, 1, '2022-09-03 12:09:49', '2022-09-03 12:09:49', NULL),
	(7, 'Histoire', 20, 40, 5, 1, '2022-09-03 12:11:08', '2022-09-03 13:28:16', NULL),
	(8, 'botanique', 20, 40, 5, 5, '2022-10-25 16:51:53', '2022-10-25 16:51:53', NULL),
	(9, 'ECM', 10, 20, 3, 1, '2023-04-13 16:46:22', '2023-04-13 16:46:23', NULL);
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;

-- Dumping structure for table sas.eleves
CREATE TABLE IF NOT EXISTS `eleves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `nom_pere` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_mere` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parrain_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eleves_parrain_id_foreign` (`parrain_id`),
  CONSTRAINT `eleves_parrain_id_foreign` FOREIGN KEY (`parrain_id`) REFERENCES `parrains` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.eleves: ~34 rows (approximately)
/*!40000 ALTER TABLE `eleves` DISABLE KEYS */;
INSERT INTO `eleves` (`id`, `nom`, `prenom`, `matricule`, `lieu_naissance`, `date_naissance`, `nom_pere`, `nom_mere`, `adresse`, `parrain_id`, `created_at`, `updated_at`, `deleted_at`, `sexe`) VALUES
	(1, 'Keaton', 'Paucek', 'E269/2022', 'Greentown', '1986-01-20', 'Dr. Peyton Schimmel', 'Mrs. Gina Strosin I', '77497 Tromp Dale\nStephonborough, MO 39691', NULL, '2022-08-24 15:01:17', '2022-09-05 12:48:16', '2022-09-05 12:48:16', 'M'),
	(2, 'Laila', 'Del Minor', 'E455/2022', 'South Elmer', '2009-01-10', 'Zane Crona', 'Nelle Schneider', '4626 Kuhic RanchStephenstad, ME 09963', NULL, '2022-08-24 15:01:17', '2022-09-06 10:19:16', NULL, 'F'),
	(3, 'Jalon', 'Wiegand', 'E428/2022', 'Port Kellenfurt', '1998-01-24', 'Giovani Effertz', 'Fae Jones', '823 Adelle PlaceLake Daniellastad, NV 62133', NULL, '2022-08-24 15:01:17', '2023-03-22 22:14:38', NULL, 'M'),
	(4, 'Korbin', 'Kshlerin', 'E480/2022', 'North Ottomouth', '1981-05-17', 'Mr. Troy Kshlerin DVM', 'Prof. Elinore Ritchie I', '7516 Muller Summit Apt. 197\nLake Chloe, CT 79149-3041', NULL, '2022-08-24 15:01:17', '2022-09-09 17:16:57', '2022-09-09 17:16:57', 'F'),
	(5, 'Carli', 'Rutherford', 'E464/2022', 'Candidafort', '2004-12-20', 'Seamus Runte', 'Frieda Hamill', '2401 Nienow Squares Suite 503\nSouth Robbie, MO 79972-3885', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(6, 'Otilia', 'Collier', 'E493/2022', 'Funkbury', '1979-11-11', 'Dr. Laurel Funk', 'Ms. Myrtis Leffler', '55071 Morissette Loaf\nHanefort, OK 95998', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(7, 'Cole', 'Lowe', 'E102/2022', 'New Afton', '2022-04-09', 'Dr. Darien Larkin', 'Miss Maddison Gusikowski DDS', '938 Nadia Road Apt. 825\nNorth Dianna, NV 19446', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'M'),
	(8, 'Alison', 'Braun', 'E460/2022', 'Paucekfurt', '2009-02-01', 'Antone Schmidt', 'Nina Berge', '848 Garry Street Apt. 802\nLake Ephraim, MD 65470', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(9, 'Clarissa', 'Langosh', 'E112/2022', 'Lake Kolbyside', '1989-09-22', 'Luigi Stark', 'Asa Cormier', '384 Schmeler Squares Suite 724\nWest Eudorahaven, MO 33504-1676', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(10, 'Eloise', 'Volkman', 'E406/2022', 'Kalliestad', '2002-04-12', 'Jaylon Fahey', 'Madaline Nader', '245 Stoltenberg Road Apt. 403\nNew Sheldonberg, RI 88277', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'M'),
	(11, 'Brendan', 'Klocko', 'E417/2022', 'North Adolphborough', '1978-12-24', 'Brenden Klein', 'Ms. Kaya Wintheiser III', '873 Emard Mills\nFeilville, IA 51926-3163', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(12, 'Jailyn', 'Kuhlman', 'E447/2022', 'East Frances', '2005-08-21', 'Randall Witting', 'Aditya Mertz', '96138 Alvis Mews\nNorth Jaydenchester, NE 96346-4794', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'M'),
	(13, 'Kadin', 'Veum', 'E406/2022', 'Llewellynside', '1998-12-06', 'Kayleigh Treutel', 'Carolyn Erdman', '90885 Mac Keys Suite 448\nHomenickchester, NY 21611-5955', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(14, 'Carey', 'Rempel', 'E537/2022', 'North Foster', '1993-10-13', 'Jacey Stoltenberg', 'Dr. Eulah Larson', '489 Borer Walks\nVirgilport, IN 33464-5620', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'M'),
	(15, 'Esmeralda', 'Osinski', 'E443/2022', 'Delphiafurt', '2015-08-02', 'Rocio Harvey', 'Ms. Jaqueline Hermiston', '95557 Kirlin Valley Apt. 860\nLake Luella, MD 74754', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(16, 'Gabriel', 'Botsford', 'E227/2022', 'New Gailview', '2008-06-11', 'Rylan Rutherford', 'Berenice Treutel', '383 Ferry Trail Apt. 432\nLangmouth, VT 50517', NULL, '2022-08-24 15:01:17', '2023-02-04 13:18:51', '2023-02-04 13:18:51', 'M'),
	(17, 'Palma', 'Romaguera', 'E440/2022', 'North Jerry', '2002-07-31', 'Dr. Horace Crist IV', 'Prof. Daphney Lubowitz Sr.', '2182 Ferry Villages Suite 928\nFidelchester, MA 19385-8539', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(18, 'Nickolas', 'Hoeger', 'E480/2022', 'Altenwerthborough', '1988-12-21', 'Dr. Sidney Howell PhD', 'Casandra Frami', '7815 Ulises Drives Apt. 785\nSouth Briaport, NC 53976', NULL, '2022-08-24 15:01:17', '2022-08-29 01:42:33', '2022-08-29 01:42:33', 'M'),
	(19, 'Candace', 'Schowalter', 'E402/2022', 'Ressiemouth', '1977-01-20', 'Heber Lehner', 'Delphia Wisoky', '14799 Anne Ways\nEast Julius, UT 07524', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(20, 'Gilda', 'Keebler', 'E579/2022', 'East Luisaville', '1985-03-31', 'Prof. Cordelia Hahn', 'Natalie Abshire', '15863 Abernathy Meadow Suite 163\nNorth Brielle, MD 53461-7406', NULL, '2022-08-24 15:01:17', '2022-08-24 15:01:17', NULL, 'F'),
	(21, 'Abraham Mulindi', 'Tommy', 'E580/2022', 'Bukavu', '2022-01-12', 'Mulindi Kabanga', 'Luguvi Antoinette', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', 3, '2022-08-28 23:41:00', '2023-04-12 12:04:44', NULL, 'M'),
	(22, 'Atosha Molisho', 'Nickel', 'E581/2022', 'Bujumbura', '2022-08-10', 'Beau-Pere', 'Belle-Mere', '121 Gihosha, Gihosha, Bujumbura-Merie', NULL, '2022-08-29 01:38:04', '2022-11-19 12:52:57', NULL, 'F'),
	(23, 'Brayant', 'Kobe', 'E582/2022', 'New York', '1559-12-12', 'Bryant Jackson', 'Alida Jackson', 'Kinindo', NULL, '2022-08-31 10:49:56', '2022-11-19 12:48:39', NULL, 'M'),
	(24, 'Bintu Rutakaza', 'Teddy', 'E583/2022', 'Kinshasa', '1993-12-12', 'Rutakaza Sr', 'Mme Rutakaza', 'Bujumbura', NULL, '2022-09-09 17:01:38', '2022-11-19 12:48:20', NULL, 'M'),
	(25, 'Christian', 'Jerry', 'E584/2022', 'Lemera', '1993-01-08', 'Mulindi', 'Antoinette', 'Bukavu', NULL, '2022-09-15 15:15:15', '2022-11-19 12:46:29', NULL, 'M'),
	(26, 'Enseignant', 'Gouver', 'E585/2022', 'Bukavu', '2022-09-25', 'Rutakaza Sr', 'Belle-Mere', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', NULL, '2022-09-15 15:34:44', '2023-04-13 23:39:28', '2023-04-13 23:39:28', 'M'),
	(27, 'Ndioni Tonobunu', 'Jeannot', 'E586/2022', 'Goma', '1995-10-10', 'Tonobunu', 'Mme Tonobunu', '19 Nyakabiga 2, Mukaza, Bujumbura-Merie', NULL, '2022-11-19 12:07:14', '2023-01-31 12:32:04', NULL, 'M'),
	(28, 'Ingenieur', 'Jascript', 'E587/2023', 'Bukavu', '2023-02-03', 'Rutakaza Sr', 'Belle-Mere', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', NULL, '2023-02-03 16:04:05', '2023-02-04 11:23:54', '2023-02-04 11:23:54', 'M'),
	(29, 'Enseignant', 'Gouver', 'E588/2023', 'Bukavu', '2023-02-04', 'Rutakaza Sr', 'Belle-Mere', '23/B Jean Miruho, Panzi, Ibanda, Bukavu', NULL, '2023-02-03 16:06:27', '2023-02-04 11:23:47', '2023-02-04 11:23:47', 'M'),
	(30, 'KIZA KABANGA', 'Sebastien', 'E587/2023', 'Lemera', '1995-10-05', 'KIZA KABANGA', 'BAHATI KABANGA', 'Bujumbura, Cibitoke', 3, '2023-04-02 11:49:52', '2023-04-12 13:02:53', NULL, 'M'),
	(31, 'Cirhuza Masumbuko', 'Chrispin', 'E588/2023', 'Bukavu', '2002-12-12', 'Jean Mado', 'Kyala', 'PZ Route Panzi', 4, '2023-04-13 00:29:08', '2023-04-13 23:53:40', NULL, 'M'),
	(32, 'Cithona jerome', 'fabrice', 'E589/2023', 'Bukavu', '2000-11-01', 'Cithona', 'Antoinette', 'av. Jean miruho', 4, '2023-04-13 14:27:28', '2023-04-13 14:38:19', NULL, 'M'),
	(33, 'cubaka mirhimeluga', 'rodrigue', 'E590/2023', 'bukavu', '2000-12-04', 'mirhimeluga', 'Soise', 'route panzi', NULL, '2023-04-13 17:34:02', '2023-04-13 17:34:02', NULL, 'M'),
	(34, 'Zawadi Lubala', 'Jeanne D\'Arc', 'E591/2023', 'Bukavu', '2000-04-12', 'Lubala Chibuzi', 'Madame Chibuzi', 'Mushununu', NULL, '2023-04-13 23:55:41', '2023-04-13 23:55:41', NULL, 'F');
/*!40000 ALTER TABLE `eleves` ENABLE KEYS */;

-- Dumping structure for table sas.eleve_conduites
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.eleve_conduites: ~5 rows (approximately)
/*!40000 ALTER TABLE `eleve_conduites` DISABLE KEYS */;
INSERT INTO `eleve_conduites` (`id`, `eleve_id`, `conduite_id`, `periode_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 21, 1, 1, '2023-04-07 22:23:05', '2023-04-07 22:23:06', NULL),
	(2, 21, 2, 2, '2023-04-09 21:49:41', '2023-04-09 21:49:41', NULL),
	(3, 31, 4, 6, '2023-04-13 16:21:03', '2023-04-13 16:21:04', NULL),
	(4, 21, 3, 3, '2023-04-14 20:43:45', '2023-04-14 20:43:45', NULL),
	(5, 21, 5, 4, '2023-04-14 21:08:49', '2023-04-14 21:08:49', NULL);
/*!40000 ALTER TABLE `eleve_conduites` ENABLE KEYS */;

-- Dumping structure for table sas.eleve_evaluation
CREATE TABLE IF NOT EXISTS `eleve_evaluation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned NOT NULL,
  `evaluation_id` bigint(20) unsigned NOT NULL,
  `note_obtenu` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table_eleve_evaluation_eleve_id_foreign` (`eleve_id`),
  KEY `table_eleve_evaluation_evaluation_id_foreign` (`evaluation_id`),
  CONSTRAINT `table_eleve_evaluation_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `table_eleve_evaluation_evaluation_id_foreign` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=596 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.eleve_evaluation: ~580 rows (approximately)
/*!40000 ALTER TABLE `eleve_evaluation` DISABLE KEYS */;
INSERT INTO `eleve_evaluation` (`id`, `eleve_id`, `evaluation_id`, `note_obtenu`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 21, 1, 3, '2022-08-31 14:14:16', '2022-08-31 14:14:15', NULL),
	(2, 21, 2, 8, '2022-08-31 14:14:17', '2022-08-31 14:14:15', NULL),
	(3, 21, 3, 4, '2022-08-31 14:14:13', '2022-08-31 14:14:14', NULL),
	(4, 23, 1, 9, '2022-08-31 14:14:50', '2022-08-31 14:14:51', NULL),
	(5, 23, 2, 7, '2022-09-01 06:33:56', '2022-09-01 06:33:55', NULL),
	(8, 23, 3, 2, '2022-09-01 04:59:36', '2022-09-01 04:59:36', NULL),
	(9, 21, 4, 8, '2022-09-01 04:59:52', '2022-09-01 04:59:52', NULL),
	(10, 21, 5, 4, '2022-09-01 05:00:23', '2022-09-01 05:00:24', NULL),
	(11, 21, 6, 5, '2022-09-01 06:33:54', '2022-09-01 06:33:54', NULL),
	(12, 21, 7, 7, '2022-09-02 05:59:56', '2022-09-02 05:59:57', NULL),
	(13, 21, 8, 3, '2022-09-02 06:00:53', '2022-09-02 06:00:53', NULL),
	(14, 21, 9, 6, '2022-09-02 06:01:17', '2022-09-02 06:01:17', NULL),
	(15, 21, 10, 5, '2022-09-02 06:01:30', '2022-09-02 06:01:30', NULL),
	(16, 21, 11, 3, '2022-09-02 06:01:37', NULL, NULL),
	(30, 2, 29, 0, NULL, NULL, NULL),
	(31, 3, 29, 0, NULL, NULL, NULL),
	(32, 4, 29, 0, NULL, NULL, NULL),
	(33, 5, 29, 0, NULL, NULL, NULL),
	(34, 6, 29, 0, NULL, NULL, NULL),
	(35, 7, 29, 0, NULL, NULL, NULL),
	(36, 8, 29, 0, NULL, NULL, NULL),
	(37, 9, 29, 0, NULL, NULL, NULL),
	(38, 10, 29, 0, NULL, NULL, NULL),
	(39, 17, 29, 0, NULL, NULL, NULL),
	(40, 21, 29, 6, NULL, NULL, NULL),
	(41, 22, 29, 0, NULL, NULL, NULL),
	(42, 23, 29, 0, NULL, NULL, NULL),
	(43, 2, 30, 0, NULL, NULL, NULL),
	(44, 3, 30, 0, NULL, NULL, NULL),
	(45, 4, 30, 0, NULL, NULL, NULL),
	(46, 5, 30, 0, NULL, NULL, NULL),
	(47, 6, 30, 0, NULL, NULL, NULL),
	(48, 7, 30, 0, NULL, NULL, NULL),
	(49, 8, 30, 0, NULL, NULL, NULL),
	(50, 9, 30, 0, NULL, NULL, NULL),
	(51, 10, 30, 0, NULL, NULL, NULL),
	(52, 17, 30, 0, NULL, NULL, NULL),
	(53, 21, 30, 8, NULL, NULL, NULL),
	(54, 22, 30, 0, NULL, NULL, NULL),
	(55, 23, 30, 0, NULL, NULL, NULL),
	(56, 2, 31, 0, NULL, NULL, NULL),
	(57, 3, 31, 0, NULL, NULL, NULL),
	(58, 4, 31, 0, NULL, NULL, NULL),
	(59, 5, 31, 0, NULL, NULL, NULL),
	(60, 6, 31, 0, NULL, NULL, NULL),
	(61, 7, 31, 0, NULL, NULL, NULL),
	(62, 8, 31, 0, NULL, NULL, NULL),
	(63, 9, 31, 0, NULL, NULL, NULL),
	(64, 10, 31, 0, NULL, NULL, NULL),
	(65, 17, 31, 0, NULL, NULL, NULL),
	(66, 21, 31, 8, NULL, NULL, NULL),
	(67, 22, 31, 0, NULL, NULL, NULL),
	(68, 23, 31, 0, NULL, NULL, NULL),
	(69, 2, 32, 0, NULL, NULL, NULL),
	(70, 3, 32, 0, NULL, NULL, NULL),
	(71, 4, 32, 0, NULL, NULL, NULL),
	(72, 5, 32, 0, NULL, NULL, NULL),
	(73, 6, 32, 0, NULL, NULL, NULL),
	(74, 7, 32, 0, NULL, NULL, NULL),
	(75, 8, 32, 0, NULL, NULL, NULL),
	(76, 9, 32, 0, NULL, NULL, NULL),
	(77, 10, 32, 0, NULL, NULL, NULL),
	(78, 17, 32, 0, NULL, NULL, NULL),
	(79, 21, 32, 4, NULL, NULL, NULL),
	(80, 22, 32, 0, NULL, NULL, NULL),
	(81, 23, 32, 0, NULL, NULL, NULL),
	(82, 2, 33, 0, NULL, NULL, NULL),
	(83, 3, 33, 0, NULL, NULL, NULL),
	(84, 4, 33, 0, NULL, NULL, NULL),
	(85, 5, 33, 0, NULL, NULL, NULL),
	(86, 6, 33, 0, NULL, NULL, NULL),
	(87, 7, 33, 0, NULL, NULL, NULL),
	(88, 8, 33, 0, NULL, NULL, NULL),
	(89, 9, 33, 0, NULL, NULL, NULL),
	(90, 10, 33, 0, NULL, NULL, NULL),
	(91, 17, 33, 0, NULL, NULL, NULL),
	(92, 21, 33, 7, NULL, NULL, NULL),
	(93, 22, 33, 0, NULL, NULL, NULL),
	(94, 23, 33, 0, NULL, NULL, NULL),
	(95, 2, 34, 0, NULL, NULL, NULL),
	(96, 3, 34, 0, NULL, NULL, NULL),
	(97, 4, 34, 0, NULL, NULL, NULL),
	(98, 5, 34, 0, NULL, NULL, NULL),
	(99, 6, 34, 0, NULL, NULL, NULL),
	(100, 7, 34, 0, NULL, NULL, NULL),
	(101, 8, 34, 0, NULL, NULL, NULL),
	(102, 9, 34, 0, NULL, NULL, NULL),
	(103, 10, 34, 0, NULL, NULL, NULL),
	(104, 17, 34, 0, NULL, NULL, NULL),
	(105, 21, 34, 5, NULL, NULL, NULL),
	(106, 22, 34, 0, NULL, NULL, NULL),
	(107, 23, 34, 0, NULL, NULL, NULL),
	(108, 2, 35, 0, NULL, NULL, NULL),
	(109, 3, 35, 0, NULL, NULL, NULL),
	(110, 4, 35, 0, NULL, NULL, NULL),
	(111, 5, 35, 0, NULL, NULL, NULL),
	(112, 6, 35, 0, NULL, NULL, NULL),
	(113, 7, 35, 0, NULL, NULL, NULL),
	(114, 8, 35, 0, NULL, NULL, NULL),
	(115, 9, 35, 0, NULL, NULL, NULL),
	(116, 10, 35, 0, NULL, NULL, NULL),
	(117, 17, 35, 0, NULL, NULL, NULL),
	(118, 21, 35, 4, NULL, NULL, NULL),
	(119, 22, 35, 0, NULL, NULL, NULL),
	(120, 23, 35, 0, NULL, NULL, NULL),
	(121, 2, 36, 0, NULL, NULL, NULL),
	(122, 3, 36, 0, NULL, NULL, NULL),
	(123, 4, 36, 0, NULL, NULL, NULL),
	(124, 5, 36, 0, NULL, NULL, NULL),
	(125, 6, 36, 0, NULL, NULL, NULL),
	(126, 7, 36, 0, NULL, NULL, NULL),
	(127, 8, 36, 0, NULL, NULL, NULL),
	(128, 9, 36, 0, NULL, NULL, NULL),
	(129, 10, 36, 0, NULL, NULL, NULL),
	(130, 17, 36, 0, NULL, NULL, NULL),
	(131, 21, 36, 8, NULL, NULL, NULL),
	(132, 22, 36, 0, NULL, NULL, NULL),
	(133, 23, 36, 0, NULL, NULL, NULL),
	(134, 2, 37, 0, NULL, NULL, NULL),
	(135, 3, 37, 0, NULL, NULL, NULL),
	(136, 4, 37, 0, NULL, NULL, NULL),
	(137, 5, 37, 0, NULL, NULL, NULL),
	(138, 6, 37, 0, NULL, NULL, NULL),
	(139, 7, 37, 0, NULL, NULL, NULL),
	(140, 8, 37, 0, NULL, NULL, NULL),
	(141, 9, 37, 0, NULL, NULL, NULL),
	(142, 10, 37, 0, NULL, NULL, NULL),
	(143, 17, 37, 0, NULL, NULL, NULL),
	(144, 21, 37, 8, NULL, NULL, NULL),
	(145, 22, 37, 0, NULL, NULL, NULL),
	(146, 23, 37, 0, NULL, NULL, NULL),
	(147, 2, 38, 0, NULL, NULL, NULL),
	(148, 3, 38, 0, NULL, NULL, NULL),
	(149, 4, 38, 0, NULL, NULL, NULL),
	(150, 5, 38, 0, NULL, NULL, NULL),
	(151, 6, 38, 0, NULL, NULL, NULL),
	(152, 7, 38, 0, NULL, NULL, NULL),
	(153, 8, 38, 0, NULL, NULL, NULL),
	(154, 9, 38, 0, NULL, NULL, NULL),
	(155, 10, 38, 0, NULL, NULL, NULL),
	(156, 17, 38, 0, NULL, NULL, NULL),
	(157, 21, 38, 5, NULL, NULL, NULL),
	(158, 22, 38, 0, NULL, NULL, NULL),
	(159, 23, 38, 0, NULL, NULL, NULL),
	(160, 2, 39, 0, NULL, NULL, NULL),
	(161, 3, 39, 0, NULL, NULL, NULL),
	(162, 4, 39, 0, NULL, NULL, NULL),
	(163, 5, 39, 0, NULL, NULL, NULL),
	(164, 6, 39, 0, NULL, NULL, NULL),
	(165, 7, 39, 0, NULL, NULL, NULL),
	(166, 8, 39, 0, NULL, NULL, NULL),
	(167, 9, 39, 0, NULL, NULL, NULL),
	(168, 10, 39, 0, NULL, NULL, NULL),
	(169, 17, 39, 0, NULL, NULL, NULL),
	(170, 21, 39, 6, NULL, NULL, NULL),
	(171, 22, 39, 0, NULL, NULL, NULL),
	(172, 23, 39, 0, NULL, NULL, NULL),
	(173, 2, 40, 0, NULL, NULL, NULL),
	(174, 3, 40, 0, NULL, NULL, NULL),
	(175, 4, 40, 0, NULL, NULL, NULL),
	(176, 5, 40, 0, NULL, NULL, NULL),
	(177, 6, 40, 0, NULL, NULL, NULL),
	(178, 7, 40, 0, NULL, NULL, NULL),
	(179, 8, 40, 0, NULL, NULL, NULL),
	(180, 9, 40, 0, NULL, NULL, NULL),
	(181, 10, 40, 0, NULL, NULL, NULL),
	(182, 17, 40, 0, NULL, NULL, NULL),
	(183, 21, 40, 6, NULL, NULL, NULL),
	(184, 22, 40, 0, NULL, NULL, NULL),
	(185, 23, 40, 0, NULL, NULL, NULL),
	(186, 2, 41, 0, NULL, NULL, NULL),
	(187, 3, 41, 0, NULL, NULL, NULL),
	(188, 4, 41, 0, NULL, NULL, NULL),
	(189, 5, 41, 0, NULL, NULL, NULL),
	(190, 6, 41, 0, NULL, NULL, NULL),
	(191, 7, 41, 0, NULL, NULL, NULL),
	(192, 8, 41, 0, NULL, NULL, NULL),
	(193, 9, 41, 0, NULL, NULL, NULL),
	(194, 10, 41, 0, NULL, NULL, NULL),
	(195, 17, 41, 0, NULL, NULL, NULL),
	(196, 21, 41, 3, NULL, NULL, NULL),
	(197, 22, 41, 0, NULL, NULL, NULL),
	(198, 23, 41, 0, NULL, NULL, NULL),
	(199, 2, 42, 0, NULL, NULL, NULL),
	(200, 3, 42, 0, NULL, NULL, NULL),
	(201, 4, 42, 0, NULL, NULL, NULL),
	(202, 5, 42, 0, NULL, NULL, NULL),
	(203, 6, 42, 0, NULL, NULL, NULL),
	(204, 7, 42, 0, NULL, NULL, NULL),
	(205, 8, 42, 0, NULL, NULL, NULL),
	(206, 9, 42, 0, NULL, NULL, NULL),
	(207, 10, 42, 0, NULL, NULL, NULL),
	(208, 17, 42, 0, NULL, NULL, NULL),
	(209, 21, 42, 6, NULL, NULL, NULL),
	(210, 22, 42, 0, NULL, NULL, NULL),
	(211, 23, 42, 0, NULL, NULL, NULL),
	(212, 2, 43, 0, NULL, NULL, NULL),
	(213, 3, 43, 0, NULL, NULL, NULL),
	(214, 4, 43, 0, NULL, NULL, NULL),
	(215, 5, 43, 0, NULL, NULL, NULL),
	(216, 6, 43, 0, NULL, NULL, NULL),
	(217, 7, 43, 0, NULL, NULL, NULL),
	(218, 8, 43, 0, NULL, NULL, NULL),
	(219, 9, 43, 0, NULL, NULL, NULL),
	(220, 10, 43, 0, NULL, NULL, NULL),
	(221, 17, 43, 0, NULL, NULL, NULL),
	(222, 21, 43, 15, NULL, NULL, NULL),
	(223, 22, 43, 0, NULL, NULL, NULL),
	(224, 23, 43, 0, NULL, NULL, NULL),
	(225, 2, 44, 0, NULL, NULL, NULL),
	(226, 3, 44, 0, NULL, NULL, NULL),
	(227, 4, 44, 0, NULL, NULL, NULL),
	(228, 5, 44, 0, NULL, NULL, NULL),
	(229, 6, 44, 0, NULL, NULL, NULL),
	(230, 7, 44, 0, NULL, NULL, NULL),
	(231, 8, 44, 0, NULL, NULL, NULL),
	(232, 9, 44, 0, NULL, NULL, NULL),
	(233, 10, 44, 0, NULL, NULL, NULL),
	(234, 17, 44, 0, NULL, NULL, NULL),
	(235, 21, 44, 3, NULL, NULL, NULL),
	(236, 22, 44, 0, NULL, NULL, NULL),
	(237, 23, 44, 0, NULL, NULL, NULL),
	(238, 2, 45, 0, NULL, NULL, NULL),
	(239, 3, 45, 0, NULL, NULL, NULL),
	(240, 4, 45, 0, NULL, NULL, NULL),
	(241, 5, 45, 0, NULL, NULL, NULL),
	(242, 6, 45, 0, NULL, NULL, NULL),
	(243, 7, 45, 0, NULL, NULL, NULL),
	(244, 8, 45, 0, NULL, NULL, NULL),
	(245, 9, 45, 0, NULL, NULL, NULL),
	(246, 10, 45, 0, NULL, NULL, NULL),
	(247, 17, 45, 0, NULL, NULL, NULL),
	(248, 21, 45, 0, NULL, NULL, NULL),
	(249, 22, 45, 0, NULL, NULL, NULL),
	(250, 23, 45, 0, NULL, NULL, NULL),
	(251, 2, 46, 0, NULL, NULL, NULL),
	(252, 3, 46, 0, NULL, NULL, NULL),
	(253, 4, 46, 0, NULL, NULL, NULL),
	(254, 5, 46, 0, NULL, NULL, NULL),
	(255, 6, 46, 0, NULL, NULL, NULL),
	(256, 7, 46, 0, NULL, NULL, NULL),
	(257, 8, 46, 0, NULL, NULL, NULL),
	(258, 9, 46, 0, NULL, NULL, NULL),
	(259, 10, 46, 0, NULL, NULL, NULL),
	(260, 17, 46, 0, NULL, NULL, NULL),
	(261, 21, 46, 5, NULL, NULL, NULL),
	(262, 22, 46, 0, NULL, NULL, NULL),
	(263, 23, 46, 0, NULL, NULL, NULL),
	(264, 2, 47, 0, NULL, NULL, NULL),
	(265, 3, 47, 0, NULL, NULL, NULL),
	(266, 4, 47, 0, NULL, NULL, NULL),
	(267, 5, 47, 0, NULL, NULL, NULL),
	(268, 6, 47, 0, NULL, NULL, NULL),
	(269, 7, 47, 0, NULL, NULL, NULL),
	(270, 8, 47, 0, NULL, NULL, NULL),
	(271, 9, 47, 0, NULL, NULL, NULL),
	(272, 10, 47, 0, NULL, NULL, NULL),
	(273, 17, 47, 0, NULL, NULL, NULL),
	(274, 21, 47, 6, NULL, NULL, NULL),
	(275, 22, 47, 0, NULL, NULL, NULL),
	(276, 23, 47, 0, NULL, NULL, NULL),
	(277, 2, 48, 0, NULL, NULL, NULL),
	(278, 3, 48, 0, NULL, NULL, NULL),
	(279, 4, 48, 0, NULL, NULL, NULL),
	(280, 5, 48, 0, NULL, NULL, NULL),
	(281, 6, 48, 0, NULL, NULL, NULL),
	(282, 7, 48, 0, NULL, NULL, NULL),
	(283, 8, 48, 0, NULL, NULL, NULL),
	(284, 9, 48, 0, NULL, NULL, NULL),
	(285, 10, 48, 0, NULL, NULL, NULL),
	(286, 17, 48, 0, NULL, NULL, NULL),
	(287, 21, 48, 3, NULL, NULL, NULL),
	(288, 22, 48, 0, NULL, NULL, NULL),
	(289, 23, 48, 0, NULL, NULL, NULL),
	(290, 2, 49, 0, NULL, NULL, NULL),
	(291, 3, 49, 0, NULL, NULL, NULL),
	(292, 4, 49, 0, NULL, NULL, NULL),
	(293, 5, 49, 0, NULL, NULL, NULL),
	(294, 6, 49, 0, NULL, NULL, NULL),
	(295, 7, 49, 0, NULL, NULL, NULL),
	(296, 8, 49, 0, NULL, NULL, NULL),
	(297, 9, 49, 0, NULL, NULL, NULL),
	(298, 10, 49, 0, NULL, NULL, NULL),
	(299, 17, 49, 0, NULL, NULL, NULL),
	(300, 21, 49, 5, NULL, NULL, NULL),
	(301, 22, 49, 0, NULL, NULL, NULL),
	(302, 23, 49, 0, NULL, NULL, NULL),
	(303, 2, 50, 0, NULL, NULL, NULL),
	(304, 3, 50, 0, NULL, NULL, NULL),
	(305, 4, 50, 0, NULL, NULL, NULL),
	(306, 5, 50, 0, NULL, NULL, NULL),
	(307, 6, 50, 0, NULL, NULL, NULL),
	(308, 7, 50, 0, NULL, NULL, NULL),
	(309, 8, 50, 0, NULL, NULL, NULL),
	(310, 9, 50, 0, NULL, NULL, NULL),
	(311, 10, 50, 0, NULL, NULL, NULL),
	(312, 17, 50, 0, NULL, NULL, NULL),
	(313, 21, 50, 8, NULL, NULL, NULL),
	(314, 22, 50, 0, NULL, NULL, NULL),
	(315, 23, 50, 0, NULL, NULL, NULL),
	(316, 2, 51, 0, NULL, NULL, NULL),
	(317, 3, 51, 0, NULL, NULL, NULL),
	(318, 4, 51, 0, NULL, NULL, NULL),
	(319, 5, 51, 0, NULL, NULL, NULL),
	(320, 6, 51, 0, NULL, NULL, NULL),
	(321, 7, 51, 0, NULL, NULL, NULL),
	(322, 8, 51, 0, NULL, NULL, NULL),
	(323, 9, 51, 0, NULL, NULL, NULL),
	(324, 10, 51, 0, NULL, NULL, NULL),
	(325, 17, 51, 0, NULL, NULL, NULL),
	(326, 21, 51, 8, NULL, NULL, NULL),
	(327, 22, 51, 0, NULL, NULL, NULL),
	(328, 23, 51, 0, NULL, NULL, NULL),
	(329, 2, 52, 0, NULL, NULL, NULL),
	(330, 3, 52, 0, NULL, NULL, NULL),
	(331, 4, 52, 0, NULL, NULL, NULL),
	(332, 5, 52, 0, NULL, NULL, NULL),
	(333, 6, 52, 0, NULL, NULL, NULL),
	(334, 7, 52, 0, NULL, NULL, NULL),
	(335, 8, 52, 0, NULL, NULL, NULL),
	(336, 9, 52, 0, NULL, NULL, NULL),
	(337, 10, 52, 0, NULL, NULL, NULL),
	(338, 17, 52, 0, NULL, NULL, NULL),
	(339, 21, 52, 8, NULL, NULL, NULL),
	(340, 22, 52, 0, NULL, NULL, NULL),
	(341, 23, 52, 0, NULL, NULL, NULL),
	(342, 2, 53, 0, NULL, NULL, NULL),
	(343, 3, 53, 0, NULL, NULL, NULL),
	(344, 5, 53, 0, NULL, NULL, NULL),
	(345, 6, 53, 0, NULL, NULL, NULL),
	(346, 7, 53, 0, NULL, NULL, NULL),
	(347, 8, 53, 0, NULL, NULL, NULL),
	(348, 9, 53, 0, NULL, NULL, NULL),
	(349, 10, 53, 0, NULL, NULL, NULL),
	(350, 17, 53, 0, NULL, NULL, NULL),
	(351, 21, 53, 0, NULL, NULL, NULL),
	(352, 22, 53, 0, NULL, NULL, NULL),
	(353, 23, 53, 0, NULL, NULL, NULL),
	(354, 25, 53, 0, NULL, NULL, NULL),
	(355, 2, 54, 0, NULL, NULL, NULL),
	(356, 3, 54, 0, NULL, NULL, NULL),
	(357, 5, 54, 0, NULL, NULL, NULL),
	(358, 6, 54, 0, NULL, NULL, NULL),
	(359, 7, 54, 0, NULL, NULL, NULL),
	(360, 8, 54, 0, NULL, NULL, NULL),
	(361, 9, 54, 0, NULL, NULL, NULL),
	(362, 10, 54, 0, NULL, NULL, NULL),
	(363, 17, 54, 0, NULL, NULL, NULL),
	(364, 21, 54, 9, NULL, NULL, NULL),
	(365, 22, 54, 0, NULL, NULL, NULL),
	(366, 23, 54, 0, NULL, NULL, NULL),
	(367, 25, 54, 0, NULL, NULL, NULL),
	(368, 2, 55, 0, NULL, NULL, NULL),
	(369, 3, 55, 0, NULL, NULL, NULL),
	(370, 5, 55, 0, NULL, NULL, NULL),
	(371, 6, 55, 0, NULL, NULL, NULL),
	(372, 7, 55, 0, NULL, NULL, NULL),
	(373, 8, 55, 0, NULL, NULL, NULL),
	(374, 9, 55, 0, NULL, NULL, NULL),
	(375, 10, 55, 0, NULL, NULL, NULL),
	(376, 17, 55, 0, NULL, NULL, NULL),
	(377, 21, 55, 7, NULL, '2023-04-13 17:07:25', NULL),
	(378, 22, 55, 0, NULL, NULL, NULL),
	(379, 23, 55, 0, NULL, NULL, NULL),
	(380, 25, 55, 0, NULL, NULL, NULL),
	(381, 2, 56, 0, NULL, NULL, NULL),
	(382, 3, 56, 0, NULL, NULL, NULL),
	(383, 5, 56, 0, NULL, NULL, NULL),
	(384, 6, 56, 0, NULL, NULL, NULL),
	(385, 7, 56, 0, NULL, NULL, NULL),
	(386, 8, 56, 0, NULL, NULL, NULL),
	(387, 9, 56, 0, NULL, NULL, NULL),
	(388, 10, 56, 0, NULL, NULL, NULL),
	(389, 17, 56, 0, NULL, NULL, NULL),
	(390, 21, 56, 0, NULL, NULL, NULL),
	(391, 22, 56, 0, NULL, NULL, NULL),
	(392, 23, 56, 0, NULL, NULL, NULL),
	(393, 25, 56, 0, NULL, NULL, NULL),
	(394, 27, 56, 0, NULL, NULL, NULL),
	(395, 31, 67, 20, NULL, NULL, NULL),
	(396, 27, 67, 0, NULL, NULL, NULL),
	(397, 25, 67, 0, NULL, NULL, NULL),
	(398, 21, 67, 0, NULL, NULL, NULL),
	(399, 23, 67, 0, NULL, NULL, NULL),
	(400, 17, 67, 0, NULL, NULL, NULL),
	(401, 22, 67, 0, NULL, NULL, NULL),
	(402, 10, 67, 0, NULL, NULL, NULL),
	(403, 9, 67, 0, NULL, NULL, NULL),
	(404, 8, 67, 0, NULL, NULL, NULL),
	(405, 7, 67, 0, NULL, NULL, NULL),
	(406, 6, 67, 0, NULL, NULL, NULL),
	(407, 5, 67, 0, NULL, NULL, NULL),
	(408, 3, 67, 0, NULL, NULL, NULL),
	(409, 2, 67, 0, NULL, NULL, NULL),
	(410, 31, 68, 10, '2023-04-13 17:17:41', '2023-04-13 16:18:23', NULL),
	(411, 27, 68, 0, '2023-04-13 17:17:41', '2023-04-13 17:17:41', NULL),
	(412, 25, 68, 0, '2023-04-13 17:17:41', '2023-04-13 17:17:41', NULL),
	(413, 21, 68, 9, '2023-04-13 17:17:41', '2023-04-13 15:24:36', NULL),
	(414, 23, 68, 0, '2023-04-13 17:17:41', '2023-04-13 17:17:41', NULL),
	(415, 17, 68, 0, '2023-04-13 17:17:41', '2023-04-13 17:17:41', NULL),
	(416, 22, 68, 0, '2023-04-13 17:17:41', '2023-04-13 17:17:41', NULL),
	(417, 10, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(418, 9, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(419, 8, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(420, 7, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(421, 6, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(422, 5, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(423, 3, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(424, 2, 68, 0, '2023-04-13 17:17:42', '2023-04-13 17:17:42', NULL),
	(425, 31, 69, 7, '2023-04-13 18:14:03', '2023-04-13 16:19:38', NULL),
	(426, 27, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(427, 25, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(428, 21, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(429, 23, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(430, 17, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(431, 22, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(432, 10, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(433, 9, 69, 0, '2023-04-13 18:14:03', '2023-04-13 18:14:03', NULL),
	(434, 8, 69, 0, '2023-04-13 18:14:04', '2023-04-13 18:14:04', NULL),
	(435, 7, 69, 0, '2023-04-13 18:14:04', '2023-04-13 18:14:04', NULL),
	(436, 6, 69, 0, '2023-04-13 18:14:04', '2023-04-13 18:14:04', NULL),
	(437, 5, 69, 0, '2023-04-13 18:14:04', '2023-04-13 18:14:04', NULL),
	(438, 3, 69, 0, '2023-04-13 18:14:04', '2023-04-13 18:14:04', NULL),
	(439, 2, 69, 0, '2023-04-13 18:14:04', '2023-04-13 18:14:04', NULL),
	(440, 31, 70, 8, '2023-04-13 18:14:35', '2023-04-13 16:18:50', NULL),
	(441, 27, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(442, 25, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(443, 21, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(444, 23, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(445, 17, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(446, 22, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(447, 10, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(448, 9, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(449, 8, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(450, 7, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(451, 6, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(452, 5, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(453, 3, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(454, 2, 70, 0, '2023-04-13 18:14:36', '2023-04-13 18:14:36', NULL),
	(455, 31, 71, 0, '2023-04-13 18:48:24', '2023-04-13 18:48:24', NULL),
	(456, 27, 71, 0, '2023-04-13 18:48:24', '2023-04-13 18:48:24', NULL),
	(457, 25, 71, 0, '2023-04-13 18:48:24', '2023-04-13 18:48:24', NULL),
	(458, 21, 71, 2, '2023-04-13 18:48:24', '2023-04-13 16:49:06', NULL),
	(459, 23, 71, 0, '2023-04-13 18:48:24', '2023-04-13 18:48:24', NULL),
	(460, 17, 71, 0, '2023-04-13 18:48:24', '2023-04-13 18:48:24', NULL),
	(461, 22, 71, 0, '2023-04-13 18:48:24', '2023-04-13 18:48:24', NULL),
	(462, 10, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(463, 9, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(464, 8, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(465, 7, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(466, 6, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(467, 5, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(468, 3, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(469, 2, 71, 0, '2023-04-13 18:48:25', '2023-04-13 18:48:25', NULL),
	(470, 31, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(471, 27, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(472, 25, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(473, 21, 72, 10, '2023-04-13 19:04:00', '2023-04-13 17:06:52', NULL),
	(474, 23, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(475, 17, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(476, 22, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(477, 10, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(478, 9, 72, 0, '2023-04-13 19:04:00', '2023-04-13 19:04:00', NULL),
	(479, 8, 72, 0, '2023-04-13 19:04:01', '2023-04-13 19:04:01', NULL),
	(480, 7, 72, 0, '2023-04-13 19:04:01', '2023-04-13 19:04:01', NULL),
	(481, 6, 72, 0, '2023-04-13 19:04:01', '2023-04-13 19:04:01', NULL),
	(482, 5, 72, 0, '2023-04-13 19:04:01', '2023-04-13 19:04:01', NULL),
	(483, 3, 72, 0, '2023-04-13 19:04:01', '2023-04-13 19:04:01', NULL),
	(484, 2, 72, 0, '2023-04-13 19:04:01', '2023-04-13 19:04:01', NULL),
	(485, 32, 74, 0, '2023-04-14 01:30:53', '2023-04-14 01:30:53', NULL),
	(486, 33, 74, 0, '2023-04-14 01:47:46', '2023-04-14 01:47:46', NULL),
	(487, 31, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(488, 27, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(489, 25, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(490, 21, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(491, 23, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(492, 17, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(493, 22, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(494, 10, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(495, 9, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(496, 8, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(497, 7, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(498, 6, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(499, 5, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(500, 3, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(501, 2, 75, 0, '2023-04-14 01:50:15', '2023-04-14 01:50:15', NULL),
	(502, 31, 76, 0, '2023-04-14 01:50:45', '2023-04-14 01:50:45', NULL),
	(503, 27, 76, 0, '2023-04-14 01:50:45', '2023-04-14 01:50:45', NULL),
	(504, 25, 76, 0, '2023-04-14 01:50:45', '2023-04-14 01:50:45', NULL),
	(505, 21, 76, 0, '2023-04-14 01:50:45', '2023-04-14 01:50:45', NULL),
	(506, 23, 76, 0, '2023-04-14 01:50:45', '2023-04-14 01:50:45', NULL),
	(507, 17, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(508, 22, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(509, 10, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(510, 9, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(511, 8, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(512, 7, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(513, 6, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(514, 5, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(515, 3, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(516, 2, 76, 0, '2023-04-14 01:50:46', '2023-04-14 01:50:46', NULL),
	(517, 31, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(518, 27, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(519, 25, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(520, 21, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(521, 23, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(522, 17, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(523, 22, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(524, 10, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(525, 9, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(526, 8, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(527, 7, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(528, 6, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(529, 5, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(530, 3, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(531, 2, 77, 0, '2023-04-14 01:51:09', '2023-04-14 01:51:09', NULL),
	(532, 31, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(533, 27, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(534, 25, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(535, 21, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(536, 23, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(537, 17, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(538, 22, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(539, 10, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(540, 9, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(541, 8, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(542, 7, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(543, 6, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(544, 5, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(545, 3, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(546, 2, 78, 0, '2023-04-14 01:51:27', '2023-04-14 01:51:27', NULL),
	(547, 34, 1, 0, '2023-04-14 01:55:49', '2023-04-14 01:55:49', NULL),
	(548, 34, 3, 0, '2023-04-14 01:55:49', '2023-04-14 01:55:49', NULL),
	(549, 34, 6, 0, '2023-04-14 01:55:49', '2023-04-14 01:55:49', NULL),
	(550, 34, 9, 0, '2023-04-14 01:55:49', '2023-04-14 01:55:49', NULL),
	(551, 34, 10, 0, '2023-04-14 01:55:49', '2023-04-14 01:55:49', NULL),
	(552, 34, 29, 0, '2023-04-14 01:55:49', '2023-04-14 01:55:49', NULL),
	(553, 34, 31, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(554, 34, 35, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(555, 34, 36, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(556, 34, 40, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(557, 34, 53, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(558, 34, 54, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(559, 34, 55, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(560, 34, 56, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(561, 34, 68, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(562, 34, 2, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(563, 34, 11, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(564, 34, 33, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(565, 34, 38, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(566, 34, 42, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(567, 34, 44, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(568, 34, 67, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(569, 34, 5, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(570, 34, 8, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(571, 34, 30, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(572, 34, 32, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(573, 34, 37, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(574, 34, 41, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(575, 34, 4, 0, '2023-04-14 01:55:50', '2023-04-14 01:55:50', NULL),
	(576, 34, 7, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(577, 34, 34, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(578, 34, 39, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(579, 34, 43, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(580, 34, 46, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(581, 34, 70, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(582, 34, 47, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(583, 34, 48, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(584, 34, 49, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(585, 34, 50, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(586, 34, 51, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(587, 34, 52, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(588, 34, 69, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(589, 34, 71, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(590, 34, 72, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(591, 34, 75, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(592, 34, 76, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(593, 34, 77, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(594, 34, 78, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(595, 21, 74, 0, '2023-04-19 02:57:06', '2023-04-19 02:57:06', NULL);
/*!40000 ALTER TABLE `eleve_evaluation` ENABLE KEYS */;

-- Dumping structure for table sas.eleve_examen
CREATE TABLE IF NOT EXISTS `eleve_examen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned NOT NULL,
  `examen_id` bigint(20) unsigned NOT NULL,
  `note_obtenu` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table_eleve_examen_eleve_id_foreign` (`eleve_id`),
  KEY `table_eleve_examen_examen_id_foreign` (`examen_id`),
  CONSTRAINT `table_eleve_examen_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `table_eleve_examen_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examens` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.eleve_examen: ~226 rows (approximately)
/*!40000 ALTER TABLE `eleve_examen` DISABLE KEYS */;
INSERT INTO `eleve_examen` (`id`, `eleve_id`, `examen_id`, `note_obtenu`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 21, 1, 49, '2022-09-02 04:48:33', '2022-09-02 04:48:34', NULL),
	(2, 21, 2, 32, '2022-09-02 04:48:52', '2022-09-02 04:48:53', NULL),
	(3, 21, 3, 13, '2022-09-02 04:49:18', '2022-09-02 04:49:20', NULL),
	(4, 21, 4, 30, '2022-09-02 04:49:38', '2022-09-02 04:49:39', NULL),
	(18, 2, 8, 0, NULL, NULL, NULL),
	(19, 3, 8, 0, NULL, NULL, NULL),
	(20, 4, 8, 0, NULL, NULL, NULL),
	(21, 5, 8, 0, NULL, NULL, NULL),
	(22, 6, 8, 0, NULL, NULL, NULL),
	(23, 7, 8, 0, NULL, NULL, NULL),
	(24, 8, 8, 0, NULL, NULL, NULL),
	(25, 9, 8, 0, NULL, NULL, NULL),
	(26, 10, 8, 0, NULL, NULL, NULL),
	(27, 17, 8, 0, NULL, NULL, NULL),
	(28, 21, 8, 36, NULL, NULL, NULL),
	(29, 22, 8, 0, NULL, NULL, NULL),
	(30, 23, 8, 0, NULL, NULL, NULL),
	(31, 2, 9, 0, NULL, NULL, NULL),
	(32, 3, 9, 0, NULL, NULL, NULL),
	(33, 4, 9, 0, NULL, NULL, NULL),
	(34, 5, 9, 0, NULL, NULL, NULL),
	(35, 6, 9, 0, NULL, NULL, NULL),
	(36, 7, 9, 0, NULL, NULL, NULL),
	(37, 8, 9, 0, NULL, NULL, NULL),
	(38, 9, 9, 0, NULL, NULL, NULL),
	(39, 10, 9, 0, NULL, NULL, NULL),
	(40, 17, 9, 0, NULL, NULL, NULL),
	(41, 21, 9, 26, NULL, NULL, NULL),
	(42, 22, 9, 0, NULL, NULL, NULL),
	(43, 23, 9, 0, NULL, NULL, NULL),
	(44, 2, 10, 0, NULL, NULL, NULL),
	(45, 3, 10, 0, NULL, NULL, NULL),
	(46, 4, 10, 0, NULL, NULL, NULL),
	(47, 5, 10, 0, NULL, NULL, NULL),
	(48, 6, 10, 0, NULL, NULL, NULL),
	(49, 7, 10, 0, NULL, NULL, NULL),
	(50, 8, 10, 0, NULL, NULL, NULL),
	(51, 9, 10, 0, NULL, NULL, NULL),
	(52, 10, 10, 0, NULL, NULL, NULL),
	(53, 17, 10, 0, NULL, NULL, NULL),
	(54, 21, 10, 14, NULL, NULL, NULL),
	(55, 22, 10, 0, NULL, NULL, NULL),
	(56, 23, 10, 0, NULL, NULL, NULL),
	(57, 2, 11, 0, NULL, NULL, NULL),
	(58, 3, 11, 0, NULL, NULL, NULL),
	(59, 4, 11, 0, NULL, NULL, NULL),
	(60, 5, 11, 0, NULL, NULL, NULL),
	(61, 6, 11, 0, NULL, NULL, NULL),
	(62, 7, 11, 0, NULL, NULL, NULL),
	(63, 8, 11, 0, NULL, NULL, NULL),
	(64, 9, 11, 0, NULL, NULL, NULL),
	(65, 10, 11, 0, NULL, NULL, NULL),
	(66, 17, 11, 0, NULL, NULL, NULL),
	(67, 21, 11, 36, NULL, NULL, NULL),
	(68, 22, 11, 0, NULL, NULL, NULL),
	(69, 23, 11, 0, NULL, NULL, NULL),
	(70, 2, 12, 0, NULL, NULL, NULL),
	(71, 3, 12, 0, NULL, NULL, NULL),
	(72, 4, 12, 0, NULL, NULL, NULL),
	(73, 5, 12, 0, NULL, NULL, NULL),
	(74, 6, 12, 0, NULL, NULL, NULL),
	(75, 7, 12, 0, NULL, NULL, NULL),
	(76, 8, 12, 0, NULL, NULL, NULL),
	(77, 9, 12, 0, NULL, NULL, NULL),
	(78, 10, 12, 0, NULL, NULL, NULL),
	(79, 17, 12, 0, NULL, NULL, NULL),
	(80, 21, 12, 35, NULL, NULL, NULL),
	(81, 22, 12, 0, NULL, NULL, NULL),
	(82, 23, 12, 0, NULL, NULL, NULL),
	(83, 2, 13, 0, NULL, NULL, NULL),
	(84, 3, 13, 0, NULL, NULL, NULL),
	(85, 4, 13, 0, NULL, NULL, NULL),
	(86, 5, 13, 0, NULL, NULL, NULL),
	(87, 6, 13, 0, NULL, NULL, NULL),
	(88, 7, 13, 0, NULL, NULL, NULL),
	(89, 8, 13, 0, NULL, NULL, NULL),
	(90, 9, 13, 0, NULL, NULL, NULL),
	(91, 10, 13, 0, NULL, NULL, NULL),
	(92, 17, 13, 0, NULL, NULL, NULL),
	(93, 21, 13, 32, NULL, NULL, NULL),
	(94, 22, 13, 0, NULL, NULL, NULL),
	(95, 23, 13, 0, NULL, NULL, NULL),
	(96, 2, 14, 0, NULL, NULL, NULL),
	(97, 3, 14, 0, NULL, NULL, NULL),
	(98, 4, 14, 0, NULL, NULL, NULL),
	(99, 5, 14, 0, NULL, NULL, NULL),
	(100, 6, 14, 0, NULL, NULL, NULL),
	(101, 7, 14, 0, NULL, NULL, NULL),
	(102, 8, 14, 0, NULL, NULL, NULL),
	(103, 9, 14, 0, NULL, NULL, NULL),
	(104, 10, 14, 0, NULL, NULL, NULL),
	(105, 17, 14, 0, NULL, NULL, NULL),
	(106, 21, 14, 30, NULL, NULL, NULL),
	(107, 22, 14, 0, NULL, NULL, NULL),
	(108, 23, 14, 0, NULL, NULL, NULL),
	(109, 2, 15, 0, NULL, NULL, NULL),
	(110, 3, 15, 0, NULL, NULL, NULL),
	(111, 4, 15, 0, NULL, NULL, NULL),
	(112, 5, 15, 0, NULL, NULL, NULL),
	(113, 6, 15, 0, NULL, NULL, NULL),
	(114, 7, 15, 0, NULL, NULL, NULL),
	(115, 8, 15, 0, NULL, NULL, NULL),
	(116, 9, 15, 0, NULL, NULL, NULL),
	(117, 10, 15, 0, NULL, NULL, NULL),
	(118, 17, 15, 0, NULL, NULL, NULL),
	(119, 21, 15, 21, NULL, NULL, NULL),
	(120, 22, 15, 0, NULL, NULL, NULL),
	(121, 23, 15, 0, NULL, NULL, NULL),
	(122, 2, 16, 0, NULL, NULL, NULL),
	(123, 3, 16, 0, NULL, NULL, NULL),
	(124, 4, 16, 0, NULL, NULL, NULL),
	(125, 5, 16, 0, NULL, NULL, NULL),
	(126, 6, 16, 0, NULL, NULL, NULL),
	(127, 7, 16, 0, NULL, NULL, NULL),
	(128, 8, 16, 0, NULL, NULL, NULL),
	(129, 9, 16, 0, NULL, NULL, NULL),
	(130, 10, 16, 0, NULL, NULL, NULL),
	(131, 17, 16, 0, NULL, NULL, NULL),
	(132, 21, 16, 18, NULL, NULL, NULL),
	(133, 22, 16, 0, NULL, NULL, NULL),
	(134, 23, 16, 0, NULL, NULL, NULL),
	(135, 2, 17, 0, NULL, NULL, NULL),
	(136, 3, 17, 0, NULL, NULL, NULL),
	(137, 4, 17, 0, NULL, NULL, NULL),
	(138, 5, 17, 0, NULL, NULL, NULL),
	(139, 6, 17, 0, NULL, NULL, NULL),
	(140, 7, 17, 0, NULL, NULL, NULL),
	(141, 8, 17, 0, NULL, NULL, NULL),
	(142, 9, 17, 0, NULL, NULL, NULL),
	(143, 10, 17, 0, NULL, NULL, NULL),
	(144, 17, 17, 0, NULL, NULL, NULL),
	(145, 21, 17, 25, NULL, NULL, NULL),
	(146, 22, 17, 0, NULL, NULL, NULL),
	(147, 23, 17, 0, NULL, NULL, NULL),
	(148, 2, 18, 0, NULL, NULL, NULL),
	(149, 3, 18, 0, NULL, NULL, NULL),
	(150, 4, 18, 0, NULL, NULL, NULL),
	(151, 5, 18, 0, NULL, NULL, NULL),
	(152, 6, 18, 0, NULL, NULL, NULL),
	(153, 7, 18, 0, NULL, NULL, NULL),
	(154, 8, 18, 0, NULL, NULL, NULL),
	(155, 9, 18, 0, NULL, NULL, NULL),
	(156, 10, 18, 0, NULL, NULL, NULL),
	(157, 17, 18, 0, NULL, NULL, NULL),
	(158, 21, 18, 19, NULL, NULL, NULL),
	(159, 22, 18, 0, NULL, NULL, NULL),
	(160, 23, 18, 0, NULL, NULL, NULL),
	(161, 31, 19, 78, '2023-04-13 17:31:52', '2023-04-13 15:32:34', NULL),
	(162, 27, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(163, 25, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(164, 21, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(165, 23, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(166, 17, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(167, 22, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(168, 10, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(169, 9, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(170, 8, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(171, 7, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(172, 6, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(173, 5, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(174, 3, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(175, 2, 19, 0, '2023-04-13 17:31:53', '2023-04-13 17:31:53', NULL),
	(176, 31, 20, 0, '2023-04-13 19:05:26', '2023-04-13 19:05:26', NULL),
	(177, 27, 20, 0, '2023-04-13 19:05:26', '2023-04-13 19:05:26', NULL),
	(178, 25, 20, 0, '2023-04-13 19:05:26', '2023-04-13 19:05:26', NULL),
	(179, 21, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(180, 23, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(181, 17, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(182, 22, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(183, 10, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(184, 9, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(185, 8, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(186, 7, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(187, 6, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(188, 5, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(189, 3, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(190, 2, 20, 0, '2023-04-13 19:05:27', '2023-04-13 19:05:27', NULL),
	(191, 31, 21, 0, '2023-04-14 01:51:58', '2023-04-14 01:51:58', NULL),
	(192, 27, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(193, 25, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(194, 21, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(195, 23, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(196, 17, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(197, 22, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(198, 10, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(199, 9, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(200, 8, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(201, 7, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(202, 6, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(203, 5, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(204, 3, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(205, 2, 21, 0, '2023-04-14 01:51:59', '2023-04-14 01:51:59', NULL),
	(206, 31, 22, 0, '2023-04-14 01:52:17', '2023-04-14 01:52:17', NULL),
	(207, 27, 22, 0, '2023-04-14 01:52:17', '2023-04-14 01:52:17', NULL),
	(208, 25, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(209, 21, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(210, 23, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(211, 17, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(212, 22, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(213, 10, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(214, 9, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(215, 8, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(216, 7, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(217, 6, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(218, 5, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(219, 3, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(220, 2, 22, 0, '2023-04-14 01:52:18', '2023-04-14 01:52:18', NULL),
	(221, 34, 1, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(222, 34, 8, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(223, 34, 12, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(224, 34, 2, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(225, 34, 9, 0, '2023-04-14 01:55:51', '2023-04-14 01:55:51', NULL),
	(226, 34, 13, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(227, 34, 19, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(228, 34, 3, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(229, 34, 10, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(230, 34, 15, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(231, 34, 4, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(232, 34, 11, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(233, 34, 14, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(234, 34, 16, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(235, 34, 17, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(236, 34, 18, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(237, 34, 20, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(238, 34, 21, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL),
	(239, 34, 22, 0, '2023-04-14 01:55:52', '2023-04-14 01:55:52', NULL);
/*!40000 ALTER TABLE `eleve_examen` ENABLE KEYS */;

-- Dumping structure for table sas.eleve_parrain
CREATE TABLE IF NOT EXISTS `eleve_parrain` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned DEFAULT NULL,
  `parrain_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_parrain_eleve_id_foreign` (`eleve_id`),
  KEY `eleve_parrain_parrain_id_foreign` (`parrain_id`),
  CONSTRAINT `eleve_parrain_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `eleve_parrain_parrain_id_foreign` FOREIGN KEY (`parrain_id`) REFERENCES `parrains` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.eleve_parrain: ~0 rows (approximately)
/*!40000 ALTER TABLE `eleve_parrain` DISABLE KEYS */;
/*!40000 ALTER TABLE `eleve_parrain` ENABLE KEYS */;

-- Dumping structure for table sas.employers
CREATE TABLE IF NOT EXISTS `employers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricule` (`matricule`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.employers: ~8 rows (approximately)
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
INSERT INTO `employers` (`id`, `matricule`, `nom`, `prenom`, `date_naissance`, `sexe`, `formation`, `diplome`, `niveau_etude`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'P01/2022', 'Abraham', 'Tommy', '2000-01-12', 'M', 'Informatique', 'Licence', 'licence', '2022-08-23 22:49:59', '2022-09-11 14:08:39', NULL),
	(2, 'P02/2022', 'Lokenze', 'Nathalie', '2022-08-24', 'F', 'Aviation', 'licence', 'A0', '2022-08-24 13:28:51', '2022-09-13 07:55:41', NULL),
	(3, 'P03/2022', 'Jean-luc Mulindi', 'Gouver', '2022-04-05', 'M', 'Langue', 'Master', 'Master', '2022-08-27 05:11:47', '2023-04-13 18:56:23', NULL),
	(4, 'P04/2022', 'Tanya Molisho', 'Nickel', '2022-08-10', 'F', 'Mathematique', 'D\'Etat', 'G3', '2022-08-27 05:26:27', '2023-04-13 01:27:38', NULL),
	(5, '000/20221', 'Enseignant', 'Gouver', '2022-08-17', 'M', 'Droit Civile', 'Master', 'MCL', '2022-08-27 05:27:33', '2022-08-27 05:27:40', '2022-08-27 05:27:40'),
	(6, 'P05/2022', 'Muhoza', 'Clayton Zeptoman', '1999-06-12', 'M', 'Informatique', 'Licence', 'Master', '2022-09-13 08:21:07', '2022-09-15 15:17:44', '2022-09-15 15:17:44'),
	(8, 'P06/2022', 'Ndioni Tonobunu', 'Makunn', '2022-11-23', 'M', 'Mathematique', 'Master', 'Master', '2022-11-23 12:37:11', '2022-11-23 12:37:11', NULL),
	(9, 'P07/2023', 'Ingabire', 'Christa', '2001-05-12', 'F', 'Comptabilité', 'Licence', 'L1', '2023-04-13 01:48:13', '2023-04-13 01:48:13', NULL);
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;

-- Dumping structure for table sas.employer_fonction
CREATE TABLE IF NOT EXISTS `employer_fonction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` bigint(20) unsigned NOT NULL,
  `fonction_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table_employer_fonction_employer_id_foreign` (`employer_id`),
  KEY `table_employer_fonction_fonction_id_foreign` (`fonction_id`),
  CONSTRAINT `table_employer_fonction_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`),
  CONSTRAINT `table_employer_fonction_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.employer_fonction: ~8 rows (approximately)
/*!40000 ALTER TABLE `employer_fonction` DISABLE KEYS */;
INSERT INTO `employer_fonction` (`id`, `employer_id`, `fonction_id`, `created_at`, `updated_at`) VALUES
	(5, 5, 1, NULL, NULL),
	(11, 1, 1, NULL, NULL),
	(12, 2, 2, NULL, NULL),
	(16, 6, 9, NULL, NULL),
	(17, 8, 2, NULL, NULL),
	(19, 4, 2, NULL, NULL),
	(20, 9, 10, NULL, NULL),
	(21, 3, 11, NULL, NULL);
/*!40000 ALTER TABLE `employer_fonction` ENABLE KEYS */;

-- Dumping structure for table sas.encadrements
CREATE TABLE IF NOT EXISTS `encadrements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.encadrements: ~4 rows (approximately)
/*!40000 ALTER TABLE `encadrements` DISABLE KEYS */;
INSERT INTO `encadrements` (`id`, `user_id`, `annee_scolaire_id`, `classe_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 1, 1, '2023-04-01 15:20:12', '2023-04-01 15:20:13', NULL),
	(2, 4, 1, 2, '2023-04-01 15:20:10', '2023-04-01 15:20:11', NULL),
	(4, 6, 1, 5, '2023-04-03 08:57:59', '2023-04-03 13:03:00', NULL),
	(5, 2, 1, 8, '2023-04-13 20:34:25', '2023-04-13 18:16:00', '2023-04-13 18:16:00');
/*!40000 ALTER TABLE `encadrements` ENABLE KEYS */;

-- Dumping structure for table sas.evaluations
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_max` int(11) NOT NULL,
  `type_evaluation_id` bigint(20) unsigned DEFAULT NULL,
  `cours_id` bigint(20) unsigned DEFAULT NULL,
  `periode_id` bigint(20) unsigned DEFAULT NULL,
  `date_evaluation` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_type_evaluation_id_foreign` (`type_evaluation_id`),
  KEY `evaluations_cours_id_foreign` (`cours_id`),
  KEY `evaluations_periode_id_foreign` (`periode_id`),
  CONSTRAINT `evaluations_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `evaluations_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`),
  CONSTRAINT `evaluations_type_evaluation_id_foreign` FOREIGN KEY (`type_evaluation_id`) REFERENCES `type_evaluations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.evaluations: ~62 rows (approximately)
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` (`id`, `note_max`, `type_evaluation_id`, `cours_id`, `periode_id`, `date_evaluation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 10, 1, 1, 1, '2022-08-31', '2022-08-31 13:08:40', '2022-08-31 13:08:40', NULL),
	(2, 10, 1, 2, 1, '2022-08-31', '2022-08-31 13:09:38', '2022-08-31 13:09:39', NULL),
	(3, 5, 2, 1, 1, '2022-08-31', '2022-09-01 04:57:10', NULL, NULL),
	(4, 10, 1, 4, 2, '2022-09-01', '2022-09-01 04:56:49', NULL, NULL),
	(5, 10, 2, 3, 2, '2022-09-01', '2022-09-01 04:57:10', NULL, NULL),
	(6, 10, 3, 1, 1, '2022-09-01', '2022-09-02 05:57:08', NULL, NULL),
	(7, 10, 1, 4, 1, '2022-09-02', '2022-09-02 05:56:19', NULL, NULL),
	(8, 10, 2, 3, 1, '2022-09-02', '2022-09-02 05:56:45', NULL, NULL),
	(9, 10, 3, 1, 2, '2022-09-02', '2022-09-02 05:57:06', NULL, NULL),
	(10, 5, 2, 1, 2, '2022-09-02', '2022-09-02 05:57:30', '2022-09-02 05:57:31', NULL),
	(11, 10, 1, 2, 2, '2022-09-02', '2022-09-02 05:59:12', '2022-09-02 05:59:12', NULL),
	(12, 15, 3, 7, 1, '2022-09-03', '2022-09-03 17:29:23', '2022-09-05 12:09:03', '2022-09-05 12:09:03'),
	(13, 10, 2, 1, 6, '2022-09-05', '2022-09-05 12:10:08', '2022-09-05 12:10:24', '2022-09-05 12:10:24'),
	(29, 10, 1, 1, 6, '2022-09-05', '2022-09-05 13:43:08', '2022-09-05 13:43:08', NULL),
	(30, 10, 1, 3, 6, '2022-09-24', '2022-09-05 13:50:34', '2022-09-05 13:50:35', NULL),
	(31, 10, 1, 1, 3, '2022-04-07', '2022-09-07 08:39:17', '2022-09-07 08:39:17', NULL),
	(32, 10, 1, 3, 3, '2022-04-08', '2022-09-07 08:39:43', '2022-09-07 08:39:43', NULL),
	(33, 10, 2, 2, 3, '2022-04-09', '2022-09-07 08:40:01', '2022-09-07 08:40:01', NULL),
	(34, 10, 1, 4, 3, '2022-04-12', '2022-09-07 08:40:22', '2022-09-07 08:40:22', NULL),
	(35, 5, 2, 1, 4, '2022-05-09', '2022-09-07 08:41:03', '2022-09-07 08:41:03', NULL),
	(36, 15, 1, 1, 4, '2022-05-19', '2022-09-07 08:41:27', '2022-09-07 08:41:27', NULL),
	(37, 10, 2, 3, 4, '2022-06-12', '2022-09-07 08:41:46', '2022-09-07 08:41:46', NULL),
	(38, 10, 1, 2, 4, '2022-06-14', '2022-09-07 08:42:02', '2022-09-07 08:42:02', NULL),
	(39, 10, 3, 4, 4, '2022-06-30', '2022-09-07 08:42:20', '2022-09-07 08:42:20', NULL),
	(40, 10, 1, 1, 5, '2022-07-10', '2022-09-07 08:43:08', '2022-09-07 08:43:08', NULL),
	(41, 10, 2, 3, 5, '2022-07-20', '2022-09-07 08:43:24', '2022-09-07 08:43:24', NULL),
	(42, 10, 1, 2, 5, '2022-07-25', '2022-09-07 08:43:43', '2022-09-07 08:43:43', NULL),
	(43, 20, 1, 4, 5, '2022-07-30', '2022-09-07 08:44:09', '2022-09-07 08:44:09', NULL),
	(44, 20, 3, 2, 6, '2022-09-25', '2022-09-07 08:45:34', '2022-09-07 08:45:34', NULL),
	(45, 20, 1, 6, 6, '2022-09-30', '2022-09-07 08:46:07', '2022-09-07 08:52:36', '2022-09-07 08:52:36'),
	(46, 10, 1, 4, 6, '2022-09-23', '2022-09-07 08:52:58', '2022-09-07 08:52:58', NULL),
	(47, 10, 1, 6, 1, '2022-01-29', '2022-09-07 22:10:03', '2022-09-07 22:10:03', NULL),
	(48, 10, 1, 6, 2, '2022-02-18', '2022-09-07 22:10:26', '2022-09-07 22:10:26', NULL),
	(49, 10, 1, 6, 3, '2022-03-26', '2022-09-07 22:10:51', '2022-09-07 22:10:51', NULL),
	(50, 10, 1, 6, 4, '2022-05-08', '2022-09-07 22:11:14', '2022-09-07 22:11:14', NULL),
	(51, 10, 1, 6, 5, '2022-06-09', '2022-09-07 22:11:42', '2022-09-07 22:11:42', NULL),
	(52, 10, 3, 6, 6, '2022-08-16', '2022-09-07 22:12:03', '2022-09-07 22:12:14', NULL),
	(53, 30, 1, 1, 6, '2022-09-15', '2022-09-15 15:39:11', '2022-09-15 15:39:11', NULL),
	(54, 10, 1, 1, 1, '2022-01-06', '2022-10-25 17:00:18', '2022-10-25 17:00:18', NULL),
	(55, 10, 2, 1, 2, '2022-11-20', '2022-11-19 23:58:13', '2022-11-19 23:58:13', NULL),
	(56, 40, 2, 1, 3, '2023-02-05', '2023-02-04 14:23:04', '2023-02-04 14:23:04', NULL),
	(57, 20, 1, 2, 6, '2023-04-13', '2023-04-13 14:52:46', '2023-04-13 15:28:41', '2023-04-13 15:28:41'),
	(58, 20, 1, 6, 6, '2023-04-13', '2023-04-13 14:54:25', '2023-04-13 15:28:35', '2023-04-13 15:28:35'),
	(59, 20, 1, 6, 6, '2023-04-13', '2023-04-13 14:54:57', '2023-04-13 15:28:46', '2023-04-13 15:28:46'),
	(60, 20, 1, 6, 6, '2023-04-13', '2023-04-13 14:55:51', '2023-04-13 15:28:49', '2023-04-13 15:28:49'),
	(61, 20, 1, 6, 6, '2023-04-13', '2023-04-13 14:56:02', '2023-04-13 15:28:53', '2023-04-13 15:28:53'),
	(62, 20, 1, 2, 6, '2023-04-13', '2023-04-13 14:58:59', '2023-04-13 15:02:34', '2023-04-13 15:02:34'),
	(63, 20, 1, 2, 6, '2023-04-13', '2023-04-13 15:00:29', '2023-04-13 15:29:02', '2023-04-13 15:29:02'),
	(64, 20, 1, 2, 6, '2023-04-13', '2023-04-13 15:01:02', '2023-04-13 15:29:09', '2023-04-13 15:29:09'),
	(65, 20, 1, 2, 6, '2023-04-13', '2023-04-13 15:01:58', '2023-04-13 15:29:14', '2023-04-13 15:29:14'),
	(66, 20, 1, 1, 1, '2023-04-13', '2023-04-13 15:07:28', '2023-04-13 15:29:54', '2023-04-13 15:29:54'),
	(67, 20, 1, 2, 6, '2023-04-13', '2023-04-13 15:12:52', '2023-04-13 15:12:52', NULL),
	(68, 20, 3, 1, 6, '2023-04-13', '2023-04-13 15:17:41', '2023-04-13 15:17:41', NULL),
	(69, 10, 2, 6, 6, '2023-04-13', '2023-04-13 16:14:03', '2023-04-13 16:14:03', NULL),
	(70, 20, 1, 4, 6, '2023-04-13', '2023-04-13 16:14:35', '2023-04-13 16:14:35', NULL),
	(71, 4, 1, 9, 1, '2022-11-13', '2023-04-13 16:48:24', '2023-04-13 16:48:24', NULL),
	(72, 10, 3, 9, 2, '2022-11-05', '2023-04-13 17:04:00', '2023-04-13 17:04:00', NULL),
	(74, 20, 2, 8, 1, '2022-11-12', '2023-04-13 23:30:52', '2023-04-13 23:30:53', NULL),
	(75, 20, 1, 9, 3, '2023-04-14', '2023-04-13 23:50:14', '2023-04-13 23:50:15', NULL),
	(76, 15, 3, 9, 4, '2022-12-25', '2023-04-13 23:50:45', '2023-04-13 23:50:45', NULL),
	(77, 40, 2, 9, 5, '2023-06-08', '2023-04-13 23:51:09', '2023-04-13 23:51:09', NULL),
	(78, 20, 1, 9, 6, '2023-04-12', '2023-04-13 23:51:27', '2023-04-13 23:51:27', NULL);
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;

-- Dumping structure for table sas.examens
CREATE TABLE IF NOT EXISTS `examens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_max` int(11) NOT NULL,
  `cours_id` bigint(20) unsigned DEFAULT NULL,
  `trimestre_id` bigint(20) unsigned DEFAULT NULL,
  `date_examen` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `examens_cours_id_foreign` (`cours_id`),
  KEY `examens_trimestre_id_foreign` (`trimestre_id`),
  CONSTRAINT `examens_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `examens_trimestre_id_foreign` FOREIGN KEY (`trimestre_id`) REFERENCES `trimestres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.examens: ~19 rows (approximately)
/*!40000 ALTER TABLE `examens` DISABLE KEYS */;
INSERT INTO `examens` (`id`, `note_max`, `cours_id`, `trimestre_id`, `date_examen`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 80, 1, 1, '2022-09-02', '2022-09-02 04:46:52', '2022-09-02 04:46:55', NULL),
	(2, 40, 2, 1, '2022-09-02', '2022-09-02 04:47:11', '2022-09-02 04:47:37', NULL),
	(3, 40, 3, 1, '2022-09-02', '2022-09-02 04:47:25', '2022-09-02 04:47:26', NULL),
	(4, 40, 4, 1, '2022-09-02', '2022-09-02 04:48:01', '2022-09-06 08:40:12', NULL),
	(8, 80, 1, 3, '2022-09-05', '2022-09-05 14:37:09', '2022-09-05 15:42:52', NULL),
	(9, 40, 2, 3, '2022-09-06', '2022-09-06 08:38:55', '2022-09-06 08:42:53', NULL),
	(10, 40, 3, 3, '2022-09-06', '2022-09-06 08:42:22', '2022-09-06 08:42:22', NULL),
	(11, 40, 4, 3, '2022-09-06', '2022-09-06 08:42:44', '2022-09-06 08:42:44', NULL),
	(12, 80, 1, 2, '2022-05-11', '2022-09-06 08:43:23', '2022-09-06 08:43:23', NULL),
	(13, 40, 2, 2, '2022-05-12', '2022-09-06 08:43:41', '2022-09-06 08:43:41', NULL),
	(14, 40, 4, 2, '2022-05-13', '2022-09-06 08:43:54', '2022-09-06 08:43:54', NULL),
	(15, 40, 3, 2, '2022-05-14', '2022-09-06 08:44:46', '2022-09-06 08:44:46', NULL),
	(16, 40, 6, 1, '2022-03-09', '2022-09-07 22:24:12', '2022-09-07 22:25:54', NULL),
	(17, 40, 6, 2, '2022-04-08', '2022-09-07 22:24:26', '2022-09-07 22:26:04', NULL),
	(18, 40, 6, 3, '2022-08-08', '2022-09-07 22:24:40', '2022-09-07 22:26:13', NULL),
	(19, 80, 2, 3, '2023-04-13', '2023-04-13 15:31:52', '2023-04-24 01:06:24', '2023-04-24 01:06:24'),
	(20, 20, 9, 1, '2022-12-15', '2023-04-13 17:05:26', '2023-04-13 17:05:26', NULL),
	(21, 40, 9, 2, '2023-04-15', '2023-04-13 23:51:58', '2023-04-13 23:51:58', NULL),
	(22, 20, 9, 3, '2023-04-13', '2023-04-13 23:52:17', '2023-04-13 23:52:17', NULL);
/*!40000 ALTER TABLE `examens` ENABLE KEYS */;

-- Dumping structure for table sas.failed_jobs
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

-- Dumping data for table sas.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table sas.fonctions
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.fonctions: ~11 rows (approximately)
/*!40000 ALTER TABLE `fonctions` DISABLE KEYS */;
INSERT INTO `fonctions` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', '2022-08-23 22:48:42', '2022-08-23 22:48:42', NULL),
	(2, 'Enseignant', '2022-08-24 17:04:55', '2022-08-24 17:04:56', NULL),
	(3, 'Directeur de Discipline', '2022-08-26 12:19:10', '2023-04-13 01:11:54', '2023-04-13 01:11:54'),
	(4, 'Proviseur', '2022-08-26 12:20:36', '2022-09-03 11:38:57', NULL),
	(5, 'Prefet', '2022-08-26 12:21:09', '2022-08-26 12:21:09', NULL),
	(6, 'Zamu', '2022-08-27 02:42:35', '2022-08-27 02:59:34', '2022-08-27 02:59:34'),
	(7, 'Ingenieure de son', '2022-08-27 03:00:11', '2022-08-27 03:00:15', '2022-08-27 03:00:15'),
	(8, 'Ouvrier', '2022-09-11 14:43:28', '2022-09-11 14:43:28', NULL),
	(9, 'Informaticien', '2022-09-13 08:19:48', '2022-09-13 08:19:48', NULL),
	(10, 'Secretaire', '2023-04-13 01:12:11', '2023-04-13 01:12:11', NULL),
	(11, 'Directeur', '2023-04-13 18:54:32', '2023-04-13 18:54:32', NULL);
/*!40000 ALTER TABLE `fonctions` ENABLE KEYS */;

-- Dumping structure for table sas.frais
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.frais: ~18 rows (approximately)
/*!40000 ALTER TABLE `frais` DISABLE KEYS */;
INSERT INTO `frais` (`id`, `nom`, `montant`, `niveau_id`, `type_frais_id`, `mode_paiement_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Prime Scolaire', 240, 1, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(3, 'Prime Scolaire', 240, 2, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(4, 'Prime Scolaire', 240, 3, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(5, 'Prime Scolaire', 240, 4, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(6, 'Prime Scolaire', 240, 5, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(7, 'Prime Scolaire', 240, 6, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(8, 'Prime Scolaire', 240, 7, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(9, 'Prime Scolaire', 240, 8, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:03', NULL),
	(10, 'Prime Scolaire', 240, 9, 1, 2, '2023-04-17 16:37:03', '2023-04-17 16:37:04', NULL),
	(11, 'Frais Divers', 10000, 1, 2, 1, '2023-04-19 00:13:04', '2023-04-19 00:13:04', NULL),
	(12, 'Frais Divers', 10000, 2, 2, 1, '2023-04-19 00:13:04', '2023-04-19 00:13:04', NULL),
	(13, 'Frais Divers', 10000, 3, 2, 1, '2023-04-19 00:13:04', '2023-04-19 00:13:05', NULL),
	(14, 'Frais Divers', 10000, 4, 2, 1, '2023-04-19 00:13:05', '2023-04-19 00:13:05', NULL),
	(15, 'Frais Divers', 10000, 5, 2, 1, '2023-04-19 00:13:05', '2023-04-19 00:13:05', NULL),
	(16, 'Frais Divers', 10000, 6, 2, 1, '2023-04-19 00:13:05', '2023-04-19 00:13:05', NULL),
	(17, 'Frais Divers', 10000, 7, 2, 1, '2023-04-19 00:13:05', '2023-04-19 00:13:05', NULL),
	(18, 'Frais Divers', 10000, 8, 2, 1, '2023-04-19 00:13:05', '2023-04-19 00:13:05', NULL),
	(19, 'Frais Divers', 10000, 9, 2, 1, '2023-04-19 00:13:05', '2023-04-19 00:13:05', NULL);
/*!40000 ALTER TABLE `frais` ENABLE KEYS */;

-- Dumping structure for table sas.frequentations
CREATE TABLE IF NOT EXISTS `frequentations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.frequentations: ~28 rows (approximately)
/*!40000 ALTER TABLE `frequentations` DISABLE KEYS */;
INSERT INTO `frequentations` (`id`, `eleve_id`, `classe_id`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, '2022-08-29 00:01:16', '2022-08-29 00:01:16', NULL),
	(2, 2, 1, 1, '2022-08-29 00:01:35', '2022-08-29 00:01:35', NULL),
	(3, 3, 1, 1, '2022-08-29 00:01:45', '2022-08-29 00:01:45', NULL),
	(4, 4, 1, 1, '2022-08-29 00:01:57', '2022-08-29 00:01:57', NULL),
	(5, 5, 1, 1, '2022-08-29 00:02:04', '2022-08-29 00:02:04', NULL),
	(6, 6, 1, 1, '2022-08-29 00:02:22', '2022-08-29 00:02:26', NULL),
	(7, 7, 1, 1, '2022-08-29 00:02:48', '2022-08-29 00:02:49', NULL),
	(8, 8, 1, 1, '2022-08-29 00:02:57', '2022-08-29 00:02:57', NULL),
	(9, 9, 1, 1, '2022-08-29 00:03:04', '2022-08-29 00:03:05', NULL),
	(10, 10, 1, 1, '2022-08-29 00:03:12', '2022-08-29 00:03:12', NULL),
	(13, 22, 1, 1, '2022-08-29 02:33:16', '2022-08-29 02:33:16', NULL),
	(14, 17, 1, 1, '2022-08-29 20:50:43', '2022-08-29 20:50:45', NULL),
	(15, 23, 1, 1, '2022-08-31 10:51:13', '2022-08-31 10:51:13', NULL),
	(18, 21, 1, 1, '2022-09-03 17:17:09', '2022-09-03 17:40:10', NULL),
	(19, 20, 8, 1, '2022-09-03 17:41:16', '2022-09-03 17:41:16', NULL),
	(20, 24, 2, 1, '2022-09-09 17:02:01', '2022-09-09 17:02:01', NULL),
	(21, 25, 1, 1, '2022-09-15 15:15:34', '2022-09-15 15:15:34', NULL),
	(22, 27, 5, 3, '2022-11-19 12:22:58', '2022-11-21 07:44:54', NULL),
	(23, 27, 1, 1, '2022-11-21 07:44:24', '2022-11-21 07:44:24', NULL),
	(24, 28, 8, 1, '2023-02-03 16:04:22', '2023-02-03 16:04:22', NULL),
	(25, 29, 9, 1, '2023-02-03 16:07:11', '2023-02-03 16:07:11', NULL),
	(26, 30, 10, 1, '2023-04-02 11:50:38', '2023-04-02 11:50:38', NULL),
	(27, 31, 1, 1, '2023-04-13 00:40:07', '2023-04-13 00:40:07', NULL),
	(28, 32, 5, 1, '2023-04-13 14:29:55', '2023-04-13 14:29:55', NULL),
	(29, 33, 5, 1, '2023-04-13 23:47:46', '2023-04-13 23:47:46', NULL),
	(30, 34, 1, 1, '2023-04-13 23:55:53', '2023-04-13 23:55:53', NULL),
	(31, 15, 8, 1, '2023-04-14 15:14:34', '2023-04-14 15:14:34', NULL),
	(32, 21, 5, 3, '2023-04-19 00:57:06', '2023-04-19 00:57:06', NULL);
/*!40000 ALTER TABLE `frequentations` ENABLE KEYS */;

-- Dumping structure for table sas.messages
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.messages: ~8 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `objet`, `contenu`, `expediteur`, `destinateur`, `created_at`, `updated_at`, `read_at`, `deleted_at`) VALUES
	(3, 'Test Message', 'Dui velit libero semper lobortis ante, felis accumsan mi proin, aliquet donec phasellus sem. Malesuada primis nunc hac arcu nam suspendisse per, consequat pulvinar habitasse sociosqu eu posuere tellus id, curae donec sed lacinia tempus lobortis.', 5, 8, '2023-04-16 23:26:34', '2023-04-17 11:44:39', '2023-04-17 11:44:39', NULL),
	(4, 'Test Message', 'Dui velit libero semper lobortis ante, felis accumsan mi proin, aliquet donec phasellus sem. Malesuada primis nunc hac arcu nam suspendisse per, consequat pulvinar habitasse sociosqu eu posuere tellus id, curae donec sed lacinia tempus lobortis.', 5, 10, '2023-04-16 23:26:34', '2023-04-16 23:26:34', NULL, NULL),
	(5, 'Communication Test', 'Lorem ipsum dolor sit amet consectetur adipiscing elit lectus neque dignissim aenean, ultricies magnis tincidunt dictum class tortor sociis senectus congue cum potenti, sollicitudin arcu vel ornare tempor et imperdiet nulla at erat. Porttitor pulvinar mollis torquent facilisis mattis semper arcu id tempor fames, faucibus pellentesque varius mi commodo primis odio enim augue risus, metus potenti parturient montes eu porta nostra fringilla sem.', 8, 5, '2023-04-16 23:42:38', '2023-04-24 01:45:11', '2023-04-24 01:45:11', NULL),
	(6, 'Tuna sema', '<span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Messages</span>\r\n                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">10</span>', 5, 8, '2023-04-17 00:16:35', '2023-04-17 11:41:04', '2023-04-17 11:41:04', NULL),
	(7, 'Tuna sema', '<span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Messages</span>\r\n                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">10</span>', 5, 10, '2023-04-17 00:16:35', '2023-04-17 00:16:35', NULL, NULL),
	(8, 'Paiement Frais Scolaires', 'Bytes\r\nLists\r\nRich TextHTML\r\nCopy\r\nLorem ipsum dolor sit amet consectetur adipiscing elit netus semper ultricies quisque, eu eros himenaeos odio nullam vel praesent pharetra ante malesuada penatibus, accumsan elementum hac dis arcu platea nec quam aptent luctus. Cubilia litora libero phasellus mollis tempus augue mattis, porttitor dis dignissim lectus nisi nulla hac conubia, nullam aliquam tortor faucibus luctus facilisis. Laoreet donec erat taciti ad mollis, aenean fermentum nostra. Enim at natoque parturient nisl velit vehicula curae suspendisse tempus, himenaeos vulputate gravida nam egestas euismod lacus nostra aptent, in eu luctus convallis vestibulum sapien netus rhoncus', 5, 8, '2023-04-17 11:43:31', '2023-04-17 13:15:03', '2023-04-17 13:15:03', NULL),
	(9, 'Paiement Frais Scolaires', 'Bytes\r\nLists\r\nRich TextHTML\r\nCopy\r\nLorem ipsum dolor sit amet consectetur adipiscing elit netus semper ultricies quisque, eu eros himenaeos odio nullam vel praesent pharetra ante malesuada penatibus, accumsan elementum hac dis arcu platea nec quam aptent luctus. Cubilia litora libero phasellus mollis tempus augue mattis, porttitor dis dignissim lectus nisi nulla hac conubia, nullam aliquam tortor faucibus luctus facilisis. Laoreet donec erat taciti ad mollis, aenean fermentum nostra. Enim at natoque parturient nisl velit vehicula curae suspendisse tempus, himenaeos vulputate gravida nam egestas euismod lacus nostra aptent, in eu luctus convallis vestibulum sapien netus rhoncus', 5, 10, '2023-04-17 11:43:32', '2023-04-17 11:43:32', NULL, NULL),
	(10, 'Demande De Derogation', 'sagittis. Massa rhoncus sed risus primis fames non parturient, molestie scelerisque nullam nibh feugiat convallis, dictum interdum proin malesuada suspendisse sagittis. Ullamcorper', 8, 5, '2023-04-17 13:22:15', '2023-04-24 01:45:01', '2023-04-24 01:45:01', NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table sas.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.migrations: ~76 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2013_08_23_182726_create_fonctions_table', 1),
	(2, '2013_08_23_183016_create_employers_table', 1),
	(3, '2013_08_23_185610_create_table_employer_fonction', 1),
	(4, '2014_10_12_000000_create_users_table', 1),
	(5, '2014_10_12_100000_create_password_resets_table', 1),
	(6, '2019_08_19_000000_create_failed_jobs_table', 1),
	(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(8, '2022_08_23_191212_create_classes_table', 1),
	(9, '2022_08_23_191630_create_categorie_cours_table', 1),
	(10, '2022_08_23_191720_create_cours_table', 1),
	(11, '2022_08_23_194802_create_annee_scolaires_table', 1),
	(12, '2022_08_23_194907_create_eleves_table', 1),
	(13, '2022_08_23_195235_create_frequentations_table', 1),
	(14, '2022_08_23_200306_create_trimestres_table', 1),
	(15, '2022_08_23_200340_create_periodes_table', 1),
	(16, '2022_08_23_200341_create_type_evaluations_table', 1),
	(17, '2022_08_23_201355_create_evaluations_table', 1),
	(18, '2022_08_23_201737_create_table_eleve_evaluation', 1),
	(19, '2022_08_23_203051_create_examens_table', 1),
	(20, '2022_08_23_203528_create_table_eleve_examen', 1),
	(21, '2022_08_24_111241_add_column_matricule_on_employer', 2),
	(22, '2022_08_24_111435_add_column_matricule_on_employer', 3),
	(23, '2022_08_25_123813_add_is_current_on_table_annee_scolaire', 4),
	(24, '2022_08_27_023021_add_softdelete_to_table_fonctions', 5),
	(25, '2022_08_27_030641_add_softdelete_to_table_fonctions', 6),
	(26, '2022_08_28_212124_add_softdeletes_to_table_eleves', 7),
	(27, '2022_08_29_015735_add_softdeletes_to_frequentations', 8),
	(28, '2022_08_29_020410_add_softdeletes_to_frequentations', 9),
	(29, '2022_08_29_212546_add_softdeletes_to_annee_scolaire', 10),
	(30, '2022_08_29_212709_add_softdeletes_to_trimestres', 10),
	(31, '2022_08_29_212754_add_softdeletes_to_periodes', 10),
	(32, '2022_08_29_213054_add_softdeletes_to_evaluations', 10),
	(33, '2022_08_29_213136_add_softdeletes_to_type_evaluations', 10),
	(34, '2022_08_29_213206_add_softdeletes_to_examens', 10),
	(35, '2022_08_29_213339_add_softdeletes_to_categorie_cours', 10),
	(36, '2022_08_29_213404_add_softdeletes_to_cours', 10),
	(37, '2022_08_29_213442_add_softdeletes_to_eleve_evaluation', 10),
	(38, '2022_08_29_213520_add_softdeletes_to_eleve_examen', 10),
	(39, '2022_08_29_214039_add_softdeletes_to_classe', 10),
	(40, '2022_08_29_214507_add_softdeletes_to_classe', 11),
	(41, '2022_08_29_214601_add_softdeletes_to_classe', 12),
	(42, '2022_08_29_214742_add_softdeletes_to_annee_scolaire', 13),
	(43, '2022_08_29_214848_add_softdeletes_to_trimestres', 13),
	(44, '2022_08_29_214922_add_softdeletes_to_periodes', 13),
	(45, '2022_08_29_214953_add_softdeletes_to_evaluations', 13),
	(46, '2022_08_29_215017_add_softdeletes_to_type_evaluations', 13),
	(47, '2022_08_29_215039_add_softdeletes_to_examens', 13),
	(48, '2022_08_29_215105_add_softdeletes_to_categorie_cours', 13),
	(49, '2022_08_29_215127_add_softdeletes_to_cours', 13),
	(50, '2022_08_29_215146_add_softdeletes_to_eleve_evaluation', 13),
	(51, '2022_08_29_215211_add_softdeletes_to_eleve_examen', 13),
	(52, '2022_08_30_051752_create_table_classe', 14),
	(53, '2022_08_30_052014_create_table_classe', 15),
	(54, '2022_09_03_091436_update_pivot_table_eleve_evaluation', 16),
	(55, '2022_10_25_214742_add_selected_to_annee_scolaire', 17),
	(57, '2022_11_19_138050_add_sexe_to_table_eleve', 19),
	(58, '2022_11_23_230530_add_soft_deletes_on_table_user', 20),
	(61, '2023_04_01_122818_create_table_encadrement', 21),
	(62, '2023_04_01_122854_create_table_niveau', 21),
	(63, '2023_04_01_123506_add_niveau_id_to_classes', 22),
	(64, '2023_04_07_154345_create_table_conduites', 23),
	(68, '2023_04_07_155226_create_table_eleve_conduite', 24),
	(71, '2023_04_10_134823_create_parent_table', 25),
	(72, '2023_04_10_135244_create_eleve_parent_table', 25),
	(73, '2023_04_11_074121_add_parrain_to_eleves', 26),
	(74, '2023_04_12_095545_add_id_parrain_to_user', 27),
	(75, '2023_04_16_141937_create_resultats_table', 28),
	(76, '2023_04_16_143659_create_type_frais_table', 28),
	(77, '2023_04_16_143741_create_mode_paiements_tables', 28),
	(78, '2023_04_16_143755_create_frais_table', 28),
	(79, '2023_04_16_143817_create_moyen_paiements_table', 28),
	(80, '2023_04_16_143909_create_paiement_frais_table', 28),
	(81, '2023_04_16_143945_create_messages_table', 28),
	(82, '2023_04_18_120107_add_frais_id_to_paiements', 29),
	(83, '2023_04_18_120110_add_date_id_to_paiements', 30),
	(84, '2023_04_18_133329_add_frequentation_id_to_paiements', 31);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table sas.mode_paiements
CREATE TABLE IF NOT EXISTS `mode_paiements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.mode_paiements: ~3 rows (approximately)
/*!40000 ALTER TABLE `mode_paiements` DISABLE KEYS */;
INSERT INTO `mode_paiements` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'ANNUEL', '2023-04-16 17:47:28', '2023-04-16 17:47:29', NULL),
	(2, 'TRIMESTRIEL', '2023-04-16 17:47:38', '2023-04-16 17:47:39', NULL),
	(3, 'MENSUEL', NULL, NULL, NULL);
/*!40000 ALTER TABLE `mode_paiements` ENABLE KEYS */;

-- Dumping structure for table sas.moyen_paiements
CREATE TABLE IF NOT EXISTS `moyen_paiements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.moyen_paiements: ~2 rows (approximately)
/*!40000 ALTER TABLE `moyen_paiements` DISABLE KEYS */;
INSERT INTO `moyen_paiements` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'CAISSE', '2023-04-16 17:38:01', '2023-04-16 17:38:01', NULL),
	(2, 'BANQUE', '2023-04-16 17:38:42', '2023-04-16 17:38:43', NULL);
/*!40000 ALTER TABLE `moyen_paiements` ENABLE KEYS */;

-- Dumping structure for table sas.niveaux
CREATE TABLE IF NOT EXISTS `niveaux` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.niveaux: ~9 rows (approximately)
/*!40000 ALTER TABLE `niveaux` DISABLE KEYS */;
INSERT INTO `niveaux` (`id`, `nom`, `numerotation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIERE ANNEE MATERNELLE', 1, '2023-04-01 14:46:08', '2023-04-01 14:46:09', NULL),
	(2, 'DEUXIEME ANNEE MATERNELLE', 2, '2023-04-01 14:46:26', '2023-04-01 14:46:27', NULL),
	(3, 'TROISIEME ANNEE MATERNELLE', 3, '2023-04-01 14:46:48', '2023-04-01 14:46:48', NULL),
	(4, 'PREMIERE ANNEE PRIMAIRE', 1, '2023-04-01 14:47:07', '2023-04-01 14:47:08', NULL),
	(5, 'DEUXIEME ANNEE PRIMAIRE', 2, '2023-04-01 14:47:27', '2023-04-01 14:47:28', NULL),
	(6, 'TROISIEME ANNEE PRIMAIRE', 3, '2023-04-01 15:16:44', '2023-04-01 15:16:44', NULL),
	(7, 'QUATRIEME ANNEE PRIMAIRE', 4, '2023-04-01 15:17:04', '2023-04-01 15:17:05', NULL),
	(8, 'CINQUIME ANNEE PRIMAIRE', 5, '2023-04-01 15:17:20', '2023-04-01 15:17:21', NULL),
	(9, 'SIXIEMEN ANNEE PRIMAIRE', 6, '2023-04-01 15:17:31', '2023-04-01 15:17:31', NULL);
/*!40000 ALTER TABLE `niveaux` ENABLE KEYS */;

-- Dumping structure for table sas.paiement_frais
CREATE TABLE IF NOT EXISTS `paiement_frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `montant_paye` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `frequentation_id` bigint(20) unsigned DEFAULT NULL,
  `moyen_paiement_id` bigint(20) unsigned DEFAULT NULL,
  `frais_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiement_frais_moyen_paiement_id_foreign` (`moyen_paiement_id`),
  KEY `paiement_frais_frais_id_foreign` (`frais_id`),
  KEY `paiement_frais_frequentation_id_foreign` (`frequentation_id`),
  CONSTRAINT `paiement_frais_frais_id_foreign` FOREIGN KEY (`frais_id`) REFERENCES `frais` (`id`),
  CONSTRAINT `paiement_frais_frequentation_id_foreign` FOREIGN KEY (`frequentation_id`) REFERENCES `frequentations` (`id`),
  CONSTRAINT `paiement_frais_moyen_paiement_id_foreign` FOREIGN KEY (`moyen_paiement_id`) REFERENCES `moyen_paiements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.paiement_frais: ~4 rows (approximately)
/*!40000 ALTER TABLE `paiement_frais` DISABLE KEYS */;
INSERT INTO `paiement_frais` (`id`, `montant_paye`, `reference`, `date`, `frequentation_id`, `moyen_paiement_id`, `frais_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(4, 150, 'ref : 120201', '2023-04-18', 18, 2, 6, '2023-04-18 13:35:14', '2023-04-18 13:35:15', NULL),
	(5, 5000, 'ref : 120201', '2023-04-19', 18, 1, 15, '2023-04-19 00:17:30', '2023-04-19 00:17:30', NULL),
	(6, 95, 'ref : 1202058', '2023-04-19', 18, 2, 6, '2023-04-19 01:44:52', '2023-04-19 01:44:52', NULL),
	(7, 4000, '00', '2023-04-19', 18, 1, 15, '2023-04-19 01:45:25', '2023-04-19 01:45:25', NULL);
/*!40000 ALTER TABLE `paiement_frais` ENABLE KEYS */;

-- Dumping structure for table sas.parrains
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.parrains: ~2 rows (approximately)
/*!40000 ALTER TABLE `parrains` DISABLE KEYS */;
INSERT INTO `parrains` (`id`, `nom`, `prenom`, `sexe`, `telephone`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'Mulindi', 'Jean Bavon', 'M', '+243971355590', '2023-04-12 10:36:45', '2023-04-12 10:36:45', NULL),
	(4, 'masumbuko', 'muderhwa', 'M', '+243971355590', '2023-04-13 14:38:00', '2023-04-13 14:38:00', NULL);
/*!40000 ALTER TABLE `parrains` ENABLE KEYS */;

-- Dumping structure for table sas.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table sas.periodes
CREATE TABLE IF NOT EXISTS `periodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `trimestre_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periodes_trimestre_id_foreign` (`trimestre_id`),
  CONSTRAINT `periodes_trimestre_id_foreign` FOREIGN KEY (`trimestre_id`) REFERENCES `trimestres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.periodes: ~7 rows (approximately)
/*!40000 ALTER TABLE `periodes` DISABLE KEYS */;
INSERT INTO `periodes` (`id`, `nom`, `date_debut`, `date_fin`, `trimestre_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIERE PERIODE', '2022-09-02', '2022-10-20', 1, '2022-08-24 17:10:38', '2022-11-17 21:14:32', NULL),
	(2, 'DEUXIEME PERIODE', '2022-10-21', '2022-12-11', 1, '2022-08-24 17:10:37', '2022-11-17 22:12:17', NULL),
	(3, 'TROISIEME PERIODE', '2022-12-12', '2023-01-30', 2, '2022-08-24 17:11:07', '2022-11-17 21:19:29', NULL),
	(4, 'QUATRIEME PERIODE', '2023-01-31', '2023-03-21', 2, '2022-08-24 17:11:31', '2022-11-17 21:19:42', NULL),
	(5, 'CINQUIME PERIODE', '2023-03-22', '2022-05-10', 3, '2022-08-24 17:11:49', '2022-11-17 21:21:47', NULL),
	(6, 'SIXIEME PERIODE', '2023-05-11', '2023-07-20', 3, '2022-08-24 17:12:04', '2022-11-17 21:22:25', NULL),
	(7, 'PREMIERE PERIODE', '2000-01-12', '2022-01-12', 7, '2022-08-30 05:30:41', '2022-11-17 22:21:21', '2022-11-17 22:21:21');
/*!40000 ALTER TABLE `periodes` ENABLE KEYS */;

-- Dumping structure for table sas.personal_access_tokens
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

-- Dumping data for table sas.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table sas.resultats
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
  `frequentation_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resultats_frequentation_id_foreign` (`frequentation_id`),
  CONSTRAINT `resultats_frequentation_id_foreign` FOREIGN KEY (`frequentation_id`) REFERENCES `frequentations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.resultats: ~0 rows (approximately)
/*!40000 ALTER TABLE `resultats` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultats` ENABLE KEYS */;

-- Dumping structure for table sas.trimestres
CREATE TABLE IF NOT EXISTS `trimestres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trimestres_annee_scolaire_id_foreign` (`annee_scolaire_id`),
  CONSTRAINT `trimestres_annee_scolaire_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.trimestres: ~5 rows (approximately)
/*!40000 ALTER TABLE `trimestres` DISABLE KEYS */;
INSERT INTO `trimestres` (`id`, `nom`, `date_debut`, `date_fin`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIER TRIMESTRE', '2022-09-02', '2022-12-11', 1, '2022-08-24 17:07:52', '2022-11-19 12:30:21', NULL),
	(2, 'DEUXIEME TRIMESTRE', '2022-12-12', '2023-03-21', 1, '2022-08-24 17:08:24', '2022-11-19 12:30:27', NULL),
	(3, 'TROISIEME TRIMESTRE', '2023-03-22', '2023-07-02', 1, '2022-08-24 17:09:17', '2022-11-17 21:20:10', NULL),
	(7, 'PREMIER TRIMESTRE', '2023-01-15', '2024-04-14', 2, '2022-09-02 04:29:56', '2022-11-17 21:20:34', '2023-04-13 17:31:33'),
	(8, 'PREMIER TRIMESTRE', '2024-09-15', '2025-09-15', 3, '2022-09-15 16:03:24', '2022-11-19 13:05:07', NULL);
/*!40000 ALTER TABLE `trimestres` ENABLE KEYS */;

-- Dumping structure for table sas.type_evaluations
CREATE TABLE IF NOT EXISTS `type_evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.type_evaluations: ~4 rows (approximately)
/*!40000 ALTER TABLE `type_evaluations` DISABLE KEYS */;
INSERT INTO `type_evaluations` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Interrogation', '2022-08-31 13:07:05', '2022-08-31 13:07:06', NULL),
	(2, 'Devoir', '2022-08-31 13:07:13', '2022-08-31 13:07:14', NULL),
	(3, 'Rattrapage', '2022-09-01 06:31:57', '2022-09-01 06:31:57', NULL),
	(4, 'Evaluation Tests', '2022-09-03 14:10:02', '2022-09-03 14:16:22', '2022-09-03 14:16:22');
/*!40000 ALTER TABLE `type_evaluations` ENABLE KEYS */;

-- Dumping structure for table sas.type_frais
CREATE TABLE IF NOT EXISTS `type_frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.type_frais: ~2 rows (approximately)
/*!40000 ALTER TABLE `type_frais` DISABLE KEYS */;
INSERT INTO `type_frais` (`id`, `nom`, `devise`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'FRAIS SCOLAIRES', 'USD', '2023-04-16 17:48:40', '2023-04-16 17:48:40', NULL),
	(2, 'FRAIS DIVERS', 'CDF', '2023-04-16 17:48:51', NULL, NULL);
/*!40000 ALTER TABLE `type_frais` ENABLE KEYS */;

-- Dumping structure for table sas.users
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sas.users: ~8 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `isAdmin`, `isActive`, `employer_id`, `created_at`, `updated_at`, `deleted_at`, `parrain_id`) VALUES
	(2, 'dev.binmulindi6@gmail.com', NULL, '$2y$10$eiqD9nLmn36y86Sd528Gou8vAUnFV9Bsyv3vdy5de6rtsEhFfCgji', 'vwxILqsF9jChyQO3zO8u9H7lYSBluo4UHY9szd7sHFKZOhwuou9yGKpPuZRH', 1, 1, 1, '2022-08-23 21:00:54', '2022-08-23 21:00:54', NULL, NULL),
	(3, 'nathalie@gmail.com', NULL, '$2y$10$vPNI6fyNN2Qk7CZ6ql6W.eWL.z9PPTyjy0RP/baU611dIVT8t/IMO', NULL, 0, 1, 2, '2022-08-24 12:21:20', '2023-04-12 16:08:05', NULL, NULL),
	(4, 'jaysonmakunn@gmail.com', NULL, '$2y$10$/qrGogOzJGphKZRpEioxzuD2/0LOuosmzIPHpLziyAuYH6reJENTK', NULL, 0, 0, 8, '2022-11-23 12:39:12', '2023-04-14 22:23:26', NULL, NULL),
	(5, 'jeanlucmulindi@gmail.com', NULL, '$2y$10$nUsIZ36MIj95XxeCFEFdZuvoZACjj71vXzP.VU8VMpRjZ8UglUF7S', NULL, 0, 1, 3, '2023-04-02 13:58:19', '2023-04-13 18:58:36', NULL, NULL),
	(6, 'nickelmolisho@gmail.com', NULL, '$2y$10$EVTCnKc7AUzQnKj7DJeG2uuOrobT96xq2Un9NOUUiJHmZ5AFCsuma', NULL, 0, 1, 4, '2023-04-03 08:34:38', '2023-04-10 01:03:26', NULL, NULL),
	(8, 'mulindi@gmail.com', NULL, '$2y$10$iIbkdMP32BxEjfgWxYxLWu7i24mPxQnopLquxDyD94FRaupuDvkQC', NULL, 0, 1, NULL, '2023-04-12 10:36:45', '2023-04-16 21:52:46', NULL, 3),
	(9, 'christa@gmail.com', NULL, '$2y$10$1gNddZoCWRmEvdJH057YD.1Qm2pi4n65htyTqz15JPSe9YCtm4Y26', NULL, 0, 1, 9, '2023-04-13 01:48:51', '2023-04-13 01:49:10', NULL, NULL),
	(10, 'masumbukomuderhwa@gmail.com', NULL, '$2y$10$ym7/iFK9pj84EOvRkCW8yuCI4p2jhcDitVfzl6m6SONoxNrQt1/yW', NULL, 0, 1, NULL, '2023-04-13 14:38:01', '2023-04-13 14:38:24', NULL, 4);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
