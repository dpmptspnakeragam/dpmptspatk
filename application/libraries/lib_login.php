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
            $email = $cek->email;
            $username = $cek->username;
            $role = $cek->role;

            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('email', $email);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('role', $role);

            $this->ci->session->set_flashdata('success', 'Login berhasil.');
            redirect('dashboard');
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
