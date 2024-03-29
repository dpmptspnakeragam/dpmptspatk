<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function index($offset = 0)
	{
		$data = array(
			'title' => 'ATK DPMPTSP Kabupaten Agam',
			'konten' => 'v_home',
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
