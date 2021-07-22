<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();
        check_admin();

        $this->load->model('m_user');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->m_user->get();
        $this->template->load('template', 'user/index_user', $data);
    }

    public function add()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[users.username]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules(
            'password2',
            'Konfirmasi password',
            'trim|required|matches[password]',
            array('matches' => '{field} tidak sesuai dengan password')
        );
        $this->form_validation->set_rules('level', 'Akses', 'trim|required');

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '<span style="color:red"> *{field} sudah dipakai</span> ');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {

            $this->template->load('template', 'user/add_user');

            # code...
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_user->add($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert ('Data berhasil disimpan');</script>";
            }
            echo "<script>window.location ='" . site_url('user') . "' ; </script>";
        }
    }

    public function edit($id)
    {

        $this->form_validation->set_rules('username', 'Username', 'min_length[5]|callback_username_check');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules(
                'password2',
                'Konfirmasi password',
                'matches[password]',
                array('matches' => '{field} tidak sesuai dengan password')
            );
        }
        if ($this->input->post('password2')) {
            $this->form_validation->set_rules(
                'password2',
                'Konfirmasi password',
                'matches[password]',
                array('matches' => '{field} tidak sesuai dengan password')
            );
        }
        $this->form_validation->set_rules('level', 'Akses', 'trim|required');

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} sudah dipakai');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_user->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'user/edit_user', $data);
            } else {
                echo "<script>alert ('Data tidak ditemukan');";
                echo "window.location ='" . site_url('user') . "' ; </scrip>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->m_user->edit($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>window.location>alert ('Data berhasil disimpan');</script>";
            }
            echo "<script>window.location ='" . site_url('user') . "' ; </script>";
        }
    }

    function username_check()
    {

        $post = $this->input->post(NULL, TRUE);
        $query = $this->db->query("SELECT * FROM users WHERE username= '$post[username]' AND id != '$post[id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function del()
    {
        $id = $this->input->post('id');
        $this->m_user->del($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert ('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location ='" . site_url('user') . "' ; </script>";
    }
}
