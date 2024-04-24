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
                                    <th class="text-center align-middle">Kode Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Action</th>
                                    <th class="text-center align-middle">Konfirmasi/Tolak</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($data_konfperm as $pm => $value) : ?>
                                    <?php if ($value->status_konfperm == 'Menunggu') : ?>

                                        <?php
                                        // Panggil query untuk mendapatkan nama user berdasarkan kode permintaan
                                        $nama_user = $this->M_permintaan->nama_user($value->kode_perm);
                                        ?>

                                        <?php
                                        $date = array(
                                            'Sunday' => 'Minggu',
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu'
                                        );
                                        $tanggal_konfperm = $value->tanggal_konfperm; // Tanggal dari data Anda
                                        $sekarang = date('l', strtotime($tanggal_konfperm)); // Ambil nama hari dalam Bahasa Inggris
                                        $hari_indo = isset($date[$sekarang]) ? $date[$sekarang] : $sekarang; // Ubah nama hari menjadi Bahasa Indonesia

                                        // Format tanggal dalam Bahasa Indonesia
                                        $format = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                        $tanggal_indo = $format->format(new DateTime($tanggal_konfperm));

                                        ?>

                                        <tr>
                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                            <td class="text-center align-middle"><?= $hari_indo . ', ' . $tanggal_indo; ?></td>
                                            <td class="text-center align-middle"><?= $value->kode_perm; ?></td>
                                            <td class="text-center align-middle"><?= $nama_user ? $nama_user->nama_user : ''; ?></td>
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#detail<?= $value->id_konfperm; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-search"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#updatePermintaan<?= $value->id_konfperm; ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></button>
                                                <!-- <button type="button" data-toggle="modal" data-target="#deletePermintaan<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button> -->
                                            </td>

                                            <!-- Button "Sign Here" hanya ditampilkan pada baris pertama dengan id_validasi atau nama_user yang berbeda -->
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#konfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-check-double"></i></button>
                                                <button type="button" data-toggle="modal" data-target="#tolakkonfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-window-close"></i></button>
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

                            <thead>
                                <tr>
                                    <th class="text-center align-middle" col>No</th>
                                    <th class="text-center align-middle">Tanggal Permintaan</th>
                                    <th class="text-center align-middle">Kode Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Status Permintaan</th>
                                    <!-- <th class="text-center align-middle">QR Code</th> -->
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($data_konfperm as $pm => $value) : ?>
                                    <?php if ($value->status_konfperm == 'Dikonfirmasi' || $value->status_konfperm == 'Ditolak') : ?>

                                        <?php
                                        // Panggil query untuk mendapatkan nama user berdasarkan kode permintaan
                                        $nama_user = $this->M_permintaan->nama_user($value->kode_perm);
                                        ?>

                                        <?php
                                        $hari = array(
                                            'Sunday' => 'Minggu',
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu'
                                        );
                                        $tanggal_konfperm = $value->tanggal_konfperm; // Tanggal dari data Anda
                                        $hari_ini = date('l', strtotime($tanggal_konfperm)); // Ambil nama hari dalam Bahasa Inggris
                                        $hari_indonesia = isset($hari[$hari_ini]) ? $hari[$hari_ini] : $hari_ini; // Ubah nama hari menjadi Bahasa Indonesia

                                        // Format tanggal dalam Bahasa Indonesia
                                        $format = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                        $tanggal_indonesia = $format->format(new DateTime($tanggal_konfperm));

                                        ?>

                                        <tr>
                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                            <td class="text-center align-middle"><?= $hari_indonesia . ', ' . $tanggal_indonesia; ?></td>
                                            <td class="text-center align-middle"><?= $value->kode_perm; ?></td>
                                            <td class="text-center align-middle"><?= $nama_user ? $nama_user->nama_user : ''; ?></td>
                                            <td class="text-center align-middle">
                                                <?php if ($value->status_konfperm == 'Dikonfirmasi') : ?>
                                                    <span class="btn btn-sm btn-primary"><?= $value->status_konfperm; ?></span>
                                                <?php elseif ($value->status_konfperm == 'Ditolak') : ?>
                                                    <span class="btn btn-sm btn-danger"><?= $value->status_konfperm; ?></span>
                                                <?php endif ?>
                                            </td>
                                            <!-- <td class="text-center align-middle">
                                                <a href="<?= base_url('assets/image/qrcode/' . $value->qr_code); ?>" data-toggle="lightbox">
                                                    <img src="<?= base_url('assets/image/qrcode/' . $value->qr_code); ?>" alt="Foto Profile" class="elevation-2 img-thumbnail img-size-32">
                                                </a>
                                            </td> -->
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#delete_riwayat_konfperm<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <?php if ($value->status_konfperm == 'Dikonfirmasi') : ?>
                                                    <a href="<?= base_url('permintaan/print_permintaan/' . $value->id_konfperm); ?>" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                <?php endif ?>
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