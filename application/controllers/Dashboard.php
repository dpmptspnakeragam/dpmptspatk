<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // check role
        $this->lib_valid_1->check_role('permintaan');
    }

    // List all your items
    public function index()
    {
        $data = [
            'home' => 'Home',
            'title' => 'Dashboard',
            'action' => 'Dashboard',
            'konten' => 'admin/v_dashboard',
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
