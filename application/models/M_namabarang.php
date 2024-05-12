<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_namabarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('');
        $this->db->from('tb_nama');
        $this->db->order_by('id_nama', 'DESC');
        return $this->db->get()->result();
    }

    public function simpan_nama($data_input)
    {
        return $this->db->insert('tb_nama', $data_input);
    }

    public function ambil_id_nama($id_nama)
    {
        $this->db->where('id_nama', $id_nama);
        return $this->db->get('tb_nama')->row();
    }

    public function cek_nama_barang($id_nama, $nama_barang)
    {
        $this->db->where('nama_barang', $nama_barang);
        $this->db->where('id_nama !=', $id_nama);
        return $this->db->get('tb_nama')->num_rows() == 0;
    }

    public function perbarui_nama($id_nama, $data_input)
    {
        $this->db->where('id_nama', $id_nama);
        $this->db->update('tb_nama', $data_input);
    }

    public function hapus_nama($id_nama)
    {
        $this->db->where('id_nama', $id_nama);
        $this->db->delete('tb_nama');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file M_namabarang.php */
