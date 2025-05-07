<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body row top-info">
                    <div class="col-md-6 clearfix">
                        <input type="text" id="searchbox" class="pull-left form-search col-8" placeholder="Pencarian.." value=""> 
                    </div>
                    <div class="clearfix col-md-6">
                        <div class="pull-right">
                            <!-- <a href="" class="btn btn-warning"><i class="fa fa-file-text"></i> Laporan Pemeriksaan</a> -->
                        </div>
                    </div>
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
                                    <th>Tgl Rekam</th>
                                    <th>Nama Pasien</th>
                                    <th>Klinik</th>
                                    <th>Dokter</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php foreach($rekam_list as $rekam) : ?>
                                    <tr>
                                      <td><?= $rekam['no_rm']; ?></td>
                                      <td><?= $rekam['tgl_rekam']; ?></td>
                                      <td><?= $rekam['nama_pasien']; ?></td>
                                      <td>
                                        <?php foreach($poli_list as $list_p) : ?>
                                        <?php if ($rekam['poli_id'] == $list_p['poli_id']) {
                                            echo $list_p['nama_klinik'];
                                        } ?>
                                        <?php endforeach ?>
                                      </td>
                                      <td><?php foreach($list_dokter as $list_d) : ?>
                                        <?php if ($rekam['dokter_id'] == $list_d['dokter_id']) {
                                            echo $list_d['nama_dokter'];
                                        } ?>
                                        <?php endforeach ?></td>
                                      <td><?php if ($rekam['status'] == true) {
                                            echo '<span class="text-success">Diperiksa</span>';
                                        }else{
                                            echo '<span class="text-danger">Belum Diperiksa</span>';
                                        } ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-xs<?php if($rekam['status'] == false){echo " disabled";}else{echo " rujuk-bnt";}?>" data-toggle="<?php if($rekam['status'] == true){echo "modal";}?>" data-target="#modal-rujuk" data-norm="<?= $rekam['no_rm']; ?>"><i class="fa fa-sign-out"></i></button>
                                            <button type="button" class="lab-btn btn btn-danger btn-xs<?php if($rekam['status'] == false){echo " disabled";}else{echo " rujuk-bnt";}?>" data-toggle="<?php if($rekam['status'] == true){echo "modal";}?>" data-target="#modal-lab" data-norm="<?= $rekam['id']; ?>"><i class="fa fa-flask"></i></button>
                                            <a href="<?= base_url('pemeriksaan/resep/').$rekam['no_rm'];?>" class="btn btn-info btn-xs <?php if($rekam['status'] == false){echo "disabled";}?>"><i class="fa fa-hospital-o"></i></a>
                                            <a href="<?= base_url('pemeriksaan/periksa/').$rekam['no_rm'];?>" class="btn btn-warning btn-xs <?php if($rekam['status'] == true){echo "disabled";}?>">Periksa</a>
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

<div class="modal fade" id="modal-rujuk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rujuk-title-modal">Rujukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 row mx-auto">
                        <a href="" class="btn btn-success col-md-6 btn-flat" id="r-internal"><i class="fa fa-wheelchair"></i>&nbsp;INTERNAL</a>
                        <a href="" class="btn btn-info col-md-6 btn-flat" id="r-external"><i class="fa fa-ambulance"></i>&nbsp;EXTERNAL</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-lab" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Kirimkan Pemeriksaan Ke LAB?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger lab-a"><i class="fa fa-paper-plane"></i> Kirim</a>
      </div>
    </div>
  </div>
</div>