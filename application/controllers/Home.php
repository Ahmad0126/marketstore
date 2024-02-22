<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('id') == null){
            redirect(base_url('auth'));
        }
        $this->load->model('M_user');
    }
    public function index(){
        $this->load->model('M_transaksi');
        $this->load->model('M_barang');
        $this->load->model('M_supplier');
        $this->load->model('M_pelanggan');
        $data = [
            'pelanggan' => $this->M_pelanggan->count_pelanggan(),
            'barang' => $this->M_barang->count_barang(),
            'supplier' => $this->M_supplier->count_supplier(),
            'pj_bulan' => $this->M_transaksi->count_total_penjualan_bulan_ini()['sum(total_tagihan)'],
            'pj_hari' => $this->M_transaksi->count_total_penjualan_hari_ini()['sum(total_tagihan)'],
            'pb_bulan' => $this->M_transaksi->count_total_pembelian_bulan_ini()['sum(total_tagihan)'],
            'pb_hari' => $this->M_transaksi->count_total_pembelian_hari_ini()['sum(total_tagihan)'],
            'pj_recent' => $this->M_transaksi->get_recent_penjualan(),
            'terjual' => $this->M_transaksi->count_terjual(),
            'terbeli' => $this->M_transaksi->count_terbeli(),
            'barang_terlaris' => $this->M_barang->get_list_barang_terlaris()
        ];
        $this->template->load('layout/template', 'dashboard', 'Dashboard', $data);
        $this->load->view('layout/dashboard_js');
    }
    public function profil(){
        $data['user'] = $this->M_user->getwup_user($this->session->userdata('username'));
        $this->template->load('layout/template', 'profil', 'Profil', $data);
    }
    public function update_user(){
        $data = array();
        if($_FILES['profil']['name'] != ''){
            if($_FILES['profil']['size'] >= 500 * 1024){
                $this->session->set_flashdata('alert', $this->template->buat_notif('Ukuran foto terlalu besar!', 'danger'));
                redirect(base_url('home/profil'));
            }
            $namafoto = '2_'.$this->session->userdata('username').'.jpg';
            $config['upload_path'] = 'assets/upload/profil';
            $config['max_size'] = 500 * 1024;
            $config['overwrite'] = true;
            $config['file_name'] = $namafoto;
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('profil')){
                $this->session->set_flashdata('alert', $this->template->buat_notif('Foto profil gagal diganti!', 'danger'));
                redirect(base_url('home/profil'));
            }
            $this->session->set_userdata('profil', $namafoto);
            $data += array('profil' => $namafoto);
        }
        $data += array('nama' => $this->input->post('nama'));
        $this->M_user->edit_profile($data);
        $this->session->set_userdata('nama', $this->input->post('nama'));
        $this->session->set_flashdata('alert', $this->template->buat_notif('Profil berhasil diubah!', 'success'));
        redirect(base_url('home/profil'));
    }
    public function update_pass(){
        $pass = $this->input->post('password');
        $pl = $this->input->post('pl');
        $pk = $this->input->post('pk');
		$cek = $this->M_user->getwup_user($this->session->userdata('username'));
        if($cek){
            if(md5($pl) == $cek['password']){
                if($pass == $pk){
                    $this->M_user->edit_profile(array('password' => md5($pass)));
                    $this->session->set_flashdata('alert', $this->template->buat_notif('Password berhasil diubah!', 'success'));
                    redirect(base_url('home/profil'));
                }else{
                    $this->session->set_flashdata('pl_val', $pl);
                    $this->session->set_flashdata('pp_val', $pass);
                    $this->session->set_flashdata('pk_val', $pk);
                    $this->session->set_flashdata('konf', 'Password Tidak Sama!');
                    $this->session->set_flashdata('alert', $this->template->buat_notif('Konfirmasi Password Baru Kembali!', 'danger'));
                    redirect(base_url('home/profil'));
                }
            }else{
                $this->session->set_flashdata('pl_val', $pl);
                $this->session->set_flashdata('pp_val', $pass);
                $this->session->set_flashdata('pk_val', $pk);
                $this->session->set_flashdata('password', 'Password Salah!');
                $this->session->set_flashdata('alert', $this->template->buat_notif('Password Lama Salah!', 'danger'));
                redirect(base_url('home/profil'));
            }
        }
    }
    public function laporan_transaksi(){
        $this->load->model('M_transaksi');
        $data = $this->M_transaksi->get_pp_data();
        echo json_encode($data);
    }
    public function laporan_pemilu(){
        $this->load->model('M_suara');
        $data = $this->M_suara->get_laporan();
        echo json_encode($data);
    }
    public function jumlah_transaksi(){
        $this->load->model('M_transaksi');
        $data = $this->M_transaksi->get_pp_jumlah();
        echo json_encode($data);
    }
    public function get_recent_tr($transaksi){
        $this->load->model('M_transaksi');
        $data = array();
        if($transaksi == 'penjualan'){
            $data = [
                'kategori' => 'penjualan',
                'transaksi' => $this->M_transaksi->get_recent_penjualan()
            ];
        }else{
            $data = [
                'kategori' => 'pembelian',
                'transaksi' => $this->M_transaksi->get_recent_pembelian()
            ];
        }
        echo json_encode($data);
    }
}