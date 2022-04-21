<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_items', 'm_category', 'm_unit','m_menu', 'm_sales']);
    }

    function get_ajax()
    {
        $list = $this->m_items->get_datatables();
        // $list = $this->m_items->get_by_jumlah();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->barcode;
            $row[] = $item->name;
            $row[] = $item->nama ;
            $row[] = $item->isi;
            $row[] = indo_currency($item->barang_harpok);
            $row[] = indo_currency($item->price);
            
            $row[] = $item->stock. '&nbsp;' .$item->category_name.'+'.$item->sisa.'&nbsp;' .$item->unit_name;
            
            // $row[] = $item->stock_kecil . '&nbsp;' .$item->unit_name;
            // $row[] = indo_currency($item->stock * $item->price);
            // $row[] = $item->jumlah;
            // $row[] = indo_currency($item->stock * $item->price * $item->id_item);
            // $row[] = $item->image != null ? '<img src="' . base_url('upload/item/' . $item->image) . '" class="img" style="width:50px">' : null;
            // add html for action
            $row[] = '<a href="' . site_url('items/edit/' . $item->id_item) . '" class="btn btn-success text-white btn-xs"><i class="fas fa-pencil-alt"></i></a>
                    <a href="' . site_url('items/del/' . $item->id_item) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger text-white btn-xs"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_items->count_all(),
            "recordsFiltered" => $this->m_items->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $data['row'] = $this->m_items->get();
        $data['jumlah'] = $this->m_items->get_by_jumlah();
        $data['total'] = $this->m_items->get_by_qty();
        $data['aset'] = $this->m_items->get_by_aset();
        $data['modal'] = $this->m_items->get_by_modal();
        $data['profit'] = $this->m_items->get_by_profit();
        $data['total_barang'] = $this->m_items->get_by_qty();
        $this->template->load('template', 'product/items/items_index', $data);
    }
    // function get_barang($kobar)
    // {
    //     $hsl = $this->db->query("SELECT * FROM items where barcode='$kobar'");
    //     return $hsl;
    // }

        

    public function add()
    {
        $items = new stdClass();
        $items->id_item = null;
        $items->barcode = null;
        $items->name = null;
        $items->barang_harpok = null;
        $items->price = null;
        $items->harga_satuan = null;
        $items->isi = null;
        $items->category_id = null;
        $items->unit_id = null;
        $items->sisa = null;
        $items->stock = null;
        $items->stock_kecil = null;
        $items->menu_id = null;
        $items->jml = null;

        $dariDB = $this->m_items->cekkodebarang();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 3, 4);
        $kodeBarangSekarang = $nourut + 1;
        $category = $this->m_category->get();
        $unit = $this->m_unit->get();
        $menu = $this->m_menu->get(); 
        // $barang = $this->m_barang->get();

        $data = array(
            'page' => 'add',
            'row' => $items,
            'category' => $category,
            'barcode' => $kodeBarangSekarang,
            'unit' => $unit,
            'menu' => $menu,
            // 'barang' => $barang
        );

        $this->template->load('template', 'product/items/form_items', $data);
    }

    public function proses()
    {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['file_name'] = 'items-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if ($this->m_items->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah terpakai produk lain");
                redirect('items/add/');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->m_items->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('items');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('items/add/');
                        
                    }
                } else {
                    $post['image'] = null;
                    $this->m_items->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('items');
                }
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->m_items->check_barcode($post['barcode'], $post['id_item'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah terpakai produk lain");
                redirect('items/edit/' . $post['id_item']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $item = $this->m_items->get($post['id_item'])->row();
                        if ($item->image != null) {
                            $target_file = './upload/item/' . $item->image;
                            unlink($target_file); //menghapus target file
                            # code...
                        }
                        $post['image'] = $this->upload->data('file_name');
                        $this->m_items->edit($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('items');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('items/edit/');
                    }
                } else {
                    $post['image'] = null;
                    $this->m_items->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('items');
                }
            }
        }
    }


    function edit($id)
    {
        $query = $this->m_items->get($id);
        if ($query->num_rows() > 0) {
            $items = $query->row();
            $category = $this->m_category->get();
            $unit = $this->m_unit->get();
             $menu = $this->m_menu->get();
             $dariDB = $this->m_items->cekkodebarang();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($dariDB, 3, 4);
            $kodeBarangSekarang = $nourut;
            // $barang = $this->m_barang->get();

            $data = array(
                'page' => 'edit',
                'row' => $items,
                'category' => $category,
                'unit' => $unit,
                 'menu' => $menu,
                  'barcode' => $kodeBarangSekarang,
                // 'barang' => $barang

            );

            $this->template->load('template', 'product/items/form_items', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('items') . "' ; </script>";
        }
    }

    public function del($id)
    {
        $item = $this->m_items->get($id)->row();
        if ($item->image != null) {
            $target_file = './upload/item/' . $item->image;
            unlink($target_file); //menghapus target file
            # code...
        }
        $this->m_items->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('items');
    }

    function barcode_qrcode($id)
    {
        $data['row'] = $this->m_items->get($id)->row();
        $this->template->load('template', 'product/items/barcode_qrcode', $data);
    }

    function barcode_print($id)
    {
        $data['row'] = $this->m_items->get($id)->row();
        $html = $this->load->view('product/items/barcode_print', $data, true);
        $this->fungsi->Pdfgenerator($html, 'barcode-' . $data['row']->barcode, 'A4', 'landscape');
    }
    function qr_print($id)
    {
        $data['row'] = $this->m_items->get($id)->row();
        $html = $this->load->view('product/items/qr_print', $data, true);
        $this->fungsi->Pdfgenerator($html, 'barcode-' . $data['row']->barcode, 'A4', 'landscape');
    }
}
