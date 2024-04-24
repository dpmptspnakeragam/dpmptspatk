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
            'data_konfperm' => $this->M_permintaan->tampilkan_tabel_konfperm(),
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load model konfirmasi, delete permintaan
        $this->load->view('admin/permintaan/v_konfirmasi', $data, FALSE);
        $this->load->view('admin/permintaan/v_tolak_konf', $data, FALSE);
        $this->load->view('admin/permintaan/v_detail', $data, FALSE);
        $this->load->view('admin/permintaan/v_delete_rkp', $data, FALSE);
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
        // $kode_perm = "PERM" . '_' . date('dmY') . '_' . $id_user . '_' . uniqid();
        $kode_perm = "PERM" . '_' . $id_user . '_' . uniqid();

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
            'keterangan' => $keterangan,
            'tanggal_konfperm' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_konfperm', $data_konf);
    }

    public function konfirmasi($id_konfperm)
    {
        $data_konfirmasi = [
            'tanggal_konfperm' => date('Y-m-d H:i:s'),
            'status_konfperm' => 'Dikonfirmasi',
        ];

        $qr_name = "PERM" . '_' . $id_konfperm;

        // Generate QR Code
        $image_name = $this->qr_code->generate_qr_code($id_konfperm, 'QR_' . $qr_name . '.png', 10, 'H');

        // Simpan nama file QR Code dan data konfirmasi ke database
        $this->M_permintaan->simpan_qr_code($id_konfperm, $image_name);
        $this->M_permintaan->konfirmasi_permintaan($id_konfperm, $data_konfirmasi);
        $this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi dan ditanda tangan!');
        redirect('permintaan', 'refresh');
    }

    public function tolak_konf($id_konfperm)
    {
        $data = [
            'tanggal_konfperm' => date('Y-m-d H:i:s'),
            'status_konfperm' => 'Ditolak'
        ];

        $this->M_permintaan->tolak_konf_permintaan($id_konfperm, $data);
        $this->session->set_flashdata('success', 'Permintaan berhasil ditolak dan data terhapus!');
        redirect('permintaan', 'refresh');
    }

    public function delete_riwayat_konfperm($id_konfperm)
    {
        // Hapus QR code terlebih dahulu sebelum menghapus data dari tabel
        $this->hapus_qr_code($id_konfperm);

        // ambil kode_perm dari tabel tb_konfperm berdasarkan id_konfperm
        $kode_perm = $this->M_permintaan->ambil_kode_perm($id_konfperm);

        if ($kode_perm) {
            $this->M_permintaan->hapus_riwayat_konfperm($id_konfperm);
            $this->M_permintaan->hapus_riwayat_perm($kode_perm);
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data. Kode permintaan tidak ditemukan.');
        }

        redirect('permintaan', 'refresh');
    }

    private function hapus_qr_code($id_konfperm)
    {

        // Lokasi QR code yang akan dihapus
        $lokasi_qr_code = FCPATH . 'assets/image/qrcode/';

        // Format nama file QR code
        $qr_name = "QR_PERM_" . $id_konfperm . ".png";

        // Path lengkap file QR code yang akan dihapus
        $file_path = $lokasi_qr_code . $qr_name;

        // Hapus QR code jika ada
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    public function print_permintaan($kode_perm)
    {
        $data = [
            'home' => FALSE,
            'title' => FALSE,
            'action' => $kode_perm,
            'konten'    => 'admin/permintaan/laporan/v_cetak',
            'data_konfperm' => $this->M_permintaan->tampilkan_tabel_konfperm(),
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }
}

/* End of file Permintaan.php */
