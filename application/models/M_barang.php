<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{

    var $column_order = array(null, 'id_barcode', 'nama_barang'); //set column field database for datatable orderable
    var $column_search = array('id_barcode', 'nama_barang'); //set column field database for datatable searchable
    var $order = array('id_barcode' => 'ASC'); // default order 

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('tbl_barcode');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all()
    {
        $this->db->from('tbl_barcode');
        return $this->db->count_all_results();
    }

    public function get($id = null)
    {
        $this->db->from('tbl_barcode');
        $this->db->order_by('nama_barang', 'ASC');
        if ($id != null) {
            $this->db->where('id_barcode', $id);
        }
        $query = $this->db->get();
        return $query;
        # code...
    }

    public function add($post)
    {
        $params = [
            'id_barcode'     => $post['id_barcode'],
            'nama_barang'    => strtoupper($post['nama_barang']),
            'image'          => $post['image'],

        ];
        $this->db->insert('tbl_barcode', $params);
    }



    public function edit($post)
    {
        $params = [
            'id_barcode'          => $post['id_barcode'],
            'nama_barang'          => $post['nama_barang'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($post['image'] != null) {

            $params['image'] = $post['image']; # code...
        }

        $this->db->where('id_barcode', $post['id_barcode']);
        $this->db->update('tbl_barcode', $params);
    }

    function check_barcode($code, $id = null)
    {
        $this->db->from('tbl_barcode');
        $this->db->where('id_barcode', $code);
        if ($id != null) {
            $this->db->where('id_barcode !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('id_barcode', $id);
        $this->db->delete('tbl_barcode');
    }
}
