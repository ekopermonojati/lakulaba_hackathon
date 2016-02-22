-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2016 at 05:27 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lakulaba`
--

-- --------------------------------------------------------

--
-- Table structure for table `ll_produk`
--

CREATE TABLE IF NOT EXISTS `ll_produk` (
  `id` int(255) unsigned NOT NULL,
  `nama_produk` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `gambar_produk` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `harga_jual` int(10) unsigned NOT NULL,
  `biaya_pengiriman` int(10) unsigned NOT NULL,
  `stok` smallint(5) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `status_jual` tinyint(1) NOT NULL DEFAULT '0',
  `url_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ll_produk`
--

INSERT INTO `ll_produk` (`id`, `nama_produk`, `gambar_produk`, `deskripsi`, `harga_jual`, `biaya_pengiriman`, `stok`, `status`, `status_jual`, `url_code`, `user_id`, `created_date`) VALUES
(11, 'sdf', 'icon512x5121.png', '1', 1, 1, 1, 0, 0, 'B9TLr', '101535554955841181', '0000-00-00 00:00:00'),
(12, 'Ketupat', 'iconkartulebaran512x512.png', '-', 1, 1, 10, 1, 0, 'D6jbw', '10153555495584118', '0000-00-00 00:00:00'),
(13, 'produk 1', 'icon_lakulaba.png', 'Icon Lakulaba', 1000, 100, 10, 0, 0, '7fuBF', '10153555495584118', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ll_transaksi`
--

CREATE TABLE IF NOT EXISTS `ll_transaksi` (
  `id_trx` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `id_produk` int(11) NOT NULL,
  `payment_method` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `status_return` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `buyer_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_postal_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_request` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `order_number` tinyint(4) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ll_transaksi`
--

INSERT INTO `ll_transaksi` (`id_trx`, `id_produk`, `payment_method`, `status`, `status_return`, `buyer_id`, `buyer_name`, `buyer_address`, `buyer_postal_code`, `buyer_phone`, `buyer_email`, `buyer_request`, `order_number`, `total_bayar`, `last_update`) VALUES
('0df6eb111d08a517f9fee79a9a5e5d5b', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('1c031c4629182c82ea0ba8c24d92be76', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('1c465b0f8a99bb95ce2fa6d6b229b970', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('2c4e348b59e841edfd1afc995c66fcaa', 12, '', 0, '', '', 'eko', 'Malang', '65141', '081321890949', '', '', 0, 0, '2016-02-22 03:47:48'),
('32c6e170e2b11eecd7e4273609febf6b', 13, 'eCash Mandiri', 1, 'HVUS4EO6FHZU6U6BJITR27QIMXQNFNZS,917935,081321890949,32c6e170e2b11eecd7e4273609febf6b,SUCCESS\n', '081321890949', 'R Eko Permono Jati', 'Kebon Sirih 12 Jakarta Pusat', '10110', '081321890949', 'ekopermonojati@gmail.com', '-', 0, 0, '2016-02-21 15:23:19'),
('64b12d5493c9383bbce3a77ca8d248dd', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('6ef2531bf758b10989429330e1471a38', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('80198eb0a8aab64bb2df253659928b75', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('85c7c80c7b6efd09fab9662b780221a6', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('8793d81b6d35c8faf16c3d9245cb2bce', 12, 'eCash Mandiri', 1, 'CBEEKFE4GKUT5IPXSIBNJTHFSMHQ1VR9,917933,081321890949,8793d81b6d35c8faf16c3d9245cb2bce,SUCCESS\n', '081321890949', 'R Eko Permono Jati', 'Kebon Sirih 12 Jakarta Pusat', '10110', '081321890949', '', '', 0, 0, '2016-02-13 17:12:48'),
('88b9bda7fa122278e8247ce759ac932d', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('8c7cb6d52bb812c971f8a0b34b6fa0b6', 12, '', 0, '', '', 'R Eko Permono Jati', 'Kebon Sirih 12 Jakarta Pusat', '10110', '081321890949', '', '', 0, 0, '2016-02-15 05:49:46'),
('92dc9310c935ed8ae5a5eaf5909cc4c0', 12, '', 0, '', '', '', 'Kebon Sirih 12 Jakarta Pusat', '10110', '081321890949', '', '', 0, 0, '2016-02-13 17:09:22'),
('93e53ea56c76bb7762c9e1e0a2f5d859', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('9de91912358dace216737c6cc00dd9f6', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('b918c6a9025caaf7c1f503552908ee11', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('bd0adceee5ecc21708645a15deedd3b3', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('be3a6cd9285a802acebc0ccc969a79c1', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('c916a762a9edf3bb164b0f498ca9ed33', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('dd0e38c4e0aa4782dfa0f0ca9d302109', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('dd48d9e64c234e503ab0d2071d66930d', 12, '', 0, '', '', 'eko', 'Griyashanta M 343 Malang', '65141', '081321890949', '', '', 0, 0, '2016-02-22 03:48:59'),
('e8713c94f42ba826a1c5b5e1176d4324', 12, 'eCash Mandiri', 1, '5ZF912RZEE3KYJZKAI0UNZBGR0Q071NK,918025,081321890949,e8713c94f42ba826a1c5b5e1176d4324,SUCCESS\n', '081321890949', 'Bagus Aryo', 'Griyashanta M 343 Malang', '65141', '081321890949', '', '', 0, 0, '2016-02-20 05:11:00'),
('f87f0593520fc4696857b61f2ed6cb78', 12, '', 0, '', '', '', '', '', '', '', '', 0, 0, '0000-00-00 00:00:00'),
('f8fa5299227a6283efd0efb1f3c3151b', 11, 'eCash Mandiri', 1, '3MJIVFA77S9SUZA39Y6VYSY40NPA7RLU,917930,081321890949,f8fa5299227a6283efd0efb1f3c3151b,SUCCESS\n', '081321890949', '', '', '', '', '', '', 0, 0, '2016-02-13 16:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `ll_users`
--

CREATE TABLE IF NOT EXISTS `ll_users` (
  `id_sosmed` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_toko` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pemilik` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `no_telepon` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `no_ecash_mandiri` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ll_users`
--

INSERT INTO `ll_users` (`id_sosmed`, `email`, `nama_toko`, `nama_pemilik`, `alamat`, `no_telepon`, `no_ecash_mandiri`) VALUES
('10153555495584118', 'rekopermonojati@yahoo.com', 'Toko Faradila', 'R. Eko Permono Jati', 'Tanjung Barat', '081321890949', '081321890949'),
('3104215380', 'ekopermonojati@gmail.com', 'Toko Faradila', 'Eko Permono Jati', 'Tanjung Barat', '081321890949', '081321890949'),
('tes1', '', 'tes2', 'tes3', 'tes4', 'tes5', 'tes6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ll_produk`
--
ALTER TABLE `ll_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ll_transaksi`
--
ALTER TABLE `ll_transaksi`
  ADD PRIMARY KEY (`id_trx`);

--
-- Indexes for table `ll_users`
--
ALTER TABLE `ll_users`
  ADD PRIMARY KEY (`id_sosmed`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ll_produk`
--
ALTER TABLE `ll_produk`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
