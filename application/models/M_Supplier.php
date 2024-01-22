<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model{
    protected $_table = 'supplier'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'telp',
            'label' => 'Telepon',
            'rules' => 'required|numeric|max_length[20]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Nomor {field} harus angka!'
            ]
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[4]|max_length[60]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'exact_length[12]|is_unique[supplier.kode_supplier]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'is_unique' => '{field} supplier sudah dipakai!',
                'exact_length' => '{field} harus berisi 12 digit!'
            ]
        ]
    ];
    protected $edit_rules = [
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[4]|max_length[60]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'telp',
            'label' => 'Telepon',
            'rules' => 'required|numeric|max_length[20]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Nomor {field} harus angka!'
            ]
        ]
    ];
    protected $validation_rules;

    //validation form
    private function validation(){
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run() == TRUE){
            if($this->input->post('kode') == ''){
                $code = $this->generate_code();
            }else{ $code = $this->input->post('kode'); }
            $data = [
                'nama' => $this->input->post('nama'),
                'kode_supplier' => $code,
                'telp' => $this->input->post('telp')
            ];
            return $data;
        }
        return FALSE;
    }
    
    //Read
    public function get_supplier(){
        return $this->db->get($this->_table)->result();
    }
    public function get_supplier_by_id($id){
        return $this->db->get_where($this->_table, array('id_supplier' => $id))->row();
    }
    public function getwup_supplier($supplier){
        return $this->db->get_where($this->_table, array('suppliername' => $supplier))->row_array();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_supplier' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $this->validation_rules = $this->insert_rules;
        $validation_supplier = $this->validation();
        if ($validation_supplier){
            return $this->insert_supplier($validation_supplier);
        } else { return FALSE; }
    }
    private function insert_supplier($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $this->validation_rules = $this->edit_rules;
        $validation_supplier = $this->validation();
        if ($validation_supplier){
            return $this->update_supplier($validation_supplier);
        } else { return FALSE; }
    }
    private function update_supplier($data){
        $this->db->where('id_supplier',$this->input->post('id_supplier'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }

    //generator
    private function generate_code(){
        $tanggal = date('sdy');
        $telp = substr($this->input->post('telp'), -4);
        $code = 'S-'.$tanggal.$telp;
        $is_code = $this->db->get_where($this->_table, array('kode_supplier' => $code))->row_array();
        if($is_code){
            $telp = substr($this->input->post('telp'), rand(-1, -5), 4);
            return 'S-'.$tanggal.$telp;
        }
        return $code;
    }
}