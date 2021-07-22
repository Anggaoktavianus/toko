<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Items Barcode</h4>
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
    <form action="<?= site_url('items/proses') ?>" method="POST" class="tm-signup-form row" enctype="multipart/form-data">

        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <?php $this->view('message'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Barcode</h4>

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?php
                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_EAN_13)) . '" style="width :200px">';
                            ?>
                            <br>
                            <?= $row->barcode ?>
                            <br><br>
                            <a href="<?= site_url('items/barcode_print/' . $row->id_item) ?>" target="_blank" class="btn btn-primary text-white">
                                <i class="fas fa-print "></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">QRCode</h4>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <?php

                            $qrCode = new Endroid\QrCode\QrCode($row->barcode);
                            $qrCode->writeFile('upload/QR/items-' . $row->barcode . '.png');

                            ?>
                            <img src="<?= base_url('upload/QR/items-' . $row->barcode . '.png') ?>" style="width :200px">
                            <br>
                            <?= $row->barcode ?>
                            <br><br>
                            <a href="<?= site_url('items/qr_print/' . $row->id_item) ?>" target="_blank" class="btn btn-primary text-white">
                                <i class="fas fa-print "></i>
                            </a>
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