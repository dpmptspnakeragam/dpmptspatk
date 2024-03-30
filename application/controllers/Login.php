<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_login');
    }

    // List all your items
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->lib_login->login_user($username, $password);
        }

        $data = array(
            'title' => 'Login | ATK DPMPTSP Kabupaten Agam',
        );
        $this->load->view('v_login', $data, FALSE);
    }

    public function logout()
    {
        $this->lib_login->logout_user();
    }
}

/* End of file Login.php */
