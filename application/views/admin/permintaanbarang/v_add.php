<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <?= form_open('permintaanbarang/add'); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_barang">Nama Barang</label>
                                    <select class="form-control select2" id="id_barang" name="id_barang">
                                        <option selected disabled>Pilih Nama Barang</option>
                                        <?php foreach ($barang as $item) : ?>
                                            <option value="<?= $item->id_barang; ?>" <?= set_select('id_barang', $item->id_barang, $item->id_barang == set_value('id_barang')); ?> data-kategori="<?= $item->nama_kategori; ?>" data-satuan="<?= $item->nama_satuan; ?>" data-harga="<?= $item->harga; ?>">
                                                <?= $item->nama_barang; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('id_barang'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Peminta</label>
                                    <select name="peminta" class="form-control select2">
                                        <option selected disabled>Pilih Nama Peminta</option>
                                        <?php foreach ($user as $u) : ?>
                                            <option value="<?= $u->id_user; ?>" <?= set_select('peminta', $u->id_user, $u->id_user == set_value('peminta')); ?>>
                                                <?= $u->nama_user; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('peminta'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori_barang">Kategori Barang</label>
                                    <input id="kategori_barang" type="text" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="satuan_barang">Satuan Barang</label>
                                    <input id="satuan_barang" type="text" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input id="harga" name="harga" type="text" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Permintaan</label>
                                    <input id="jumlah" name="jumlah" type="number" class="form-control form-control-sm">
                                    <small class="text-danger"><?= form_error('jumlah'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_harga">Total Harga</label>
                                    <input id="total_harga" name="total" type="text" class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control form-control-sm" rows="2"><?= set_value('keterangan'); ?></textarea>
                                    <small class="text-danger"><?= form_error('keterangan'); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?= form_submit('submit', 'Simpan', 'class="btn btn-outline-primary"'); ?>
                        <a href="<?= base_url('permintaanbarang'); ?>" class="btn btn-outline-secondary">Kembali</a>
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