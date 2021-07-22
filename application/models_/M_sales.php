<?php
class M_sales extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('items.*, category.name as namak, unit.name as namau, tbl_barcode.id_barcode as bar,tbl_barcode.nama_barang as nabar');

        $this->db->from('items');
        $this->db->join('category', 'category.category_id = items.category_id');
        $this->db->join('unit', 'unit.unit_id = items.unit_id');
        $this->db->join('tbl_barcode', 'tbl_barcode.id_barcode = items.barcode');
        if ($id != null) {
            $this->db->where('id_item', $id);
        }
        $this->db->order_by('barcode', 'asc');
        $query = $this->db->get();

        return $query;
        # code...
    }

    function hapus_retur($kode)
    {
        $hsl = $this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
        return $hsl;
    }
    function tampil_retur()
    {
        $hsl = $this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
        return $hsl;
    }

    function simpan_retur($kobar, $nabar, $satuan, $harjul, $qty, $keterangan)
    {
        $hsl = $this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
        return $hsl;
    }

    function simpan_penjualan($nofak, $total, $jml_uang, $kembalian, $pembeli)
    {
        $idadmin = $this->session->userdata('idadmin');
        $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembeli) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$pembeli')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_jual_nofak'             =>    $nofak,
                'd_jual_barang_id'         =>    $item['id'],
                'd_jual_barang_nama'       =>    $item['name'],
                'd_jual_barang_satuan'     =>    $item['satuan'],
                'd_jual_barang_harpok'     =>    $item['barang_harpok'],
                'd_jual_barang_harjul'     =>    $item['amount'],
                'd_jual_barang_harjul_satuan'     =>    $item['amounts'],
                'd_jual_qty'               =>    $item['qty'],
                'd_jual_qty_satuan'               =>    $item['qtys'],
                'd_jual_diskon'            =>    $item['disc'],
                'd_jual_total'             =>    $item['subtotal'],
                'created_at'            =>    date('Y-m-d H:i:s')
            );
            $this->db->insert('tbl_detail_jual', $data);
            $this->db->query("update items set stock=stock-'$item[qty]' where id_item='$item[id]'");
        }
        return true;
    }
    function get_nofak()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return date('dmy') . $kd;
    }

    //=====================Penjualan grosir================================
    function simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian, $pembeli, $created_at)
    {
        $idadmin = $this->session->userdata('idadmin');
        $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembeli,created_at) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir','$pembeli','$created_at')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_jual_nofak'              =>    $nofak,
                'd_jual_barang_id'          =>    $item['id'],
                'd_jual_barang_nama'        =>    $item['name'],
                'd_jual_barang_satuan'      =>    $item['nama_category'].'/'.$item['nama_unit'],
                'd_jual_barang_harpok'      =>    $item['harpok'],
                'd_jual_barang_harjul'      =>    $item['amount'],
                'd_jual_barang_harjul_satuan'=>    $item['amounts'],
                'd_jual_qty'                =>    $item['qty'],
                'd_jual_qty_satuan'         =>    $item['qtys'],
                'd_jual_diskon'             =>    $item['disc'],
                'd_jual_total'              =>    $item['subtotal'],
                'created_at'            =>    date('Y-m-d H:i:s')
            );
            $this->db->insert('tbl_detail_jual', $data);
            // $sql = "UPDATE items SET stock = floor((stock_kecil - (isi * '$item[qty]' + '$item[qtys]'))/isi), sisa = stock_kecil-(stock * isi)-'$item[qtys]' , stock_kecil=stock_kecil - (isi * '$item[qty]' + '$item[qtys]')  WHERE barcode='$item[id]'";
            $sql = "UPDATE items SET stock = floor((stock_kecil - (isi * '$item[qty]' + '$item[qtys]'))/isi) , stock_kecil=stock_kecil - (isi * '$item[qty]' + '$item[qtys]'), sisa = stock_kecil-(stock * isi) WHERE barcode='$item[id]'";
            $this->db->query($sql);
        }
//         $sql = "UPDATE items SET stock = floor((stock_kecil - (isi * '$item[qty]' + '$item[qtys]'))/isi)  WHERE barcode='$item[id]'";
// $this->db->query($sql);
// $sql3= "UPDATE items SET stock_kecil=stock_kecil - (isi * '$item[qty]' + '$item[qtys]')  WHERE barcode='$item[id]'";
// $this->db->query($sql3);
// $sql2= "UPDATE items SET sisa = stock_kecil-(stock * isi)-'$item[qtys]' + '$item[qtys]' WHERE barcode='$item[id]'";
// $this->db->query($sql2);

        return true;
    }
    function cetak_faktur()
    {
        $nofak = $this->session->userdata('nofak');
        $hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,jual_pembeli,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
        return $hsl;
    }
}