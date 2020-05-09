<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Edit Password</h4>
                    <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <form method="post" action="<?= base_url('user/editPassword'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Password Lama:</label>
                                    <input class="form-control inp" type="password" value="" id="nama" name="password_lama">
                                    <input type="hidden" name="username" value="<?=$user['username'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Password Baru:</label>
                                    <input class="form-control inp" type="password" value="" id="nama" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">Konfirmasi Password Baru:</label>
                                    <input class="form-control inp" type="password" value="" id="nama" name="r_password">
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