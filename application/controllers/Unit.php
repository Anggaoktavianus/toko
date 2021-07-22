<?php
defined('BASEPATH') or exit('No direct script access allowed');

class unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_unit');
    }

    public function index()
    {
        $data['row'] = $this->m_unit->get();
        $this->template->load('template', 'product/unit/unit_index', $data);
    }

    public function add()
    {
        $unit = new stdClass();
        $unit->unit_id = null;
        $unit->name = null;

        $data = array(
            'page' => 'add',
            'row' => $unit
        );

        $this->template->load('template', 'product/unit/form_unit', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_unit->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_unit->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('unit');
    }


    function edit($id)
    {
        $query = $this->m_unit->get($id);
        if ($query->num_rows() > 0) {
            $unit = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $unit
            );
            $this->template->load('template', 'product/unit/form_unit', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('unit') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_unit->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('unit');
    }
}
