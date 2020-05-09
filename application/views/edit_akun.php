<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Edit Akun</h4>
                    <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('user/editProses'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nama</label>
                                    <input class="form-control inp" type="text" value="<?=$user['nama'];?>" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Username</label>
                                    <input class="form-control inp" type="text" value="<?=$user['username'];?>" id="nama" name="username" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Nomor Telpon</label>
                                    <input class="form-control inp" type="text" value="<?=$user['telpon'];?>" id="nama" name="telpon">
                                </div>
                                <div class="form-group ml-auto">
                                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Edit</button>
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