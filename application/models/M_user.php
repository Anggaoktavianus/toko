<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('users');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }
    public function add($post)
    {
        $params['username'] = $post['username'];
        $params['nama'] = $post['nama'];
        $params['password'] = sha1($post['password']);
        $params['alamat'] = $post['alamat'] != "" ? $post['alamat'] : null;
        $params['level'] = $post['level'];
        $this->db->insert('users', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    public function edit($post)
    {
        $params['username'] = $post['username'];
        $params['nama'] = $post['nama'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }

        $params['alamat'] = $post['alamat'] != "" ? $post['alamat'] : null;
        $params['level'] = $post['level'];
        $this->db->where('id', $post['id']);
        $this->db->update('users', $params);
    }
}
