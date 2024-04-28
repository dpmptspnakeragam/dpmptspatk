<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lib_valid
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function check_role()
    {
        $role = $this->ci->session->userdata('role');
        if ($role != '1') {
            // Redirect back to previous page
            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($redirect_url, 'refresh');
        }
    }
}

/* End of file lib_valid.php */
