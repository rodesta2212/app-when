/*
MySQL Backup
Source Server Version: 5.1.31
Source Database: when
Date: 25/12/2020 21:35:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `dikdasmen`
-- ----------------------------
DROP TABLE IF EXISTS `dikdasmen`;
CREATE TABLE `dikdasmen` (
  `id_dikdasmen` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_dikdasmen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `guru`
-- ----------------------------
DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(32) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('laki','perempuan') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `email` varchar(22) DEFAULT NULL,
  `tempat_kelahiran` varchar(10) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(22) DEFAULT NULL,
  `nama_lembaga` varchar(32) DEFAULT NULL,
  `tahun_ijazah` varchar(4) DEFAULT NULL,
  `jumlah_program_study` int(2) DEFAULT NULL,
  `alamat` text,
  `id_tingkatan` int(11) DEFAULT NULL,
  `fc_ijazah` varchar(255) DEFAULT NULL,
  `status_perkawinan` enum('menikah','belum menikah') DEFAULT NULL,
  `tanggal_mulai_bertugas` date DEFAULT NULL,
  `fc_sk_sekolah` varchar(255) DEFAULT NULL,
  `fc_sk_gtt` varchar(255) DEFAULT NULL,
  `fc_Kartu_anggota_muhammadiyag` varchar(255) DEFAULT NULL,
  `fc_kartu_keluarga` varchar(255) DEFAULT NULL,
  `sk_membaca_alquran` varchar(255) DEFAULT NULL,
  `sk_lulus_tes_muhammadiyah` varchar(255) DEFAULT NULL,
  `sk_aktif_kegiatan_muhammadiyah` varchar(255) DEFAULT NULL,
  `sk_pernyataan_ketentuan_dikdasmen` varchar(255) DEFAULT NULL,
  `status` enum('belum verifikasi','verifikasi') NOT NULL,
  `tingkatan` enum('SD','SMP','SMA') DEFAULT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `hasil`
-- ----------------------------
DROP TABLE IF EXISTS `hasil`;
CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL DEFAULT '0',
  `id_ujian` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nilai` int(3) DEFAULT NULL,
  `status` enum('lulus','tidak lulus') DEFAULT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jadwal_ujian`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_ujian`;
CREATE TABLE `jadwal_ujian` (
  `id_jadwal_ujian` int(11) NOT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `tgl_ujian` datetime DEFAULT NULL,
  `id_penguji` int(11) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_ujian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `penguji`
-- ----------------------------
DROP TABLE IF EXISTS `penguji`;
CREATE TABLE `penguji` (
  `id_penguji` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(22) DEFAULT NULL,
  `alamat` text,
  `telp` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_penguji`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ujian`
-- ----------------------------
DROP TABLE IF EXISTS `ujian`;
CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(32) DEFAULT NULL,
  `nilai_lulus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ujian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` enum('guru','penguji','dikdasmen') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `dikdasmen` VALUES ('1','1','rodesta');
INSERT INTO `guru` VALUES ('1200000001','2','wisnu hendratama','1996-08-06','perempuan','089324574382','when@mail.com','bantul','islam','calon S1','STMIK AKAKOM','2020','144','bantul','1','asgdahjksdgasdqw213123','belum menikah','2020-11-27','jshdfsjkdhfsk384283','hsdjkfhs7676','jhsjfgsjdfs665765','jhfjsgfjsdgf6656465','hgdhjsgfjhsdgfsd7687678678','ghjsdgfjhsdgfjhsdgfs7867687','hdshjfgs768fsdhfgsjdg','dgfjshggysfg7678','verifikasi','SMP'), ('1200000005','4','intan','2020-12-20','laki','1','ricky.listiawan@mail','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SD'), ('1200000006','19','achell','2020-12-09','perempuan','456456','rodesta2212@gmail.com','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL), ('1200000007','20','ozawa','2020-12-14','laki','367547658779','g45lab.xyz@gmail.com','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL), ('1200000008','21','agung','2020-12-22','laki','12345','g45lab.xyz@gmail.com','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SMA'), ('1200000009','22','ani','2020-12-22','laki','12222','g45lab.xyz@gmail.com','bantu;',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SMP'), ('1200000010','23','ana','2020-12-15','laki','11111','g45lab.xyz@gmail.com','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SD'), ('1200000011','24','anu','2020-12-15','perempuan','22222','g45lab.xyz@gmail.com','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SD'), ('1200000012','25','ant','2020-12-15','laki','33333','g45lab.xyz@gmail.com','bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL), ('1200000013','26','babu','2020-12-15','laki','44444','g45lab.xyz@gmail.com','jogja',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SMP'), ('1200000014','27','baba','2020-12-15','perempuan','55555','g45lab.xyz@gmail.com','jogja',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL), ('1200000015','28','babo','2020-12-15','laki','66666','g45lab.xyz@gmail.com','jogja',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SMP'), ('1200000016','29','babe','2020-12-15','laki','77777','g45lab.xyz@gmail.com','jogja',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL), ('1200000017','30','caca','2020-12-15','perempuan','88888','g45lab.xyz@gmail.com','jogja',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SD'), ('1200000018','31','cici','2020-12-15','laki','99999','g45lab.xyz@gmail.com','jogja',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi','SMP');
INSERT INTO `jadwal_ujian` VALUES ('1','1','2020-12-26 16:25:33','1','sekolah'), ('2','2','2020-12-28 16:25:39','2','Masjid'), ('3','6','2020-12-31 16:25:00','3','Masjid'), ('4','1','2020-12-16 20:30:00','3','aula'), ('5','4','2020-12-07 16:30:00','3','Masjid'), ('6','7','2020-12-25 16:27:00','2','Masjid');
INSERT INTO `penguji` VALUES ('1','3','Bu Deby','bantul','098762786538'), ('2','15','intan','g46 space','89735496'), ('3','16','brian','bantul','85642146'), ('4','17','hallo','sdfsdf','2132131'), ('5','18','asdasdas','sadasdasd','4565546');
INSERT INTO `ujian` VALUES ('1','Ujian Tertulis','75'), ('2','Al Quran','75'), ('3','Tata Cara Mandi dan Wudhu','75'), ('4','Shalat Fardhu','75'), ('5','Shalat Jenazah','75'), ('6','Ideologi Muhamadiyah','75'), ('7','Aktivitas Muhammadiyah','75');
INSERT INTO `user` VALUES ('1','rodesta','123456','dikdasmen'), ('2','wisnu','123456','guru'), ('3','daby','123456','penguji'), ('9','ricky','ricky','guru'), ('10','wildan','123456','penguji'), ('11',NULL,NULL,NULL), ('12','aaaa','123456','guru'), ('13','edy','123456','guru'), ('14','budi','123456','guru'), ('15','intan','123456','penguji'), ('16','brian','123456','penguji'), ('17','hallo','123123','penguji'), ('18','dasdasdsa','asdasdas','penguji'), ('19','ricky','ricky','guru'), ('20','ozawa','12345','guru');
