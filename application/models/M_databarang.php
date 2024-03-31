<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_databarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left');
        $this->db->order_by('tb_barang.id_barang', 'desc');
        return $this->db->get()->result();
    }
}

/* End of file M_databarang.php */
