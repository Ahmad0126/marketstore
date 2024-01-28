<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_voucher extends CI_Model{
    protected $_table = 'voucher'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'potongan',
            'label' => 'Potongan Harga',
            'rules' => 'required|integer',
            'errors' => [
                'required' => '{field}nya dikasih berapa?!',
                'integer' => '{field} harus angka!'
            ]
        ],
        [
            'field' => 'expired',
            'label' => 'Tanggal Berlaku',
            'rules' => 'required',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
            ]
        ],
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'required|min_length[4]|max_length[10]|is_unique[voucher.kode_voucher]',
            'errors' => [
                'required' => 'Tolong kasih {field} voucher!',
                'is_unique' => '{field} voucher sudah dipakai!',
                'max_length' => '{field} voucher kepanjangan, maximal 10 digit!',
                'min_length' => 'Kasih {field} voucher minimal 4 digit!'
            ]
        ]
    ];
    protected $edit_rules = [
        [
            'field' => 'potongan',
            'label' => 'Potongan Harga',
            'rules' => 'required|integer',
            'errors' => [
                'required' => '{field}nya dikasih berapa?!',
                'integer' => '{field} harus angka!'
            ]
        ],
        [
            'field' => 'expired',
            'label' => 'Tanggal Berlaku',
            'rules' => 'required',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
            ]
        ],
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'min_length[4]|max_length[10]',
            'errors' => [
                'max_length' => '{field} voucher kepanjangan, maximal 10 digit!',
                'min_length' => 'Kasih {field} voucher minimal 4 digit!'
            ]
        ]
    ];
    protected $validation_rules;

    //validation form
    private function validation(){
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run() == TRUE){
            $data = [
                'potongan' => $this->input->post('potongan'),
                'kode_voucher' => $this->input->post('kode'),
                'expired' => $this->input->post('expired')
            ];
            return $data;
        }
        return FALSE;
    }
    
    //Read
    public function get_voucher(){
        return $this->db->get($this->_table)->result();
    }
    public function get_voucher_by_kode($kode){
        return $this->db->get_where($this->_table, array('kode_voucher' => $kode))->row_array();
    }
    public function get_voucher_by_id($id){
        return $this->db->get_where($this->_table, array('id_voucher' => $id))->row_array();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_voucher' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $this->validation_rules = $this->insert_rules;
        $validation_voucher = $this->validation();
        if ($validation_voucher){
            return $this->insert_voucher($validation_voucher);
        } else { return FALSE; }
    }
    private function insert_voucher($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $this->validation_rules = $this->edit_rules;
        $validation_voucher = $this->validation();
        if ($validation_voucher){
            return $this->update_voucher($validation_voucher);
        } else { return FALSE; }
    }
    public function use_voucher(){
        $data = array('used' => 1);
        $this->update_voucher($data);
    }
    private function update_voucher($data){
        $this->db->where('id_voucher', $this->input->post('id_voucher'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
}