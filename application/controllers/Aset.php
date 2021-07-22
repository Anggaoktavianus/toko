<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();

        $this->load->model('m_aset');
    }

    public function index()
    {
        $data['row'] = $this->m_aset->get();
        $this->template->load('template', 'aset/aset_index', $data);
    }

    public function add()
    {
        $aset = new stdClass();
        $aset->id = null;
        $aset->name = null;
        $aset->nilai = null;

        $data = array(
            'page' => 'add',
            'row' => $aset
        );

        $this->template->load('template', 'aset/form_aset', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_aset->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_aset->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('aset/index');
    }


    function edit($id)
    {
        $query = $this->m_aset->get($id);
        if ($query->num_rows() > 0) {
            $aset = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $aset
            );
            $this->template->load('template', 'aset/form_aset', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('aset/index') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_aset->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('aset/index');
    }
}
