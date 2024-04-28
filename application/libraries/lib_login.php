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
            $id_user = $cek->id_user;
            $user_email = $cek->email;
            $user_username = $cek->username;
            $user_role = $cek->role;

            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('email', $user_email);
            $this->ci->session->set_userdata('username', $user_username);
            $this->ci->session->set_userdata('role', $user_role);

            $this->ci->session->set_flashdata('success', 'Login berhasil.');
            redirect($this->halaman_user($user_role));
        } else {
            $this->ci->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('login');
        }
    }

    private function halaman_user($user_role)
    {
        switch ($user_role) {
            case '1':
                return 'dashboard';
            case '2':
                return 'permintaan';
            case '3':
                return 'permintaan';
            default:
                return 'login'; // Redirect ke halaman login jika role tidak valid
        }
    }

    public function protection_url()
    {
        if ($this->ci->session->userdata('id_user') == '') {
            $this->ci->session->set_flashdata('warning', 'Akses tidak valid!');
            redirect('login');
        }
    }

    public function logout_user()
    {
        $this->ci->session->unset_userdata('id_user');
        $this->ci->session->unset_userdata('email');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('role');
        $this->ci->session->set_flashdata('success', 'Logout berhasil!');
        redirect('login');
    }
}

/* End of file lib_login.php */
