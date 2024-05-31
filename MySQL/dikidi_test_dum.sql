-- Adminer 4.8.1 MySQL 8.0.36 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `dikidi_test`;

CREATE DATABASE `dikidi_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dikidi_test`;

DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `types` (`id`, `Name`) VALUES
(1, 'Sport'),
(2, 'Cruiser'),
(3, 'Classic');

DROP TABLE IF EXISTS `motorcycles`;
CREATE TABLE `motorcycles` (
  `id` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `motorcycles_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `motorcycles` (`id`, `Name`, `type_id`, `status`) VALUES
(1,	'Ducati Panigale V4',	1,	0),
(2,	'Harley-Davidson Street 750',	1,	1),
(3,	'BMW S1000RR',	2,	1),
(4,	'Triumph Bonneville',	1,	1);

-- 2024-05-31 15:35:40
