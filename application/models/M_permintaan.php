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
        $this->db->order_by('tb_barang.id_barang', 'DESC');
        return $this->db->get()->result();
    }

    public function tampilkan_tabel_konfperm()
    {
        $this->db->select('');
        $this->db->from('tb_konfperm');
        $this->db->order_by('id_konfperm', 'DESC');
        return $this->db->get()->result();
    }

    public function nama_user($kode_perm)
    {
        $this->db->select('tb_user.id_user, tb_user.nama_user');
        $this->db->from('tb_user');
        $this->db->join('tb_perm', 'tb_user.id_user = tb_perm.id_user');
        $this->db->where('tb_perm.kode_perm', $kode_perm);
        return $this->db->get()->row();
    }


    public function qr_code($kode_perm)
    {
        $this->db->select('qr_code');
        $this->db->from('tb_konfperm');
        $this->db->where('kode_perm', $kode_perm);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $qr_code_filename = $query->row()->qr_code;
            $qr_code_path = base_url('assets/image/qrcode/' . $qr_code_filename);
            return $qr_code_path;
        } else {
            return null;
        }
    }

    public function nama_barang($kode_perm)
    {
        $this->db->select('tb_nama.nama_barang, tb_perm.jumlah_perm, tb_perm.sub_total, tb_satuan.nama_satuan, tb_konfperm.keterangan');
        $this->db->from('tb_perm');
        $this->db->join('tb_barang', 'tb_perm.id_barang = tb_barang.id_barang');
        $this->db->join('tb_nama', 'tb_barang.id_nama = tb_nama.id_nama');
        $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan');
        $this->db->join('tb_konfperm', 'tb_perm.kode_perm = tb_konfperm.kode_perm');
        $this->db->where('tb_perm.kode_perm', $kode_perm);

        $query = $this->db->get();
        return $query->result();
    }

    public function tb_konfperm($kode_perm)
    {
        $this->db->select('SUM(total_bayar) as total_bayar, keterangan');
        $this->db->from('tb_konfperm');
        $this->db->where('kode_perm', $kode_perm);
        $this->db->where('status_konfperm', 'Dikonfirmasi');
        return $this->db->get()->row();
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

    public function id_user($kode_perm, $id_konfperm)
    {
        $this->db->select('p.id_user');
        $this->db->from('tb_perm p');
        $this->db->join('tb_konfperm k', 'p.kode_perm = k.kode_perm');
        $this->db->where('p.kode_perm', $kode_perm);
        $this->db->where('k.id_konfperm', $id_konfperm);
        $result = $this->db->get()->row();
        return ($result) ? $result->id_user : null;
    }
}

/* End of file M_permintaan.php */
