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

<div class="content">
    <div class="container">
        <?php if (isset($pesan)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $pesan; ?>
            </div>
        <?php else : ?>
            <div class="row">
                <?php foreach ($view_barang as $b => $value) : ?>
                    <div class="col-lg-3 col-6">
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
                                        <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" class="img-circle img-thumbnail">
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
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- /.content -->

<style>
    .card-barang {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        height: 250px;
    }

    .card-barang:hover {
        transform: scale(1.05);
    }

    .card-barang .gambar-barang img {
        width: 100%;
        height: 250px;

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