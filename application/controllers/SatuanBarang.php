<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SatuanBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_satuanbarang');
    }

    // List all your items
    public function index($offset = 0)
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Satuan Barang',
            'action'    => 'Satuan Barang',
            'satuan'    => $this->M_satuanbarang->ambil_semua(),
            'konten'    => 'admin/v_satuanbarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal satuan barang
        $this->load->view('admin/satuanbarang/v_add', $data, FALSE);
        $this->load->view('admin/satuanbarang/v_update', $data, FALSE);
        $this->load->view('admin/satuanbarang/v_delete', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('nama_satuan', 'Satuan Barang', 'trim|required|is_unique[tb_satuan.nama_satuan]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_satuan' => $this->input->post('nama_satuan'),
            ];
            $this->M_satuanbarang->simpan_satuan($data_input);
            $this->session->set_flashdata('success', 'Satuan barang berhasil ditambahkan.');
            redirect('satuanbarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Satuan Barang',
            'action'    => 'Satuan Barang',
            'satuan'    => $this->M_satuanbarang->ambil_semua(),
            'konten'    => 'admin/v_satuanbarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal satuan barang
        $this->load->view('admin/satuanbarang/v_add', $data, FALSE);
        $this->load->view('admin/satuanbarang/v_update', $data, FALSE);
        $this->load->view('admin/satuanbarang/v_delete', $data, FALSE);
    }

    //Update one item
    public function update($id_satuan = NULL)
    {
        $this->form_validation->set_rules('nama_satuan', 'Satuan Barang', 'trim|required|is_unique[tb_satuan.nama_satuan]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_satuan' => $this->input->post('nama_satuan'),
            ];
            $this->M_satuanbarang->perbarui_satuan($id_satuan, $data_input);
            $this->session->set_flashdata('success', 'Satuan barang berhasil diperbarui.');
            redirect('satuanbarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Satuan Barang',
            'action'    => 'Satuan Barang',
            'satuan'    => $this->M_satuanbarang->ambil_semua(),
            'konten'    => 'admin/v_satuanbarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal satuan barang
        $this->load->view('admin/satuanbarang/v_add', $data, FALSE);
        $this->load->view('admin/satuanbarang/v_update', $data, FALSE);
        $this->load->view('admin/satuanbarang/v_delete', $data, FALSE);
    }

    //Delete one item
    public function delete($id_satuan = NULL)
    {
        $this->M_satuanbarang->hapus_satuan($id_satuan);
        $this->session->set_flashdata('success', 'Satuan barang berhasil dihapus!');
        redirect('satuanbarang', 'refresh');
    }
}

/* End of file SatuanBarang.php */
