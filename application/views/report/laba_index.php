<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Laba</h4>
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
<center><?php echo $this->session->flashdata('msg'); ?></center>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!--==============================================================-->
    <!-- Start Page Content -->
    <!--==============================================================-->
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock In</h4>
                        <div class="form-group">
                            <div class="row">
			                    <?php foreach ($row as $i => $data) { ?>                              
                                <div class="col-md-6">
                                    <label for="tgl1">Tanggal</label>
                                    <input type="date" name="date" id="unit" value="<?=$data->date?>" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl2">Sampai</label>
                                    <input type="date" name="date" id="stock" value="<?=$data->date?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="stock_kecil">Subtotal</label>
                                    <input type="text" name="d_jual_total" id="stock_kecil" value="<?=$data->total?>" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" value="" class="form-control" readonly>
                                </div>
				                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail *</label>
                            <input type="text" name="detail" id="detail" value="" class="form-control">
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="" class="btn btn-success text-white">
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
	<div class="row">
		<div class="col-12">
		<div class="card">
			<div class="card-body"><br>
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

       