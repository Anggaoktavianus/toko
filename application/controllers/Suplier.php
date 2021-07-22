<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_suplier');
    }

    public function index()
    {
        $data['row'] = $this->m_suplier->get();
        $this->template->load('template', 'suplier/suplier_index', $data);
    }

    public function add()
    {
        $suplier = new stdClass();
        $suplier->id_suplier = null;
        $suplier->name = null;
        $suplier->phone = null;
        $suplier->address = null;
        $suplier->description = null;
        $data = array(
            'page' => 'add',
            'row' => $suplier
        );

        $this->template->load('template', 'suplier/form_suplier', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_suplier->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_suplier->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert ('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location ='" . site_url('suplier') . "' ; </script>";
    }


    function edit($id)
    {
        $query = $this->m_suplier->get($id);
        if ($query->num_rows() > 0) {
            $suplier = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $suplier
            );
            $this->template->load('template', 'suplier/form_suplier', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('suplier') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_suplier->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert ('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location ='" . site_url('suplier') . "' ; </script>";
    }
}
