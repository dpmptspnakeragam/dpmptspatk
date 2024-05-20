<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('M_home');
    }

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
            'home'          => 'Home',
            'title_website' => 'Detail Permintaan | ATK DPMPTSP Kabupaten Agam',
            'title1'        => false,
            'title2'        => 'Detail Barang Permintaan',
            'konten'        => 'home/v_detail_cart',
            'produk'        => $this->M_home->produk(),
            'kategori'      => $this->M_home->kategori(),
            'produk'        => $this->M_home->produk(),
        );
        $this->load->view('layout/v_home_wrapper', $data, FALSE);
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
        $action = $this->input->post('action');

        if ($action == 'tambah') {
            if (!$this->session->userdata('id_user')) {
                $this->session->set_flashdata('warning', 'Silakan login terlebih dahulu untuk menyimpan data.');
                redirect('login');
            }

            $cart_items = $this->cart->contents();
            $id_user = $this->session->userdata('id_user');
            $kode_perm = "PERM" . '_' . $id_user . '_' . uniqid();

            $inserted_ids = array();
            foreach ($cart_items as $i => $item) {
                $sub_total = $item['subtotal'] != 0 ? $item['subtotal'] : null;

                $qty = $this->input->post($item['rowid'] . '[qty]');
                // Validasi qty tidak boleh kosong
                if (empty($qty)) {
                    $this->session->set_flashdata('warning', 'Jumlah barang tidak boleh kosong.');
                    redirect('cart/detail');
                }

                $keterangan = $this->input->post($item['rowid'] . '_keterangan');
                // Validasi keterangan tidak boleh kosong
                if (empty($keterangan)) {
                    $this->session->set_flashdata('warning', 'Keterangan barang tidak boleh kosong.');
                    redirect('cart/detail');
                }

                $data_perm = array(
                    'kode_perm' => $kode_perm,
                    'id_user' => $id_user,
                    'id_barang' => $item['id'],
                    'jumlah_perm' => $qty,
                    'sub_total' => $sub_total,
                    'ket' => $keterangan
                );
                $this->db->insert('tb_perm', $data_perm);
                $inserted_ids[] = $this->db->insert_id();
            }

            date_default_timezone_set('Asia/Jakarta');

            $total_bayar = $this->cart->total() != 0 ? $this->cart->total() : null;

            if (!empty($inserted_ids)) {
                $first_inserted_id = $inserted_ids[0];
                $data_konfperm = array(
                    'kode_perm' => $kode_perm,
                    'tanggal_konfperm' => date('Y-m-d H:i:s'),
                    'status_konfperm' => 1,
                    'total_bayar' => $total_bayar,
                );
                $this->db->insert('tb_konfperm', $data_konfperm);
            }

            $this->cart->destroy();

            $this->session->set_flashdata('success', 'Permintaan berhasil ditambahkan.');
            redirect('home');

            if (empty($this->cart->contents())) {
                redirect('home');
            }

            $data = array(
                'title_website' => 'Simpan | ATK DPMPTSP Kabupaten Agam',
                'home'         => 'Home',
                'title1'         => 'Detail',
                'title2'        => 'Detail Barang Permintaan',
                'konten'        => 'home/v_detail_cart',
            );
            $this->load->view('layout/v_home_wrapper', $data, FALSE);
        } elseif ($action == 'perbarui') {
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
    }
}

/* End of file Cart.php */
