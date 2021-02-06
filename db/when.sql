/*
MySQL Backup
Source Server Version: 5.1.31
Source Database: when
Date: 06/02/2021 12:17:48
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
INSERT INTO `dikdasmen` VALUES ('1','1','rodesta');
INSERT INTO `guru` VALUES ('1200000001','2','whenwhen','2020-12-30','laki','449683213134','whenwhen@gmail.com','bantul','islam','S1','STMIK AKAKOM','2020','144','klatak','Notes_210118_141305.pdf','belum menikah','2021-01-20','Halaman Login 2.png','Halaman Login 2.png','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','Halaman Login 2.png','admin.png','Halaman Login 2.png','Halaman Login 2.png','verifikasi','SMP'), ('1200000002','3','Riki','2021-01-31','laki','449683213134','rodesta2212@gmail.com','Sleman','islam','D3','STMIK AKAKOM','2020','144','dlrmsn','Halaman Login 2.png','belum menikah','2021-01-31','IMG20210119235710.jpg','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','IMG20210119235710.jpg','IMG20210119235710.jpg','IMG20210119235710.jpg','IMG20210119235710.jpg','IMG20210119234931.jpg','verifikasi','SMP'), ('1200000003','4','dusdus','2021-02-10','laki','449683213134','wisnu@gmail.com','bantul','islam','S1','STMIK AKAKOM','2020','144','ditinggal','Halaman Login 2.png','menikah','2021-01-31','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','1610171626.jpg','IMG20210119235710.jpg','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','WhatsApp Image 2021-01-18 at 08.59.50.jpeg','verifikasi','SMP'), ('1200000004','5','endang','2021-01-31','laki','449683213134','endangs0412@gmail.com','Sleman','islam','S1','STMIK AKAKOM','2020','144','ditinggal',NULL,'belum menikah','2021-01-31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'belum verifikasi','SD');
INSERT INTO `jadwal_guru` VALUES ('1','2','3','belum verifikasi',NULL), ('2','1','3','belum verifikasi',NULL), ('3','3','3','belum verifikasi',NULL), ('4','5','3','belum verifikasi',NULL), ('5','4','1200000002','belum verifikasi',NULL), ('6','3','1200000003','belum verifikasi',NULL), ('7','3','1200000003','belum verifikasi',NULL), ('8','2','1200000003','belum verifikasi',NULL), ('9','1','1200000003','belum verifikasi',NULL), ('10','6','1200000003','belum verifikasi',NULL), ('11','1','1200000002','belum verifikasi',NULL), ('12','5','1200000002','belum verifikasi',NULL), ('13','1','1200000002','belum verifikasi',NULL), ('14','3','1200000002','belum verifikasi',NULL), ('15','2','1200000001','verifikasi',NULL), ('16','5','1200000001','verifikasi',NULL), ('17','1','1200000001','verifikasi',NULL), ('18','1','1200000001','verifikasi',NULL), ('19','1','1200000002','verifikasi',NULL);
INSERT INTO `jadwal_ujian` VALUES ('1','1','2021-02-28 14:19:00','1','sekolah'), ('2','2','2021-02-28 14:21:00','2','Masjid'), ('3','6','2021-02-28 14:22:00','3','Masjid'), ('4','1','2021-02-28 14:22:00','3','aula'), ('5','6','2021-03-10 15:05:00','4','Masjid Sekolah'), ('6','3','2021-02-28 14:23:00','4','Masjid Sekolah');
INSERT INTO `penguji` VALUES ('1','3','Bu Deby','Imogiri','098762786538'), ('2','15','intan','g46 space','89735496'), ('3','16','brian','bantul','85642146'), ('4','17','hallo','sdfsdf','2132131'), ('5','18','Budi','Bantul','4565546');
INSERT INTO `ujian` VALUES ('1','Ujian Tertulis','80'), ('2','AL-Quran','80'), ('3','Tata Cara Mandi dan Wudhu','75'), ('4','Shalat Fardhu','75'), ('5','Shalat Jenazah','75'), ('6','Ideologi Muhamadiyah','75'), ('7','Aktivitas Muhammadiyah','75');
INSERT INTO `user` VALUES ('1','rodesta','123456','dikdasmen'), ('2','whenwhen','123456','guru'), ('3','riki','123456','guru'), ('4','wisnu','123456','guru'), ('5','endang','12345','guru');
