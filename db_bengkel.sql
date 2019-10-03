/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : db_bengkel

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2018-09-03 16:14:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `feedbackid` int(11) NOT NULL AUTO_INCREMENT,
  `penjualanid` int(11) NOT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `mstfeedbackid` int(11) DEFAULT NULL,
  PRIMARY KEY (`feedbackid`),
  KEY `penjualanid` (`penjualanid`),
  KEY `mstfeedbackid` (`mstfeedbackid`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`penjualanid`) REFERENCES `penjualan` (`penjualanid`),
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`mstfeedbackid`) REFERENCES `mst_feedback` (`mstfeedbackid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of feedback
-- ----------------------------

-- ----------------------------
-- Table structure for mst_feedback
-- ----------------------------
DROP TABLE IF EXISTS `mst_feedback`;
CREATE TABLE `mst_feedback` (
  `mstfeedbackid` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mstfeedbackid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_feedback
-- ----------------------------
INSERT INTO `mst_feedback` VALUES ('1', 'Pihak bengkel dapat menyediakan spare part yang dibutuhkan untuk layanan service');
INSERT INTO `mst_feedback` VALUES ('2', 'Pihak bengkel dapat menyediakan layanan yang dibutuhkan oleh pelanggan');
INSERT INTO `mst_feedback` VALUES ('3', 'Pihak bengkel dapat menyelesaikan layanan service sesuai dengan waktu yang dijanjikan');
INSERT INTO `mst_feedback` VALUES ('4', 'Pemeriksaan kendaraan tidak dilakukan dalam waktu yang lama');
INSERT INTO `mst_feedback` VALUES ('6', 'Pelanggan tidak menunggu lama untuk dilayani oleh pegawai bengkel (kurang dari 10 menit)');
INSERT INTO `mst_feedback` VALUES ('7', 'Pegawai bengkel dapat memberikan rekomendasi spare part kepada pelanggan');
INSERT INTO `mst_feedback` VALUES ('8', 'Pegawai bengkel dapat memberikan rekomendasi layanan kepada pelanggan');
INSERT INTO `mst_feedback` VALUES ('9', 'Pelanggan dapat mengerti mengenai solusi yang diberikan oleh pegawai bengkel');
INSERT INTO `mst_feedback` VALUES ('10', 'Layanan dan total yang harus dibayar sesuai dengan persetujuan');
INSERT INTO `mst_feedback` VALUES ('11', 'Pegawai bengkel menerima hasil keluhan pelanggan secara menyeluruh');

-- ----------------------------
-- Table structure for mst_jenis
-- ----------------------------
DROP TABLE IF EXISTS `mst_jenis`;
CREATE TABLE `mst_jenis` (
  `jenisid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jenisid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_jenis
-- ----------------------------
INSERT INTO `mst_jenis` VALUES ('1', 'Sedans');
INSERT INTO `mst_jenis` VALUES ('2', 'Jip');
INSERT INTO `mst_jenis` VALUES ('3', 'Pick Up');
INSERT INTO `mst_jenis` VALUES ('4', 'Bus Kecil');
INSERT INTO `mst_jenis` VALUES ('8', 'Family Car');
INSERT INTO `mst_jenis` VALUES ('9', 'City Car');

-- ----------------------------
-- Table structure for mst_kategori
-- ----------------------------
DROP TABLE IF EXISTS `mst_kategori`;
CREATE TABLE `mst_kategori` (
  `kategoriid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kategoriid`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_kategori
-- ----------------------------
INSERT INTO `mst_kategori` VALUES ('1', 'Oli');
INSERT INTO `mst_kategori` VALUES ('2', 'Minyak Rem');
INSERT INTO `mst_kategori` VALUES ('3', 'Filter');
INSERT INTO `mst_kategori` VALUES ('4', 'Pembersih Body & Interior');
INSERT INTO `mst_kategori` VALUES ('5', 'Absorber');
INSERT INTO `mst_kategori` VALUES ('6', 'Ball Joint');
INSERT INTO `mst_kategori` VALUES ('7', 'Cross Joint');
INSERT INTO `mst_kategori` VALUES ('8', 'Baud');
INSERT INTO `mst_kategori` VALUES ('9', 'Bohlam');
INSERT INTO `mst_kategori` VALUES ('10', 'Boot');
INSERT INTO `mst_kategori` VALUES ('11', 'Brake Pad');
INSERT INTO `mst_kategori` VALUES ('12', 'Brake Shoe');
INSERT INTO `mst_kategori` VALUES ('13', 'Busi');
INSERT INTO `mst_kategori` VALUES ('14', 'Clutch');
INSERT INTO `mst_kategori` VALUES ('15', 'Caliper Kit');
INSERT INTO `mst_kategori` VALUES ('16', 'Cylinder Kit');
INSERT INTO `mst_kategori` VALUES ('17', 'Dekrup');
INSERT INTO `mst_kategori` VALUES ('18', 'Air Aki');
INSERT INTO `mst_kategori` VALUES ('19', 'Shock Breaker');
INSERT INTO `mst_kategori` VALUES ('20', 'Kabel');
INSERT INTO `mst_kategori` VALUES ('21', 'Halogen');
INSERT INTO `mst_kategori` VALUES ('22', 'Dreg Laher');
INSERT INTO `mst_kategori` VALUES ('23', 'Seal');
INSERT INTO `mst_kategori` VALUES ('24', 'Gasket');
INSERT INTO `mst_kategori` VALUES ('25', 'Karet');
INSERT INTO `mst_kategori` VALUES ('26', 'Kondensor');
INSERT INTO `mst_kategori` VALUES ('27', 'Klakson');
INSERT INTO `mst_kategori` VALUES ('28', 'Kleman');
INSERT INTO `mst_kategori` VALUES ('29', 'Laher');
INSERT INTO `mst_kategori` VALUES ('30', 'Lower Arm');
INSERT INTO `mst_kategori` VALUES ('31', 'Mur Roda');
INSERT INTO `mst_kategori` VALUES ('32', 'Rack End');
INSERT INTO `mst_kategori` VALUES ('33', 'Stabil Link');
INSERT INTO `mst_kategori` VALUES ('34', 'Timing Belt');
INSERT INTO `mst_kategori` VALUES ('35', 'Tirerod');
INSERT INTO `mst_kategori` VALUES ('36', 'Vanbelt');
INSERT INTO `mst_kategori` VALUES ('37', 'Thermostat');
INSERT INTO `mst_kategori` VALUES ('39', 'Pewangi');
INSERT INTO `mst_kategori` VALUES ('40', 'Bos');

-- ----------------------------
-- Table structure for mst_merk
-- ----------------------------
DROP TABLE IF EXISTS `mst_merk`;
CREATE TABLE `mst_merk` (
  `merkid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`merkid`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_merk
-- ----------------------------
INSERT INTO `mst_merk` VALUES ('2', 'Audi');
INSERT INTO `mst_merk` VALUES ('4', 'BMW');
INSERT INTO `mst_merk` VALUES ('5', 'Chevrolet');
INSERT INTO `mst_merk` VALUES ('6', 'Cadilac');
INSERT INTO `mst_merk` VALUES ('7', 'Chery');
INSERT INTO `mst_merk` VALUES ('8', 'Crysler Jeep');
INSERT INTO `mst_merk` VALUES ('11', 'Daihatsu');
INSERT INTO `mst_merk` VALUES ('13', 'Ferrari');
INSERT INTO `mst_merk` VALUES ('14', 'Flat');
INSERT INTO `mst_merk` VALUES ('15', 'Ford');
INSERT INTO `mst_merk` VALUES ('17', 'Holden');
INSERT INTO `mst_merk` VALUES ('18', 'Honda');
INSERT INTO `mst_merk` VALUES ('19', 'Hammer');
INSERT INTO `mst_merk` VALUES ('20', 'Hyundai');
INSERT INTO `mst_merk` VALUES ('21', 'Isuzu');
INSERT INTO `mst_merk` VALUES ('22', 'Jaguar');
INSERT INTO `mst_merk` VALUES ('23', 'KIA');
INSERT INTO `mst_merk` VALUES ('24', 'Land Rover');
INSERT INTO `mst_merk` VALUES ('25', 'Lexus');
INSERT INTO `mst_merk` VALUES ('26', 'Mazda');
INSERT INTO `mst_merk` VALUES ('27', 'Mercedes Benz');
INSERT INTO `mst_merk` VALUES ('28', 'Mini');
INSERT INTO `mst_merk` VALUES ('29', 'Mitsubishi');
INSERT INTO `mst_merk` VALUES ('30', 'Moris');
INSERT INTO `mst_merk` VALUES ('31', 'Nissan');
INSERT INTO `mst_merk` VALUES ('33', 'Peugeot');
INSERT INTO `mst_merk` VALUES ('34', 'Porsche');
INSERT INTO `mst_merk` VALUES ('35', 'Proton');
INSERT INTO `mst_merk` VALUES ('36', 'Renault');
INSERT INTO `mst_merk` VALUES ('37', 'Subaru');
INSERT INTO `mst_merk` VALUES ('38', 'Suzuki');
INSERT INTO `mst_merk` VALUES ('39', 'Toyota ');
INSERT INTO `mst_merk` VALUES ('40', 'Volvo');
INSERT INTO `mst_merk` VALUES ('41', 'VW');

-- ----------------------------
-- Table structure for mst_pelayanan
-- ----------------------------
DROP TABLE IF EXISTS `mst_pelayanan`;
CREATE TABLE `mst_pelayanan` (
  `pelayananid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `tipepelayananid` int(11) DEFAULT NULL,
  PRIMARY KEY (`pelayananid`),
  KEY `tipepelayananid` (`tipepelayananid`),
  CONSTRAINT `mst_pelayanan_ibfk_1` FOREIGN KEY (`tipepelayananid`) REFERENCES `mst_tipe_pelayanan` (`tipepelayananid`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_pelayanan
-- ----------------------------
INSERT INTO `mst_pelayanan` VALUES ('2', 'Ganti Oli', '4');
INSERT INTO `mst_pelayanan` VALUES ('4', 'Cek bagian roda (Ball Joint)', '3');
INSERT INTO `mst_pelayanan` VALUES ('5', 'Cek lampu / Halogen', '4');
INSERT INTO `mst_pelayanan` VALUES ('6', 'Cek Mesin (Busi)', '4');
INSERT INTO `mst_pelayanan` VALUES ('7', 'Ganti Mur', '4');
INSERT INTO `mst_pelayanan` VALUES ('8', 'Ganti Baud', '4');
INSERT INTO `mst_pelayanan` VALUES ('9', 'Perawatan Mobil', '4');
INSERT INTO `mst_pelayanan` VALUES ('10', 'Cek Kelistrikan', '4');
INSERT INTO `mst_pelayanan` VALUES ('11', 'Cek Rem (Brake Pad)', '3');
INSERT INTO `mst_pelayanan` VALUES ('12', 'Cek bagian roda (Cross Joint)', '3');
INSERT INTO `mst_pelayanan` VALUES ('13', 'Cek Filter', '3');
INSERT INTO `mst_pelayanan` VALUES ('14', 'Cek Minyak Rem', '4');
INSERT INTO `mst_pelayanan` VALUES ('15', 'cek Rem (Brake Shoe)', '3');
INSERT INTO `mst_pelayanan` VALUES ('16', 'Tambah Pewangi', '4');
INSERT INTO `mst_pelayanan` VALUES ('17', 'Ganti Abs', '3');
INSERT INTO `mst_pelayanan` VALUES ('18', 'Ganti Tierod', '3');
INSERT INTO `mst_pelayanan` VALUES ('19', 'Ganti Thermostat', '4');
INSERT INTO `mst_pelayanan` VALUES ('20', 'Ganti Cylinder', '4');
INSERT INTO `mst_pelayanan` VALUES ('21', 'Ganti Kleman', '3');
INSERT INTO `mst_pelayanan` VALUES ('22', 'Ganti Seal & Karet', '4');
INSERT INTO `mst_pelayanan` VALUES ('23', 'Cek bagian roda (Lower Arm)', '3');
INSERT INTO `mst_pelayanan` VALUES ('24', 'Ganti Timingbelt', '3');
INSERT INTO `mst_pelayanan` VALUES ('25', 'Ganti vanbelt', '4');
INSERT INTO `mst_pelayanan` VALUES ('26', 'Ganti Dekrup', '3');
INSERT INTO `mst_pelayanan` VALUES ('27', 'Cek Shock Breaker', '3');
INSERT INTO `mst_pelayanan` VALUES ('28', 'Cek Boot & Bos', '4');
INSERT INTO `mst_pelayanan` VALUES ('29', 'Cek Mesin (Gasket)', '4');
INSERT INTO `mst_pelayanan` VALUES ('30', 'Cek Kondensor', '4');
INSERT INTO `mst_pelayanan` VALUES ('31', 'Cek aki', '4');
INSERT INTO `mst_pelayanan` VALUES ('32', 'Cek Laher', '4');
INSERT INTO `mst_pelayanan` VALUES ('33', 'Cek Dreg Laher', '4');
INSERT INTO `mst_pelayanan` VALUES ('34', 'Cek bagian roda (Rack End)', '3');
INSERT INTO `mst_pelayanan` VALUES ('35', 'Cek bagian roda (Tirerod)', '3');
INSERT INTO `mst_pelayanan` VALUES ('36', 'Cek bagian roda (Stabil Link)', '4');

-- ----------------------------
-- Table structure for mst_pelayanan_detail
-- ----------------------------
DROP TABLE IF EXISTS `mst_pelayanan_detail`;
CREATE TABLE `mst_pelayanan_detail` (
  `pelayanandetailid` int(11) NOT NULL AUTO_INCREMENT,
  `merkid` int(11) DEFAULT NULL,
  `jenisid` int(11) DEFAULT NULL,
  `pelayananid` int(11) DEFAULT NULL,
  `sparepartid` int(11) DEFAULT NULL,
  PRIMARY KEY (`pelayanandetailid`),
  KEY `merkid` (`merkid`),
  KEY `jenisid` (`jenisid`),
  KEY `pelayananid` (`pelayananid`),
  KEY `sparepartid` (`sparepartid`),
  CONSTRAINT `mst_pelayanan_detail_ibfk_1` FOREIGN KEY (`merkid`) REFERENCES `mst_merk` (`merkid`),
  CONSTRAINT `mst_pelayanan_detail_ibfk_2` FOREIGN KEY (`jenisid`) REFERENCES `mst_jenis` (`jenisid`),
  CONSTRAINT `mst_pelayanan_detail_ibfk_3` FOREIGN KEY (`pelayananid`) REFERENCES `mst_pelayanan` (`pelayananid`),
  CONSTRAINT `mst_pelayanan_detail_ibfk_4` FOREIGN KEY (`sparepartid`) REFERENCES `sparepart` (`sparepartid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_pelayanan_detail
-- ----------------------------

-- ----------------------------
-- Table structure for mst_satuan
-- ----------------------------
DROP TABLE IF EXISTS `mst_satuan`;
CREATE TABLE `mst_satuan` (
  `satuanid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`satuanid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_satuan
-- ----------------------------
INSERT INTO `mst_satuan` VALUES ('1', 'Dus');
INSERT INTO `mst_satuan` VALUES ('2', 'Buah');
INSERT INTO `mst_satuan` VALUES ('3', 'Set');
INSERT INTO `mst_satuan` VALUES ('6', 'Liter');

-- ----------------------------
-- Table structure for mst_tipe_pelayanan
-- ----------------------------
DROP TABLE IF EXISTS `mst_tipe_pelayanan`;
CREATE TABLE `mst_tipe_pelayanan` (
  `tipepelayananid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  PRIMARY KEY (`tipepelayananid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mst_tipe_pelayanan
-- ----------------------------
INSERT INTO `mst_tipe_pelayanan` VALUES ('3', 'Sedang', '30');
INSERT INTO `mst_tipe_pelayanan` VALUES ('4', 'Ringan', '14');

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `pelangganid` int(11) NOT NULL AUTO_INCREMENT,
  `merkid` int(11) DEFAULT NULL,
  `jenisid` int(11) DEFAULT NULL,
  `nama_pemilik` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nopolisi` varchar(255) DEFAULT NULL,
  `notelp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pelangganid`),
  KEY `merkid` (`merkid`),
  KEY `jenisid` (`jenisid`),
  CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`merkid`) REFERENCES `mst_merk` (`merkid`),
  CONSTRAINT `pelanggan_ibfk_2` FOREIGN KEY (`jenisid`) REFERENCES `mst_jenis` (`jenisid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES ('4', '39', '1', 'Adit', 'TKI 1', 'D 2049', '08926472912');
INSERT INTO `pelanggan` VALUES ('5', '39', '1', 'Budi', 'Jalan Holis 257', 'D 1201 FS', '08926472901');
INSERT INTO `pelanggan` VALUES ('6', '39', '1', 'Chandra', 'TKI 1 blok A no 1', 'D1504 FF', '0858127412');
INSERT INTO `pelanggan` VALUES ('7', '24', '2', 'Dedi', 'Tki 1 blok a no 2', 'D 1201 FD', '08926472902');
INSERT INTO `pelanggan` VALUES ('8', '29', '1', 'Frans', 'TKI 1 blok A no 3', 'D 1201 FG', '08926472903');
INSERT INTO `pelanggan` VALUES ('9', '18', '1', 'Gita', 'TKI 1 blok A no 4', 'D 1201 FH', '08926472904');
INSERT INTO `pelanggan` VALUES ('10', '29', '1', 'Hans', 'TKI 1 blok A no 5', 'D 1201 FJ', '08926472905');
INSERT INTO `pelanggan` VALUES ('11', '24', '2', 'Intan', 'TKI 1 blok A no 6', 'D 1201 FK', '08926472906');
INSERT INTO `pelanggan` VALUES ('12', '24', '2', 'Jajang', 'TKI 1 blok A no 7', 'D 1201 FZ', '08926472913');
INSERT INTO `pelanggan` VALUES ('13', '29', '1', 'Krisna', 'TKI 1 blok A no 8', 'D 1201 FX', '0858127414');
INSERT INTO `pelanggan` VALUES ('14', '24', '2', 'Linda', 'TKI 1 blok A no 10', 'D 1201 FC', '0858127416');

-- ----------------------------
-- Table structure for pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `pembelianid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal_datang` datetime DEFAULT NULL,
  PRIMARY KEY (`pembelianid`),
  KEY `userid` (`userid`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pembelian
-- ----------------------------
INSERT INTO `pembelian` VALUES ('32', '1', '2018-05-01 00:00:00', '18770915', '2018-05-15 00:00:00');
INSERT INTO `pembelian` VALUES ('33', '1', '2018-05-15 00:00:00', '526270', '2018-05-29 00:00:00');
INSERT INTO `pembelian` VALUES ('35', '1', '2018-04-01 00:00:00', '526270', '2018-04-16 00:00:00');
INSERT INTO `pembelian` VALUES ('36', '1', '2018-04-15 00:00:00', '526270', '2018-04-30 00:00:00');
INSERT INTO `pembelian` VALUES ('37', '1', '2018-03-01 00:00:00', '52627', '2018-03-16 00:00:00');
INSERT INTO `pembelian` VALUES ('38', '1', '2018-03-15 00:00:00', '105254', '2018-03-31 00:00:00');
INSERT INTO `pembelian` VALUES ('39', '1', '2018-02-01 00:00:00', '52600', '2018-02-17 00:00:00');
INSERT INTO `pembelian` VALUES ('40', '1', '2018-02-15 00:00:00', '52000', '2018-03-04 00:00:00');
INSERT INTO `pembelian` VALUES ('43', '1', '2017-09-01 00:00:00', '320000', '2017-10-01 00:00:00');
INSERT INTO `pembelian` VALUES ('44', '1', '2017-10-02 00:00:00', '12000', '2017-11-01 00:00:00');
INSERT INTO `pembelian` VALUES ('45', '1', '2017-11-01 00:00:00', '4000', '2017-12-01 00:00:00');
INSERT INTO `pembelian` VALUES ('46', '1', '2017-12-01 00:00:00', '4000', '2017-12-31 00:00:00');
INSERT INTO `pembelian` VALUES ('47', '1', '2018-01-02 00:00:00', '4000', '2018-02-02 00:00:00');
INSERT INTO `pembelian` VALUES ('48', '1', '2018-02-01 00:00:00', '4000', '2018-03-05 00:00:00');
INSERT INTO `pembelian` VALUES ('49', '1', '2018-03-01 00:00:00', '4000', '2018-04-02 00:00:00');
INSERT INTO `pembelian` VALUES ('50', '1', '2018-04-02 00:00:00', '12000', '2018-05-05 00:00:00');
INSERT INTO `pembelian` VALUES ('52', '1', '2018-06-21 00:00:00', '50000', null);

-- ----------------------------
-- Table structure for pembelian_detail
-- ----------------------------
DROP TABLE IF EXISTS `pembelian_detail`;
CREATE TABLE `pembelian_detail` (
  `pembeliandetailid` int(11) NOT NULL AUTO_INCREMENT,
  `sparepartid` int(11) DEFAULT NULL,
  `jumlah` int(255) DEFAULT NULL,
  `hargasatuan` int(255) DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  `pembelianid` int(11) DEFAULT NULL,
  PRIMARY KEY (`pembeliandetailid`),
  KEY `sparepartid` (`sparepartid`),
  KEY `pembelianid` (`pembelianid`),
  CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`sparepartid`) REFERENCES `sparepart` (`sparepartid`),
  CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`pembelianid`) REFERENCES `pembelian` (`pembelianid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pembelian_detail
-- ----------------------------

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `penjualanid` int(11) NOT NULL AUTO_INCREMENT,
  `nomorfaktur` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `tanggal_faktur` datetime DEFAULT NULL,
  `tanggal_cetak` datetime DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  `woid` int(11) DEFAULT NULL,
  PRIMARY KEY (`penjualanid`),
  KEY `userid` (`userid`),
  KEY `woid` (`woid`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`),
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`woid`) REFERENCES `workorder` (`workorderid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penjualan
-- ----------------------------

-- ----------------------------
-- Table structure for sparepart
-- ----------------------------
DROP TABLE IF EXISTS `sparepart`;
CREATE TABLE `sparepart` (
  `sparepartid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `jenisid` int(255) DEFAULT NULL,
  `kategoriid` int(255) DEFAULT NULL,
  `stokakhir` int(255) DEFAULT NULL,
  `satuanid` int(255) DEFAULT NULL,
  `hargajual` int(11) DEFAULT NULL,
  PRIMARY KEY (`sparepartid`),
  KEY `jenisid` (`jenisid`) USING BTREE,
  KEY `kategoriid` (`kategoriid`),
  KEY `satuanid` (`satuanid`),
  CONSTRAINT `sparepart_ibfk_1` FOREIGN KEY (`jenisid`) REFERENCES `mst_jenis` (`jenisid`),
  CONSTRAINT `sparepart_ibfk_2` FOREIGN KEY (`kategoriid`) REFERENCES `mst_kategori` (`kategoriid`),
  CONSTRAINT `sparepart_ibfk_3` FOREIGN KEY (`satuanid`) REFERENCES `mst_satuan` (`satuanid`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sparepart
-- ----------------------------
INSERT INTO `sparepart` VALUES ('5', 'Repsol Diesel SHFD 15/40 Liter', '8', '1', '1', '6', '65000');
INSERT INTO `sparepart` VALUES ('6', 'Repsol Diesel SHFD 15/40 Liter', '9', '1', '8', '6', '65000');
INSERT INTO `sparepart` VALUES ('8', 'Repsol Super 20/50 4 liter', '9', '1', '143', '6', '60000');
INSERT INTO `sparepart` VALUES ('10', 'Minyak Rem Bosch', '3', '2', null, '2', '25000');
INSERT INTO `sparepart` VALUES ('12', 'Minyak Rem Jumbo', '4', '2', null, '2', '25000');
INSERT INTO `sparepart` VALUES ('13', 'F/F ME 971553', '4', '3', null, '2', '75000');
INSERT INTO `sparepart` VALUES ('15', 'F/F Solar LC Arpi', '2', '3', null, '2', '115000');
INSERT INTO `sparepart` VALUES ('18', 'Kit Interior Pump', '9', '4', null, '2', '21000');
INSERT INTO `sparepart` VALUES ('19', 'Kit Wash & Wax 800 ML', '1', '4', null, '2', '30000');
INSERT INTO `sparepart` VALUES ('20', 'ABS 48500-09020', '3', '5', '9', '2', '255000');
INSERT INTO `sparepart` VALUES ('22', 'ABS 48531-09430', '9', '5', null, '2', '395000');
INSERT INTO `sparepart` VALUES ('24', 'Ball Joint  Bawah G Pnt ', '3', '6', null, '2', '370000');
INSERT INTO `sparepart` VALUES ('26', 'Ball Joint  Atas G Pnt', '2', '6', null, '2', '375000');
INSERT INTO `sparepart` VALUES ('28', 'Cross Joint 04371-0K050', '8', '7', null, '2', '560000');
INSERT INTO `sparepart` VALUES ('30', 'Cross Joint PNT 2.5G', '8', '7', null, '2', '450000');
INSERT INTO `sparepart` VALUES ('32', 'Baud Platina', '3', '8', null, '2', '1000');
INSERT INTO `sparepart` VALUES ('35', 'Baud Roda 1.5 KF', '1', '8', null, '2', '7000');
INSERT INTO `sparepart` VALUES ('36', 'Bohlam Philips 12455', '1', '9', null, '2', '40000');
INSERT INTO `sparepart` VALUES ('39', 'Bohlam Philips 12065', '1', '9', null, '2', '50000');
INSERT INTO `sparepart` VALUES ('40', 'Boot As Roda TCM', '3', '10', null, '2', '35000');
INSERT INTO `sparepart` VALUES ('42', 'Boot Stir KF50', '1', '10', null, '2', '55000');
INSERT INTO `sparepart` VALUES ('43', 'Brake Pad Avanza', '8', '11', null, '2', '245000');
INSERT INTO `sparepart` VALUES ('44', 'Brake Pad DPN Jazz', '9', '11', null, '2', '317000');
INSERT INTO `sparepart` VALUES ('45', 'Brake Shoe 6627', '2', '12', null, '2', '360000');
INSERT INTO `sparepart` VALUES ('47', 'Brake Shoe Taff K 0022', '2', '12', null, '2', '155000');
INSERT INTO `sparepart` VALUES ('48', 'Busi Iri Deum', '3', '13', null, '2', '98000');
INSERT INTO `sparepart` VALUES ('49', 'Busi Double Iredium Set', '9', '13', null, '2', '250000');
INSERT INTO `sparepart` VALUES ('50', 'Cover Clutch 31210-0K101', '3', '14', null, '2', '835000');
INSERT INTO `sparepart` VALUES ('51', 'Caliper Kit F70 87602', '2', '15', null, '2', '55000');
INSERT INTO `sparepart` VALUES ('52', 'Caliper Kit 55100-82820 KTN', '2', '15', null, '2', '60000');
INSERT INTO `sparepart` VALUES ('53', 'Cylinder Kit 044/8-0K130', '4', '16', null, '2', '580000');
INSERT INTO `sparepart` VALUES ('54', 'Cylinder Kit 044/8-0K060', '3', '16', null, '2', '360000');
INSERT INTO `sparepart` VALUES ('55', 'Dekrup 061', '1', '17', null, '2', '598000');
INSERT INTO `sparepart` VALUES ('56', 'Dekrup 011', '3', '17', null, '2', '520000');
INSERT INTO `sparepart` VALUES ('58', 'Air Aki Edna Putih', '8', '18', null, '3', '8000');
INSERT INTO `sparepart` VALUES ('60', 'Air Aki Edna Merah', '1', '18', null, '3', '8000');
INSERT INTO `sparepart` VALUES ('61', 'Shock Breaker DPN Elf', '4', '19', null, '3', '225000');
INSERT INTO `sparepart` VALUES ('62', 'Shock Breaker BLK Elf', '4', '19', null, '3', '225000');
INSERT INTO `sparepart` VALUES ('63', 'Kabel MT 08 M/M', '1', '20', null, '2', '5000');
INSERT INTO `sparepart` VALUES ('65', 'Kabel MT B', '1', '20', null, '2', '5000');
INSERT INTO `sparepart` VALUES ('66', 'Halogen Indo 60/55', '8', '21', null, '2', '20000');
INSERT INTO `sparepart` VALUES ('68', 'Halogen Forch H11', '1', '21', null, '2', '110000');
INSERT INTO `sparepart` VALUES ('69', 'Dreg Laher Avanza', '8', '22', null, '2', '315000');
INSERT INTO `sparepart` VALUES ('70', 'Dreg Laher 2.5', '3', '22', null, '2', '215000');
INSERT INTO `sparepart` VALUES ('71', 'Oil Seal Roda RR 277', '3', '23', null, '2', '42000');
INSERT INTO `sparepart` VALUES ('73', 'Oil Seal 31020 Avanza', '8', '23', null, '2', '80000');
INSERT INTO `sparepart` VALUES ('74', 'Gasket 12151-13011', '2', '24', null, '2', '185000');
INSERT INTO `sparepart` VALUES ('75', 'Gasket 12151-13010', '2', '24', null, '2', '225000');
INSERT INTO `sparepart` VALUES ('76', 'Karet Per B', '8', '25', null, '2', '16000');
INSERT INTO `sparepart` VALUES ('78', 'Karet Per K', '1', '25', null, '2', '10000');
INSERT INTO `sparepart` VALUES ('79', 'Karet Per K', '9', '25', null, '2', '10000');
INSERT INTO `sparepart` VALUES ('80', 'Kondensor Hardtop', '2', '26', null, '2', '19000');
INSERT INTO `sparepart` VALUES ('81', 'Kondensor 2K', '3', '26', null, '2', '29000');
INSERT INTO `sparepart` VALUES ('82', 'Klakson Hella 2T SET', '1', '27', null, '3', '350000');
INSERT INTO `sparepart` VALUES ('83', 'Klakson MD STD 24V', '1', '27', null, '3', '175000');
INSERT INTO `sparepart` VALUES ('84', 'Kleman Plastik K', '1', '28', null, '3', '2500');
INSERT INTO `sparepart` VALUES ('86', 'Kleman Slang 5/8\"', '2', '28', null, '3', '2500');
INSERT INTO `sparepart` VALUES ('87', 'Laher 6000', '3', '29', null, '2', '25000');
INSERT INTO `sparepart` VALUES ('88', 'Laher DAC 3064 F', '4', '29', null, '2', '215000');
INSERT INTO `sparepart` VALUES ('89', 'Lower Arm Avanza LH/RH', '8', '30', null, '3', '475000');
INSERT INTO `sparepart` VALUES ('90', 'Lower Arm Karimun', '9', '30', null, '3', '210000');
INSERT INTO `sparepart` VALUES ('91', 'Mur Roda 09159-12050/12079', '1', '31', null, '2', '25000');
INSERT INTO `sparepart` VALUES ('94', 'Rack End Avanza', '8', '32', null, '3', '165000');
INSERT INTO `sparepart` VALUES ('95', 'Rack End APV', '8', '32', null, '3', '145000');
INSERT INTO `sparepart` VALUES ('96', 'Stabil Link Kit Vios', '1', '33', null, '3', '50000');
INSERT INTO `sparepart` VALUES ('97', 'Stabil Link Avanza/Xenia', '8', '33', null, '3', '130000');
INSERT INTO `sparepart` VALUES ('98', 'Timing Belt Short MD 310484', '8', '34', null, '2', '184000');
INSERT INTO `sparepart` VALUES ('100', 'Timing Belt Long MD 300470', '1', '34', null, '2', '323000');
INSERT INTO `sparepart` VALUES ('101', 'Tirerod Maestro', '2', '35', null, '3', '145000');
INSERT INTO `sparepart` VALUES ('102', 'Tirerod Accord 2000', '1', '35', null, '3', '145000');
INSERT INTO `sparepart` VALUES ('103', 'Vanbelt 35', '8', '36', null, '2', '35000');
INSERT INTO `sparepart` VALUES ('105', 'Vanbelt 2290', '3', '36', null, '2', '35000');
INSERT INTO `sparepart` VALUES ('106', 'Thermostat K/K 06010', '1', '37', null, '3', '120000');
INSERT INTO `sparepart` VALUES ('108', 'Glade Racing AC', '1', '39', null, '3', '19000');
INSERT INTO `sparepart` VALUES ('109', 'Glad Sport Cair', '1', '39', null, '3', '32000');
INSERT INTO `sparepart` VALUES ('110', 'Bos Stir Carry G 79030', '8', '40', null, '3', '100000');
INSERT INTO `sparepart` VALUES ('111', 'Jumbo Garder 90 Lt', '1', '1', null, '6', '40000');

-- ----------------------------
-- Table structure for sys_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_log`;
CREATE TABLE `sys_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `idPenerima` int(11) DEFAULT NULL,
  `aksi` text,
  `waktu` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `path` text,
  `statusNotif` int(11) DEFAULT '0',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_log
-- ----------------------------

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` enum('Administrator','Kasir','Manager','Kepala Gudang','Service Advisor') DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', 'Administrator', 'Administrator', '/4/9Rmz10P/qoQcwIh0RMan6Ag0Ru72oDeyreLoLNZW9sgF2xKlxHxwy9OGqV5vDweIzwlX1iJXlWlgFctXoaQ==');
INSERT INTO `sys_user` VALUES ('2', 'Kasir', 'Kasir', 'BhBXhkOBlQyHauxRJjS4nZea1527utwBs3kkdgCkEOoJ6UP8GHE+UoTosV0A9MVpqWiggS58bHOLJi8nnXsQjw==');
INSERT INTO `sys_user` VALUES ('3', 'manager', 'Manager', 'u/bcKcCiYYWwwGON8mUO0fWyRN6EOdrle8gXuQq74/wLBuinKSILwKhztdK7sXGViyHTemsbYiGEbrS9ZpilmA==');
INSERT INTO `sys_user` VALUES ('4', 'gudang', 'Kepala Gudang', 'TCobkIuzgXZlMB1fsJMb5b3ALs0frb4hzLRRZi2NPSaHCs/+vR7dj0iEky/+gJlCbfMkj3KUVTtMDzsD4oPQZw==');
INSERT INTO `sys_user` VALUES ('5', 'bengkel', 'Service Advisor', 'vN+ZZOwlvvD96ae2AyDu4H0XnU98Lc71imy2i9IWesFhGIZoGrp5mdgP/TI+ZUFAaqy9UZJEx4oPPv35kDDf4g==');

-- ----------------------------
-- Table structure for workorder
-- ----------------------------
DROP TABLE IF EXISTS `workorder`;
CREATE TABLE `workorder` (
  `workorderid` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) DEFAULT NULL,
  `keluhan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `pelangganid` int(11) DEFAULT NULL,
  PRIMARY KEY (`workorderid`),
  KEY `userid` (`userid`),
  KEY `pelangganid` (`pelangganid`),
  CONSTRAINT `workorder_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`),
  CONSTRAINT `workorder_ibfk_2` FOREIGN KEY (`pelangganid`) REFERENCES `pelanggan` (`pelangganid`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of workorder
-- ----------------------------
INSERT INTO `workorder` VALUES ('7', 'WO0000', 'Ganti Oli', '', 'F', null, '2018-06-04 09:06:55', '2018-06-04 09:12:58', '1', '4');
INSERT INTO `workorder` VALUES ('8', 'WO0007', 'Ganti Oli', '', 'F', null, '2018-06-04 14:00:05', '2018-06-04 14:03:58', '1', '4');
INSERT INTO `workorder` VALUES ('9', 'WO0008', 'Ganti Oli', '', 'F', null, '2018-06-04 14:04:41', '2018-06-04 14:05:02', '1', '5');
INSERT INTO `workorder` VALUES ('10', 'WO0009', 'Asap Knalpot Kebul', '', 'F', null, '2018-06-04 14:16:55', '2018-06-04 14:17:19', '1', '5');
INSERT INTO `workorder` VALUES ('11', 'WO0010', 'Ganti Oli Rutin', '', 'F', null, '2018-06-04 14:17:47', '2018-06-04 14:18:07', '1', '7');
INSERT INTO `workorder` VALUES ('12', 'WO0011', 'Ganti Oli', '', 'F', null, '2018-06-04 14:18:51', '2018-06-04 14:20:17', '1', '9');
INSERT INTO `workorder` VALUES ('13', 'WO0012', 'Asap Knalpot Kebul', '', 'F', null, '2018-06-04 14:20:50', '2018-06-04 14:21:15', '1', '11');
INSERT INTO `workorder` VALUES ('14', 'WO0013', 'Ganti oli rutin', '', 'F', null, '2018-06-04 14:22:01', '2018-06-04 14:22:21', '1', '10');
INSERT INTO `workorder` VALUES ('15', 'WO0014', 'Ganti oli', '', 'F', null, '2018-06-04 14:23:29', '2018-06-04 14:23:48', '1', '7');
INSERT INTO `workorder` VALUES ('16', 'WO0015', 'Ganti Oli', '', 'F', null, '2018-06-04 14:24:15', '2018-06-04 14:24:38', '1', '5');
INSERT INTO `workorder` VALUES ('17', 'WO0016', 'Ganti oli', '', 'F', null, '2018-06-04 14:25:23', '2018-06-04 14:25:52', '1', '11');
INSERT INTO `workorder` VALUES ('18', 'WO0017', 'Ganti Oli', '', 'F', null, '2018-06-04 14:27:49', '2018-06-04 14:28:57', '1', '8');
INSERT INTO `workorder` VALUES ('19', 'WO0018', 'Ganti Oli', '', 'F', null, '2018-06-04 14:29:22', '2018-06-04 14:30:00', '1', '9');
INSERT INTO `workorder` VALUES ('20', 'WO0019', 'Ganti Oli', '', 'F', null, '2018-06-04 14:31:14', '2018-06-04 14:31:34', '1', '12');
INSERT INTO `workorder` VALUES ('21', 'WO0020', 'Ganti Oli', '', 'F', null, '2018-06-04 14:31:49', '2018-06-04 14:32:59', '1', '5');
INSERT INTO `workorder` VALUES ('22', 'WO0021', 'Ganti Oli', '', 'F', null, '2018-06-04 14:33:33', '2018-06-04 14:33:55', '1', '12');
INSERT INTO `workorder` VALUES ('23', 'WO0022', 'Ganti Oli', '', 'F', null, '2018-06-04 14:34:48', '2018-06-04 14:35:38', '1', '13');
INSERT INTO `workorder` VALUES ('24', 'WO0023', 'Ganti Oli', '', 'F', null, '2018-06-04 14:36:17', '2018-06-04 14:36:35', '1', '13');
INSERT INTO `workorder` VALUES ('25', 'WO0024', 'Ganti Oli', '', 'F', null, '2018-06-04 14:36:52', '2018-06-04 14:37:09', '1', '5');
INSERT INTO `workorder` VALUES ('26', 'WO0025', 'Asap Knalpot Kebul', '', 'F', null, '2018-06-04 14:38:44', '2018-06-04 14:39:20', '1', '8');
INSERT INTO `workorder` VALUES ('27', 'WO0026', 'Ganti Oli', '', 'F', null, '2018-06-04 14:40:06', '2018-06-04 14:42:05', '1', '5');
INSERT INTO `workorder` VALUES ('28', 'WO0027', 'Ganti Oli', '', 'F', null, '2018-06-04 14:43:00', '2018-06-04 14:43:30', '1', '13');
INSERT INTO `workorder` VALUES ('29', 'WO0028', 'Ganti Oli', '', 'F', null, '2018-06-04 14:45:29', '2018-06-04 14:46:07', '1', '13');
INSERT INTO `workorder` VALUES ('30', 'WO0029', 'Ganti Oli', '', 'F', null, '2018-06-04 14:46:27', '2018-06-04 14:46:48', '1', '9');
INSERT INTO `workorder` VALUES ('31', 'WO0030', 'Asap Knalpot Kebul', '', 'F', null, '2018-06-04 14:48:05', '2018-06-04 14:48:39', '1', '14');
INSERT INTO `workorder` VALUES ('32', 'WO0031', 'Ganti Oli', '', 'F', null, '2018-06-04 14:49:30', '2018-06-04 14:49:57', '1', '12');
INSERT INTO `workorder` VALUES ('33', 'WO0032', 'Ganti Oli Rutin', '', 'F', null, '2018-06-04 14:50:27', '2018-06-04 14:50:49', '1', '8');
INSERT INTO `workorder` VALUES ('34', 'WO0033', 'Ganti Oli', '', 'F', null, '2018-06-04 14:51:11', '2018-06-04 14:52:09', '1', '5');
INSERT INTO `workorder` VALUES ('35', 'WO0034', 'Ganti Oli', '', 'F', null, '2018-06-04 14:52:32', '2018-06-04 14:53:00', '1', '4');
INSERT INTO `workorder` VALUES ('36', 'WO0035', 'Asap Knalpot Kebul', '', 'F', null, '2018-06-04 14:53:25', '2018-06-04 14:55:38', '1', '4');
INSERT INTO `workorder` VALUES ('37', 'WO0036', 'Ganti Oli', '', 'F', null, '2018-06-04 14:56:24', '2018-06-04 14:56:57', '1', '10');
INSERT INTO `workorder` VALUES ('38', 'WO0037', 'Ganti Oli', '', 'F', null, '2018-06-04 14:58:44', '2018-06-04 15:03:08', '1', '14');
INSERT INTO `workorder` VALUES ('39', 'WO0038', 'Ganti Oli', '', 'F', null, '2018-06-04 15:01:24', '2018-06-04 15:03:32', '1', '13');
INSERT INTO `workorder` VALUES ('40', 'WO0039', 'Ganti Oli', '', 'F', null, '2018-06-04 15:01:59', '2018-06-04 15:04:40', '1', '13');
INSERT INTO `workorder` VALUES ('41', 'WO0040', 'Ganti Oli', '', 'F', null, '2018-06-04 15:05:00', '2018-06-04 15:05:28', '1', '4');
INSERT INTO `workorder` VALUES ('42', 'WO0041', 'Ganti Oli Rutin', '', 'F', null, '2018-06-04 15:05:52', '2018-06-04 15:06:23', '1', '10');
INSERT INTO `workorder` VALUES ('43', 'WO0042', 'Ganti Oli', '', 'F', null, '2018-06-04 15:07:09', '2018-06-04 15:07:38', '1', '6');
INSERT INTO `workorder` VALUES ('44', 'WO0043', 'Ganti Oli', '', 'F', null, '2018-06-04 15:07:51', '2018-06-04 15:08:13', '1', '7');
INSERT INTO `workorder` VALUES ('45', 'WO0044', 'Ganti Oli', '', 'F', null, '2018-06-04 15:08:40', '2018-06-04 15:08:54', '1', '7');
INSERT INTO `workorder` VALUES ('46', 'WO0045', 'Ganti Oli', '', 'F', null, '2018-06-04 15:09:07', '2018-06-04 15:09:27', '1', '9');
INSERT INTO `workorder` VALUES ('47', 'WO0046', 'Ganti Oli', '', 'NF', null, '2018-06-04 15:16:06', null, '1', '14');
INSERT INTO `workorder` VALUES ('48', 'WO0047', 'Agak sulit belok', '', 'F', null, '2018-06-05 01:12:09', '2018-06-05 02:21:39', '1', '4');
INSERT INTO `workorder` VALUES ('49', 'WO0048', 'Agak Sulit belok', '', 'F', null, '2018-06-05 02:22:05', '2018-06-05 02:22:30', '1', '4');
INSERT INTO `workorder` VALUES ('50', 'WO0049', 'Ganti Oli', '', 'F', null, '2018-06-05 02:22:44', '2018-06-05 02:22:54', '1', '5');
INSERT INTO `workorder` VALUES ('51', 'WO0050', 'Ganti abs', '', 'F', null, '2018-06-05 02:33:22', '2018-06-05 02:33:34', '1', '4');
INSERT INTO `workorder` VALUES ('52', 'WO0051', 'Ganti abs', '', 'NF', null, '2018-06-05 02:34:34', null, '1', '4');
INSERT INTO `workorder` VALUES ('53', 'WO0054', 'Ganti Abs', '', 'F', null, '2018-06-05 02:44:01', '2018-05-07 00:00:00', '1', '4');
INSERT INTO `workorder` VALUES ('54', 'WO0053', 'Ganti abs', '', 'F', null, '2018-06-05 02:37:55', '2018-05-08 00:00:00', '1', '4');
INSERT INTO `workorder` VALUES ('55', 'WO0054', 'Ganti Abs', '', 'F', null, '2018-06-05 02:52:50', '2018-05-09 00:00:00', '1', '6');
INSERT INTO `workorder` VALUES ('56', 'WO0055', 'Ganti Abs', '', 'F', null, '2018-06-05 02:53:45', '2018-05-10 00:00:00', '1', '5');
INSERT INTO `workorder` VALUES ('57', 'WO0056', 'Ganti Abs', '', 'F', null, '2018-06-05 02:54:19', '2018-05-10 00:00:00', '1', '6');
INSERT INTO `workorder` VALUES ('58', 'WO0057', 'Ganti Abs', '', 'F', null, '2018-06-05 02:59:57', '2018-05-11 00:00:00', '1', '14');
INSERT INTO `workorder` VALUES ('59', 'WO0058', 'Ganti Abs', '', 'F', null, '2018-06-05 03:00:43', '2018-05-12 00:00:00', '1', '13');
INSERT INTO `workorder` VALUES ('60', 'WO0059', 'Ganti Abs', '', 'F', null, '2018-06-05 03:02:00', '2018-05-14 00:00:00', '1', '6');
INSERT INTO `workorder` VALUES ('61', 'WO0060', 'Ganti Abs', '', 'F', null, '2018-06-05 03:02:43', '2018-05-15 00:00:00', '1', '12');
INSERT INTO `workorder` VALUES ('62', 'WO0061', 'Ganti Abs', '', 'F', null, '2018-06-05 03:11:30', '2018-05-16 00:00:00', '1', '9');
INSERT INTO `workorder` VALUES ('63', 'WO0062', 'Ganti Abs', '', 'F', null, '2018-06-05 03:12:31', '2018-05-17 00:00:00', '1', '5');
INSERT INTO `workorder` VALUES ('64', 'WO0063', 'Ganti Abs', '', 'F', null, '2018-06-05 03:13:38', '2018-05-18 00:00:00', '1', '10');
INSERT INTO `workorder` VALUES ('65', 'WO0064', 'Ganti Abs', '', 'F', null, '2018-06-05 03:21:29', '2018-05-19 00:00:00', '1', '7');
INSERT INTO `workorder` VALUES ('66', 'WO0065', 'Ganti Oli', '', 'F', null, '2018-06-05 03:22:01', '2018-05-21 00:00:00', '1', '8');
INSERT INTO `workorder` VALUES ('67', 'WO0066', 'Ganti Abs', '', 'F', null, '2018-06-05 03:22:50', '2018-05-22 00:00:00', '1', '9');
INSERT INTO `workorder` VALUES ('68', 'WO0067', 'Ganti Abs', '', 'F', null, '2018-06-05 03:24:03', '2018-05-23 00:00:00', '1', '6');
INSERT INTO `workorder` VALUES ('69', 'WO0068', 'Ganti Oli', '', 'F', null, '2018-06-05 03:24:50', '2018-05-24 00:00:00', '1', '11');
INSERT INTO `workorder` VALUES ('70', 'WO0069', 'Ganti Abs', '', 'F', null, '2018-06-05 03:25:42', '2018-05-25 00:00:00', '1', '14');
INSERT INTO `workorder` VALUES ('71', 'WO0070', 'Ganti Abs', '', 'F', null, '2018-06-05 03:27:09', '2018-05-26 00:00:00', '1', '13');
INSERT INTO `workorder` VALUES ('72', 'WO0071', 'Ganti Abs', '', 'F', null, '2018-06-05 03:27:59', '2018-05-28 00:00:00', '1', '12');
INSERT INTO `workorder` VALUES ('73', 'WO0072', 'Ganti ABs', '', 'F', null, '2018-06-05 03:29:04', '2018-05-29 00:00:00', '1', '11');
INSERT INTO `workorder` VALUES ('74', 'WO0073', 'Ganti Abs', '', 'F', null, '2018-06-05 03:29:56', '2018-05-30 00:00:00', '1', '10');
INSERT INTO `workorder` VALUES ('75', 'WO0074', 'Ganti Abs', '', 'F', null, '2018-06-05 03:30:59', '2018-05-31 00:00:00', '1', '9');
INSERT INTO `workorder` VALUES ('76', 'WO0075', 'Ganti Abs', '', 'F', null, '2018-06-05 03:32:00', '2018-06-01 00:00:00', '1', '8');
INSERT INTO `workorder` VALUES ('77', 'WO0076', 'Ganti Abs', '', 'F', null, '2018-06-05 03:32:11', '2018-06-02 00:00:00', '1', '7');
INSERT INTO `workorder` VALUES ('78', 'WO0077', 'Ganti Abs', '', 'F', null, '2018-06-05 03:32:20', '2018-06-03 00:00:00', '1', '6');
INSERT INTO `workorder` VALUES ('79', 'WO0078', 'Ganti Abs', '', 'F', null, '2018-06-05 03:32:26', '2018-06-04 00:00:00', '1', '5');
INSERT INTO `workorder` VALUES ('80', 'WO0079', 'Ganti Abs', '', 'NF', null, '2018-06-05 03:32:31', null, '1', '4');
INSERT INTO `workorder` VALUES ('81', 'WO0080', 'Ganti Oli', '', 'F', null, '2018-06-05 03:42:48', '2018-06-04 00:00:00', '1', '4');
INSERT INTO `workorder` VALUES ('82', 'WO0081', 'Ganti Oli', '', 'F', null, '2018-06-05 06:17:30', '2018-05-16 00:00:00', '1', '5');
INSERT INTO `workorder` VALUES ('83', 'WO0082', 'Ganti Oli', '', 'F', null, '2018-06-05 07:23:07', '2018-06-05 00:00:00', '1', '4');
INSERT INTO `workorder` VALUES ('84', 'WO0083', 'Ganti Abs', '', 'F', null, '2018-06-05 07:44:55', '2018-06-16 00:00:00', '1', '6');
INSERT INTO `workorder` VALUES ('85', 'WO0084', 'Ganti Oli', '', 'F', null, '2018-06-06 01:20:54', '2018-06-05 00:00:00', '1', '5');
INSERT INTO `workorder` VALUES ('86', 'WO0085', 'Ganti Oli', '', null, null, '2018-06-06 03:20:28', null, '1', '4');
INSERT INTO `workorder` VALUES ('87', 'WO0086', 'Ganti Oli', '', 'F', null, '2018-06-06 07:07:54', '2018-06-06 00:00:00', '1', '4');
INSERT INTO `workorder` VALUES ('88', 'WO0087', 'Ganti Abs', '', 'NF', null, '2018-06-06 07:12:11', null, '1', '4');

-- ----------------------------
-- Table structure for workorder_detail
-- ----------------------------
DROP TABLE IF EXISTS `workorder_detail`;
CREATE TABLE `workorder_detail` (
  `detailwoid` int(11) NOT NULL AUTO_INCREMENT,
  `workorderid` int(11) DEFAULT NULL,
  `sparepartid` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  `pelayananid` int(11) DEFAULT NULL,
  PRIMARY KEY (`detailwoid`),
  KEY `workorderid` (`workorderid`),
  KEY `sparepartid` (`sparepartid`),
  KEY `pelayananid` (`pelayananid`),
  CONSTRAINT `workorder_detail_ibfk_1` FOREIGN KEY (`workorderid`) REFERENCES `workorder` (`workorderid`),
  CONSTRAINT `workorder_detail_ibfk_2` FOREIGN KEY (`sparepartid`) REFERENCES `sparepart` (`sparepartid`),
  CONSTRAINT `workorder_detail_ibfk_3` FOREIGN KEY (`pelayananid`) REFERENCES `mst_pelayanan` (`pelayananid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of workorder_detail
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
