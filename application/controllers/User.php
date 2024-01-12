<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_user');
    }
    public function index(){
        $data['users'] = $this->M_user->get_user();
        $this->template->load('layout/template', 'user_index', 'Daftar User', $data);
    }
    public function add(){
        if($this->M_user->simpan()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('User Berhasil Ditambahkan!', 'success'));
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('user'));
        }
    }
    public function edit(){
        if($this->M_user->edit()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('User Berhasil Diedit!', 'success'));
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif(validation_errors(), 'danger'));
            redirect(base_url('user'));
        }
    }
    public function delete($id){
        if($this->M_user->delete($id)){
            $this->session->set_flashdata('alert', $this->template->buat_notif('User Berhasil Dihapus!', 'warning'));
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('User Gagal Dihapus!', 'danger'));
            redirect(base_url('user'));
        }
    }
}