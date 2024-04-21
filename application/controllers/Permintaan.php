<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_permintaan');
    }

    public function index()
    {
        $data = [
            'home' => 'Transaksi',
            'title' => 'Permintaan ATK',
            'action' => 'Permintaan ATK',
            'konten'    => 'admin/v_permintaan',
            'data_permintaan' => $this->M_permintaan->tampilkan_tabel_konfperm()
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load model konfirmasi permintaan
        $this->load->view('admin/permintaan/v_konfirmasi', $data, FALSE);
    }


    public function add()
    {
        $data = [
            'home' => 'Transaksi',
            'title' => 'Permintaan ATK',
            'action' => 'Tambah Permintaan ATK',
            'konten' => 'admin/permintaan/v_add',
            'data_barang' => $this->M_permintaan->tampilkan_data_barang(),
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function simpan_permintaan()
    {
        $keterangan = $this->input->post('keterangan');
        $barang = json_decode($this->input->post('barang'), true);
        $id_user = $this->session->userdata('id_user');

        // Pembentukan kode permintaan yang unik
        $kode_perm = "PERM" . '_' . date('dmY') . '_' . $id_user . '_' . uniqid();

        // Hitung total bayar dari hasil penambahan sub_total
        $total_bayar = 0;
        foreach ($barang as $item) {
            $total_bayar += $item['sub_total'];
        }

        // Simpan data ke dalam tabel tb_perm
        foreach ($barang as $item) {
            $data_perm = array(
                'kode_perm' => $kode_perm,
                'id_user' => $id_user,
                'id_barang' => $item['id_barang'],
                'jumlah_perm' => $item['jumlah_permintaan'],
                'sub_total' => $item['sub_total']
            );
            $this->db->insert('tb_perm', $data_perm);
        }

        // Simpan data ke dalam tabel tb_konfperm
        $data_konf = array(
            'kode_perm' => $kode_perm,
            'status_konfperm' => 'Menunggu',
            'total_bayar' => $total_bayar,
            'keterangan' => $keterangan
        );
        $this->db->insert('tb_konfperm', $data_konf);
    }

    public function konfirmasi($id_konfperm)
    {
        $data_konfirmasi = [
            'tanggal_konfperm' => date('Y-m-d H:i:s'),
            'status_konfperm' => 'Dikonfirmasi',
        ];

        // Generate QR Code
        $image_name = $this->qr_code->generate_qr_code($id_konfperm, 'qr_' . $id_konfperm . '.png', 10, 'H');

        // Simpan nama file QR Code dan data konfirmasi ke database
        $this->M_permintaan->simpan_qr_code($id_konfperm, $image_name);
        $this->M_permintaan->konfirmasi_permintaan($id_konfperm, $data_konfirmasi);
        $this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi dan ditanda tangan!');
        redirect('permintaan', 'refresh');
    }
}

/* End of file Permintaan.php */
