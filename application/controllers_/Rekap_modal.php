<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Load library phpspreadsheet
require('./assets/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet
class Rekap_modal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_items', 'm_category', 'm_unit', 'm_barang', 'm_rekap']);
    }

    public function index()
    {
        $data['row'] = $this->m_rekap->get();
        $data['jumlah'] = $this->m_rekap->get_by_jumlah();
        $data['total'] = $this->m_rekap->get_by_qty();
        $data['aset'] = $this->m_rekap->get_by_aset();
        $data['modal'] = $this->m_rekap->get_by_modal();
        $data['profit'] = $this->m_rekap->get_by_profit();
        $data['total_barang'] = $this->m_rekap->get_by_qty();
        $this->template->load('template', 'report/rekap_modal', $data);
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

    // public function history()
    // {
    //     $data['row'] = $this->m_items->get_by_filter();
       
    //     $this->template->load('template', 'transaksi/penjualan/rekap_penjualan', $data);
    // }
    
    // public function history(){
    //     if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
    //         $filter = $_GET['filter']; // Ambil data filder yang dipilih user

    //         if($filter == '1'){ // Jika filter nya 1 (per tanggal)
    //             $created_at = $_GET['tanggal'];

    //             $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at));
    //             $url_export = 'transaksi/export?filter=1&tanggal='.$created_at;
    //             $transaksi = $this->m_rekap->view_by_date($created_at); // Panggil fungsi view_by_date yang ada di m_rekap
    //         }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
    //             $bulan = $_GET['bulan'];
    //             $tahun = $_GET['tahun'];
    //             $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    //             $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
    //             $url_export = 'transaksi/export?filter=2&bulan='.$bulan.'&tahun='.$tahun;
    //             $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
    //         }else{ // Jika filter nya 3 (per tahun)
    //             $tahun = $_GET['tahun'];

    //             $label = 'Data Transaksi Tahun '.$tahun;
    //             $url_export = 'transaksi/export?filter=3&tahun='.$tahun;
    //             $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
    //         }
    //     }else{ // Jika user tidak mengklik tombol tampilkan
    //         $label = 'Semua Data Transaksi';
    //         $url_export = 'rekap_modal/export';
    //         $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
    //     }

	// 	$data['label'] = $label;
	// 	$data['url_export'] = base_url($url_export);
	// 	$data['transaksi'] = $transaksi;
    //     $data['option_tahun'] = $this->m_rekap->option_tahun();
	// 	$this->template->load('template', 'transaksi/penjualan/rekap_penjualan', $data);
	// }

	// public function export(){
    //     // Load plugin PHPExcel nya
	// 	include APPPATH.'third_party/PHPExcel/PHPExcel.php';

	// 	// Panggil class PHPExcel nya
	// 	$excel = new PHPExcel();

    //     // Settingan awal fil excel
    //     $excel->getProperties()->setCreator('My Notes Code')
    //     					   ->setLastModifiedBy('My Notes Code')
    //     					   ->setTitle("Data Transaksi")
    //     					   ->setSubject("Transaksi")
    //     					   ->setDescription("Laporan Semua Data Transaksi")
    //     					   ->setKeywords("Data Transaksi");

    //     // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    //     $style_col = array(
    //     	'font' => array('bold' => true), // Set font nya jadi bold
    //     	'alignment' => array(
    //     		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    //     	),
    //     	'borders' => array(
    //     		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    //     		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    //     		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    //     		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    //     	)
    //     );

    //     // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    //     $style_row = array(
    //     	'alignment' => array(
    //     		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    //     	),
    //     	'borders' => array(
    //     		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    //     		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    //     		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    //     		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    //     	)
    //     );

    //     if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
    //         $filter = $_GET['filter']; // Ambil data filder yang dipilih user

    //         if($filter == '1'){ // Jika filter nya 1 (per tanggal)
    //             $created_at = $_GET['tanggal'];

    //             $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at));
    //             $transaksi = $this->m_rekap->view_by_date($created_at); // Panggil fungsi view_by_date yang ada di m_rekap
    //         }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
    //             $bulan = $_GET['bulan'];
    //             $tahun = $_GET['tahun'];
    //             $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    //             $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
    //             $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
    //         }else{ // Jika filter nya 3 (per tahun)
    //             $tahun = $_GET['tahun'];

    //             $label = 'Data Transaksi Tahun '.$tahun;
    //             $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
    //         }
    //     }else{ // Jika user tidak mengklik tombol tampilkan
    //         $label = 'Semua Data Transaksi';
    //         $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
    //     }

    //     $excel->setActiveSheetIndex(0);
    //     $excel->getActiveSheet()->setCellValue('A1', "DATA TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
    //     $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
    //     $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1

    //     $excel->getActiveSheet()->setCellValue('A2', $label); // Set kolom A2 sesuai dengan yang pada variabel $label
    //     $excel->getActiveSheet()->mergeCells('A2:E2'); // Set Merge Cell pada kolom A2 sampai E2

    //     // Buat header tabel nya pada baris ke 4
    //     $excel->getActiveSheet()->setCellValue('A4', "Tanggal"); // Set kolom A4 dengan tulisan "Tanggal"
    //     $excel->getActiveSheet()->setCellValue('B4', "Kode Transaksi"); // Set kolom B4 dengan tulisan "Kode Transaksi"
    //     $excel->getActiveSheet()->setCellValue('C4', "Barang"); // Set kolom C4 dengan tulisan "Barang"
    //     $excel->getActiveSheet()->setCellValue('D4', "Jumlah"); // Set kolom D4 dengan tulisan "Jumlah"
    //     $excel->getActiveSheet()->setCellValue('E4', "Total Harga"); // Set kolom E4 dengan tulisan "Total Harga"

    //     // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    //     $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);

    //     // Set height baris ke 1, 2, 3 dan 4
    //     $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
    //     $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
    //     $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
    //     $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

    //     $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    //     $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 5

	// 	foreach($transaksi as $data){ // Lakukan looping pada variabel transaksi
    //     	$created_at = date('d-m-Y', strtotime($data->created_at)); // Ubah format tanggal jadi dd-mm-yyyy

    //     	$excel->getActiveSheet()->setCellValue('A'.$numrow, $created_at);
    //     	$excel->getActiveSheet()->setCellValue('B'.$numrow, $data->jual_nofak);
    //     	$excel->getActiveSheet()->setCellValue('C'.$numrow, $data->jual_total);
    //     	$excel->getActiveSheet()->setCellValue('D'.$numrow, $data->jual_jml_uang);
    //     	$excel->getActiveSheet()->setCellValue('E'.$numrow, $data->jutal_kembalian);

    //     	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    //     	$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
    //     	$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
    //     	$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
    //     	$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
    //     	$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);

    //     	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

    //     	$no++; // Tambah 1 setiap kali looping
    //     	$numrow++; // Tambah 1 setiap kali looping
    //     }

    //     // Set width kolom
    //     $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
    //     $excel->getActiveSheet()->getColumnDimension('B')->setWidth(18); // Set width kolom B
    //     $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    //     $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    //     $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E

    //     // Set orientasi kertas jadi LANDSCAPE
    //     $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    //     // Set judul file excel nya
    //     $excel->getActiveSheet()->setTitle("Laporan Data Transaksi");
    //     $excel->getActiveSheet();

    //     // Proses file excel
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"'); // Set nama file excel nya
    //     header('Cache-Control: max-age=0');

    //     $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    //     $write->save('php://output');
    // }

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
            $url_export = 'rekap_modal/export';
            $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        }

		$data['label'] = $label;
        $data['total'] = $total;
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
                              
        
        // Create new Spreadsheet object
        // $spreadsheet = new Spreadsheet();

        // // Set document properties
        // $spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
        // ->setLastModifiedBy('Andoyo - Java Web Medi')
        // ->setTitle('Office 2007 XLSX Test Document')
        // ->setSubject('Office 2007 XLSX Test Document')
        // ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
        // ->setKeywords('office 2007 openxml php')
        // ->setCategory('Test result file');
        // if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
        //     $filter = $_GET['filter']; // Ambil data filder yang dipilih user

        //     if($filter == '1'){ // Jika filter nya 1 (per tanggal)
        //         $created_at = $_GET['tanggal'];

        //         $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($created_at));
        //         $transaksi = $this->m_rekap->view_by_date($created_at); // Panggil fungsi view_by_date yang ada di m_rekap
        //     }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
        //         $bulan = $_GET['bulan'];
        //         $tahun = $_GET['tahun'];
        //         $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        //         $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
        //         $transaksi = $this->m_rekap->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di m_rekap
        //     }else{ // Jika filter nya 3 (per tahun)
        //         $tahun = $_GET['tahun'];

        //         $label = 'Data Transaksi Tahun '.$tahun;
        //         $transaksi = $this->m_rekap->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di m_rekap
        //     }
        // }else{ // Jika user tidak mengklik tombol tampilkan
        //     $label = 'Semua Data Transaksi';
        //     $transaksi = $this->m_rekap->view_all(); // Panggil fungsi view_all yang ada di m_rekap
        // }

        // // Add some data
        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A1', 'Tanggal')
        // ->setCellValue('B1', 'NO Faktur')
        // ->setCellValue('C1', 'Total')
        // ->setCellValue('D1', 'Dibayar')
        // ->setCellValue('E1', 'Kembalian')
        // ;

        // // Miscellaneous glyphs, UTF-8
        // $i=2; foreach($transaksi as $data) {
        // $created_at = date('d-m-Y', strtotime($data->created_at));
        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('A'.$i, $created_at)
        // ->setCellValue('B'.$i, $data->jual_nofak)
        // ->setCellValue('A'.$i, $data->jual_total)
        // ->setCellValue('B'.$i, $data->jual_jml_uang)
        // ->setCellValue('A'.$i, $data->jual_kembalian);
        
        // $i++;
        // }
        
        // // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

        // // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        // $spreadsheet->setActiveSheetIndex(0);

        // // Redirect output to a client’s web browser (Xlsx)
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
        // header('Cache-Control: max-age=0');
        // // If you're serving to IE 9, then the following may be needed
        // header('Cache-Control: max-age=1');

        // // If you're serving to IE over SSL, then the following may be needed
        // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        // header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        // header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        // header('Pragma: public'); // HTTP/1.0

        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');
        // // exit;
        }
}
