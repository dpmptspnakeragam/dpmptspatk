<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataBarang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_databarang');
    }

    // List all items Data Barang
    public function index()
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data Barang',
            'action'    => 'Data Barang',
            'barang'    => $this->M_databarang->ambil_semua(),
            'konten'    => 'admin/v_databarang',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load view modal delete data barang
        $this->load->view('admin/databarang/v_delete', $data, FALSE);
    }

    // Add Data Barang
    public function add()
    {
        $this->form_validation->set_rules('barang', 'Nama Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('harga', 'Harga Barang', 'trim|required', [
            'required'       => '%s harus diisi!',

        ]);
        $this->form_validation->set_rules('stok', 'Stok Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
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
                    'nama_barang'   => $this->input->post('barang'),
                    'id_kategori'   => $this->input->post('kategori'),
                    'id_satuan'     => $this->input->post('satuan'),
                    'harga'         => $this->input->post('harga'),
                    'stok'          => $this->input->post('stok'),
                    'deskripsi'     => $this->input->post('deskripsi'),
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
                            'nama_barang'   => $this->input->post('barang'),
                            'id_kategori'   => $this->input->post('kategori'),
                            'id_satuan'     => $this->input->post('satuan'),
                            'harga'         => $this->input->post('harga'),
                            'stok'          => $this->input->post('stok'),
                            'deskripsi'     => $this->input->post('deskripsi'),
                            'gambar'        => $random_file_name,
                        ];
                    } else {
                        // handle error jika file tidak dapat disalin
                    }
                } else {
                    // handle error jika file dengan nama unik sudah ada
                }
            }
            $this->M_databarang->tambah_barang($data_input);

            $this->session->set_flashdata('success', 'Data barang berhasil ditambahkan');
            redirect('databarang');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data Barang',
            'action'    => 'Tambah Barang',
            'kategori'  => $this->M_databarang->kategori(),
            'satuan'    => $this->M_databarang->satuan(),
            'konten'    => 'admin/databarang/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Update Data Barang
    public function update($id_barang = NULL)
    {
        $this->form_validation->set_rules('barang', 'Nama Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('harga', 'Harga Barang', 'trim|required', [
            'required'       => '%s harus diisi!',

        ]);
        $this->form_validation->set_rules('stok', 'Stok Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Barang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);


        if ($this->form_validation->run() == TRUE) {

            $config['upload_path'] = './assets/image/barang/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']  = '10240';
            $nama_barang = "gambar";

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($nama_barang)) {
                // copy dan upload gambar barang default
                $data_input = [
                    'nama_barang'   => $this->input->post('barang'),
                    'id_kategori'   => $this->input->post('kategori'),
                    'id_satuan'     => $this->input->post('satuan'),
                    'harga'         => $this->input->post('harga'),
                    'stok'          => $this->input->post('stok'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                ];
            } else {
                // upload gambar barang yang diunggah atau diupload
                $upload_gambar = $this->upload->data();
                $file_extension = pathinfo($upload_gambar['file_name'], PATHINFO_EXTENSION);
                $random_file_name = uniqid('barang_', true) . '.' . $file_extension;
                $file_path = './assets/image/barang/' . $random_file_name;

                $barang_id = $this->M_databarang->ambil_id_barang($id_barang);
                // rename gambar baru dan hapus gambar lama jika ada
                if ($barang_id->gambar && file_exists('./assets/image/barang/' . $barang_id->gambar)) {
                    unlink('./assets/image/barang/' . $barang_id->gambar); // hapus gambar lama
                }
                rename($upload_gambar['full_path'], $file_path); // rename gambar baru

                // lakukan resize gambar barang jika diperlukan
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_path;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data_input = [
                    'nama_barang'   => $this->input->post('barang'),
                    'id_kategori'   => $this->input->post('kategori'),
                    'id_satuan'     => $this->input->post('satuan'),
                    'harga'         => $this->input->post('harga'),
                    'stok'          => $this->input->post('stok'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'gambar'        => $random_file_name,
                ];
            }
            $this->M_databarang->perbarui_barang($id_barang, $data_input);

            $this->session->set_flashdata('success', 'Data barang berhasil diperbarui');
            redirect('databarang');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data Barang',
            'action'    => 'Perbarui Barang',
            'kategori'  => $this->M_databarang->kategori(),
            'satuan'    => $this->M_databarang->satuan(),
            'barang_id' => $this->M_databarang->ambil_id_barang($id_barang),
            'konten'    => 'admin/databarang/v_update',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Delete Data Barang
    public function delete($id_barang = NULL)
    {
        // hapus gambar
        $barang_id = $this->M_databarang->ambil_id_barang($id_barang);
        // rename gambar baru dan hapus gambar lama jika ada
        if ($barang_id->gambar && file_exists('./assets/image/barang/' . $barang_id->gambar)) {
            unlink('./assets/image/barang/' . $barang_id->gambar);
        }

        // panggil method hapus_barang dari models
        $hapus_status = $this->M_databarang->hapus_barang($id_barang);

        if ($hapus_status) {
            $this->session->set_flashdata('success', 'Data barang berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data barang!');
        }
        redirect('databarang');
    }
}

/* End of file DataBarang.php */
