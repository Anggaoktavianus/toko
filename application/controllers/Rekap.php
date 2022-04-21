<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./assets/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet
class Rekap extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_items', 'm_category', 'm_unit', 'm_barang', 'm_rekap']);
    }

    // LAPORAN PENJUALAN
    public function index()
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                $userid= $_GET['pegawai1'];

                if (!empty($created_at) && !empty($created_at1) && !empty($pegawai)) {
                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'-'.'&nbsp;'.date('d-m-y', strtotime($created_at1)).'&nbsp;'.'oleh'.$userid;
                        $transaksi = $this->m_rekap->jual_view_by_date($created_at,$created_at1,$userid);
                        $url_export = 'rekap/export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1.'&pegawai1='.$userid;
                        $total = $this->m_rekap->jual_view_by_date_id($created_at,$created_at1,$userid);

                } else {
                        
                        $label = 'Data Transaksi Tanggal '.date('d-m-y H:i', strtotime($created_at)).'&nbsp;'.'-'.'&nbsp;'.date('d-m-y H:i', strtotime($created_at1));
                        $total = $this->m_rekap->jual_view_by_date_id($created_at,$created_at1,$userid);
                        $url_export = 'rekap/export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1.'&pegawai1='.$userid;
                        $transaksi = $this->m_rekap->jual_view_by_date($created_at, $created_at1,$userid);     
                } 
                
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total = $this->m_rekap->jual_view_by_month_id($bulan, $tahun);
                $url_export = 'rekap/export?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->m_rekap->jual_view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else if ($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $total = $this->m_rekap->jual_view_by_year_id($tahun);
                $label = 'Data Transaksi Tahun '.$tahun;
                $url_export = 'rekap/export?filter=3&tahun='.$tahun;
                $transaksi = $this->m_rekap->jual_view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }else{ // Jika filter nya 2 (per bulan)
                $pegawai = $_GET['pegawai'];
                $label = 'Data Penjualan';
                $transaksi = $this->m_rekap->jual_view_by_pegawai($pegawai); 
                $total = $this->m_rekap->jual_view_by_pegawai_id($pegawai);
                $url_export = 'rekap/export?filter=4&pegawai='.$pegawai;
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $total = $this->m_rekap->jual_view_all_id();
            $url_export = 'rekap/export';
            $transaksi = $this->m_rekap->jual_view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

		$data['label'] = $label;
        $data['total'] = $total; 
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->m_rekap->option_tahun();
        $data['option_pegawai'] = $this->m_rekap->option_pegawai();
		$this->template->load('template', 'rekap/rekap_penjualan', $data);
	}


    // Export ke excel
    public function export()
        {
            if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                $userid= $_GET['pegawai1'];

                if (!empty($created_at) && !empty($created_at1) && !empty($pegawai)) {
                        $transaksi = $this->m_rekap->jual_view_by_date($created_at,$created_at1,$userid);
                        $total = $this->m_rekap->jual_view_by_date_id($created_at,$created_at1,$userid);

                } else {
                        
                        $total = $this->m_rekap->jual_view_by_date_id($created_at,$created_at1);
                        $transaksi = $this->m_rekap->jual_view_by_date($created_at, $created_at1);     
                } 
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else if ($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $label = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }else{ // Jika filter nya 3 (per tahun)
                $pegawai = $_GET['pegawai'];

                $label = 'Data Transaksi Oleh '.$pegawai;
                $transaksi = $this->m_rekap->view_by_pegawai($pegawai); // Panggil fungsi view_by_year yang ada di m_rekap
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $total = $this->m_rekap->jual_view_all_id();
            $transaksi = $this->m_rekap->jual_view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Penjualan.xls");
         
                                        echo "<table border=1>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>".'No'."</th>";
                                        echo "<th>".'Kode Barang'."</th>";
                                        echo "<th>".'Nama Barang'."</th>";
                                        echo "<th>".'Terjual Box/Pcs'."</th>";
                                        echo "<th>".'Sisa Box/Pcs'."</th>";
                                        echo "<th>".'Harga Jual'."</th>";
                                        echo "<th>".'Subtotal'."</th>";
                                        echo "<th>".'Diskon'."</th>";
                                        echo "<th>".'Jasa'."</th>";
                                        echo "<th>".'Total'."</th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "</table>"; 
           if( ! empty($transaksi)){
            $no = 1;
            foreach($transaksi as $data){ 
                $created_at = date('d-m-Y', strtotime($data->created_at));
                                    echo "<table border=1>";                                   
                                        echo "<tbody>";
                                            echo "<tr>";
                                                echo "<td>".$no++."</td>";
                                                echo "<td>".$data->kobar."</td>";
                                                echo "<td>".$data->nabar."</td>";
                                                echo "<td>".$data->qty.'+'.$data->qtys.'&nbsp;'.$data->satuan."</td>";
                                                echo "<td>".$data->sisa_qty.'+'.$data->sisa_qtys.'&nbsp;'.$data->satuan."</td>";
                                                echo "<td>".$data->harjul."</td>";
                                                echo "<td>".$data->subtotal ."</td>";
                                                echo "<td>".$data->diskon ."</td>";
                                                echo "<td>".$data->jasa ."</td>";
                                                echo "<td>".$data->total ."</td>"; 
                                            echo "</tr>";
                                        echo "</tbody>";
                                    }
                                        echo"<tfoot>";
                                            echo "<tr>";
                                                echo "<th></th>";
                                                echo "<th></th>";
                                                echo "<th></th>";
                                                echo "<th></th>";
                                                echo "<th></th>";
                                                echo "<th>TOTAL</th>";
                                            foreach($total as $data){ // Ambil data tahun dari model yang dikirim dari controller
                                                echo "<th>"."<b>".$data->jual_subtotal."</th>";
                                                echo "<th>"."<b>".$data->diskon."</th>";
                                                echo "<th>"."<b>".$data->jasa."</th>";
                                                echo "<th>"."<b>".$data->total."</th>";
                                            }
                                        
                                            echo "</tr>";
                                        echo "</tfoot>";
                                    echo "</table>"; 
                                }  
        }

    // HISTORY PENJUALAN BARANG
    public function barang()
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                $userid= $_GET['pegawai1'];

                if (!empty($created_at) && !empty($created_at1) && !empty($pegawai)) {
                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1)).'&nbsp;'.'oleh'.$userid;
                        $transaksi = $this->m_rekap->view_by_date($created_at,$created_at1,$userid);
                        $url_export = 'rekap/barang_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;
                        $total = $this->m_rekap->view_by_date_id($created_at,$created_at1,$userid);

                } else {
                        
                        $label = 'Data Transaksi Tanggal '.date('d-m-y H:i', strtotime($created_at)).'&nbsp;'.'Sampai'.'&nbsp;'.date('d-m-y H:i', strtotime($created_at1));
                        $total = $this->m_rekap->view_by_date_id($created_at,$created_at1);
                        $url_export = 'rekap/barang_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;
                        $transaksi = $this->m_rekap->view_by_date($created_at, $created_at1);     
                } 
                
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total = $this->m_rekap->view_by_month_id($bulan, $tahun);
                $url_export = 'rekap/barang_export?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else if ($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $total = $this->m_rekap->view_by_year_id($tahun);
                $label = 'Data Transaksi Tahun '.$tahun;
                $url_export = 'rekap/barang_export?filter=3&tahun='.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }else{ // Jika filter nya 2 (per bulan)
                $pegawai = $_GET['pegawai'];
                $label = 'Data Penjualan';
                $transaksi = $this->m_rekap->view_by_pegawai($pegawai); 
                $total = $this->m_rekap->view_by_pegawai_id($pegawai);
                $url_export = 'rekap/barang_export?filter=4&pegawai='.$pegawai;
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $total = $this->m_rekap->view_all_id();
            $url_export = 'rekap/barang_export';
            $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

		$data['label'] = $label;
        $data['total'] = $total; 
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->m_rekap->option_tahun();
        $data['option_pegawai'] = $this->m_rekap->option_pegawai();
		$this->template->load('template', 'rekap/rekap_barang', $data);
	}


        // Export ke excel
    public function barang_export()
        {
            if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                // $created_at = $_GET['tanggal'];
                // $created_at1 = $_GET['tanggal1'];
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                // $userid= $_GET['pegawai1'];

                $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                // $transaksi = $this->m_rekap->view_by_date($created_at, $created_at1); // Panggil fungsi view_by_date yang ada di m_rekap
                 $transaksi = $this->m_rekap->view_by_date($created_at,$created_at1);
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else if ($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $label = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }else{ // Jika filter nya 3 (per tahun)
                $pegawai = $_GET['pegawai'];

                $label = 'Data Transaksi Oleh '.$pegawai;
                $transaksi = $this->m_rekap->view_by_pegawai($pegawai); // Panggil fungsi view_by_year yang ada di m_rekap
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Pegawai.xls");
                                        echo "<table border=1>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>".'No'."</th>";
                                        echo "<th>".'Nama'."</th>";
                                        echo "<th>".'Faktur'."</th>";
                                        echo "<th>".'Satuan'."</th>";
                                        echo "<th>".'Qty'."</th>";
                                        echo "<th>".'Qtys'."</th>";
                                        echo "<th>".'Tanggal'."</th>";
                                        // echo "<th>".'Faktur'."</th>";
                                        echo "<th>".'Total'."</th>";
                                        // echo "<th>".'Dibayar'."</th>";
                                        // echo "<th>".'Kembalian'."</th>";
                                        // echo "<td>".$$no++."</td>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "</table>"; 
           if( ! empty($transaksi)){
            $no = 1;
            foreach($transaksi as $data){ 
                $created_at = date('d-m-Y', strtotime($data->created_at));
                                    echo "<table border=1>";                                   
                                    echo "<tbody>";
                                        echo "<tr>";
                                        echo "<td>".$no++."</td>";
                                        echo "<td>".$data->d_jual_barang_nama."</td>";
                                        echo "<td>".$data->jual_nofak."</td>";
                                        echo "<td>".$data->d_jual_barang_satuan."</td>";
                                        echo "<td>".$data->d_jual_qty."</td>";
                                        echo "<td>".$data->d_jual_qty_satuan."</td>";
                                        echo "<td>".$created_at."</td>";
                                        echo "<td>".$data->total."</td>";
                                        // echo "<td>".$data->jual_jml_uang."</td>";
                                        // echo "<td>".$data->jual_kembalian."</td>";
                                        // echo "<td>".$$no++."</td>";
                                        echo "</tr>";
                                        echo "</tbody>";
                                    echo "</table>"; 
                                    }
                                }  
                              
        
        
        }

    // HISTORY OPERASIONAL TOKO

    public function toko_add()
    {
        $jml = new stdClass();
        $jml->id = null;
        $jml->d_jumlah = null;
        $jml->d_deskripsi = null;
        $jml->d_tgl_awal = null;
        $jml->d_tgl_sampai = null;
        $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];

                if (!empty($created_at) && !empty($created_at1)) {
                        $jml = $this->m_rekap->add_toko_view_by_date_id($created_at,$created_at1);
                        $mulai = $created_at;
                        $sampai =$created_at1;

                } else {
                        $jml = $this->m_rekap->add_toko_view_by_date_id($created_at,$created_at1);
                        $mulai = $created_at;
                        $sampai =$created_at1;
                } 
                
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $jml = $this->m_rekap->add_toko_view_by_date_id($created_at,$created_at1);
            $mulai = $created_at;
            $sampai =$created_at1;
        }   
        $data['jml'] = $jml; 
        $data['mulai'] = $mulai;
        $data['sampai'] = $sampai;
        
		$this->template->load('template', 'rekap/rekap_operasional', $data);
	}
     public function toko_add_act()
    {
        $post = $this->input->post(null, TRUE);
            $this->m_rekap->add_toko($post);
        if ($this->db->affected_rows() > 0) {
            redirect('rekap/toko?tanggal=&tanggal1=');
        }
        echo "<script>window.location ='" . site_url('rekap/toko_add?tanggal=&tanggal1=') . "' ; </script>";
    }

    public function toko()
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];

                if (!empty($created_at) && !empty($created_at1) && !empty($pegawai)) {
                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                        $transaksi = $this->m_rekap->toko_view_by_date($created_at,$created_at1);
                        $url_export = 'rekap/toko_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;
                        $total = $this->m_rekap->toko_view_by_date_id($created_at,$created_at1);
                        $jml = $this->m_rekap->add_toko_view_by_date_id($created_at,$created_at1);

                } else {
                        
                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                        $total = $this->m_rekap->toko_view_by_date_id($created_at,$created_at1);
                        $url_export = 'rekap/toko_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;
                        $transaksi = $this->m_rekap->toko_view_by_date($created_at, $created_at1);  
                        $jml = $this->m_rekap->add_toko_view_by_date_id($created_at,$created_at1);   
                } 
                
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $total = $this->m_rekap->toko_view_all_id();
            $jml = $this->m_rekap->add_toko_view_by_date_id();
            $url_export = 'rekap/toko_export';
            $transaksi = $this->m_rekap->toko_view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

		$data['label'] = $label;
        $data['total'] = $total; 
        $data['jml'] = $jml; 
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->m_rekap->option_tahun();
		$this->template->load('template', 'rekap/rekap_operasional_index', $data);
	}


        // Export ke excel
    public function toko_export()
        {
            if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                // $created_at = $_GET['tanggal'];
                // $created_at1 = $_GET['tanggal1'];
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                // $userid= $_GET['pegawai1'];

                $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                // $transaksi = $this->m_rekap->view_by_date($created_at, $created_at1); // Panggil fungsi view_by_date yang ada di m_rekap
                 $transaksi = $this->m_rekap->toko_view_by_date($created_at,$created_at1);
                 $total = $this->m_rekap->toko_view_all_id();
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else if ($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $label = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }else{ // Jika filter nya 3 (per tahun)
                $pegawai = $_GET['pegawai'];

                $label = 'Data Transaksi Oleh '.$pegawai;
                $transaksi = $this->m_rekap->view_by_pegawai($pegawai); // Panggil fungsi view_by_year yang ada di m_rekap
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $transaksi = $this->m_rekap->toko_view_all(); // Panggil fungsi view_all yang ada di m_rekap
            $total = $this->m_rekap->toko_view_all_id();
        }
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Pegawai.xls");
                                        echo "<table border=1>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th>".'No'."</th>";
                                                    echo "<th>".'Tanggal'."</th>";
                                                    echo "<th>".'Jumlah'."</th>";
                                                    echo "<th>".'Deskripsi'."</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                        echo "</table>"; 
           if( ! empty($transaksi)){
            $no = 1;
            foreach($transaksi as $data){ 
                                    echo "<table border=1>";                                   
                                        echo "<tbody>";
                                            echo "<tr>";
                                                echo "<td>".$no++."</td>";
                                                echo "<td>".$data->mulai.'&nbsp;'.'--'.'&nbsp;'.$data->selesai."</td>";
                                                echo "<td>".number_format($data->jumlah)."</td>";
                                                echo "<td>".$data->deskripsi."</td>";
                                            echo "</tr>";
                                        echo "</tbody>";
                                    }
                                     foreach($total as $data){
                                        echo "<tfoot>";
                                            echo "<tr>";
                                                echo "<th>"."<b>"."</th>";
                                                echo "<th>"."<b>"."TOTAL"."</th>";
                                                echo "<th>"."<b>".number_format($data->jumlah) ."</th>";
                                                echo "<th>"."<b>"."</th>";
                                            echo "</tr>";
                                        echo "</tfoot>";
                                    }
                                    echo "</table>"; 
                                    
                                }  
                              
        
        
        }

        

}
