<div class="main-content-inner">
    <div class="row mt-4">
        <!-- data table start -->
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-users"></i></div>
                            <h2><?=$kunjungan;?></h2>
                            <span>Kunjungan/Bulan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-user-plus"></i></div>
                            <h2><?=$pasien;?></h2>
                            <span>Jumlah Pasien</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg3 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-flask"></i></div>
                            <h2><?=$lab;?></h2>
                            <span>Layanan Lab/Hari</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg4 pb-3">
                        <div class="p-4">
                            <div class="seofct-icon"><i class="fa fa-medkit"></i></div>
                            <h2><?=$obat;?></h2>
                            <span>Layanan Obat/Bulan</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <canvas id="myKunjungan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <canvas id="myObat"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>