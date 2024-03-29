<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    protected $_table = 'user'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|min_length[4]|is_unique[user.username]|max_length[25]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!',
                'is_unique' => '{field} sudah Dipakai!'
            ]
        ], 
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[4]|max_length[40]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 4 huruf!'
            ]
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|min_length[5]|max_length[60]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
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
            'rules' => 'required|min_length[4]|max_length[60]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
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
    public function get_user(){
        $this->db->order_by('id_user', 'DESC');
        return $this->db->get($this->_table)->result();
    }
    public function get_user_by_id($id){
        return $this->db->get_where($this->_table, array('user_id' => $id))->row();
    }
    public function getwup_user($user){
        return $this->db->get_where($this->_table, array('username' => $user))->row_array();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_user' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $this->validation_rules = $this->insert_rules;
        $validation_user = $this->validation();
        if ($validation_user){
            $data = [
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'nama' => $this->input->post('nama'),
                'level' => $this->input->post('level')
            ];
            return $this->insert_user($data);
        } else { return FALSE; }
    }
    private function insert_user($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $this->validation_rules = $this->edit_rules;
        $validation_user = $this->validation();
        if ($validation_user){
            $data = [
                'nama' => $this->input->post('nama'),
                'level' => $this->input->post('level')
            ];
            return $this->update_user($data);
        } else { return FALSE; }
    }
    public function reset(){
        return $this->update_user(array('password' => md5('12345678')));
    }
    public function edit_profile($data){
        $this->db->where('id_user',$this->session->userdata('id'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
    private function update_user($data){
        $this->db->where('id_user',$this->input->post('id_user'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
}