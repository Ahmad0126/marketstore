<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_suara extends CI_Model{
    protected $_table = 'suara_01'; //DB table

    //validation rules
    protected $validation_rules = [
        [
            'field' => 'nama_tps',
            'label' => 'Nama TPS',
            'rules' => 'required|max_length[25]',
            'errors' => [
                'max_length' => '{field}nya kepanjangan!',
                'required' => 'Tolong kasih {field}!'
            ]
        ],
        [
            'field' => 'suara1',
            'label' => 'Suara 01',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Total {field} harus angka!'
            ]
        ],
        [
            'field' => 'suara2',
            'label' => 'Suara 02',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Total {field} harus angka!'
            ]
        ],
        [
            'field' => 'suara3',
            'label' => 'Suara 03',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Total {field} harus angka!'
            ]
        ],
        [
            'field' => 'sah',
            'label' => 'Suara Sah',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Total {field} harus angka!'
            ]
        ],
        [
            'field' => 'tidak_sah',
            'label' => 'Suara Tidak Sah',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Total {field} harus angka!'
            ]
        ],
        [
            'field' => 'total',
            'label' => 'Suara',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'numeric' => 'Total {field} harus angka!'
            ]
        ]
    ];

    //validation form
    private function validation(){
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run() == TRUE){
            return array(
                'total_suara_01' => $this->input->post('total'),
                'nama_tps_01' => $this->input->post('nama_tps'),
                'suara_no1_01' => $this->input->post('suara1'),
                'suara_no2_01' => $this->input->post('suara2'),
                'suara_no3_01' => $this->input->post('suara3'),
                'total_suara_sah_01' => $this->input->post('sah'),
                'total_suara_tidak_sah_01' => $this->input->post('tidak_sah')
            );
        }
        return FALSE;
    }
    
    //Read
    public function get_laporan(){
        $s1 = $this->count_suara('suara_no1_01');
        $s2 = $this->count_suara('suara_no2_01');
        $s3 = $this->count_suara('suara_no3_01');
        $data = [
            'labels' => array('Suara 01', 'Suara 02', 'Suara 03'),
            'datasets' => [[
                'data' => array($s1['sum(suara_no1_01)'], $s2['sum(suara_no2_01)'], $s3['sum(suara_no3_01)']),
                'backgroundColor' => array('#3794fc', '#a037fc', '#51c81c'),
                'borderWidth' => 0,
                'fill' => false
            ]],
            'suara_sah' => $this->count_suara('total_suara_sah_01')['sum(total_suara_sah_01)'],
            'suara_tidak_sah' => $this->count_suara('total_suara_tidak_sah_01')['sum(total_suara_tidak_sah_01)'],
            'total_suara' => $this->count_suara('total_suara_01')['sum(total_suara_01)']
        ];
        return $data;
    }
    private function count_suara($column){
        $this->db->select('sum('.$column.')');
        return $this->db->get($this->_table)->row_array();
    }

    //Insert
    public function simpan(){
        $validation = $this->validation();
        if ($validation){
            $sah = $this->input->post('suara1') + $this->input->post('suara2') + $this->input->post('suara3');
            if($this->input->post('sah') != $sah){
                $this->session->set_flashdata('alert',$this->template->buat_notif('Total suara sah tidak valid!', 'warning'));
                redirect(base_url('pemilu'));
            }
            $total = $this->input->post('sah') + $this->input->post('tidak_sah');
            if($this->input->post('total') != $total){
                $this->session->set_flashdata('alert',$this->template->buat_notif('Total semua suara tidak valid!', 'warning'));
                redirect(base_url('pemilu'));
            }
            return $this->insert_supplier($validation);
        } else { 
            $this->session->set_flashdata('alert',$this->template->buat_notif(validation_errors(), 'danger'));
            return FALSE;
        }
    }
    private function insert_supplier($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
}