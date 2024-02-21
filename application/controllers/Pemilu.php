<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilu extends CI_Controller {
	public function __construct(){
        parent::__construct();
		if($this->session->userdata('id') == null){
            redirect(base_url('auth'));
        }else if($this->session->userdata('level') != 'Admin'){
            show_404();
        }
        $this->load->model('M_suara');
    }

	//view
	public function index(){
		$this->template->load('layout/template', 'suara_index', 'Rekap Suara Pemilu');
	}

	//backend
	public function add(){
		if($this->M_suara->simpan()){
			$this->session->set_flashdata('alert',$this->template->buat_notif('Data suara berhasil direkap!', 'success'));
			redirect(base_url('pemilu'));
        } else {
			redirect(base_url('pemilu'));
        }
	}
}
