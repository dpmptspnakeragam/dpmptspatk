<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // load model dashboard
        $this->load->model('M_dashboard');

        // Get the id_user from wherever it is stored
        $id_user = $this->session->userdata('id_user'); // Assuming it's stored in session

        // Check if id_user exists in tb_user using Lib_login
        if ($id_user && !$this->lib_login->cek_id($id_user)) {
            // Clear userdata if id_user doesn't exist
            $this->lib_login->clear_userdata();

            // Redirect to login page
            redirect('login'); // Adjust 'login' to the actual login page URL
        }
    }

    // List all your items
    public function index()
    {
        $data = [
            'home' => 'Home',
            'title' => 'Dashboard',
            'action' => 'Dashboard',
            'konten' => 'admin/v_dashboard',
            'total_user' => $this->M_dashboard->ambil_user(),
            'total_barang' => $this->M_dashboard->ambil_barang(),
            'total_kategori' => $this->M_dashboard->ambil_kategori(),
            'total_permintaan' => $this->M_dashboard->ambil_permintaan(),
            'total_tte' => $this->M_dashboard->ambil_tte(),

            'permintaan' => $this->M_dashboard->ambil_tb_konfperm()
        ];

        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
    }

    //Update one item
    public function update($id = NULL)
    {
    }

    //Delete one item
    public function delete($id = NULL)
    {
    }
}

/* End of file Dashboard.php */
