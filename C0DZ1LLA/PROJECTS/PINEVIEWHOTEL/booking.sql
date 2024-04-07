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


-- Dumping database structure for booking
DROP DATABASE IF EXISTS `booking`;
CREATE DATABASE IF NOT EXISTS `booking` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `booking`;

-- Dumping structure for table booking.bookings
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `infants` int(11) NOT NULL,
  `group_number` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `idx_arrival_departure` (`arrival_date`,`departure_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table booking.bookings: ~0 rows (approximately)
DELETE FROM `bookings`;

-- Dumping structure for table booking.rooms
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `idx_room_type` (`room_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table booking.rooms: ~10 rows (approximately)
DELETE FROM `rooms`;
INSERT INTO `rooms` (`room_id`, `room_type`, `description`, `price`, `capacity`) VALUES
	(1, 'Standard', 'Standard room with basic amenities', 100.00, 2),
	(2, 'Deluxe', 'Deluxe room with additional amenities', 150.00, 2),
	(3, 'Suite', 'Luxurious suite with premium amenities', 250.00, 4),
	(4, 'Double Room with Mountain View', 'A spacious double room with a stunning mountain view.', 100.00, 2),
	(5, 'Twin Room with Mountain View', 'A comfortable twin room with a beautiful mountain view.', 90.00, 2),
	(6, 'Deluxe Double Room with Balcony', 'A luxurious double room with a private balcony.', 150.00, 2),
	(7, 'Single Room', 'A cozy single room perfect for solo travelers.', 80.00, 1),
	(8, 'Suite', 'A luxurious suite with separate living and sleeping areas.', 200.00, 4),
	(9, 'Double Room', 'A standard double room with modern amenities.', 110.00, 2),
	(10, 'Suite with Balcony', 'A spacious suite with a private balcony overlooking the city.', 220.00, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
