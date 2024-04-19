<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_permintaan');
        $this->load->library('qr_code');
    }

    public function konfirmasi($id_validasi)
    {
        if (!empty($id_validasi)) {
            $this->M_permintaan->konfirmasi_permintaan($id_validasi);

            // Generate QR Code
            $image_name = $this->qr_code->generate_qr_code($id_validasi, 'qr_' . $id_validasi . '.png', 10, 'H');

            // Simpan nama file QR Code ke database
            $this->M_permintaan->simpan_qr_code($id_validasi, $image_name);

            $this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi.');
            redirect('permintaan');
        } else {
            $this->session->set_flashdata('error', 'ID Validasi tidak valid.');
            redirect('permintaan');
        }
    }

    // List all your items
    public function index($offset = 0)
    {
        $data = [
            'home'          => 'Transaksi',
            'title'         => 'Permintaan ATK',
            'action'        => 'Permintaan ATK',
            'action2'        => 'Riwayat Permintaan ATK',
            'permintaan'    => $this->M_permintaan->ambil_semua(),
            'konten'        => 'admin/v_permintaan',
        ];

        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load semua view modal permintaan barang
        // $this->load->view('admin/permintaan/v_detail', $data, FALSE);
        $this->load->view('admin/permintaan/v_validasi', $data, FALSE);
        $this->load->view('admin/permintaan/v_detail_validasi', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules('peminta', 'Nama Peminta', 'trim|required', [
            'required'          => 'Pilih %s!',
        ]);
        $this->form_validation->set_rules('id_barang', 'Nama Barang', 'trim|required|callback_check_id_barang', [
            'required'          => 'Pilih %s!',
            'check_id_barang'   => '%s sudah ada untuk ID Validasi ini!',
        ]);
        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'trim|required', [
            'required'          => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required'          => '%s harus diisi!',
        ]);

        if ($this->form_validation->run() == TRUE) {
            $id_user = $this->input->post('peminta');
            $id_barang = $this->input->post('id_barang');
            $jumlah = $this->input->post('jumlah');
            $total_harga = $jumlah * filter_var($this->input->post('harga'), FILTER_SANITIZE_NUMBER_INT);
            $keterangan = $this->input->post('keterangan');
            $status = 'menunggu';

            $tanggal_validasi = date('d-m-Y');

            $id_validasi = $id_user . '_' . $tanggal_validasi;

            $data_input = [
                'id_user'               => $id_user,
                'id_barang'             => $id_barang,
                'jumlah'                => $jumlah,
                'total_harga'           => $total_harga,
                'keterangan'            => $keterangan,
                'status'                => $status,
                'id_validasi'           => $id_validasi,
            ];

            $this->M_permintaan->simpan_permintaan($data_input);

            $this->session->set_flashdata('success', 'Permintaan barang berhasil ditambahkan.');
            redirect('permintaan');
            exit();
        }

        $data = [
            'home'          => 'Transaksi',
            'title'         => 'Permintaan Barang',
            'action'        => 'Permintaan Barang',
            'barang'        => $this->M_permintaan->ambil_barang(),
            'konten'        => 'admin/permintaan/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function check_id_barang($id_barang)
    {
        $id_user = $this->input->post('peminta');
        $tanggal_validasi = date('d-m-Y');
        $id_validasi = $id_user . '_' . $tanggal_validasi;

        // Ambil status barang dari model $barang berdasarkan id_validasi
        $status = $this->M_permintaan->get_status_by_id_validasi($id_validasi);

        // Jika status adalah 'menunggu', lakukan validasi
        if ($status == 'menunggu') {
            // Ambil data barang
            $barang = $this->M_permintaan->ambil_barang();

            // Periksa keberadaan id_barang berdasarkan id_validasi
            $existing_id_barang = $this->M_permintaan->check_id_barang_exists($id_barang, $id_validasi);

            if ($existing_id_barang) {
                $this->form_validation->set_message('check_id_barang', 'ID Barang sudah ada untuk ID Validasi ini.');
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            // Jika status adalah 'dikonfirmasi', tidak perlu validasi
            return TRUE;
        }
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

/* End of file Permintaan.php */
