<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>

                        <div class="card-tools">
                            <a href="<?= base_url('datauser/add'); ?>" class="btn btn-outline-primary btn-sm">Tambah</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Lengkap</th>
                                    <th class="text-center align-middle">Bidang</th>
                                    <th class="text-center align-middle">Role ID</th>
                                    <th class="text-center align-middle">Profile</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($user as $u => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_user; ?></td>
                                        <td class="text-center align-middle"><?= $value->bidang; ?></td>
                                        <td class="text-center align-middle">
                                            <?php if ($value->role == 1) {
                                                echo 'Administrator';
                                            } else {
                                                echo 'Pegawai';
                                            } ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('assets/image/profile/' . $value->profile); ?>" data-toggle="lightbox">
                                                <img src="<?= base_url('assets/image/profile/' . $value->profile); ?>" alt="Foto Profile" class="img-circle elevation-2 img-size-32">
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php
                                            $statusText = $value->status == 1 ? 'Aktif' : 'Tidak Aktif';
                                            $statusColor = $value->status == 1 ? 'primary' : 'danger';
                                            $newStatus = $value->status == 1 ? 2 : 1;
                                            ?>
                                            <?php if ($value->id_user != 1) : ?>
                                                <a href="<?= base_url('datauser/update_status/' . $value->id_user . '/' . $newStatus); ?>" class="btn btn-sm btn-<?= $statusColor; ?>">
                                                    <?= $statusText; ?>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('datauser/update/' . $value->id_user); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <?php if ($value->id_user != 1) : ?>
                                                <button type="button" data-toggle="modal" data-target="#deleteUser<?= $value->id_user; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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