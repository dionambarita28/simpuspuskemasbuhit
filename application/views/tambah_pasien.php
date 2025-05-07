<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h3 class="header-title text-center text-uppercase mb-5">Tambah Pasien Baru</h4>
                                <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                                <form method="post" action="<?= base_url('pasien/addProses'); ?>" class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_ktp" class="col-form-label">No Ktp</label>
                                            <input class="form-control inp" type="text" value="" id="no_ktp_pasien" name="no_ktp_pasien">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Nama Lengkap</label>
                                            <input class="form-control inp" type="text" value="" id="nama" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_nik" class="col-form-label">No NIK</label>
                                            <input class="form-control inp" type="text" value="" id="no_nik" name="no_nik">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Jenis Kelamin</label>
                                            <select class="form-control inp" id="kelamin" name="kelamin">
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-form-label">Alamat</label>
                                            <textarea class="form-control inp" id="alamat" name="alamat"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="col-form-label">Tanggal Lahir</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                <input type="text" class="form-control" id="birth" placeholder="dd-mm-yyyy" name="tgl_lahir">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="supplier" class="col-form-label">No Hp</label>
                                            <input class="form-control inp" type="text" value="" id="no_hp" name="no_hp">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Bpjs Atau Umum</label>
                                            <select class="form-control inp" id="jenis_pasien" name="jenis_pasien">
                                                <option value="BPJS">BPJS</option>
                                                <option value="Umum">Umum</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="supplier" class="col-form-label">Keluhan Sakit</label>
                                            <input class="form-control inp" type="text" value="" id="keluhan" name="keluhan">
                                        </div>
                                    </div>
                                    <div class="form-group pull-right ml-3">
                                        <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i>&nbsp;Tambahkan</button>
                                        <button type="reset" class="btn btn-default btn-md">Reset</button>

                                    </div>


                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>