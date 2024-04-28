<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SatuanBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_satuanbarang');
        if ($this->session->userdata('role') != 1) {
            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($redirect_url, 'refresh');
        }
    }

    public function index()
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Satuan Barang',
            'action'    => 'Satuan Barang',
            'satuan'    => $this->M_satuanbarang->ambil_semua(),
            'konten'    => 'admin/v_satuanbarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load modal hapus satuan barang
        $this->load->view('admin/satuanbarang/v_delete', $data, FALSE);
    }

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
            'action'    => 'Tambah Satuan Barang',
            'satuan'    => $this->M_satuanbarang->ambil_semua(),
            'konten'    => 'admin/satuanbarang/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

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
            'action'    => 'Perbarui Satuan Barang',
            'satuan'    => $this->M_satuanbarang->ambil_semua(),
            'satuan_id' => $this->M_satuanbarang->ambil_id_satuan($id_satuan),
            'konten'    => 'admin/satuanbarang/v_update',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function delete($id_satuan = NULL)
    {
        $this->M_satuanbarang->hapus_satuan($id_satuan);
        $this->session->set_flashdata('success', 'Satuan barang berhasil dihapus!');
        redirect('satuanbarang', 'refresh');
    }
}

/* End of file SatuanBarang.php */
