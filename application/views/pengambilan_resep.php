<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body row top-info">
                    <div class="col-md-6 clearfix">
                        <input type="text" id="searchbox" class="pull-left form-search col-8" placeholder="Pencarian.." value=""> 
                    </div>
                    <!-- <div class="clearfix col-md-6">
                        <div class="pull-right">
                            <a href="" class="btn btn-warning"><i class="fa fa-file-text"></i> Laporan Resep</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                    		<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-white text-uppercase text-sm">
                                    <th>No Rm</th>
                                    <th>ID Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Setujui</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php foreach($resep_list as $resep) : ?>
                                    <tr>
                                      <td><?= $resep['no_rm']; ?></td>
                                      <td><?= $resep['id_obat']; ?></td>
                                      <td><?= $resep['nama_obat']; ?></td>
                                      <td><?= $resep['jumlah']; ?></td>
                                      <td><?php if ($resep['status'] == 1) {
                                            echo '<span class="text-success">DIberikan</span>';
                                        }elseif ($resep['status'] == 0) {
                                            echo '<span class="text-warning">Belum Diberikan</span>';
                                        }else{
                                            echo '<span class="text-danger">Ditolak</span>';
                                        } ?></td>
                                      <td>
                                          <button class="btn btn-success btn-xs hapus-button<?php if ($resep['status'] == 3) {echo' disabled';}?>" data-target="#hapus" data-toggle="modal" data-url="obat/setuju_resep/<?=$resep['id']; ?>"><i class="fa fa-check"></i></button>
                                          <button class="btn btn-danger btn-xs hapus-button2<?php if ($resep['status'] == 3) {echo' disabled';}?>" data-target="#hapus2" data-toggle="modal" data-url="obat/tolak_resep/<?=$resep['id']; ?>"><i class="fa fa-remove"></i></button>
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Setujui Resep?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-success" id="haps"><i class="fa fa-check"></i> Setujui</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="hapus2" tabindex="-1" role="dialog" aria-labelledby="hapus2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Tolak Resep?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps2"><i class="fa fa-remove"></i> Tolak</a>
      </div>
    </div>
  </div>
</div>