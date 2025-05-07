<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Edit Obat</h4>
                        <?= $this->session->flashdata('message'); ?>

                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('obat/editProses'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nama Obat</label>
                                    <input class="form-control inp" type="text" value="<?=$obat['nama_obat'];?>" id="nama" name="nama_obat">
                                    <input type="hidden" name="id_obat" value="<?=$obat['id_obat'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Stok Obat</label>
                                    <input class="form-control inp" type="number" value="<?=$obat['stok'];?>" id="nama" name="stok">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Kategori Obat</label>
                                    <select class="form-control inp" id="kategori-obat" name="id_kategori_obat">
                                        <?php foreach($list_kategori as $list_k) : ?>
                                        <?php if ($list_k['id_kategori_obat'] == $obat['id_kategori_obat']) {
                                           echo '<option value="'.$list_k['id_kategori_obat'].'" selected>'.$list_k['kategori_obat'].'</option>';
                                        }else{
                                            echo '<option value="'.$list_k['id_kategori_obat'].'">'.$list_k['kategori_obat'].'</option>';
                                        } ?>
                                        
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Satuan Obat</label>
                                    <select class="form-control inp" id="satuan-obat"name="id_satuan">
                                        <?php foreach($list_satuan_obat as $list_s) : ?>
                                        <?php if($list_s['id_satuan'] == $obat['id_satuan']) {
                                           echo '<option value="'.$list_s['id_satuan'].'" selected>'.$list_s['nama_satuan'].'</option>';
                                        }else{
                                            echo '<option value="'.$list_s['id_satuan'].'">'.$list_s['nama_satuan'].'</option>';
                                        } ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Keterangan</label>
                                    <textarea class="form-control inp" id="keterangan" name="keterangan"><?=$obat['keterangan'];?></textarea>
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