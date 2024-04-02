<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_permintaanbarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('*');
        $this->db->from('tb_permintaan');
        $this->db->join('tb_user', 'tb_user.id_user = tb_permintaan.id_user', 'left');
        $this->db->join('tb_nama', 'tb_nama.id_nama = tb_permintaan.id_nama', 'left');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_permintaan.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_permintaan.id_satuan', 'left');
        $this->db->order_by('tb_permintaan.id_permintaan', 'desc');
        return $this->db->get()->result();
    }

    public function ambil_user()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('nama_user', 'asc');
        return $this->db->get()->result();
    }

    public function ambil_nama()
    {
        $this->db->select('*');
        $this->db->from('tb_nama');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get()->result();
    }

    public function ambil_kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('nama_kategori', 'asc');
        return $this->db->get()->result();
    }

    public function ambil_satuan()
    {
        $this->db->select('*');
        $this->db->from('tb_satuan');
        $this->db->order_by('nama_satuan', 'asc');
        return $this->db->get()->result();
    }

    public function simpan_permintaan($data_input)
    {
        return $this->db->insert('tb_permintaan', $data_input);
    }
}

/* End of file M_permintaanbarang.php */
