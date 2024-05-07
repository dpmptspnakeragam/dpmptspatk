<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white elevation-2">
    <div class="container">

        <a href="<?= base_url('home'); ?>" class="navbar-brand mt-2 ml-2">
            <img src="<?= base_url('assets/'); ?>image/logo/atk.png" alt="AdminLTE Logo" class="brand-image">
        </a>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <!-- <button type="button" class="nav-link btn btn-link" onclick="scrollToElement('myCarousel');">Home</button> -->
                    <a href="<?= base_url('home'); ?>" class="nav-link">Home</i></a>
                </li>

                <!-- <li class="nav-item dropdown">
                    <a id="dropdownProduk" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Produk</a>
                    <ul aria-labelledby="dropdownProduk" class="dropdown-menu border-0 shadow" style="max-height: 300px; overflow-y: auto;">
                        <?php foreach ($produk as $item) : ?>
                            <li><a id="kategori<?= $item->id_nama; ?>" href="<?= base_url('kategori/' . $item->id_nama); ?>" class="dropdown-item"><?= $item->nama_barang; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li> -->

                <li class="nav-item dropdown">
                    <a id="dropdownKategori" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori</a>
                    <ul aria-labelledby="dropdownKategori" class="dropdown-menu border-0 shadow" style="max-height: 300px; overflow-y: auto;">
                        <?php foreach ($kategori as $item) : ?>
                            <li><a id="kategori<?= $item->id_kategori; ?>" href="<?= base_url('home/kategori/' . $item->id_kategori); ?>" class="dropdown-item"><?= $item->nama_kategori; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <?php if ($this->session->userdata('id_user')) : ?>
                    <!-- Jika user sudah login, tampilkan tombol Logout -->
                    <li class="nav-item">
                        <a href="<?= base_url('logout'); ?>" class="nav-link">Logout</a>
                    </li>
                <?php else : ?>
                    <!-- Jika user belum login, tampilkan tombol Login -->
                    <li class="nav-item">
                        <a href="<?= base_url('login'); ?>" class="nav-link">Login</a>
                    </li>
                <?php endif; ?>

                <script>
                    $(document).ready(function() {
                        // Check if user is logged in
                        if (<?= $this->session->userdata('id_user') ? 'true' : 'false' ?>) {
                            $('#loginLink').hide(); // Hide the login link
                        }
                    });
                </script>
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <?php $cart = $this->cart->contents();
            $jumlah_item = 0;
            foreach ($cart as $key => $value) {
                $jumlah_item = $jumlah_item + $value['qty'];
            }
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cart-plus"></i>
                    <span class="badge badge-danger navbar-badge"><?= $jumlah_item; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php foreach ($cart as $key => $value) : ?>
                        <?php foreach ($produk as $item) : ?>
                            <?php if ($item->id_nama == $value['id']) : ?>
                                <div class="mt-2 mb-2 mr-2 ml-2">
                                    <div class="media">
                                        <img src="<?= base_url('assets/image/barang/' . $item->gambar); ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                <?= $value['name']; ?>
                                            </h3>
                                            <p class="text-sm"><?= $value['qty']; ?> x Rp <?= number_format($value['price']); ?></p>
                                            <p class="text-sm text-muted"><i class="fas fa-calculator"></i> Rp <?php echo number_format($value['subtotal']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>


                    <div class="dropdown-divider"></div>

                    <?php if (empty($cart)) : ?>
                        <strong class="dropdown-footer">Keranjang Kosong</strong>
                    <?php elseif ($cart) : ?>
                        <div class="mt-2 mb-2 mr-2 ml-2">
                            <div class="media">
                                <div class="media-body">
                                    <tr>
                                        <td colspan="2"> </td>
                                        <td class="right"><strong>Total Bayar</strong></td>
                                        <td class="right">Rp <?= number_format($this->cart->total()); ?></td>
                                    </tr>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('cart/detail'); ?>" class="dropdown-item dropdown-footer">Tampilkan semua</a>
                    <?php endif; ?>

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
                        <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
                        <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->