<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_permintaan');
        $this->load->library('tcpdf');

        // Get the id_user from wherever it is stored
        $id_user = $this->session->userdata('id_user'); // Assuming it's stored in session

        // Check if id_user exists in tb_user using Lib_login
        if ($id_user && !$this->lib_login->cek_id($id_user)) {
            // Clear userdata if id_user doesn't exist
            $this->lib_login->clear_userdata();

            // Redirect to login page
            redirect('login'); // Adjust 'login' to the actual login page URL
        }
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
        $this->load->view('admin/permintaan/v_konf_1', $data, FALSE);
        $this->load->view('admin/permintaan/v_konf_2', $data, FALSE);
        $this->load->view('admin/permintaan/v_konf_3', $data, FALSE);
        $this->load->view('admin/permintaan/v_tolak_konf', $data, FALSE);
        $this->load->view('admin/permintaan/v_delete_rkp', $data, FALSE);
        $this->load->view('admin/permintaan/v_delete_perm', $data, FALSE);
        $this->load->view('admin/permintaan/v_batalkan_perm', $data, FALSE);
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
            'status_konfperm' => 1,
            'total_bayar' => $total_bayar,
            'keterangan' => $keterangan,
            'tanggal_konfperm' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_konfperm', $data_konf);
    }

    public function konf1($id_konfperm)
    {
        $data_konfirmasi = [
            'status_konfperm' => 2,
        ];

        $this->M_permintaan->konfirmasi_permintaan($id_konfperm, $data_konfirmasi);

        $this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi.');
        redirect('permintaan', 'refresh');
    }

    public function konf2($id_konfperm)
    {
        $data_konfirmasi = [
            'status_konfperm' => 3,
        ];

        $this->M_permintaan->konfirmasi_permintaan($id_konfperm, $data_konfirmasi);

        $this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi.');
        redirect('permintaan', 'refresh');
    }

    public function konf3($id_konfperm)
    {
        $data_konfirmasi = [
            'tanggal_konfperm' => date('Y-m-d H:i:s'),
            'status_konfperm' => 'Menunggu',
        ];

        $this->M_permintaan->konfirmasi_permintaan($id_konfperm, $data_konfirmasi);

        $this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi dan ditanda tangan.');
        redirect('permintaan', 'refresh');
    }

    public function tolak_perm($id_konfperm)
    {
        $data = [
            'tanggal_konfperm' => date('Y-m-d H:i:s'),
            'status_konfperm' => 'Ditolak'
        ];

        $this->M_permintaan->tolak_konf_permintaan($id_konfperm, $data);
        $this->session->set_flashdata('success', 'Permintaan berhasil ditolak dan data terhapus!');
        redirect('permintaan', 'refresh');
    }

    public function hapus_konf($id_konfperm)
    {
        // ambil kode_perm dari tabel tb_konfperm berdasarkan id_konfperm
        $kode_perm = $this->M_permintaan->ambil_kode_perm($id_konfperm);

        if ($kode_perm) {
            $this->M_permintaan->hapus_riwayat_konfperm($id_konfperm);
            $this->M_permintaan->hapus_riwayat_perm($kode_perm);
            $this->session->set_flashdata('success', 'Data permintaan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data. Kode permintaan tidak ditemukan.');
        }

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

        // ambil kode_perm dari tabel tb_konfperm berdasarkan id_konfperm
        $kode_perm = $this->M_permintaan->ambil_kode_perm($id_konfperm);

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

        // Lokasi PDF yang akan dihapus
        $lokasi_pdf = FCPATH . 'assets/pdf/';

        // Format nama file PDF
        $pdf_name = $kode_perm . ".pdf";

        // Path lengkap file PDF yang akan dihapus
        $file_path_pdf = $lokasi_pdf . $pdf_name;

        // Hapus PDF jika ada
        if (file_exists($file_path_pdf)) {
            unlink($file_path_pdf);
        }
    }

    public function tte($id_konfperm)
    {
        $qr_name = "PERM" . '_' . $id_konfperm;
        // Generate QR Code
        $image_name = $this->qr_code->generate_qr_code($id_konfperm, 'QR_' . $qr_name . '.png', 10, 'H');
        // Simpan nama file QR Code dan data konfirmasi ke database
        $this->M_permintaan->simpan_qr_code($id_konfperm, $image_name);

        $data_konfirmasi = [
            'tanggal_konfperm' => date('Y-m-d H:i:s'),
            'status_konfperm' => 'Selesai',
        ];

        $this->M_permintaan->konfirmasi_permintaan($id_konfperm, $data_konfirmasi);

        $this->session->set_flashdata('success', 'Permintaan berhasil ditanda tangan.');

        // mengambil kode_perm dari id_konfperm
        $kode_perm = $this->M_permintaan->ambil_kode_perm($id_konfperm);

        // Ambil data dari model
        $data['data_konfperm'] = $this->M_permintaan->tampilkan_tabel_konfperm();
        $data['nama_user'] = $this->M_permintaan->nama_user($kode_perm);
        $data['nama_barang'] = $this->M_permintaan->nama_barang($kode_perm);
        $data['tb_konfperm'] = $this->M_permintaan->tb_konfperm($kode_perm);
        $data['qr_code'] = $this->M_permintaan->qr_code($kode_perm);

        $data['kode_perm'] = $kode_perm;

        $this->load->view('admin/permintaan/v_validasi_qr', $data, FALSE);
    }

    public function cetak($id_konfperm)
    {

        // mengambil kode_perm dari id_konfperm
        $kode_perm = $this->M_permintaan->ambil_kode_perm($id_konfperm);

        // Ambil data dari model
        $data['data_konfperm'] = $this->M_permintaan->tampilkan_tabel_konfperm();
        $data['nama_user'] = $this->M_permintaan->nama_user($kode_perm);
        $data['nama_barang'] = $this->M_permintaan->nama_barang($kode_perm);
        $data['tb_konfperm'] = $this->M_permintaan->tb_konfperm($kode_perm);
        $data['qr_code'] = $this->M_permintaan->qr_code($kode_perm);

        $data['kode_perm'] = $kode_perm;

        $this->load->view('admin/permintaan/v_invoice', $data, FALSE);
    }

    // public function cetak($kode_perm)
    // {
    //     // Ambil data dari model
    //     $data['data_konfperm'] = $this->M_permintaan->tampilkan_tabel_konfperm();
    //     $data['nama_user'] = $this->M_permintaan->nama_user($kode_perm);
    //     $data['nama_barang'] = $this->M_permintaan->nama_barang($kode_perm);
    //     $data['total_bayar'] = $this->M_permintaan->total_bayar($kode_perm);
    //     $data['qr_code'] = $this->M_permintaan->qr_code($kode_perm);

    //     // Generate PDF content
    //     $pdf_content = $this->generate_pdf($data);

    //     // Kembalikan konten PDF sebagai respons HTTP
    //     header('Content-Type: application/pdf');
    //     header('Content-Disposition: inline; filename="invoice_' . $kode_perm . '.pdf"');
    //     header('Content-Transfer-Encoding: binary');
    //     header('Accept-Ranges: bytes');
    //     echo $pdf_content;
    // }

    // private function generate_pdf($data)
    // {
    //     // Load TCPDF
    //     require_once APPPATH . 'libraries/tcpdf/tcpdf.php';

    //     // Set judul dan ukuran halaman
    //     $pdf = new TCPDF('P', 'mm', 'F4', true, 'UTF-8', false);

    //     // Set margin
    //     $pdf->SetMargins(20, 0, 20, 0); // Atas, Kanan, Bawah, Kiri

    //     // Set header dan footer
    //     // $pdf->SetHeaderMargin(10);
    //     // $pdf->SetFooterMargin(10);

    //     // Set font
    //     $pdf->SetFont('times', '', 12);

    //     // Tambahkan halaman
    //     $pdf->AddPage();

    //     // Tambahkan konten HTML ke PDF
    //     ob_start();
    //     $this->load->view('admin/permintaan/v_cetak', $data); // Memuat view v_cetak.php dengan data yang diteruskan
    //     $html = ob_get_clean();

    //     // Tambahkan konten HTML ke PDF
    //     $pdf->writeHTML($html);

    //     // Output PDF sebagai string
    //     return $pdf->Output('', 'S');
    // }




    // public function cetak($kode_perm)
    // {
    //     $data['data_konfperm'] = $this->M_permintaan->tampilkan_tabel_konfperm();
    //     $data['nama_user'] = $this->M_permintaan->nama_user($kode_perm);
    //     $data['nama_barang'] = $this->M_permintaan->nama_barang($kode_perm);
    //     $data['total_bayar'] = $this->M_permintaan->total_bayar($kode_perm);
    //     $data['qr_code'] = $this->M_permintaan->qr_code($kode_perm);

    //     $this->load->view('admin/permintaan/v_cetak', $data);
    // }

    // public function data_atk($kode_perm)
    // {
    //     $data['data_konfperm'] = $this->M_permintaan->tampilkan_tabel_konfperm();
    //     $data['nama_user'] = $this->M_permintaan->nama_user($kode_perm);
    //     $data['nama_barang'] = $this->M_permintaan->nama_barang($kode_perm);
    //     $data['total_bayar'] = $this->M_permintaan->total_bayar($kode_perm);
    //     $data['qr_code'] = $this->M_permintaan->qr_code($kode_perm);

    //     $this->load->view('admin/permintaan/v_hasil_scan', $data);
    // }
}

/* End of file Permintaan.php */
