<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function index()
    {
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');

        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('price'),
            'name'    => $this->input->post('name'),
            // 'options' => array('Size' => 'L', 'Color' => 'Red')
        );
        $this->cart->insert($data);

        redirect($redirect_page, 'refresh');
    }
}

/* End of file Cart.php */
