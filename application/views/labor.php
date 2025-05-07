<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body row top-info">
                    <div class="col-md-6 clearfix">
                        <input type="text" id="searchbox" class="pull-left form-search col-8" placeholder="Pencarian.." value=""> 
                    </div>
                    <div class="clearfix col-md-6">
                        <!-- <div class="pull-right">
                            <a href="" class="btn btn-warning"><i class="fa fa-file-text"></i> Laporan Laboratorium</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
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
                                    <th>No Labor</th>
                                    <th>No KTP Pasien</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($list_labor as $labor) : ?>
                                    <tr>
                                      <td><?= $labor['no_rm']; ?></td>
                                      <td><?= $labor['no_labor']; ?></td>
                                      <td><?= $labor['no_ktp_pasien']; ?></td>
                                      <td><?= $labor['tgl_labor']; ?></td>
                                      <td>
                                        <?php foreach($list_pasien as $pasien) : ?>
                                            <?php 
                                                if ($labor['no_ktp_pasien'] == $pasien['no_ktp_pasien']) {
                                                    echo $pasien['nama'];
                                                }
                                            ?>
                                        <?php endforeach ?>

                                      </td>
                                      <td><?php if ($labor['status'] == true) {
                                            echo '<span class="text-success">Diperiksa</span>';
                                        }else{
                                            echo '<span class="text-danger">Belum Diperiksa</span>';
                                        } ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('cetak/info_rm/'.$labor['id_rm']);?>" class="btn btn-info btn-xs"><i class="fa fa-hospital-o"></i></a>
                                            <button class="btn btn-success btn-xs btn-labp" data-target="#modal-periksa" data-toggle="modal" data-id="<?= $labor['id']; ?>" data-keterangan="<?= $labor['keterangan_labor']; ?>" data-nolabor="<?= $labor['no_labor']; ?>"><i class="fa fa-eye"></i> Periksa</button>
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

<div class="modal fade" id="modal-periksa">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="form-edit" action="<?php echo base_url('laboratorium/periksaProses') ;?>" method="post">
            <div class="modal-header">
                <h4 class="modal-title">Periksa Lab</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="supplier" class="col-form-label">Nomor Pemeriksaan Lab</label>
                    <input class="form-control inp" type="text" value="" id="no_lab" name="no_labor">
                </div>
                <div class="form-group">
                    <label for="Diagnosa" class="col-form-label">Keterangan Lab</label>
                    <textarea class="form-control inp" id="keterangan_labor" name="keterangan_labor"></textarea>
                </div>
            <input name="id" type="hidden" class="form-control" value="" id="id_lab">
            <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-edit"></i> Sumbit</button>
            </div>
            </form>
        </div>

    </div>
</div>