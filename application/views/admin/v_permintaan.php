<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <a href="<?= base_url('permintaan/add'); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus p-1"></i>
                                Tambah Data
                            </a>
                        </div>
                        <table id="TabelData1" class="table table-bordered table-sm table-hover">

                            <?= validation_errors(
                                '<div class="alert alert-warning alert-dismissible small">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>',
                                '</div>'
                            ); ?>

                            <thead>
                                <tr>
                                    <th class="text-center align-middle" col>No</th>
                                    <th class="text-center align-middle">Kode Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Detail Barang</th>
                                    <th class="text-center align-middle">Action</th>
                                    <th class="text-center align-middle">Konfirmasi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($data_permintaan as $pm => $value) : ?>
                                    <?php if ($value->status_konfperm == 'Menunggu') : ?>

                                        <?php
                                        // Panggil query untuk mendapatkan nama user berdasarkan kode permintaan
                                        $nama_user = $this->M_permintaan->tampilkan_nama_user_by_kode_perm($value->kode_perm);
                                        ?>

                                        <tr>
                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                            <td class="text-center align-middle"><?= substr($value->kode_perm, 0, strlen($value->kode_perm) - 16); ?></td>
                                            <td class="text-center align-middle"><?= $nama_user ? $nama_user->nama_user : ''; ?></td>

                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#detailPermintaan<?= $value->id_konfperm; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-search"></i></button>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#updatePermintaan<?= $value->id_konfperm; ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#deletePermintaan<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </td>

                                            <!-- Button "Sign Here" hanya ditampilkan pada baris pertama dengan id_validasi atau nama_user yang berbeda -->
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#konfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-check-double"></i></button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Riwayat <?= $action; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="TabelData2" class="table table-bordered table-sm table-hover">

                            <?= validation_errors(
                                '<div class="alert alert-warning alert-dismissible small">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>',
                                '</div>'
                            ); ?>

                            <thead>
                                <tr>
                                    <th class="text-center align-middle" col>No</th>
                                    <th class="text-center align-middle">Kode Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Status Permintaan</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($data_permintaan as $pm => $value) : ?>
                                    <?php if ($value->status_konfperm == 'Dikonfirmasi' || 'Ditolak') : ?>

                                        <?php
                                        // Panggil query untuk mendapatkan nama user berdasarkan kode permintaan
                                        $nama_user = $this->M_permintaan->tampilkan_nama_user_by_kode_perm($value->kode_perm);
                                        ?>

                                        <tr>
                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                            <td class="text-center align-middle"><?= substr($value->kode_perm, 0, strlen($value->kode_perm) - 16); ?></td>
                                            <td class="text-center align-middle"><?= $nama_user ? $nama_user->nama_user : ''; ?></td>
                                            <td class="text-center align-middle"><?= $value->status_konfperm; ?></td>
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#konfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>

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