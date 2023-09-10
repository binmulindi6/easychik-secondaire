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

-- Dumping data for table sas old v.classes: ~13 rows (approximately)
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` (`id`, `nom`, `niveau_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'A', 5, '2022-08-24 12:54:36', '2022-08-24 12:54:37', NULL),
	(2, 'A', 6, '2022-08-31 08:53:08', '2022-08-31 08:53:09', NULL),
	(3, 'B', 5, '2022-09-03 05:58:32', '2022-09-03 05:58:32', NULL),
	(4, 'B', 6, '2022-09-03 06:02:21', '2022-09-03 06:02:21', NULL),
	(5, 'A', 7, '2022-09-03 06:40:20', '2022-09-03 06:40:20', NULL),
	(6, 'C', 7, '2022-09-03 06:40:43', '2022-09-03 06:41:21', '2022-09-03 06:41:21'),
	(7, 'B', 7, '2022-09-03 06:41:32', '2022-09-03 06:41:32', NULL),
	(8, 'A', 4, '2022-09-03 06:41:40', '2022-11-23 19:54:33', NULL),
	(9, 'B', 4, '2022-09-03 06:41:47', '2023-07-11 15:42:23', NULL),
	(10, 'A', 8, '2023-01-31 08:30:58', '2023-01-31 08:30:58', NULL),
	(14, 'B', 8, '2023-04-13 13:55:25', '2023-04-13 13:55:25', NULL),
	(15, 'B', 8, '2023-04-13 13:58:39', '2023-04-13 13:58:46', '2023-04-13 13:58:46'),
	(16, 'A', 9, '2023-04-13 13:58:57', '2023-04-13 13:58:57', NULL);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
