<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model{
    protected $_table = 'barang'; //DB table
    protected $table1 = 'kategori'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|min_length[4]|is_unique[user.username]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!',
                'is_unique' => '{field} sudah Dipakai!'
            ]
        ], 
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[4]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 5 huruf!'
            ]
        ],
        [
            'field' => 'level',
            'label' => 'Level',
            'rules' => 'in_list[Admin,Kasir]'
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
            'field' => 'level',
            'label' => 'Level',
            'rules' => 'required|in_list[Admin,Kasir]'
        ]
    ];
    protected $kategori_rules = [
        [
            'field' => 'kategori',
            'label' => 'Kategori',
            'rules' => 'required|is_unique[kategori.kategori]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'is_unique' => '{field} sudah Dipakai!'
            ]
        ],
        
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

    //Bagian Kategori
    //Read
    public function get_kategori(){
        return $this->db->get($this->table1)->result();
    }
    public function get_kategori_by_id($id){
        return $this->db->get_where($this->table1, array('id_kategori' => $id))->row_array();
    }

    //Delete
    public function delete_kategori($id){
        $this->db->delete($this->table1, array('id_kategori' => $id));
        return TRUE;
    }

    //Insert
    public function simpan_kategori(){
        $this->validation_rules = $this->kategori_rules;
        $validation_kategori = $this->validation();
        if ($validation_kategori){
            $data = [
                'kategori' => $this->input->post('kategori')
            ];
            return $this->insert_kategori($data);
        } else { return FALSE; }
    }
    private function insert_kategori($data){
        $this->db->insert($this->table1, $data);
        return TRUE;
    }
    
    //Update
    public function edit_kategori(){
        $this->db->select('kategori');
        $this->db->from($this->table1);
        $this->db->where('kategori', $this->input->post('kategori'));
        $kategori_lain = $this->db->get()->row_array();
        $kategori = $this->get_kategori_by_id($this->input->post('id_kategori'));
        if ($kategori_lain == null || $kategori['kategori'] == $this->input->post('kategori')){
            $data = [
                'kategori' => $this->input->post('kategori')
            ];
            return $this->update_kategori($data);
        } else {
            return FALSE; 
        }
    }
    private function update_kategori($data){
        $this->db->where('id_kategori',$this->input->post('id_kategori'));
        $this->db->update($this->table1, $data);
        return TRUE;
    }
    
    //Bagian barang
    //Read
    public function get_barang(){
        return $this->db->get($this->_table)->result();
    }
    public function get_barang_by_id($id){
        return $this->db->get_where($this->_table, array('user_id' => $id))->row();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_barang' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $this->validation_rules = $this->insert_rules;
        $validation_barang = $this->validation();
        if ($validation_barang){
            $data = [

            ];
            return $this->insert_barang($data);
        } else { return FALSE; }
    }
    private function insert_barang($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $this->validation_rules = $this->edit_rules;
        $validation_barang = $this->validation();
        if ($validation_barang){
            $data = [
                
            ];
            return $this->update_barang($data);
        } else { return FALSE; }
    }
    private function update_barang($data){
        $this->db->where('id_barang',$this->input->post('id_barang'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
}