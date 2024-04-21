<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_permintaan extends CI_Model
{
    public function tampilkan_data_barang()
    {
        $this->db->select('tb_barang.id_barang, tb_barang.id_nama, tb_barang.harga, tb_barang.id_kategori, tb_satuan.id_satuan, tb_nama.nama_barang, tb_kategori.nama_kategori, tb_satuan.nama_satuan');
        $this->db->from('tb_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
        $this->db->order_by('tb_barang.id_barang', 'ASC');
        return $this->db->get()->result();
    }

    public function tampilkan_tabel_konfperm()
    {
        $this->db->select('');
        $this->db->from('tb_konfperm');
        $this->db->order_by('id_konfperm', 'desc');
        return $this->db->get()->result();
    }

    public function tampilkan_nama_user_by_kode_perm($kode_perm)
    {
        $this->db->select('tb_user.nama_user');
        $this->db->from('tb_user');
        $this->db->join('tb_perm', 'tb_user.id_user = tb_perm.id_user');
        $this->db->where('tb_perm.kode_perm', $kode_perm);
        return $this->db->get()->row(); // Menggunakan row() karena kita hanya ingin satu baris data
    }

    public function konfirmasi_permintaan($id_konfperm, $data_konfirmasi)
    {
        $this->db->where('id_konfperm', $id_konfperm);
        $this->db->update('tb_konfperm', $data_konfirmasi);
    }

    public function simpan_qr_code($id_konfperm, $file_name)
    {
        $data = array('qr_code' => $file_name);
        $this->db->where('id_konfperm', $id_konfperm);
        $this->db->update('tb_konfperm', $data);
    }
}

/* End of file M_permintaan.php */
