<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Pengadaan Obat</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <?= $this->session->flashdata('message'); ?>

                            <form method="post" action="<?= base_url('pengadaan_obat/add'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Supplier(asal)</label>
                                    <input class="form-control inp" type="text" value="" id="supplier" name="supplier" placeholder="Masukan nama supplier">
                                </div>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Klik Tombol Cari Obat...." name="nama_obat" id="nama-obat" readonly>
                                  <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-obat"><i class="fa fa-search"></i></button>
                                  </div>
                                    <input type="hidden" value="" id="userid" name="obatid">
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nama-obat" class="col-form-label">Jumlah/<span id="obat_satuan"></span></label>
                                        <input class="form-control inp" type="number" value="" id="qty-obat" name="qty_obat" placeholder="0">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nama-obat" class="col-form-label">Harga</label>
                                        <input class="form-control inp" type="text" value="" id="harga" name="harga" placeholder="0000">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="expired-obat" class="col-form-label">Expired</label>
                                        <input class="form-control inp" type="text" value="" id="expired" name="expired" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                
                                <div class="form-group mt-4" align="right">
                                    
                                    <button type="reset" class="btn btn-default btn-md mr-2">Reset</button>
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Submit</button>
                            
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-obat" tabindex="-1" role="dialog" aria-labelledby="modal-obat-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-obat-title">Pilih Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body data-tables table-responsive">
            <table id="table-kategori" class="table">
            <thead>
                <tr class="text-uppercase text-sm">
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach($obat_list as $obat) : ?>
                    <tr>
                      <td><?= $obat['nama_obat']; ?></td>
                      <td>
                        <?php foreach($list_kategori as $list_k) : ?>
                        <?php if ($obat['id_kategori_obat'] == $list_k['id_kategori_obat']) {
                            echo $list_k['kategori_obat'];
                        }?>
                        <?php endforeach ?>
                        
                      </td>
                      <td>
                          
                        <?php foreach($list_satuan_obat as $list_s) : ?>
                        <?php if ($obat['id_satuan'] == $list_s['id_satuan']) {
                            echo $list_s['nama_satuan'];
                        }?>
                        <?php endforeach ?>

                      </td>
                        <td>
                            <button class="btn btn-success btn-xs" data-nama="<?=$obat['nama_obat']; ?>" data-id="<?=$obat['id_obat']; ?>" id="pilih-obat"><i class="fa fa-check"></i>&nbsp; Pilih</button>
                        </td>
                    </tr>
                    <?php endforeach ?>

            </tbody>

        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>