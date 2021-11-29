/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `store` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `store`;

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `available` tinyint(1) DEFAULT '1',
  `stock` int(11) DEFAULT NULL,
  `uniqueOrder` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `available`, `stock`, `uniqueOrder`) VALUES
	(26, 'Megadrive', 'Une console Sega', 50, NULL, 1, NULL, 0),
	(27, 'Commodore 64', 'qsdfhj', 25, NULL, 1, NULL, 0),
	(28, 'Megadrive2', 'fzfzgr', 25, NULL, 1, NULL, 0),
	(29, 'Super Nintendo', 'Trop bien !', 109.99, NULL, 1, NULL, 0),
	(30, 'GameBoy', 'Console potable !', 25, NULL, 1, NULL, 0),
	(31, 'VirtualBoy', 'Punaise !', 1450, NULL, 1, NULL, 0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `email`, `password`, `createdAt`, `role`) VALUES
	(3, 'Squalli', 'squalli@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MGg4ZEhhTTVvU0llWHk2Tg$G5tG4WC3iuBk+cdcOwjBubLFgRieN61z+Lyr9eHSYVI', '2021-11-22 16:56:08', NULL),
	(4, 'BestAdmin', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UEdMaWZ0S2pucGcuNnRqYw$+KQ7WRB44bu2TzJHkR8RIWCBO5RfPIL393z4XHNd9OE', '2021-11-24 17:00:58', 'ROLE_ADMIN'),
	(5, 'Steph', 'steph@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QVBjQi93aDBJWDh4ZU5WWg$Fet9IG59+ALsoSUp4QWahgVc8rz/wpmLVHubYF8iDV0', '2021-11-29 14:52:55', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
