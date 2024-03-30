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
        // cek user saat login
        if ($cek) {
            $id_user = $cek->id_user;
            $username = $cek->username;
            $foto = $cek->foto_profile;
            $role = $cek->role_pegawai;
            $keaktifan = $cek->status_keaktifan;

            // buat session user saat login
            $this->ci->session->set_userdata('id_user', $id_user);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('foto_profile', $foto);
            $this->ci->session->set_userdata('role_pegawai', $role);
            $this->ci->session->set_userdata('status_keaktifan', $keaktifan);

            // arahkan ke halaman admin
            redirect('dashboard');
        } else {
            // jika cek salah
            $this->ci->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('login');
        }
    }

    public function protection_url()
    {
        if ($this->ci->session->userdata('username') == '') {
            $this->ci->session->set_flashdata('warning', 'Akses tidak valid!');
            redirect('login');
        }
    }

    public function logout_user()
    {
        $this->ci->session->unset_userdata('id_user');
        $this->ci->session->unset_userdata('role_pegawai');
        $this->ci->session->unset_userdata('status_keaktifan');
        $this->ci->session->set_flashdata('success', 'Logout berhasil!');
        redirect('login');
    }
}

/* End of file lib_login.php */
