<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // load model dashboard
        $this->load->model('M_dashboard');
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
            'nama_barang' => $this->M_dashboard->nama_barang(),
            'total_permintaan' => $this->M_dashboard->ambil_permintaan(),
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
