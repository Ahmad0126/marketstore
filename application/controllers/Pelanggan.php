<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != 'Admin'){
            redirect(base_url('auth'));
        }
        $this->load->model('M_pelanggan');
    }
    public function index(){
        $data['pelanggan'] = $this->M_pelanggan->get_pelanggan();
        $this->template->load('layout/template', 'pelanggan_index', 'Daftar Pelanggan', $data);
    }
    public function riwayat($id){
        $this->load->model('M_transaksi');
        $data['pelanggan'] = $this->M_pelanggan->get_pelanggan_by_id($id);
        $data['transaksi'] = $this->M_transaksi->get_penjualan_by_member($id);
        $this->template->load('layout/template', 'pelanggan_riwayat', 'Riwayat Transaksi Pelanggan', $data);
    }
    public function add(){
        if($this->M_pelanggan->simpan()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Pelanggan Berhasil Ditambahkan!', 'success'));
            redirect(base_url('pelanggan'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('pelanggan'));
        }
    }
    public function edit(){
        if($this->M_pelanggan->edit()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Pelanggan Berhasil Diedit!', 'success'));
            redirect(base_url('pelanggan'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('pelanggan'));
        }
    }
    public function delete($id){
        if($this->M_pelanggan->delete($id)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Pelanggan Berhasil Dihapus!', 'warning'));
            redirect(base_url('pelanggan'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Pelanggan Gagal Dihapus!', 'danger'));
            redirect(base_url('pelanggan'));
        }
    }
    public function cek_poin(){
        if($this->input->post('nama') == null){
            echo json_encode(array('status' => 'Pelanggan Tidak Diketahui!'));
            return;
        }
        if($this->input->post('jumlah') == null){
            echo json_encode(array('status' => 'Poinnya berapa?!'));
            return;
        }
        $pelanggan = $this->M_pelanggan->get_pelanggan_by_id($this->input->post('nama'));
        if($pelanggan == null){
            echo json_encode(array('status' => 'Pelanggan tidak punya poin!'));
            return;
        }
        $poin = $pelanggan->poin < $this->input->post('jumlah');
        if($poin){
            echo json_encode(array('status' => 'Poin tidak mencukupi!'));
            return;
        }
        echo json_encode(array('jumlah' => $this->input->post('jumlah')));
    }
}