<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data jasa</h4>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Basic Datatable</h5> -->
                    <a href="<?= site_url('jasa/add/') ?>" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle ">Tambah data</i></a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                   <th scope="col">No</th>
                                   <th scope="col">ID</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) {
                                ?>
                                    <tr>
                                        <td style="white-space:nowrap"><?= $no++ ?></td>
                                        <td style="white-space:nowrap"><?= $data->barcode ?></td>
                                        <td style="white-space:nowrap"><?= number_format($data->jumlah)  ?></td>
                                        <td style="white-space:nowrap"> <?=$data->deskripsi ?></td>
                                        <td>

                                            <a href="<?= site_url('jasa/edit/' . $data->id) ?>" class="btn btn-success text-white">
                                                <i class="fas fa-pencil-alt "></i>
                                            </a>
                                            <a href="<?= site_url('jasa/del/' . $data->id) ?>" onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger text-white">
                                                <i class="fas fa-trash-alt "></i>
                                            </a>


                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    
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