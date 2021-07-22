<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_items', 'm_category', 'm_unit', 'm_rekap']);
    }
	public function index()
	{
		// $this->template->load('template', 'home');
		 if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                if (!empty($created_at) && !empty($created_at1)) {

                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                        $total = $this->m_rekap->view_by_date_id($created_at,$created_at1);
                        $url_export = 'rekap_modal/export?filter=1&tanggal&tanggal1='.$created_at.$created_at1;
                        $transaksi = $this->m_rekap->view_by_date($created_at,$created_at1);
                        } else{
                            
                          if (!empty($created_at)) {

                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at));
                        $total = $this->m_rekap->view_by_date_id($created_at,$created_at1);
                        $url_export = 'rekap_modal/export?filter=1&tanggal='.$created_at;
                        $transaksi = $this->m_rekap->view_by_date($created_at, $created_at1);
                        }
                    }
                
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total = $this->m_rekap->view_by_month_id($bulan, $tahun);
                $url_export = 'rekap_modal/export?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $total = $this->m_rekap->view_by_year_id($tahun);
                $label = 'Data Transaksi Tahun '.$tahun;
                $url_export = 'rekap_modal/export?filter=3&tahun='.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $hitung = $this->m_rekap->count();
            $grafik = $this->m_rekap->grafik();
            $chart = $this->m_rekap->get_data()->result();
            $total = $this->m_rekap->view_all_id();
            $url_export = 'rekap_modal/export';
            $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

		$data['label'] = $label;
        $data['hitung'] = $hitung;
        $data['grafik'] = json_encode($grafik);
        $data['total'] = $total;
        $data['chart'] = json_encode($chart);
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->m_rekap->option_tahun();
		$this->template->load('template', 'home', $data);
	}
	public function chart()
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];
                if (!empty($created_at) && !empty($created_at1)) {

                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                        $url_export = 'rekap_modal/export?filter=1&tanggal&tanggal1='.$created_at.$created_at1;
                        $transaksi = $this->m_rekap->view_by_date($created_at,$created_at1);
                        } else{
                            
                          if (!empty($created_at)) {

                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at));
                        $url_export = 'rekap_modal/export?filter=1&tanggal='.$created_at;
                        $transaksi = $this->m_rekap->view_by_date($created_at, $created_at1);
                        }
                    }
                
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_export = 'rekap_modal/export?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $label = 'Data Transaksi Tahun '.$tahun;
                $url_export = 'rekap_modal/export?filter=3&tahun='.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $hitung = $this->m_rekap->count();
            $url_export = 'rekap_modal/export';
            $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

            
        $data['hitung'] = $hitung;
		$data['label'] = $label;
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->m_rekap->option_tahun();
		$this->template->load('template', 'home', $data);
	}


        // Export ke excel
    public function export()
        {
            if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                 $created_at1 = $_GET['tanggal1'];

               $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                $transaksi = $this->m_rekap->view_by_date($created_at, $created_at1); // Panggil fungsi view_by_date yang ada di m_rekap
            
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $label = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
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
                                        echo "<th>".'Nama'."</th>";
                                        echo "<th>".'Faktur'."</th>";
                                        echo "<th>".'Satuan'."</th>";
                                        echo "<th>".'Qty'."</th>";
                                        echo "<th>".'Qtys'."</th>";
                                        echo "<th>".'Tanggal'."</th>";
                                        // echo "<th>".'Faktur'."</th>";
                                        echo "<th>".'Total'."</th>";
                                        echo "<th>".'Dibayar'."</th>";
                                        echo "<th>".'Kembalian'."</th>";
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
                                        echo "<td>".$data->d_jual_barang_nama."</td>";
                                        echo "<td>".$data->jual_nofak."</td>";
                                        echo "<td>".$data->d_jual_barang_satuan."</td>";
                                        echo "<td>".$data->d_jual_qty."</td>";
                                        echo "<td>".$data->d_jual_qty_satuan."</td>";
                                        echo "<td>".$created_at."</td>";
                                        echo "<td>".$data->jual_total."</td>";
                                        echo "<td>".$data->jual_jml_uang."</td>";
                                        echo "<td>".$data->jual_kembalian."</td>";
                                        // echo "<td>".$$no++."</td>";
                                        echo "</tr>";
                                        echo "</tbody>";
                                    echo "</table>"; 
                                    }
                                }  
							}
}
