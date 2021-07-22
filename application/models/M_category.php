<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_category extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('category');
        if ($id != null) {
            $this->db->where('category_id', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }

    public function add($post)
    {
        $params = [
            'name'          => $post['name'],

        ];
        $this->db->insert('category', $params);
    }

    public function edit($post)
    {
        $params = [
            'name'          => $post['name'],

            'updated' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('category_id', $post['category_id']);
        $this->db->update('category', $params);
    }


    public function del($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('category');
    }
}
