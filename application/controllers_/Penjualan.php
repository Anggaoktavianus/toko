<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_penjualan', 'm_items', 'm_suplier']);
    }

    public function index()
    {
        $penjualan = $this->m_penjualan->get()->result();
        $item = $this->m_items->get()->result();
        $suplier = $this->m_suplier->get()->result();
        $data = [
            'item' => $item, 'suplier' => $suplier, 'penjualan' => $penjualan, 'page' => 'add',

        ];
        $this->template->load('template', 'transaksi/penjualan/penjualan', $data);
    }

    public function add()
    {
        $penjualan = $this->m_penjualan->get()->result();
        $item = $this->m_items->get()->result();
        $suplier = $this->m_suplier->get()->result();
        $query = $this->m_penjualan->get();
        $jual = $query->row();
        $nofak = $this->m_penjualan->get_nofak();
        $data = array(
            'page' => 'add',
            'row' => $jual,
            'nofak' => $nofak,
            'penjualan' => $penjualan,
            'item' => $item,
        );

        $this->template->load('template', 'transaksi/penjualan/penjualan', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        $nofak = $this->m_penjualan->get_nofak();
        $total = $this->input->post(null, TRUE);
        $jml_uang = $this->input->post(null, TRUE);
        $kembalian = $this->input->post(null, TRUE);
        $idadmin = $this->input->post(null, TRUE);
        $pembeli = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_penjualan->add($post, $nofak, $total, $jml_uang, $kembalian, $idadmin, $pembeli);
        } elseif (isset($_POST['edit'])) {
            $this->m_modal->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('penjualan/add');
    }


    function edit($id)
    {
        $query = $this->m_modal->get($id);
        if ($query->num_rows() > 0) {
            $modal = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $modal
            );
            $this->template->load('template', 'modal/form_modal', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('modal/index') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_modal->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('modal/index');
    }

    // function get_barang()
    // {
    //     if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
    //         $kobar = $this->input->post('kode_brg');
    //         $x['brg'] = $this->m_items->get_barang($kobar);
    //         $this->load->view('admin/v_detail_barang_jual_grosir', $x);
    //     } else {
    //         echo "Halaman tidak ditemukan";
    //     }
    // }
    // function add_to_cart()
    // {
    //     if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
    //         $kobar = $this->input->post('kode_brg');
    //         $produk = $this->m_items->get_barang($kobar);
    //         $i = $produk->row_array();
    //         $data = array(
    //             'id'       => $i['id_item'],
    //             'name'     => $i['name'],
    //             'satuan'   => $i['unit_id'],
    //             'harpok'   => $i['barang_harpok'],
    //             'price'    => str_replace(",", "", $this->input->post('harjul')) - $this->input->post('diskon'),
    //             'disc'     => $this->input->post('diskon'),
    //             'qty'      => $this->input->post('qty'),
    //             'amount'      => str_replace(",", "", $this->input->post('harjul'))
    //         );
    //         if (!empty($this->cart->total_items())) {
    //             foreach ($this->cart->contents() as $items) {
    //                 $id = $items['id'];
    //                 $qtylama = $items['qty'];
    //                 $rowid = $items['rowid'];
    //                 $kobar = $this->input->post('kode_brg');
    //                 $qty = $this->input->post('qty');
    //                 if ($id == $kobar) {
    //                     $up = array(
    //                         'rowid' => $rowid,
    //                         'qty' => $qtylama + $qty
    //                     );
    //                     $this->cart->update($up);
    //                 } else {
    //                     $this->cart->insert($data);
    //                 }
    //             }
    //         } else {
    //             $this->cart->insert($data);
    //         }
    //         redirect('admin/penjualan_grosir');
    //     } else {
    //         echo "Halaman tidak ditemukan";
    //     }
    // }
    // function remove()
    // {
    //     if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
    //         $row_id = $this->uri->segment(4);
    //         $this->cart->update(array(
    //             'rowid'      => $row_id,
    //             'qty'     => 0
    //         ));
    //         redirect('admin/penjualan_grosir');
    //     } else {
    //         echo "Halaman tidak ditemukan";
    //     }
    // }
    // function simpan_penjualan_grosir()
    // {
    //     if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
    //         $total = $this->input->post('total');
    //         $pembeli = $this->input->post('pembeli');
    //         $jml_uang = str_replace(",", "", $this->input->post('jml_uang'));
    //         $kembalian = $jml_uang - $total;
    //         if (!empty($total) && !empty($jml_uang)) {
    //             if ($jml_uang < $total) {
    //                 echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
    //                 redirect('admin/penjualan_grosir');
    //             } else {
    //                 $nofak = $this->m_penjualan->get_nofak();
    //                 $this->session->set_userdata('nofak', $nofak);
    //                 $order_proses = $this->m_penjualan->simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian, $pembeli);
    //                 if ($order_proses) {
    //                     $this->cart->destroy();
    //                     //$this->session->unset_userdata('nofak');
    //                     $this->session->unset_userdata('tglfak');
    //                     $this->session->unset_userdata('suplier');
    //                     $this->load->view('admin/alert/alert_sukses_grosir');
    //                 } else {
    //                     redirect('admin/penjualan_grosir');
    //                 }
    //             }
    //         } else {
    //             echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
    //             redirect('admin/penjualan_grosir');
    //         }
    //     } else {
    //         echo "Halaman tidak ditemukan";
    //     }
    // }

    // function cetak_faktur_grosir()
    // {
    //     $x['data'] = $this->m_penjualan->cetak_faktur();
    //     $this->load->view('admin/laporan/v_faktur_grosir', $x);
    //     //$this->session->unset_userdata('nofak');
    // }
    // function cetak_struk_grosir()
    // {
    //     $x['data'] = $this->m_penjualan->cetak_faktur();
    //     $this->load->view('admin/laporan/v_struk_grosir', $x);
    //     //$this->session->unset_userdata('nofak');
    //     redirect('admin/penjualan');
    // }
}
