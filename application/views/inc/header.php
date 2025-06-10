<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$title;?> - Simpus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">

    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Stye Datatable -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/typography.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="<?= base_url(); ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href=""><img src="<?= base_url(); ?>assets/images/icon/logo3.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="<?= link_active($title, 'Dashboard'); ?>"><a href="<?= base_url('dashboard'); ?>"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>

                            <?php
                            if ($user['level'] == 1) {
                                echo '
                                <li class="'.link_active($title, 'Petugas').'"><a href="'.base_url('petugas').'"><i class="fa fa-user-md"></i> <span>Petugas</span></a></li>
                                <li class="'.link_active($title, 'Dokter').'"><a href="'.base_url('petugas/dokter').'"><i class="fa fa-stethoscope"></i> <span>Dokter</span></a></li>
                                ';
                            }
                            ?>
                            <?php
                            if ($user['level'] == 2 || $user['level'] == 1) {
                                echo '
                                <li class="'.link_active($title, 'Pasien').'"><a href="'.base_url('pasien').'"><i class="fa fa-heartbeat"></i> <span>Data Pasien</span></a></li>
                                <li class="'.link_active($title, 'Pendaftaran').'"><a href="'.base_url('pasien/list_registrasi').'"><i class="fa fa-list"></i> <span>List Registrasi</span></a></li>
                                ';
                            }
                            ?>
                            <?php
                            if ($user['level'] == 3 || $user['level'] == 1) {
                                echo '
                                <li class="'.link_active($title, 'Obat').'"><a href="'.base_url('obat').'"><i class="fa fa-medkit"></i> <span>Data Obat</span></a></li>
                                <li class="'.link_active($title, 'Kategori Obat').'"><a href="'.base_url('kategori_obat').'"><i class="fa fa-plus-square"></i> <span>Kategori Obat</span></a></li>
                                <li class="'.link_active($title, 'Pengadaan Obat').'"><a href="'.base_url('pengadaan_obat').'"><i class="fa fa-ambulance"></i> <span>Pengadaan Obat</span></a></li>
                                <li class="'.link_active($title, 'Obat Pasien').'"><a href="'.base_url('obat/pengambilan_resep').'"><i class="fa fa-check"></i> <span>Resep Pasien</span></a></li>
                                ';
                            }
                            ?>
                            <?php
                            if ($user['level'] == 4) {
                                echo '
                                <li class="'.link_active($title, 'Pemeriksaan').'"><a href="'.base_url('pemeriksaan').'"><i class="fa fa-stethoscope"></i> <span>Pemeriksaan</span></a></li>
                                <li class="'.link_active($title, 'Resep Obat').'"><a href="'.base_url('pemeriksaan/riwayat_resep').'"><i class="fa fa-hospital-o"></i> <span>Riwayat Resep</span></a></li>
                                <li class="'.link_active($title, 'Rujukan').'"><a href="'.base_url('rujukan').'"><i class="fa fa-ambulance"></i> <span>Rujukan</span></a></li>
                                ';
                            }
                            ?>
                            <?php
                            if ($user['level'] == 5 || $user['level'] == 1) {
                                echo '
                                <li class="'.link_active($title, 'Laboratorium').'"><a href="'.base_url('laboratorium').'"><i class="fa fa-flask"></i> <span>Data Labor</span></a></li>
                                ';
                            }
                            ?>
                            <li class="<?= link_active($title, 'Rekam Medis'); ?>"><a href="<?= base_url('rekam_medis'); ?>"><i class="fa fa-heart"></i> <span>Rekam Medis</span></a></li>
                            <li class="<?= link_active($title, 'Riwayat Rekam'); ?>"><a href="<?= base_url('rekam_medis/riwayat_rekam'); ?>"><i class="fa fa-history"></i> <span>Riwayat Rekam</span></a></li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <!-- <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span>2</span>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                    <div class="nofity-list">
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                            <div class="notify-text">
                                                <p>NO NOTIF</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </li> -->
                            
                            <li class="settings-btn">
                                <i class="ti-settings"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?=$title;?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                                <li><span><?=$title;?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?= base_url(); ?>assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= $user['nama']; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url('user'); ?>">Edit Profil</a>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>