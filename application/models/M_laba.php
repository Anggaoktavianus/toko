<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laba extends CI_Model
{


    public function get(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT *
            FROM laba
            ORDER BY id DESC
            LIMIT 1") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }
     public function getall(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT *
            FROM laba
            ORDER BY id DESC") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

public function get_by_jumlah()

    {   

        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2)) {
        // perintah tampil data berdasarkan range tanggal
        $q = ("SELECT SUM(d_jual_total) as totjual,SUM(d_jual_barang_harpok) as harpok,SUM(d_jual_total) - SUM(d_jual_barang_harpok) as laba_kotor
            FROM `tbl_detail_jual`
            WHERE tbl_detail_jual.date BETWEEN '$date' and '$date2'   
            ORDER BY d_jual_id  DESC
        "); 
       
        $query = $this->db->query($q);

        } 
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
    }

public function get_by_operasional()

    {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2)) {
        // perintah tampil data berdasarkan range tanggal
        $q = ("SELECT SUM(jumlah) as beban
            FROM `tbl_toko`
            WHERE created_at BETWEEN '$date' and '$date2' AND deleted_at IS NULL
            ORDER BY id DESC
        "); 
       
        $query = $this->db->query($q);

        } 
       
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
	    
    }

public function get_by_exp()

    {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2)) {
        // perintah tampil data berdasarkan range tanggal
        $q = ("SELECT SUM(jml) as expired
                FROM `stock`
                WHERE created_at BETWEEN '$date' and '$date2' AND stock.type = 'out' AND deleted_at IS NULL
                ORDER BY stock_id DESC
        "); 
       
        $query = $this->db->query($q);

        } 
       
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
	    
    }

    public function laba_view_all(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT SUM(d_jual_total=0) as totjual,SUM(d_jual_barang_harpok=0) as harpok,SUM(d_jual_total=0) - SUM(d_jual_barang_harpok=0) as laba_kotor
            FROM `tbl_detail_jual`") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }
    

    public function operasional_view_all(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT SUM(jumlah=0) as beban
            FROM `tbl_toko`
            WHERE deleted_at IS NULL
            ORDER BY id DESC") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

    public function exp_view_all(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT SUM(jml=0) as expired
                FROM `stock`
                WHERE stock.type = 'out' AND deleted_at IS NULL
                ORDER BY stock_id DESC") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

    public function add_laba($post)
    
    {
        $params = [
            'dari_tanggal'          => $post['dari_tanggal'],
            'sampai_tanggal'       => $post['sampai_tanggal'],
            'laba_kotor'        => $post['laba_kotor'],
            'totjul'        => $post['totjul'],
            'harpok'        => $post['harpok'],
            'expired'      => $post['expired'],
            'pengeluaran'      => $post['pengeluaran'],
            'keterangan'      => $post['keterangan'],
            'hasil'      => $post['laba_kotor']-$post['harpok']-$post['pengeluaran']-$post['expired'],
            'created_at'        => date('Y-m-d H:i:s')

        ];
        $this->db->insert('laba', $params);
    }

    public function add_laba_view_by_date_id()
    {      
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2)) {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
         $q2 = ("SELECT SUM(d_jual_total) as totjual,SUM(d_jual_barang_harpok) as harpok,SUM(d_jual_total) - SUM(d_jual_barang_harpok) as laba_kotor
            FROM `tbl_detail_jual`
            WHERE tbl_detail_jual.date BETWEEN '$date' and '$date2'   
            ORDER BY d_jual_id DESC
         ");
        $query = $this->db->query($q2);
       
        }else{
        
         $q2 = ("SELECT SUM(d_jual_total) as totjual,SUM(d_jual_barang_harpok) as harpok,SUM(d_jual_total) - SUM(d_jual_barang_harpok) as laba_kotor
            FROM `tbl_detail_jual`
            ORDER BY d_jual_id  DESC
         ");
    
        
        $query = $this->db->query($q2);
        }
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
       
	}

public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('laba');
    }
}