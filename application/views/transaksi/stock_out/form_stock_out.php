<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Stock Out</h4>
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
    <form action="<?= site_url('stock/proses') ?>" method="POST" class="tm-signup-form row">

        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <?php $this->view('message'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock In</h4>
                        <div class="form-group">
                            <label for="date">Tanggal</label>
                            <input id="date" required name="date" type="date" class="form-control validate" value="<?= date('Y-m-d') ?>" />

                        </div>
                        <div>
                            <label for="barcode">Barcode*</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="id_item" id="id_item">
                            <input type="text" name="barcode" id="barcode" class="form-control" required autofocus>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info text-white" data-toggle="modal" data-target="#modal-item">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button type="button" class="btn btn-secondary text-white" data-toggle="" data-target="">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                            </span>
                        </div>
                        <div>
                            <label for="name">Item Name*</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="text" name="name" id="name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="unit">Item unit</label>
                                    <input type="text" name="unit" id="unit" value="" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="stock">Initial Stock</label>
                                    <input type="text" name="stock" id="stock" value="" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail *</label>
                            <input type="text" name="detail" id="detail" value="" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="suplier_id">Supplier</label>
                            <select name="suplier_id" id="suplier_id" class="form-control">
                                <option value="">--Pilih--</option>
                                <!-- <?php foreach ($suplier as $i => $data) {
                                            echo '<option value"' . $data->id_suplier . '">' . $data->name . '</option>';
                                        } ?> -->
                                <?php foreach ($suplier as $i => $data) { ?>
                                    <option value="<?= $data->id_suplier ?>"><?= $data->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty *</label>
                            <input type="number" name="qty" id="qty" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="out_add" class="btn btn-success text-white">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger text-white">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">

            <!-- Ini adalah Bagian Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Header Modal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Ini adalah Bagian Body Modal -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Barcode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($item as $key => $data) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td> <?= $data->barcode ?></td>
                                    <td> <?= $data->name ?></td>
                                    <td><?= indo_currency($data->price) ?></td>
                                    <td><?= $data->stock ?> &nbsp;<?= $data->namau ?></td>
                                    <td>
                                        <button class="btn btn-primary text-white" id="select" data-id="<?= $data->id_item ?>" data-barcode="<?= $data->barcode ?>" data-name="<?= $data->name ?>" data-unit="<?= $data->namau ?>" data-stock="<?= $data->stock ?>">
                                            <i class="mdi mdi-check-circle">Select</i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ini adalah Bagian Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var id_item = $(this).data('id');
            var barcode = $(this).data('barcode');
            var name = $(this).data('name');
            var namau = $(this).data('unit');
            var stock = $(this).data('stock');
            $('#id_item').val(id_item);
            $('#barcode').val(barcode);
            $('#name').val(name);
            $('#unit').val(namau);
            $('#stock').val(stock);
            $("#modal-item").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $("#modal-item").hide();


        })
    })
</script>