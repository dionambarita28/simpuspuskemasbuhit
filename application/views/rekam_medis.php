<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Tambah Rekam Medis</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('rekam_medis/addProses'); ?>">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="supplier" class="col-form-label">No Pasien</label>
                                        <input class="form-control inp" type="text" value="<?=$pasien->no_pasien;?>" id="nama" name="no_pasien" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="supplier" class="col-form-label">No Pendaftaran</label>
                                        <input class="form-control inp" type="text" value="<?=$pendaftaran->no_pendaftaran;?>" id="nama" name="no_pendaftaran" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">No Rekam Medis</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="no_rm">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Tanggal Rekam</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="birth" placeholder="dd-mm-yyyy" name="tgl_rekam" value="<?= date('d-m-Y');?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-form-label">Klinik Tujuan</label>
                                    <select class="form-control inp" id="klinik" name="klinik_tujuan">
                                        <?php foreach($list_klinik as $list_p) : ?>
                                        <option value="<?= $list_p['id']; ?>"><?= $list_p['nama_klinik']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Dokter Tujuan</label>
                                    <select class="form-control inp" id="dokter" name="dokter_tujuan">
                                        <?php foreach($dokter as $dkter) : ?>
                                        <option value="<?=$dkter->id;?>"><?=$dkter->nama_dokter;?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Pasien</label>
                                    <input class="form-control inp" type="text" value="<?=$pasien->nama;?>" name="nama_pasien" readonly>
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