<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                    <div class="clearfix col-md-12 ">
                        <div class="text-right">
                            <a href="<?=base_url('laporan/cetak_resep/'.$rekam_medis->no_rm);?>" class="btn btn-green"><i class="fa fa-print"></i>&nbsp; <b>PRINT RESEP</b></a>
                        </div>
                    </div>
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Resep Obat Rekam Medis</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= $this->session->flashdata('message'); ?>

                        <table class="table table-borderless mt-4 mb-3">
                          <tbody>
                            <tr>
                              <th scope="row">No Rekam Medis</td>
                              <td>:</td>
                              <td><?=$rekam_medis->no_rm;?></td>
                            </tr>
                            <tr>
                              <th scope="row">Nama Pasien</td>
                              <td>:</td>
                              <td><?=$rekam_medis->nama_pasien;?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tgl Pemeriksaan</td>
                              <td>:</td>
                              <td><?=$pemeriksaan->tgl_pemeriksaan;?></td>
                            </tr>
                            <tr>
                              <th scope="row">Diagnosa</td>
                              <td>:</td>
                              <td><?=$pemeriksaan->diagnosa_penyakit;?></td>
                            </tr>
                          </tbody>
                        </table>
                            <form method="post" action="<?= base_url('pemeriksaan/addResep'); ?>" class="mb-4">
                              <h4 class="header-title mt-4">Tambah Resep</h4>
                                    <div class="input-group mb-2 mt-2">
                                      <input type="text" class="form-control" placeholder="Klik Tombol Cari Obat...." name="nama_obat" id="nama-obat" readonly>
                                      <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-obat"><i class="fa fa-search"></i></button>
                                      </div>
                                        <input type="hidden" value="" id="userid" name="id_obat">
                                        <input type="hidden" value="<?=$rekam_medis->no_rm;?>" id="no_rm" name="no_rm">
                                        <input type="hidden" value="<?=$rekam_medis->dokter_id;?>" id="no_rm" name="dokter_id">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="supplier" class="col-form-label">Jumlah</label>
                                        <input class="form-control inp" type="number" value="0" id="no_rm" name="jumlah">
                                        <input type="hidden" name="id_rm" value="<?=$rekam_medis->id;?>">
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-success btn-md" name="submit"><i class="fa fa-paper-plane"></i> Tambah Resep</button>
                                      <button type="reset" class="btn btn-default btn-md">Reset</button>
                                    </div>
                                
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                      <?= $this->session->flashdata('message2'); ?>
                        <table class="table" id="table-kategori">
                          <thead class="bg-default">
                            <tr>
                              <th scope="col">ID Obat</th>
                              <th scope="col">Nama Obat</th>
                              <th scope="col">Jumlah</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($resep_list as $resep_l) : ?>
                            <tr>
                              <th scope="row"><?= $resep_l->id_obat;?></th>
                              <td><?=$resep_l->nama_obat;?></td>
                              <td><?=$resep_l->jumlah;?></td>
                              <td><button class="btn btn-danger btn-xs btn-resep" data-toggle="modal" data-target="#hapus-resep" data-idresep="<?= $resep_l->id;?>">HAPUS</button></td>
                            </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="hapus-resep" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus data?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-warning" id="h-only"><i class="fa fa-eraser"></i> Hapus</a>
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
            <table id="table-pasien" class="table">
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