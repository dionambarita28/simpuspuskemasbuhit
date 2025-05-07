<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Tambah Jenis Obat</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('obat/addProses'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nama Obat</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Kategori Obat</label>
                                    <select class="form-control inp" id="id_kategori_obat" name="id_kategori_obat">
                                        <option value="NULL">-- Pilih Kategori Obat --</option>
                                        <?php foreach($list_kategori as $list_k) { ?>
                                        <option value="<?= $list_k['id_kategori_obat']; ?>"><?= $list_k['kategori_obat']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Satuan Obat</label>
                                    <select class="form-control inp" id="id_satuan"name="id_satuan">
                                        <option value="NULL">-- Pilih Satuan Obat --</option>
                                        <?php foreach($list_satuan_obat as $list_s) { ?>
                                        <option value="<?= $list_s['id_satuan']; ?>"><?= $list_s['nama_satuan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Keterangan</label>
                                    <textarea class="form-control inp" id="keterangan" name="keterangan"></textarea>
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