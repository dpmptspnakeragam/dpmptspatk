<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <?= form_open('databarang/add'); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select name="barang" class="form-control select2">
                                        <option selected disabled>Pilih Nama Barang</option>
                                        <?php foreach ($nama as $nm) : ?>
                                            <option value="<?= $nm->id_nama; ?>" <?= set_select('barang', $nm->id_nama); ?>>
                                                <?= $nm->nama_barang; ?>
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
                                            <option value="<?= $kat->id_kategori; ?>" <?= set_select('kategori', $kat->id_kategori); ?>>
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
                                            <option value="<?= $sat->id_satuan; ?>" <?= set_select('satuan', $sat->id_satuan); ?>>
                                                <?= $sat->nama_satuan; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('satuan'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Barang/Opsional</label>
                                    <input name="harga" type="number" class="form-control form-control-sm " value="<?= set_value('harga'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok Barang/Opsional</label>
                                    <input name="stok" type="number" class="form-control form-control-sm" value="<?= set_value('stok'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deskripsi/Opsional</label>
                                    <textarea name="deskripsi" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <button type="submit" class="btn btn-outline-primary start">Simpan</button>
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