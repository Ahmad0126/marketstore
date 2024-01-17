<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model{
    protected $table1 = 'pembelian'; //DB tables
    protected $table2 = 'penjualan';
    protected $table3 = 'supplier';
    protected $table4 = 'detail_pembelian';
    protected $table5 = 'detail_ penjualan';
    protected $table6 = 'barang';

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

    //Bagian Pembelian
    //Read
    public function get_pembelian(){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join($this->table3, $this->table3.'.kode_supplier = '.$this->table1.'.kode_supplier');
        return $this->db->get()->result();
    }
    public function get_pembelian_by_id($id){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join($this->table3, $this->table3.'.kode_supplier = '.$this->table1.'.kode_supplier');
        $this->db->where('id_pembelian', $id);
        return $this->db->get()->row_array();
    }
    public function get_detail_pembelian($kode){
        $this->db->select('*');
        $this->db->from($this->table4);
        $this->db->join($this->table6, $this->table6.'.kode_barang = '.$this->table4.'.kode_barang');
        $this->db->where('kode_pembelian', $kode);
        return $this->db->get()->result();
    }

    //Delete
    public function delete_pembelian($kode){
        $this->load->model('M_barang');
        $detail = $this->get_detail_pembelian($kode);
        foreach($detail as $d){
            $stok = $this->M_barang->get_stok($d->kode_barang);
            $stok_akhir = $stok['stok'] - $d->jumlah;
            $this->M_barang->update_stok_barang(array('stok' => $stok_akhir), $d->kode_barang);
        }
        $this->db->delete($this->table4, array('kode_pembelian' => $kode));
        $this->db->delete($this->table1, array('kode_pembelian' => $kode));
        return TRUE;
    }

    //Insert
    public function beli(){
        $this->load->model('M_barang');
        $kode_beli = $this->generate_code();
        $total = 0;
        $kode_barang = $this->input->post('kode_barang');
        $jumlah = $this->input->post('jumlah');
        $harga = $this->input->post('harga');
        for($i = 0; $i < count($kode_barang); $i++){
            $data = [
                'kode_barang' => $kode_barang[$i],
                'jumlah' => $jumlah[$i],
                'kode_pembelian' => $kode_beli
            ];
            $total += ($harga[$i] * $jumlah[$i]);
            $this->insert_barang($data);
            $stok = $this->M_barang->get_stok($kode_barang[$i]);
            $newstok = intval($stok['stok']) + intval($jumlah[$i]);
            $this->M_barang->update_stok_barang(array('stok' => $newstok), $kode_barang[$i]);
        }
        $pembelian = [
            'kode_pembelian' => $kode_beli,
            'tanggal' => $this->input->post('tanggal'),
            'kode_supplier' => $this->input->post('kode_supplier'),
            'total_tagihan' => $total
        ];
        return $this->insert_pembelian($pembelian);
    }
    private function insert_pembelian($data){
        $this->db->insert($this->table1, $data);
        return TRUE;
    }
    private function insert_barang($data){
        $this->db->insert($this->table4, $data);
        return TRUE;
    }
    
    //Bagian Penjualan
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
            return $this->insert_($data);
        } else { return FALSE; }
    }
    private function insert_($data){
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
        $tanggal = substr($this->input->post('tanggal'), 2, 2).substr($this->input->post('tanggal'), 5, 2).substr($this->input->post('tanggal'), 8, 2);
        $kode_supplier = substr($this->input->post('kode_supplier'), -4);
        $code = 'P-'.$tanggal.$kode_supplier.rand(0, 99);
        $is_code = $this->db->get_where($this->table1, array('kode_pembelian' => $code))->row_array();
        if($is_code){
            $new = intval(substr($code, -2)) + rand(0, 99);
            return 'B-'.$tanggal.$kode_supplier.$new;
        }
        return $code;
    }
}