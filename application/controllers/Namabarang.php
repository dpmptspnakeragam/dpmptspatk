<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NamaBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_namabarang');
        if ($this->session->userdata('id_role') != 1) {
            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($redirect_url, 'refresh');
        }

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
            'home'      => 'Data Master',
            'title'     => 'Nama Barang',
            'action'    => 'Nama Barang',
            'nama'      => $this->M_namabarang->ambil_semua(),
            'konten'    => 'admin/v_namabarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal delete nama barang
        $this->load->view('admin/namabarang/v_delete', $data, FALSE);
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|is_unique[tb_nama.nama_barang]', [
            'required'  => '%s harus diisi!',
            'is_unique' => '%s sudah ada!',
        ]);

        if ($this->form_validation->run() == TRUE) {

            $config['upload_path'] = './assets/image/barang/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']  = '10240';
            $nama_barang = "gambar";

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($nama_barang)) {
                // copy dan upload gambar barang default
                $default_gambar = './assets/image/barang/barang-default.png';
                $file_extension = pathinfo($default_gambar, PATHINFO_EXTENSION);
                $random_file_name = uniqid('barang_', true) . '.' . $file_extension;
                $file_path = './assets/image/barang/' . $random_file_name;
                copy($default_gambar, $file_path);

                // lakukan resize gambar barang jika diperlukan
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_path;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data_input = [
                    'nama_barang'   => $this->input->post('nama_barang'),
                    'gambar'        => $random_file_name,
                ];
            } else {
                // upload gambar barang yang diunggah atau diupload
                $upload_gambar = $this->upload->data();
                $file_extension = pathinfo($upload_gambar['file_name'], PATHINFO_EXTENSION);
                $random_file_name = uniqid('barang_', true) . '.' . $file_extension;
                $file_path = './assets/image/barang/' . $random_file_name;

                // cek apakah file dengan nama unik jika sudah ada
                if (!file_exists($file_path)) {
                    if (copy($upload_gambar['full_path'], $file_path)) {
                        // hapus file yang diunggah sementara
                        unlink($upload_gambar['full_path']);

                        // lakukan resize gambar barang jika diperlukan
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $file_path;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $data_input = [
                            'nama_barang'   => $this->input->post('nama_barang'),
                            'gambar'        => $random_file_name,
                        ];
                    }
                }
            }

            $this->M_namabarang->simpan_nama($data_input);

            $this->session->set_flashdata('success', 'Nama barang berhasil ditambahkan.');
            redirect('namabarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Nama Barang',
            'action'    => 'Tambah Nama Barang',
            'nama'    => $this->M_namabarang->ambil_semua(),
            'konten'    => 'admin/namabarang/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function update($id_nama = NULL)
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', [
            'required' => '%s harus diisi!'
        ]);

        // ambil id nama barang
        $nama_id = $this->M_namabarang->ambil_id_nama($id_nama);

        // ambil data nama barang yang baru
        $gambar_barang = $this->input->post('nama_barang');

        // lakukan validasi hanya jika nama barang berubah
        if ($nama_id->nama_barang != $gambar_barang) {
            $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'is_unique[tb_nama.nama_barang]', [
                'is_unique' => '%s sudah ada!'
            ]);
        }

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/image/barang/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']  = '10240';
            $gambar_barang = "gambar";

            $this->upload->initialize($config);

            // Periksa apakah ada gambar yang diupload
            if (!$this->upload->do_upload($gambar_barang)) {
                // Jika tidak ada gambar yang diupload, proses update data tanpa gambar
                $data_input = [
                    'nama_barang' => $this->input->post('nama_barang'),
                ];
            } else {
                // Jika ada gambar yang diupload, proses upload dan update data dengan gambar baru
                $upload_gambar = $this->upload->data();
                $file_extension = pathinfo($upload_gambar['file_name'], PATHINFO_EXTENSION);
                $random_file_name = uniqid('barang_', true) . '.' . $file_extension;
                $file_path = './assets/image/barang/' . $random_file_name;

                // Rename gambar baru dan hapus gambar lama jika ada
                if ($nama_id->gambar && file_exists('./assets/image/barang/' . $nama_id->gambar)) {
                    unlink('./assets/image/barang/' . $nama_id->gambar); // hapus gambar lama
                }
                rename($upload_gambar['full_path'], $file_path); // rename gambar baru

                // Lakukan resize gambar barang jika diperlukan
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_path;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data_input = [
                    'nama_barang' => $this->input->post('nama_barang'),
                    'gambar'      => $random_file_name,
                ];
            }
            $this->M_namabarang->perbarui_nama($id_nama, $data_input);

            $this->session->set_flashdata('success', 'Nama barang berhasil diperbarui.');
            redirect('namabarang', 'refresh');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Nama Barang',
            'action'    => 'Perbarui Nama Barang',
            'nama'    => $this->M_namabarang->ambil_semua(),
            'nama_id'   => $this->M_namabarang->ambil_id_nama($id_nama),
            'konten'    => 'admin/namabarang/v_update',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function delete($id_nama = NULL)
    {
        // hapus gambar
        $nama_id = $this->M_namabarang->ambil_id_nama($id_nama);
        // rename gambar baru dan hapus gambar lama jika ada
        if ($nama_id->gambar && file_exists('./assets/image/barang/' . $nama_id->gambar)) {
            unlink('./assets/image/barang/' . $nama_id->gambar);
        }

        // panggil method hapus_nama dari models
        $hapus_status = $this->M_namabarang->hapus_nama($id_nama);

        if ($hapus_status) {
            $this->session->set_flashdata('success', 'Nama barang berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus nama barang!');
        }
        redirect('namabarang', 'refresh');
    }
}

/* End of file NamaBarang.php */
