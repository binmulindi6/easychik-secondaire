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

-- Dumping data for table sas old v.migrations: ~78 rows (approximately)
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
	(84, '2023_04_18_133329_add_frequentation_id_to_paiements', 31),
	(85, '2023_05_22_012447_add_decisiom_on_resultats', 32),
	(87, '2023_06_28_225525_create_log_files_table', 33);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
