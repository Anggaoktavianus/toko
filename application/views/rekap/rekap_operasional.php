
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Data Operasional</h4>
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

<div class="container">
	<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Operasional Toko</h4>
                        <div class="form-group">
				<form method="get" action="<?= base_url('rekap/toko_add')?>">
					<div class="row">                                
						<div class="col-md-4">
							<label for="tgl1">Tanggal</label>
							<input type="date"  name="tanggal" class="form-control" autocomplete="off" />
						</div>
						<div class="col-md-4">
							<label for="tgl2">Sampai</label>
							<input type="date"  name="tanggal1" class="form-control" autocomplete="off" />
							<!-- <input type="date" name="date" id="stock" value="" class="form-control"> -->
						</div>
						<div class="col-md-3">
							<label for="tgl2">Hitung</label><br>
							<button type="submit" name="" class="btn btn-default text-white">
							Calculate
							</button>
						</div>
					</div><br>
				</form>
				<form action="<?= site_url('rekap/toko_add_act') ?>" method="POST"  enctype="multipart/form-data">
					<div class="row">      
						 <?php foreach ($jml as $key => $data ){?>
						<div class="col-md-4">
							<label for="jumlah">Jumlah</label>
							<input type="hidden"  name="d_tgl_awal" value="<?php echo $mulai?>" class="form-control"  />
							<input type="hidden"  name="d_tgl_sampai" value="<?php echo $sampai?>" class="form-control" />
							<input type="text" name="d_jumlah" id="jumlah" value="<?=$data->jumlah?>" class="form-control" readonly>
						</div>
						<div class="col-md-4">
							<label for="deskripsi">Keterangan</label>
							<input type="text" name="d_deskripsi" id="deskripsi" value="" class="form-control" >
						</div>
                                           
                                        <?php }?>                         
						
					</div> <br>
					<button type="submit" name="save" class="btn btn-success text-white">
						Simpan
					</button>
					<a href="toko?tanggal=&tanggal1=" class="btn btn-default text-white">
						Lihat data
					</a>
					<button type="reset" class="btn btn-danger text-white">
						Reset
					</button>
				</form>
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
    <script src="<?php echo base_url('assets/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script> <!-- Load file bootstrap-datepicker.min.js -->
	<script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        setDatePicker() // Panggil fungsi setDatePicker

        $('#form-tanggal, #form-bulan, #form-tahun, #form-pegawai').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun, #form-pegawai').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal,#form-pegawai').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else if($(this).val() == '3'){ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan, #form-pegawai').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }else { // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-pegawai').show(); // Tampilkan form tahun
            }
            $('#form-tanggal input, #form-bulan select, #form-tahun select, #form-pegawai select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })

	function setDatePicker(){
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
         $('#reservationdatetime2').datetimepicker({ icons: { time: 'far fa-clock' } });
		// $(".datepicker").datepicker({
		// 	format: "yyyy-mm-dd",
		// 	todayHighlight: true,
		// 	autoclose: true
		// }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
	}
    </script>

    
</div>




