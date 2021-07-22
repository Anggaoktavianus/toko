<?php
defined('BASEPATH') or exit('No direct script access allowed');

class menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_menu');
    }

    public function index()
    {
        $data['row'] = $this->m_menu->get();
        $this->template->load('template', 'product/menu/menu_index', $data);
    }

    public function add()
    {
        $menu = new stdClass();
        $menu->id = null;
        $menu->nama = null;

        $data = array(
            'page' => 'add',
            'row' => $menu
        );

        $this->template->load('template', 'product/menu/form_menu', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_menu->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_menu->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('menu');
    }


    function edit($id)
    {
        $query = $this->m_menu->get($id);
        if ($query->num_rows() > 0) {
            $menu = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $menu
            );
            $this->template->load('template', 'product/menu/form_menu', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('menu') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_menu->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('menu');
    }
}
