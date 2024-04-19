<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_permintaan extends CI_Model
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
        $this->db->order_by('tb_permintaan.id_permintaan', 'DESC');
        $query = $this->db->get();
        return $query->result();
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

    public function check_id_barang_exists($id_barang, $id_validasi)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->where('id_validasi', $id_validasi);
        $query = $this->db->get('tb_permintaan');

        return $query->num_rows() > 0;
    }

    public function get_status_by_id_validasi($id_validasi)
    {
        // Lakukan query untuk mendapatkan status berdasarkan id_validasi
        $this->db->select('status');
        $this->db->where('id_validasi', $id_validasi);
        $query = $this->db->get('tb_permintaan');

        // Jika data ditemukan, kembalikan status
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->status;
        } else {
            // Jika tidak ada data ditemukan, kembalikan null atau status default
            return null;
        }
    }

    public function konfirmasi_permintaan($id_validasi)
    {
        // Ubah status permintaan menjadi "dikonfirmasi"
        $data = array('status' => 'dikonfirmasi');
        $this->db->where('id_validasi', $id_validasi);
        $this->db->update('tb_permintaan', $data);
    }

    public function simpan_qr_code($id_validasi, $file_name)
    {
        $data = array('qr_code' => $file_name);
        $this->db->where('id_validasi', $id_validasi);
        $this->db->update('tb_permintaan', $data);
    }
}

/* End of file M_permintaan.php */
