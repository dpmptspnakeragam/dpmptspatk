<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white elevation-3">
    <div class="container">

        <a href="<?= base_url('/'); ?>" class="navbar-brand mt-2 ml-2">
            <img src="<?= base_url('assets/'); ?>image/logo/atk.png" alt="AdminLTE Logo" class="brand-image">
        </a>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <button type="button" class="nav-link btn btn-link" onclick="scrollToElement('myCarousel');">Home</button>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownProduk" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Produk</a>
                    <ul aria-labelledby="dropdownProduk" class="dropdown-menu border-0 shadow" style="max-height: 300px; overflow-y: auto;">
                        <?php foreach ($produk as $item) : ?>
                            <li><a id="kategori<?= $item->id_nama; ?>" href="<?= base_url('kategori/' . $item->id_nama); ?>" class="dropdown-item"><?= $item->nama_barang; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownKategori" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori</a>
                    <ul aria-labelledby="dropdownKategori" class="dropdown-menu border-0 shadow" style="max-height: 300px; overflow-y: auto;">
                        <?php foreach ($kategori as $item) : ?>
                            <li><a id="kategori<?= $item->id_kategori; ?>" href="<?= base_url('kategori/' . $item->id_kategori); ?>" class="dropdown-item"><?= $item->nama_kategori; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('login'); ?>" class="nav-link">Login</a>
                </li>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto mr-2">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cart-plus"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="<?= base_url('assets/'); ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
                            <!-- <img src="<?= base_url('assets/'); ?>dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
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
                            <img src="<?= base_url('assets/'); ?>dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
        </ul>

        <!-- Button toggle Menu -->
        <button class="navbar-toggler order-1 mr-2" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<!-- /.navbar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 mt-4"><small><?= $title; ?></small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
                        <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->