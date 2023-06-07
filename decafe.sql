-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for decafe
DROP DATABASE IF EXISTS `decafe`;
CREATE DATABASE IF NOT EXISTS `decafe` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `decafe`;

-- Dumping structure for table decafe.kategori_menu
DROP TABLE IF EXISTS `kategori_menu`;
CREATE TABLE IF NOT EXISTS `kategori_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_menu` int DEFAULT NULL,
  `kategori_menu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table decafe.kategori_menu: ~7 rows (approximately)
/*!40000 ALTER TABLE `kategori_menu` DISABLE KEYS */;
REPLACE INTO `kategori_menu` (`id`, `jenis_menu`, `kategori_menu`) VALUES
	(1, 0, 'nasi bakar'),
	(2, 1, 'snack'),
	(3, 2, 'jus'),
	(4, 2, 'kopi'),
	(5, 1, 'air Surga'),
	(6, 2, 'bandrek'),
	(7, 1, 'ayam bakar');
/*!40000 ALTER TABLE `kategori_menu` ENABLE KEYS */;

-- Dumping structure for table decafe.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(50) DEFAULT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `kategori` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE,
  KEY `FK_menu_kategori_menu` (`kategori`),
  CONSTRAINT `FK_menu_kategori_menu` FOREIGN KEY (`kategori`) REFERENCES `kategori_menu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table decafe.menu: ~7 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
REPLACE INTO `menu` (`id_menu`, `foto`, `nama_menu`, `keterangan`, `kategori`, `harga`, `stok`) VALUES
	(1, 'esKosong.png', 'Es Kosong', 'Pake salju', 5, 1000, 100),
	(12, 'burger.png', 'Burger', '', 2, 5000, 30),
	(13, 'sanger.png', 'Sanger', '', 4, 8000, 20),
	(14, 'kari.png', 'Kari Udin', 'kuah saja', 1, 10000, 10),
	(15, 'sate.png', 'Sate Firman', 'Mata firman', 1, 15000, 1),
	(18, 'pexels-suzy-hazelwood-4634190.jpg', 'asds', 'bbbbbbbb', 2, 2, 2),
	(20, 'pexels-normunds-ispwich-10131568.jpg', 'sda', 'sads', 2, 2, 2);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table decafe.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '202cb962ac59075b964b07152d234b70',
  `level` int DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table decafe.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `nama`, `username`, `password`, `level`, `nohp`, `alamat`) VALUES
	(13, 'admin3', 'admin3', '202cb962ac59075b964b07152d234b70', 3, '092041742323', 'nunang'),
	(14, 'admin4', 'admin4', '202cb962ac59075b964b07152d234b70', 4, '092041742323', 'nunang'),
	(23, 'adsa', 'asdsa', '202cb962ac59075b964b07152d234b70', 3, 'dsad', 'asdad'),
	(24, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 1, '092041742323', 'nunang');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
