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
        $this->db->order_by('tb_nama.nama_barang', 'ASC');
        return $this->db->get()->result();
    }

    public function ambil_barang_paginated($start, $per_page)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->order_by('tb_nama.nama_barang', 'ASC');
        $this->db->limit($per_page, $start);
        return $this->db->get()->result();
    }

    public function kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get()->result();
    }

    public function produk()
    {
        $this->db->select('*');
        $this->db->from('tb_nama');
        $this->db->order_by('nama_barang', 'ASC');
        return $this->db->get()->result();
    }

    public function searchBarangkeyword($keyword = null)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->order_by('tb_barang.id_barang', 'ASC');

        if ($keyword) {
            $this->db->like('nama_barang', $keyword);
        }

        return $this->db->get()->result();
    }

    // Model (M_home)
    public function searchBarangPage($keyword, $start, $per_page)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->like('nama_barang', $keyword);
        $this->db->limit($per_page, $start);
        $this->db->order_by('tb_barang.id_barang', 'ASC');
        return $this->db->get()->result();
    }


    public function ambil_barang_by_kategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->where('tb_barang.id_kategori', $id_kategori); // Filter berdasarkan kategori
        $this->db->order_by('tb_barang.id_barang', 'ASC');

        return $this->db->get()->result();
    }

    public function ambil_barang_by_kategori_paginated($id_kategori, $start, $limit)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->where('tb_barang.id_kategori', $id_kategori); // Filter berdasarkan kategori
        $this->db->order_by('tb_barang.id_barang', 'ASC');
        $this->db->limit($limit, $start);

        return $this->db->get()->result();
    }

    public function ambil_detail_barang($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->where('tb_barang.id_barang', $id_barang); // Filter berdasarkan id_barang

        return $this->db->get()->row(); // Menggunakan row() karena hanya ingin satu data
    }
}

/* End of file M_home.php */
