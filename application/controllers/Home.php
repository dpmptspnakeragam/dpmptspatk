<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('M_home');

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

	// List all your items
	public function index($page = 1)
	{
		$per_page = 12;
		$start = ($page - 1) * $per_page;

		$data = array(
			'title_website' => 'Home | ATK DPMPTSP Kabupaten Agam',
			'home'         => 'Home',
			'title1'         => false,
			'title2'        => false,
			'konten'        => 'v_home',
			'view_barang'   => $this->M_home->ambil_barang_paginated($start, $per_page),
			'kategori'      => $this->M_home->kategori(),
			'produk'        => $this->M_home->produk(),
		);

		$this->load->library('pagination');

		$config['base_url'] = base_url('home/index');
		$config['total_rows'] = count($this->M_home->ambil_barang());
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$data['pagination'] = array(
			'total_pages' => ceil($config['total_rows'] / $config['per_page']),
			'current_page' => $page,
		);

		$this->load->view('layout/v_home_wrapper', $data);
	}

	public function search()
	{
		$keyword = $this->input->get('keyword');

		if (empty($keyword)) {
			$this->session->set_flashdata('warning', 'Masukkan nama barang untuk melakukan pencarian.');
			redirect('home');
		}

		// Pagination configuration
		$per_page = 12;
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		$start = ($page - 1) * $per_page;

		$data = array(
			'title_website' => 'Search | ATK DPMPTSP Kabupaten Agam',
			'home'         => 'Home',
			'title1'             => 'Search',
			'title2'            => $keyword,
			'konten'            => 'v_home',
			'view_barang'       => $this->M_home->ambil_barang(),
			'kategori'          => $this->M_home->kategori(),
			'produk'            => $this->M_home->produk(),
			'view_barang'  => $this->M_home->searchBarangPage($keyword, $start, $per_page),
		);

		// Pagination initialization
		$config['base_url'] = base_url("home/search?keyword={$keyword}");
		$config['total_rows'] = count($this->M_home->searchBarangkeyword($keyword));
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		// Set pagination data
		$data['pagination'] = array(
			'total_pages' => ceil($config['total_rows'] / $per_page),
			'current_page' => $page,
			'keyword' => $keyword,
		);

		// Check if search result is empty
		if (empty($data['view_barang'])) {
			$this->session->set_flashdata('warning', 'Barang tidak ditemukan.');
		}

		$this->load->view('layout/v_home_wrapper', $data, FALSE);
	}

	public function kategori($id_kategori, $page = 1)
	{
		$per_page = 12;
		$start = ($page - 1) * $per_page;

		$kategori = $this->M_home->get_kategori_by_id($id_kategori);

		$data = array(
			'title_website' => 'Kategori | ATK DPMPTSP Kabupaten Agam',
			'home'         => 'Home',
			'title1'         => 'Kategori',
			'title2'         => $kategori,
			'konten'        => 'v_home',
			'view_barang'   => $this->M_home->ambil_barang_by_kategori_paginated($id_kategori, $start, $per_page),
			'kategori'      => $this->M_home->kategori(),
			'produk'        => $this->M_home->produk(),
		);

		$this->load->library('pagination');

		$config['base_url'] = base_url("home/kategori/$id_kategori");
		$config['total_rows'] = count($this->M_home->ambil_barang_by_kategori($id_kategori));
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$data['pagination'] = array(
			'total_pages' => ceil($config['total_rows'] / $per_page),
			'current_page' => $page,
			'kategori_id' => $id_kategori,
		);

		$this->load->view('layout/v_home_wrapper', $data);
	}

	public function produk($id_nama, $page = 1)
	{
		$per_page = 12;
		$start = ($page - 1) * $per_page;

		$produk = $this->M_home->get_produk_by_id($id_nama);

		$data = array(
			'title_website' => 'Produk | ATK DPMPTSP Kabupaten Agam',
			'home'         => 'Home',
			'title1'         => 'Produk',
			'title2'         => $produk,
			'konten'        => 'v_home',
			'view_barang'   => $this->M_home->ambil_barang_by_produk_paginated($id_nama, $start, $per_page),
			'kategori'      => $this->M_home->kategori(),
			'produk'        => $this->M_home->produk(),
		);

		$this->load->library('pagination');

		$config['base_url'] = base_url("home/produk/$id_nama");
		$config['total_rows'] = count($this->M_home->ambil_barang_by_nama_barang($id_nama));
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$data['pagination'] = array(
			'total_pages' => ceil($config['total_rows'] / $per_page),
			'current_page' => $page,
			'kategori_id' => $id_nama,
		);

		$this->load->view('layout/v_home_wrapper', $data);
	}

	public function detail($id_barang)
	{

		$detail = $this->M_home->ambil_nama_barang($id_barang);

		$data = array(
			'title_website' => 'Detail | ATK DPMPTSP Kabupaten Agam',
			'home'         => 'Home',
			'title1'         => 'Detail',
			'title2'        => $detail,
			'konten'        => 'home/v_detail_barang',
			'detail_barang' => $this->M_home->ambil_detail_barang($id_barang),
			'view_barang'	=> $this->M_home->ambil_barang(),
			'kategori'      => $this->M_home->kategori(),
			'produk'        => $this->M_home->produk(),
		);

		$this->load->view('layout/v_home_wrapper', $data, FALSE);
	}
}

/* End of file Home.php */
