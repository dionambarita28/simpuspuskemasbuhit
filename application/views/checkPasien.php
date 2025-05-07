<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h3 class="header-title text-center text-uppercase mb-5">Check Pasien</h4>
                                <div style="
                                    background:#ddd;
                                    padding:32px;
                                    border-radius:12px;
                                ">
                                    <?php
                                    if (isset($no_ktp_pasien) && empty($pasien)) :
                                    ?>
                                        <div class="alert alert-warning" role="alert">
                                            Pasien tidak ditemukan, silahkan daftar <a href="<?= base_url('pasien/addPasien'); ?>">disini</a>
                                        </div>
                                    <?php
                                    endif;
                                    ?>

                                    <form method="post" action="<?= base_url('pasien/checkPasien'); ?>" class="row">
                                        <div class="input-group mb-3">
                                            <input id="cari_pasien" type="text" name="no_ktp_pasien" class="form-control" placeholder="No KTP Pasien" value="<?= isset($no_ktp_pasien) ? $no_ktp_pasien : ""; ?>" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit"> <i class="fa fa-search"></i> Check</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                if (isset($pasien)) :
                                ?>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <h3 class="h3 mb-4">Informasi Pasien</h3>
                                            <table class="table">
                                                <tr>
                                                    <td width="30%">Nama</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->nama; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">NIK</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->no_nik; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">Alamat</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->alamat; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">Kelamin</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->kelamin; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">Tanggal Lahir</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->tgl_lahir; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">No HP</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->no_hp; ?></td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">Jenis Pasien</td>
                                                    <td width="5%">:</td>
                                                    <td><?= $pasien->jenis_pasien; ?></td>
                                                </tr>
                                            </table>
                                            <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                            <form action="<?= base_url('pasien/printPasien'); ?>" method="post">
                                                <div class="form-group">
                                                    <input type="hidden" name="no_ktp_pasien" value="<?= $pasien->no_ktp_pasien; ?>">
                                                    <label for="keluhan">Keluhan</label>
                                                    <textarea class="form-control" id="keluhan" placeholder="Masukan Keluhan" rows="5" name="keluhan"></textarea>
                                                    <small id="keluhan" class="form-text text-muted">Masukan keluhan sebelum print data pengguna.</small>
                                                </div>
                                                <button class="btn btn-block btn-success" type="submit"> <i class="fa fa-print"></i> PRINT PDF</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="h3 mb-4">Riwayat Keluhan</h3>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th width="30%">Tanggal</th>
                                                    <th>Keluhan</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($keluhan as $keluhan) : ?>
                                                    <tr>
                                                        <td><?= $keluhan['created_at']; ?></td>
                                                        <td><?= $keluhan['keluhan']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php
                                endif;
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>