<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Rujukan Eksternal</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('pemeriksaan/addRujuk_external'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">No Rekam Medis</label>
                                    <input class="form-control inp" type="text" value="<?=$rekam_medis->no_rm;?>" id="nama" name="no_rm" readonly>
                                    <input type="hidden" name="no_ktp_pasien" value="<?=$rekam_medis->no_ktp_pasien;?>">
                                    <input type="hidden" name="nama_pasien" value="<?=$rekam_medis->nama_pasien;?>">
                                    <input type="hidden" name="klinik_perujuk" value="<?=$rekam_medis->poli_id;?>">
                                    <input type="hidden" name="dokter_perujuk" value="<?=$rekam_medis->dokter_id;?>">
                                </div> 
                                <div class="form-group">
                                    <label class="col-form-label">Rumah Sakit Tujuan</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="rs_tujuan">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Nama Dokter Tujuan</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="dokter_tujuan">
                                </div>
                                <div class="form-group ml-auto">
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Submit</button>
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