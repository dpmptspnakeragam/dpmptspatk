<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_permintaanbarang');
    }

    // List all your items
    public function index($offset = 0)
    {
        $data = [
            'home'          => 'Transaksi',
            'title'         => 'Permintaan Barang',
            'action'        => 'Permintaan Barang',
            'permintaan'    => $this->M_permintaanbarang->ambil_semua(),
            'konten'        => 'admin/v_permintaanbarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('peminta', 'Nama Peminta', 'trim|required', [
            'required'      => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('barang', 'Nama Barang', 'trim|required', [
            'required'      => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Barang', 'trim|required', [
            'required'      => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required', [
            'required'      => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('harga', 'Harga Barang', 'trim|required', [
            'required'      => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'trim|required', [
            'required'      => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required'      => '%s harus diisi!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'id_user'       => $this->input->post('peminta'),
                'id_barang'     => $this->input->post('barang'),
                'id_kategori'   => $this->input->post('kategori'),
                'id_satuan'     => $this->input->post('satuan'),
                'harga'         => $this->input->post('harga'),
                'jumlah'        => $this->input->post('jumlah'),
                'total'         => $this->input->post('harga') * $this->input->post('jumlah'),
                'keterangan'    => $this->input->post('keterangan'),
            ];

            $this->M_permintaanbarang->simpan_permintaan($data_input);

            $this->session->set_flashdata('success', 'Permintaan barang berhasil ditambahkan.');
            redirect('permintaanbarang');
        }

        $data = [
            'home'          => 'Transaksi',
            'title'         => 'Permintaan Barang',
            'action'        => 'Tambah Permintaan Barang',
            'permintaan'    => $this->M_permintaanbarang->ambil_semua(),
            'nama'          => $this->M_permintaanbarang->ambil_nama(),
            'user'          => $this->M_permintaanbarang->ambil_user(),
            'kategori'      => $this->M_permintaanbarang->ambil_kategori(),
            'satuan'        => $this->M_permintaanbarang->ambil_satuan(),
            'konten'        => 'admin/permintaanbarang/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
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

/* End of file PermintaanBarang.php */
