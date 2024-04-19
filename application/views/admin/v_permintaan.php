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
                                    <th class="text-center align-middle">Tanggal Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Action</th>
                                    <th class="text-center align-middle">Konfirmasi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php $prev_id_validasi = ''; ?>
                                <?php $prev_nama_user = ''; ?>
                                <?php foreach ($permintaan as $pm => $value) : ?>
                                    <?php if ($value->status == 'menunggu') : ?>

                                        <?php
                                        // Mendapatkan bagian tanggal dari id_validasi
                                        $id_validasi_parts = explode('_', $value->id_validasi);
                                        $tanggal_permintaan = $id_validasi_parts[1]; // Bagian kedua adalah tanggal

                                        // Mendapatkan hari dari tanggal dalam bahasa Indonesia
                                        $hariIndonesia = [
                                            'Sunday' => 'Minggu',
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu'
                                        ];
                                        $hari = date('l', strtotime($tanggal_permintaan));
                                        ?>

                                        <tr>
                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                            <td class="text-center"><?= $hariIndonesia[$hari] . ', ' . date('d F Y', strtotime($tanggal_permintaan)); ?></td>
                                            <td class="text-center align-middle"><?= $value->nama_user; ?></td>
                                            <td class="text-center align-middle"><?= $value->nama_barang; ?></td>
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#detailPermintaan<?= $value->id_permintaan; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-search"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#updatePermintaan<?= $value->id_permintaan; ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#deletePermintaan<?= $value->id_permintaan; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </td>

                                            <!-- Button "Sign Here" hanya ditampilkan pada baris pertama dengan id_validasi atau nama_user yang berbeda -->
                                            <td class="text-center align-middle">
                                                <?php if ($prev_id_validasi != $value->id_validasi || $prev_nama_user != $value->nama_user) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#signPermintaan<?= $value->id_validasi; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-check-double"></i></button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <?php $prev_id_validasi = $value->id_validasi; ?>
                                        <?php $prev_nama_user = $value->nama_user; ?>
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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action2; ?></h3>
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
                                    <th class="text-center align-middle">Tanggal Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">QR Code</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>

                            <?php
                            $prev_id_validasi = '';
                            $prev_nama_user = '';
                            ?>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($permintaan as $pm => $value) : ?>
                                    <?php if ($value->status == 'dikonfirmasi') : ?>

                                        <?php
                                        // Mendapatkan bagian tanggal dari id_validasi
                                        $id_validasi_parts = explode('_', $value->id_validasi);
                                        $tanggal_permintaan = $id_validasi_parts[1]; // Bagian kedua adalah tanggal

                                        // Mendapatkan hari dari tanggal dalam bahasa Indonesia
                                        $hariIndonesia = [
                                            'Sunday' => 'Minggu',
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu'
                                        ];
                                        $hari = date('l', strtotime($tanggal_permintaan));
                                        ?>
                                        <?php if ($prev_id_validasi != $value->id_validasi || $prev_nama_user != $value->nama_user) : ?>
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <?= $count++; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $hariIndonesia[$hari] . ', ' . date('d F Y', strtotime($tanggal_permintaan)); ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= $value->nama_user; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <?= $value->nama_barang; ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="<?= base_url('assets/image/qrcode/' . $value->qr_code); ?>" data-toggle="lightbox">
                                                        <img src="<?= base_url('assets/image/qrcode/' . $value->qr_code); ?>" alt="Foto Profile" class="img-size-32">
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    Terkonfirmasi
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button type="button" data-toggle="modal" data-target="#deletePermintaan<?= $value->id_validasi; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php $prev_id_validasi = $value->id_validasi; ?>
                                        <?php $prev_nama_user = $value->nama_user; ?>
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