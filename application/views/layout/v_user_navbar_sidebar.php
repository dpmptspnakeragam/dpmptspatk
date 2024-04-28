<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white">
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
    $this->db->select('*');
    $this->db->from('tb_user');
    $this->db->where('id_user', $id_user);
    $data = $this->db->get();
    $data_login = $data->row();
    ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Role -->
        <li class="nav-item">
            <span class="nav-link active">
                <?php if ($data_login->role == 1) : ?>
                    Administrator
                <?php elseif ($data_login->role == 2) : ?>
                    Admin
                <?php elseif ($data_login->role == 3) : ?>
                    Pegawai
                <?php endif; ?>
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
                <a href="<?= base_url('myprofile'); ?>" class="d-block"><?= $data_login->nama_user; ?></a>
                <a href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <?php if ($data_login->role == '1') : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard'); ?>" class="nav-link <?php if (in_array($this->uri->segment(1), ['dashboard'])) echo "active"; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <div class="user-panel mb-1 d-flex"></div>

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

                    <div class="user-panel mb-1 d-flex"></div>
                <?php endif; ?>
                <li class="nav-item <?= in_array(
                                        $this->uri->segment(1),
                                        [
                                            'permintaan',
                                        ]
                                    ) ? 'menu-open' : ''; ?>">
                    <a href="" class="nav-link <?= in_array(
                                                    $this->uri->segment(1),
                                                    [
                                                        'permintaan',
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
                                <p>Permintaan ATK</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <div class="user-panel mb-1 d-flex"></div>

                <li class="nav-item">
                    <a href="<?= base_url('report'); ?>" class="nav-link <?php if (in_array($this->uri->segment(1), ['report'])) echo "active"; ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Report</p>
                    </a>
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