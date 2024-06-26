<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lib_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('M_login');
    }

    public function login_user($username, $password)
    {
        $cek = $this->ci->M_login->login($username, $password);
        if ($cek) {
            // Check user status
            if ($cek->status == 2) {
                // Account not activated
                $this->ci->session->set_flashdata('info', 'Akun belum diaktivasi.');
                redirect('login');
            }

            // Account is active, proceed with login
            $id_user = $cek->id_user;
            $email = $cek->email;
            $username = $cek->username;
            $id_role = $cek->id_role;

            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('email', $email);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('id_role', $id_role);

            $this->ci->session->set_flashdata('success', 'Login berhasil.');
            // Redirect based on role ID
            if ($id_role == 5) {
                redirect('cart/detail');
            } else {
                redirect('dashboard');
            }
        } else {
            $this->ci->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('login');
        }
    }

    public function protection_url()
    {
        if ($this->ci->session->userdata('id_user') == '') {
            $this->ci->session->set_flashdata('warning', 'Akses tidak valid!');
            redirect('login');
        }
    }

    public function cek_id($id_user)
    {
        // Query to check if id_user exists in tb_user
        $query = $this->ci->db->get_where('tb_user', ['id_user' => $id_user]);

        // If id_user doesn't exist, return false
        if ($query->num_rows() == 0) {
            return false;
        }

        // If id_user exists, return true
        return true;
    }

    public function clear_userdata()
    {
        // Clear userdata
        $this->ci->session->unset_userdata('id_user');
        $this->ci->session->unset_userdata('email');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('id_role');
    }

    // logout user
    public function logout_user()
    {
        $this->ci->session->unset_userdata('id_user');
        $this->ci->session->unset_userdata('email');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('id_role');
        $this->ci->session->set_flashdata('success', 'Logout berhasil!');
        redirect('home');
    }
}

/* End of file lib_login.php */
