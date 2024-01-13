<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('id') == null){
            redirect(base_url('auth'));
        }
    }
    public function index(){
        $this->template->load('layout/template', 'dashboard', 'Dashboard');
    }
}