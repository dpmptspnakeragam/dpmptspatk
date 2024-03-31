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
                    <?= form_open_multipart('datauser/add'); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input name="nama_user" type="text" class="form-control" value="<?= set_value('nama_user'); ?>">
                                    <small class="text-danger"><?= form_error('nama_user'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" value="<?= set_value('email'); ?>">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control" value="<?= set_value('username'); ?>">
                                    <small class="text-danger"><?= form_error('username'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <select class="custom-select" name="bidang">
                                        <option selected disabled>Pilih Bidang</option>
                                        <option value="Sekretariat" <?= set_select('bidang', 'Sekretariat'); ?>>Sekretariat</option>
                                        <option value="Keuangan" <?= set_select('bidang', 'Keuangan'); ?>>Keuangan</option>
                                        <option value="Pelayanan" <?= set_select('bidang', 'Pelayanan'); ?>>Pelayanan</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('bidang'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role ID</label>
                                    <select class="custom-select" name="role">
                                        <option selected disabled>Pilih Role ID</option>
                                        <option value="1" <?= set_select('role', '1'); ?>>Administrator</option>
                                        <option value="2" <?= set_select('role', '2'); ?>>Pegawai</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('role'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="custom-select" name="status">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="1" <?= set_select('status', '1'); ?>>Aktif</option>
                                        <option value="2" <?= set_select('status', '2'); ?>>Tidak Aktif</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('status'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pilih Gambar</label>
                                    <input type="file" class="form-control-file" id="profileUpload" name="profile" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <!-- Pratinjau gambar -->
                                <label>Pratinjau Gambar</label>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/image/profile/user-default.png'); ?>" id="profilePreview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary start">Simpan</button>
                        <a href="<?= base_url('datauser'); ?>" class="btn btn-outline-secondary">Kembali</a>
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