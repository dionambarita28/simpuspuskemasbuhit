-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2022 at 04:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `dokter_id` int(11) NOT NULL,
  `nama_dokter` varchar(200) NOT NULL,
  `poli_id` int(10) NOT NULL,
  `username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`dokter_id`, `nama_dokter`, `poli_id`, `username`) VALUES
(1, 'Rere', 1, 'rere'),
(5, 'Juliansyah', 5, 'juliansyah'),
(9, 'Abel Kurniawan', 6, 'abel'),
(12, 'Deni Irwansyah', 1, 'deni_irwansyah');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id_kategori_obat` int(11) NOT NULL,
  `kategori_obat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id_kategori_obat`, `kategori_obat`) VALUES
(1, 'Obat Kumur'),
(2, 'Obat Gosok'),
(4, 'Vitamin'),
(5, 'Obat Luka'),
(6, 'Anti Biotik'),
(7, 'Saluran Napas');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id` int(11) NOT NULL,
  `no_ktp_pasien` varchar(100) CHARACTER SET latin1 NOT NULL,
  `keluhan` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id`, `no_ktp_pasien`, `keluhan`, `created_at`) VALUES
(1, '320339571002', 'boke', '2022-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id` int(11) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `tahun` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id`, `bulan`, `jumlah`, `tahun`) VALUES
(1, 'January', 0, '2022'),
(2, 'February', 0, '2022'),
(3, 'March', 0, '2022'),
(4, 'April', 0, '2022'),
(5, 'May', 0, '2022'),
(6, 'June', 0, '2022'),
(7, 'July', 0, '2022'),
(8, 'August', 0, '2022'),
(9, 'September', 0, '2022'),
(10, 'October', 0, '2022'),
(11, 'November', 0, '2020'),
(12, 'December', 0, '2020');

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id` int(11) NOT NULL,
  `no_labor` varchar(100) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `no_ktp_pasien` varchar(100) NOT NULL,
  `keterangan_labor` text NOT NULL,
  `tgl_labor` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`id`, `no_labor`, `id_rm`, `no_rm`, `no_ktp_pasien`, `keterangan_labor`, `tgl_labor`, `status`) VALUES
(1, '32532042', 9, '12321333', '0002', 'sydah', '09-07-2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(100) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `id_kategori_obat` int(11) NOT NULL,
  `id_satuan` int(11) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `harga` int(100) DEFAULT NULL,
  `stok` int(100) NOT NULL,
  `expired` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `id_kategori_obat`, `id_satuan`, `supplier`, `harga`, `stok`, `expired`, `keterangan`) VALUES
(2, 'Zinc Pro', 4, 1, 'Pemerintah', 0, 95, '0000-00-00', ''),
(3, 'Betadin', 5, 1, 'supplier', 1000, 51, '0000-00-00', 'Obat Luka Luar'),
(7, 'botrex', 1, 3, 'Desa', 0, 90, '0000-00-00', ''),
(8, 'Vitamin A', 4, 3, 'Pemerintah', 0, 13, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `no_ktp_pasien` varchar(100) NOT NULL,
  `no_nik` int(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `tgl_lahir` varchar(15) NOT NULL,
  `no_hp` int(20) DEFAULT NULL,
  `jenis_pasien` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `no_ktp_pasien`, `no_nik`, `nama`, `alamat`, `kelamin`, `tgl_lahir`, `no_hp`, `jenis_pasien`) VALUES
(2, '0002', 123123, 'Julian', 'jalan beringin 2', 'Perempuan', '17-04-2020', 124123213, 'Umum'),
(3, '0003', 123213, 'Dede R riu', 'Jalan Gabek', 'Laki-Laki', '23-04-1981', 0, 'BPJS'),
(4, '0004', 1234123, 'abel', 'efwaf', 'Laki-Laki', '12-04-1999', 0, 'BPJS'),
(6, '0040', 123, 'Saipul', 'weafawef', 'Laki-Laki', '17-04-1991', 0, 'BPJS'),
(10, '1444444', 2147483647, 'Jamet', 'Merdeka street', 'Laki-Laki', '01-07-2021', 123213, 'BPJS'),
(12, '320339571002', 2147483647, 'Pasien 1', 'Jakrta', 'Laki-Laki', '01-04-2022', 2147483647, 'BPJS'),
(11, '334455544', 2147483647, 'Julian', 'Jl Selindang', 'Laki-Laki', '14-07-2021', 2147483647, 'BPJS');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian_obat`
--

CREATE TABLE `pemakaian_obat` (
  `id` int(11) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `tahun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakaian_obat`
--

INSERT INTO `pemakaian_obat` (`id`, `bulan`, `jumlah`, `tahun`) VALUES
(1, 'January', 0, '2021'),
(2, 'February', 0, '2021'),
(3, 'March', 0, '2021'),
(4, 'April', 0, '2021'),
(5, 'May', 0, '2021'),
(6, 'June', 0, '2021'),
(7, 'July', 21, '2021'),
(8, 'August', 0, '2021'),
(9, 'September', 0, '2021'),
(10, 'October', 0, '2021'),
(11, 'November', 0, '2021'),
(12, 'December', 0, '2021');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `no_pemeriksaan` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `diagnosa_penyakit` text NOT NULL,
  `tgl_pemeriksaan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`no_pemeriksaan`, `no_rm`, `diagnosa_penyakit`, `tgl_pemeriksaan`) VALUES
(1, '12321333', 'Luka di bagian lengan, infeksi', '09-07-2121');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `no_pendaftaran` varchar(11) NOT NULL,
  `no_ktp_pasien` varchar(100) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `tgl_berobat` varchar(100) NOT NULL,
  `jenis_pasien` varchar(100) NOT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `no_pendaftaran`, `no_ktp_pasien`, `nama_pasien`, `tgl_berobat`, `jenis_pasien`, `biaya`) VALUES
(2, '2', '0003', 'Dede R riu', '19-04-2020', 'BPJS', 10000),
(3, '2130', '0040', 'Saipul', '21-04-2020', 'BPJS', 10000),
(6, '1', '0002', 'Jaja lala', '30-04-2020', 'BPJS', 10000),
(12, '9', '0002', 'Jaja lala', '03-05-2020', 'BPJS', 0),
(13, '1', '0040', 'Saipul', '04-05-2020', 'BPJS', 0),
(16, '1', '0002', 'Julian', '09-07-2021', 'Umum', 100000),
(17, '0010', '320339571002', 'Pasien 1', '05-04-2022', 'BPJS', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `poli_id` int(10) NOT NULL,
  `nama_klinik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`poli_id`, `nama_klinik`) VALUES
(1, 'Klinik Umum'),
(2, 'Klinik Gigi'),
(3, 'Klinik KIA,KB'),
(4, 'Klinik MTBS'),
(5, 'Klinik PKPR'),
(6, 'Klinik Lansia'),
(7, 'Klinik Jiwa'),
(8, 'Ruang Imunisasi'),
(9, 'Ruang TBC');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `no_pendaftaran` varchar(100) NOT NULL,
  `no_ktp_pasien` varchar(100) NOT NULL,
  `tgl_rekam` varchar(200) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `poli_id` int(10) NOT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `no_rm`, `no_pendaftaran`, `no_ktp_pasien`, `tgl_rekam`, `nama_pasien`, `poli_id`, `dokter_id`, `status`) VALUES
(9, '12321333', '1', '0002', '09-07-2021', 'Julian', 2, 1, 1),
(10, '20', '1', '0002', '05-04-2022', 'Julian', 1, 12, 0),
(11, '202', '1', '0002', '05-04-2022', 'Julian', 1, 1, 0),
(8, '213213213', '2130', '0040', '08-07-2021', 'Saipul', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `id_obat` int(100) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id`, `no_rm`, `id_rm`, `id_obat`, `nama_obat`, `jumlah`, `status`, `dokter_id`) VALUES
(1, '12321333', 9, 3, 'Betadin', 1, 1, 1),
(2, '12321333', 9, 3, 'Betadin', 20, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pengadaan`
--

CREATE TABLE `riwayat_pengadaan` (
  `id` int(100) NOT NULL,
  `supplier` varchar(200) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `stok` int(255) NOT NULL,
  `harga` int(255) DEFAULT NULL,
  `expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_pengadaan`
--

INSERT INTO `riwayat_pengadaan` (`id`, `supplier`, `nama_obat`, `stok`, `harga`, `expired`) VALUES
(1, 'Pemerintah Daerah', 'Pemerintah Daerah', 50, 0, '0000-00-00'),
(2, 'Desa Setempat', 'Desa Setempat', 10, 0, '0000-00-00'),
(3, 'Pemerintah', 'Pemerintah', 20, 0, '0000-00-00'),
(4, 'Pemrintah', 'Pemrintah', 40, 0, '0000-00-00'),
(5, 'Desa', 'Desa', 50, 0, '0000-00-00'),
(6, 'Pemerintah', 'Pemerintah', 100, 0, '0000-00-00'),
(7, 'Pemerintah', 'Pemerintah', 20, 0, '0000-00-00'),
(8, 'Pemerintah', 'Pemerintah', 20, 0, '0000-00-00'),
(9, 'RM Bakti', 'RM Bakti', 50, 0, '0000-00-00'),
(10, 'RM Bakti', 'RM Bakti', 50, 0, '0000-00-00'),
(11, 'supplier', 'supplier', 2, 1000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `rujuk_external`
--

CREATE TABLE `rujuk_external` (
  `id_rujuk` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `no_ktp_pasien` varchar(100) NOT NULL,
  `poli_id` int(10) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `rs_tujuan` varchar(255) NOT NULL,
  `dokter_tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rujuk_internal`
--

CREATE TABLE `rujuk_internal` (
  `id_rujuk` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `no_ktp_pasien` varchar(100) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `poli_id` int(10) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `klinik_rujuk` int(11) NOT NULL,
  `dokter_rujuk` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `diagnosa_rujuk` text NOT NULL,
  `saran_tindakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rujuk_internal`
--

INSERT INTO `rujuk_internal` (`id_rujuk`, `no_rm`, `no_ktp_pasien`, `nama_pasien`, `poli_id`, `dokter_id`, `klinik_rujuk`, `dokter_rujuk`, `status`, `diagnosa_rujuk`, `saran_tindakan`) VALUES
(2, '12321333', '0002', 'Julian', 1, 1, 5, 5, 1, 'Ada urat putuss', 'Operasi lurrrr');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_obat`
--

CREATE TABLE `satuan_obat` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_obat`
--

INSERT INTO `satuan_obat` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Botol'),
(2, 'Tablet'),
(3, 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telpon` varchar(255) DEFAULT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `telpon`, `level`) VALUES
(12, 'Abel', 'abel', '$2y$10$Kl3acYBz9Jann6coxBNitObBwXoHCJJuxlf.dzP1yQfU6NBynRMM.', '083166662', 4),
(9, 'SuperAdmin', 'admin', '$2y$10$PBF5c7iFuqc5BLE4qorwGeCsOoygQVVw81ki7StwqKfpVlbro4ke6', '083175087363', 1),
(17, 'Apotek', 'apotek', '$2y$10$aBk4FWB4U1/KnabjEkUjBuZMptXsV92CajjfHCItqKokVgOC.1jtK', '8293829', 3),
(6, 'Apoteker', 'apoteker', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '2147483647', 3),
(1, 'Dr. Daftar', 'daftar', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '83175087', 2),
(14, 'Deni Irwansyah', 'deni_irwansyah', '$2y$10$.aDZGkkJpM23q3rzvaAZ.ei2ktx4gdPH1wpjDjTwelgLFUewHvRmW', '123214124', 4),
(15, 'dokter', 'dokter', '$2y$10$HUIYw4psj5RCtlzBM/waJOTXNQe.77s6lMi3YDjP8Pv/jlQsPYl2i', '8429829382', 4),
(5, 'Juliansyah', 'juliansyah', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '083175087363', 4),
(8, 'Laboratorium', 'labor', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '2147483647', 5),
(18, 'Laboratorium', 'laboratorium', '$2y$10$Stsyne.VIeWabH1yn/tWaORcoMqoFntVHs4QukFKW9ENu9iy2Ur66', '8429829382', 5),
(16, 'petugas', 'petugas', '$2y$10$qH0DuIQKw7ubc8djWfbR4O6WHZbWPXcZXyzH7MGpu5a5Zif.rdJku', '402920392', 2),
(7, 'Rere', 'rere', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '2147483647', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`dokter_id`),
  ADD KEY `username` (`username`),
  ADD KEY `poli_id` (`poli_id`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id_kategori_obat`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_ktp_pasien` (`no_ktp_pasien`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`no_labor`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `no_ktp_pasien` (`no_ktp_pasien`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_kategori_obat` (`id_kategori_obat`,`id_satuan`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_ktp_pasien`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pemakaian_obat`
--
ALTER TABLE `pemakaian_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`no_pemeriksaan`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `no_ktp_pasien` (`no_ktp_pasien`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`poli_id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`no_rm`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `no_ktp_pasien` (`no_ktp_pasien`),
  ADD KEY `poli_id` (`poli_id`,`dokter_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `id_obat` (`id_obat`,`dokter_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rujuk_external`
--
ALTER TABLE `rujuk_external`
  ADD PRIMARY KEY (`id_rujuk`),
  ADD KEY `no_ktp_pasien` (`no_ktp_pasien`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `poli_id` (`poli_id`,`dokter_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `rujuk_internal`
--
ALTER TABLE `rujuk_internal`
  ADD PRIMARY KEY (`id_rujuk`),
  ADD KEY `no_ktp_pasien` (`no_ktp_pasien`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `poli_id` (`poli_id`,`dokter_id`),
  ADD KEY `dokter_id` (`dokter_id`);

--
-- Indexes for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `dokter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id_kategori_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemakaian_obat`
--
ALTER TABLE `pemakaian_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `no_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `poli_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rujuk_external`
--
ALTER TABLE `rujuk_external`
  MODIFY `id_rujuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rujuk_internal`
--
ALTER TABLE `rujuk_internal`
  MODIFY `id_rujuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dokter_ibfk_2` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`poli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD CONSTRAINT `keluhan_ibfk_1` FOREIGN KEY (`no_ktp_pasien`) REFERENCES `pasien` (`no_ktp_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD CONSTRAINT `laboratorium_ibfk_1` FOREIGN KEY (`no_ktp_pasien`) REFERENCES `pasien` (`no_ktp_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laboratorium_ibfk_2` FOREIGN KEY (`no_rm`) REFERENCES `rekam_medis` (`no_rm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan_obat` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `obat_ibfk_2` FOREIGN KEY (`id_kategori_obat`) REFERENCES `kategori_obat` (`id_kategori_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`no_rm`) REFERENCES `rekam_medis` (`no_rm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`no_ktp_pasien`) REFERENCES `pasien` (`no_ktp_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`no_ktp_pasien`) REFERENCES `pasien` (`no_ktp_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_3` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`poli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `resep_obat_ibfk_1` FOREIGN KEY (`no_rm`) REFERENCES `rekam_medis` (`no_rm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_obat_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resep_obat_ibfk_3` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rujuk_external`
--
ALTER TABLE `rujuk_external`
  ADD CONSTRAINT `rujuk_external_ibfk_1` FOREIGN KEY (`no_ktp_pasien`) REFERENCES `pasien` (`no_ktp_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rujuk_external_ibfk_2` FOREIGN KEY (`no_rm`) REFERENCES `rekam_medis` (`no_rm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rujuk_external_ibfk_3` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rujuk_external_ibfk_4` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`poli_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rujuk_internal`
--
ALTER TABLE `rujuk_internal`
  ADD CONSTRAINT `rujuk_internal_ibfk_1` FOREIGN KEY (`no_ktp_pasien`) REFERENCES `pasien` (`no_ktp_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rujuk_internal_ibfk_2` FOREIGN KEY (`no_rm`) REFERENCES `rekam_medis` (`no_rm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rujuk_internal_ibfk_3` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`dokter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rujuk_internal_ibfk_4` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`poli_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
