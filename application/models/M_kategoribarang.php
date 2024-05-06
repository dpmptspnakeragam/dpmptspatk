<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kategoribarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('');
        $this->db->from('tb_kategori');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get()->result();
    }

    public function simpan_kategori($data_input)
    {
        return $this->db->insert('tb_kategori', $data_input);
    }

    public function ambil_id_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->get('tb_kategori')->row();
    }

    public function perbarui_kategori($id_kategori, $data_input)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('tb_kategori', $data_input);
    }

    public function hapus_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->delete('tb_kategori');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file M_kategoribarang.php */
