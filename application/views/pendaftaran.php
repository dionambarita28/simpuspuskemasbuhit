<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Registrasi Pasien</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('pasien/addRegistrasi'); ?>" class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">No Pasien</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->no_pasien;?>" id="nama" name="no_pasien" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Tanggal Berobat</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="tgl_berobat" placeholder="dd-mm-yyyy" name="tgl_berobat" value="<?= date('d-m-Y');?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Jenis Pasien</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->jenis_pasien;?>" id="nama" name="jenis_pasien" readonly>
                                    </div>
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">No Pendaftaran</label>
                                        <input class="form-control inp" type="text" value="" id="nama" name="no_pendaftaran">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Nama Pasien</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->nama;?>" name="nama_pasien" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Biaya</label>
                                        <input class="form-control inp" type="text" value="" id="nama" name="biaya">
                                    </div>
                                    <div class="form-group ml-auto">
                                        <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Daftar</button>
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