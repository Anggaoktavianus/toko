<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        not_login();


        $this->load->model(['m_stock', 'm_items', 'm_suplier', 'm_penjualan']);
    }
    public function sales()
    {
        $penjualan = $this->m_penjualan->get()->result();
        $item = $this->m_items->get()->result();
        $suplier = $this->m_suplier->get()->result();
        $data = [
            'item' => $item, 'suplier' => $suplier, 'penjualan' => $penjualan

        ];
        $this->template->load('template', 'transaksi/penjualan/penjualan', $data);
    }
    public function stock_in()
    {
        $data['row'] = $this->m_stock->get_stock_in()->result();
        $this->template->load('template', 'transaksi/stock_in/stock_in_index', $data);
    }

    public function stock_add()
    {
        $item = $this->m_items->get()->result();
        $suplier = $this->m_suplier->get()->result();
        $data = [
            'item' => $item, 'suplier' => $suplier

        ];
        $this->template->load('template', 'transaksi/stock_in/form_stock_in', $data);
    }

    public function stock_out()
    {
        $data['row'] = $this->m_stock->get_stock_out()->result();
        $this->template->load('template', 'transaksi/stock_out/stock_out_index', $data);
    }

    public function stock_out_add()
    {
        $item = $this->m_items->get()->result();
        $suplier = $this->m_suplier->get()->result();
        $data = [
            'item' => $item, 'suplier' => $suplier

        ];
        $this->template->load('template', 'transaksi/stock_out/form_stock_out', $data);
    }


    public function stock_del()
    {
        $stock_id = $this->uri->segment(3);
    }
    public function proses()
    {
        if (isset($_POST['in_add'])) {

            $post = $this->input->post(null, TRUE);
            $this->m_stock->add_stock_in($post);
            $this->m_items->update_stock_in($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('stock/in');
        } else {
            if (isset($_POST['out_add'])) {
                $post = $this->input->post(null, TRUE);
                $this->m_stock->add_stock_out($post);
                $this->m_items->update_stock_out($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                }
                redirect('stock/out');
            } else {
                $post = $this->input->post(null, TRUE);
                if ($this->m_items->check_stock($post['stock'])->num_rows() > 0) {
                    $this->session->set_flashdata('error', "Stock kurang dari $post[stock] ");
                    redirect('stock/out/add');
                }
            }
        }
    }
}
