<!-- Main content -->
<div class="content">
    <div class="container mb-4">
        <div class="row d-flex justify-content-end">
            <div class="col-md-6">
                <form action="<?= base_url('home/search'); ?>" method="GET">
                    <div class="input-group">
                        <input type="search" class="form-control form-control-sm" placeholder="Cari Nama Barang" name="keyword">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content" id="homeSection">

    <!-- Default box -->
    <div class="container">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h4>Produk Alat Tulis Kantor</h4>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <?php if (isset($pesan)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $pesan; ?>
                        </div>
                    <?php else : ?>
                        <?php $counter = 0; ?>
                        <?php foreach ($view_barang as $b => $value) : ?>
                            <?php if ($counter < 6) : ?>
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <?= form_open('cart/add'); ?>
                                    <?= form_hidden('id', $value->id_barang); ?>
                                    <?= form_hidden('qty', 1); ?>
                                    <?= form_hidden('price', $value->harga); ?>
                                    <?= form_hidden('name', $value->nama_barang); ?>
                                    <?= form_hidden('redirect_page', str_replace('index.php/', '', current_url())); ?>
                                    <div class="small-box">
                                        <div class="card-barang">
                                            <div class="gambar-barang">
                                                <a href="<?= base_url('assets/image/barang/' . $value->gambar); ?>" data-toggle="lightbox">
                                                    <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" class="img-thumbnail">
                                                </a>
                                            </div>
                                            <div class="konten-card">
                                                <h6>
                                                    <strong>
                                                        <?= $value->nama_barang; ?>
                                                    </strong>
                                                </h6>
                                                <hr class="bg-white mt-1 mb-1">
                                                <div class="text-center mb-2">
                                                    <a href="#" class="text-white">
                                                        Rp. <?= number_format($value->harga, 0, ',', '.'); ?> / <?= $value->nama_satuan; ?>
                                                    </a>
                                                </div>
                                                <div class="text-center">
                                                    <a href="<?= base_url('home/detail/' . $value->id_barang); ?>" class="btn btn-sm btn-info"><i class="fas fa-search"></i></a>
                                                    <button class="btn btn-sm btn-primary swalDefaultSuccess"><i class="fas fa-cart-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            <?php endif; ?>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <?php if (isset($pagination) && $pagination['total_pages'] > 1) : ?>
                    <nav aria-label="Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++) : ?>
                                <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : ''; ?>">
                                    <?php if (isset($pagination['kategori_id'])) : ?>
                                        <a class="page-link" href="<?= base_url("home/kategori/{$pagination['kategori_id']}/{$i}"); ?>"><?= $i; ?></a>
                                    <?php elseif (isset($pagination['keyword'])) : ?>
                                        <a class="page-link" href="<?= base_url("home/search?keyword={$pagination['keyword']}&page={$i}"); ?>"><?= $i; ?></a>
                                    <?php else : ?>
                                        <a class="page-link" href="<?= base_url("home/{$i}"); ?>"><?= $i; ?></a>
                                    <?php endif; ?>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /.container -->
</section>
<!-- /.content -->


<style>
    .card-barang {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        height: 300px;
    }

    .card-barang:hover {
        transform: scale(1.05);
    }

    .card-barang .gambar-barang img {
        width: 100%;
        height: 300px;
        /* Menggunakan height: auto; untuk mengikuti proporsi asli gambar */
        object-fit: cover;
        border-radius: 8px;
        transition: filter 0.3s ease-in-out;
        aspect-ratio: 16/9;
        /* Mengatur proporsi gambar sesuai kebutuhan Anda (misalnya 16:9) */
    }

    .konten-card {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        border-radius: 8px;
        transition: opacity 0.3s ease-in-out;
        opacity: 0;
    }

    .card-barang:hover .konten-card {
        opacity: 1;
    }

    .konten-card h6,
    .konten-card a {
        color: white;
        margin: 0;
        text-align: center;
        transition: opacity 0.3s ease-in-out;
        opacity: 0;
    }

    .card-barang:hover .konten-card h6,
    .card-barang:hover .konten-card a {
        opacity: 1;
    }
</style>