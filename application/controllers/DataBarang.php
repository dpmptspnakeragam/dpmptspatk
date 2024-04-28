<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_databarang');
        // Check role and redirect back to previous page if needed
        $this->lib_valid->check_role();
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

        // load view modal delete data barang
        $this->load->view('admin/databarang/v_delete', $data, FALSE);
        $this->load->view('admin/databarang/v_detail', $data, FALSE);
    }

    // Add Data Barang
    public function add()
    {
        $this->form_validation->set_rules('barang', 'Nama Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);

        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'id_nama'       => $this->input->post('barang'),
                'id_kategori'   => $this->input->post('kategori'),
                'id_satuan'     => $this->input->post('satuan'),
                'harga'         => $this->input->post('harga'),
                'stok'          => $this->input->post('stok'),
                'deskripsi'     => $this->input->post('deskripsi'),
            ];
            $this->M_databarang->tambah_barang($data_input);

            $this->session->set_flashdata('success', 'Data barang berhasil ditambahkan');
            redirect('databarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data Barang',
            'action'    => 'Tambah Barang',
            'nama'      => $this->M_databarang->nama(),
            'kategori'  => $this->M_databarang->kategori(),
            'satuan'    => $this->M_databarang->satuan(),
            'konten'    => 'admin/databarang/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Update Data Barang
    public function update($id_barang = NULL)
    {
        $this->form_validation->set_rules('barang', 'Nama Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'id_nama'   => $this->input->post('barang'),
                'id_kategori'   => $this->input->post('kategori'),
                'id_satuan'     => $this->input->post('satuan'),
                'harga'         => $this->input->post('harga'),
                'stok'          => $this->input->post('stok'),
                'deskripsi'     => $this->input->post('deskripsi'),
            ];
            $this->M_databarang->perbarui_barang($id_barang, $data_input);

            $this->session->set_flashdata('success', 'Data barang berhasil diperbarui');
            redirect('databarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data Barang',
            'action'    => 'Perbarui Barang',
            'nama'      => $this->M_databarang->nama(),
            'kategori'  => $this->M_databarang->kategori(),
            'satuan'    => $this->M_databarang->satuan(),
            'barang_id' => $this->M_databarang->ambil_id_barang($id_barang),
            'konten'    => 'admin/databarang/v_update',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Delete Data Barang
    public function delete($id_barang = NULL)
    {
        $this->M_databarang->hapus_barang($id_barang);

        $this->session->set_flashdata('success', 'Data barang berhasil dihapus.');
        redirect('databarang', 'refresh');
    }
}

/* End of file DataBarang.php */
