<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function ambil_user()
    {
        return $this->db->count_all('tb_user');
    }

    public function ambil_barang()
    {
        return $this->db->count_all('tb_barang');
    }

    public function ambil_kategori()
    {
        return $this->db->count_all('tb_kategori');
    }

    public function ambil_permintaan()
    {
        $status = array(1, 2, 3);
        $this->db->where_in('status_konfperm', $status);
        return $this->db->count_all_results('tb_konfperm');
    }

    public function ambil_tte()
    {
        return $this->db->where('status_konfperm', 'Menunggu')->count_all_results('tb_konfperm');
    }

    public function ambil_tb_konfperm()
    {
        // Ambil data jumlah permintaan yang dikonfirmasi per bulan dari tabel tb_konfperm
        $this->db->select('MONTH(tanggal_konfperm) as bulan, COUNT(*) as jumlah_permintaan');
        $this->db->where('status_konfperm', 'Selesai');
        $this->db->group_by('MONTH(tanggal_konfperm)');
        return $this->db->get('tb_konfperm')->result();
    }
}

/* End of file M_dashboard.php */
