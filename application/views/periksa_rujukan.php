<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                        <h4 class="header-title text-center text-uppercase">Periksa Rujukan Internal</h4>
                        <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        <table class="text-left table table-borderless mb-2">
                            <tr>
                                <td>Diagnosa Sebelumnya</td>
                                <td>:</td>
                                <td><?= $pemeriksaan['diagnosa_penyakit'];?></td>
                            </tr>
                        </table>
                            <form method="post" action="<?= base_url('rujukan/addDiagnosa'); ?>">
                                <div class="form-group">
                                    <label for="supplier" class="col-form-label">No Rujuk</label>
                                    <input class="form-control inp" type="text" value="<?=$rujuk_internal->id_rujuk;?>" id="no_rm" name="id_rujuk" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Diagnosa Penyakit Rujukan</label>
                                    <textarea class="form-control inp" name="diagnosa_rujuk"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Saran Dan Tindakan</label>
                                    <textarea class="form-control inp" name="saran_tindakan"></textarea>
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