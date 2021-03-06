
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jasa extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('tbl_jasa');
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
            'deskripsi'          => $post['deskripsi'],
            'jumlah'          => $post['jumlah'],

        ];
        $this->db->insert('tbl_jasa', $params);
    }

    public function edit($post)
    {
        $params = [
            'deskripsi'          => $post['deskripsi'],
            'jumlah'          => $post['jumlah'],
           
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('tbl_jasa', $params);
    }


    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_jasa');
    }
}
