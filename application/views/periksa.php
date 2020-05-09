<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Periksa Rekam Medis</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('pemeriksaan/addProses'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">No Rekam Medis</label>
                                    <input class="form-control inp" type="text" value="<?=$rekam_medis->no_rm;?>" id="no_rm" name="no_rm" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Tanggal Pemeriksaan</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="pemeriksaan" placeholder="dd-mm-yyyy" name="tgl_pemeriksaan" value="<?= date('d-m-yy');?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Diagnosa Penyakit</label>
                                    <textarea class="form-control inp" name="diagnosa_penyakit"></textarea>
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