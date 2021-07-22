<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_customer extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('customer');
        if ($id != null) {
            $this->db->where('id_customer', $id);
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
            'gender'         => $post['gender'],
            'address'       => $post['address'],
            'description'   => empty($post['description']) ? null : $post['description'],
        ];
        $this->db->insert('customer', $params);
    }

    public function edit($post)
    {
        $params = [
            'name'          => $post['name'],
            'phone'         => $post['phone'],
            'gender'         => $post['gender'],
            'address'       => $post['address'],
            'description'   => empty($post['description']) ? null : $post['description'],
            'updated' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id_customer', $post['id_customer']);
        $this->db->update('customer', $params);
    }


    public function del($id)
    {
        $this->db->where('id_customer', $id);
        $this->db->delete('customer');
    }
}
