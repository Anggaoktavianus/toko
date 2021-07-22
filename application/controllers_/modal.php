<?php
defined('BASEPATH') or exit('No direct script access allowed');

class modal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_modal');
    }

    public function index()
    {
        $data['row'] = $this->m_modal->get();
        $this->template->load('template', 'modal/modal_index', $data);
    }

    public function add()
    {
        $modal = new stdClass();
        $modal->id = null;
        $modal->keterangan = null;
        $modal->jumlah_modal = null;

        $data = array(
            'page' => 'add',
            'row' => $modal
        );

        $this->template->load('template', 'modal/form_modal', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_modal->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_modal->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('modal/index');
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
}
