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
                            <a href="<?=base_url('laporan/pendaftaran');?>" class="btn btn-warning"><i class="fa fa-file-text"></i> Laporan Pendaftaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                  <h4 class="mb-4">Registrasi Hari Ini</h4>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                    		<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-uppercase text-sm text-white">
                                    <th scope="col" class="text-center">No Daftar</th>
                                    <th scope="col">No KTP Pasien</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tgl Berobat</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($list_registrasi2 as $registrasi2) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $registrasi2['no_pendaftaran']; ?></strong></td>
                                      <td><?= $registrasi2['no_ktp_pasien']; ?></td>
                                      <td><?= $registrasi2['nama_pasien']; ?></td>
                                      <td><?= $registrasi2['tgl_berobat']; ?></td>
                                      <td><?= $registrasi2['jenis_pasien']; ?></td>
                                      <td>Rp. <?= number_format($registrasi2['biaya']); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="pasien/delete_register/<?=$registrasi2['id']; ?>"><i class="fa fa-trash"></i></button>
                                            <a href="<?= base_url('rekam_medis/rekam/').$registrasi2['no_ktp_pasien'];?>" class="btn btn-warning btn-xs">Rekam</a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>

                            </tbody>

                        </table>



                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                  <h4 class="mb-4">Semua Registrasi</h4>
                    <div class="data-tables table-responsive">
                        <table id="table-kategori" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr class="text-uppercase text-sm">
                                    <th scope="col" class="text-center">No Daftar</th>
                                    <th scope="col">No KTP Pasien</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tgl Berobat</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($list_registrasi as $registrasi) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $registrasi['no_pendaftaran']; ?></strong></td>
                                      <td><?= $registrasi['no_ktp_pasien']; ?></td>
                                      <td><?= $registrasi['nama_pasien']; ?></td>
                                      <td><?= $registrasi['tgl_berobat']; ?></td>
                                      <td><?= $registrasi['jenis_pasien']; ?></td>
                                      <td>Rp. <?= number_format($registrasi['biaya']); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="pasien/delete_register/<?=$registrasi['id']; ?>"><i class="fa fa-trash"></i></button>
                                            <a href="<?= base_url('rekam_medis/rekam/').$registrasi['no_ktp_pasien'];?>" class="btn btn-warning btn-xs">Rekam</a>
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Data Registrasi?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>
