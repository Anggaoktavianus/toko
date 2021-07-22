<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data barang</h4>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Basic Datatable</h5> -->
                    <a href="<?= site_url('barang/add/') ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle ">Tambah data</i></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="30px">No</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Image</th>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('barang/get_ajax') ?>",
                "type": "POST"
            }
            // "columnDefs": [{
            //     "targets": [5, 6],
            //     "className": 'text-right'
            // }, {
            //     "targets": [1, 3],
            //     "className": 'text-center',
            // }]
        })
    })
</script>