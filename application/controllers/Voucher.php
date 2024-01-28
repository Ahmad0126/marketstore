<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
	public function __construct(){
        parent::__construct();
		if($this->session->userdata('id') == null){ redirect(base_url('auth')); }
        $this->load->model('M_voucher');
    }

	//view
	public function index(){
		$data['voucher'] = $this->M_voucher->get_voucher();
		$this->template->load('layout/template', 'voucher_index', 'Daftar Voucher', $data);
	}

	//backend
	public function delete($id){
        if($this->M_voucher->delete($id)){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Voucher berhasil dihapus!', 'warning'));
			redirect(base_url('voucher'));
        }else{
            $this->session->set_flashdata('alert',$this->template->buat_notif('Voucher gagal dihapus!', 'danger'));
			redirect(base_url('voucher'));
        }
	}
	public function add(){
		if($this->M_voucher->simpan()){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Voucher berhasil ditambahkan!', 'success'));
			redirect(base_url('voucher'));
        } else {
            $this->session->set_flashdata('alert',$this->template->buat_notif(validation_errors(), 'danger'));
			redirect(base_url('voucher'));
        }
	}
	public function cek_voucher(){
		$voucher = $this->M_voucher->get_voucher_by_kode($this->input->post('kode_voucher'));
		if($voucher != null){
			if($voucher['used'] != 1){
				if($voucher['expired'] >= date('Y-m-d')){
					echo json_encode($voucher);
				} else { echo json_encode(array('status' => 'Voucher Sudah Kadaluawarsa pada tanggal '.$this->template->translate_bulan($voucher['expired']))); }
			} else { echo json_encode(array('status' => 'Voucher Sudah Dipakai')); }
        } else { echo json_encode(array('status' => 'Voucher Tidak Ada')); }
	}
	public function edit(){
		if($this->M_voucher->edit()){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Voucher berhasil diedit!', 'success'));
			redirect(base_url('voucher'));
        } else {
            $this->session->set_flashdata('alert',$this->template->buat_notif(validation_errors(), 'danger'));
			redirect(base_url('voucher'));
        }
	}
}
