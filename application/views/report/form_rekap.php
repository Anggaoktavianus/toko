<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Buat Rekap</h4>
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
    <form action="<?= site_url('rekap_modal/proses') ?>" method="POST" class="tm-signup-form row">

        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Forms Control</h4>
                        <input id="id" name="id" type="hidden" class="form-control validate" value="<?= $row->id ?>" />
                        <div class="form-group col-lg-6">
                            <label for="stock">Total Stock</label>
                            <?php
                            foreach ($stock as $key => $data) {
                            ?>
                                <input id="stock" required name="t_stock" type="number" class="form-control validate" value="<?= $data->jumlah ?>" readonly />
                            <?php
                            } ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="nilai">Nilai Barang</label>
                            <?php
                            foreach ($barang as $key => $barang) {
                            ?>
                                <input id="nilai" required name="nilai_barang" type="text" class="form-control validate" value="<?= $barang->jumlah ?>" readonly />
                            <?php
                            } ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="aset">Nilai Aset</label>
                            <?php
                            foreach ($aset as $key => $aset) {
                            ?>
                                <input id="aset" required name="nilai_aset" type="text" class="form-control validate" value="<?= $aset->jumlah ?>" readonly />
                            <?php
                            } ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="sub">Sub Total</label>


                            <input id="sub" required name="sub_total" type="text" class="form-control validate" value="<?= $aset->jumlah + $barang->jumlah ?>" readonly />

                        </div>
                        <div class="form-group col-lg-6">
                            <label for="modal">Modal</label>
                            <?php
                            foreach ($nilaimodal as $key => $modal) {
                            ?>
                                <input id="modal" required name="modal" type="text" class="form-control validate" value="<?= $modal->jumlah ?>" readonly />
                            <?php
                            } ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="income">Income</label>
                            <?php
                            foreach ($profit as $key => $profit) {
                            ?>
                                <input id="income" required name="income" type="text" class="form-control validate" value="<?= $aset->jumlah + $barang->jumlah - $modal->jumlah ?>" readonly />
                            <?php
                            } ?>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="ket">Keterangan</label>
                            <div>
                                <textarea name="keterangan" id="ket" class="form-control validate"></textarea>
                            </div>


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
    </form>
</div>