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

    public function generate_qr_code($id_konfperm, $filename = FALSE, $size = 10, $level = 'H')
    {
        // Load library QR Code PHP
        require_once APPPATH . 'libraries/phpqrcode/qrlib.php';

        // Ambil kode_perm dari tabel tb_konfperm berdasarkan id_konfperm
        $query = $this->ci->db->get_where('tb_konfperm', array('id_konfperm' => $id_konfperm));
        $result = $query->row();
        if (!$result) {
            // Jika data tidak ditemukan, kembalikan false atau lakukan penanganan yang sesuai
            return FALSE;
        }
        $id_konfperm = $result->id_konfperm;

        // URL yang ingin disematkan di dalam QR Code
        $url = base_url('permintaan/cetak/' . $id_konfperm);

        // Konfigurasi QR Code
        $config['cacheable']    = true;
        $config['cachedir']     = APPPATH . 'cache/';
        $config['errorlog']     = APPPATH . 'logs/';
        $config['imagedir']     = FCPATH . 'assets/image/qrcode/';
        $config['quality']      = true;

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
