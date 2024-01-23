<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model{
    protected $_table = 'pelanggan'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'telp',
            'label' => 'Telepon',
            'rules' => 'required|numeric|max_length[18]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Nomor {field} harus angka!'
            ]
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[4]|max_length[40]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required|max_length[200]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
            ]
        ]
    ];
    protected $edit_rules = [
        [
            'field' => 'telp',
            'label' => 'Telepon',
            'rules' => 'required|numeric|max_length[18]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Nomor {field} harus angka!'
            ]
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[4]|max_length[40]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required|max_length[200]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
            ]
        ]
    ];
    protected $validation_rules;

    //validation form
    private function validation(){
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run() == TRUE){
            return TRUE;
        }
        return FALSE;
    }
    
    //Read
    public function get_pelanggan(){
        return $this->db->get($this->_table)->result();
    }
    public function get_pelanggan_by_id($id){
        return $this->db->get_where($this->_table, array('id_pelanggan' => $id))->row();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_pelanggan' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $this->validation_rules = $this->insert_rules;
        $validation_pelanggan = $this->validation();
        if ($validation_pelanggan){
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'poin' => 0,
                'telp' => $this->input->post('telp')
            ];
            return $this->insert_pelanggan($data);
        } else { return FALSE; }
    }
    private function insert_pelanggan($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $this->validation_rules = $this->edit_rules;
        $validation_pelanggan = $this->validation();
        if ($validation_pelanggan){
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp')
            ];
            return $this->update_pelanggan($data);
        } else { return FALSE; }
    }
    public function update_poin($poin){
        $data = [
            'poin' => $poin
        ];
        return $this->update_pelanggan($data);
    }
    private function update_pelanggan($data){
        $this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
}