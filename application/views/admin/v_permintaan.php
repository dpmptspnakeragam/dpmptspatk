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
                        <!-- <?php if ($this->session->userdata('id_role') != 2 && $this->session->userdata('id_role') != 3 && $this->session->userdata('id_role') != 4) : ?>
                            <div class="d-flex mb-3">
                                <a href="<?= base_url('permintaan/add'); ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-plus p-1"></i>
                                    Tambah Data
                                </a>
                            </div>
                        <?php endif; ?> -->
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

                                        // Coba format tanggal dalam Bahasa Indonesia menggunakan IntlDateFormatter
                                        if (class_exists('IntlDateFormatter')) {
                                            $format = new IntlDateFormatter('id_ID', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                                            $tanggal_indo = $format->format(new DateTime($tanggal_konfperm));
                                        } else {
                                            // Fallback jika IntlDateFormatter tidak tersedia
                                            $tanggal_indo = date('d F Y', strtotime($tanggal_konfperm)); // Format default
                                        }

                                        // Gunakan variabel yang konsisten
                                        $hari_indonesia = $hari_indo;
                                        $tanggal_indonesia = $tanggal_indo;

                                        // Output hasil
                                        echo $hari_indonesia . ', ' . $tanggal_indonesia;
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
                                                <button type="button" data-toggle="modal" data-target="#detail<?= $value->id_konfperm; ?>" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
                                            </td> -->
                                            <td class="text-center align-middle">

                                                <?php if ($this->session->userdata('id_role') != 5) : ?>
                                                    <?php if ($value->status_konfperm == 1 && in_array($this->session->userdata('id_user'), [1, 4])) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#konfirmasi1<?= $value->id_konfperm; ?>" class="btn btn-outline-primary mt-1 mb-1"><i class="fas fa-check"></i></button>
                                                    <?php elseif ($value->status_konfperm == 2 && in_array($this->session->userdata('id_user'), [1, 3])) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#konfirmasi2<?= $value->id_konfperm; ?>" class="btn btn-outline-primary mt-1 mb-1"><i class="fas fa-check-double"></i></button>
                                                    <?php elseif ($value->status_konfperm == 3 && in_array($this->session->userdata('id_user'), [1, 2])) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#konfirmasi3<?= $value->id_konfperm; ?>" class="btn btn-outline-primary mt-1 mb-1"><i class="fas fa-tasks"></i></button>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if ($this->session->userdata('id_role') != 5) : ?>
                                                    <?php if ($value->status_konfperm == 2 && $this->session->userdata('id_role') == 4) : ?>
                                                        <!-- Kosongkan bagian ini untuk menyembunyikan button -->
                                                    <?php elseif ($value->status_konfperm == 3 && ($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 3)) : ?>
                                                        <!-- Kosongkan bagian ini untuk menyembunyikan button -->
                                                    <?php else : ?>
                                                        <button type="button" data-toggle="modal" data-target="#tolak<?= $value->id_konfperm; ?>" class="btn btn-outline-danger mt-1 mb-1"><i class="fas fa-window-close"></i></button>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if ($this->session->userdata('id_role') != 2 && $this->session->userdata('id_role') != 3 && $this->session->userdata('id_role') != 4) : ?>
                                                    <?php if ($nama_user && ($nama_user->id_user == $this->session->userdata('id_user') || $this->session->userdata('id_user') == 1)) : ?>
                                                        <button type="button" data-toggle="modal" data-target="#batalkan<?= $value->id_konfperm; ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                    <?php endif; ?>
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