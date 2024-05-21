<!-- Main content -->
<div class="container">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <h3 class="card-title">Tabel <?= $title2; ?></h3>
                </div>
                <?= form_open('cart/simpan'); ?>
                <div class="card-body">
                    <table id="TabelData2" class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 85px;">QTY</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Keterangan Barang</th>
                                <th class="text-center" colspan="2">Harga / Satuan</th>
                                <th class="text-center" colspan="2">Sub-Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                                <tr>
                                    <td>
                                        <?= form_input(array(
                                            'name' => $items['rowid'] . '[qty]',
                                            'value' => $items['qty'],
                                            'maxlength' => '3',
                                            'min' => 1,
                                            'size' => '5',
                                            'type' => 'number',
                                            'class' => 'form-control border-0 text-center'
                                        )); ?>
                                    </td>

                                    <td><?= $items['name']; ?></td>

                                    <td><?= form_input(array(
                                            'name' => $items['rowid'] . '_keterangan',
                                            'placeholder' => 'Masukan keterangan',
                                            'autofocus' => 'on',
                                            'size' => 'auto',
                                            'type' => 'text',
                                            'class' => 'form-control border-0'
                                        )); ?>
                                    </td>

                                    <td class="text-left border-right-0">Rp. </td>
                                    <td class="text-right border-left-0">
                                        <?php
                                        if ($items['price'] != 0) {
                                            echo number_format($items['price']);
                                        }
                                        ?>
                                    </td>

                                    <td class="text-left border-right-0" style="width: 150px;">Rp. </td>
                                    <td class=" text-right border-left-0">
                                        <?php
                                        if ($items['subtotal'] != 0) {
                                            echo number_format($items['subtotal']);
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="<?= base_url('cart/delete/' . $items['rowid']); ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="5" class="text-center"><strong>Total</strong></td>
                                <td colspan="1" class="text-left border-right-0">Rp. </td>
                                <td class="text-right border-left-0">
                                    <?php
                                    $total = $this->cart->total();
                                    echo $total != 0 ?  number_format($total) : '';
                                    ?>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" name="action" value="tambah" class="btn btn-outline-primary"><i class="fas fa-file-upload"></i> Tambah</button>
                    <button type="submit" name="action" value="perbarui" class="btn btn-outline-success"><i class="fas fa-undo"></i> Perbarui</button>
                    <a href="<?= base_url('cart/clear'); ?>" class="btn btn-outline-danger"><i class="fas fa-magic"></i> Bersihkan</a>
                    <a href="<?= base_url('home'); ?>" class="btn btn-outline-secondary"><i class="fas fa-home"></i> Kembali</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card -->
</div>
<!-- /.content -->