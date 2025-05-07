<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Tambah Dokter</h4>
                        <p class="text-muted font-14 mb-4">Sebelum Menambahkan Dokter pastikan membuat <code>AKUN PETUGAS DOKTER</code> terlebih dahulu.</p>
                    <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('petugas/addDokterProses'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nama:</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="nama_dokter">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Pilih Username:</label>
                                    <select class="form-control inp" id="level" name="username">
                                        <?php foreach($username as $username) : ?>
                                            <option value="<?= $username['username'];?>"><?= $username['username'];?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Klinik Posisi:</label>
                                    <select class="form-control inp" id="level" name="klinik">
                                        <?php foreach($list_klinik as $klinik) : ?>
                                            <option value="<?= $klinik['poli_id'];?>"><?= $klinik['nama_klinik'];?></option>
                                        <?php endforeach ?>
                                    </select>
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