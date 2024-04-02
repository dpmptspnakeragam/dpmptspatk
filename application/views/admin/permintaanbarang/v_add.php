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
                    <?= form_open('permintaanbarang/add'); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
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
                                    <label>Nama Barang</label>
                                    <select name="barang" class="form-control select2">
                                        <option selected disabled>Pilih Nama Barang</option>
                                        <?php foreach ($nama as $n) : ?>
                                            <option value="<?= $n->id_nama; ?>" <?= set_select('barang', $n->id_nama, $n->id_nama == set_value('barang')); ?>>
                                                <?= $n->nama_barang; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('barang'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select name="kategori" class="form-control select2">
                                        <option selected disabled>Pilih Kategori Barang</option>
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat->id_kategori; ?>" <?= set_select('kategori', $kat->id_kategori, $kat->id_kategori == set_value('kategori')); ?>>
                                                <?= $kat->nama_kategori; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('kategori'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <select name="satuan" class="form-control select2">
                                        <option selected disabled>Pilih Satuan Barang</option>
                                        <?php foreach ($satuan as $sat) : ?>
                                            <option value="<?= $sat->id_satuan; ?>" <?= set_select('satuan', $sat->id_satuan, $sat->id_satuan == set_value('satuan')); ?>>
                                                <?= $sat->nama_satuan; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('satuan'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Barang</label>
                                    <input id="harga" name="harga" type="text" class="form-control form-control-sm" value="<?= set_value('harga'); ?>">
                                    <small class="text-danger"><?= form_error('harga'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Permintaan</label>
                                    <input id="jumlah" name="jumlah" type="number" class="form-control form-control-sm" value="<?= set_value('jumlah'); ?>">
                                    <small class="text-danger"><?= form_error('jumlah'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Bayar</label>
                                    <input id="total" disabled name="total" type="text" class="form-control form-control-sm" value="<?= set_value('total'); ?>">
                                </div>
                            </div>
                            <script>
                                var inputHarga = document.getElementById('harga');
                                var inputJumlah = document.getElementById('jumlah');
                                var inputTotal = document.getElementById('total');

                                inputHarga.addEventListener('input', updateTotal);
                                inputJumlah.addEventListener('input', updateTotal);

                                function updateTotal() {
                                    var harga = parseInt(inputHarga.value) || 0;
                                    var jumlah = parseInt(inputJumlah.value) || 0;
                                    var total = harga * jumlah;

                                    inputTotal.value = total;
                                }
                            </script>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control form-control-sm" rows="1"><?= set_value('keterangan'); ?></textarea>
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