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


-- Dumping database structure for easychik_secondaire
CREATE DATABASE IF NOT EXISTS `easychik_secondaire` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `easychik_secondaire`;

-- Dumping structure for table easychik_secondaire.annee_scolaires
CREATE TABLE IF NOT EXISTS `annee_scolaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `annee_scolaires_nom_unique` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.annee_scolaires: ~1 rows (approximately)
/*!40000 ALTER TABLE `annee_scolaires` DISABLE KEYS */;
INSERT INTO `annee_scolaires` (`id`, `nom`, `date_debut`, `date_fin`, `selected`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '2023-2024', '2023-10-04', '2024-07-02', 0, 1, '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL);
/*!40000 ALTER TABLE `annee_scolaires` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.articles
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.articles: ~0 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.categorie_articles
CREATE TABLE IF NOT EXISTS `categorie_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.categorie_articles: ~0 rows (approximately)
/*!40000 ALTER TABLE `categorie_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorie_articles` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.categorie_cours
CREATE TABLE IF NOT EXISTS `categorie_cours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.categorie_cours: ~0 rows (approximately)
/*!40000 ALTER TABLE `categorie_cours` DISABLE KEYS */;
INSERT INTO `categorie_cours` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'MATHEMATIQUES', '2023-11-03 21:27:49', '2023-11-03 21:27:49', NULL),
	(2, 'LANGUES', '2023-11-04 12:28:06', '2023-11-04 12:28:06', NULL);
/*!40000 ALTER TABLE `categorie_cours` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_id` bigint(20) unsigned DEFAULT NULL,
  `section_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_niveau_id_foreign` (`niveau_id`),
  KEY `classes_section_id_foreign` (`section_id`),
  CONSTRAINT `classes_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`),
  CONSTRAINT `classes_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.classes: ~0 rows (approximately)
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` (`id`, `nom`, `niveau_id`, `section_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'A', 1, 1, '2023-11-03 20:52:50', '2023-11-03 21:08:18', NULL),
	(2, 'A', 1, 2, '2023-11-04 14:01:41', '2023-11-04 14:01:59', NULL);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.conduites
CREATE TABLE IF NOT EXISTS `conduites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.conduites: ~0 rows (approximately)
/*!40000 ALTER TABLE `conduites` DISABLE KEYS */;
/*!40000 ALTER TABLE `conduites` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.cours
CREATE TABLE IF NOT EXISTS `cours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_periode` int(11) NOT NULL,
  `max_examen` int(11) NOT NULL,
  `categorie_cours_id` bigint(20) unsigned DEFAULT NULL,
  `niveau_id` bigint(20) unsigned DEFAULT NULL,
  `section_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_categorie_cours_id_foreign` (`categorie_cours_id`),
  KEY `cours_niveau_id_foreign` (`niveau_id`),
  KEY `cours_section_id_foreign` (`section_id`),
  CONSTRAINT `cours_categorie_cours_id_foreign` FOREIGN KEY (`categorie_cours_id`) REFERENCES `categorie_cours` (`id`),
  CONSTRAINT `cours_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`),
  CONSTRAINT `cours_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.cours: ~0 rows (approximately)
/*!40000 ALTER TABLE `cours` DISABLE KEYS */;
INSERT INTO `cours` (`id`, `nom`, `max_periode`, `max_examen`, `categorie_cours_id`, `niveau_id`, `section_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'ALGEBRE', 50, 100, 1, 1, 2, '2023-11-03 21:30:54', '2023-11-03 21:31:34', NULL),
	(2, 'FRANCAIS', 50, 100, 2, 1, 1, '2023-11-04 12:28:34', '2023-11-04 12:28:34', NULL);
/*!40000 ALTER TABLE `cours` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.eleves
CREATE TABLE IF NOT EXISTS `eleves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_permanent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Congolaise',
  `nom_pere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_mere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefession_pere` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefession_mere` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medecin_traitant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allergie_alimentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `probleme_sante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langue_maternelle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `familiers_inscrits_ici` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personne_autorise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eleves_avatar_unique` (`avatar`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.eleves: ~0 rows (approximately)
/*!40000 ALTER TABLE `eleves` DISABLE KEYS */;
INSERT INTO `eleves` (`id`, `matricule`, `avatar`, `num_permanent`, `nom`, `prenom`, `sexe`, `lieu_naissance`, `date_naissance`, `nationalite`, `nom_pere`, `nom_mere`, `prefession_pere`, `prefession_mere`, `email`, `telephone`, `medecin_traitant`, `allergie_alimentaire`, `probleme_sante`, `langue_maternelle`, `familiers_inscrits_ici`, `personne_autorise`, `adresse`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'E01/2023', NULL, '12345678', 'student', '1', 'M', 'lemera', '2012-01-12', 'Congolaise', 'Parent 1', 'Parent 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lemera', 1, '2023-11-04 14:56:21', '2023-11-04 14:56:21', NULL);
/*!40000 ALTER TABLE `eleves` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.eleve_conduites
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.eleve_conduites: ~0 rows (approximately)
/*!40000 ALTER TABLE `eleve_conduites` DISABLE KEYS */;
/*!40000 ALTER TABLE `eleve_conduites` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.eleve_evaluation
CREATE TABLE IF NOT EXISTS `eleve_evaluation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned DEFAULT NULL,
  `evaluation_id` bigint(20) unsigned DEFAULT NULL,
  `note_obtenu` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_evaluation_eleve_id_foreign` (`eleve_id`),
  KEY `eleve_evaluation_evaluation_id_foreign` (`evaluation_id`),
  CONSTRAINT `eleve_evaluation_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `eleve_evaluation_evaluation_id_foreign` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.eleve_evaluation: ~0 rows (approximately)
/*!40000 ALTER TABLE `eleve_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `eleve_evaluation` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.eleve_examen
CREATE TABLE IF NOT EXISTS `eleve_examen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) unsigned DEFAULT NULL,
  `examen_id` bigint(20) unsigned DEFAULT NULL,
  `note_obtenu` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eleve_examen_eleve_id_foreign` (`eleve_id`),
  KEY `eleve_examen_examen_id_foreign` (`examen_id`),
  CONSTRAINT `eleve_examen_eleve_id_foreign` FOREIGN KEY (`eleve_id`) REFERENCES `eleves` (`id`),
  CONSTRAINT `eleve_examen_examen_id_foreign` FOREIGN KEY (`examen_id`) REFERENCES `examens` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.eleve_examen: ~0 rows (approximately)
/*!40000 ALTER TABLE `eleve_examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `eleve_examen` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.eleve_parrain
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

-- Dumping data for table easychik_secondaire.eleve_parrain: ~0 rows (approximately)
/*!40000 ALTER TABLE `eleve_parrain` DISABLE KEYS */;
/*!40000 ALTER TABLE `eleve_parrain` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.employers
CREATE TABLE IF NOT EXISTS `employers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `etat_civil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CONGOLAISE',
  `formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employers_avatar_unique` (`avatar`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.employers: ~1 rows (approximately)
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
INSERT INTO `employers` (`id`, `matricule`, `avatar`, `nom`, `prenom`, `sexe`, `date_naissance`, `etat_civil`, `nationalite`, `formation`, `diplome`, `niveau_etude`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'P00/2022', NULL, 'System', 'Admin', 'M', '2022-09-10', NULL, 'CONGOLAISE', 'unknown', 'unknown', 'unknown', 1, '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(2, 'P01/2023', NULL, 'Big', 'Manager', 'M', '2001-01-11', NULL, 'CONGOLAISE', 'Informatique', 'Licence', 'L2', 1, '2023-11-03 21:57:42', '2023-11-03 21:57:42', NULL),
	(3, 'P02/2023', NULL, 'The', 'Teacher', 'M', '2001-12-31', NULL, 'CONGOLAISE', 'Informatique', 'Licence', 'L2', 1, '2023-11-04 10:30:03', '2023-11-04 10:30:03', NULL),
	(4, 'P03/2023', NULL, '2nd', 'Teacher', 'M', '2001-12-31', NULL, 'CONGOLAISE', 'Droit Civile', 'Doctorat', 'Aucun', 1, '2023-11-04 12:46:39', '2023-11-04 12:46:39', NULL);
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.employer_fonction
CREATE TABLE IF NOT EXISTS `employer_fonction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` bigint(20) unsigned DEFAULT NULL,
  `fonction_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_fonction_employer_id_foreign` (`employer_id`),
  KEY `employer_fonction_fonction_id_foreign` (`fonction_id`),
  CONSTRAINT `employer_fonction_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`),
  CONSTRAINT `employer_fonction_fonction_id_foreign` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.employer_fonction: ~0 rows (approximately)
/*!40000 ALTER TABLE `employer_fonction` DISABLE KEYS */;
INSERT INTO `employer_fonction` (`id`, `employer_id`, `fonction_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 7, NULL, NULL),
	(2, 3, 1, NULL, NULL),
	(3, 4, 1, NULL, NULL);
/*!40000 ALTER TABLE `employer_fonction` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.employer_presences
CREATE TABLE IF NOT EXISTS `employer_presences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` bigint(20) unsigned DEFAULT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
  `type_presence_id` bigint(20) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_presences_employer_id_foreign` (`employer_id`),
  KEY `employer_presences_annee_scolaire_id_foreign` (`annee_scolaire_id`),
  KEY `employer_presences_type_presence_id_foreign` (`type_presence_id`),
  CONSTRAINT `employer_presences_annee_scolaire_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`),
  CONSTRAINT `employer_presences_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`),
  CONSTRAINT `employer_presences_type_presence_id_foreign` FOREIGN KEY (`type_presence_id`) REFERENCES `type_presences` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.employer_presences: ~0 rows (approximately)
/*!40000 ALTER TABLE `employer_presences` DISABLE KEYS */;
/*!40000 ALTER TABLE `employer_presences` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.encadrements
CREATE TABLE IF NOT EXISTS `encadrements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `classe_id` bigint(20) unsigned DEFAULT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.encadrements: ~0 rows (approximately)
/*!40000 ALTER TABLE `encadrements` DISABLE KEYS */;
INSERT INTO `encadrements` (`id`, `user_id`, `classe_id`, `annee_scolaire_id`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 1, 1, 1, '2023-11-04 12:55:01', '2023-11-04 12:55:01', NULL);
/*!40000 ALTER TABLE `encadrements` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.enseignements
CREATE TABLE IF NOT EXISTS `enseignements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `cours_id` bigint(20) unsigned DEFAULT NULL,
  `annee_scolaire_id` bigint(20) unsigned DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enseignements_user_id_foreign` (`user_id`),
  KEY `enseignements_cours_id_foreign` (`cours_id`),
  KEY `enseignements_annee_scolaire_id_foreign` (`annee_scolaire_id`),
  CONSTRAINT `enseignements_annee_scolaire_id_foreign` FOREIGN KEY (`annee_scolaire_id`) REFERENCES `annee_scolaires` (`id`),
  CONSTRAINT `enseignements_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `enseignements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.enseignements: ~0 rows (approximately)
/*!40000 ALTER TABLE `enseignements` DISABLE KEYS */;
INSERT INTO `enseignements` (`id`, `user_id`, `cours_id`, `annee_scolaire_id`, `isActive`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 3, 1, 1, 1, '2023-11-04 11:27:55', '2023-11-04 11:27:55', NULL),
	(3, 3, 2, 1, 0, '2023-11-04 12:45:05', '2023-11-04 16:11:54', NULL),
	(4, 4, 2, 1, 1, '2023-11-04 13:52:30', '2023-11-04 16:11:54', NULL);
/*!40000 ALTER TABLE `enseignements` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.entree_articles
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.entree_articles: ~0 rows (approximately)
/*!40000 ALTER TABLE `entree_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `entree_articles` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.evaluations
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.evaluations: ~0 rows (approximately)
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.examens
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.examens: ~0 rows (approximately)
/*!40000 ALTER TABLE `examens` DISABLE KEYS */;
/*!40000 ALTER TABLE `examens` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.failed_jobs
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

-- Dumping data for table easychik_secondaire.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.fonctions
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.fonctions: ~7 rows (approximately)
/*!40000 ALTER TABLE `fonctions` DISABLE KEYS */;
INSERT INTO `fonctions` (`id`, `nom`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Enseignant', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(2, 'Secretaire', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(3, 'Comptable', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(4, 'Proviseur', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(5, 'Directeur', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(6, 'Directeur de Discipline', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL),
	(7, 'Gestionnaire', '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL);
/*!40000 ALTER TABLE `fonctions` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.frais
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.frais: ~0 rows (approximately)
/*!40000 ALTER TABLE `frais` DISABLE KEYS */;
/*!40000 ALTER TABLE `frais` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.frequentations
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.frequentations: ~0 rows (approximately)
/*!40000 ALTER TABLE `frequentations` DISABLE KEYS */;
INSERT INTO `frequentations` (`id`, `eleve_id`, `classe_id`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, '2023-11-04 14:56:29', '2023-11-04 14:56:29', NULL);
/*!40000 ALTER TABLE `frequentations` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.heures
CREATE TABLE IF NOT EXISTS `heures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `debut` time NOT NULL,
  `fin` time NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.heures: ~0 rows (approximately)
/*!40000 ALTER TABLE `heures` DISABLE KEYS */;
/*!40000 ALTER TABLE `heures` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.horaires
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.horaires: ~0 rows (approximately)
/*!40000 ALTER TABLE `horaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `horaires` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.jours
CREATE TABLE IF NOT EXISTS `jours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.jours: ~0 rows (approximately)
/*!40000 ALTER TABLE `jours` DISABLE KEYS */;
/*!40000 ALTER TABLE `jours` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.logfiles
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.logfiles: ~0 rows (approximately)
/*!40000 ALTER TABLE `logfiles` DISABLE KEYS */;
INSERT INTO `logfiles` (`id`, `table_name`, `item_id`, `event`, `done_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'sections', '2', 'Creation', 1, NULL, '2023-11-03 17:20:18', '2023-11-03 17:20:18'),
	(2, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:28:45', '2023-11-03 17:28:45'),
	(3, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:28:50', '2023-11-03 17:28:50'),
	(4, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:29:44', '2023-11-03 17:29:44'),
	(5, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:29:59', '2023-11-03 17:29:59'),
	(6, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:31:44', '2023-11-03 17:31:44'),
	(7, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:32:25', '2023-11-03 17:32:25'),
	(8, 'sections', '1', 'Modification', 1, NULL, '2023-11-03 17:32:36', '2023-11-03 17:32:36'),
	(9, 'niveaux', '1', 'Modification', 1, NULL, '2023-11-03 18:00:03', '2023-11-03 18:00:03'),
	(10, 'niveaux', '1', 'Modification', 1, NULL, '2023-11-03 18:00:20', '2023-11-03 18:00:20'),
	(11, 'classes', '1', 'Creation', 1, NULL, '2023-11-03 20:52:50', '2023-11-03 20:52:50'),
	(12, 'classes', '1', 'Modification', 1, NULL, '2023-11-03 21:08:08', '2023-11-03 21:08:08'),
	(13, 'classes', '1', 'Modification', 1, NULL, '2023-11-03 21:08:18', '2023-11-03 21:08:18'),
	(14, 'categorie_cours', '1', 'Creation', 1, NULL, '2023-11-03 21:27:49', '2023-11-03 21:27:49'),
	(15, 'cours', '1', 'Creation', 1, NULL, '2023-11-03 21:30:54', '2023-11-03 21:30:54'),
	(16, 'cours', '1', 'Modification', 1, NULL, '2023-11-03 21:31:25', '2023-11-03 21:31:25'),
	(17, 'cours', '1', 'Modification', 1, NULL, '2023-11-03 21:31:34', '2023-11-03 21:31:34'),
	(18, 'employers', '2', 'Creation', 1, NULL, '2023-11-03 21:57:42', '2023-11-03 21:57:42'),
	(19, 'users', '2', 'Creation', 1, NULL, '2023-11-03 21:58:21', '2023-11-03 21:58:21'),
	(20, 'users', '2', 'Modification', 1, NULL, '2023-11-03 21:58:25', '2023-11-03 21:58:25'),
	(21, 'employers', '3', 'Creation', 2, NULL, '2023-11-04 10:30:03', '2023-11-04 10:30:03'),
	(22, 'users', '3', 'Creation', 2, NULL, '2023-11-04 10:34:58', '2023-11-04 10:34:58'),
	(23, 'users', '3', 'Modification', 2, NULL, '2023-11-04 10:35:20', '2023-11-04 10:35:20'),
	(24, 'enseignements', '2', 'Creation', 2, NULL, '2023-11-04 11:27:55', '2023-11-04 11:27:55'),
	(25, 'users', '3', 'Modification', 2, NULL, '2023-11-04 12:16:25', '2023-11-04 12:16:25'),
	(26, 'users', '3', 'Modification', 2, NULL, '2023-11-04 12:16:29', '2023-11-04 12:16:29'),
	(27, 'users', '3', 'Modification', 2, NULL, '2023-11-04 12:16:30', '2023-11-04 12:16:30'),
	(28, 'categorie_cours', '2', 'Creation', 2, NULL, '2023-11-04 12:28:06', '2023-11-04 12:28:06'),
	(29, 'cours', '2', 'Creation', 2, NULL, '2023-11-04 12:28:34', '2023-11-04 12:28:34'),
	(30, 'enseignements', '3', 'Creation', 2, NULL, '2023-11-04 12:45:05', '2023-11-04 12:45:05'),
	(31, 'employers', '4', 'Creation', 2, NULL, '2023-11-04 12:46:39', '2023-11-04 12:46:39'),
	(32, 'users', '4', 'Creation', 2, NULL, '2023-11-04 12:47:15', '2023-11-04 12:47:15'),
	(33, 'users', '4', 'Modification', 2, NULL, '2023-11-04 12:54:55', '2023-11-04 12:54:55'),
	(34, 'encadrements', '1', 'Creation', 2, NULL, '2023-11-04 12:55:01', '2023-11-04 12:55:01'),
	(35, 'enseignements', '4', 'Creation', 2, NULL, '2023-11-04 13:52:30', '2023-11-04 13:52:30'),
	(36, 'enseignements', '3', 'Modification', 2, NULL, '2023-11-04 13:52:30', '2023-11-04 13:52:30'),
	(37, 'enseignements', '3', 'Modification', 2, NULL, '2023-11-04 13:52:52', '2023-11-04 13:52:52'),
	(38, 'enseignements', '4', 'Modification', 2, NULL, '2023-11-04 13:55:33', '2023-11-04 13:55:33'),
	(39, 'enseignements', '3', 'Modification', 2, NULL, '2023-11-04 13:55:33', '2023-11-04 13:55:33'),
	(40, 'enseignements', '3', 'Modification', 2, NULL, '2023-11-04 13:56:01', '2023-11-04 13:56:01'),
	(41, 'enseignements', '4', 'Modification', 2, NULL, '2023-11-04 13:56:01', '2023-11-04 13:56:01'),
	(42, 'classes', '2', 'Creation', 2, NULL, '2023-11-04 14:01:41', '2023-11-04 14:01:41'),
	(43, 'classes', '2', 'Modification', 2, NULL, '2023-11-04 14:01:59', '2023-11-04 14:01:59'),
	(44, 'eleves', '1', 'Creation', 2, NULL, '2023-11-04 14:56:21', '2023-11-04 14:56:21'),
	(45, 'frequentations', '1', 'Creation', 2, NULL, '2023-11-04 14:56:29', '2023-11-04 14:56:29'),
	(46, 'resultats', '1', 'Creation', 2, NULL, '2023-11-04 14:56:29', '2023-11-04 14:56:29'),
	(47, 'trimestres', '1', 'Creation', 2, NULL, '2023-11-04 15:33:06', '2023-11-04 15:33:06'),
	(48, 'trimestres', '2', 'Creation', 2, NULL, '2023-11-04 15:33:37', '2023-11-04 15:33:37'),
	(49, 'trimestres', '1', 'Modification', 2, NULL, '2023-11-04 15:37:13', '2023-11-04 15:37:13'),
	(50, 'trimestres', '2', 'Modification', 2, NULL, '2023-11-04 15:37:22', '2023-11-04 15:37:22'),
	(51, 'periodes', '1', 'Creation', 2, NULL, '2023-11-04 15:38:14', '2023-11-04 15:38:14'),
	(52, 'periodes', '2', 'Creation', 2, NULL, '2023-11-04 15:38:36', '2023-11-04 15:38:36'),
	(53, 'periodes', '3', 'Creation', 2, NULL, '2023-11-04 15:47:43', '2023-11-04 15:47:43'),
	(54, 'periodes', '4', 'Creation', 2, NULL, '2023-11-04 15:48:59', '2023-11-04 15:48:59'),
	(55, 'periodes', '5', 'Creation', 2, NULL, '2023-11-04 15:51:20', '2023-11-04 15:51:20'),
	(56, 'periodes', '5', 'Modification', 2, NULL, '2023-11-04 15:51:58', '2023-11-04 15:51:58'),
	(57, 'periodes', '6', 'Creation', 2, NULL, '2023-11-04 15:52:30', '2023-11-04 15:52:30'),
	(58, 'enseignements', '4', 'Modification', 3, NULL, '2023-11-04 16:11:54', '2023-11-04 16:11:54'),
	(59, 'enseignements', '3', 'Modification', 3, NULL, '2023-11-04 16:11:54', '2023-11-04 16:11:54');
/*!40000 ALTER TABLE `logfiles` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.messages
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.migrations: ~68 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2013_08_23_182726_create_fonctions_table', 1),
	(2, '2013_08_23_183016_create_employers_table', 2),
	(3, '2013_08_23_185610_create_employer_fonction', 2),
	(4, '2014_10_12_000000_create_users_table', 2),
	(5, '2014_10_12_100000_create_password_resets_table', 2),
	(6, '2019_08_19_000000_create_failed_jobs_table', 2),
	(7, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(8, '2022_08_23_191112_create_table_niveau', 2),
	(9, '2022_08_23_191113_create_table_section', 2),
	(10, '2022_08_23_191212_create_classes_table', 2),
	(11, '2022_08_23_191630_create_categorie_cours_table', 2),
	(12, '2022_08_23_191720_create_cours_table', 2),
	(13, '2022_08_23_194802_create_annee_scolaires_table', 2),
	(14, '2022_08_23_194907_create_eleves_table', 2),
	(15, '2022_08_23_195235_create_frequentations_table', 2),
	(16, '2022_08_23_200306_create_trimestres_table', 2),
	(17, '2022_08_23_200340_create_periodes_table', 2),
	(18, '2022_08_23_200341_create_type_evaluations_table', 2),
	(19, '2022_08_23_201355_create_evaluations_table', 2),
	(20, '2022_08_23_201737_create_table_eleve_evaluation', 2),
	(21, '2022_08_23_203051_create_examens_table', 2),
	(22, '2022_08_23_203528_create_table_eleve_examen', 2),
	(23, '2022_08_27_023021_add_softdelete_to_table_fonctions', 2),
	(24, '2022_08_27_030641_add_softdelete_to_table_fonctions', 2),
	(25, '2022_08_28_212124_add_softdeletes_to_table_eleves', 2),
	(26, '2022_08_29_015735_add_softdeletes_to_frequentations', 2),
	(27, '2022_08_29_214601_add_softdeletes_to_classe', 2),
	(28, '2022_08_29_214742_add_softdeletes_to_annee_scolaire', 2),
	(29, '2022_08_29_214848_add_softdeletes_to_trimestres', 2),
	(30, '2022_08_29_214922_add_softdeletes_to_periodes', 2),
	(31, '2022_08_29_214953_add_softdeletes_to_evaluations', 2),
	(32, '2022_08_29_215017_add_softdeletes_to_type_evaluations', 2),
	(33, '2022_08_29_215039_add_softdeletes_to_examens', 2),
	(34, '2022_08_29_215105_add_softdeletes_to_categorie_cours', 2),
	(35, '2022_08_29_215127_add_softdeletes_to_cours', 2),
	(36, '2022_08_29_215146_add_softdeletes_to_eleve_evaluation', 2),
	(37, '2022_08_29_215211_add_softdeletes_to_eleve_examen', 2),
	(38, '2022_11_23_230530_add_soft_deletes_on_table_user', 2),
	(39, '2023_04_01_122816_create_table_enseignement', 2),
	(40, '2023_04_01_122818_create_table_encadrement', 2),
	(41, '2023_04_07_154345_create_table_conduites', 2),
	(42, '2023_04_07_155226_create_table_eleve_conduite', 2),
	(43, '2023_04_10_134823_create_parrains_table', 2),
	(44, '2023_04_11_074121_create_table_eleve_parrain', 2),
	(45, '2023_04_12_095545_add_id_parrain_to_user', 2),
	(46, '2023_04_16_141937_create_resultats_table', 2),
	(47, '2023_04_16_143659_create_type_frais_table', 2),
	(48, '2023_04_16_143741_create_mode_paiements_tables', 2),
	(49, '2023_04_16_143755_create_frais_table', 2),
	(50, '2023_04_16_143817_create_moyen_paiements_table', 2),
	(51, '2023_04_16_143909_create_paiement_frais_table', 2),
	(52, '2023_04_16_143945_create_messages_table', 2),
	(53, '2023_04_18_120110_add_date_id_to_paiements', 2),
	(54, '2023_04_18_133329_add_frequentation_id_to_paiements', 2),
	(55, '2023_05_22_012447_add_decisiom_on_resultats', 2),
	(56, '2023_06_28_225525_create_log_files_table', 2),
	(57, '2023_08_03_114945_create_jours_table', 2),
	(58, '2023_08_03_115031_add_heures_table', 2),
	(59, '2023_08_03_115222_create_horaires_table', 2),
	(60, '2023_08_04_164918_add_is_recreation_to_horaires', 2),
	(61, '2023_08_12_140926_create_categorie_articles_table', 2),
	(62, '2023_08_12_141116_create_unite_articles_table', 2),
	(63, '2023_08_12_141153_create_articles_table', 2),
	(64, '2023_08_12_141247_create_sortie_articles_table', 2),
	(65, '2023_08_12_141321_create_entree_articles_table', 2),
	(66, '2023_08_12_142338_create_type_presences_table', 2),
	(67, '2023_08_12_142401_create_presences_table', 2),
	(68, '2023_08_27_080456_create_employer_presences_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.mode_paiements
CREATE TABLE IF NOT EXISTS `mode_paiements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.mode_paiements: ~0 rows (approximately)
/*!40000 ALTER TABLE `mode_paiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `mode_paiements` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.moyen_paiements
CREATE TABLE IF NOT EXISTS `moyen_paiements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.moyen_paiements: ~0 rows (approximately)
/*!40000 ALTER TABLE `moyen_paiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `moyen_paiements` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.niveaux
CREATE TABLE IF NOT EXISTS `niveaux` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numerotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.niveaux: ~0 rows (approximately)
/*!40000 ALTER TABLE `niveaux` DISABLE KEYS */;
INSERT INTO `niveaux` (`id`, `nom`, `numerotation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIERE ANNEE', 1, '2023-11-03 19:34:45', '2023-11-03 19:34:46', NULL);
/*!40000 ALTER TABLE `niveaux` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.paiement_frais
CREATE TABLE IF NOT EXISTS `paiement_frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `montant_paye` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.paiement_frais: ~0 rows (approximately)
/*!40000 ALTER TABLE `paiement_frais` DISABLE KEYS */;
/*!40000 ALTER TABLE `paiement_frais` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.parrains
CREATE TABLE IF NOT EXISTS `parrains` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isBiologique` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parrains_avatar_unique` (`avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.parrains: ~0 rows (approximately)
/*!40000 ALTER TABLE `parrains` DISABLE KEYS */;
/*!40000 ALTER TABLE `parrains` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.periodes
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.periodes: ~0 rows (approximately)
/*!40000 ALTER TABLE `periodes` DISABLE KEYS */;
INSERT INTO `periodes` (`id`, `nom`, `date_debut`, `date_fin`, `trimestre_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIERE PERIODE', '2023-09-04', '2023-11-04', 1, '2023-11-04 15:38:13', '2023-11-04 15:38:13', NULL),
	(2, 'DEUXIEME PERIODE', '2023-11-10', '2024-02-05', 1, '2023-11-04 15:38:36', '2023-11-04 15:38:36', NULL),
	(5, 'TROISIEME PERIODE', '2024-02-12', '2024-04-28', 2, '2023-11-04 15:51:20', '2023-11-04 15:51:58', NULL),
	(6, 'QUATRIEME PERIODE', '2024-05-01', '2024-07-02', 2, '2023-11-04 15:52:30', '2023-11-04 15:52:30', NULL);
/*!40000 ALTER TABLE `periodes` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.personal_access_tokens
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

-- Dumping data for table easychik_secondaire.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.presences
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.presences: ~0 rows (approximately)
/*!40000 ALTER TABLE `presences` DISABLE KEYS */;
/*!40000 ALTER TABLE `presences` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.resultats
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.resultats: ~0 rows (approximately)
/*!40000 ALTER TABLE `resultats` DISABLE KEYS */;
INSERT INTO `resultats` (`id`, `periode1`, `periode2`, `periode3`, `periode4`, `periode5`, `periode6`, `examen1`, `examen2`, `examen3`, `trimestre1`, `trimestre2`, `trimestre3`, `annee`, `decision`, `frequentation_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 1, '2023-11-04 14:56:29', '2023-11-04 14:56:29', NULL);
/*!40000 ALTER TABLE `resultats` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.sections: ~0 rows (approximately)
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id`, `nom`, `abbreviation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'EDUCATION DE BASE', 'EB', '2023-11-03 18:59:06', '2023-11-03 17:32:36', NULL),
	(2, 'SCIENTIPHIQUE', 'SC', '2023-11-03 17:20:18', '2023-11-03 17:20:18', NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.sortie_articles
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.sortie_articles: ~0 rows (approximately)
/*!40000 ALTER TABLE `sortie_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `sortie_articles` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.trimestres
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.trimestres: ~0 rows (approximately)
/*!40000 ALTER TABLE `trimestres` DISABLE KEYS */;
INSERT INTO `trimestres` (`id`, `nom`, `date_debut`, `date_fin`, `annee_scolaire_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PREMIER SEMESTRE', '2023-10-04', '2024-01-31', 1, '2023-11-04 15:33:06', '2023-11-04 15:37:13', NULL),
	(2, 'DEUXIEME SEMESTRE', '2024-02-01', '2024-07-02', 1, '2023-11-04 15:33:37', '2023-11-04 15:37:22', NULL);
/*!40000 ALTER TABLE `trimestres` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.type_evaluations
CREATE TABLE IF NOT EXISTS `type_evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.type_evaluations: ~0 rows (approximately)
/*!40000 ALTER TABLE `type_evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_evaluations` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.type_frais
CREATE TABLE IF NOT EXISTS `type_frais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.type_frais: ~0 rows (approximately)
/*!40000 ALTER TABLE `type_frais` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_frais` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.type_presences
CREATE TABLE IF NOT EXISTS `type_presences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.type_presences: ~0 rows (approximately)
/*!40000 ALTER TABLE `type_presences` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_presences` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.unite_articles
CREATE TABLE IF NOT EXISTS `unite_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.unite_articles: ~0 rows (approximately)
/*!40000 ALTER TABLE `unite_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `unite_articles` ENABLE KEYS */;

-- Dumping structure for table easychik_secondaire.users
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table easychik_secondaire.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `isAdmin`, `isActive`, `employer_id`, `created_at`, `updated_at`, `deleted_at`, `parrain_id`) VALUES
	(1, 'admin@easychik.com', NULL, '$2y$10$GqV3l.g.BoxaY/QTUPsfr.kbb5dZ.Pu4xx.0AVqaPXv8QKCrq51oO', NULL, 1, 1, 1, '2023-11-03 16:45:07', '2023-11-03 16:45:07', NULL, NULL),
	(2, 'manager@easychik.com', NULL, '$2y$10$U1rHF0XjHp5nHHEUba9dvOV/.m28x25MJcSePSkDOl6WDPGhfMDta', NULL, 0, 1, 2, '2023-11-03 21:58:20', '2023-11-03 21:58:25', NULL, NULL),
	(3, 'teacher@easychik.com', NULL, '$2y$10$SXl7J4SKtQRjHsNwFXA93eTZtiuhHIauIQkihLcEmHzUBg3ck0tEy', NULL, 0, 1, 3, '2023-11-04 10:34:58', '2023-11-04 12:16:29', NULL, NULL),
	(4, 'teacher2@easychik.com', NULL, '$2y$10$rdsP4Bm.1t9mwLMNOkrmAeEBe/eUFEyY11JBmFwoXe5n0BZBaAFD.', NULL, 0, 1, 4, '2023-11-04 12:47:15', '2023-11-04 12:54:55', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
