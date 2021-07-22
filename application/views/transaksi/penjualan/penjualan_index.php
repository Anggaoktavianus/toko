
<style>
div.polaroid {
 
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
}


</style>
<style>
* {
  box-sizing: border-box;
}

/* Center website */
.main {
  max-width: 1000px;
  margin: auto;
}

h4 {
  font-size: 12px;
  word-break: break-all;
}

.row {
  margin: 1px -16px;
  
}

/* Add padding BETWEEN each column */
.row,
.row > .column {
  padding: 10px;
  
}

/* Create three equal columns that floats next to each other */
.column {
  float: center;
  width: 18%;
  display: none; /* Hide all elements by default */
}

/* Clear floats after rows */ 
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Content */
.content {
  background-color: whitesmoke;
  padding: 1px -10px;
}

/* The "show" class is added to the filtered elements */
.show {
  display: block;
}

/* Style the buttons */
/* .btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
} */

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Sales</h4>
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
<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-sm">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Data Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                    <form action="<?= site_url('sales/add_to_cart') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                        <div class="form-group input-group">
                                            <input type="hidden" name="id_item" id="id_item">
                                            <input type="hidden" name="kode_brg" id="kode_brg" class="form-control" required autofocus>
                                        </div>
                                         
					                    <div>
                                            <label for="name">Nama Barang</label>                                       
                                        </div>
                                        <div class="form-group input-group">
                                        <input type="text" name="name" id="name" value="" class="form-control" readonly placeholder="Nama Barang"> &nbsp;
                                        </div>
                                        <div>
                                            <label for="jasa">Jasa Goreng</label>                                       
                                        </div>
                                        <div class="form-group input-group">
                                        <select name="jasa" class="form-control">
                                        <option value="0">-Select-</option>
                                            <option value="500">Goreng</option>
                                        </select> &nbsp;
                                        </div>
                                        
                                        <div>
                                            <label for="diskon">Disc</label>
                                        </div>
                                        <div class="form-group input-group">
                                        <input type="number" name="diskon" id="diskon" value="0" min="0" class="form-control" placeholder="Diskon item">
                                        <input type="hidden" name="jumlah" id="jasa" value="0" min="0" class="form-control" placeholder="Jasa ">
                                        </div>
                                        <input type="hidden" name="stock" id="stock" value="" class="form-control" readonly>
                                    	<input type="hidden" required name="harpok" id="harpok" value="" class="form-control">
                                            <input type="hidden" required name="harjul" id="price" value="" class="form-control">
                                            <input type="hidden" required name="harga_satuan" id="prices" value="" class="form-control">
                                        <div class="col-md-6">
                                            <label for="qty">Jumlah</label>
                                           <input type="number"  name="qty" id="qty" value="0" min="0" max="" class="form-control" placeholder="Box "> &nbsp;
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <label for="qtys">Eceran</label>
                                            </div>
                                            <div class="form-group input-group">
                                              <input type="number"  name="qtys" id="qtys" value="0" min="0" max="" class="form-control" placeholder="Pcs ">
                                            </div>
                                        </div>
                                        
                                        <!-- <div>
                                            <label for="jmlmm">Jumlah</label>
                                        </div>
                                        <div class="form-group input-group">
                                            
                                            
					                    </div> -->
                                        <div class="card-footer">
                                            <button  type="submit" class="btn btn-primary text-white" ><i class="fas fa-save">&nbsp; Pilih</i></button>
                                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal"><i class="fas fa-window-close">&nbsp; Close</i></button>
                                        </div>
                                </div>
                            </div> 
                        </div>
                    </form>
            <!-- Ini adalah Bagian Footer Modal -->
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

    <!--==============================================================-->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-8">
            <form action="<?php echo base_url().'sales/add_to_cart'?>" method="post">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped " style="font-size:11px;margin-top:10px;" width="100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Isi</th>
                                    <th style="text-align:center;">Stock</th>
                                    <th style="text-align:center;">Harga(Rp)</th>
                                    <th style="text-align:center;">Diskon(Rp)</th>
                                     <th style="text-align:center;">Jasa</th>
                                    <th style="text-align:center;">Qty</th>
                                    <th style="text-align:center;">Qtys</th>
                                    <th style="text-align:center;">Sub Total</th>
                                    <th style="width:100px;text-align:center;">Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($this->cart->contents() as $items): ?>
                                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                                    <tr>
                                        <td><?= $items['id'] ?></td>
                                        <td><?= $items['name'] ?></td>
                                         <td><?= $items['isi'] ?></td>
                                        <td style="text-align:center;"><?=$items['stock']?> <?= $items['nama_category']?> + <?=$items['sisa']?> <?=$items['nama_unit']?></td>
                                        <td style="text-align:right;"><?php echo number_format(
                                            $items['amount']
                                        ); ?></td>                                     
                                        <td style="text-align:right;"><?php echo number_format(
                                            $items['disc']
                                        ); ?></td>
                                         <td style="text-align:right;"><?php echo number_format(
                                            $items['jasa']
                                        ); ?></td>
                                        <td style="text-align:center;"><?php echo number_format(
                                            $items['qty']
                                        ); ?></td>
                                        <td style="text-align:center;"><?php echo number_format(
                                            $items['qtys']
                                        ); ?></td>
                                        
                                        <td style="text-align:right;"><?php echo number_format(
                                            $items['subtotal']
                                        ); ?></td>

                                         <td style="text-align:center;"><a href="<?php echo base_url() .
                                             'sales/remove/' .
                                             $items[
                                                 'rowid'
                                             ]; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                                    </tr>

                                    <?php $i++; ?>
                                <?php endforeach; ?>
                                     </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-lg-4">
            <form action="<?php echo base_url() .
                'sales/simpan_penjualan_grosir'; ?>" method="post">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <tr>
                                <th style="width:140px;">Total Belanja(Rp)</th>
                                <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format(
                                    $this->cart->total()
                                ); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                                <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                            </tr>
                            
                             <!-- <input type="hidden" name="jumlah" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required> -->
                            <!-- <tr>
                                <th>Tunai(Rp)</th>
                                <th style="text-align:right;"><input type="text" value="0" name="jml_uang" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                                <input type="hidden" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                            </tr>
                            <tr>
                                <th>Kembalian(Rp)</th>
                                <th style="text-align:right;"><input type="text" value="0" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            </tr>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th style="text-align:right;"><input type="text" id="pembeli" name="pembeli" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" ></th>
                            </tr> -->
                            <tr>
                            <td style="width:100px;" rowspan="2"><button type="submit" class="btn btn-info btn-sm"> Simpan</button></td>
                            <!-- <td style="width:100px;" rowspan="2"><button type="submit" class="btn btn-info btn-sm"> Cetak</button></td> -->
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="polaroid"><br>
                    <div id="myBtnContainer">
                        <button class="btn btn-primary" onclick="filterSelection('all')"> All</button>
                        <?php foreach ($menu as $key => $data ){?>
                        <button class="btn btn-primary" onclick="filterSelection('<?=$data->menu_id?>')"> <?=$data->nama?></button>
                        <?php }?>
                    </div>
                     <!-- Portfolio Gallery Grid -->
                    <div class="row">
                        <?php foreach ($item as $key => $data ){?>
                            <div class="column <?=$data->menu_id?>">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="polaroid">
                                                    <img src="<?=base_url('upload/' . $data->image)?>" class="img-thumbnail" alt="Cinque Terre" style="width:100%; height:80px;">
                                                    <br><h4><?=$data->name?></h4>
                                                    <p style="text-align:justify; font-size:80%">&nbsp; Stock : <?php echo $data->stock ?><?php echo $data->namak ?>+<?php echo $data->sisa ?><?php echo $data->namau ?><br> &nbsp; Harga : Rp.<?php echo number_format($data->price ) ?></p>
                                                    <div type="submit" class="badge badge-danger px-3 rounded-pill font-weight-normal" id="select" data-id="<?= $data->id_item ?>" data-kode_brg="<?= $data->barcode ?>" data-name="<?= $data->name ?>" data-unit="<?= $data->namau ?>" data-stock="<?= $data->stock ?><?= $data->namak ?>+<?= $data->sisa ?><?= $data->namau ?>" data-sisa="<?= $data->sisa ?>" data-price="<?= number_format($data->price) ?>" data-prices="<?= number_format($data->harga_satuan)  ?>" data-harpok="<?= $data->barang_harpok ?>" data-toggle="modal" data-target="#modal-item">Select</div><br> &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
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
        $(document).on('click', '#select', function() {
            var id_item = $(this).data('id');
            var barcode = $(this).data('kode_brg');
            var name = $(this).data('name');
            var namau = $(this).data('unit');
            var stock = $(this).data('stock');
            var sisa = $(this).data('sisa');
            var price = $(this).data('price');
            var harga_satuan = $(this).data('prices');
            var barang_harpok = $(this).data('harpok');
            $('#id_item').val(id_item);
            $('#kode_brg').val(barcode);
            $('#name').val(name);
            $('#unit').val(namau);
            $('#stock').val(stock);
            $('#sisa').val(sisa);
            $('#price').val(price);
            $('#prices').val(harga_satuan);
            $('#harpok').val(barang_harpok);
            $("#modal-item").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $("#modal-item").hide();


        })
    })
</script>



<script type="text/javascript">
    $(document).ready(function() {
        //Ajax kabupaten/kota insert
        $("#kode_brg").focus();
        $("#kode_brg").on("click", function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'sales/get_barang'; ?>",
                data: kobar,
                success: function(msg) {
                    $('#detail_barang').html(msg);
                }
            });
        });

        $("#kode_brg").keypress(function(e) {
            if (e.which == 13) {
                $("#jumlah").focus();
            }
        });
    });
</script>
<!-- <script type="text/javascript">
    $(function() {
        $('#jml_uang').on("input", function() {
            var total = $('#total').val();
            var jumuang = $('#jml_uang').val();
            var hsl = jumuang.replace(/[^\d]/g, "");
            $('#jml_uang2').val(hsl);
            $('#kembalian').val(hsl - total);
        })

    });
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#mydata').DataTable();
    });
</script>
<!-- <script type="text/javascript">
    $(function() {
        $('.jml_uang').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('#jml_uang2').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ''
        });
        $('#kembalian').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.harjul').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('items/get_ajax') ?>",
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



<!-- MAIN (Center website) -->


<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
       