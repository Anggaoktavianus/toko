<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title"><?= ucfirst($page) ?> Category</h4>
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
    <form action="<?= site_url('modal/proses/') ?>" method="POST" class="tm-signup-form row">

        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Forms Control</h4>
                        <input id="id" name="id" type="hidden" class="form-control validate" value="<?= $row->id ?>" />
                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input id="ket" required name="keterangan" type="text" class="form-control validate" value="<?= $row->keterangan ?>" />

                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input id="nilai" required name="jumlah_modal" type="text" class="form-control validate" value="<?= $row->jumlah_modal ?>" />

                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="<?= $page ?>" class="btn btn-success text-white">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger text-white">
                                Reset
                            </button>
                        </div>
                    </div>
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
</div>