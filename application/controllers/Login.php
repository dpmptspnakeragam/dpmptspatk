<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_login');

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
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required'  => 'Masukan %s!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required'  => 'Masukan %s!',
        ]);


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
