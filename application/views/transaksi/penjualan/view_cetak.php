

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Cetak</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!--==============================================================-->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        
        <div class="col-lg-12">
            <form action="<?php echo base_url() .
                'sales/cetak_struk_grosir'; ?>" method="post">
                <div class="card">
                    <div class="card-body">
                            <button type="submit" class="btn btn-info btn-sm"> Cetak</button>
			                <a type="submit" href="<?=site_url('sales/')?>" class="btn btn-info btn-sm"> Kembali</a>
                    </div>
                </div>
            </form>
            <hr />
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>

