<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('menu');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }

    public function add($post)
    {
        $params = [
            'nama'          => $post['nama'],

        ];
        $this->db->insert('menu', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama'          => $post['nama'],

            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('menu', $params);
    }


    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('menu');
    }
}
