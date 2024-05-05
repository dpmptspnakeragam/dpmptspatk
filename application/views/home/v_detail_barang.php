<!-- Main content -->
<div class="container">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        <img src="<?= base_url('assets/image/barang/' . $detail_barang->gambar); ?>" class="product-image" alt="Product Image">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3"><?= $detail_barang->nama_barang; ?></h3>
                    <p><?= $detail_barang->deskripsi; ?></p>

                    <hr>

                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            Harga: Rp. <?= number_format($detail_barang->harga, 0, ',', '.'); ?> / <?= $detail_barang->nama_satuan; ?>
                        </h2>
                    </div>

                    <div class="mt-4">
                        <?= form_open('cart/add', ['class' => 'd-inline-block']); ?>
                        <?= form_hidden('id', $detail_barang->id_barang); ?>
                        <?= form_hidden('qty', 1); ?>
                        <?= form_hidden('price', $detail_barang->harga); ?>
                        <?= form_hidden('name', $detail_barang->nama_barang); ?>
                        <?= form_hidden('redirect_page', str_replace('index.php/', '', current_url())); ?>
                        <button type="submit" class="btn btn-primary btn-sm btn-flat swalDefaultSuccess">
                            <i class="fas fa-cart-plus fa-lg mr-2"></i>
                            Masukan Keranjang
                        </button>
                        <?= form_close(); ?>

                        <a href="<?= base_url('home'); ?>" class="btn btn-default btn-sm btn-flat float-none">
                            <i class="fas fa-home fa-lg mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- /.content -->