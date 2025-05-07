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
                                    <th scope="col" class="text-center">No Pasien</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelamin</th>
                                    <th scope="col">Tgl Lahir</th>
                                    <th scope="col">Jenis Pasien</th>
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
                                      <td><?= $pasien['jenis_pasien']; ?> cm</td>
                                        <td class="text-center">
                                            <a href="<?=base_url('cetak/riwayat/'.$pasien['no_ktp_pasien']);?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Lihat</a>
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

