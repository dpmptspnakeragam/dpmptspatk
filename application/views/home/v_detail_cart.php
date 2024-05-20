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
                    <table id="TabelData1" cellpadding="6" cellspacing="1" style="width:100%" border="1">
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
                                    <td><?= form_input(array(
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

                                    <td class="text-center" style="width: 10px;">
                                        <input class="border-0" type="text" name="<?= $items['rowid'] ?>_keterangan" style="width: 200px;" placeholder="Keterangan Barang" autofocus>
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
                                        <a href="<?= base_url('cart/delete/' . $items['rowid']); ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                    <button type="submit" name="action" value="tambah" class="btn btn-sm btn-primary">Tambah</button>
                    <button type="submit" name="action" value="perbarui" class="btn btn-sm btn-success">Perbarui</button>
                    <a href="<?= base_url('cart/clear'); ?>" class="btn btn-sm btn-danger">Batal</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card -->
</div>
<!-- /.content -->