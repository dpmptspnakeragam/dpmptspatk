<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

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
                                    <?php if ($value->status_konfperm == 'Selesai' || $value->status_konfperm == 'Ditolak') : ?>

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
                                                        <button class="btn btn-outline-success" onclick="print(<?= $value->id_konfperm; ?>)">
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
                                                            <a href="<?= base_url('permintaan/tte/' . $value->id_konfperm); ?>" class="btn btn-outline-primary"><i class="fas fa-qrcode"></i> TTE</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if ($this->session->userdata('id_role') == 1) : ?>
                                                    <button type="button" data-toggle="modal" data-target="#delete_riwayat_konfperm<?= $value->id_konfperm; ?>" class="btn btn-outline-danger">
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