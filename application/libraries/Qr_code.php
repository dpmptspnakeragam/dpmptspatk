<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qr_code
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        log_message('info', 'QR Code Class Initialized');
    }

    public function generate_qr_code($kode_perm, $filename = FALSE, $size = 10, $level = 'H')
    {
        // Load library QR Code PHP
        require_once APPPATH . 'libraries/phpqrcode/qrlib.php';

        // URL yang ingin disematkan di dalam QR Code
        $url = base_url('permintaan/cetak_qr/' . $kode_perm); // Tambahkan parameter kode_perm

        // Konfigurasi QR Code
        $config['cacheable']    = true; // cacheable QR Code
        $config['cachedir']     = APPPATH . 'cache/'; // tempat penyimpanan cache QR Code
        $config['errorlog']     = APPPATH . 'logs/'; // direktori untuk log jika terjadi error
        $config['imagedir']     = FCPATH . 'assets/image/qrcode/'; // direktori tempat penyimpanan QR Code yang dihasilkan
        $config['quality']      = true; // tingkat kualitas QR Code

        // Buat folder qrcode jika belum ada
        if (!is_dir($config['imagedir'])) {
            mkdir($config['imagedir'], 0777, true);
        }

        // Nama file QR Code yang akan disimpan
        $file_name = $filename ? $filename : 'qr_' . time() . '.png';

        // Path lengkap tempat penyimpanan QR Code
        $file_path = $config['imagedir'] . $file_name;

        // Generate QR Code dengan URL
        QRcode::png($url, $file_path, $level, $size);

        // Kembalikan nama file QR Code yang dihasilkan
        return $file_name;
    }
}
