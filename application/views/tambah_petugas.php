<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Tambah Akun Petugas</h4>
                    <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('petugas/addProses'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nama</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Username</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Password</label>
                                    <input class="form-control inp" type="password" value="" id="nama" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Konfirm Password</label>
                                    <input class="form-control inp" type="password" value="" id="nama" name="r_password">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nomor Telpon</label>
                                    <input class="form-control inp" type="text" value="" id="nama" name="telpon">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Posisi</label>
                                    <select class="form-control inp" id="level" name="level">
                                        <option value="1">SuperAdmin</option>
                                        <option value="2">Petugas Daftar</option>
                                        <option value="3">Apoteker</option>
                                        <option value="4">Dokter</option>
                                        <option value="5">Petugas Laboratorium</option>
                                    </select>
                                </div>
                                <div class="form-group ml-auto">
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Submit</button>
                                    <button type="reset" class="btn btn-default btn-md">Reset</button>
                            
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>