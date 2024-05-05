<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('M_home');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title'			=> 'ATK DPMPTSP Kabupaten Agam',
			'konten'		=> 'v_home',
			'view_barang'	=> $this->M_home->ambil_barang(),
			'kategori'		=> $this->M_home->kategori(),
			'produk'		=> $this->M_home->produk(),
		);
		$this->load->view('layout/v_home_wrapper', $data, FALSE);
	}

	public function search()
	{
		$keyword = $this->input->get('keyword');

		if (empty($keyword)) {
			$this->session->set_flashdata('warning', 'Masukkan nama barang untuk melakukan pencarian.');
			redirect('home');
		}

		$data = array(
			'title'             => 'ATK DPMPTSP Kabupaten Agam',
			'konten'            => 'v_home',
			'view_barang'       => $this->M_home->ambil_barang(),
			'kategori'          => $this->M_home->kategori(),
			'produk'            => $this->M_home->produk(),
			'view_nama_barang'  => $this->M_home->searchBarang($keyword),
		);

		// Check if search result is empty
		if (empty($data['view_nama_barang'])) {
			$this->session->set_flashdata('warning', 'Barang tidak ditemukan.');
		}

		$this->load->view('layout/v_home_wrapper', $data, FALSE);
	}

	public function kategori($id_kategori)
	{
		$data = array(
			'title'             => 'ATK DPMPTSP Kabupaten Agam',
			'konten'            => 'v_home',
			'view_barang'       => $this->M_home->ambil_barang_by_kategori($id_kategori),
			'kategori'          => $this->M_home->kategori(),
			'produk'            => $this->M_home->produk(),
		);

		$this->load->view('layout/v_home_wrapper', $data, FALSE);
	}

	public function detail($id_barang)
	{
		$data = array(
			'title'         => 'Detail Barang',
			'konten'        => 'home/v_detail_barang',
			'detail_barang' => $this->M_home->ambil_detail_barang($id_barang),
			'view_barang'	=> $this->M_home->ambil_barang()
		);

		$this->load->view('layout/v_home_wrapper', $data, FALSE);
	}
}

/* End of file Home.php */
