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
     <form action="<?= site_url('items/proses') ?>" method="POST" class="tm-signup-form row" enctype="multipart/form-data">

        <!--==============================================================-->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <?php $this->view('message'); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Forms Control</h4>
                        <input id="id_item" name="id_item" type="hidden" class="form-control validate" value="<?= $row->id_item ?>" />
                         <div class="form-group">
                         
                            <label for="barcode">Barcode</label>
                            <!-- <input id="barcode" required name="barcode" type="hidden" class="form-control validate" value="<?= $row->barcode ?>" style="text-transform:uppercase" /> -->
                            
                            <input type="text" class="form-control" id="barcode" name="barcode" value="<?= $page == 'edit' ? $row->barcode :"TM". sprintf("%04s", $barcode) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" required name="name" type="text" class="form-control validate" value="<?= $row->name ?>" />

                        </div>
                        <div class="form-group">
                            <label for="harpok">Harga Beli</label>
                            <input id="harpok" name="harpok" type="number" class="form-control validate" value="<?= $row->barang_harpok ?>" />
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Jual</label>
                            <input id="price" name="price" type="number" class="form-control validate" value="<?= $row->price ?>" />
                        </div>
                        <div class="form-group">
                            <label for="price">Category Unit</label>
                            <select name="category" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php foreach ($category->result() as $key => $data) { ?>
                                    <option value="<?= $data->category_id ?>" <?= $data->category_id == $row->category_id ? "selected" : null ?>><?= $data->name ?></option>
                                <?php } ?>
                                <!--  -->
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="menu">Category Menu</label>
                            <select name="menu" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php foreach ($menu->result() as $key => $data) { ?>
                                    <option value="<?= $data->id ?>" <?= $data->id == $row->menu_id ? "selected" : null ?>><?= $data->nama ?></option>
                                <?php } ?>
                                <!--  -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi (q)</label>
                            <input id="isi" name="isi" type="number" class="form-control validate" value="<?= $page == 'edit' ? $row->isi :'1'?>" />
                        
                        </div>
                        <div class="form-group">
                        <!-- <label for="harga_satuan">Harga Per Box/Pcs</label> -->
                            <input id="harga_satuan" name="harga_satuan" type="hidden" class="form-control validate" value="<?= $row->harga_satuan ?>" />
                            <input id="stock_kecil" name="stock_kecil" type="hidden" class="form-control validate" value="<?= $row->stock_kecil ?>" />
                            <input id="stock" name="stock" type="hidden" class="form-control validate" value="<?= $row->stock ?>" />
                         
                        </div>
                        <div class="form-group">
                            <label for="price">Unit</label>
                            <select name="unit" class="form-control">
                                <option value="">--Pilih--</option>
                                <?php foreach ($unit->result() as $key => $data) { ?>
                                    <option value="<?= $data->unit_id ?>" <?= $data->unit_id == $row->unit_id ? "selected" : null ?>><?= $data->name ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <?php if ($page == 'edit') {
                                if ($row->image != null) { ?>
                                    <div style="margin-bottom: 5px;">
                                        <img src="<?= base_url('upload/' . $row->image) ?>" style="width:20%">
                                    </div>
                            <?php
                                }
                            } ?>

                            <input id="image" name="image" type="file" class="form-control validate" value="" />
                            <small>Biarkan kosong jika tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?> </small>
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