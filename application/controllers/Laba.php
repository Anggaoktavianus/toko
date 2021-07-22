<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./assets/vendor/autoload.php');

// End load library phpspreadsheet
class Laba extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_items', 'm_category', 'm_unit', 'm_barang', 'm_rekap','m_laba']);
    }

    public function index()
    {
	// $date1 = $_GET['tanggal'];
	// $date2 = $_GET['tanggal1'];
	$data['row'] = $this->m_laba->get_by_jumlah();
        $this->template->load('template', 'report/laba_index', $data);
    }

    function rekap_print($id)
    {
        $data['row'] = $this->m_rekap->get($id)->row();
        $html = $this->load->view('report/rekap_print', $data, true);
        $this->fungsi->Pdfgenerator($html, 'barcode-' . $data['row']->id, 'A4', 'potrait');
    }

    public function add()
    {
        $modal = new stdClass();
        $modal->id = null;
        $modal->t_stock = null;
        $modal->nilai_barang = null;
        $modal->nilai_aset = null;
        $modal->sub_total = null;
        $modal->modal = null;
        $modal->income = null;
        $modal->keterangan = null;
        $stock = $this->m_rekap->get_by_jumlah();
        $barang = $this->m_rekap->get_by_qty();
        $aset = $this->m_rekap->get_by_aset();
        $nilaimodal = $this->m_rekap->get_by_modal();
        $profit = $this->m_rekap->get_by_profit();
        $data = array(
            'page' => 'add',
            'row' => $modal,
            'stock' => $stock,
            'barang' => $barang,
            'aset' => $aset,
            'nilaimodal' => $nilaimodal,
            'profit' => $profit,
        );

        $this->template->load('template', 'report/form_rekap', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_rekap->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_rekap->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert ('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location ='" . site_url('rekap_modal') . "' ; </script>";
    }

    function edit($id)
    {
        $query = $this->m_items->get($id);
        if ($query->num_rows() > 0) {
            $items = $query->row();
            $category = $this->m_category->get();
            $unit = $this->m_unit->get();
            $barang = $this->m_barang->get();

            $data = array(
                'page' => 'edit',
                'row' => $items,
                'category' => $category,
                'unit' => $unit,
                'barang' => $barang

            );

            $this->template->load('template', 'product/items/form_items', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('items') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_rekap->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('rekap_modal/');
    }

   

    public function excel()
    {
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
            $total = $this->m_rekap->view_all_id();
            $subtotal = $this->m_rekap->view_subtotal_id();
            $jasa = $this->m_rekap->view_jasa_id();
            $url_export = 'rekap_modal/export';
            $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

		$data['label'] = $label;
        $data['total'] = $total;
         $data['subtotal'] = $subtotal;
          $data['jasa'] = $jasa;
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->m_rekap->option_tahun();
		$this->template->load('template', 'transaksi/penjualan/rekap_penjualan', $data);
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
                                        echo "<td>".$data->d_jual_barang_nama."</td>";
                                        echo "<td>".$data->jual_nofak."</td>";
                                        echo "<td>".$data->d_jual_barang_satuan."</td>";
                                        echo "<td>".$data->d_jual_qty."</td>";
                                        echo "<td>".$data->d_jual_qty_satuan."</td>";
                                        echo "<td>".$created_at."</td>";
                                        echo "<td>".$data->jual_total."</td>";
                                        // echo "<td>".$data->jual_jml_uang."</td>";
                                        // echo "<td>".$data->jual_kembalian."</td>";
                                        // echo "<td>".$$no++."</td>";
                                        echo "</tr>";
                                        echo "</tbody>";
                                    echo "</table>"; 
                                    }
                                }  
                        
        }
}
