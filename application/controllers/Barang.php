<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != 'Admin'){
            redirect(base_url('auth'));
        }
        $this->load->model('M_barang');
    }
    public function index(){
        $data['barang'] = $this->M_barang->get_barang();
        $data['kategori'] = $this->M_barang->get_kategori();
        $this->template->load('layout/template', 'barang_index', 'Daftar Barang', $data);
    }
    public function add(){
        if($this->M_barang->simpan()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Barang Berhasil Ditambahkan!', 'success'));
            redirect(base_url('barang'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('barang'));
        }
    }
    public function edit(){
        if($this->M_barang->edit()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Barang Berhasil Diedit!', 'success'));
            redirect(base_url('barang'));
        }else{
            if(validation_errors() == null){
                $pesan = "Kode barang sudah dipakai!";
            }else{
                $pesan = validation_errors();
            }
            $this->session->set_flashdata('alert', $this->template->buat_notif($pesan, 'danger'));
            redirect(base_url('barang'));
        }
    }
    public function delete($id){
        if($this->M_barang->delete($id)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Barang Berhasil Dihapus!', 'warning'));
            redirect(base_url('barang'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Barang Gagal Dihapus!', 'danger'));
            redirect(base_url('barang'));
        }
    }
    public function get_barang(){
        $data = array();
        $barang = $this->M_barang->get_barang();
        foreach($barang as $b){
            array_push($data, $b->nama);
        }
        echo json_encode($data);
    }
    public function lihat_barang(){
        if($this->input->post('nama') == null){
            echo json_encode(array('status' => 'Masukkan nama barang!'));
            return;
        }
        $barang = $this->M_barang->get_barang_by_name($this->input->post('nama'));
        if($this->input->post('jumlah') == null){
            echo json_encode(array('status' => 'Jumlahnya berapa?!'));
            return;
        }
        if($barang == null){
            echo json_encode(array('status' => 'Barang tidak terdaftar!'));
            return;
        }
        $stok = $barang['stok'] < $this->input->post('jumlah');
        if($stok){
            echo json_encode(array('status' => 'Barang melebihi stok!'));
            return;
        }
        echo json_encode(array_merge($barang, array('jumlah' => $this->input->post('jumlah'))));
    }
    public function ambil_barang(){
        if($this->input->post('nama') == null){
            echo json_encode(array('status' => 'Masukkan nama barang!'));
            return;
        }
        if($this->input->post('jumlah') == null){
            echo json_encode(array('status' => 'Jumlahnya berapa?!'));
            return;
        }
        $barang = $this->M_barang->get_barang_by_name($this->input->post('nama'));
        if($barang == null){
            echo json_encode(array('status' => 'Barang tidak terdaftar!'));
            return;
        }
        echo json_encode(array_merge($barang, array('jumlah' => $this->input->post('jumlah'))));
    }
}