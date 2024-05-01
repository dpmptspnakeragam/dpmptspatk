<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataUser extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_datauser');
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

    public function check_role($role_id)
    {
        // Validasi jika role_id sudah ada dalam database
        $existing_role = $this->M_datauser->role_exists($role_id);
        if ($existing_role) {
            $this->form_validation->set_message('check_role', 'Role ID sudah ada!');
            return false;
        } else {
            return true;
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

        $username_lama = $this->M_datauser->validasi_username();
        if ($this->input->post('username') != $username_lama) {
            $this->form_validation->set_rules('username', 'Username', 'is_unique[tb_user.username]', [
                'is_unique' => '%s sudah ada!'
            ]);
        }

        $email_lama = $this->M_datauser->validasi_email();
        if ($this->input->post('email') != $email_lama) {
            $this->form_validation->set_rules('email', 'Email', 'is_unique[tb_user.email]', [
                'is_unique' => '%s sudah ada!'
            ]);
        }

        // Validasi role
        $role_input = $this->input->post('role');
        if ($role_input >= 1 && $role_input <= 4) {
            $this->form_validation->set_rules('role', 'Role ID', 'callback_check_role[' . $role_input . ']');
        } else {
            $this->form_validation->set_rules('role', 'Role ID', 'required', [
                'required' => '%s harus diisi!'
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
                    'id_role'      => $this->input->post('role'),
                    'status'    => $this->input->post('status'),
                    'profile'   => $random_file_name,
                ];
            } else {
                // Upload gambar user profile yang diunggah
                $upload_profile = $this->upload->data();
                $file_extension = pathinfo($upload_profile['file_name'], PATHINFO_EXTENSION);
                $random_file_name = 'profile_' . uniqid() . '.' . $file_extension;
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
                            'id_role'      => $this->input->post('role'),
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
            'user_roles'  => $this->M_datauser->role(),
            'konten'   => 'admin/datauser/v_add',
        ];
        $this->load->view('layout/v_user_wrapper', $data, FALSE);
    }

    public function username_check($username, $id_user)
    {
        $id_role = $this->session->userdata('id_role');

        $result = $this->M_datauser->username_unik($username, $id_user, $id_role);
        if ($result) {
            $this->form_validation->set_message('username_check', 'Username sudah digunakan.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function email_check($email, $id_user)
    {
        $id_role = $this->session->userdata('id_role');

        $result = $this->M_datauser->email_unik($email, $id_user, $id_role);
        if ($result) {
            $this->form_validation->set_message('email_check', 'Email sudah digunakan.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Update Data User
    public function update($id_user = NULL)
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

        // Validasi role
        $role_input = $this->input->post('role');
        if ($role_input >= 2 && $role_input <= 4) {
            // Cek apakah role baru yang dipilih sudah ada pada tb_user
            $existing_role = $this->M_datauser->check_existing_role($role_input);
            $user_id = $this->input->post('id_user'); // Ambil id_user dari form
            $user_role = $this->M_datauser->ambil_id_user($user_id)->id_role; // Ambil id_role dari user yang sedang diupdate

            if ($existing_role && $role_input != $user_role) {
                $this->form_validation->set_rules('role', 'Role ID', 'callback_check_role[' . $role_input . ']');
            } else {
                // Tidak perlu validasi jika role tidak diubah atau role baru tidak ada pada tb_user
                // Simpan data user tanpa validasi role
                $this->form_validation->set_rules('role', 'Role ID', 'required', [
                    'required' => 'Role ID harus diisi dan berada dalam rentang 1-4!'
                ]);
            }
        } else {
            $this->form_validation->set_rules('role', 'Role ID', 'required', [
                'required' => 'Role ID harus diisi dan berada dalam rentang 1-4!'
            ]);
        }


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
                    'id_role'      => $this->input->post('role'),
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
                    'id_role'      => $this->input->post('role'),
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
            'user_id'   => $this->M_datauser->ambil_id_user($id_user),
            'role_id'   => $this->M_datauser->role(),
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
