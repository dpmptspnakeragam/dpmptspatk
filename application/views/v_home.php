<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php for ($i = 0; $i < min(5, count($permintaan)); $i++) : ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" <?= $i == 0 ? 'class="active"' : '' ?>></li>
                            <?php endfor; ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php $count = 0; ?>
                            <?php foreach ($permintaan as $b => $value) : ?>
                                <?php if ($count < 5) : ?>
                                    <div class="carousel-item <?= $count == 0 ? 'active' : '' ?>">
                                        <img class="d-block" style="width: 100%;" src="<?= base_url('assets/image/barang/' . $value->gambar); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-custom-icon" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <?php foreach ($permintaan as $b => $value) : ?>
                        <div class="col-6 col-md-6 col-lg-6 col-xl-3 mb-2">
                            <div class="card-barang">
                                <div class="gambar-barang">
                                    <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>">
                                </div>
                                <div class="konten-card">
                                    <h4><?= $value->nama_barang; ?></h4>
                                    <p class="deskripsi-desktop"><?= $value->deskripsi; ?></p>
                                    <div class="row">
                                        <div class="col-12 text-center mb-2">
                                            <a href="#" class="text-white">
                                                Rp. <?= number_format($value->harga, 0, ',', '.'); ?>,-
                                            </a>
                                        </div>
                                        <div class="col-12 text-center mb-2">
                                            <a href="#" class="text-white">
                                                Satuan: <?= $value->nama_satuan; ?>
                                            </a>
                                        </div>
                                        <div class="col-6 text-center">
                                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-search"></i></a>
                                        </div>
                                        <div class="col-6 text-center">
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
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
    }

    .card-barang:hover {
        transform: scale(1.05);
    }

    .card-barang .gambar-barang img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        transition: filter 0.3s ease-in-out;
    }

    .card-barang:hover .gambar-barang img {
        filter: grayscale(1) brightness(0.6);
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

    .konten-card h4,
    .konten-card p,
    .konten-card a {
        color: white;
        margin: 0;
        text-align: center;
        transition: opacity 0.3s ease-in-out;
        opacity: 0;
    }

    .card-barang:hover .konten-card h4,
    .card-barang:hover .konten-card p,
    .card-barang:hover .konten-card a {
        opacity: 1;
    }

    /* Media queries untuk menyembunyikan deskripsi pada mode handphone */
    @media (max-width: 576px) {
        .deskripsi-desktop {
            display: none;
        }
    }
</style>