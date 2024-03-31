<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataProduk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
    }

    // List all items Data Produk
    public function index()
    {
        $data = [
            'home'  => 'Data Master',
            'title' => 'Data Produk',
            'action' => false,
            'konten'   => 'v_dataproduk',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    // Add Data Produk
    public function add()
    {
    }

    //Update Data Produk
    public function update($id_user = NULL)
    {
    }

    //Delete Data Produk
    public function delete($id_user = NULL)
    {
    }
}

/* End of file DataProduk.php */
