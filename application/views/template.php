<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>POS Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon.png') ?>">
    <!-- Modal -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> -->
    <!-- Datetime -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')?>">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bs-stepper/css/bs-stepper.min.css')?>">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/dropzone/min/dropzone.min.css')?>">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/libs/fullcalendar/dist/fullcalendar.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/extra-libs/calendar/calendar.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/dist/css/style.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/morris.css'?>"/>

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/extra-libs/multicheck/multicheck.css') ?>">
    <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?= site_url('home') ?>">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url('assets/images/logo-icon.png') ?>" alt="homepage" class="light-logo" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="<?= base_url('assets/images/logo1.png') ?>" alt="homepage" class="light-logo" />
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="<?= base_url('assets/images/logo-text.png') ?>" alt="homepage" class="light-logo" /> -->
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= base_url('assets/images/users/d3.jpg') ?> " alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>
                                    <?= $this->session->userdata('username')?></a></a>
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('home') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <?php if ($this->fungsi->user_login()->level == 1) { ?>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Master Data </span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?= site_url('category') ?>" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Kategori Satuan
                                        </span></a></li>
                                <li class="sidebar-item"><a href="<?= site_url('unit') ?>" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Kategori Unit
                                     <li class="sidebar-item"><a href="<?= site_url('menu') ?>" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Kategori Produk
                                    <li class="sidebar-item"><a href="<?= site_url('aset/index') ?>" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Data Aset
                                            </span></a></li>
                                    <li class="sidebar-item"><a href="<?= site_url('modal/index') ?>" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">Data Modal
                                            </span></a></li>
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('user') ?>" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Management User </span></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('suplier') ?>" aria-expanded="false"><i class="mdi mdi-truck-delivery"></i><span class="hide-menu">Data Suplier</span></a></li>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('customer') ?>" aria-expanded="false"><i class="mdi mdi-account-plus"></i><span class="hide-menu">Customer</span></a></li> -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('items') ?>" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Data Produk </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-archive"></i><span class="hide-menu">Data Stok</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="<?= site_url('stock/in') ?>" class="sidebar-link"><i class="mdi mdi-arrow-right-box"></i><span class="hide-menu"> Stock Masuk </span></a>
                                </li>
                                <li class="sidebar-item"><a href="<?= site_url('stock/out') ?>" class="sidebar-link"><i class="mdi mdi-arrow-left-box"></i><span class="hide-menu"> Stock Keluar </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a href="<?= site_url('sales') ?>" class="sidebar-link"><i class="mdi mdi-cart-outline"></i><span class="hide-menu">Data Penjualan 
                                        </span></a></li>
                            <!-- <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?= site_url('sales') ?>" class="sidebar-link"><i class="mdi mdi-cart-outline"></i><span class="hide-menu"> Penjualan 
                                        </span></a></li>
                                <li class="sidebar-item"><a href="<?= site_url('rekap_modal/excel') ?>" class="sidebar-link"><i class="mdi mdi-cart-off"></i><span class="hide-menu"> History Penjualan </span></a></li>
                            </ul> -->
                        </li>
                        <li class="sidebar-item"><a href="<?= site_url('toko')?>" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">Data Pembelian Toko</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu">Rekap </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                            <?php if ($this->fungsi->user_login()->level == 2) { ?>
                             <li class="sidebar-item"><a href="<?= site_url('rekap_modal/pegawai') ?>" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> History Penjualan
                                        </span></a></li>
                                <!-- <li class="sidebar-item"><a href="<?= site_url('perusahaan')?>" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Perusahaan -->
                            <?php } ?>
                            <?php if ($this->fungsi->user_login()->level == 1) { ?>
                            <li class="sidebar-item"><a href="<?= site_url('rekap/barang') ?>" class="sidebar-link"><i class="mdi mdi-cart-off"></i><span class="hide-menu"> History Penjualan Barang </span></a></li>
                            <li class="sidebar-item"><a href="<?= site_url('rekap') ?>" class="sidebar-link"><i class="mdi mdi-cart-off"></i><span class="hide-menu"> Laporan Penjualan </span></a></li>
                                <li class="sidebar-item"><a href="<?= site_url('laba/index?tanggal=&tanggal1=')?>" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">Laporan Laba</span></a></li>
                            <?php } ?>
                                <li class="sidebar-item"><a href="<?= site_url('rekap/toko_add?tanggal=&tanggal1=') ?>" class="sidebar-link"><i class="mdi mdi-cart-off"></i><span class="hide-menu"> Laporan Pembelian Toko </span></a></li>
                                <li class="sidebar-item"><a href="<?= site_url('jasa')?>" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu">Laporan Jasa</span></a></li>
                                <li class="sidebar-item"><a href="<?= site_url('') ?>" class="sidebar-link"><i class="mdi mdi-cart-off"></i><span class="hide-menu"> Laporan Return </span></a></li>     
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <script src="<?= base_url('assets/js/jquery.min.js') ?> "></script>
        <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?> "></script>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php echo $contents ?>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-left">
                All Rights Reserved by . Template by <a href="https://www.wrappixel.com">WrapPixel</a>&ensp;
                Point Of Sales <a href="">Version : 1.0 Beta</a>
            </footer>
           
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- <script src="<?= base_url('assets/dist/js/jquery.ui.touch-punch-improved.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/jquery-ui.min.js') ?>"></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets//extra-libs/sparkline/sparkline.js') ?>"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('assets/dist/js/waves.js') ?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url('assets/dist/js/sidebarmenu.js') ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('assets/dist/js/custom.min.js') ?>"></script>
   
    <!-- this page js -->
    <script src="<?= base_url('assets/libs/moment/min/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/fullcalendar/dist/fullcalendar.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/pages/calendar/cal-init.js') ?>"></script>

    <script src="<?= base_url('assets/extra-libs/multicheck/datatable-checkbox-init.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/multicheck/jquery.multicheck.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/DataTables/datatables.min.js') ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?= base_url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>
    <!-- InputMask -->
    <script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- bootstrap color picker -->
    <script src="<?= base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
    <!-- Bootstrap Switch -->
    <script src="<?= base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>"></script>
    <!-- BS-Stepper -->
    <script src="<?= base_url('assets/plugins/bs-stepper/js/bs-stepper.min.js') ?>"></script>
    <!-- dropzonejs -->
    <script src="<?= base_url('assets/plugins/dropzone/min/dropzone.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script>
        /*****************************************       Basic Table                   *****************************************/
        $('#zero_config').DataTable();
    </script>
    <script>
        /*****************************************       Basic Table                   *****************************************/
        $('#example').DataTable();
    </script>

</body>

</html>