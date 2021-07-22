<?php
defined('BASEPATH') or exit('No direct script access allowed');

class toko extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_toko');
    }

    public function index()
    {
        $data['row'] = $this->m_toko->get();
        $this->template->load('template', 'lain/toko/toko_index', $data);
    }

    public function add()
    {
        $toko = new stdClass();
        $toko->id = null;
        $toko->jumlah = null;
        $toko->deskripsi = null;

        $data = array(
            'page' => 'add',
            'row' => $toko
        );

        $this->template->load('template', 'lain/toko/form_toko', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_toko->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_toko->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('toko/index');
    }


    function edit($id)
    {
        $query = $this->m_toko->get($id);
        if ($query->num_rows() > 0) {
            $toko = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $toko
            );
            $this->template->load('template', 'lain/toko/form_toko', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('toko/index') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_toko->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('toko/index');
    }
}
