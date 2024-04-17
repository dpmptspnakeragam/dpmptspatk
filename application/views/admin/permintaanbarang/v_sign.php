<?php foreach ($permintaan as $id => $value) : ?>
    <div class="modal fade" id="signPermintaan<?= $value->tanggal_permintaan; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    $dateFormatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
                    $dateFormatter->setPattern('EEEE d MMMM y');
                    $tanggal_permintaan = new DateTime($value->tanggal_permintaan);
                    $tanggal_indonesia = $dateFormatter->format($tanggal_permintaan);
                    ?>
                    Tanda tangan seluruh barang tanggal "<strong class="text-primary"><?= $tanggal_indonesia; ?></strong>" ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('datauser/delete/' . $value->id_user); ?>" class="btn btn-outline-primary">Tanda Tangan</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>