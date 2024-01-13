<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model{
    protected $_table = 'supplier'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'telp',
            'label' => 'Telepon',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Nomor {field} harus angka!'
            ]
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[4]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'required|is_unique[supplier.kode_supplier]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'is_unique' => '{field} supplier sudah dipakai!'
            ]
        ]
    ];
    protected $edit_rules = [
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[4]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'telp',
            'label' => 'Telepon',
            'rules' => 'required|numeric',
            'errors' => [
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
            $data = [
                'nama' => $this->input->post('nama'),
                'kode_supplier' => $this->input->post('kode'),
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
}