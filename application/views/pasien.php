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
                            <a href="<?= base_url('pasien/add_Pasien'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pasien</a>
                            <a href="<?= base_url('cetak/laporan_pasien'); ?>" class="btn btn-warning"><i class="fa fa-file-text"></i> Laporan Pasien</a>
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
                                <tr class="text-uppercase text-sm text-white">
                                    <th scope="col" class="text-center">No KTP Pasien</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Kelamin</th>
                                    <th scope="col">Tgl Lahir</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($pasien_list as $pasien) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $pasien['no_ktp_pasien']; ?></strong></td>
                                      <td><?= $pasien['nama']; ?></td>
                                      <td><?= $pasien['kelamin']; ?></td>
                                      <td><?= $pasien['tgl_lahir']; ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('pasien/editPasien/').$pasien['no_ktp_pasien'];?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="pasien/delete_pasien/<?=$pasien['id']; ?>"><i class="fa fa-trash"></i></button>
                                            <a href="<?= base_url('pasien/daftar/').$pasien['no_ktp_pasien'];?>" class="btn btn-warning btn-xs">Daftar</a>
                                            <a href="<?= base_url('laporan/cetak_kartu/').$pasien['no_ktp_pasien'];?>" class="btn btn-info btn-xs">Kartu</a>
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Pasien?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

