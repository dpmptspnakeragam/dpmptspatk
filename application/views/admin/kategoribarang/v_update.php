<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <h3 class="card-title">Form <?= $action; ?></h3>
                </div>
                <?= form_open('kategoribarang/update/' . $kategori_id->id_kategori); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input name="nama_kategori" type="text" class="form-control form-control-sm" value="<?= $kategori_id->nama_kategori; ?>">
                                <small class="text-danger"><?= form_error('nama_kategori'); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                    <a href="<?= base_url('kategoribarang'); ?>" class="btn btn-outline-secondary">Kembali</a>
                </div>
                <?= form_close() ?>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->