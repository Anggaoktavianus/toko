<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data items</h4>
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
    <?php $this->view('message'); ?>
    <?php if ($this->session->has_userdata('danger')) {
    ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success! &nbsp; <?= $this->session->flashdata('danger'); ?></strong>
        </div>
    <?php } ?>
    <!-- ============================================================== -->
    <!-- <div class="card">
        <div class="card-body">
            <?php
            foreach ($jumlah as $key => $data) {
            ?>

                <p>Total Stock : <?= $data->jumlah ?></p>


            <?php
            } ?>
            <?php
            foreach ($total as $key => $data) {
            ?>

                <p>Jumlah Barang : <?= indo_currency($data->jumlah) ?></p>


            <?php
            } ?>
            <?php
            foreach ($aset as $key => $aset) {
            ?>

                <p>Jumlah Aset : <?= indo_currency($aset->jumlah) ?></p>


            <?php
            } ?>

            <?php
            foreach ($total as $tot => $total) {
            ?>

                <p>Jumlah Total : <?= indo_currency($aset->jumlah + $total->jumlah) ?></p>


            <?php
            } ?>

            <?php
            foreach ($modal as $key => $data) {
            ?>

                <p>Jumlah Modal : <?= indo_currency($data->jumlah) ?></p>


            <?php
            } ?>
            <?php
            foreach ($profit as $key => $data) {
            ?>

                <p>Jumlah Sisa Modal : <?= indo_currency($total->jumlah - $data->jumlah + $aset->jumlah) ?></p>


            <?php
            } ?>
            <a href="<?= site_url('items/rekap_print/') ?>" class="btn btn-secondary btn-sm "><i class="fas fa-print">&nbsp; Rekap</i></a>

        </div>
    </div> -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Basic Datatable</h5> -->
                    <a href="<?= site_url('items/add/') ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle">&nbsp; Tambah data</i></a>

                    <br><br>
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="example" width="100%">


                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Beli</th>
                                    <th scope="col">Jual</th>
                                    <th scope="col">Isi(q)</th>
                                    <th scope="col">Stock Sisa</th>
                                    <!-- <th scope="col">Total Stock</th> -->
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Aksi</th> 
                                </tr>

                            </thead>

                            <tbody>
                                <!-- <?php $no = 1;
                                        foreach ($row->result() as $key => $data) {
                                        ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <a href="<?= site_url('items/barcode_qrcode/' . $data->id_item) ?>"><?= $data->barcode ?><br></a>
                                        </td>
                                        <td><?= $data->name ?></td>
                                        <td><?= $data->namau ?></td>
                                        <td><?= $data->price ?></td>
                                        <td><?= $data->stock ?><?= $data->namak ?></td>
                                        <td>
                                            <?php if ($data->image != null) { ?>
                                                <img src="<?= base_url('upload/item/' . $data->image) ?>" style="width:50px"> <?php } ?>
                                        </td>
                                        <td>

                                            <a href="<?= site_url('items/edit/' . $data->id_item) ?>" class="btn btn-success text-white">
                                                <i class="fas fa-pencil-alt "></i>
                                            </a>
                                            <a href="<?= site_url('items/del/' . $data->id_item) ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger text-white">
                                                <i class="fas fa-trash-alt "></i>
                                            </a>


                                        </td>
                                    </tr>
                                <?php
                                        } ?> -->
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga Beli</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Image</th>
                            <th scope="col">Aksi</th>
                            </tr>
                            </tfoot> -->
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







<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url": "<?= site_url('items/get_ajax') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [5, 6],
                "className": 'text-right'
            }, {
                "targets": [1, 3],
                "className": 'text-center',
            }]
        })
    })
</script>