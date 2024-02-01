<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model{
    protected $table1 = 'pembelian'; //DB tables
    protected $table2 = 'penjualan';
    protected $table3 = 'supplier';
    protected $table4 = 'detail_pembelian';
    protected $table5 = 'detail_penjualan';
    protected $table6 = 'barang';

    public function get_pp_data(){
        $pembelian = array();
        $penjualan = array();
        $pembelian_color = array();
        $penjualan_color = array();

        $hari = [];
        $end = date_create(date('Y-m-d', strtotime('+1 day')));
        $begin = date_create(date('Y-m-d', strtotime('+1 day')));
        date_sub($begin, new DateInterval('P7D'));

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            //fetch data from database where tanggal = $dt
            array_push($pembelian, intval($this->count_all_pembelian_by_tanggal($dt->format("Y-m-d"))));
            array_push($penjualan, intval($this->count_all_penjualan_by_tanggal($dt->format("Y-m-d"))));
            array_push($pembelian_color, '#51c81c');
            array_push($penjualan_color, '#dee5ef');
            array_push($hari, $dt->format("j"));
        }
        $data = [
            'labels' => $hari,
            'datasets' => [
                [
                    'label' => 'Penjualan',
                    'data' => $penjualan,
                    'backgroundColor' => $penjualan_color,
                    'borderColor' => $penjualan_color,
                    'borderWidth' => 1,
                    'fill' => false
                ],
                [
                    'label' => 'Pembelian',
                    'data' => $pembelian,
                    'backgroundColor' => $pembelian_color,
                    'borderColor' => $pembelian_color,
                    'borderWidth' => 1,
                    'fill' => false
                ]
            ]
        ];
        return $data;
    }

    //Bagian Pembelian
    //Read
    public function get_pembelian(){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join($this->table3, $this->table3.'.kode_supplier = '.$this->table1.'.kode_supplier');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get()->result();
    }
    public function count_all_pembelian_by_tanggal($tanggal){
        $this->db->like('tanggal', $tanggal);
        return $this->db->get($this->table1)->num_rows();
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
        $kode_beli = $this->generate_code_pembelian();
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
            $this->insert_barang($this->table4, $data);
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
    private function insert_barang($table, $data){
        $this->db->insert($table, $data);
        return TRUE;
    }
    
    //Bagian Penjualan
    //Read
    public function get_penjualan(){
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($this->table2)->result();
    }
    public function get_penjualan_by_id($id){
        $this->db->where('id_penjualan', $id);
        return $this->db->get($this->table2)->row_array();
    }
    public function count_all_penjualan_by_tanggal($tanggal){
        $this->db->like('tanggal', $tanggal);
        return $this->db->get($this->table2)->num_rows();
    }
    public function get_penjualan_by_member($id){
        $this->db->order_by('tanggal', 'DESC');
        $this->db->where('id_pelanggan', $id);
        return $this->db->get($this->table2)->result();
    }
    public function get_detail_penjualan($kode){
        $this->db->select('*');
        $this->db->from($this->table5);
        $this->db->join($this->table6, $this->table6.'.kode_barang = '.$this->table5.'.kode_barang');
        $this->db->where('kode_penjualan', $kode);
        return $this->db->get()->result();
    }

    //Delete
    public function delete_penjualan($kode){
        $this->load->model('M_barang');
        $detail = $this->get_detail_penjualan($kode);
        foreach($detail as $d){
            $stok = $this->M_barang->get_stok($d->kode_barang);
            $stok_akhir = $stok['stok'] + $d->jumlah;
            $this->M_barang->update_stok_barang(array('stok' => $stok_akhir), $d->kode_barang);
        }
        $this->db->delete($this->table5, array('kode_penjualan' => $kode));
        $this->db->delete($this->table2, array('kode_penjualan' => $kode));
        return TRUE;
    }

    //Insert
    public function jual(){
        $this->load->model('M_barang');
        $kode_jual = $this->generate_code_penjualan();
        $total = 0;
        $diskon = 0;
        $kode_barang = $this->input->post('kode_barang');
        $jumlah = $this->input->post('jumlah');
        $harga = $this->input->post('harga');
        for($i = 0; $i < count($kode_barang); $i++){
            $data = [
                'kode_barang' => $kode_barang[$i],
                'jumlah' => $jumlah[$i],
                'kode_penjualan' => $kode_jual
            ];
            $total += ($harga[$i] * $jumlah[$i]);
            $this->insert_barang($this->table5, $data);
            $stok = $this->M_barang->get_stok($kode_barang[$i]);
            $newstok = intval($stok['stok']) - intval($jumlah[$i]);
            $this->M_barang->update_stok_barang(array('stok' => $newstok), $kode_barang[$i]);
        }
        if($this->input->post('id_pelanggan') != null){
            $this->load->model('M_pelanggan');
            if($this->input->post('poin') != null){
                $member = $this->M_pelanggan->get_pelanggan_by_id($this->input->post('id_pelanggan'));
                $diskon += intval($this->input->post('poin'));
                $poin = intval($member->poin) - $diskon;
                $this->M_pelanggan->update_poin($poin);
            }
            if($total >= 10000){
                $member = $this->M_pelanggan->get_pelanggan_by_id($this->input->post('id_pelanggan'));
                $poin = intval($member->poin) + (5 * $total / 100);
                $this->M_pelanggan->update_poin($poin);
            }
        }
        if($this->input->post('id_voucher') != null){
            $this->load->model('M_voucher');
            $this->M_voucher->use_voucher();
            $diskon += intval($this->input->post('voucher'));
        }
        $penjualan = [
            'kode_penjualan' => $kode_jual,
            'tanggal' => $this->input->post('tanggal'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'diskon' => $diskon,
            'total_tagihan' => $total
        ];
        return $this->insert_penjualan($penjualan);
    }
    private function insert_penjualan($data){
        $this->db->insert($this->table2, $data);
        return TRUE;
    }

    //generator
    private function generate_code_pembelian(){
        $tanggal = substr($this->input->post('tanggal'), 2, 2).substr($this->input->post('tanggal'), 5, 2).substr($this->input->post('tanggal'), 8, 2);
        $kode_supplier = substr($this->input->post('kode_supplier'), -4);
        $code = 'P-'.$tanggal.$kode_supplier.rand(10, 99);
        $is_code = $this->db->get_where($this->table1, array('kode_pembelian' => $code))->row_array();
        if($is_code){
            $new = intval(substr($code, -2)) + rand(10, 99);
            return 'B-'.$tanggal.$kode_supplier.$new;
        }
        return $code;
    }
    private function generate_code_penjualan(){
        $tanggal = substr($this->input->post('tanggal'), 2, 2).substr($this->input->post('tanggal'), 5, 2).substr($this->input->post('tanggal'), 8, 2);
        $code = 'P-'.$tanggal.rand(100, 999);
        $is_code = $this->db->get_where($this->table2, array('kode_penjualan' => $code))->row_array();
        if($is_code){
            $new = intval(substr($code, -3)) + rand(100, 999);
            return 'J-'.$tanggal.$new;
        }
        return $code;
    }
}