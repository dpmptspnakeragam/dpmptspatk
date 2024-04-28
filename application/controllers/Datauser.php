<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataUser extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_datauser');
        if ($this->session->userdata('role') != 1) {
            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($redirect_url, 'refresh');
        }
    }

    // List all items Data User
    public function index()
    {
        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data User',
            'action'    => 'Data User',
            'user'      => $this->M_datauser->ambil_semua(),
            'konten'    => 'admin/v_datauser',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);

        // load modal delete
        $this->load->view('admin/datauser/v_delete', $data, FALSE);
    }

    public function update_status($id_user, $newStatus)
    {
        $result = $this->M_datauser->perbarui_status($id_user, $newStatus);

        if ($result) {
            $this->session->set_flashdata('success', 'Status keaktifan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status keaktifan.');
        }
        redirect('datauser');
    }

    public function username_check($username, $id_user)
    {
        $role = $this->session->userdata('role');

        $result = $this->M_datauser->username_unik($username, $id_user, $role);
        if ($result) {
            $this->form_validation->set_message('username_check', 'Username sudah digunakan.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function email_check($email, $id_user)
    {
        $role = $this->session->userdata('role');

        $result = $this->M_datauser->email_unik($email, $id_user, $role);
        if ($result) {
            $this->form_validation->set_message('email_check', 'Email sudah digunakan.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Add Data User
    public function add()
    {
        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required'       => '%s harus diisi!',
            'valid_email'    => 'Format %s tidak valid!',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]', [
            'required'       => '%s harus diisi!',
            'min_length'     => '%s minimal 5 karakter!',
            'max_length'     => '%s maximal 15 karakter!',
        ]);

        $username_lama = $this->M_datauser->validasi();
        if ($this->input->post('username') != $username_lama) {
            $this->form_validation->set_rules('username', 'Username', 'is_unique[tb_user.username]', [
                'is_unique' => '%s sudah ada!'
            ]);
        }

        $email_lama = $this->M_datauser->validasi();
        if ($this->input->post('email') != $email_lama) {
            $this->form_validation->set_rules('email', 'Email', 'is_unique[tb_user.email]', [
                'is_unique' => '%s sudah ada!'
            ]);
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]', [
            'required'       => '%s harus diisi!',
            'min_length'     => '%s minimal 5 karakter!',
            'max_length'     => '%s maximal 15 karakter!',
        ]);
        $this->form_validation->set_rules('bidang', 'Bidang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('role', 'Role ID', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('status', 'Status', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/image/profile/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']  = '10240';
            $nama_gambar = "profile";

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($nama_gambar)) {
                // copy dan upload gambar defaultnya profile user
                $default_profile = './assets/image/profile/user-default.png';
                $file_extension = pathinfo($default_profile, PATHINFO_EXTENSION);
                $random_file_name = 'profile_' . uniqid() . '.' . $file_extension;
                $file_path = './assets/image/profile/' . $random_file_name;
                copy($default_profile, $file_path);

                // Lakukan resize gambar jika diperlukan
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_path;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data_input = [
                    'nama_user' => $this->input->post('nama_user'),
                    'email'     => $this->input->post('email'),
                    'username'  => $this->input->post('username'),
                    'password'  => $this->input->post('password'),
                    'bidang'    => $this->input->post('bidang'),
                    'role'      => $this->input->post('role'),
                    'status'    => $this->input->post('status'),
                    'profile'   => $random_file_name,
                ];
            } else {
                // Upload gambar user profile yang diunggah
                $upload_profile = $this->upload->data();
                $file_extension = pathinfo($upload_profile['file_name'], PATHINFO_EXTENSION);
                $random_file_name = uniqid('profile_', true) . '.' . $file_extension;
                $file_path = './assets/image/profile/' . $random_file_name;

                if (!file_exists($file_path)) { // Cek apakah file dengan nama unik sudah ada
                    if (copy($upload_profile['full_path'], $file_path)) {
                        // Hapus file yang diunggah sementara
                        unlink($upload_profile['full_path']);

                        // Lakukan resize gambar jika diperlukan
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $file_path;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $data_input = [
                            'nama_user' => $this->input->post('nama_user'),
                            'email'     => $this->input->post('email'),
                            'username'  => $this->input->post('username'),
                            'password'  => $this->input->post('password'),
                            'bidang'    => $this->input->post('bidang'),
                            'role'      => $this->input->post('role'),
                            'status'    => $this->input->post('status'),
                            'profile'   => $random_file_name,
                        ];
                    } else {
                        // Handle error jika file tidak dapat disalin
                    }
                } else {
                    // Handle error jika file dengan nama unik sudah ada
                }
            }
            $this->M_datauser->tambah_user($data_input);

            $this->session->set_flashdata('success', 'Data user berhasil ditambahkan.');
            redirect('datauser');
        }

        $data = [
            'home'  => 'Data Master',
            'title' => 'Data User',
            'action' => 'Tambah User',
            'user'  => $this->M_datauser->ambil_semua(),
            'konten'   => 'admin/datauser/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Update Data User
    public function update($id_user = NULL)
    {
        // cek id pengguna yang sedang login
        // $id_user_login = $this->session->userdata('id_user');
        // if ($id_user != $id_user_login) {
        //     show_error('Anda tidak memiliki izin untuk mengakses halaman ini.', 403);
        // }

        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required'       => '%s harus diisi!',
            'valid_email'    => 'Format %s tidak valid!',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]', [
            'required'       => '%s harus diisi!',
            'min_length'     => '%s minimal 5 karakter!',
            'max_length'     => '%s maximal 15 karakter!',
        ]);

        $username_lama = $this->M_datauser->validasi_id($id_user);
        if ($this->input->post('username') != $username_lama) {
            $this->form_validation->set_rules('username', 'Username', 'callback_username_check[' . $id_user . ']');
        }

        $email_lama = $this->M_datauser->validasi_id($id_user);
        if ($this->input->post('email') != $email_lama) {
            $this->form_validation->set_rules('email', 'Email', 'callback_email_check[' . $id_user . ']');
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]', [
            'required'       => '%s harus diisi!',
            'min_length'     => '%s minimal 5 karakter!',
            'max_length'     => '%s maximal 15 karakter!',
        ]);
        $this->form_validation->set_rules('bidang', 'Bidang', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);

        $this->form_validation->set_rules('role', 'Role ID', 'trim|required', [
            'required' => '%s harus diisi!',
        ]);
        $this->form_validation->set_rules('status', 'Status', 'trim|required', [
            'required' => '%s harus diisi!',
        ]);

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/image/profile/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']  = '10240';
            $nama_gambar = "profile";

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($nama_gambar)) {
                // upload gambar defaultnya profile user
                $data_input = [
                    'id_user'   => $this->input->post('id_user'),
                    'nama_user' => $this->input->post('nama_user'),
                    'email'     => $this->input->post('email'),
                    'username'  => $this->input->post('username'),
                    'password'  => $this->input->post('password'),
                    'bidang'    => $this->input->post('bidang'),
                    'role'      => $this->input->post('role'),
                    'status'    => $this->input->post('status'),
                ];
            } else {
                // Jika ada gambar baru diupload
                $upload_profile = $this->upload->data();
                $file_extension = pathinfo($upload_profile['file_name'], PATHINFO_EXTENSION);
                $random_file_name = 'profile_' . uniqid() . '.' . $file_extension;
                $file_path = './assets/image/profile/' . $random_file_name;

                $user_id = $this->M_datauser->ambil_id_user($id_user);
                // Rename gambar baru dan hapus gambar lama jika ada
                if ($user_id->profile && file_exists('./assets/image/profile/' . $user_id->profile)) {
                    unlink('./assets/image/profile/' . $user_id->profile); // Hapus gambar lama
                }
                rename($upload_profile['full_path'], $file_path); // Rename gambar baru

                // Lakukan resize gambar jika diperlukan
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_path;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data_input = [
                    'id_user'   => $this->input->post('id_user'),
                    'nama_user' => $this->input->post('nama_user'),
                    'email'     => $this->input->post('email'),
                    'username'  => $this->input->post('username'),
                    'password'  => $this->input->post('password'),
                    'bidang'    => $this->input->post('bidang'),
                    'role'      => $this->input->post('role'),
                    'status'    => $this->input->post('status'),
                    'profile'   => $random_file_name,
                ];
            }
            $this->M_datauser->perbarui_user($id_user, $data_input);

            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
            redirect('datauser');
        }

        $data = [
            'home'      => 'Data Master',
            'title'     => 'Data User',
            'action'    => 'Perbarui User',
            'user'      => $this->M_datauser->ambil_semua(),
            'user_id'   => $this->M_datauser->ambil_id_user($id_user),
            'konten'    => 'admin/datauser/v_update',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    //Delete Data User
    public function delete($id_user = NULL)
    {
        // hapus gambar
        $user_id = $this->M_datauser->ambil_id_user($id_user);
        // Rename gambar baru dan hapus gambar lama jika ada
        if ($user_id->profile && file_exists('./assets/image/profile/' . $user_id->profile)) {
            unlink('./assets/image/profile/' . $user_id->profile); // Hapus gambar lama
        }

        // Panggil method hapus_user dari model
        $hapus_status = $this->M_datauser->hapus_user($id_user);

        if ($hapus_status) {
            $this->session->set_flashdata('success', 'Data user berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data user.');
        }
        redirect('datauser');
    }
}

/* End of file DataUser.php */
