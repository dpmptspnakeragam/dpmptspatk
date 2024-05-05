<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function index()
    {
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');

        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('price'),
            'name'    => $this->input->post('name'),
            // 'options' => array('Size' => 'L', 'Color' => 'Red')
        );
        $this->cart->insert($data);
        $this->session->set_flashdata('success', 'Barang berhasil dimasukan ke keranjang.');
        redirect($redirect_page, 'refresh');
    }

    public function detail()
    {
        if (empty($this->cart->contents())) {
            redirect('home');
        }

        $data = array(
            'title'         => 'Detail Barang Permintaan',
            'konten'        => 'home/v_detail_cart',
        );
        $this->load->view('layout/v_home_wrapper', $data, FALSE);
    }

    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]')
            );

            $this->cart->update($data);
            $i++;
        }

        $this->session->set_flashdata('success', 'Permintaan berhasil diupdate.');
        redirect('cart/detail');
    }

    public function clear()
    {
        $this->cart->destroy();
        $this->session->set_flashdata('success', 'Permintaan berhasil dibersihkan.');
        redirect('home');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        redirect('cart/detail');
    }

    public function simpan()
    {
        // Check if user is logged in
        if (!$this->session->userdata('id_user')) {
            // User is not logged in, redirect to login page
            $this->session->set_flashdata('warning', 'Silakan login terlebih dahulu untuk menyimpan data.');
            redirect('login'); // Redirect to your login page
        }

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required'       => '%s harus diisi!',
        ]);

        if ($this->form_validation->run() == true) {
            // Retrieve cart data
            $cart_items = $this->cart->contents();

            // Ambil ID user dari sesi atau dari hasil login
            $id_user = $this->session->userdata('id_user');

            // Buat kode perm sesuai dengan ID user
            $kode_perm = "PERM" . '_' . $id_user . '_' . uniqid();

            // Insert into 'tb_perm' and collect inserted IDs
            $inserted_ids = array();
            foreach ($cart_items as $item) {
                $data_perm = array(
                    'kode_perm' => $kode_perm,
                    'id_user' => $id_user,
                    'id_barang' => $item['id'],
                    'jumlah_perm' => $item['qty'],
                    'sub_total' => $item['subtotal'],
                );
                $this->db->insert('tb_perm', $data_perm);
                $inserted_ids[] = $this->db->insert_id(); // Collect inserted IDs
            }

            date_default_timezone_set('Asia/Jakarta');

            // Insert into 'tb_konfperm' using the first inserted ID
            if (!empty($inserted_ids)) {
                $first_inserted_id = $inserted_ids[0];
                $data_konfperm = array(
                    'kode_perm' => $kode_perm,
                    'tanggal_konfperm' => date('Y-m-d H:i:s'),
                    'status_konfperm' => 'Menunggu',
                    'total_bayar' => $this->cart->total(),
                    'keterangan' => $this->input->post('keterangan')
                );
                $this->db->insert('tb_konfperm', $data_konfperm);
            }

            // Clear the cart after saving data
            $this->cart->destroy();

            $this->session->set_flashdata('success', 'Permintaan berhasil ditambahkan.');
            // Redirect or show success message
            redirect('home');
        }

        if (empty($this->cart->contents())) {
            redirect('home');
        }

        $data = array(
            'title'         => 'Detail Barang Permintaan',
            'konten'        => 'home/v_detail_cart',
        );
        $this->load->view('layout/v_home_wrapper', $data, FALSE);
    }
}

/* End of file Cart.php */
