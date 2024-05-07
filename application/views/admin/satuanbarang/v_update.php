<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <?= form_open('satuanbarang/update/' . $satuan_id->id_satuan); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Satuan</label>
                                    <input name="nama_satuan" type="text" class="form-control form-control-sm" value="<?= $satuan_id->nama_satuan; ?>" autofocus>
                                    <small class="text-danger"><?= form_error('nama_satuan'); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                        <a href="<?= base_url('satuanbarang'); ?>" class="btn btn-outline-secondary">Kembali</a>
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