<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data Stock In</h4>
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
                    <a href="<?= site_url('stock/in/add/') ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle">Tambah data</i></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Product Item</th>
                                    <th scope="col">Suplier</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->barcode ?></td>
                                        <td><?= $data->namai ?></td>
                                        <td><?= $data->namas ?></td>
                                        <td><?= indo_date($data->date) ?></td>

                                        <td><?= $data->qty ?></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm text-white">
                                                <i class="fas fa-eye "></i>
                                            </a>
                                            <a href="<?= site_url('stock/in/del/' . $data->stock_id . '/' . $data->id_item) ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger btn-sm text-white">
                                                <i class="fas fa-trash-alt "></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Product Item</th>
                                    <th scope="col">Suplier</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

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