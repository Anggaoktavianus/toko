<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_stock extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('stock');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_in()
    {
        $this->db->select('stock.id_item,stock.stock_id, items.id_item, items.name as namai,barcode, qty, date, detail, suplier.name as namas, items.id_item');
        $this->db->from('stock');
        $this->db->join('items', 'stock.id_item = items.id_item');
        $this->db->join('suplier', 'stock.suplier_id = suplier.id_suplier', 'left');
        $this->db->where('type', 'in');
        $this->db->order_by('stock_id', 'desc');
        $query = $this->db->get();
        return $query;
    }
    public function add_stock_in($post)
    {
        $params = [
            'id_item'       => $post['id_item'],
            'type'          => 'in',
            'detail'        => $post['detail'],
            'suplier_id'    => $post['suplier_id'],
            'qty'           => $post['qty'],
            'jml'           => $post['qty'] * $post['price'],
            'date'          => $post['date'],
            'user_id'          => $this->session->userdata('id'),

        ];
        $this->db->insert('stock', $params);
    }

    public function get_stock_out()
    {
        $this->db->select('stock.id_item,stock.stock_id, items.id_item, items.name as namai,barcode, qty, date, detail, suplier.name as namas, items.id_item');
        $this->db->from('stock');
        $this->db->join('items', 'stock.id_item = items.id_item');
        $this->db->join('suplier', 'stock.suplier_id = suplier.id_suplier', 'left');
        $this->db->where('type', 'out');
        $this->db->order_by('stock_id', 'desc');
        $query = $this->db->get();
        return $query;
    }
    public function add_stock_out($post)
    {
        $params = [
            'id_item'       => $post['id_item'],
            'type'          => 'out',
            'detail'        => $post['detail'],
            'suplier_id'    => $post['suplier_id'],
            'qty'           => $post['qty'],
            'date'          => $post['date'],
            'user_id'          => $this->session->userdata('id'),

        ];
        $this->db->insert('stock', $params);
    }

    // function check_stock($code, $id = null)
    // {
    //     $this->db->from('items');
    //     $this->db->where('stock', $code);
    //     if ($id != null) {
    //         $this->db->where('id_item !=', $id);
    //     }
    //     $query = $this->db->get();
    //     return $query;
    // }
}
