/*
Navicat MySQL Data Transfer

Source Server         : lokal_mysql
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : arsip

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2016-01-08 07:20:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_berkas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_berkas`;
CREATE TABLE `tbl_berkas` (
  `no_berkas` varchar(32) NOT NULL,
  `npwp` varchar(15) NOT NULL,
  `nama_wp` varchar(50) NOT NULL,
  `no_box` varchar(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `user_id` char(20) NOT NULL,
  `tahun_berkas` varchar(4) NOT NULL,
  `masa` varchar(2) NOT NULL,
  `jenis_berkas` tinyint(4) NOT NULL,
  `tgl_edit` date NOT NULL,
  `user_edit` varchar(20) NOT NULL,
  PRIMARY KEY  (`no_berkas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_box
-- ----------------------------
DROP TABLE IF EXISTS `tbl_box`;
CREATE TABLE `tbl_box` (
  `no_box` varchar(14) NOT NULL,
  `no_rak` int(10) NOT NULL,
  `no_kolom` int(10) NOT NULL,
  `no_baris` int(10) NOT NULL,
  `no_id` int(10) NOT NULL,
  PRIMARY KEY  (`no_box`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_jenis
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jenis`;
CREATE TABLE `tbl_jenis` (
  `id` tinyint(10) NOT NULL auto_increment,
  `nama_jenis` varchar(255) NOT NULL,
  `keterangan` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_modul
-- ----------------------------
DROP TABLE IF EXISTS `tbl_modul`;
CREATE TABLE `tbl_modul` (
  `id` tinyint(4) NOT NULL,
  `link` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `link_sidebar` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_msg
-- ----------------------------
DROP TABLE IF EXISTS `tbl_msg`;
CREATE TABLE `tbl_msg` (
  `id` tinyint(4) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_peminjam
-- ----------------------------
DROP TABLE IF EXISTS `tbl_peminjam`;
CREATE TABLE `tbl_peminjam` (
  `id` int(10) NOT NULL auto_increment,
  `peminjam` varchar(50) NOT NULL,
  `no_berkas` varchar(32) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` tinyint(4) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `seksi` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_wp
-- ----------------------------
DROP TABLE IF EXISTS `tbl_wp`;
CREATE TABLE `tbl_wp` (
  `NPWP` varchar(255) default NULL,
  `NAMA_WP` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- View structure for v_arsip
-- ----------------------------
DROP VIEW IF EXISTS `v_arsip`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_arsip` AS SELECT
tbl_berkas.no_berkas,
tbl_berkas.npwp,
tbl_berkas.nama_wp,
tbl_berkas.no_box,
tbl_berkas.tgl_masuk,
tbl_berkas.tahun_berkas,
tbl_jenis.nama_jenis,
tbl_berkas.user_id,
tbl_berkas.tgl_edit,
tbl_berkas.user_edit
FROM
tbl_berkas ,
tbl_jenis
WHERE
tbl_jenis.id = tbl_berkas.jenis_berkas ;

-- ----------------------------
-- View structure for v_perjenis
-- ----------------------------
DROP VIEW IF EXISTS `v_perjenis`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_perjenis` AS SELECT
tbl_jenis.nama_jenis AS jenis,
Count(tbl_berkas.no_berkas) AS jumlah,
tbl_jenis.id
FROM
tbl_berkas
LEFT JOIN tbl_jenis ON tbl_berkas.jenis_berkas = tbl_jenis.id
GROUP BY
tbl_jenis.id ;

--
-- Data Awal
--

INSERT INTO `tbl_user` VALUES ('', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', '1993-12-11');
INSERT INTO `tbl_msg` VALUES ('1', 'Maaf, Username dan Password harus diisi');
INSERT INTO `tbl_msg` VALUES ('2', 'Username yang anda masukan tidak terdaftar');
INSERT INTO `tbl_msg` VALUES ('3', 'Password yang anda masukan tidak sesuai');
INSERT INTO `tbl_msg` VALUES ('4', 'Gagal, Berkas sudah ada.');
INSERT INTO `tbl_msg` VALUES ('5', 'Berhasil.');
INSERT INTO `tbl_msg` VALUES ('6', 'Gagal.');
INSERT INTO `tbl_msg` VALUES ('7', 'Username sudah ada');
INSERT INTO `tbl_msg` VALUES ('8', 'Rak Sudah Ada');
INSERT INTO `tbl_msg` VALUES ('9', 'Nama Jenis Sudah Ada.');
INSERT INTO `tbl_modul` VALUES ('1', 'php/modul/pilih_rak.php', 'Pilih Rak', '');
INSERT INTO `tbl_modul` VALUES ('2', 'php/modul/pilih_kolom.php', 'Pilih Kolom', '');
INSERT INTO `tbl_modul` VALUES ('3', 'php/modul/pilih_baris.php', 'Pilih Baris', '');
INSERT INTO `tbl_modul` VALUES ('4', 'php/modul/pilih_box.php', 'Pilih Box', '');
INSERT INTO `tbl_modul` VALUES ('5', 'php/modul/isi_berkas.php', 'Isi Berkas', '');
INSERT INTO `tbl_modul` VALUES ('10', 'php/modul/home.php', 'Home', '');
INSERT INTO `tbl_modul` VALUES ('11', 'php/modul/isi_peminjaman.php', 'Peminjaman', '');
INSERT INTO `tbl_modul` VALUES ('12', 'php/modul/arsip_berkas.php', 'Arsip Berkas', '');
INSERT INTO `tbl_modul` VALUES ('13', 'php/modul/isi_user.php', 'Isi User', '');
INSERT INTO `tbl_modul` VALUES ('14', 'php/modul/isi_rak.php', 'Isi Rak', '');
INSERT INTO `tbl_modul` VALUES ('15', 'php/modul/isi_jenis.php', 'Isi Jenis', '');
INSERT INTO `tbl_modul` VALUES ('16', 'php/modul/alat.php', 'Alat', '');
INSERT INTO `tbl_modul` VALUES ('17', 'php/modul/daluarsa.php', 'Daluarsa', '');