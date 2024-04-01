<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <?= form_open_multipart('databarang/add'); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input name="barang" type="text" class="form-control form-control-sm" value="<?= set_value('nama_barang'); ?>">
                                    <small class="text-danger"><?= form_error('nama_barang'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select name="kategori" class="form-control select2">
                                        <option selected="selected" disabled>Pilih Kategori Barang</option>
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat->id_kategori; ?>"><?= $kat->nama_kategori; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <select name="satuan" class="form-control select2">
                                        <option selected disabled>Pilih Satuan Barang</option>
                                        <?php foreach ($satuan as $sat) : ?>
                                            <option value="<?= $sat->id_satuan; ?>"><?= $sat->nama_satuan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input name="harga" type="number" class="form-control form-control-sm" value="<?= set_value('harga'); ?>">
                                    <small class="text-danger"><?= form_error('harga'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok Barang</label>
                                    <input name="stok" type="number" class="form-control form-control-sm" value="<?= set_value('stok'); ?>">
                                    <small class="text-danger"><?= form_error('stok'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control form-control-sm" rows="1"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pilih Gambar</label>
                                    <input name="gambar" type="file" class="form-control-file" id="profileUpload" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <!-- Pratinjau gambar -->
                                <label>Pratinjau Gambar</label>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/image/barang/barang-default.png'); ?>" id="profilePreview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary start">Simpan</button>
                        <a href="<?= base_url('databarang'); ?>" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    <!-- /.card-footer -->
                    <?= form_close(); ?>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->