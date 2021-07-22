<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title"><?= ucfirst($page) ?> items</h4>
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
    <form action="<?= site_url('barang/proses') ?>" method="POST" class="tm-signup-form row" enctype="multipart/form-data">

        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <?php $this->view('message'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Forms Control</h4>
                        <!-- <input id="id_barcode" name="id_barcode" type="number" class="form-control validate" value="<?= $row->id_item ?>" /> -->
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input id="barcode" required name="id_barcode" type="number" class="form-control validate" value="<?= $row->id_barcode ?>" style="text-transform:uppercase" />
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" required name="nama_barang" type="text" class="form-control validate" value="<?= $row->nama_barang ?>" />

                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <?php if ($page == 'edit') {
                                if ($row->image != null) { ?>
                                    <div style="margin-bottom: 5px;">
                                        <img src="<?= base_url('upload/item/' . $row->image) ?>" style="width:50%">
                                    </div>
                            <?php
                                }
                            } ?>

                            <input id="image" name="image" type="file" class="form-control validate" value="" />
                            <small>Biarkan kosong jika tidak ada <?= $page == 'edit' ? 'diganti' : 'ada' ?> </small>
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