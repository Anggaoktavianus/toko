<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function index()
    {
        not_login();
        $this->template->load('template', 'admin/profile');
    }
}
