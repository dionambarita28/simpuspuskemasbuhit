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
                            <a href="<?=base_url('petugas/tambah');?>" class="btn btn-success"><i class="fa fa-plus"></i>  Tambah Petugas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <div class="data-tables table-responsive" id="anti-search">
                    		<table id="table-obat" class="table table-striped table-hover" style="width:100%">
                            <thead class="bg-secondary">
                                <tr class="text-uppercase text-sm text-white">
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $i=1; foreach($list_petugas as $petugas) : ?>
                                    <tr>
                                      <td scope="row" class="text-center"><strong><?= $i; ?></strong></td>
                                      <td><?= $petugas['nama']; ?></td>
                                      <td><?= $petugas['username']; ?></td>
                                      <td><?= $petugas['telpon']; ?></td>
                                      <td><?php if ($petugas['level'] == 1) {
                                          echo "SuperAdmin";
                                      }elseif ($petugas['level'] == 2) {
                                        echo "Petugas Daftar";
                                      }elseif ($petugas['level'] == 3) {
                                        echo "Petugas Apoteker";
                                      }elseif ($petugas['level'] == 5) {
                                        echo "Petugas Labor";
                                      }elseif($petugas['level'] == 4){
                                          echo "Dokter";
                                      } ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-xs modal-edit-petugas" data-target="#modal-edit-petugas" data-toggle="modal" data-nama="<?=$petugas['nama']; ?>" data-id="<?=$petugas['id']; ?>" data-username="<?=$petugas['username']; ?>" data-telpon="<?=$petugas['telpon']; ?>"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="petugas/delete_petugas/<?=$petugas['id']; ?>"><i class="fa fa-trash"></i></button>
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Petugas?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-petugas">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('petugas/editProses') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Petugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Nama</label>
                    <input name="nama" type="text" class="form-control" value="" id="nama_petugas">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Username</label>
                    <input name="username" type="text" class="form-control" value="" id="username_petugas">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Telpon</label>
                    <input name="telpon" type="text" class="form-control" value="" id="telpon_petugas">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Password</label>
                    <input name="password" type="password" class="form-control" value="" id="password_petugas">
                </div>
                <div class="form-group">
                    <label for="edit_floor" class="form-control-label">Konfirm Password</label>
                    <input name="r_password" type="password" class="form-control" value="" id="r_password_petugas">
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id" type="hidden" class="form-control" value="" id="id_petugas">
            </form>
        </div>
    </div>
</div>