<?php foreach ($permintaan as $id => $value) : ?>
    <div class="modal fade" id="signPermintaan<?= $value->tanggal_permintaan; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Default box -->
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="col-12">
                                        <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" class="product-image" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3"><?= $value->nama_barang; ?></h3>

                                    <hr>

                                    <div class="bg-gray py-2 px-3 mt-2">
                                        <h5 class="mb-0">
                                            Rp. <?= number_format($value->harga, 0, ',', '.'); ?>,- / <?= $value->nama_satuan; ?>
                                        </h5>
                                        <h5 class="mt-0">
                                            <small>x <?= $value->jumlah; ?> <?= $value->nama_satuan; ?></small>
                                        </h5>
                                        <h5 class="mt-0 mb-0">
                                            <small>Total Bayar:</small>
                                        </h5>
                                        <h5 class="mt-0">
                                            <small>Rp. <?= number_format($value->total_harga, 0, ',', '.'); ?></small>
                                        </h5>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Deskripsi</a>
                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Keterangan</a>
                                    </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                        <?= $value->deskripsi; ?>
                                    </div>
                                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                                        <?= $value->keterangan; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>