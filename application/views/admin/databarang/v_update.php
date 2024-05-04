<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <?= form_open('databarang/update/' . $barang_id->id_barang); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select name="barang" class="form-control select2">
                                        <option disabled>Pilih Nama Barang</option>
                                        <?php foreach ($nama as $n) : ?>
                                            <?php $selected_nama = ($n->id_nama == $barang_id->id_nama) ? 'selected' : ''; ?>
                                            <option value="<?= $n->id_nama; ?>" <?= $selected_nama; ?>><?= $n->nama_barang; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select name="kategori" class="form-control select2">
                                        <option disabled>Pilih Kategori Barang</option>
                                        <?php foreach ($kategori as $kat) : ?>
                                            <?php $selected_kategori = ($kat->id_kategori == $barang_id->id_kategori) ? 'selected' : ''; ?>
                                            <option value="<?= $kat->id_kategori; ?>" <?= $selected_kategori; ?>><?= $kat->nama_kategori; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <select name="satuan" class="form-control select2">
                                        <option disabled>Pilih Satuan Barang</option>
                                        <?php foreach ($satuan as $sat) : ?>
                                            <?php $selected_satuan = ($sat->id_satuan == $barang_id->id_satuan) ? 'selected' : ''; ?>
                                            <option value="<?= $sat->id_satuan; ?>" <?= $selected_satuan; ?>><?= $sat->nama_satuan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Barang/Opsional</label>
                                    <input name="harga" type="number" class="form-control form-control-sm" value="<?= $barang_id->harga; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok Barang/Opsional</label>
                                    <input name="stok" type="number" class="form-control form-control-sm" value="<?= $barang_id->stok; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deskripsi/Opsional</label>
                                    <textarea name="deskripsi" class="form-control form-control-sm" rows="4"><?= $barang_id->deskripsi; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                        <a href="<?= base_url('databarang'); ?>" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    <!-- /.card-footer -->
                    <?= form_close(); ?>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->