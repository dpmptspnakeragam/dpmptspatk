<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_permintaanbarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('tb_permintaan.*, tb_barang.*, tb_user.nama_user, tb_nama.nama_barang, tb_nama.gambar, tb_kategori.nama_kategori, tb_satuan.nama_satuan');
        $this->db->from('tb_permintaan');
        $this->db->join('tb_barang', 'tb_permintaan.id_barang = tb_barang.id_barang');
        $this->db->join('tb_user', 'tb_permintaan.id_user = tb_user.id_user');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan');
        $this->db->order_by('tb_permintaan.id_permintaan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function ambil_user()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('nama_user', 'ASC');
        return $this->db->get()->result();
    }

    public function ambil_barang()
    {
        $this->db->select('tb_barang.id_barang, tb_barang.id_nama, tb_barang.harga, tb_barang.id_kategori, tb_satuan.id_satuan, tb_nama.nama_barang, tb_kategori.nama_kategori, tb_satuan.nama_satuan');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->order_by('tb_barang.id_barang', 'ASC');
        return $this->db->get()->result();
    }

    public function simpan_permintaan($data_input)
    {
        return $this->db->insert('tb_permintaan', $data_input);
    }
}

/* End of file M_permintaanbarang.php */
