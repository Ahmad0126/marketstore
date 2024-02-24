<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('id') == null){
            redirect(base_url('auth'));
        }else if($this->session->userdata('level') != 'Admin'){
            show_404();
        }
        $this->load->model('M_transaksi');
    }
    public function index(){
        $this->load->model('M_barang');
        $this->load->model('M_supplier');
        $data['supplier'] = $this->M_supplier->count_supplier();
        $data['barang'] = $this->M_barang->count_barang();
        $data['pembelian'] = $this->M_transaksi->get_pembelian();
        $this->template->load('layout/template', 'pembelian_index', 'Transaksi Pembelian', $data);
    }
    public function add(){
        $this->load->model('M_barang');
        $this->load->model('M_supplier');
        $data['barang'] = $this->M_barang->get_barang();
        $data['suppliers'] = $this->M_supplier->get_supplier();
        $this->template->load('layout/template', 'pembelian_form', 'Transaksi Pembelian', $data);
        $this->load->view('layout/transaksi_js');
    }
    public function delete($kode){
        if($this->M_transaksi->delete_pembelian($kode)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Pembelian Berhasil Dihapus!', 'warning'));
            redirect(base_url('pembelian'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Pembelian Gagal Dihapus!', 'danger'));
            redirect(base_url('pembelian'));
        }
    }
    public function simpan(){
        if($this->M_transaksi->beli()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Pembelian Berhasil Ditambahkan!', 'success'));
            redirect(base_url('pembelian'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Pembelian Gagal Ditambahkan!', 'danger'));
            redirect(base_url('pembelian'));
        }
    }
    public function detail($id){
        $data['pembelian'] = $this->M_transaksi->get_pembelian_by_id($id);
        $data['detail'] = $this->M_transaksi->get_detail_pembelian($data['pembelian']['kode_pembelian']);
        $this->template->load('layout/template', 'pembelian_detail', 'Transaksi '.$data['pembelian']['kode_pembelian'], $data);
    }
}