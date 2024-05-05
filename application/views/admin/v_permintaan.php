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
                        <?php if ($this->session->userdata('id_role') != 2 && $this->session->userdata('id_role') != 3 && $this->session->userdata('id_role') != 4) : ?>
                            <div class="d-flex mb-3">
                                <a href="<?= base_url('permintaan/add'); ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-plus p-1"></i>
                                    Tambah Data
                                </a>
                            </div>
                        <?php endif; ?>
                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" col>No</th>
                                    <th class="text-center align-middle">Tanggal</th>
                                    <th class="text-center align-middle">Peminta</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Detail</th>
                                    <th class="text-center align-middle">Action</th>
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
                                            <td class="text-center align-middle"><?= $nama_user ? $nama_user->nama_user : ''; ?></td>
                                            <td class="text-center align-middle"><span class="badge bg-success"><?= $value->status_konfperm; ?></span></td>
                                            <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#detail<?= $value->id_konfperm; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-search"></i></button>
                                            </td>
                                            <td class="text-center align-middle">

                                                <?php if ($this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 1) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#konfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-check-double"></i></button>
                                                <?php endif; ?>
                                                <?php if ($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 2 || $this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 4) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#tolakkonfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-window-close"></i></button>
                                                <?php endif; ?>

                                                <?php if ($this->session->userdata('id_role') != 2 && $this->session->userdata('id_role') != 3 && $this->session->userdata('id_role') != 4) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#hapusPermintaan<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                <?php endif; ?>
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
                                    <th class="text-center align-middle">Tanggal</th>
                                    <th class="text-center align-middle">Peminta</th>
                                    <th class="text-center align-middle">Status</th>
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
                                            <td class="text-center align-middle"><?= $nama_user ? $nama_user->nama_user : ''; ?></td>
                                            <td class="text-center align-middle">
                                                <?php if ($value->status_konfperm == 'Dikonfirmasi') : ?>
                                                    <span class="badge bg-primary"><?= $value->status_konfperm; ?></span>
                                                <?php elseif ($value->status_konfperm == 'Ditolak') : ?>
                                                    <span class="badge bg-danger"><?= $value->status_konfperm; ?></span>
                                                <?php endif ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php if ($this->session->userdata('id_role') == 1) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#delete_riwayat_konfperm<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <?php if ($value->status_konfperm == 'Dikonfirmasi') : ?>
                                                    <?php
                                                    $validasiQrStatus = isset($_SESSION['validasi_qr_' . $value->kode_perm]) ? $_SESSION['validasi_qr_' . $value->kode_perm] : 'hidden';
                                                    ?>
                                                    <a id="printButton" href="<?= base_url('permintaan/cetak/' . $value->kode_perm); ?>" class="btn btn-outline-success btn-sm" style="display: <?= $validasiQrStatus === 'shown' ? 'inline-block' : 'none'; ?>"><i class="fas fa-print"></i> Print</a>
                                                    <a id="validateQRButton" href="<?= base_url('permintaan/validasi_qr/' . $value->kode_perm); ?>" class="btn btn-outline-primary btn-sm" style="display: <?= $validasiQrStatus === 'hidden' ? 'inline-block' : 'none'; ?>"><i class="fas fa-file-archive"></i> Validasi QR</a>
                                                <?php endif ?>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        var validateQRButton = document.getElementById('validateQRButton');
                                                        var printButton = document.getElementById('printButton');

                                                        // Fungsi untuk menampilkan tombol Print dan menyembunyikan tombol Validasi QR
                                                        function showPrintButton() {
                                                            validateQRButton.style.display = 'none';
                                                            printButton.style.display = 'inline-block';
                                                            // Simpan status tombol Validasi QR ke local storage
                                                            localStorage.setItem('validasi_qr_<?= $value->kode_perm ?>', 'shown');
                                                        }

                                                        // Cek apakah tombol Validasi QR sudah pernah diklik sebelumnya
                                                        var validasiQrStatus = localStorage.getItem('validasi_qr_<?= $value->kode_perm ?>');
                                                        if (validasiQrStatus === 'shown') {
                                                            showPrintButton();
                                                        }

                                                        // Panggil fungsi showPrintButton saat tombol Validasi QR diklik
                                                        validateQRButton.addEventListener('click', function() {
                                                            // Lakukan validasi QR di sini
                                                            // Misalnya, jika validasi berhasil, panggil showPrintButton();
                                                            showPrintButton();
                                                        });
                                                    });
                                                </script>

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