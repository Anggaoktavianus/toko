<!-- content-wrapper ends -->

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Tambah Pengguna</h4>
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
    <form action="" method="POST" class="forms-sample">
        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Forms Control</h4>
                        <div class="form-group">
                            <label for="nama-demo">Nama</label>
                            <label for="nama">Nama</label>
                            <input id="nama" name="nama" type="text" class="form-control" value="<?= set_value('nama') ?>" placeholder="Name">
                            <?= form_error('nama') ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" name="username" type="text" class="form-control" value="<?= set_value('username') ?>" />
                            <?= form_error('username') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" class="form-control" />
                            <?= form_error('password') ?>
                        </div>

                        <div class="form-group">
                            <label for="password2">Re-Type Password</label>
                            <input id="password2" name="password2" type="password" class="form-control" />
                            <?= form_error('password2') ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input id="alamat" name="alamat" type="text" class="form-control" value="<?= set_value('alamat') ?>" />
                        </div>
                        <div class="form-group">
                            <label for="level">Akses</label>
                            <select name="level" class="form-control">
                                <option value="0">--Select--</option>
                                <option value="1" <?= set_value('level') == 1 ? "selected" : null ?>>Admin</option>
                                <option value="2" <?= set_value('level') == 2 ? "selected" : null ?>>Kasir</option>
                                <option value="3" <?= set_value('level') == 3 ? "selected" : null ?>>Leader</option>
                            </select>
                            <?= form_error('level') ?>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white">Submit</button>
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