<?php
class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();

        $this->load->model('m_category');
        $this->load->model('m_items');
        $this->load->model('m_suplier');
        $this->load->model('m_sales');
        $this->load->model('m_unit');
        $this->load->model('m_menu');
        $this->load->model('m_user');

    }

    function index()
    {

        $item = $this->m_items->get()->result();
        $menu = $this->m_items->get_by_id()->result();
        $data = [
            'item' => $item,
            'menu' => $menu,

        ];

        $this->template->load('template', 'transaksi/penjualan/penjualan_index', $data);
    }

    function get_barang()
    {
        $kobar = $this->input->post('kode_brg');
        $x['brg'] = $this->m_items->get_barang($kobar);
        $this->load->view('transaksi/penjualan/v_detail_barang_jual_grosir', $x);
    }

    function add_to_cart()
    {

        $kobar = $this->input->post('kode_brg');
        $produk = $this->m_items->get_barang($kobar);
        $i = $produk->row_array();
        $data = array(
            'id'            => $i['barcode'],
            'name'          => $i['name'],
            'nama_unit'     => $i['nama_unit'], 
            'isi'           => $i['isi'],
            'nama_category' => $i['nama_category'],
            'stock'         => $i['stock'] - $this->input->post('qty'),
            'sisa'          => $i['sisa'],
            'harpok'        => str_replace(",", "", $this->input->post('harpok')),
            'price'         => str_replace(",", "", $this->input->post('harjul')) - $this->input->post('diskon'),
            'disc'          => $this->input->post('diskon'),
            // 'jual_subtotal' => ($this->input->post('harjul')-$this->input->post('diskon'))*$this->input->post('qty')+($this->input->post('harga_satuan')*$this->input->post('qtys')),
            'jasa'          => $this->input->post('jasa')*($i['isi']*$this->input->post('qty'))+($this->input->post('qtys')* $this->input->post('jasa')),
            'qty'           => $this->input->post('qty'),
            'qtys'          => $this->input->post('qtys'),
            'amount'        => str_replace(",", "", $this->input->post('harjul')),
            'amounts'       => str_replace(",", "", $this->input->post('harga_satuan'))

        );
        if (!empty($this->cart->total_items())) {
            foreach ($this->cart->contents() as $items) {
                $id         = $items['id'];
                $qtylama    = $items['qty'];
                $qtyslama   = $items['qtys'];
                $jasalama   = $items['jasa'];
                $rowid      = $items['rowid'];
                $kobar      = $this->input->post('kode_brg');
                $qty        = $this->input->post('qty');
                $qtys       = $this->input->post('qtys');
                 $jasa      = $this->input->post('jasa')*$i['isi'];
                // $isi        = $this->input->post('isi');
                if ($id == $kobar) {
                    $up = array(
                        'rowid' => $rowid,
                        'qty'   => $qtylama + $qty,
                        'qtys'  => $qtyslama + $qtys,
                         'jasa'  => $jasalama + $jasa,
                        // 'isi'  => $isi,
                        

                    );
                    $this->cart->update($up);
                } else {
                    $this->cart->insert($data);
                }
            }
        } else {
            $this->cart->insert($data);
        }
        redirect('sales');
    }

    function remove()
    {

        $row_id = $this->uri->segment(3);
        $this->cart->update(array(
            'rowid'   => $row_id,
            'qty'     => 0,
            'qtys'    => 0
        ));
        redirect('sales');
    }

    function simpan_penjualan_grosir()
    {

        $total = $this->input->post('total');
        // $deskripsi = $this->input->post('deskripsi');
        // $pembeli = $this->input->post('pembeli');
        $idadmin = $this->input->post('jual_user_id');
         $created_at = date('Y-m-d H:i:s');
        // $jml_uang = str_replace(",", "", $this->input->post('jml_uang'));
        // $jml_uang = $this->input->post('jml_uang');
        // $kembalian = $jml_uang - $total;
        //  $kembalian = $this->input->post('kembalian');
        if (!empty($total)) {
            if ($total == 0) {
                echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
                redirect('sales');
            } else {
                $nofak = $this->m_sales->get_nofak();
                $this->session->set_userdata('nofak', $nofak);
                $order_proses = $this->m_sales->simpan_penjualan_grosir($nofak, $total, $created_at,$idadmin);
                if ($order_proses) {
                    $this->cart->destroy();
                    //$this->session->unset_userdata('nofak');
                    $this->session->unset_userdata('tglfak');
                    $this->session->unset_userdata('suplier');
                    // $this->template->load('template', 'transaksi/penjualan/view_cetak');
                     $this->load->view('transaksi/penjualan/view_cetak');
                    // redirect('sales/cetak_struk_grosir');
                    // echo json_encode($order_proses);
                } else {
                    redirect('sales');
                }
            }
        } else {
            echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
            redirect('sales');
            // echo json_encode($total);
        }
    }

    function cetak_faktur_grosir()
    {
        $x['data'] = $this->m_sales->cetak_faktur();
        $this->load->view('admin/laporan/v_faktur_grosir', $x);
        
        //$this->session->unset_userdata('nofak');
    }
    function cetak_struk_grosir()
    {
        $x['data'] = $this->m_sales->cetak_faktur();
        // $this->load->view('transaksi/pejualan/cetak_struk', $x);
        $this->template->load('template', 'transaksi/penjualan/cetak_struk', $x);
        //$this->session->unset_userdata('nofak');
        // redirect('sales');
    }
}
