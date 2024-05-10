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
                                    <!-- <th class="text-center align-middle">Detail</th> -->
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($data_konfperm as $pm => $value) : ?>

                                    <?php if (in_array($value->status_konfperm, [1, 2, 3])) : ?>
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
                                            <td class="text-center align-middle">
                                                <?php if ($value->status_konfperm == 1) : ?>
                                                    <span class="badge bg-success">Menunggu konfirmasi Kasubag Umum dan Kepegawaian</span>
                                                <?php elseif ($value->status_konfperm == 2) : ?>
                                                    <span class="badge bg-info">Menunggu konfirmasi Sekretaris</span>
                                                <?php elseif ($value->status_konfperm == 3) : ?>
                                                    <span class="badge bg-primary">Menunggu konfirmasi Kepala Dinas</span>
                                                <?php endif; ?>
                                            </td>
                                            <!-- <td class="text-center align-middle">
                                                <button type="button" data-toggle="modal" data-target="#detail<?= $value->id_konfperm; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-search"></i></button>
                                            </td> -->
                                            <td class="text-center align-middle">

                                                <?php if ($this->session->userdata('id_role') != 5) : ?>
                                                    <?php if ($value->status_konfperm == 1 && in_array($this->session->userdata('id_user'), [1, 4])) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#konfirmasi1<?= $value->id_konfperm; ?>" class="btn btn-outline-primary btn-sm mt-1 mb-1"><i class="fas fa-check"></i></button>
                                                    <?php elseif ($value->status_konfperm == 2 && in_array($this->session->userdata('id_user'), [1, 3])) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#konfirmasi2<?= $value->id_konfperm; ?>" class="btn btn-outline-primary btn-sm mt-1 mb-1"><i class="fas fa-check-double"></i></button>
                                                    <?php elseif ($value->status_konfperm == 3 && in_array($this->session->userdata('id_user'), [1, 2])) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#konfirmasi3<?= $value->id_konfperm; ?>" class="btn btn-outline-primary btn-sm mt-1 mb-1"><i class="fas fa-tasks"></i></button>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if ($this->session->userdata('id_role') != 5) : ?>
                                                    <?php if ($value->status_konfperm != 2 || $value->status_konfperm != 3) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#tolakkonfirmasi<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm mt-1 mb-1"><i class="fas fa-window-close"></i></button>
                                                    <?php endif; ?>
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
                                    <?php if ($value->status_konfperm == 'Menunggu' || $value->status_konfperm == 'Selesai' || $value->status_konfperm == 'Ditolak') : ?>

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
                                                <?php if ($value->status_konfperm == 'Selesai') : ?>
                                                    <span class="badge bg-primary"><?= $value->status_konfperm; ?></span>
                                                <?php elseif ($value->status_konfperm == 'Menunggu') : ?>
                                                    <span class="badge bg-info"><?= $value->status_konfperm; ?> TTE</span>
                                                <?php elseif ($value->status_konfperm == 'Ditolak') : ?>
                                                    <span class="badge bg-danger"><?= $value->status_konfperm; ?></span>
                                                <?php endif ?>
                                            </td>

                                            <td class="text-center align-middle">
                                                <?php if (($value->status_konfperm == 'Selesai' || $value->status_konfperm == 'Menunggu')) : ?>
                                                    <?php if (!empty($value->qr_code)) : ?>
                                                        <!-- Jika qr_code sudah ada, tampilkan tombol Print -->
                                                        <!-- <a href="<?= base_url('permintaan/cetak/' . $value->id_konfperm); ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-print"></i> Print</a> -->
                                                        <button class="btn btn-outline-success btn-sm" onclick="print(<?= $value->id_konfperm; ?>)">
                                                            <i class="fas fa-print"></i> Print
                                                        </button>
                                                        <script>
                                                            function print(id) {
                                                                // Redirect ke halaman cetak dengan ID kuesioner
                                                                window.open('<?php echo base_url('permintaan/cetak/'); ?>' + id, '_blank');
                                                            }
                                                        </script>
                                                    <?php else : ?>
                                                        <?php if (in_array($this->session->userdata('id_user'), [1, 2])) : ?>
                                                            <!-- Jika qr_code belum ada, tampilkan tombol TTE -->
                                                            <a href="<?= base_url('permintaan/tte/' . $value->id_konfperm); ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-qrcode"></i> TTE</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if ($this->session->userdata('id_role') == 1) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#delete_riwayat_konfperm<?= $value->id_konfperm; ?>" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
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
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var validateQRButton = document.getElementById('validateQRButton');
        var printButton = document.getElementById('printButton');

        // Fungsi untuk menampilkan tombol Print dan menyembunyikan tombol Validasi QR
        function showPrintButton() {
            validateQRButton.style.display = 'none';
            printButton.style.display = 'inline-block';
            // Simpan status tombol Validasi QR ke local storage
            localStorage.setItem('validasi_qr_<?= $value->id_konfperm ?>', 'shown');
        }

        // Cek apakah tombol Validasi QR sudah pernah diklik sebelumnya
        var validasiQrStatus = localStorage.getItem('validasi_qr_<?= $value->id_konfperm ?>');
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
</script> -->