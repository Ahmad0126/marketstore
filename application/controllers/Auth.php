<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    public function index(){
        $this->load->view('login');
    }
    public function login(){
        $this->load->model('M_user');
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $data = $this->M_user->getwup_user($user);
        if($data){
            if($data['password'] == md5($pass)){
                $this->session->set_userdata('level', $data['level']);
                $this->session->set_userdata('id', $data['id_user']);
                $this->session->set_userdata('nama', $data['nama']);
                $this->session->set_userdata('username', $data['username']);
                $this->session->set_userdata('profil', $data['profil']);
                redirect(base_url());
            }else{
                $this->session->set_flashdata('username_val', $user);
                $this->session->set_flashdata('password', 'Password Salah!');
                redirect(base_url('auth'));
            }
        }else{
            $this->session->set_flashdata('username_val', $user);
            $this->session->set_flashdata('username', 'Username Tidak Terdaftar!');
            redirect(base_url('auth'));
        }
    }
    public function logout(){
        $user = array('level', 'id', 'nama', 'username', 'profil');
        $this->session->unset_userdata($user);
        redirect(base_url('auth'));
    }
    public function err(){
        $this->load->view('errors/html/err_404');
    }

    //JSON Monitor
    public function cek_voucher(){
        $this->load->model('M_voucher');
		$voucher = $this->M_voucher->get_voucher_by_kode($this->input->post('kode_voucher'));
		if($voucher != null){
			if($voucher['used'] != 1){
				if($voucher['expired'] >= date('Y-m-d')){
					echo json_encode($voucher);
				} else { echo json_encode(array('status' => 'Voucher Sudah Kadaluawarsa pada tanggal '.$this->template->translate_bulan($voucher['expired']))); }
			} else { echo json_encode(array('status' => 'Voucher Sudah Dipakai')); }
        } else { echo json_encode(array('status' => 'Voucher Tidak Ada')); }
	}
    public function cek_poin(){
        $this->load->model('M_pelanggan');
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
    public function get_barang(){
        $this->load->model('M_barang');
        $data = array();
        $barang = $this->M_barang->get_barang();
        foreach($barang as $b){
            array_push($data, $b->nama);
        }
        echo json_encode($data);
    }
    public function lihat_barang(){
        $this->load->model('M_barang');
        if($this->input->post('nama') == null){
            echo json_encode(array('status' => 'Masukkan nama barang!'));
            return;
        }
        if($this->input->post('jumlah') == null){
            echo json_encode(array('status' => 'Jumlahnya berapa?!'));
            return;
        }
        if($this->input->post('jumlah') <= 0){
            echo json_encode(array('status' => 'Jumlah barang minimal 1!'));
            return;
        }
        $barang = $this->M_barang->get_barang_by_name($this->input->post('nama'));
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
        $this->load->model('M_barang');
        if($this->input->post('nama') == null){
            echo json_encode(array('status' => 'Masukkan nama barang!'));
            return;
        }
        if($this->input->post('jumlah') == null){
            echo json_encode(array('status' => 'Jumlahnya berapa?!'));
            return;
        }
        if($this->input->post('jumlah') <= 0){
            echo json_encode(array('status' => 'Jumlah barang minimal 1!'));
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