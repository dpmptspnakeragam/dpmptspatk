    <?php foreach ($nama as $ki => $value) : ?>
        <div class="modal fade" id="updateNama<?= $value->id_nama; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Perbarui <?= $action; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart('namabarang/update/' . $value->id_nama); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama_barang" type="text" class="form-control" value="<?= $value->nama_barang; ?>">
                            <small class="text-danger"><?= form_error('nama_barang'); ?></small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Gambar</label>
                                    <input name="gambar" type="file" class="form-control-file" id="updateBarangUpload" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <!-- Pratinjau gambar -->
                                <label>Pratinjau Gambar</label>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" id="updateBarangPreview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('updateBarangUpload').onchange = function(e) {
                var input = e.target;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        document.getElementById('updateBarangPreview').src = event.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };
        </script>
    <?php endforeach; ?>