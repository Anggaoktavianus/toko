
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_barang');
    }

    function get_ajax()
    {
        $list = $this->m_barang->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->id_barcode;
            $row[] = $item->nama_barang;
            $row[] = $item->image != null ? '<img src="' . base_url('upload/item/' . $item->image) . '" class="img" style="width:50px">' : null;
            $row[] = '<a href="' . site_url('barang/edit/' . $item->id_barcode) . '" class="btn btn-success text-white"><i class="fas fa-pencil-alt"></i></a>
            <a href="' . site_url('items/del/' . $item->id_barcode) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger text-white"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_barang->count_all(),
            "recordsFiltered" => $this->m_barang->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }


    public function index()
    {
        $data['row'] = $this->m_barang->get();
        $this->template->load('template', 'barang/list', $data);
    }

    public function add()
    {
        $items = new stdClass();
        $items->id_barcode = null;
        $items->nama_barang = null;


        $data = array(
            'page' => 'add',
            'row' => $items
        );

        $this->template->load('template', 'barang/form_barang', $data);
    }

    public function proses()
    {
        $config['upload_path'] = './upload/item/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = 'items-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if ($this->m_barang->check_barcode($post['id_barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[id_barcode] sudah terpakai produk lain");
                redirect('barang/add/');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->m_barang->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('barang');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('barang/add/');
                    }
                } else {
                    $post['image'] = null;
                    $this->m_barang->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('barang');
                }
            }
        } elseif (isset($_POST['edit'])) {
            if ($this->m_barang->check_barcode($post['id_barcode'], $post['id_barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[id_barcode] sudah terpakai produk lain");
                redirect('barang/edit/' . $post['id_barcode']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $item = $this->m_barang->get($post['id_barcode'])->row();
                        if ($item->image != null) {
                            $target_file = './upload/item/' . $item->image;
                            unlink($target_file); //menghapus target file
                            # code...
                        }
                        $post['image'] = $this->upload->data('file_name');
                        $this->m_barang->edit($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('barang');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('barang/edit/');
                    }
                } else {
                    $post['image'] = null;
                    $this->m_barang->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('barang');
                }
            }
        }
    }


    function edit($id)
    {
        $query = $this->m_barang->get($id);
        if ($query->num_rows() > 0) {
            $items = $query->row();

            $data = array(
                'page' => 'edit',
                'row' => $items,

            );

            $this->template->load('template', 'barang/form_barang', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('barang') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $item = $this->m_barang->get($id)->row();
        if ($item->image != null) {
            $target_file = './upload/item/' . $item->image;
            unlink($target_file); //menghapus target file
            # code...
        }
        $this->m_barang->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('barang');
    }
}
