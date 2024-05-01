<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_datauser extends CI_Model
{
    public function ambil_semua()
    {
        $this->db->select('tb_user.*, tb_role.nama_role'); // Memilih kolom role dari tabel tb_role
        $this->db->from('tb_user');
        $this->db->join('tb_role', 'tb_user.id_role = tb_role.id_role', 'left');

        $this->db->order_by('tb_user.id_user', 'desc'); // Mengurutkan berdasarkan id_user dari tb_user
        return $this->db->get()->result();
    }

    public function role()
    {
        $this->db->select('*');
        $this->db->from('tb_role');
        $this->db->where('id_role !=', 1); // Menyembunyikan id_role 1
        $this->db->order_by('id_role', 'asc');
        return $this->db->get()->result();
    }

    public function perbarui_status($id_user, $newStatus)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user', ['status' => $newStatus]);

        // Mengembalikan nilai true jika proses update berhasil
        return $this->db->affected_rows() > 0;
    }

    public function validasi_username()
    {
        $this->db->select('username');
        $this->db->where('id_user');
        $data = $this->db->get('tb_user')->row();
        return $data ? $data->username : null;
    }

    public function validasi_email()
    {
        $this->db->select('email');
        $this->db->where('id_user');
        $data = $this->db->get('tb_user')->row();
        return $data ? $data->email : null;
    }

    public function role_exists($role_id)
    {
        $this->db->where('id_role', $role_id);
        $query = $this->db->get('tb_user');
        return $query->num_rows() > 0;
    }

    public function validasi_id($id_user)
    {
        $this->db->select('username');
        $this->db->where('id_user', $id_user);
        $data = $this->db->get('tb_user')->row();
        return $data ? $data->username : null;
    }

    public function username_unik($username, $id_user, $id_role)
    {
        if ($id_role != 1) {
            // Jika role adalah admin, tidak perlu validasi unik
            return FALSE;
        }

        $this->db->where('username', $username);
        $this->db->where_not_in('id_user', $id_user);
        return $this->db->get('tb_user')->row();
    }

    public function email_unik($email, $id_user, $id_role)
    {
        if ($id_role != 1) {
            // Jika role adalah admin, tidak perlu validasi unik
            return FALSE;
        }

        $this->db->where('email', $email);
        $this->db->where_not_in('id_user', $id_user);
        return $this->db->get('tb_user')->row();
    }

    public function ambil_id_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->get('tb_user')->row();
    }

    public function tambah_user($data_input)
    {
        return $this->db->insert('tb_user', $data_input);
    }


    public function check_existing_role($role_id)
    {
        return $this->role_exists($role_id);
    }

    public function perbarui_user($id_user, $data_input)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data_input);
    }

    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        return $this->db->affected_rows() > 0;
    }
}

/* End of file M_datauser.php */
