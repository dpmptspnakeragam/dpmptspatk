<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KategoriBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_kategoribarang');
    }

    // List all your items
    public function index()
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Kategori Barang',
            'action'    => 'Kategori Barang',
            'kategori'  => $this->M_kategoribarang->ambil_semua(),
            'konten'    => 'admin/v_kategoribarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal delete kategori barang
        $this->load->view('admin/kategoribarang/v_delete', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_kategori', 'Kategori Barang', 'trim|required|is_unique[tb_kategori.nama_kategori]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_kategori' => $this->input->post('nama_kategori'),
            ];
            $this->M_kategoribarang->simpan_kategori($data_input);
            $this->session->set_flashdata('success', 'Kategori barang berhasil ditambahkan.');
            redirect('kategoribarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Kategori Barang',
            'action'    => 'Kategori Barang',
            'kategori'    => $this->M_kategoribarang->ambil_semua(),
            'konten'    => 'admin/kategoribarang/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Update one item
    public function update($id_kategori = NULL)
    {
        $this->form_validation->set_rules('nama_kategori', 'Kategori Barang', 'trim|required|is_unique[tb_kategori.nama_kategori]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_kategori' => $this->input->post('nama_kategori'),
            ];
            $this->M_kategoribarang->perbarui_kategori($id_kategori, $data_input);
            $this->session->set_flashdata('success', 'Kategori barang berhasil diperbarui.');
            redirect('kategoribarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Kategori Barang',
            'action'    => 'Kategori Barang',
            'kategori'    => $this->M_kategoribarang->ambil_semua(),
            'konten'    => 'admin/v_kategoribarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal kategori barang
        $this->load->view('admin/kategoribarang/v_add', $data, FALSE);
        $this->load->view('admin/kategoribarang/v_update', $data, FALSE);
        $this->load->view('admin/kategoribarang/v_delete', $data, FALSE);
    }

    //Delete one item
    public function delete($id_kategori = NULL)
    {
        $this->M_kategoribarang->hapus_kategori($id_kategori);
        $this->session->set_flashdata('success', 'Kategori barang berhasil dihapus!');
        redirect('kategoribarang', 'refresh');
    }
}

/* End of file KategoriBarang.php */
