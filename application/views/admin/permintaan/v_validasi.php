<?php foreach ($permintaan as $id => $value) : ?>
    <div class="modal fade" id="signPermintaan<?= $value->id_validasi; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                    Tanda tangan seluruh permintaan ?
                    <br>
                    <span>Tanggal Permintaan : <strong class="text-primary"><?= $tanggal_permintaan; ?></strong></span>
                    <br>
                    <span>Nama Peminta : <strong class="text-primary"><?= $value->nama_user; ?></strong></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('permintaan/konfirmasi/' . $value->id_validasi); ?>" class="btn btn-outline-primary">Konfirmasi</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>