<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Pengguna</h4>
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
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <div class="form-group  <?= form_error('username') ? 'has-error' : null ?>">

                            <label for="username">Username</label>
                            <input id="username" name="username" type="text" value="<?= $this->input->post('username') ?:  $row->username ?>" class="form-control validate" />
                            <?= form_error('username') ?>
                        </div>
                        <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                            <label for="nama">Nama</label>
                            <input id="nama" name="nama" type="name" class="form-control validate" value="<?= $this->input->post('nama') ?:  $row->nama ?>" />
                            <?= form_error('nama') ?>
                        </div>

                        <div class="form-group ">
                            <label for="password">Password <small>*Biarkan kosong, jika tidak diganti</small></label>
                            <input id="password" name="password" type="password" value="<?= $this->input->post('password') ?>" class="form-control validate" />
                            <?= form_error('password') ?>
                        </div>
                        <div class="form-group ">
                            <label for="password2">Re-Type Password</label>
                            <input id="password2" name="password2" type="password" value="<?= $this->input->post('password2 ') ?>" class="form-control validate" />
                            <?= form_error('password2') ?>
                        </div>
                        <div class="form-group ">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control validate"><?= $this->input->post('alamat') ?:  $row->alamat ?></textarea><?= form_error('alamat') ?>
                            <!-- <input id="alamat" name="alamat" type="text" class="form-control validate" value="<?= $this->input->post('alamat') ?:  $row->alamat ?>" /> -->
                        </div>

                        <div class="form-group">
                            <label for="level">Akses</label>
                            <select name="level" class="form-control">
                                <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?>
                                <option value="1">Admin</option>
                                <option value="2" <?= $level == 2 ? "selected" : null ?>>Kasir</option>
                            </select>
                            <?= form_error('level') ?>
                        </div>
                        <div class="form-group">
                            <label class="tm-hide-sm">&nbsp;</label>
                            <button type="submit" class="btn btn-primary text-white">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger text-white">
                                Reset
                            </button>
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