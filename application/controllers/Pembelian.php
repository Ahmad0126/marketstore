<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != 'Admin'){
            redirect(base_url('auth'));
        }
        $this->load->model('M_transaksi');
    }
    public function index(){
        $data['pembelian'] = $this->M_transaksi->get_pembelian();
        $this->template->load('layout/template', 'pembelian_index', 'Transaksi Pembelian', $data);
    }
    public function add(){
        $this->load->model('M_barang');
        $data['barang'] = $this->M_barang->get_barang();
        $this->template->load('layout/template', 'pembelian_form', 'Transaksi Pembelian', $data);
    }
    public function simpan(){
        if($this->M_transaksi->beli()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Data Pembelian Berhasil Ditambahkan!', 'success'));
            redirect(base_url('pembelian'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('pembelian'));
        }
    }
    public function delete($id){
        if($this->M_transaksi->delete($id)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Pembelian Berhasil Dihapus!', 'warning'));
            redirect(base_url('pembelian'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Pembelian Gagal Dihapus!', 'danger'));
            redirect(base_url('pembelian'));
        }
    }
}