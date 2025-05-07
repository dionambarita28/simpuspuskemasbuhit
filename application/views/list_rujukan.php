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
                            <!-- <a href="" class="btn btn-warning"><i class="fa fa-file-text"></i> Laporan Resep</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Rujukan Dari Klinik Lain</h4>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                    		<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-white text-uppercase text-sm">
                                    <th>No Rm</th>
                                    <th>No KTP Pasien</th>
                                    <th>Nama Pasien</th>
                                    <th>Dari</th>
                                    <th>Dokter</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php foreach($rujuk_internal as $rujuk_i) : ?>
                                    <tr>
                                      <td><?= $rujuk_i['no_rm']; ?></td>
                                      <td><?= $rujuk_i['no_ktp_pasien']; ?></td>
                                      <td><?= $rujuk_i['nama_pasien']; ?></td>
                                      <td>
                                        <?php foreach($klinik_list as $klinik) : ?>
                                        <?php if ($rujuk_i['poli_id'] == $klinik['poli_id']) {
                                            echo $klinik['nama_klinik'];
                                        } ?>
                                        <?php endforeach ?>
                                        </td>
                                      <td>
                                        <?php foreach($list_dokter as $dokter) : ?>
                                        <?php if ($rujuk_i['dokter_id'] == $dokter['dokter_id']) {
                                            echo $dokter['nama_dokter'];
                                        } ?>
                                        <?php endforeach ?>
                                      </td>
                                      <td><?php if ($rujuk_i['status'] == true) {
                                            echo '<span class="text-success">Diperiksa</span>';
                                        }else{
                                            echo '<span class="text-danger">Belum Diperiksa</span>';
                                        } ?>
                                      </td>
                                      <td class="text-center">
                                            <a href="<?= base_url('rujukan/periksa/').$rujuk_i['id_rujuk'];?>" class="btn btn-warning btn-xs<?php if($rujuk_i['status'] == true){echo " disabled";}?>">Periksa</a>
                                            <button class="u-diagnosa btn btn-info btn-xs<?php if($rujuk_i['status'] == false){echo " disabled";}?>" data-target="<?php if($rujuk_i['status'] == true){echo "#modal-edit";}?>" data-toggle="modal" data-diagnosa="<?=$rujuk_i['diagnosa_rujuk']; ?>" data-saran="<?=$rujuk_i['saran_tindakan']; ?>" data-id="<?=$rujuk_i['id_rujuk']; ?>">Ubah Diagnosa</button>
                                            
                                       </td>
                                    </tr>
                                    <?php endforeach ?>

                            </tbody>

                        </table>



                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body bg-secondary text-uppercase text-center text-white pt-3 pb-3">
                    Riwayat Anda Merujuk
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Riwayat Rujukan Internal</h4>
                    <?= $this->session->flashdata('message3'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                            <table id="table-kategori" class="table table-hover" style="width:100%">
                            <thead class="bg-success">
                                <tr class="text-white text-uppercase text-sm">
                                    <th>Nama Pasien</th>
                                    <th>Ke</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php foreach($rujuk_internalr as $rujuk_i) : ?>
                                    <tr>
                                      <td><?= $rujuk_i['nama_pasien']; ?></td>
                                      <td>
                                        <?php foreach($klinik_list as $klinik) : ?>
                                        <?php if ($rujuk_i['poli_id'] == $klinik['poli_id']) {
                                            echo $klinik['nama_klinik'];
                                        } ?>
                                        <?php endforeach ?>
                                        </td>
                                      <td><?php if ($rujuk_i['status'] == true) {
                                            echo '<span class="text-success">Diperiksa</span>';
                                        }else{
                                            echo '<span class="text-danger">Belum Diperiksa</span>';
                                        } ?>
                                      </td>
                                      <td class="text-center">
                                            <a href="<?= base_url('rujukan/hapus_internal/').$rujuk_i['id_rujuk'];?>" class="badge badge-info btn-xs"><i class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                    <?php endforeach ?>

                            </tbody>

                        </table>



                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Riwayat Rujukan External</h4>
                    <?= $this->session->flashdata('message3'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                            <table id="table-pasien" class="table table-hover" style="width:100%">
                            <thead class="bg-primary text-uppercase">
                                <tr class="text-white text-sm">
                                    <th>Nama</th>
                                    <th>Ke</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php foreach($rujuk_external as $rujuk_i) : ?>
                                    <tr>
                                      <td>
                                        <?php foreach($pasien as $psn) : ?>
                                            <?php 
                                            if ($rujuk_i['no_ktp_pasien'] == $psn['no_ktp_pasien']) {
                                                echo $psn['nama'];
                                            }
                                            ?>
                                        <?php endforeach ?>
                                      </td>
                                      <td><?= $rujuk_i['rs_tujuan']; ?></td>
                                      
                                      <td class="text-center">
                                            <a href="<?= base_url('rujukan/hapus_external/').$rujuk_i['id_rujuk'];?>" class="badge badge-danger btn-xs"><i class="fa fa-trash"></i></a>
                                            <a href="<?= base_url('cetak/cetak_rujuk/').$rujuk_i['id_rujuk'];?>" class="badge badge-info btn-xs"><i class="fa fa-print"></i>&nbsp; PRINT</a>
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('rujukan/editRujuk') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Diagnosa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Diagnosa" class="col-form-label">Diagnosa Rujuk</label>
                    <textarea class="form-control inp" id="diagnosa_rujuk" name="diagnosa_rujuk"></textarea>
                </div>
                <div class="form-group">
                    <label for="Diagnosa" class="col-form-label">Saran Tindakan</label>
                    <textarea class="form-control inp" id="saran_tindakan" name="saran_tindakan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id_rujuk" type="hidden" class="form-control" value="" id="id_rujuk">
            </form>
        </div>
    </div>
</div>