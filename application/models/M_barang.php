<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model{
    protected $_table = 'barang'; //Main DB table
    protected $table1 = 'kategori'; //DB table

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'harga_jual',
            'label' => 'Harga Jual',
            'rules' => 'required|integer|min_length[3]|max_length[11]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
            ]
        ],
        [
            'field' => 'harga_beli',
            'label' => 'Harga Beli',
            'rules' => 'required|integer|min_length[3]|max_length[11]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
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
            'field' => 'kategori',
            'label' => 'Kategori',
            'rules' => 'required',
            'errors' => [
                'required' => 'Tolong kasih {field}!'
            ]
        ],
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'exact_length[15]|is_unique[barang.kode_barang]',
            'errors' => [
                'is_unique' => '{field} barang sudah dipakai!',
                'exact_length' => '{field} harus berisi 15 digit!'
            ]
        ]
    ];
    protected $edit_rules = [
        [
            'field' => 'harga_jual',
            'label' => 'Harga Jual',
            'rules' => 'required|integer|min_length[3]|max_length[11]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
            ]
        ],
        [
            'field' => 'harga_beli',
            'label' => 'Harga Beli',
            'rules' => 'required|integer|min_length[3]|max_length[11]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
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
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'exact_length[15]',
            'errors' => [
                'exact_length' => '{field} harus berisi 15 digit!'
            ]
        ],
        [
            'field' => 'kategori',
            'label' => 'Kategori',
            'rules' => 'required',
            'errors' => [
                'required' => 'Tolong kasih {field}!'
            ]
        ]
    ];
    protected $kategori_rules = [
        [
            'field' => 'kategori',
            'label' => 'Kategori',
            'rules' => 'required|is_unique[kategori.kategori]|max_length[20]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
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
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join($this->table1, $this->_table.'.id_kategori = '.$this->table1.'.id_kategori');
        return $this->db->get()->result();
    }
    public function get_stok($kode){
        return $this->db->get_where($this->_table, array('kode_barang' => $kode))->row_array();
    }
    public function get_barang_by_id($id){
        return $this->db->get_where($this->_table, array('id_barang' => $id))->row_array();
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
            if($this->input->post('kode') == ''){
                $code = $this->generate_code();
            }else{ $code = $this->input->post('kode'); }
            $data = [
                'kode_barang' => $code,
                'nama' => $this->input->post('nama'),
                'id_kategori' => $this->input->post('kategori'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual'),
                'stok' => 0
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
        $kode_lain = $this->get_stok($this->input->post('kode'));
        $kode = $this->get_barang_by_id($this->input->post('id_barang'));
        if ($validation_barang && ($kode_lain == null || $kode['kode_barang'] == $this->input->post('kode'))){
            $data = [
                'nama' => $this->input->post('nama'),
                'id_kategori' => $this->input->post('kategori'),
                'kode_barang' => $this->input->post('kode'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_jual' => $this->input->post('harga_jual')
            ];
            return $this->update_barang($data);
        } else { return FALSE; }
    }
    private function update_barang($data){
        $this->db->where('id_barang',$this->input->post('id_barang'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
    public function update_stok_barang($data, $id){
        $this->db->where('kode_barang',$id);
        $this->db->update($this->_table, $data);
        return TRUE;
    }

    //generator
    private function generate_code(){
        $tanggal = date('sdy');
        $kategori = $this->input->post('kategori');
        $h_jual = substr($this->input->post('harga_jual'), 0, 2).rand(0, 9);
        $h_beli = substr($this->input->post('harga_beli'), 0, 2).rand(0, 9);
        $code = 'B-'.$tanggal.$kategori.$h_beli.$h_jual;
        $is_code = $this->db->get_where($this->_table, array('kode_barang' => $code))->row_array();
        if($is_code){
            $harga_j = intval($h_jual) + rand(0, 9);
            $harga_b = intval($h_beli) + rand(0, 9);
            return 'B-'.$tanggal.$kategori.$harga_b.$harga_j;
        }
        return $code;
    }
}