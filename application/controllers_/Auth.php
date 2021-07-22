<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        is_login();
        $this->load->view('login');
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('m_user');
            $query = $this->m_user->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'id' => $row->id,
                    'level' => $row->level
                );

                $this->session->set_userdata($params);
                echo "<script>
                alert('Selamat, anda berhasil login');
                window.location='" . site_url('home') . "';
                </script>";
            } else {
                echo "<script>
                alert('Login gagal, periksa username dan password anda');
                window.location='" . site_url('auth') . "';
                </script>";
            }
        }
    }

    public function logout()
    {
        $params = array('id', 'level');

        $this->session->unset_userdata($params);
        redirect('auth');
        # code...
    }
}
