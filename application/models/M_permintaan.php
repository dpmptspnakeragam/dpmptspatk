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

    public function nama_user($kode_perm)
    {
        $this->db->select('tb_user.nama_user');
        $this->db->from('tb_user');
        $this->db->join('tb_perm', 'tb_user.id_user = tb_perm.id_user');
        $this->db->where('tb_perm.kode_perm', $kode_perm);
        return $this->db->get()->row(); // Menggunakan row() karena kita hanya ingin satu baris data
    }

    public function nama_barang($kode_perm)
    {
        $this->db->select('tb_nama.nama_barang, tb_perm.jumlah_perm, tb_perm.sub_total');
        $this->db->from('tb_perm');
        $this->db->join('tb_barang', 'tb_perm.id_barang = tb_barang.id_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->where('tb_perm.kode_perm', $kode_perm);

        $query = $this->db->get();
        return $query->result();
    }

    public function konfirmasi_permintaan($id_konfperm, $data_konfirmasi)
    {
        $this->db->where('id_konfperm', $id_konfperm);
        $this->db->update('tb_konfperm', $data_konfirmasi);
    }

    public function tolak_konf_permintaan($id_konfperm, $data)
    {
        $this->db->where('id_konfperm', $id_konfperm);
        $this->db->update('tb_konfperm', $data);
    }

    public function simpan_qr_code($id_konfperm, $file_name)
    {
        $data = array('qr_code' => $file_name);
        $this->db->where('id_konfperm', $id_konfperm);
        $this->db->update('tb_konfperm', $data);
    }

    public function hapus_riwayat_konfperm($id_konfperm)
    {
        $this->db->where('id_konfperm', $id_konfperm);
        $this->db->delete('tb_konfperm');
        return $this->db->affected_rows() > 0;
    }

    public function hapus_riwayat_perm($kode_perm)
    {
        $this->db->where('kode_perm', $kode_perm);
        $this->db->delete('tb_perm');
    }

    public function ambil_kode_perm($id_konfperm)
    {
        $this->db->select('kode_perm');
        $this->db->from('tb_konfperm');
        $this->db->where('id_konfperm', $id_konfperm);
        $result = $this->db->get()->row();
        return ($result) ? $result->kode_perm : null;
    }
}

/* End of file M_permintaan.php */
