<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NamaBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_namabarang');
    }

    // List all your items
    public function index($offset = 0)
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Nama Barang',
            'action'    => 'Nama Barang',
            'nama'    => $this->M_namabarang->ambil_semua(),
            'konten'    => 'admin/v_namabarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal nama barang
        $this->load->view('admin/namabarang/v_add', $data, FALSE);
        $this->load->view('admin/namabarang/v_update', $data, FALSE);
        $this->load->view('admin/namabarang/v_delete', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|is_unique[tb_nama.nama_barang]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_barang' => $this->input->post('nama_barang'),
            ];
            $this->M_namabarang->simpan_nama($data_input);
            $this->session->set_flashdata('success', 'Nama barang berhasil ditambahkan.');
            redirect('namabarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Nama Barang',
            'action'    => 'Nama Barang',
            'nama'    => $this->M_namabarang->ambil_semua(),
            'konten'    => 'admin/v_namabarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal nama barang
        $this->load->view('admin/namabarang/v_add', $data, FALSE);
        $this->load->view('admin/namabarang/v_update', $data, FALSE);
        $this->load->view('admin/namabarang/v_delete', $data, FALSE);
    }

    //Update one item
    public function update($id_nama = NULL)
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|is_unique[tb_nama.nama_barang]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_barang' => $this->input->post('nama_barang'),
            ];
            $this->M_namabarang->perbarui_nama($id_nama, $data_input);
            $this->session->set_flashdata('success', 'Nama barang berhasil diperbarui.');
            redirect('namabarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Nama Barang',
            'action'    => 'Nama Barang',
            'nama'    => $this->M_namabarang->ambil_semua(),
            'konten'    => 'admin/v_namabarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal nama barang
        $this->load->view('admin/namabarang/v_add', $data, FALSE);
        $this->load->view('admin/namabarang/v_update', $data, FALSE);
        $this->load->view('admin/namabarang/v_delete', $data, FALSE);
    }

    //Delete one item
    public function delete($id_nama = NULL)
    {
        $this->M_namabarang->hapus_nama($id_nama);
        $this->session->set_flashdata('success', 'Nama barang berhasil dihapus!');
        redirect('namabarang', 'refresh');
    }
}

/* End of file NamaBarang.php */
