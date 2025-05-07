<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5 row">
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-body"> 
                    <?= $this->session->flashdata('message'); ?>
                    <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <h5 class="mb-3">Tambah Kategori Obat</h5>
                        <form action="<?= base_url('kategori_obat/add'); ?>" method="post">
                          <div class="form-group">
                              <div class="row">
                                  <div class="col col-sm-8">
                                    <input name="nama_kategori" type="text" class="form-control" placeholder="Nama Kategori" />
                                  </div>
                                  <div class="col col-sm-3">
                                    <button type="submit" class="btn btn-success btn-md">
                                   <i class="fa fa-plus"></i> Tambah</button>
                                  </div>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="data-tables table-responsive">
                                
                        		<table id="table-obat" class="table" style="width:100%">
                                <thead class="bg-green">
                                    <tr class="text-white text-uppercase">
                                        <th scope="row">No.</th>
                                        <th>Nama Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $i=1 ;?>
                                        <?php foreach($list_kategori as $list_k) : ?>
                                        <tr>
                                        <td><?= $i; ?></td>
                                        <td><strong><?= $list_k['kategori_obat']; ?></strong></td>
                                        <td>    
                                            <button class="btn btn-success btn-xs edit-kategori" data-target="#modal-edit" data-toggle="modal" data-id="<?=$list_k['id_kategori_obat']; ?>" data-kategori="<?=$list_k['kategori_obat']; ?>"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-xs hapus-button" data-target="#hapus" data-toggle="modal" data-url="kategori_obat/delete/<?=$list_k['id_kategori_obat']; ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                        </tr>
                                        <?php $i++ ;?>
                                        <?php endforeach ?>
                                    
                                </tbody>

                            </table>
                        </div>
                        <!-- END LIST -->
                        
                        
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
        <h5 class="modal-title mb-5" id="hapus-title" align="center">Yakin Hapus Kategori Beserta Obat Didalamnya?</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="" class="btn btn-danger" id="haps"><i class="fa fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('kategori_obat/editProses') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row form-group">
                <div class="col col-sm">
                    <label for="edit_floor" class="form-control-label">Nama Kategori</label>
                    <input name="kategori_obat" type="text" class="form-control" value="" id="kategori_nama">
                </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Ubah</button>
            </div>
            <input name="id_kategori_obat" type="hidden" class="form-control" value="" id="id_kategori">
            </form>
        </div>
    </div>
</div>