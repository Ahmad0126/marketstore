<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model{
    protected $table1 = 'pembelian'; //DB tables
    protected $table2 = 'penjualan'; //DB tables
    protected $table3 = 'supplier'; //DB tables

    //validation rules
    protected $insert_rules = [
        [
            'field' => 'harga_jual',
            'label' => 'Harga Jual',
            'rules' => 'required|integer|min_length[3]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
            ]
        ],
        [
            'field' => 'harga_beli',
            'label' => 'Harga Beli',
            'rules' => 'required|integer|min_length[3]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
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
            'rules' => 'required|integer|min_length[3]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
            ]
        ],
        [
            'field' => 'harga_beli',
            'label' => 'Harga Beli',
            'rules' => 'required|integer|min_length[3]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'integer' => 'Kasih {field} yang valid!',
                'min_length' => '{field} minimal Rp100!'
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
    public function get_pembelian(){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join($this->table3, $this->table3.'.kode_supplier = '.$this->table1.'.kode_supplier');
        return $this->db->get()->result();
    }
    public function get_pembelian_by_id($id){
        return $this->db->get_where($this->table1, array('id_pembelian' => $id))->row_array();
    }

    //Delete
    public function delete_pembelian($id){
        $this->db->delete($this->table1, array('id_pembelian' => $id));
        return TRUE;
    }

    //Insert
    public function simpan_pembelian(){
        $this->validation_rules = $this->pembelian_rules;
        $validation_pembelian = $this->validation();
        if ($validation_pembelian){
            $data = [
                'pembelian' => $this->input->post('pembelian')
            ];
            return $this->insert_pembelian($data);
        } else { return FALSE; }
    }
    private function insert_pembelian($data){
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
        if ($validation_barang){
            $data = [
                'nama' => $this->input->post('nama'),
                'id_kategori' => $this->input->post('kategori'),
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