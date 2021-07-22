<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jasa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_jasa');
    }

    public function index()
    {
        $data['row'] = $this->m_jasa->get();
        $this->template->load('template', 'lain/jasa/jasa_index', $data);
    }

    public function add()
    {
        $jasa = new stdClass();
        $jasa->id = null;
        $jasa->jumlah = null;
        $jasa->deskripsi = null;

        $data = array(
            'page' => 'add',
            'row' => $jasa
        );

        $this->template->load('template', 'lain/jasa/form_jasa', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_jasa->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_jasa->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('jasa/index');
    }


    function edit($id)
    {
        $query = $this->m_jasa->get($id);
        if ($query->num_rows() > 0) {
            $jasa = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $jasa
            );
            $this->template->load('template', 'lain/jasa/form_jasa', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('jasa/index') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_jasa->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('jasa/index');
    }
}
