<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laba extends CI_Model
{
public function get_by_jumlah()

    {
	    
        $sql =
            "SELECT a.date, a.created_at, SUM(a.d_jual_total) as total FROM tbl_detail_jual a WHERE a.date BETWEEN a.date AND a.date ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            $data = array();
        }

        return $data;
    }



// <!--  -->
}