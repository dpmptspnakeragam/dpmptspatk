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
                    <?= form_open_multipart('datauser/update/' . $user_id->id_user); ?>
                    <input type="hidden" name="id_user" value="<?= $user_id->id_user; ?>">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input name="nama_user" type="text" class="form-control" value="<?= $user_id->nama_user; ?>">
                                    <small class="text-danger"><?= form_error('nama_user'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" value="<?= $user_id->email; ?>">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control" value="<?= $user_id->username; ?>">
                                    <small class="text-danger"><?= form_error('username'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="text" class="form-control" value="<?= $user_id->password; ?>">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <select class="custom-select" name="bidang">
                                        <option selected disabled>Pilih Bidang</option>
                                        <option value="Sekretariat" <?= $user_id->bidang == 'Sekretariat' ? 'selected' : ''; ?>>Sekretariat</option>
                                        <option value="Keuangan" <?= $user_id->bidang == 'Keuangan' ? 'selected' : ''; ?>>Keuangan</option>
                                        <option value="Pelayanan" <?= $user_id->bidang == 'Pelayanan' ? 'selected' : ''; ?>>Pelayanan</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('bidang'); ?></small>
                                </div>
                            </div>
                            <?php if ($user_id->id_user != 1) : ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role ID</label>
                                        <select class="custom-select" name="role">
                                            <option selected disabled>Pilih Role ID</option>
                                            <option value="1" <?= $user_id->role == '1' ? 'selected' : ''; ?>>Administrator</option>
                                            <option value="2" <?= $user_id->role == '2' ? 'selected' : ''; ?>>Pegawai</option>
                                        </select>
                                        <small class="text-danger"><?= form_error('role'); ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="custom-select" name="status">
                                            <option selected disabled>Pilih Status</option>
                                            <option value="1" <?= $user_id->status == '1' ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="2" <?= $user_id->status == '2' ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                        <small class="text-danger"><?= form_error('status'); ?></small>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pilih Gambar</label>
                                    <input type="file" class="form-control-file" id="upload" name="profile" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <!-- Pratinjau gambar -->
                                <label>Pratinjau Gambar</label>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/image/profile/' . $user_id->profile); ?>" id="preview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success start">Perbarui</button>
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