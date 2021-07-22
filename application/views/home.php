
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
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
     <h5>Selamat datang <?= $this->session->userdata('username')?></h5>
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <?php if ($this->fungsi->user_login()->level == 1) { ?>
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <a href="<?= site_url('home') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <h6 class="text-white">Dashboard</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <a href="<?= site_url('suplier') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-truck-delivery"></i></h1>
                        <h6 class="text-white">Supplier</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <a href="<?= site_url('customer') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                        <h6 class="text-white">Customer</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <a href="<?= site_url('category') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                        <h6 class="text-white">Category</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <a href="<?= site_url('unit') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-archive"></i></h1>
                        <h6 class="text-white">Unit</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <a href="<?= site_url('sales') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-cart"></i></h1>
                        <h6 class="text-white">Penjualan</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <a href="<?= site_url('items') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                        <h6 class="text-white">Produk</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <a href="<?= site_url('stock/in') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-arrow-down-box"></i></h1>
                        <h6 class="text-white">Stock In</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <a href="<?= site_url('stock/out') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-arrow-up-box"></i></h1>
                        <h6 class="text-white">Stock Out</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <a href="<?= site_url('rekap_modal/excel') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-file-chart"></i></h1>
                        <h6 class="text-white">Laporan</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <form method="get" action="">
                        <div class="row">
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label>Filter Berdasarkan</label>
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">Per Tanggal</option>
                                        <option value="2">Per Bulan</option>
                                        <option value="3">Per Tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="form-tanggal">
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" name="tanggal" class="form-control datepicker" autocomplete="off" />
                                    
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label>Sampai</label>
                                    <input type="text" name="tanggal1" class="form-control datepicker" autocomplete="off" />
                                    <!-- <input type="date" name="date1" id="date1" class="form-control mr-2">
                                    <input type="date" name="date2" id="date2" class="form-control mr-2"> -->
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

                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <a href="<?= site_url('rekap_modal/excel/') ?>" class="btn btn-default">Reset Filter</a>
                    </form>
                    <hr />
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Analisis Income</h4>
                            <h5 class="card-subtitle"> <b><?php echo $label; ?></b></h5>
                        </div>
                    </div>
                    <!-- <b><?php echo $label; ?></b><br /><br /> -->
                    <a href="<?php echo $url_export; ?>" class="btn btn-secondary btn-sm"><span class="fa fa-file-excel"></span>&nbsp; EXCEL</a><br><br>
                        <!-- <a href="<?php echo $url_export; ?>" class="btn btn-secondary btn-sm"><span class="fa fa-file-pdf"></span> &nbsp; PDF</a><br> <br> -->
                         
                    
                    <div class="row">
                      <div class="col-lg-12">
                            <div class="float-chart">
                                <div class="flot-chart-content" id="graph">  </div>
                                <script src="<?php echo base_url().'assets/js/raphael-min.js'?>"></script>
                                    <script src="<?php echo base_url().'assets/js/morris.min.js'?>"></script>
                                 
                                   
                              
                            </div>
                        </div>
                        <!-- <div id="graph"></div>            -->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->fungsi->user_login()->level == 2) { ?>
<div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <a href="<?= site_url('home') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <h6 class="text-white">Dashboard</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <a href="<?= site_url('suplier') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-truck-delivery"></i></h1>
                        <h6 class="text-white">Supplier</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        
        <!-- Column -->
        
        <!-- Column -->
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <a href="<?= site_url('sales') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-cart"></i></h1>
                        <h6 class="text-white">Penjualan</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <a href="<?= site_url('items') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                        <h6 class="text-white">Produk</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <a href="<?= site_url('stock/in') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-arrow-down-box"></i></h1>
                        <h6 class="text-white">Stock In</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <a href="<?= site_url('stock/out') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-arrow-up-box"></i></h1>
                        <h6 class="text-white">Stock Out</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <a href="<?= site_url('rekap_modal/pegawai') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-file-chart"></i></h1>
                        <h6 class="text-white">Laporan</h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <a href="<?= site_url('toko') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-file-chart"></i></h1>
                        <h6 class="text-white">Toko</h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <a href="<?= site_url('jasa') ?>">
                        <h1 class="font-light text-white"><i class="mdi mdi-file-chart"></i></h1>
                        <h6 class="text-white">Jasa</h6>
                    </a>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Grafik Penjualan Produk</h4>
                            <h5 class="card-subtitle"> <b><?php echo $label; ?></b></h5>
                        </div>
                    </div>
                   <br><br>
                    <div class="row">
                      <div class="col-lg-12">
                            <div class="float-chart">

                               <div id="container"></div> 
                              
                            </div>
                        </div>
                        <!-- <div id="graph"></div>            -->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- BEGIN MODAL -->
</div>
<!--  -->
 <script>
     $(document).ready(function() {
        barChart();

        $(window).resize(function() {
        window.barChart.redraw();
                                            
         });
         });
    function barChart() {
        window.barChart = Morris.Bar({
            element: 'graph',
            data: <?php echo $grafik;?>,
            xkey: 'd_jual_barang_nama',
            ykeys: ['totalz'],
            labels: ['Total'],
            lineColors: ['#1e88e5','#ff3321'],
            ineWidth: '3px',
            resize: true,
            redraw: true
            });
            }
                                                                                
</script>

<script src="<?php echo base_url('assets/libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script> <!-- Load file bootstrap-datepicker.min.js -->
	<script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        setDatePicker() // Panggil fungsi setDatePicker

        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }
            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })

	function setDatePicker(){
		$(".datepicker").datepicker({
			format: "yyyy-mm-dd",
			todayHighlight: true,
			autoclose: true
		}).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});
	}
    </script>


    <?php
    /* Mengambil query report*/
    foreach($penjualan as $kmdt){
		    $namaproduk[]   = $kmdt->namaproduk;
        $qty[]      = (float) $kmdt->qty;
        $satuan[]      = (float) $kmdt->satuan;
    }
	/* end mengambil query*/
?>


<style>
	.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 300px;
}
#container2 {
    height: 300px;
}

#container3 {
    height: 300px;
}
#container4 {
    height: 300px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #5555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script> 
Highcharts.chart('container', {
	colors: ['#E8C731', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
		'#55BF3B', '#DF5353', '#7798BF', '#aaeeee'
	],
    chart: {
		backgroundColor: '#FFFFFF',
		type: 'column',
    },
    exporting: { enabled: false },
    title: {
		style: {
				color: '#070606',
				fontWeight: 'bold',
				fontSize: '12px',
				fontFamily: 'Trebuchet MS, Verdana, sans-serif'

			},
        text: ''
    },
    subtitle: {
		style: {
				color: '#070606',
				fontWeight: 'normal',
				fontSize: '12px',
				fontFamily: 'Trebuchet MS, Verdana, sans-serif'

			},
        text: ''
    },
    xAxis: {
		labels: {
            style: {
                color: '#070606'
            }
        },
        categories: <?=json_encode($namaproduk);?>,
        crosshair: true
    },
    yAxis: {
		labels: {
            style: {
                color: '#070606'
            }
        },
        min: 0,
        title: {
			  style: {
				color: '#070606',
				// fontWeight: 'bold',
				fontSize: '12px',
				fontFamily: 'Trebuchet MS, Verdana, sans-serif'

			},
            text: 'Jumlah (Box/pcs)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
        }
    },
    series: [
          
            { name: '<span style="color:#070606">Box</span>', data: <?=json_encode($qty)?> },
            { name: '<span style="color:#070606">Pcs</span>', data: <?=json_encode($satuan)?> }
        ],
});
</script>


            


          