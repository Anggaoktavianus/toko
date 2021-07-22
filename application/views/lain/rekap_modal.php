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

                <td> <?= $data->jumlah ?></td>


            <?php
            } ?>
            <?php
            foreach ($total as $key => $data) {
            ?>

                <td><?= indo_currency($data->jumlah) ?></td>


            <?php
            } ?>
            <?php
            foreach ($aset as $key => $aset) {
            ?>

                <td><?= indo_currency($aset->jumlah) ?></td>


            <?php
            } ?>

            <?php
            foreach ($total as $tot => $total) {
            ?>

                <td><?= indo_currency($aset->jumlah + $total->jumlah) ?></td>


            <?php
            } ?>

            <?php
            foreach ($modal as $key => $modal) {
            ?>

                <td><?= indo_currency($modal->jumlah) ?></td>


            <?php
            } ?>
            <?php
            foreach ($profit as $key => $profit) {
            ?>

                <td><?= indo_currency($total->jumlah - $profit->jumlah + $aset->jumlah) ?></td>


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
                    <a href="<?= site_url('rekap_modal/add/') ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle">&nbsp; Buat Stock Opname</i></a>

                    <br><br>
                    <div class="table-responsive">

                        <table id="zero_config" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Total Stock</th>
                                    <th scope="col">Nilai Barang</th>
                                    <th scope="col">Nilai Aset</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Modal</th>
                                    <th scope="col">Beban</th>
                                    <th scope="col">Income</th>
                                    <th scope="col">Tgl Cetak</th>
                                    <th scope="col">Aksi</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>

                                        <td><?= number_format($data->t_stock)  ?></td>
                                        <td><?= indo_currency($data->nilai_barang)  ?></td>
                                        <td><?= indo_currency($data->nilai_aset) ?></td>
                                        <td><?= indo_currency($data->sub_total) ?></td>
                                        <td><?= indo_currency($data->modal) ?></td>
                                        <td><?= indo_currency($data->income) ?></td>
                                        <td><?= $data->created_at ?></td>
                                        <td>

                                            <a href="<?= site_url('rekap_modal/rekap_print/' . $data->id) ?>" class="btn btn-success text-white btn-sm">
                                                <i class="fas fa-print "></i>
                                            </a>
                                            <a href="<?= site_url('rekap_modal/del/' . $data->id) ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger text-white btn-sm">
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
                                    <th scope="col">Total Stock</th>
                                    <th scope="col">Nilai Barang</th>
                                    <th scope="col">Nilai Aset</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Modal</th>
                                    <th scope="col">Beban</th>
                                    <th scope="col">Income</th>
                                    <th scope="col">Tgl Cetak</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </tfoot>
                            <p style="color:red; font-size:70%;"> *Sub total didapat dari Nilai Barang + Nilai Aset <br>
                                *Income didapat dari Sub total - Modal </p>
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