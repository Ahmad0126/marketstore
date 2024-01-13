<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct(){
        parent::__construct();
		if($this->session->userdata('id') == null){ redirect(base_url('auth')); }
        $this->load->model('M_barang');
    }

	//view
	public function index(){
		$data['kategori'] = $this->M_barang->get_kategori();
		$this->template->load('layout/template', 'kategori_index', 'Kategori Barang', $data);
	}

	//backend
	public function delete($id){
        if($this->M_barang->delete_kategori($id)){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Kategori berhasil dihapus!', 'warning'));
			redirect(base_url('kategori'));
        }else{
            $this->session->set_flashdata('alert',$this->template->buat_notif('Kategori gagal dihapus!', 'danger'));
			redirect(base_url('kategori'));
        }
	}
	public function add(){
		if($this->M_barang->simpan_kategori()){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Kategori berhasil ditambahkan!', 'success'));
			redirect(base_url('kategori'));
        } else {
            $this->session->set_flashdata('alert',$this->template->buat_notif(validation_errors(), 'danger'));
			redirect(base_url('kategori'));
        }
	}
	public function edit(){
		if($this->M_barang->edit_kategori()){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Kategori berhasil diedit!', 'success'));
			redirect(base_url('kategori'));
        } else {
            $this->session->set_flashdata('alert',$this->template->buat_notif('Kategori Sudah Dipakai!', 'danger'));
			redirect(base_url('kategori'));
        }
	}
}
