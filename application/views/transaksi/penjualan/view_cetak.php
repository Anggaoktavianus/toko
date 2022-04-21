<!DOCTYPE html>
<html>
<head>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<h2 style="text-align:center">Cetak Struk</h2>

<div class="card">
    <h1>Cetak Penjualan Barang</h1>
    <form action="<?php echo base_url().'sales/cetak_struk_grosir'; ?>" method="post">
        <div class="card">
            <div class="card-body">
                    <button type="submit" class="btn btn-info btn-sm"><i class="mdi mdi-view-dashboard">Cetak</i></button>
                    <a type="submit" href="<?=site_url('sales/')?>" class="btn btn-info btn-sm"> Kembali</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>