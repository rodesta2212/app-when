/*
MySQL Backup
Source Server Version: 5.1.31
Source Database: when
Date: 25/02/2021 09:27:08
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
  `fc_ijazah` varchar(255) DEFAULT NULL,
  `status_perkawinan` enum('menikah','belum menikah') DEFAULT NULL,
  `tanggal_mulai_bertugas` date DEFAULT NULL,
  `fc_sk_sekolah` varchar(255) DEFAULT NULL,
  `fc_sk_gtt` varchar(255) DEFAULT NULL,
  `fc_kartu_anggota_muhammadiyah` varchar(255) DEFAULT NULL,
  `fc_kartu_keluarga` varchar(255) DEFAULT NULL,
  `sk_membaca_alquran` varchar(255) DEFAULT NULL,
  `sk_aktif_kegiatan_muhammadiyah` varchar(255) DEFAULT NULL,
  `sk_pernyataan_ketentuan_dikdasmen` varchar(255) DEFAULT NULL,
  `status` enum('belum verifikasi','verifikasi') NOT NULL,
  `tingkatan` enum('SD','SMP','SMA') DEFAULT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `jadwal_guru`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_guru`;
CREATE TABLE `jadwal_guru` (
  `id_jadwal_guru` int(11) NOT NULL DEFAULT '0',
  `id_jadwal_ujian` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `status` enum('belum verifikasi','verifikasi') DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal_guru`)
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
INSERT INTO `dikdasmen` VALUES ('1','1','Dikdasmen');
INSERT INTO `guru` VALUES ('1200000001','3','Enita Rahayu','1993-05-16','perempuan','88221328165','enytharahayu@gmail.com','Klaten','islam','S2','Universitas Negeri Yogyakarta','2018','184','Jl. Parkit, Pemukti Baru Rt 12/Rw 14','IMG20210119235710.png','belum menikah','2018-08-16','IMG20210119235710.png','IMG20210119235710.png','IMG20210119235710.png','IMG20210119235710.png','IMG20210119235710.png','IMG20210119235710.png','IMG20210119235710.png','verifikasi','SMP'), ('1200000002','4','Nurul Fahmi','1991-05-14','perempuan','82236453216','nurulfahmi@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000003','5','Anton Nugroho','1990-05-02','laki','85231273216','antonnugroho@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000004','6','Ani Nurmala','1991-01-14','perempuan','82738121321','aninurmala@gmail.com','Sleman',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000005','7','Bayu Nurcholis','1993-04-20','laki','86729634328','bayunur@gmail.com','Sleman',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000006','8','Danu Danang','1990-08-09','laki','85218765672','danang123@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000007','9','Nur Cahya','1990-05-25','laki','85217767231','nurcahya@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000008','10','Evilia Ronna','1992-12-14','perempuan','81722342125','evievilia@gmail.com','Sleman',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000009','11','Fanny Agusta','1991-01-01','laki','82321212837','fannyagusta@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000010','12','Gilang Romani','1990-11-14','laki','81232187821','gilangroman@gmail.com','Klaten',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000011','13','Huda Ninda','1991-06-06','perempuan','82882132672','hudaninda@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000012','14','Ilham Sulaiman','1990-07-17','laki','82321213432','ilhamsulai@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'verifikasi',NULL), ('1200000013','15','Juni Refiyanto','1990-02-08','laki','82678767531','junirefi@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL), ('1200000014','16','Mahendra Sundawa','1992-01-01','laki','82123423212','sundawahen@gmail.com','Bantul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi',NULL);
INSERT INTO `jadwal_guru` VALUES ('0',NULL,NULL,NULL,NULL), ('1','1','1200000001','verifikasi','80'), ('2','2','1200000001','verifikasi','80'), ('3','3','1200000001','verifikasi','75'), ('4','4','1200000001','verifikasi','80'), ('5','5','1200000001','verifikasi','75'), ('6','6','1200000001','verifikasi','60'), ('7','7','1200000001','verifikasi','60'), ('8','1','1200000002','verifikasi','90'), ('9','2','1200000002','verifikasi','80'), ('10','3','1200000002','verifikasi','75'), ('11','4','1200000002','verifikasi','45'), ('12','5','1200000002','verifikasi','82'), ('13','6','1200000002','verifikasi','49'), ('14','7','1200000002','verifikasi','80'), ('15','1','1200000003','verifikasi','75'), ('16','2','1200000003','verifikasi','80'), ('17','3','1200000003','verifikasi','60'), ('18','4','1200000003','verifikasi','65'), ('19','5','1200000003','verifikasi','80'), ('20','6','1200000003','verifikasi','45'), ('21','7','1200000003','verifikasi','80'), ('22','1','1200000004','verifikasi','80'), ('23','2','1200000004','verifikasi','90'), ('24','3','1200000004','verifikasi','78'), ('25','4','1200000004','verifikasi','90'), ('26','5','1200000004','verifikasi','55'), ('28','6','1200000004','verifikasi','80'), ('29','7','1200000004','verifikasi','90'), ('30','1','1200000005','verifikasi','80'), ('31','2','1200000005','verifikasi','90'), ('32','3','1200000005','verifikasi','80'), ('33','4','1200000005','verifikasi','80'), ('34','5','1200000005','verifikasi','70'), ('35','6','1200000005','verifikasi','90'), ('36','7','1200000005','verifikasi','80'), ('37','1','1200000006','verifikasi','55'), ('38','2','1200000006','verifikasi','60'), ('39','3','1200000006','verifikasi','80'), ('40','4','1200000006','verifikasi','75'), ('41','5','1200000006','verifikasi','75'), ('42','6','1200000006','verifikasi','60'), ('43','7','1200000006','verifikasi','80'), ('44','1','1200000007','verifikasi','75'), ('45','2','1200000007','verifikasi','90'), ('46','3','1200000007','verifikasi','55'), ('47','4','1200000007','verifikasi','80'), ('48','5','1200000007','verifikasi','75'), ('49','6','1200000007','verifikasi','80'), ('50','7','1200000007','verifikasi','90'), ('51','1','1200000008','verifikasi','80'), ('52','2','1200000008','verifikasi','80'), ('53','3','1200000008','verifikasi','75'), ('54','4','1200000008','verifikasi','90'), ('55','5','1200000008','verifikasi','80'), ('56','6','1200000008','verifikasi','80'), ('57','7','1200000008','verifikasi','75'), ('58','1','1200000010','verifikasi','75'), ('59','2','1200000010','verifikasi','75'), ('60','3','1200000010','verifikasi','75'), ('61','4','1200000010','verifikasi','60'), ('62','5','1200000010','verifikasi','85'), ('63','6','1200000010','verifikasi','88'), ('64','7','1200000010','verifikasi','75'), ('65','1','1200000011','verifikasi','77'), ('66','2','1200000011','verifikasi','90'), ('67','3','1200000011','verifikasi','82'), ('68','4','1200000011','verifikasi','50'), ('69','5','1200000011','verifikasi','60'), ('70','6','1200000011','verifikasi','80'), ('71','7','1200000011','verifikasi','46'), ('72','1','1200000013','belum verifikasi',NULL), ('73','2','1200000013','belum verifikasi',NULL), ('74','3','1200000013','belum verifikasi',NULL), ('75','4','1200000013','belum verifikasi',NULL), ('76','5','1200000013','belum verifikasi',NULL), ('77','6','1200000013','belum verifikasi',NULL), ('78','7','1200000013','belum verifikasi',NULL);
INSERT INTO `jadwal_ujian` VALUES ('1','1','2021-02-22 08:00:00','1','Gedung Ruang B'), ('2','2','2021-02-23 08:00:00','1','Masjid PDM'), ('3','3','2021-02-23 10:30:00','1','Masjid PDM'), ('4','4','2021-02-23 13:00:00','1','Masjid PDM'), ('5','5','2021-02-24 08:00:00','1','Masjid PDM'), ('6','6','2021-02-24 10:30:00','1','Gedung Ruang B'), ('7','7','2021-02-24 13:00:00','1','Gedung Ruang B');
INSERT INTO `penguji` VALUES ('1','2','Wisnu Hendratama','Klatak, Gadingsari, Sanden','85729643217');
INSERT INTO `ujian` VALUES ('1','Ujian Tertulis','80'), ('2','AL-Quran','80'), ('3','Tata Cara Mandi dan Wudhu','75'), ('4','Shalat Fardhu','75'), ('5','Shalat Jenazah','75'), ('6','Ideologi Muhamadiyah','75'), ('7','Aktivitas Muhammadiyah','75');
INSERT INTO `user` VALUES ('1','dikdasmen','123456','dikdasmen'), ('2','wisnu','123456','penguji'), ('3','enita','123456','guru'), ('4','nurul','123456','guru'), ('5','anton','123456','guru'), ('6','aninur','123456','guru'), ('7','bayu','123456','guru'), ('8','danang','123456','guru'), ('9','cahya','123456','guru'), ('10','evilia','123456','guru'), ('11','fanny','123456','guru'), ('12','gilang','123456','guru'), ('13','huda','123456','guru'), ('14','ilham','123456','guru'), ('15','juni','123456','guru'), ('16','mahendra','123456','guru');
