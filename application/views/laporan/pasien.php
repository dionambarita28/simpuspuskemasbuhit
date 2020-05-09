<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Laporan Pasien</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('cetak/laporan_pasien'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Pilih Bulan & Tahun</label>
                                    <input class="form-control inp" type="text" value="<?= date('m-Y');?>" id="bulan" name="bulan">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="seluruh" name="seluruh">
                                    <label class="form-check-label" for="seluruh">Seluruh Data (<span class="text-danger">tanpa memasukan bulan</span>)</label>
                                </div>
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> PRINT</button>
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