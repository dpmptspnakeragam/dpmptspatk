<!-- Main content -->
<div class="content">
    <div class="container-fluid">
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

<hr>

<div class="content">
    <div class="container-fluid">
        <div class="card-header text-center bg-transparent border-bottom-0">
            <h4><strong>Barang Alat Tulis Kantor</strong></h4>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <?php $counter = 0; ?>
                <?php foreach ($view_barang as $b => $value) : ?>
                    <?php if ($counter < 12) : ?>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex align-items-stretch flex-column">
                            <?= form_open('cart/add'); ?>
                            <?= form_hidden('id', $value->id_barang); ?>
                            <?= form_hidden('qty', 1); ?>
                            <?= form_hidden('price', $value->harga); ?>
                            <?= form_hidden('name', $value->nama_barang); ?>
                            <?= form_hidden('redirect_page', str_replace('index.php/', '', current_url())); ?>
                            <div class="card-barang shadow img-thumbnail ">
                                <div class="gambar-barang">
                                    <button href="<?= base_url('assets/image/barang/' . $value->gambar); ?>" class="border-0 bg-transparent" data-toggle="lightbox">
                                        <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>">
                                    </button>
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
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="<?= base_url('home/detail/' . $value->id_barang); ?>" class="btn btn-outline-success btn-block mt-2"><i class="fas fa-search"></i> Detail</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary btn-block swalDefaultSuccess mt-2"><i class="fas fa-cart-plus"></i> Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                        <?php $counter++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card-footer bg-transparent">
            <?php if (isset($pagination) && $pagination['total_pages'] > 1) : ?>
                <nav aria-label="Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                        <?php if ($pagination['current_page'] > 1) : ?>
                            <?php // Tautan ke halaman pertama 
                            ?>
                            <li class="page-item">
                                <?php if (isset($pagination['kategori_id'])) : ?>
                                    <a class="page-link" href="<?= base_url("home/kategori/{$pagination['kategori_id']}/1"); ?>">&laquo;</a>
                                <?php elseif (isset($pagination['keyword'])) : ?>
                                    <a class="page-link" href="<?= base_url("home/search?keyword={$pagination['keyword']}&page=1"); ?>">&laquo;</a>
                                <?php else : ?>
                                    <a class="page-link" href="<?= base_url("home/1"); ?>">&laquo;</a>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <?php
                        $start_page = max(1, $pagination['current_page'] - 2);
                        $end_page = min($start_page + 4, $pagination['total_pages']);

                        for ($i = $start_page; $i <= $end_page; $i++) :
                        ?>
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

                        <?php if ($pagination['current_page'] < $pagination['total_pages']) : ?>
                            <?php // Tautan ke halaman terakhir 
                            ?>
                            <li class="page-item">
                                <?php if (isset($pagination['kategori_id'])) : ?>
                                    <a class="page-link" href="<?= base_url("home/kategori/{$pagination['kategori_id']}/{$pagination['total_pages']}"); ?>">&raquo;</a>
                                <?php elseif (isset($pagination['keyword'])) : ?>
                                    <a class="page-link" href="<?= base_url("home/search?keyword={$pagination['keyword']}&page={$pagination['total_pages']}"); ?>">&raquo;</a>
                                <?php else : ?>
                                    <a class="page-link" href="<?= base_url("home/{$pagination['total_pages']}"); ?>">&raquo;</a>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>

    </div>
</div>


<style>
    .card-barang {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
        margin-bottom: 13px;
        box-shadow: 0.2rem 0.2rem rgba(0, 0, 0, .175) !important;
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
        aspect-ratio: 1/1;
    }

    .konten-card {
        position: absolute;
        bottom: 60px;
        left: 10px;
        right: 10px;
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