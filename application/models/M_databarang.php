<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_databarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left');
        $this->db->order_by('tb_barang.id_barang', 'desc');
        return $this->db->get()->result();
    }

    public function kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('nama_kategori', 'asc');
        return $this->db->get()->result();
    }

    public function satuan()
    {
        $this->db->select('*');
        $this->db->from('tb_satuan');
        $this->db->order_by('nama_satuan', 'asc');
        return $this->db->get()->result();
    }

    public function ambil_id_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        return $this->db->get('tb_barang')->row();
    }

    public function tambah_barang($data_input)
    {
        return $this->db->insert('tb_barang', $data_input);
    }

    public function perbarui_barang($id_barang, $data_input)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->update('tb_barang', $data_input);
    }

    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('tb_barang');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file M_databarang.php */
