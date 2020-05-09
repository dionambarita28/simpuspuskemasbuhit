<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                        <h3 class="header-title text-center text-uppercase mb-5">Edit Pasien</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('pasien/editProses'); ?>" class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">No Pasien</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->no_pasien;?>" id="nama" name="no_pasien" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">No Ktp</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->no_ktp;?>" id="nama" name="no_ktp">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Nama</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->nama;?>" id="nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Pekerjaan</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->pekerjaan;?>" id="nama" name="pekerjaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Alamat</label>
                                        <textarea class="form-control inp" id="keterangan" name="alamat"><?=$pasien->alamat;?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="col-form-label">Jenis Kelamin</label>
                                    <select class="form-control inp" id="satuan-obat" name="kelamin">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Tanggal Lahir</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="birth" placeholder="dd-mm-yyyy" name="tgl_lahir" value="<?=$pasien->tgl_lahir;?>">
                                    </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Agama</label>
                                        <select class="form-control inp" id="satuan-obat"name="agama">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                            <option value="Hindu">Hindu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Tinggi Badan(Cm)</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->tinggi;?>" id="tinggi" name="tinggi">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Berat Badan(kg)</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->berat;?>" id="berat" name="berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Jenis Pasien</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->jenis_pasien;?>" id="jenis" name="jenis_pasien">
                                    </div>
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i>&nbsp;Edit</button>
                                        <button type="reset" class="btn btn-default btn-md">Reset</button>
                                
                                    </div>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>