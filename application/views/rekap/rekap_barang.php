
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

<div class="container">
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
                   <!-- <form method="POST" action="" class="form-inline mt-3">
                    <label for="date1">Tanggal &nbsp;</label>
                    <input type="date" name="date1" id="date1" class="form-control mr-2">
                    <label for="date2">sampai &nbsp;</label>
                    <input type="date" name="date2" id="date2" class="form-control mr-2">
                    <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                    </form> -->
                    <form method="get" action="<?= base_url('rekap/barang')?>">
                        <div class="row">
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label>Filter Berdasarkan</label>
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="0">Pilih</option>
                                        <option value="1">Per Tanggal</option>
                                        <!-- <option value="2">Per Bulan</option>
                                        <option value="3">Per Tahun</option> -->
                                        <option value="4">Per Pegawai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="form-tanggal">
                            <div class="col-sm-3 col-md-2">
                                
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="datetime-local"  name="tanggal" class="form-control " autocomplete="off" />
                                    <!-- <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" name="tanggal" class="form-control datetimepicker-input" data-target="#reservationdatetime" autocomplete="off"/>
                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div> -->
                                    
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label>Sampai</label>
                                    <input type="datetime-local" name="tanggal1" class="form-control " autocomplete="off" />
                                    <!-- <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                        <input type="text" name="tanggal1" class="form-control datetimepicker-input" data-target="#reservationdatetime2" autocomplete="off"/>
                                        <div class="input-group-append" data-target="#reservationdatetime2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label>Pegawai</label>
                                   <select name="pegawai1" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                        foreach($option_pegawai as $data){ // Ambil data tahun dari model yang dikirim dari controller
                                            echo '<option value="'.$data->id.'">'.$data->namaus.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3 col-md-2" id="form-bulan">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select name="bulan" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2" id="form-tahun">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select name="tahun" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                        foreach($option_tahun as $data){ // Ambil data tahun dari model yang dikirim dari controller
                                            echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-md-2" id="form-pegawai">
                                <div class="form-group">
                                    <label>Pegawai</label>
                                    <select name="pegawai" class="form-control " >
                                        <option value="">Pilih</option>
                                        <?php
                                        foreach($option_pegawai as $data){ // Ambil data tahun dari model yang dikirim dari controller
                                            echo '<option value="'.$data->id.'">'.$data->namaus.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <a href="<?= site_url('rekap/barang/') ?>" class="btn btn-default">Reset Filter</a>
                    </form>
                    <hr />
                    <b><?php echo $label; ?></b><br /><br />
                    <a href="<?php echo $url_export; ?>" class="btn btn-secondary btn-sm"><span class="fa fa-file-excel"></span>&nbsp; EXCEL</a><br><br>
                        <!-- <a href="<?php echo $url_export; ?>" class="btn btn-secondary btn-sm"><span class="fa fa-file-pdf"></span> &nbsp; PDF</a><br> <br> -->
                    
                        
                    <div class="table-responsive">

                        <table id="zero_config" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Faktur</th>
                                        <!-- <th>Satuan</th> -->
                                        <th>Box+Pcs</th>
                                        <th>Tanggal</th>
                                        <th>Pegawai</th>
                                        <th>Subtotal</th>
                                        <th>Diskon</th>
                                        <th>Jasa</th>
                                        <th>Total</th>
                                        <!-- <th>Action</th> -->
                                        <!-- <th>Dibayar</th>
                                        <th>Kembalian</th> -->
                                </tr>
		    

                            </thead>

                            <tbody>
                               <?php
                                if( ! empty($transaksi)){
                                    $no = 1;
                                    foreach($transaksi as $data){
                                        $created_at = date('d-m-Y', strtotime($data->created_at));

                                        echo "<tr>";
                                         echo "<td>".$no++."</td>";
                                        echo "<td>".$data->d_jual_barang_nama."</td>";
                                        echo "<td>".$data->jual_nofak."</td>";
                                        echo "<td>".$data->d_jual_qty.'+'.$data->d_jual_qty_satuan.'&nbsp;'.$data->d_jual_barang_satuan."</td>";
                                        // echo "<td>".."</td>";
                                        echo "<td>".$created_at."</td>";
                                        echo "<td>".$data->namas."</td>";
                                        echo "<td>".number_format($data->subtotal) ."</td>";
                                        echo "<td>".number_format($data->diskon) ."</td>";
                                        echo "<td>".number_format($data->jasa) ."</td>";
                                        echo "<td>".number_format($data->total) ."</td>"; 
                                        // echo "<td>".number_format($data->jual_jml_uang) ."</td>";
                                        // echo "<td>".number_format($data->jual_kembalian) ."</td>";
                                        // echo "<td>".number_format($data->terjual) ."</td>";
                                        echo "</tr>";
                                                      
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        
                                        <th><b>TOTAL</th>
                                         <?php
                                        foreach($total as $data){ // Ambil data tahun dari model yang dikirim dari controller
                                            echo "<th>"."<b>".number_format($data->jual_subtotal) ."</th>";
                                             echo "<th>"."<b>"."</th>";
                                            echo "<th>"."<b>".number_format($data->jasa) ."</th>";
                                            echo "<th>"."<b>".number_format($data->total) ."</th>";
                                        }
                                        ?>
                                        
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




