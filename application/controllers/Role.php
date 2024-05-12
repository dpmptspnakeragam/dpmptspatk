<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_role');

        if ($this->session->userdata('id_role') != 1) {
            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($redirect_url, 'refresh');
        }

        $id_user = $this->session->userdata('id_user');
        if ($id_user && !$this->lib_login->cek_id($id_user)) {
            $this->lib_login->clear_userdata();
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'home'      => 'Setting',
            'title'     => 'Role',
            'action'    => 'Setting Role',
            'konten'    => 'admin/v_role',
            'role'      => $this->M_role->ambil_semua()
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load modal hapus role
        $this->load->view('admin/role/v_delete', $data, FALSE);
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_role', 'Role', 'trim|required|is_unique[tb_role.nama_role]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);

        if ($this->form_validation->run() == TRUE) {

            $data_input = [
                'nama_role' => $this->input->post('nama_role'),
            ];
            $this->M_role->simpan($data_input);

            $this->session->set_flashdata('success', 'Role berhasil ditambahkan.');
            redirect('role', 'refresh');
        }

        $data = [
            'home'      => 'Setting',
            'title'     => 'Role',
            'action'    => 'Tambah Role',
            'konten'    => 'admin/role/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function update($id_role = NULL)
    {
        $this->form_validation->set_rules('nama_role', 'Role', 'trim|required|is_unique[tb_role.nama_role]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);

        if ($this->form_validation->run() == TRUE) {
            $data_input = [
                'nama_role' => $this->input->post('nama_role'),
            ];
            $this->M_role->perbarui($id_role, $data_input);

            $this->session->set_flashdata('success', 'Role berhasil diperbarui.');
            redirect('role', 'refresh');
        }

        $data = [
            'home'      => 'Setting',
            'title'     => 'Role',
            'action'    => 'Perbarui Role',
            'konten'    => 'admin/role/v_update',
            'id'        => $this->M_role->id($id_role)
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function delete($id_role = NULL)
    {
        $this->M_role->hapus($id_role);

        $this->session->set_flashdata('success', 'Role berhasil dihapus!');
        redirect('role', 'refresh');
    }
}

/* End of file Role.php */
