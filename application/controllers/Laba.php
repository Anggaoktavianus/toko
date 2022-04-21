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


        $this->load->model(['m_items', 'm_category', 'm_unit', 'm_barang', 'm_laba','m_laba']);
        $this->load->library('form_validation');
    }


    // LABA PENJUALAN
    public function laba_add()
    {
        $transaksi = new stdClass();
        $transaksi->id = null;
        $transaksi->dari_tanggal = null;
        $transaksi->sampai_tanggal = null;
        $transaksi->totjul = null;
        $transaksi->laba_kotor = null;
        $transaksi->expired = null;
        $transaksi->pengeluaran = null;
        $transaksi->hasil = null;
        $transaksi->keterangan = null;

        $created_at = $_GET['tanggal'];
        $created_at1 = $_GET['tanggal1'];
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];

                if (!empty($created_at) && !empty($created_at1)) {
                        $label = 'Semua Data Transaksi';
                        $transaksi = $this->m_laba->add_laba_view_by_date_id($created_at,$created_at1);
                        $mulai = $created_at;
                        $sampai =$created_at1;
                        $operasional = $this->m_laba->get_by_operasional($created_at,$created_at1);
                        $exp = $this->m_laba->get_by_exp($created_at,$created_at1);
                         $row = $this->m_laba->get();
                         $rows = $this->m_laba->getall();
                         $url_export = 'laba/laba_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;

                } else {
                        $label = 'Semua Data Transaksi';
                        $transaksi = $this->m_laba->add_laba_view_by_date_id($created_at,$created_at1);
                        $mulai = $created_at;
                        $sampai =$created_at1;
                        $operasional = $this->m_laba->get_by_operasional($created_at,$created_at1);
                        $exp = $this->m_laba->get_by_exp($created_at,$created_at1);
                         $row = $this->m_laba->get();
                         $rows = $this->m_laba->getall();
                         $url_export = 'laba/laba_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;
                } 
                
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $transaksi = $this->m_laba->add_laba_view_by_date_id($created_at,$created_at1);
            $mulai = $created_at;
            $sampai =$created_at1;
            $operasional = $this->m_laba->get_by_operasional($created_at,$created_at1);
            $exp = $this->m_laba->get_by_exp($created_at,$created_at1);
             $row = $this->m_laba->get();
             $rows = $this->m_laba->getall();
             $url_export = 'laba/laba_export';
        }   
        $data['label'] = $label;
        $data['transaksi'] = $transaksi; 
        $data['mulai'] = $mulai;
        $data['sampai'] = $sampai;
        $data['operasional'] = $operasional; 
        $data['exp'] = $exp; 
        $data['row'] = $row; 
        $data['rows'] = $rows; 
        $data['url_export'] = base_url($url_export);
		$this->template->load('template', 'report/laba_index', $data);
	}
     public function laba_add_act()
    {
        $this->form_validation->set_rules('dari_tanggal', 'Tanggal', 'trim|required|is_unique[laba.dari_tanggal]');
        $this->form_validation->set_message('is_unique', '<span style="color:red"> *{field} sudah dibuat</span> ');
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            // $this->template->load('template', 'report/laba_index');
            redirect('laba/index?tanggal=&tanggal1=');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_laba->add_laba($post);
            if ($this->db->affected_rows() > 0) {
                redirect('laba/index?tanggal=&tanggal1=');
            }
            echo "<script>window.location ='" . site_url('laba/laba_add?tanggal=&tanggal1=') . "' ; </script>";
        }
    }

    public function index()

    {
        $created_at = $_GET['tanggal'];
        $created_at1 = $_GET['tanggal1'];
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $created_at = $_GET['tanggal'];
                $created_at1 = $_GET['tanggal1'];

                if (!empty($created_at) && !empty($created_at1) && !empty($pegawai)) {
                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai Tanggal'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                        $transaksi = $this->m_laba->get_by_jumlah($created_at,$created_at1);
                        $operasional = $this->m_laba->get_by_operasional($created_at,$created_at1);
                        $exp = $this->m_laba->get_by_exp($created_at,$created_at1);
                        $url_export = 'laba/laba_export?filter=1&tanggal='.$created_at.'&tanggal1='.$created_at1;
                        $mulai = $created_at;
                        $sampai =$created_at1;
                        $row = $this->m_laba->get();
                        $rows = $this->m_laba->getall();

                } else {
                        
                        $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at)).'&nbsp;'.'Sampai'.'&nbsp;'.date('d-m-y', strtotime($created_at1));
                        $transaksi = $this->m_laba->get_by_jumlah($created_at,$created_at1);
                        $operasional = $this->m_laba->get_by_operasional($created_at,$created_at1);
                        $exp = $this->m_laba->get_by_exp($created_at,$created_at1);
                        $mulai = $created_at;
                        $sampai =$created_at1;
                        $row = $this->m_laba->get();
                        $rows = $this->m_laba->getall();
                } 
                
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $transaksi = $this->m_laba->laba_view_all();
            $row = $this->m_laba->get();
            $rows = $this->m_laba->getall();
            $operasional = $this->m_laba->operasional_view_all();
            $exp = $this->m_laba->exp_view_all();
            $mulai = $created_at;
            $sampai =$created_at1;
            $url_export = 'laba/laba_export';
        }

		$data['label'] = $label;
        $data['operasional'] = $operasional; 
        $data['exp'] = $exp; 
        $data['mulai'] = $mulai;
        $data['sampai'] = $sampai;
        $data['row'] = $row; 
        $data['rows'] = $rows; 
		$data['url_export'] = base_url($url_export);
		$data['transaksi'] = $transaksi;
		$this->template->load('template', 'report/laba_index', $data);
	}


        // Export ke excel
    public function laba_export()
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
                // $transaksi = $this->m_laba->view_by_date($created_at, $created_at1); // Panggil fungsi view_by_date yang ada di m_laba
                 $transaksi = $this->m_laba->laba_view_by_date($created_at,$created_at1);
                 $total = $this->m_laba->laba_view_all_id();
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->m_laba->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_laba
            }else if ($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $label = 'Data Transaksi Tahun '.$tahun;
                $transaksi = $this->m_laba->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_laba
            }else{ // Jika filter nya 3 (per tahun)
                $pegawai = $_GET['pegawai'];

                $label = 'Data Transaksi Oleh '.$pegawai;
                $transaksi = $this->m_laba->view_by_pegawai($pegawai); // Panggil fungsi view_by_year yang ada di m_laba
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $transaksi = $this->m_laba->laba_view_all(); // Panggil fungsi view_all yang ada di m_laba
            $total = $this->m_laba->laba_view_all_id();
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


    public function del($id)
    {
        // $laba = $this->m_laba->get($id)->row();
        $this->m_laba->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('laba/index?tanggal=&tanggal1=');
    }
}
