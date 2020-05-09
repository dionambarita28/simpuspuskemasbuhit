<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>

                    <div class="data-tables table-responsive" id="anti-search">
                    		<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-white text-uppercase text-sm">
                                    <th>No Rm</th>
                                    <th>No Pasien</th>
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
                                      <td><?= $rekam['no_pasien']; ?></td>
                                      <td><?= $rekam['tgl_rekam']; ?></td>
                                      <td><?= $rekam['nama_pasien']; ?></td>
                                      <td>
                                        <?php foreach($poli_list as $list_p) : ?>
                                        <?php if ($rekam['klinik_tujuan'] == $list_p['id']) {
                                            echo $list_p['nama_klinik'];
                                        } ?>
                                        <?php endforeach ?>
                                      </td>
                                      <td><?php foreach($list_dokter as $list_d) : ?>
                                        <?php if ($rekam['dokter_tujuan'] == $list_d['id']) {
                                            echo $list_d['nama_dokter'];
                                        } ?>
                                        <?php endforeach ?></td>
                                      <td><?php if ($rekam['status'] == true) {
                                            echo '<span class="text-success">Diperiksa</span>';
                                        }else{
                                            echo '<span class="text-danger">Belum Diperiksa</span>';
                                        } ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('cetak/info_rm/'.$rekam['id']);?>" class="btn btn-info btn-xs"><i class="fa fa-hospital-o"></i></a>
                                            <a href="" class="btn btn-success btn-xs<?php if($user['level'] != 2){echo " disabled";}?>"><i class="fa fa-pencil"></i></a>
                                            <button data-toggle="modal" data-target="<?php if($user['level'] == 2){echo "#hapus";}?>" class="hapus-button btn btn-danger btn-xs<?php if($user['level'] != 2){echo " disabled";}?>" data-url="rekam_medis/delete_rm/<?=$rekam['id']; ?>"><i class="fa fa-trash"></i></button>
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
<!-- MODAL -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Rekam Medis?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="info-rm" tabindex="-1" role="dialog" aria-labelledby="info-rm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Informasi Rekam Medis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td scope="row">Nama</td>
                  <td>:</td>
                  <td>awefweafwaef</td>
                </tr>
                <tr>
                  <td scope="row">Nomor Rekam Medis</td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Tgl Rekam</td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Klinik</td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Dokter Pemeriksa</td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <td scope="row">Status</td>
                  <td>:</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td scope="row">Diagnosa Dokter</td>
                  <td>:</td>
                  <td>ewfjewalfkhjewkaewhfew ewf khewajkfhewfkjwef weef wef ewahfjk lhwfk</td>
                </tr>
                <tr>
                  <td scope="row">Pemeriksaan Lab</td>
                  <td>:</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td scope="row">Rujukan Internal</td>
                  <td>:</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td scope="row">Rujukan External</td>
                  <td>:</td>
                  <td>-</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            <h5 class="mb-2">Obat Yang Diberikan</h5>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Obat</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success"> <i class="fa fa-print"></i> PRINT</button>
      </div>
    </div>
  </div>
</div>