<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 elevation-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-dark"><?= $data_login->nama_user; ?></span>
                <img src="<?= base_url('assets/image/profile/' . $data_login->profile); ?>" class="img-profile rounded-circle elevation-3" style="max-width: 100%; max-height: 20px;">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <div class="image">
            <img src="<?= base_url('assets/image/logo/agam.png'); ?>" alt="ATK Logo" class="brand-image">
            <span class="brand-text font-weight-light">ATK DPMPTSP</span>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/image/profile/' . $data_login->profile); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $data_login->nama_user; ?></a>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link <?php if (in_array($this->uri->segment(1), ['dashboard'])) echo "active"; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>

                </li>

                <li class="user-panel mt-2 mb-2"></li>

                <li class="nav-item <?= in_array(
                                        $this->uri->segment(1),
                                        [
                                            'DataMaster',
                                            'datauser',
                                            'databarang',
                                            'kategoribarang',
                                            'satuanbarang'
                                        ]
                                    ) ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= in_array(
                                                    $this->uri->segment(1),
                                                    [
                                                        'DataMaster',
                                                        'datauser',
                                                        'databarang',
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
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('databarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'databarang' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('kategoribarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'kategoribarang' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('satuanbarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'satuanbarang' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Satuan Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?= in_array(
                                        $this->uri->segment(1),
                                        [
                                            'Transaksi',
                                            'permintaanbarang',
                                        ]
                                    ) ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= in_array(
                                                    $this->uri->segment(1),
                                                    [
                                                        'Transaksi',
                                                        'permintaanbarang',
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
                            <a href="<?= base_url('permintaanbarang'); ?>" class="nav-link <?= $this->uri->segment(1) == 'permintaanbarang' ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permintaan Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
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
            <div class="row mb-2">
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