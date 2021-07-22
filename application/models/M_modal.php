
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_modal extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('modal');
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
            'keterangan'          => $post['keterangan'],
            'jumlah_modal'          => $post['jumlah_modal'],

        ];
        $this->db->insert('modal', $params);
    }

    public function edit($post)
    {
        $params = [
            'keterangan'          => $post['keterangan'],
            'jumlah_modal'          => $post['jumlah_modal'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('modal', $params);
    }


    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('modal');
    }
}
