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
                            <a href="<?=base_url('petugas/tambah_dokter');?>" class="btn btn-success"><i class="fa fa-plus"></i>  Tambah Dokter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>');?>
                    <div class="data-tables table-responsive" id="anti-search">
                    		<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-uppercase text-sm text-white">
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Klinik</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($list_dokter as $dokter) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                      <td><?= $dokter['nama_dokter']; ?></td>
                                      <td><?= $dokter['username']; ?></td>
                                      <td>
                                      <?php foreach($list_klinik as $klinik) : ?>

                                      <?php if ($dokter['poli_id'] == $klinik['poli_id']) {
                                          echo $klinik['nama_klinik'];
                                        } 
                                      ?>
                                      <?php endforeach ?>
                                      </td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-xs modal-edit-dokter" data-target="#modal-edit-dokter" data-toggle="modal" data-nama="<?=$dokter['nama_dokter']; ?>" data-id="<?=$dokter['dokter_id']; ?>"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="petugas/delete_dokter/<?=$dokter['dokter_id']; ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach ?>

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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Dokter?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-dokter">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('petugas/editDokterProses') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Dokter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Nama Dokter:</label>
                    <input name="nama_dokter" type="text" class="form-control" value="" id="nama_dokter">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Klinik Posisi:</label>
                    <select class="form-control inp" id="level" name="klinik">
                        <?php foreach($list_klinik as $klinik) : ?>
                            <option value="<?= $klinik['poli_id'];?>"><?= $klinik['nama_klinik'];?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id" type="hidden" class="form-control" value="" id="id_dokter">
            </form>
        </div>
    </div>
</div>