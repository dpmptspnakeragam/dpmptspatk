<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white elevation-2">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <?php
    // Ambil id_user dari session
    $id_user = $this->session->userdata('id_user');

    // Query untuk mengambil data user berdasarkan id_user dari session
    $this->db->select('tb_user.*, tb_role.nama_role');
    $this->db->from('tb_user');
    $this->db->join('tb_role', 'tb_user.id_role = tb_role.id_role', 'left');
    $this->db->where('id_user', $id_user);
    $data = $this->db->get();
    $data_login = $data->row();
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Role -->
        <li class="nav-item">
            <span class="nav-link active">
                <?= $data_login->nama_role; ?>
            </span>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="<?= base_url($this->uri->segment(1)); ?>" class="brand-link">
        <img src="<?= base_url('assets/'); ?>image/logo/agam.png" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text">
            <strong>ATK DPMPTSP</strong>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-2 mb-1 d-flex">
            <div style="margin-left: 10px;">
                <img src="<?= base_url('assets/image/profile/' . $data_login->profile); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info d-flex justify-content-between align-items-center w-100">
                <span class="d-block"><?= $data_login->nama_user; ?></span>
                <a href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('home'); ?>" class="nav-link <?php if (in_array($this->uri->segment(1), ['home'])) echo "active"; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <div class="user-panel mb-1 d-flex"></div>

                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link <?php if (in_array($this->uri->segment(1), ['dashboard'])) echo "active"; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <div class="user-panel mb-1 d-flex"></div>

                <?php if ($data_login->id_role == 1) : ?>
                    <li class="nav-item <?= in_array(
                                            $this->uri->segment(1),
                                            [
                                                'DataMaster',
                                                'datauser',
                                                'databarang',
                                                'namabarang',
                                                'kategoribarang',
                                                'satuanbarang'
                                            ]
                                        ) ? 'menu-open' : ''; ?>">
                        <a href="" class="nav-link <?= in_array(
                                                        $this->uri->segment(1),
                                                        [
                                                            'DataMaster',
                                                            'datauser',
                                                            'databarang',
                                                            'namabarang',
                                                            'kategoribarang',
                                                            'satuanbarang',
                                                        ]
                                                    ) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('datauser'); ?>" class="nav-link <?= $this->uri->segment(1) == 'datauser' ? 'active' : ''; ?>">
                                    <i class="<?= $this->uri->segment(1) == 'datauser' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'datauser' ? 'text-primary' : ''; ?>"></i>
                                    <p>Data User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('databarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'databarang' ? 'active' : ''; ?>">
                                    <i class="<?= $this->uri->segment(1) == 'databarang' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'databarang' ? 'text-primary' : ''; ?>"></i>
                                    <p>Data Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('namabarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'namabarang' ? 'active' : ''; ?>">
                                    <i class="<?= $this->uri->segment(1) == 'namabarang' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'namabarang' ? 'text-primary' : ''; ?>"></i>
                                    <p>Nama Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('kategoribarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'kategoribarang' ? 'active' : ''; ?>">
                                    <i class="<?= $this->uri->segment(1) == 'kategoribarang' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'kategoribarang' ? 'text-primary' : ''; ?>"></i>
                                    <p>Kategori Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('satuanbarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'satuanbarang' ? 'active' : ''; ?>">
                                    <i class="<?= $this->uri->segment(1) == 'satuanbarang' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'satuanbarang' ? 'text-primary' : ''; ?>"></i>
                                    <p>Satuan Barang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item <?= in_array(
                                        $this->uri->segment(1),
                                        [
                                            'permintaan',
                                            'tte_index',
                                        ]
                                    ) ? 'menu-open' : ''; ?>">
                    <a href="" class="nav-link <?= in_array(
                                                    $this->uri->segment(1),
                                                    [
                                                        'permintaan',
                                                        'tte_index',
                                                    ]
                                                ) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('permintaan'); ?>" class="nav-link <?= $this->uri->segment(1) == 'permintaan' ? 'active' : ''; ?>">
                                <i class="<?= $this->uri->segment(1) == 'permintaan' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'permintaan' ? 'text-primary' : ''; ?>"></i>
                                <p>Permintaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('tte_index'); ?>" class="nav-link <?= $this->uri->segment(1) == 'tte_index' ? 'active' : ''; ?>">
                                <i class="<?= $this->uri->segment(1) == 'tte_index' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'tte_index' ? 'text-primary' : ''; ?>"></i>
                                <p>TTE</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <?php if ($data_login->id_role == 1) : ?>
                    <li class="nav-item <?= in_array(
                                            $this->uri->segment(1),
                                            [
                                                'role',
                                            ]
                                        ) ? 'menu-open' : ''; ?>">
                        <a href="" class="nav-link <?= in_array(
                                                        $this->uri->segment(1),
                                                        [
                                                            'role',
                                                        ]
                                                    ) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Setting
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('role'); ?>" class="nav-link <?= $this->uri->segment(1) == 'role' ? 'active' : ''; ?>">
                                    <i class="<?= $this->uri->segment(1) == 'role' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'role' ? 'text-primary' : ''; ?>"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item <?= in_array(
                                        $this->uri->segment(1),
                                        [
                                            'laporan_permintaan',
                                            'rekap_barang',
                                        ]
                                    ) ? 'menu-open' : ''; ?>">
                    <a href="" class="nav-link <?= in_array(
                                                    $this->uri->segment(1),
                                                    [
                                                        'laporan_permintaan',
                                                        'rekap_barang',
                                                    ]
                                                ) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('laporan_permintaan'); ?>" class="nav-link <?= $this->uri->segment(1) == 'laporan_permintaan' ? 'active' : ''; ?>">
                                <i class="<?= $this->uri->segment(1) == 'laporan_permintaan' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'laporan_permintaan' ? 'text-primary' : ''; ?>"></i>
                                <p>Permintaan</p>
                            </a>
                        </li>
                    </ul>
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('rekap_barang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'rekap_barang' ? 'active' : ''; ?>">
                                <i class="<?= $this->uri->segment(1) == 'rekap_barang' ? 'fas' : 'far'; ?> fa-circle nav-icon <?= $this->uri->segment(1) == 'rekap_barang' ? 'text-primary' : ''; ?>"></i>
                                <p>Rekap Barang</p>
                            </a>
                        </li>
                    </ul> -->
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $action; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url($this->uri->segment(1)); ?>"><?= $home; ?></a></li>

                        <!-- Breadcrumb untuk Uri Segment 1 atau 2 -->
                        <?php if ($this->uri->segment(1) && !$this->uri->segment(2)) : ?>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        <?php elseif ($this->uri->segment(1) && $this->uri->segment(2)) : ?>
                            <li class="breadcrumb-item active"><a href="<?= base_url($this->uri->segment(1)); ?>"><?= $title; ?></a></li>
                        <?php endif; ?>

                        <!-- Breadcrumb untuk Halaman Tambah User, Update User, Hapus User -->
                        <?php if ($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'update' || $this->uri->segment(2) == 'delete') : ?>
                            <li class="breadcrumb-item active"><?= $action; ?></li>
                        <?php endif; ?>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->