-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2020 pada 20.10
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

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
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama_dokter` varchar(200) NOT NULL,
  `klinik` int(11) NOT NULL,
  `username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `nama_dokter`, `klinik`, `username`) VALUES
(1, 'Rere', 1, 'dokter'),
(3, 'Saipul', 3, 'saipul'),
(4, 'Dede', 4, 'dede'),
(5, 'Juliansyah', 5, 'juliansyah'),
(6, 'Rana', 6, 'rana'),
(7, 'Deni', 7, 'deni'),
(8, 'Abdur', 8, 'abdur'),
(9, 'Abel', 5, 'abel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id` int(11) NOT NULL,
  `kategori_obat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_obat`
--

INSERT INTO `kategori_obat` (`id`, `kategori_obat`) VALUES
(1, 'Obat Kumur'),
(2, 'Obat Gosok'),
(4, 'Vitamin'),
(5, 'Obat Luka'),
(6, 'Anti Biotik'),
(7, 'Saluran Napas'),
(68, 'Saluran Cerna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id` int(11) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `tahun` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kunjungan`
--

INSERT INTO `kunjungan` (`id`, `bulan`, `jumlah`, `tahun`) VALUES
(1, 'January', 200, '2020'),
(2, 'February', 300, '2020'),
(3, 'March', 126, '2020'),
(4, 'April', 100, '2020'),
(5, 'May', 2, '2020'),
(6, 'June', 0, '2020'),
(7, 'July', 0, '2020'),
(8, 'August', 0, '2020'),
(9, 'September', 0, '2020'),
(10, 'October', 0, '2020'),
(11, 'November', 0, '2020'),
(12, 'December', 0, '2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id` int(11) NOT NULL,
  `no_labor` varchar(100) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `no_pasien` varchar(100) NOT NULL,
  `keterangan_labor` text NOT NULL,
  `tgl_labor` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laboratorium`
--

INSERT INTO `laboratorium` (`id`, `no_labor`, `id_rm`, `no_rm`, `no_pasien`, `keterangan_labor`, `tgl_labor`, `status`) VALUES
(2, '', 4, '9874', '0040', '', '04-05-2020', 0),
(1, '1', 4, '9874', '0040', 'Banyak Daki, Kek kedel', '28-04-2020', 1),
(4, '20200504', 4, '9874', '0040', '', '04-05-2020', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(100) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `satuan` int(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `harga` int(100) DEFAULT NULL,
  `stok` int(100) NOT NULL,
  `expired` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kategori`, `satuan`, `supplier`, `harga`, `stok`, `expired`, `keterangan`) VALUES
(1, 'Paramek', '4', 2, 'Pemerintah', 0, 6, '0000-00-00', 'Anti Covid 19 makan jambu biji'),
(2, 'Zinc Pro', '4', 1, 'Pemerintah', 0, 95, '0000-00-00', ''),
(3, 'Betadin', '2', 1, NULL, NULL, 20, NULL, ''),
(7, 'botrex', '1', 3, 'Desa', 0, 90, '0000-00-00', ''),
(8, 'Vitamin A', '4', 3, 'Pemerintah', 0, 13, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `no_pasien` varchar(20) NOT NULL,
  `no_ktp` int(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `tgl_lahir` varchar(15) NOT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `tinggi` int(5) DEFAULT NULL,
  `berat` int(5) DEFAULT NULL,
  `jenis_pasien` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `no_pasien`, `no_ktp`, `nama`, `pekerjaan`, `alamat`, `kelamin`, `tgl_lahir`, `agama`, `tinggi`, `berat`, `jenis_pasien`) VALUES
(1, '0001', 12623743, 'Juliansyah KW', 'Petani 2', 'Jalan Gang lengkeng Kabupaten Bangka2', 'Laki-Laki', '16-07-1999', 'Islam', 170, 50, 'Reguler'),
(2, '0002', 123123, 'Jaja lala', 'Op Warnet', 'jalan beringin 2', 'Laki-Laki', '17-04-2020', 'Islam', 0, 0, 'BPJS'),
(3, '0003', 123213, 'Dede R riu', 'Mahasiswa', 'Jalan Gabek', 'Laki-Laki', '23-04-1981', 'Islam', 123, 123, 'BPJS'),
(4, '0004', 1234123, 'abel', 'Mahasiswa', 'efwaf', 'Laki-Laki', '12-04-1999', 'Islam', 123, 123, 'BPJS'),
(6, '0040', 123, 'Saipul', 'Petani Lada', 'weafawef', 'Laki-Laki', '17-04-1991', 'Islam', 123, 123, 'BPJS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_obat`
--

CREATE TABLE `pemakaian_obat` (
  `id` int(11) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `tahun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemakaian_obat`
--

INSERT INTO `pemakaian_obat` (`id`, `bulan`, `jumlah`, `tahun`) VALUES
(1, 'January', 40, '2020'),
(2, 'February', 120, '2020'),
(3, 'March', 30, '2020'),
(4, 'April', 58, '2020'),
(5, 'May', 15, '2020'),
(6, 'June', 0, '2020'),
(7, 'July', 0, '2020'),
(8, 'August', 0, '2020'),
(9, 'September', 0, '2020'),
(10, 'October', 0, '2020'),
(11, 'November', 0, '2020'),
(12, 'December', 0, '2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `no_pemeriksaan` int(11) NOT NULL,
  `no_rm` varchar(11) NOT NULL,
  `diagnosa_penyakit` text NOT NULL,
  `tgl_pemeriksaan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`no_pemeriksaan`, `no_rm`, `diagnosa_penyakit`, `tgl_pemeriksaan`) VALUES
(1, '0004', 'Covid 19', '20-04-2020'),
(4, '9874', 'Demam Berdarah', '21-04-2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `no_pendaftaran` varchar(11) NOT NULL,
  `no_pasien` varchar(11) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `tgl_berobat` varchar(100) NOT NULL,
  `jenis_pasien` varchar(100) NOT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `no_pendaftaran`, `no_pasien`, `nama_pasien`, `tgl_berobat`, `jenis_pasien`, `biaya`) VALUES
(1, '1', '0001', 'Juliansyah', '19-04-2020', 'Reguler', 0),
(2, '2', '0003', 'Dede R riu', '19-04-2020', 'BPJS', 10000),
(3, '2130', '0040', 'Saipul', '21-04-2020', 'BPJS', 10000),
(5, '1', '0001', 'Juliansyah', '30-04-2020', 'Reguler', 10000),
(6, '1', '0002', 'Jaja lala', '30-04-2020', 'BPJS', 10000),
(9, '5', '0001', 'Juliansyah KW', '03-05-2020', 'Reguler', 0),
(11, '7', '0001', 'Juliansyah KW', '03-05-2020', 'Reguler', 0),
(12, '9', '0002', 'Jaja lala', '03-05-2020', 'BPJS', 0),
(13, '1', '0040', 'Saipul', '04-05-2020', 'BPJS', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(10) NOT NULL,
  `nama_klinik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_klinik`) VALUES
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
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(100) NOT NULL,
  `no_pendaftaran` varchar(100) NOT NULL,
  `no_pasien` varchar(100) NOT NULL,
  `tgl_rekam` varchar(200) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `klinik_tujuan` int(11) NOT NULL,
  `dokter_tujuan` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `no_rm`, `no_pendaftaran`, `no_pasien`, `tgl_rekam`, `nama_pasien`, `klinik_tujuan`, `dokter_tujuan`, `status`) VALUES
(5, '0005', '2', '0003', '01-05-2020', 'Dede R riu', 1, 1, 0),
(4, '9874', '2130', '0040', '21-04-2020', 'Saipul', 5, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `id_rm` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resep_obat`
--

INSERT INTO `resep_obat` (`id`, `no_rm`, `id_rm`, `id_obat`, `nama_obat`, `jumlah`, `status`, `dokter_id`) VALUES
(1, '0004', 3, 2, 'Zinc Pro', 5, 1, 1),
(2, '0004', 3, 1, 'Paramek', 3, 1, 1),
(4, '9874', 4, 1, 'Paramek', 3, 0, 5),
(5, '9874', 4, 1, 'Paramek', 6, 0, 5),
(6, '9874', 4, 1, 'Paramek', 2, 0, 5),
(7, '9874', 4, 8, 'Vitamin A', 7, 0, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengadaan`
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
-- Dumping data untuk tabel `riwayat_pengadaan`
--

INSERT INTO `riwayat_pengadaan` (`id`, `supplier`, `nama_obat`, `stok`, `harga`, `expired`) VALUES
(1, 'Pemerintah Daerah', 'Pemerintah Daerah', 50, 0, '0000-00-00'),
(2, 'Desa Setempat', 'Desa Setempat', 10, 0, '0000-00-00'),
(3, 'Pemerintah', 'Pemerintah', 20, 0, '0000-00-00'),
(4, 'Pemrintah', 'Pemrintah', 40, 0, '0000-00-00'),
(5, 'Desa', 'Desa', 50, 0, '0000-00-00'),
(6, 'Pemerintah', 'Pemerintah', 100, 0, '0000-00-00'),
(7, 'Pemerintah', 'Pemerintah', 20, 0, '0000-00-00'),
(8, 'Pemerintah', 'Pemerintah', 20, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rujuk_external`
--

CREATE TABLE `rujuk_external` (
  `id_rujuk` int(11) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `no_pasien` varchar(20) NOT NULL,
  `klinik_perujuk` int(11) NOT NULL,
  `dokter_perujuk` int(11) NOT NULL,
  `rs_tujuan` varchar(255) NOT NULL,
  `dokter_tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rujuk_external`
--

INSERT INTO `rujuk_external` (`id_rujuk`, `no_rm`, `no_pasien`, `klinik_perujuk`, `dokter_perujuk`, `rs_tujuan`, `dokter_tujuan`) VALUES
(1, '9874', '0040', 5, 5, 'Rumah Sakit Timah', 'Dr. abdurahman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rujuk_internal`
--

CREATE TABLE `rujuk_internal` (
  `id_rujuk` int(11) NOT NULL,
  `no_rm` varchar(200) NOT NULL,
  `no_pasien` varchar(200) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `klinik_perujuk` int(11) NOT NULL,
  `dokter_perujuk` int(11) NOT NULL,
  `klinik_rujuk` int(11) NOT NULL,
  `dokter_rujuk` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `diagnosa_rujuk` text NOT NULL,
  `saran_tindakan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rujuk_internal`
--

INSERT INTO `rujuk_internal` (`id_rujuk`, `no_rm`, `no_pasien`, `nama_pasien`, `klinik_perujuk`, `dokter_perujuk`, `klinik_rujuk`, `dokter_rujuk`, `status`, `diagnosa_rujuk`, `saran_tindakan`) VALUES
(1, '0004', '0001', 'Juliansyah', 2, 2, 5, 5, 1, 'Gigi Berlobang2', 'Makan Batu 2 3'),
(2, '9874', '0040', 'Saipul', 5, 5, 1, 1, 0, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_obat`
--

CREATE TABLE `satuan_obat` (
  `id` int(100) NOT NULL,
  `nama_satuan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan_obat`
--

INSERT INTO `satuan_obat` (`id`, `nama_satuan`) VALUES
(1, 'Botol'),
(2, 'Tablet'),
(3, 'Pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `telpon`, `level`) VALUES
(1, 'Dr. Daftar', 'daftar', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '83175087', 2),
(5, 'Juliansyah', 'juliansyah', '$2y$10$ElnNf4tmnGzQoTaAeBuPgu92IJ5b0yR3Ow3daV5vZVJgPEKUAOPa.', '083175087363', 4),
(6, 'Apoteker', 'apoteker', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '2147483647', 3),
(7, 'Rere', 'rere', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '2147483647', 4),
(8, 'Laboratorium', 'labor', '$2y$10$upIqOJmd9laewP9LHS2py.0O0RIhI6e51tC7DXcdQM8i6XqWDkCGS', '2147483647', 5),
(9, 'SuperAdmin', 'admin', '$2y$10$PBF5c7iFuqc5BLE4qorwGeCsOoygQVVw81ki7StwqKfpVlbro4ke6', '083175087363', 1),
(12, 'Abel', 'abel', '$2y$10$Kl3acYBz9Jann6coxBNitObBwXoHCJJuxlf.dzP1yQfU6NBynRMM.', '083166662', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`no_labor`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_pasien`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `pemakaian_obat`
--
ALTER TABLE `pemakaian_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`no_pemeriksaan`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`no_rm`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rujuk_external`
--
ALTER TABLE `rujuk_external`
  ADD PRIMARY KEY (`id_rujuk`);

--
-- Indeks untuk tabel `rujuk_internal`
--
ALTER TABLE `rujuk_internal`
  ADD PRIMARY KEY (`id_rujuk`);

--
-- Indeks untuk tabel `satuan_obat`
--
ALTER TABLE `satuan_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_obat`
--
ALTER TABLE `pemakaian_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `no_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengadaan`
--
ALTER TABLE `riwayat_pengadaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rujuk_external`
--
ALTER TABLE `rujuk_external`
  MODIFY `id_rujuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rujuk_internal`
--
ALTER TABLE `rujuk_internal`
  MODIFY `id_rujuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `satuan_obat`
--
ALTER TABLE `satuan_obat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
