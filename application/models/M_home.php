<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    public function ambil_barang()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->order_by('tb_barang.id_barang', 'ASC');
        return $this->db->get()->result();
    }

    public function kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get()->result();
    }
}

/* End of file M_home.php */
