<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <?= form_open_multipart('namabarang/update/' . $nama_id->id_nama); ?>
                    <input type="hidden" name="id_nama" value="<?= $nama_id->id_nama; ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama_barang" type="text" class="form-control" value="<?= $nama_id->nama_barang; ?>" autofocus>
                            <small class="text-danger"><?= form_error('nama_barang'); ?></small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pilih Gambar</label>
                                    <input name="gambar" type="file" class="form-control-file" id="upload" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Pratinjau gambar -->
                                <label>Pratinjau Gambar</label>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/image/barang/' . $nama_id->gambar); ?>" id="preview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                        <a href="<?= base_url('namabarang'); ?>" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->