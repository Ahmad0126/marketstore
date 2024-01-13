<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level') != 'Admin'){
            redirect(base_url('auth'));
        }
        $this->load->model('M_supplier');
    }
    public function index(){
        $data['suppliers'] = $this->M_supplier->get_supplier();
        $this->template->load('layout/template', 'supplier_index', 'Daftar Supplier', $data);
    }
    public function add(){
        if($this->M_supplier->simpan()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Supplier Berhasil Ditambahkan!', 'success'));
            redirect(base_url('supplier'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('supplier'));
        }
    }
    public function edit(){
        if($this->M_supplier->edit()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Supplier Berhasil Diedit!', 'success'));
            redirect(base_url('supplier'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('supplier'));
        }
    }
    public function delete($id){
        if($this->M_supplier->delete($id)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('Supplier Berhasil Dihapus!', 'warning'));
            redirect(base_url('supplier'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('Supplier Gagal Dihapus!', 'danger'));
            redirect(base_url('supplier'));
        }
    }
}