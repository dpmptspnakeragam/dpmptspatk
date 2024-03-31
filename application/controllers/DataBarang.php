<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_databarang');
    }

    // List all items Data Barang
    public function index()
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data Barang',
            'action'    => 'Data Barang',
            'barang'    => $this->M_databarang->ambil_semua(),
            'konten'    => 'admin/v_databarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    // Add Data Barang
    public function add()
    {
    }

    //Update Data Barang
    public function update($id_user = NULL)
    {
    }

    //Delete Data Barang
    public function delete($id_user = NULL)
    {
    }
}

/* End of file DataBarang.php */
