<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies

    }

    // List all your items
    public function dashboard()
    {
        $data = array(
            'home' => 'Home',
            'title' => 'Dashboard',
            'konten' => 'v_dashboard',
        );
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

/* End of file User.php */
