<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rekap extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('profit');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }


    public function get_by_jumlah()
    {
        $sql =
            "SELECT total.`stock`, SUM(total.`stock`) jumlah FROM `items` total WHERE total.`id_item` != '0'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }
    public function get_by_qty()
    {
        $sql =
            " SELECT total.`jml`, SUM(total.`jml`) jumlah FROM `stock` total WHERE total.`id_item` != '0'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }
    public function get_by_aset_()
    {
        $sql =
            " SELECT stock.`jml` stock, aset.`nilai` aset, modal.`jumlah_modal` modal
            FROM `profit` profit
            JOIN `stock` stock ON profit.`id_stock` = stock.`stock_id`
            JOIN `aset` aset ON profit.`id_aset` = aset.`id`
            JOIN `modal` modal ON profit.`id_modal` = modal.`id`
            WHERE profit.`id` != '0'
            AND profit.`created_at` IS NOT NULL
            GROUP BY profit.`id`
            ORDER BY stock DESC";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }

    public function get_by_aset()
    {
        $sql =
            " SELECT aset.`nilai` aset, SUM(aset.`nilai`) jumlah 
            FROM `aset` aset 
            -- JOIN `modal`modal ON aset.`id_modal` = modal.`id` 
            WHERE aset.`id` != '0'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }
    public function get_by_modal()
    {
        $sql =
            " SELECT total.`jumlah_modal`, SUM(total.`jumlah_modal`) jumlah FROM `modal` total WHERE total.`id` != '0'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }

    public function get_by_profit()
    {
        $sql =
            " SELECT total.`jumlah_modal` total ,aset.`nilai` aset, SUM((COALESCE(total.`jumlah_modal`))) jumlah
             FROM `aset` aset 
             JOIN `modal` total ON aset.`id_modal` = total.`id`
             WHERE total.`id` != '0'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }
    public function add($post)
    {
        $params = [
            't_stock'          => $post['t_stock'],
            'nilai_barang'         => $post['nilai_barang'],
            'nilai_aset'         => $post['nilai_aset'],
            'sub_total'       => $post['sub_total'],
            'modal'       => $post['modal'],
            'income'       => $post['income'],
            'keterangan'   => empty($post['keterangan']) ? null : $post['keterangan'],

        ];
        $this->db->insert('profit', $params);
    }

    public function edit($post)
    {
        $params = [
            'name'          => $post['name'],
            'phone'         => $post['phone'],
            'gender'         => $post['gender'],
            'address'       => $post['address'],
            'description'   => empty($post['description']) ? null : $post['description'],
            'updated' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('profit', $params);
    }


    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('profit');
    }
// Rekap laporan


    public function view_by_date($date, $date2){
//        

        if (!empty($date) && !empty($date2)) {
        // perintah tampil data berdasarkan range tanggal
        //  $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual` WHERE tbl_jual.created_at BETWEEN '$date' and '$date2'");
        $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
        WHERE tbl_jual.created_at BETWEEN '$date' and '$date2'"); 
       
        $query = $this->db->query($q);
        
        // $this->db->where('DATE(created_at)', $date and $date2);
        } else {
        // perintah tampil semua data
        if (!empty($date)){
             $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak
         WHERE tbl_jual.created_at ='$date'"); 
                $query = $this->db->query($q);
            // $this->db->where('DATE(created_at)', $date );
        }else {
           $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak "); 
            $query = $this->db->query($q);
        // $this->db->where('DATE(created_at)', $date );
        }
       
        }
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
        // $this->db->where('DATE(created_at)', $date); // Tambahkan where tanggal nya
        
		// return $this->db->get('tbl_jual',$data)->result();// Tampilkan data tbl_jual sesuai tanggal yang diinput oleh user pada filter
	}
public function view_by_date_id($date, $date2){
//        

        if (!empty($date) && !empty($date2)) {
        // perintah tampil data berdasarkan range tanggal
         $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual` WHERE tbl_jual.created_at BETWEEN '$date' and '$date2'");
        // $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        // FROM tbl_jual
        // INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
        // WHERE tbl_jual.created_at BETWEEN '$date' and '$date2'"); 
       
        $query = $this->db->query($q2);
        
        // $this->db->where('DATE(created_at)', $date and $date2);
        } else {
        // perintah tampil semua data
        if (!empty($date)){
        //      $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        // FROM tbl_jual
        // INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak
        //  WHERE tbl_jual.created_at ='$date'"); 
        $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual` WHERE tbl_jual.created_at BETWEEN '$date' ");
                $query = $this->db->query($q2);
            // $this->db->where('DATE(created_at)', $date );
        }else {
        //    $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        // FROM tbl_jual
        // INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak "); 
        $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual`");
            $query = $this->db->query($q2);
        // $this->db->where('DATE(created_at)', $date );
        }
       
        }
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
        // $this->db->where('DATE(created_at)', $date); // Tambahkan where tanggal nya
        
		// return $this->db->get('tbl_jual',$data)->result();// Tampilkan data tbl_jual sesuai tanggal yang diinput oleh user pada filter
	}
    
	public function view_by_month($month, $year){

        $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak WHERE MONTH(tbl_jual.created_at)= '$month' and YEAR(tbl_jual.created_at)='$year'");  
        
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;

        // $this->db->where('MONTH(created_at)', $month); // Tambahkan where bulan
        // $this->db->where('YEAR(created_at)', $year); // Tambahkan where tahun
        
		// return $this->db->get('tbl_jual')->result(); // Tampilkan data tbl_jual sesuai bulan dan tahun yang diinput oleh user pada filter
	}

    public function view_by_month_id($month, $year){
        // perintah tampil data berdasarkan range tanggal
         $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual` WHERE MONTH(tbl_jual.created_at)= '$month' and YEAR(tbl_jual.created_at)='$year'");
        
        $query = $this->db->query($q2);
        
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
        // $this->db->where('MONTH(created_at)', $month); // Tambahkan where bulan
        // $this->db->where('YEAR(created_at)', $year); // Tambahkan where tahun
        
		// return $this->db->get('tbl_jual')->result(); // Tampilkan data tbl_jual sesuai bulan dan tahun yang diinput oleh user pada filter
	
    }
    
	public function view_by_year($year){

        $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak WHERE  YEAR(tbl_jual.created_at)='$year'");  
        
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
        // $this->db->where('YEAR(created_at)', $year); // Tambahkan where tahun
        
		// return $this->db->get('tbl_jual')->result(); // Tampilkan data tbl_jual sesuai tahun yang diinput oleh user pada filter
	}

    public function view_by_year_id($year){
        // perintah tampil data berdasarkan range tanggal
         $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual` WHERE YEAR(tbl_jual.created_at)='$year'");
        
        $query = $this->db->query($q2);
        
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
        // $this->db->where('MONTH(created_at)', $month); // Tambahkan where bulan
        // $this->db->where('YEAR(created_at)', $year); // Tambahkan where tahun
        
		// return $this->db->get('tbl_jual')->result(); // Tampilkan data tbl_jual sesuai bulan dan tahun yang diinput oleh user pada filter
	
    }

	public function view_all(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama, tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon 
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }
    public function view_all_id(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
       
        $q2 = ("SELECT SUM(tbl_jual.jual_total) as total FROM `tbl_jual`");
        $query = $this->db->query($q2);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }
    
    public function option_tahun(){
        $this->db->select('YEAR(created_at) AS tahun'); // Ambil Tahun dari field created_at
        $this->db->from('tbl_jual'); // select ke tabel tbl_jual
        $this->db->order_by('YEAR(created_at)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(created_at)'); // Group berdasarkan tahun pada field created_at
        
        return $this->db->get()->result(); // Ambil data pada tabel tbl_jual sesuai kondisi diatas
    }

    // Harian
    // SELECT b.d_jual_total, b.d_jual_barang_nama, sum(a.jual_total) as terjual FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_nofak=b.d_jual_nofak  where SUBSTR(a.jual_tanggal, 1,10)=DATE(NOW()) GROUP BY a.jual_nofak
    // Mingguan
    // SELECT b.d_jual_total, b.d_jual_barang_nama, avg(a.jual_total) as terjual, a.jual_tanggal as tanggal FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_nofak=b.d_jual_nofak  where YEARWEEK(a.jual_tanggal)=YEARWEEK(NOW()) GROUP BY a.jual_nofak
    // Bulanan
    // SELECT b.d_jual_total, b.d_jual_barang_nama, sum(a.jual_total) as terjual FROM `tbl_jual` a JOIN tbl_detail_jual b ON a.jual_nofak=b.d_jual_nofak  where MONTH(a.jual_tanggal)=MONTH(NOW()) GROUP BY a.jual_nofak
    // Tahunan

    public function count(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
       
        $q2 = ("SELECT count(tbl_jual.jual_nofak) as hitung FROM `tbl_jual`");
        $query = $this->db->query($q2);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

    public function grafik(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
       
        $q2 = ("SELECT d_jual_barang_nama,d_jual_barang_satuan as 'satuan', COUNT(d_jual_barang_id) as 'total', SUM(tbl_detail_jual.d_jual_total) AS 'totalz',SUM(tbl_detail_jual.d_jual_qty ) AS 'totals',SUM(tbl_detail_jual.d_jual_qty_satuan) AS 'totaly' FROM tbl_detail_jual GROUP BY d_jual_barang_nama ASC ");
       
        $query = $this->db->query($q2);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

    function get_data(){
      $this->db->select('d_jual_barang_id,d_jual_barang_nama,d_jual_total');
      $result = $this->db->get('tbl_detail_jual');
      return $result;
  }

}
