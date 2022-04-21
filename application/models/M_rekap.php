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
 
    // REKAP PENJUALAN BARANG

    public function view_by_date()
    {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        $pegawai= $_GET['pegawai1'];
        if (!empty($date) && !empty($date2) && !empty($pegawai)) {
        // perintah tampil data berdasarkan range tanggal
        $q = ("SELECT a.created_at,a.jual_nofak, c.nama as namas,c.id, a.jual_user_id, b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.created_at, b.d_jual_diskon as diskon
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
        WHERE b.created_at BETWEEN '$date' and '$date2' and a.jual_user_id='$pegawai'
        ORDER BY b.d_jual_id DESC"); 
       
        $query = $this->db->query($q);
        
        // $this->db->where('DATE(created_at)', $date and $date2);
        } else if (empty($date2 )&& empty($pegawai)){
        // perintah tampil semua data
        
             $q = ("SELECT a.created_at,a.jual_nofak, a.jual_user_id,c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.created_at, b.d_jual_diskon as diskon
            FROM tbl_jual a
            INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
            INNER JOIN users c ON c.id = a.jual_user_id
            WHERE b.created_at ='$date' 
            ORDER BY b.d_jual_id DESC"); 
                $query = $this->db->query($q);
            // $this->db->where('DATE(created_at)', $date );
        }else if (empty($pegawai)){
        // perintah tampil semua data
             $q = ("SELECT a.created_at,a.jual_nofak, a.jual_user_id,c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.created_at, b.d_jual_diskon as diskon
                    FROM tbl_jual a
                    INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
                    INNER JOIN users c ON c.id = a.jual_user_id
                    WHERE b.created_at BETWEEN '$date' and '$date2'
                    ORDER BY b.d_jual_id DESC "); 
                $query = $this->db->query($q);
          
        }else if (empty($date2)){
        // perintah tampil semua data
             $q = ("SELECT a.created_at,a.jual_nofak, a.jual_user_id,c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.created_at, b.d_jual_diskon as diskon
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
         WHERE b.created_at = '$date' 
         ORDER BY b.d_jual_id DESC"); 
                $query = $this->db->query($q);
          
        }else if(empty($date) && empty($date2)){
        // perintah tampil semua data
             $q = ("SELECT a.created_at,a.jual_nofak, a.jual_user_id,c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.created_at, b.d_jual_diskon as diskon
                    FROM tbl_jual a
                    INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
                    INNER JOIN users c ON c.id = a.jual_user_id
                    WHERE a.created_at IS NOT NULL and a.jual_user_id='$pegawai'
                    ORDER BY b.d_jual_id DESC"); 
                $query = $this->db->query($q);
          
        } else {
           $q = ("SELECT a.created_at,a.jual_nofak,a.jual_user_id, c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.created_at, b.d_jual_diskon as diskon
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
        ORDER BY b.d_jual_id DESC
        "); 
            $query = $this->db->query($q);
        // $this->db->where('DATE(created_at)', $date );
        }
       
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
       
	}

    public function view_by_date_id()
    {      
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        $pegawai= $_GET['pegawai1'];
        if (!empty($date) && !empty($date2) && !empty($pegawai)) {
        // perintah tampil data berdasarkan range tanggal
        
         $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
         FROM `tbl_detail_jual`
         INNER JOIN tbl_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
         INNER JOIN users ON users.id = tbl_jual.jual_user_id
            WHERE tbl_detail_jual.created_at BETWEEN '$date' and '$date2' and tbl_jual.jual_user_id='$pegawai'
            
         ");
    
        
        $query = $this->db->query($q2);
        
        } else if (empty($date2 )&& empty($pegawai)){
        // perintah tampil semua data
        
        $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
         FROM `tbl_detail_jual`
         INNER JOIN tbl_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
         INNER JOIN users ON users.id = tbl_jual.jual_user_id
         WHERE tbl_detail_jual.created_at = '$date'
          ");
                $query = $this->db->query($q2);
            // $this->db->where('DATE(created_at)', $date );
        }else if (empty($pegawai)){
        // perintah tampil semua data
        
        $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
         FROM `tbl_detail_jual`
         INNER JOIN tbl_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
         INNER JOIN users ON users.id = tbl_jual.jual_user_id
         WHERE tbl_detail_jual.created_at BETWEEN '$date' and '$date2' ");
                $query = $this->db->query($q2);
            // $this->db->where('DATE(created_at)', $date );
        }else if (empty($date )&& empty($date2)){
            $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
                    FROM `tbl_detail_jual`
                    INNER JOIN tbl_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
                    INNER JOIN users ON users.id = tbl_jual.jual_user_id
                    WHERE tbl_jual.jual_user_id='$pegawai' ");
                $query = $this->db->query($q2);

        }else{

        $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa , tbl_detail_jual.created_at
         FROM `tbl_jual`
         INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
         INNER JOIN users ON users.id = tbl_jual.jual_user_id
         WHERE tbl_detail_jual.created_at = '$date' ");
            $query = $this->db->query($q2);
        // $this->db->where('DATE(created_at)', $date );
        }
       
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
       
	}
    
	public function view_by_month($month, $year){

        $q = ("SELECT a.created_at,a.jual_nofak, c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as jual_subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as jual_total
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
        WHERE MONTH(a.created_at)= '$month' and YEAR(a.created_at)='$year'");  
        
        $query = $this->db->query($q);
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;

	}

    public function view_by_month_id($month, $year){
        // perintah tampil data berdasarkan range tanggal
         $q2 = ("SELECT SUM(tbl_jual.jual_total) as total,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
         FROM `tbl_jual`
         INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
         WHERE MONTH(tbl_jual.created_at)= '$month' and YEAR(tbl_jual.created_at)='$year'");
        
        $query = $this->db->query($q2);
        
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        return $data;
        
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

    public function view_by_pegawai($pegawai){

        $q = ("SELECT a.created_at,a.jual_nofak, c.nama as namas,b.d_jual_qty,b.d_jual_qty_satuan, b.d_jual_barang_nama, b.d_jual_nofak, b.d_jual_barang_satuan, b.d_jual_subtotal as subtotal, b.d_jual_barang_jasa as jasa, b.d_jual_total as total, b.d_jual_diskon as diskon
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
         WHERE a.jual_user_id='$pegawai'
         ORDER BY b.d_jual_id DESC");  
       
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

    public function view_by_pegawai_id($pegawai){
        // perintah tampil data berdasarkan range tanggal
         $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
         FROM `tbl_jual`
         INNER JOIN users ON users.id = tbl_jual.jual_user_id
         INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
         WHERE tbl_jual.jual_user_id= '$pegawai'
         ");
        
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
        $q = ("SELECT tbl_jual.jual_nofak, tbl_jual.jual_total,tbl_jual.jual_jml_uang,tbl_jual.jual_kembalian,tbl_jual.created_at,tbl_jual.jual_user_id, tbl_detail_jual.d_jual_nofak, tbl_detail_jual.d_jual_barang_nama,
        tbl_detail_jual.d_jual_barang_satuan, tbl_detail_jual.d_jual_qty,tbl_detail_jual.d_jual_qty_satuan, tbl_detail_jual.d_jual_diskon ,
        tbl_detail_jual.d_jual_barang_jasa ,  tbl_detail_jual.d_jual_barang_harjul as harjul,tbl_detail_jual.d_jual_barang_harjul_satuan as satuan,tbl_detail_jual.d_jual_qty as qty,tbl_detail_jual.d_jual_qty_satuan as qtysatuan,tbl_detail_jual.d_jual_diskon as diskon,
        tbl_detail_jual.d_jual_subtotal as subtotal ,tbl_detail_jual.d_jual_total as total, tbl_detail_jual.d_jual_barang_jasa as jasa,users.nama as namas
        FROM tbl_jual
        INNER JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak
        INNER JOIN users ON tbl_jual.jual_user_id=users.id
        --  WHERE tbl_detail_jual.date = DATE(NOW() )
        ORDER BY tbl_detail_jual.d_jual_id  DESC") ;
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
       
        $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa 
        FROM `tbl_detail_jual` ");
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

    public function option_pegawai(){
        $q2 = ("SELECT a.id as id,a.nama as namaus 
        FROM users a 
        ORDER BY a.id");
        $query = $this->db->query($q2);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

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
   // END REKAP PENJUALAN BARANG

   // REKAP LAPORAN PENJUALAN 

   public function jual_view_by_date()
    {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        $pegawai= $_GET['pegawai1'];
        if (!empty($date) && !empty($date2) && !empty($pegawai)) {
        // perintah tampil data berdasarkan range tanggal
        $q = ("SELECT b.d_jual_barang_id as kobar, b.d_jual_barang_nama as nabar,b.d_jual_barang_satuan as satuan, SUM(b.d_jual_qty) as qty,SUM(b.d_jual_qty_satuan) as qtys, b.d_jual_barang_harjul as harjul, c.nama as namas,c.id, SUM(b.d_jual_subtotal) as subtotal, SUM(b.d_jual_barang_jasa) as jasa,SUM(b.d_jual_diskon) as diskon, SUM(b.d_jual_total) as total, b.created_at, d.stock as sisa_qty, d.sisa as sisa_qtys
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
        LEFT JOIN items d ON d.barcode = b.d_jual_barang_id
        WHERE b.created_at BETWEEN '$date' and '$date2' and a.jual_user_id='$pegawai'    
        GROUP BY  b.d_jual_barang_id
        ORDER BY b.d_jual_id DESC
        "); 
       
        $query = $this->db->query($q);

        } else {
           $q = ("SELECT b.d_jual_barang_id as kobar, b.d_jual_barang_nama as nabar,b.d_jual_barang_satuan as satuan, SUM(b.d_jual_qty) as qty,SUM(b.d_jual_qty_satuan) as qtys, b.d_jual_barang_harjul as harjul, c.nama as namas,c.id, SUM(b.d_jual_subtotal) as subtotal, SUM(b.d_jual_barang_jasa) as jasa,SUM(b.d_jual_diskon) as diskon, SUM(b.d_jual_total) as total, b.created_at, d.stock as sisa_qty, d.sisa as sisa_qtys
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
        LEFT JOIN items d ON d.barcode = b.d_jual_barang_id
        WHERE b.created_at BETWEEN '$date' and '$date2'
        GROUP BY  b.d_jual_barang_id
        ORDER BY b.d_jual_id DESC
        "); 
            $query = $this->db->query($q);
        // $this->db->where('DATE(created_at)', $date );
        }
       
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
       
	}

    public function jual_view_by_date_id()
    {      
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        $pegawai= $_GET['pegawai1'];
        if (!empty($date) && !empty($date2) && !empty($pegawai)) {
        // perintah tampil data berdasarkan range tanggal
        
         $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa ,SUM(tbl_detail_jual.d_jual_diskon) as diskon , d.stock as sisa_qty, d.sisa as sisa_qtys
                FROM `tbl_detail_jual`
                INNER JOIN tbl_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
                INNER JOIN users ON users.id = tbl_jual.jual_user_id
                LEFT JOIN items d ON d.barcode = tbl_detail_jual.d_jual_barang_id
                WHERE tbl_detail_jual.created_at BETWEEN '$date' and '$date2' and tbl_jual.jual_user_id='$pegawai'
         ");
    
        
        $query = $this->db->query($q2);
        
        } else {
        // perintah tampil semua data
        
        $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, users.nama as namas,  SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa ,SUM(tbl_detail_jual.d_jual_diskon) as diskon , d.stock as sisa_qty, d.sisa as sisa_qtys
            FROM `tbl_detail_jual`
            INNER JOIN tbl_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak 
            INNER JOIN users ON users.id = tbl_jual.jual_user_id
            LEFT JOIN items d ON d.barcode = tbl_detail_jual.d_jual_barang_id
            WHERE tbl_detail_jual.created_at BETWEEN '$date' and '$date2'
          ");
                $query = $this->db->query($q2);
            // $this->db->where('DATE(created_at)', $date );
        }
       
        
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
       
	}

    public function jual_view_all(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT b.d_jual_barang_id as kobar, b.d_jual_barang_nama as nabar,b.d_jual_barang_satuan as satuan, SUM(b.d_jual_qty) as qty,SUM(b.d_jual_qty_satuan) as qtys, b.d_jual_barang_harjul as harjul, c.nama as namas,c.id, SUM(b.d_jual_subtotal) as subtotal, SUM(b.d_jual_barang_jasa) as jasa,SUM(b.d_jual_diskon) as diskon, SUM(b.d_jual_total) as total, b.created_at, d.stock as sisa_qty, d.sisa as sisa_qtys
        FROM tbl_jual a
        INNER JOIN tbl_detail_jual b ON b.d_jual_nofak = a.jual_nofak
        INNER JOIN users c ON c.id = a.jual_user_id
        LEFT JOIN items d ON d.barcode = b.d_jual_barang_id
        WHERE b.created_at 
        GROUP BY  b.d_jual_barang_id
        ORDER BY b.d_jual_id DESC") ;
        $query = $this->db->query($q);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }
    
    public function jual_view_all_id(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
       
        $q2 = ("SELECT SUM(tbl_detail_jual.d_jual_total) as total, SUM(tbl_detail_jual.d_jual_subtotal) as jual_subtotal , SUM(tbl_detail_jual.d_jual_barang_jasa) as jasa ,SUM(tbl_detail_jual.d_jual_diskon) as diskon 
        FROM `tbl_detail_jual` ");
        $query = $this->db->query($q2);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

    // REKAP LAPORAN OPRRASIONSL 

   public function toko_view_by_date()
    {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2)) {
        // perintah tampil data berdasarkan range tanggal
        $q = ("SELECT a.d_tgl_awal as mulai, a.d_tgl_sampai as selesai, a.d_jumlah as jumlah, a.d_deskripsi as deskripsi
        FROM tbl_detail_toko a 
        WHERE a.d_tgl_awal BETWEEN '$date' and '$date2'   
        ORDER BY a.id DESC
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

    public function toko_view_by_date_id()
    {      
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2) ) {
        // perintah tampil data berdasarkan range tanggal
        
         $q2 = ("SELECT SUM(a.d_jumlah) as jumlah
                FROM tbl_detail_toko a
                 WHERE a.d_tgl_awal BETWEEN '$date' and '$date2' 
                ORDER BY id DESC
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

    public function toko_view_all(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
        $q = ("SELECT a.d_tgl_awal as mulai, a.d_tgl_sampai as selesai, a.d_jumlah as jumlah, a.d_deskripsi as deskripsi
        FROM tbl_detail_toko a 
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
    
    public function toko_view_all_id(){
		// return $this->db->get('tbl_jual')->result(); // Tampilkan semua data tbl_jual
       
        $q2 = ("SELECT SUM(a.d_jumlah) as jumlah
                FROM tbl_detail_toko a
                ORDER BY id DESC");
        $query = $this->db->query($q2);
         if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }
        //  return $this->db->get('tbl_jual', $data)->result();
        return $data;
    }

    public function add_toko($post)
    
    {
        $params = [
            'd_jumlah'          => $post['d_jumlah'],
            'd_deskripsi'       => $post['d_deskripsi'],
            'd_tgl_awal'        => $post['d_tgl_awal'],
            'd_tgl_sampai'      => $post['d_tgl_sampai'],
            'created_at'        => date('Y-m-d H:i:s')

        ];
        $this->db->insert('tbl_detail_toko', $params);
    }

    public function add_toko_view_by_date_id()
    {      
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
        if (!empty($date) && !empty($date2)) {
        $date = $_GET['tanggal'];
        $date2 = $_GET['tanggal1'];
         $q2 = ("SELECT SUM(jumlah) as jumlah
                FROM tbl_toko 
                WHERE created_at BETWEEN '$date' AND  '$date2'
         ");
        $query = $this->db->query($q2);
       
        }else{
        
         $q2 = ("SELECT SUM(jumlah=0) as jumlah
                FROM tbl_toko 
                WHERE created_at 
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

}
