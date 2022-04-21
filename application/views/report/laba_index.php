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
                    <h4 class="card-title">Laba Penjualan</h4>
                    <button type="submit" id="buat" class="btn btn-primary text-white btn-sm"><i class="fas fa-plus"></i> Buat Laporan</button>
                    <button type="submit" id="hide" class="btn btn-secondary text-white btn-sm"><i class="fas fa-eye"></i> Tutup</button><br><br>
                    <div class="form-group" id="rekap">
                        <form method="get" action="<?= base_url('laba/laba_add')?>">
                            <div class="row">                                
                                <div class="col-md-4">
                                    <label for="tgl1">Tanggal</label>
                                    <input type="date"  name="tanggal" class="form-control" autocomplete="off" />
                                    <?= form_error('dari_tanggal') ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="tgl2">Sampai</label>
                                    <input type="date"  name="tanggal1" class="form-control" autocomplete="off" />
                                </div>
                                <div class="col-md-3">
                                    <label for="tgl2">Hitung</label><br>
                                    <button type="submit" name="save" class="btn btn-default text-white">
                                    Calculate
                                    </button>
                                </div>
                            </div><br>
                        </form>
                        <form action="<?= site_url('laba/laba_add_act') ?>" method="POST"  enctype="multipart/form-data">
                        <div class="row">
                            <?php foreach ($transaksi as $i => $data) { ?>                              
                            <div class="col-md-3">
                                <input type="hidden"  name="dari_tanggal" value="<?php echo $mulai?>" class="form-control"  />
                                <?= form_error('dari_tanggal') ?>
                                <input type="hidden"  name="sampai_tanggal" value="<?php echo $sampai?>" class="form-control" />
                                <label for="stock_kecil">Total Penjualan</label>
                                <input type="text" name="totjul" id="stock_kecil" value="<?=$data->totjual?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="stock_kecil">Total Harga Pokok Barang</label>
                                <input type="text" name="harpok" id="stock_kecil" value="<?=$data->harpok?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="stock_kecil">Laba Kotor</label>
                                <input type="text" name="laba_kotor" id="stock_kecil" value="<?=$data->laba_kotor?>" class="form-control" readonly><br>
                            </div>
                            <?php } ?>
                            <?php foreach ($operasional as $i => $data) { ?>  
                            <div class="col-md-3">
                                <label for="price">Pengeluaran</label>
                                <input type="text" name="pengeluaran" id="price" value="<?=$data->beban?>" class="form-control" readonly>
                            </div>
                            <?php } ?>
                                <?php foreach ($exp as $i => $data) { ?> 
                            <div class="col-md-3">
                                <label for="price">Barang Expired</label>
                                <input type="text" name="expired" id="price" value="<?=$data->expired?>" class="form-control" readonly>
                            </div>
                            <?php } ?>
                            <input type="hidden" name="hasil" class="form-control" readonly>
                            <div class="form-group">
                                <label for="detail">Keterangan</label>
                                <input type="text" name="keterangan" id="detail" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="" class="btn btn-success text-white btn-sm">
                                        <i class="fas fa-file-alt"></i>  &nbsp; Simpan Laporan
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Terbaru</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Lihat Semua</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                            <h5>Data Laba Penjualan</h5>
                            <a href="<?php echo $url_export; ?>" class="btn btn-secondary btn-sm"><span class="fa fa-file-excel"></span>&nbsp; EXCEL</a><br><br>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Dari Tanggal</th>
                                            <th scope="col">Sampai Tanggal</th>
                                            <th scope="col">Total Penjualan</th>
                                            <th scope="col">Total Harga Pokok</th>
                                            <th scope="col">Laba Kotor</th>
                                            <th scope="col">Pengeluaran</th>
                                            <th scope="col">Barang Expired</th>
                                            <th scope="col">Laba Bersih</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if( ! empty($row)){
                                            $no = 1;
                                            foreach($row as $data){

                                                echo "<tr>";
                                                echo "<td>".$no++."</td>";
                                                echo "<td>".$data->dari_tanggal."</td>";
                                                echo "<td>".$data->sampai_tanggal."</td>";
                                                echo "<td>".number_format($data->totjul)."</td>";
                                                echo "<td>".number_format($data->harpok)."</td>";
                                                echo "<td>".number_format($data->laba_kotor)."</td>";
                                                echo "<td>".number_format($data->pengeluaran)."</td>";
                                                echo "<td>".number_format($data->expired)."</td>";
                                                echo "<td>".number_format($data->hasil)."</td>";
                                                echo "<td>".$data->keterangan."</td>";
                                                echo "<td>".'<a href="' . site_url('laba/del/' . $data->id) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger text-white btn-xs"><i class="fas fa-trash-alt"></i></a>'."</td>";
                                                echo "</tr>";
                                                                
                                            }
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Dari Tanggal</th>
                                            <th scope="col">Sampai Tanggal</th>
                                            <th scope="col">Total Penjualan</th>
                                            <th scope="col">Total Harga Pokok</th>
                                            <th scope="col">Laba Kotor</th>
                                            <th scope="col">Pengeluaran</th>
                                            <th scope="col">Barang Expired</th>
                                            <th scope="col">Laba Bersih</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                            <div class="table-responsive">
                                <h5>Data Laba Penjualan</h5>
                                <a href="<?php echo $url_export; ?>" class="btn btn-secondary btn-sm"><span class="fa fa-file-excel"></span>&nbsp; EXCEL</a><br><br>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Dari Tanggal</th>
                                                <th scope="col">Sampai Tanggal</th>
                                                <th scope="col">Total Penjualan</th>
                                                <th scope="col">Total Harga Pokok</th>
                                                <th scope="col">Laba Kotor</th>
                                                <th scope="col">Pengeluaran</th>
                                                <th scope="col">Barang Expired</th>
                                                <th scope="col">Laba Bersih</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if( ! empty($rows)){
                                                $no = 1;
                                                foreach($rows as $data){

                                                    echo "<tr>";
                                                    echo "<td>".$no++."</td>";
                                                    echo "<td>".$data->dari_tanggal."</td>";
                                                    echo "<td>".$data->sampai_tanggal."</td>";
                                                    echo "<td>".number_format($data->totjul)."</td>";
                                                    echo "<td>".number_format($data->harpok)."</td>";
                                                    echo "<td>".number_format($data->laba_kotor)."</td>";
                                                    echo "<td>".number_format($data->pengeluaran)."</td>";
                                                    echo "<td>".number_format($data->expired)."</td>";
                                                    echo "<td>".number_format($data->hasil)."</td>";
                                                    echo "<td>".$data->keterangan."</td>";
                                                    echo "<td>".'<a href="' . site_url('laba/del/' . $data->id) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger text-white btn-xs"><i class="fas fa-trash-alt"></i></a>'."</td>";
                                                    echo "</tr>";            
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Dari Tanggal</th>
                                                <th scope="col">Sampai Tanggal</th>
                                                <th scope="col">Total Penjualan</th>
                                                <th scope="col">Total Harga Pokok</th>
                                                <th scope="col">Laba Kotor</th>
                                                <th scope="col">Pengeluaran</th>
                                                <th scope="col">Barang Expired</th>
                                                <th scope="col">Laba Bersih</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
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
    $(document).ready(function(){

    $("#rekap").show();
    $("#buat").click(function(){
        $("#rekap").show();
    });
    $("#hide").click(function(){
        $("#rekap").hide();
    });
    });
</script>
<script>
        /*****************************************       Basic Table                   *****************************************/
        $('#viewall').DataTable();
</script>
       