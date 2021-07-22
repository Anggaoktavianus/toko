<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model('m_category');
    }

    public function index()
    {
        $data['row'] = $this->m_category->get();
        $this->template->load('template', 'product/category/category_index', $data);
    }

    public function add()
    {
        $category = new stdClass();
        $category->category_id = null;
        $category->name = null;

        $data = array(
            'page' => 'add',
            'row' => $category
        );

        $this->template->load('template', 'product/category/form_category', $data);
    }

    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {

            $this->m_category->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->m_category->edit($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('category');
    }


    function edit($id)
    {
        $query = $this->m_category->get($id);
        if ($query->num_rows() > 0) {
            $category = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $category
            );
            $this->template->load('template', 'product/category/form_category', $data);
        } else {
            echo "<script>alert ('Data tidak ditemukan');";
            echo "window.location ='" . site_url('category') . "' ; </scrip>";
        }
    }

    public function del($id)
    {
        $this->m_category->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data berhasil dihapus');
        }
        redirect('category');
    }
}
