<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('tbl_jual');
        if ($id != null) {
            $this->db->where('jual_nofak', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }

    public function add($post, $nofak, $total, $jml_uang, $kembalian, $idadmin, $pembeli)
    {
        $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembeli) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$pembeli')");
        $params = [
            'd_jual_nofak'             =>    $nofak,
            'd_jual_barang_id'        =>    $post['id'],
            'd_jual_barang_nama'    =>    $post['bname'],
            'd_jual_barang_satuan'    =>    $post['satuan'],
            'd_jual_barang_harpok'    =>    $post['harpok'],
            'd_jual_barang_harjul'    =>    $post['amount'],
            'd_jual_qty'            =>    $post['qty'],
            'd_jual_diskon'            =>    $post['disc'],
            'd_jual_total'            =>    $post['subtotal']


        ];
        $this->db->insert('tbl_detail_jual', $params);
    }



    public function edit($post)
    {
        $params = [
            'barcode'          => $post['barcode'],
            'name'          => $post['name'],
            'category_id'          => $post['category'],
            'unit_id'          => $post['unit'],
            'price'          => $post['price'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($post['image'] != null) {

            $params['image'] = $post['image']; # code...
        }

        $this->db->where('id_item', $post['id_item']);
        $this->db->update('items', $params);
    }

    function check_barcode($code, $id = null)
    {
        $this->db->from('items');
        $this->db->where('barcode', $code);
        if ($id != null) {
            $this->db->where('id_item !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('id_item', $id);
        $this->db->delete('items');
    }

    function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['id_item'];
        $sql = "UPDATE items SET stock = stock + '$qty' WHERE id_item='$id'";
        $this->db->query($sql);
    }

    function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['id_item'];
        $sql = "UPDATE items SET stock = stock - '$qty' WHERE id_item='$id'";
        $this->db->query($sql);
    }


    function simpan_penjualan($nofak, $total, $jml_uang, $kembalian, $pembeli)
    {
        $idadmin = $this->session->userdata('idadmin');
        $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembeli) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$pembeli')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_jual_nofak'             =>    $nofak,
                'd_jual_barang_id'        =>    $item['id'],
                'd_jual_barang_nama'    =>    $item['name'],
                'd_jual_barang_satuan'    =>    $item['satuan'],
                'd_jual_barang_harpok'    =>    $item['harpok'],
                'd_jual_barang_harjul'    =>    $item['amount'],
                'd_jual_qty'            =>    $item['qty'],
                'd_jual_diskon'            =>    $item['disc'],
                'd_jual_total'            =>    $item['subtotal']
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
    function simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian, $pembeli)
    {
        $idadmin = $this->session->userdata('idadmin');
        $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembeli) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir','$pembeli')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'd_jual_nofak'             =>    $nofak,
                'd_jual_barang_id'        =>    $item['id'],
                'd_jual_barang_nama'    =>    $item['name'],
                'd_jual_barang_satuan'    =>    $item['satuan'],
                'd_jual_barang_harpok'    =>    $item['harpok'],
                'd_jual_barang_harjul'    =>    $item['amount'],
                'd_jual_qty'            =>    $item['qty'],
                'd_jual_diskon'            =>    $item['disc'],
                'd_jual_total'            =>    $item['subtotal']
            );
            $this->db->insert('tbl_detail_jual', $data);
            $this->db->query("update items set stock=stock-'$item[qty]' where id_item='$item[id]'");
        }
        return true;
    }

    function cetak_faktur()
    {
        $nofak = $this->session->userdata('nofak');
        $hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,jual_pembeli,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
        return $hsl;
    }
}
