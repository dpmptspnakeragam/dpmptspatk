<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <?= form_open_multipart('datauser/add'); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input name="nama_user" type="text" class="form-control form-control-sm" value="<?= set_value('nama_user'); ?>">
                                    <small class="text-danger"><?= form_error('nama_user'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control form-control-sm" value="<?= set_value('email'); ?>">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control form-control-sm" value="<?= set_value('username'); ?>">
                                    <small class="text-danger"><?= form_error('username'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control form-control-sm">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <select name="bidang" class="form-control select2">
                                        <option selected disabled>Pilih Bidang</option>
                                        <option value="1" <?= set_select('bidang', '1'); ?>>Kepala Dinas</option>
                                        <option value="2" <?= set_select('bidang', '2'); ?>>Sekretariat</option>
                                        <option value="3" <?= set_select('bidang', '3'); ?>>Keuangan</option>
                                        <option value="4" <?= set_select('bidang', '4'); ?>>Penanaman Modal</option>
                                        <option value="5" <?= set_select('bidang', '5'); ?>>Pelayanan/Perizinan</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('bidang'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role ID</label>
                                    <select name="role" class="form-control select2">
                                        <option selected disabled>Pilih Role ID</option>
                                        <option value="2" <?= set_select('role', '2'); ?>>Kepala Dinas</option>
                                        <option value="3" <?= set_select('role', '3'); ?>>Sekretaris</option>
                                        <option value="4" <?= set_select('role', '4'); ?>>Sub Bagian Umum & Kepegawaian</option>
                                        <option value="5" <?= set_select('role', '5'); ?>>Pegawai</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('role'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control select2">
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
                                    <input type="file" class="form-control form-control-sm bg-transparent border-0" id="upload" name="profile" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- Pratinjau gambar -->
                                <label>Pratinjau Gambar</label>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/image/profile/user-default.png'); ?>" id="preview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <?= form_submit('submit', 'Simpan', 'class="btn btn-outline-primary"'); ?>
                        <a href="<?= base_url('datauser'); ?>" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    <!-- /.card-footer -->
                    <?= form_close(); ?>
                </div>
                <!-- ./card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->