<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_satuanbarang extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('');
        $this->db->from('tb_satuan');
        $this->db->order_by('id_satuan', 'desc');
        return $this->db->get()->result();
    }

    public function simpan_satuan($data_input)
    {
        return $this->db->insert('tb_satuan', $data_input);
    }

    public function ambil_id_satuan($id_satuan)
    {
        $this->db->where('id_satuan', $id_satuan);
        return $this->db->get('tb_satuan')->row();
    }

    public function perbarui_satuan($id_satuan, $data_input)
    {
        $this->db->where('id_satuan', $id_satuan);
        $this->db->update('tb_satuan', $data_input);
    }

    public function hapus_satuan($id_satuan)
    {
        $this->db->where('id_satuan', $id_satuan);
        $this->db->delete('tb_satuan');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file M_satuanbarang.php */
