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

	// Add a new item
	public function add()
	{
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

/* End of file Home.php */
