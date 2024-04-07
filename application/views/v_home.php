<!-- Main content -->
<div class="content mb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < min(5, count($view_barang)); $i++) : ?>
                            <li data-target="#myCarousel" data-slide-to="<?= $i ?>" <?= $i == 0 ? 'class="active"' : '' ?>></li>
                        <?php endfor; ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php $count = 0; ?>
                        <?php foreach ($view_barang as $b => $value) : ?>
                            <?php if ($count < 5) : ?>
                                <div class="carousel-item <?= $count == 0 ? 'active' : '' ?>">
                                    <img class="d-block w-100" src="<?= base_url('assets/image/barang/' . $value->gambar); ?>">
                                </div>
                            <?php endif; ?>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function scrollToElement(id) {
        var element = document.getElementById(id);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
</script>



<style>
    .fa-chevron-left {
        color: black;
    }

    .fa-chevron-right {
        color: black;
    }
</style>

<script>
    $(document).ready(function() {
        $('#myCarousel').carousel();

        // Mengontrol perpindahan slide pada carousel
        $('.carousel-control-prev').click(function() {
            $('#myCarousel').carousel('prev');
        });

        $('.carousel-control-next').click(function() {
            $('#myCarousel').carousel('next');
        });
    });
</script>



<div class="content">
    <div class="container">
        <div class="row">
            <?php foreach ($view_barang as $b => $value) : ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box">
                        <div class="card-barang">
                            <div class="gambar-barang">
                                <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" class="img-circle img-thumbnail">
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
                                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-search"></i></a>
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