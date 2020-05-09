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
                                            echo '<span class="text-success">Diperiksa</span>';
                                        }elseif ($resep['status'] == 0) {
                                            echo '<span class="text-warning">Belum Diperiksa</span>';
                                        }else{
                                            echo '<span class="text-danger">Ditolak</span>';
                                        } ?></td>
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
