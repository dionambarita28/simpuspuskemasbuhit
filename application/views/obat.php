<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="text-left mb-4">
                    <a href="<?= base_url('obat/addObat'); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Jenis Obat</a>
                    <!-- <a href="" class="btn btn-success btn-warning btn-sm"><i class="fa fa-file-text"></i> Laporan Obat</a> -->
                    </div>
                    <div class="data-tables table-responsive">
                    		<table id="table-obat" class="table" style="width:100%">
                            <thead class="bg-info">
                                <tr class="text-white text-uppercase text-sm">
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Satuan Obat</th>
                                    <th>Supplier</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Expired</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($obat_list as $obat) : ?>
                                    <tr>
                                      <td><?= $obat['nama_obat']; ?></td>
                                      <td class="text-right">
                                        <?php foreach($list_kategori as $list_k) : ?>
                                        <?php if ($obat['id_kategori_obat'] == $list_k['id_kategori_obat']) {
                                            echo $list_k['kategori_obat'];
                                        }?>
                                        <?php endforeach ?>
                                        
                                      </td>
                                      <td class="text-right">
                                          
                                        <?php foreach($list_satuan_obat as $list_s) : ?>
                                        <?php if ($obat['id_satuan'] == $list_s['id_satuan']) {
                                            echo $list_s['nama_satuan'];
                                        }?>
                                        <?php endforeach ?>

                                      </td>
                                      <td><?= $obat['supplier']; ?></td>
                                      <td><?= $obat['harga']; ?></td>
                                      <td><?= $obat['stok']; ?></td>
                                      <td><?= $obat['expired']; ?></td>
                                      <td><?= substr($obat['keterangan'],0,20 ); ?>..</td>
                                        <td>    
                                            <a href="<?=base_url('obat/update_obat/').$obat['id_obat'];?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="obat/delete/<?=$obat['id_obat']; ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>

                            </tbody>

                        </table>



                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus data?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>