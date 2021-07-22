<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title"><?= ucfirst($page) ?> Customer</h4>
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
    <form action="<?= site_url('customer/proses') ?>" method="POST" class="">
        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Forms Control</h4>
                        <input id="id_customer" name="id_customer" type="hidden" class="form-control" value="<?= $row->id_customer ?>" />
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" required name="name" type="text" class="form-control" value="<?= $row->name ?>" />

                        </div>
                        <div class="form-group ">
                            <label for="phone">Telepon</label>
                            <input id="phone" required name="phone" type="number" class="form-control" value="<?= $row->phone ?>" />

                        </div>
                        <div class="form-group ">
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="form-control" required />
                            <option value="">--Pilih--</option>
                            <option value="L" <?= $row->gender == 'L' ? 'selected' : null ?>>Laki-laki</option>
                            <option value="P" <?= $row->gender == 'P' ? 'selected' : null ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="address">Alamat</label>
                            <textarea id="desc" name="address" class="form-control"> <?= $row->address ?></textarea>
                            </textarea>
                        </div>
                        <div class="form-group ">
                            <label for="description">Keterangan</label>
                            <textarea id="desc" name="description" class="form-control "> <?= $row->description ?></textarea>
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