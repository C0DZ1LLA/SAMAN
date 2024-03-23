-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for productdatabase
DROP DATABASE IF EXISTS `productdatabase`;
CREATE DATABASE IF NOT EXISTS `productdatabase` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `productdatabase`;

-- Dumping structure for table productdatabase.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `bulk_price` decimal(10,2) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `bulk_cost` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `total_profit` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table productdatabase.products: ~2 rows (approximately)
DELETE FROM `products`;
INSERT INTO `products` (`id`, `name`, `bulk_price`, `sell_price`, `bulk_cost`, `quantity`, `total_cost`, `total_profit`) VALUES
	(5, '1231', 0.00, 123.00, 123.00, 123, 15129.00, 0.00),
	(6, '1231', 0.00, 1233.00, 123.00, 123, 15129.00, 136530.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
