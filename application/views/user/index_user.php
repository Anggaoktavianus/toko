<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data Pengguna</h4>
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
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Basic Datatable</h5> -->
                    <a href="<?= site_url('user/add/') ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle ">Tambah data</i></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">N0</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->username ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td><?= $data->alamat ?></td>
                                        <td><?= $data->level == 1 ? "Admin" : "Kasir" ?></td>
                                        <td>
                                            <form action="<?= site_url('user/del') ?>" method="post">
                                                <a href="<?= site_url('user/edit/' . $data->id) ?>" class="btn btn-success btn-sm text-white">
                                                    <i class="fas fa-pencil-alt "></i>
                                                </a>

                                                <input type="hidden" name="id" value="<?= $data->id ?>">
                                                <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm text-white">
                                                    <i class="fas fa-trash-alt "></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">N0</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>