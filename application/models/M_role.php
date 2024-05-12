<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_role extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('');
        $this->db->from('tb_role');
        $this->db->order_by('id_role', 'ASC');
        return $this->db->get()->result();
    }

    // ambil id_role
    public function id($id_role)
    {
        $this->db->where('id_role', $id_role);
        return $this->db->get('tb_role')->row();
    }

    // simpan
    public function simpan($data_input)
    {
        return $this->db->insert('tb_role', $data_input);
    }

    // perbarui
    public function perbarui($id_role, $data_input)
    {
        $this->db->where('id_role', $id_role);
        $this->db->update('tb_role', $data_input);
    }

    // delete
    public function hapus($id_role)
    {
        $this->db->where('id_role', $id_role);
        $this->db->delete('tb_role');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file M_role.php */
