<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <?= form_open_multipart('datauser/update/' . $user_id->id_user); ?>
                    <input type="hidden" name="id_user" value="<?= $user_id->id_user; ?>">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input name="nama_user" type="text" class="form-control form-control-sm" value="<?= $user_id->nama_user; ?>">
                                    <small class="text-danger"><?= form_error('nama_user'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control form-control-sm" value="<?= $user_id->email; ?>">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control form-control-sm" value="<?= $user_id->username; ?>">
                                    <small class="text-danger"><?= form_error('username'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="text" class="form-control form-control-sm" value="<?= $user_id->password; ?>">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <select class="form-control select2" name="bidang">
                                        <option selected disabled>Pilih Bidang</option>
                                        <option value="1" <?= $user_id->bidang == '1' ? 'selected' : ''; ?>>Kepala Dinas</option>
                                        <option value="2" <?= $user_id->bidang == '2' ? 'selected' : ''; ?>>Sekretariat</option>
                                        <option value="3" <?= $user_id->bidang == '3' ? 'selected' : ''; ?>>Keuangan</option>
                                        <option value="4" <?= $user_id->bidang == '4' ? 'selected' : ''; ?>>Penanaman Modal</option>
                                        <option value="5" <?= $user_id->bidang == '5' ? 'selected' : ''; ?>>Pelayanan/Perizinan</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('bidang'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role ID</label>
                                    <select name="role" class="form-control select2">
                                        <option disabled selected>Pilih Role</option>
                                        <?php foreach ($role_id as $role) : ?>
                                            <?php $select_role = ($role->id_role == $user_id->id_role) ? 'selected' : ''; ?>
                                            <option value="<?= $role->id_role; ?>" <?= $select_role; ?>><?= $role->nama_role; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('role'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6" <?= $user_id->id_role == '1' ? 'hidden' : ''; ?>>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="1" <?= $user_id->status == '1' ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="2" <?= $user_id->status == '2' ? 'selected' : ''; ?>>Tidak Aktif</option>
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
                                    <img src="<?= base_url('assets/image/profile/' . $user_id->profile); ?>" id="preview" style="max-width: 100%; max-height: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                        <a href="<?= base_url('datauser'); ?>" class="btn btn-outline-secondary">Kembali</a>
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