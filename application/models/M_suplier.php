<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_suplier extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('suplier');
        if ($id != null) {
            $this->db->where('id_suplier', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }

    public function add($post)
    {
        $params = [
            'name'          => $post['name'],
            'phone'         => $post['phone'],
            'address'       => $post['address'],
            'description'   => empty($post['description']) ? null : $post['description'],
        ];
        $this->db->insert('suplier', $params);
    }

    public function edit($post)
    {
        $params = [
            'name'          => $post['name'],
            'phone'         => $post['phone'],
            'address'       => $post['address'],
            'description'   => empty($post['description']) ? null : $post['description'],
            'updated' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id_suplier', $post['id_suplier']);
        $this->db->update('suplier', $params);
    }


    public function del($id)
    {
        $this->db->where('id_suplier', $id);
        $this->db->delete('suplier');
    }
}
