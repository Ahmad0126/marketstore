<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function index(){
        $this->template->load('layout/template', 'user_index', 'Daftar User');
    }
    public function add(){
        if($this->M_User->simpan()){
            $this->session->set_flashdata('alert', $this->template->buat_notif('User Berhasil Ditambahkan!', 'success'));
            redirect(base_url('user'));
        }else{
            $this->session->set_flashdata('alert', $this->template->buat_notif('User Gagal Ditambahkan!', 'danger'));
            redirect(base_url('user'));
        }
    }
}