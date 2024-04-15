<?php foreach ($barang as $id => $value) : ?>
    <div class="modal fade" id="detailBarang<?= $value->id_barang; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="namabarang">Nama Barang</label>
                                <input type="text" id="namabarang" class="form-control form-control-sm" value="<?= $value->nama_barang; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori">Kategori Barang</label>
                                <input type="text" id="kategori" class="form-control form-control-sm" value="<?= $value->nama_kategori; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="satuan">Satuan Barang</label>
                                <input type="text" id="satuan" class="form-control form-control-sm" value="<?= $value->nama_satuan; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="harga">Harga Barang</label>
                                <input type="text" id="harga" class="form-control form-control-sm" value="Rp. <?= number_format($value->harga, 0, ',', '.'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="stok">Stok Barang</label>
                                <input type="text" id="stok" class="form-control form-control-sm" value="<?= $value->stok; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="preview">Gambar Barang</label>
                            <div class="form-group">
                                <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" id="preview" style="max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control form-control-sm" rows="6" readonly><?= $value->deskripsi; ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>