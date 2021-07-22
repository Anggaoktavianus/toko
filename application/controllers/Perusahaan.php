<?php
defined('BASEPATH') or exit('No direct script access allowed');

class perusahaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_perusahaan');
    }

    public function index()
    {
        $data['row'] = $this->m_perusahaan->get();
        $this->template->load('template', 'lain/perusahaan/perusahaan_index', $data);
    }

    public function add()
    {
        $perusahaan = new stdClass();
        $perusahaan->id = null;
        $perusahaan->jumlah = null;
        $perusahaan->deskripsi = null;

        $data = array(
            'page' => 'add',
            'row' => $perusahaan
        );

        $this->template->load('template', 'lain/perusahaan/form_perusahaan', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_perusahaan->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_perusahaan->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('perusahaan/index');
    }


    function edit($id)
    {
        $query = $this->m_perusahaan->get($id);
        if ($query->num_rows() > 0) {
            $perusahaan = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $perusahaan
            );
            $this->template->load('template', 'lain/perusahaan/form_perusahaan', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('perusahaan/index') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_perusahaan->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('perusahaan/index');
    }
}
