<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_aset extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('aset');
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
            'name'          => $post['name'],
            'nilai'          => $post['nilai'],

        ];
        $this->db->insert('aset', $params);
    }

    public function edit($post)
    {
        $params = [
            'name'          => $post['name'],
            'nilai'          => $post['nilai'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('aset', $params);
    }


    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('aset');
    }
}
