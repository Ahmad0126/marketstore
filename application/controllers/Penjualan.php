<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != 'Admin'){
            redirect(base_url('auth'));
        }
        $this->load->model('M_transaksi');
    }
    public function index(){
        $this->load->model('M_pelanggan');
        $data['pelanggan'] = $this->M_pelanggan->get_pelanggan();
        $data['penjualan'] = $this->M_transaksi->get_penjualan();
        $this->template->load('layout/template', 'penjualan_index', 'Transaksi Penjualan', $data);
    }
    public function add(){
        $this->load->model('M_barang');
        $data['barang'] = $this->M_barang->get_barang();
        $this->template->load('layout/template', 'penjualan_form', 'Transaksi Penjualan', $data);
        $this->load->view('layout/transaksi_js');
    }
    public function member($id){
        $this->load->model('M_barang');
        $this->load->model('M_pelanggan');
        $data['barang'] = $this->M_barang->get_barang();
        $data['pelanggan'] = $this->M_pelanggan->get_pelanggan_by_id($id);
        $this->template->load('layout/template', 'penjualan_form_member', 'Transaksi Penjualan', $data);
        $this->load->view('layout/transaksi_js');
    }
    public function delete($kode){
        if($this->M_transaksi->delete_penjualan($kode)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Penjualan Berhasil Dihapus!', 'warning'));
            redirect(base_url('penjualan'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Penjualan Gagal Dihapus!', 'danger'));
            redirect(base_url('penjualan'));
        }
    }
    public function simpan(){
        if($this->M_transaksi->jual()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Penjualan Berhasil Ditambahkan!', 'success'));
            redirect(base_url('penjualan'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Penjualan Gagal Ditambahkan!', 'danger'));
            redirect(base_url('penjualan'));
        }
    }
    public function detail($id){
        $data['penjualan'] = $this->M_transaksi->get_penjualan_by_id($id);
        $data['detail'] = $this->M_transaksi->get_detail_penjualan($data['penjualan']['kode_penjualan']);
        $this->template->load('layout/template', 'penjualan_detail', 'Transaksi '.$data['penjualan']['kode_penjualan'], $data);
    }
}