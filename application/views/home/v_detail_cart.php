<!-- Main content -->
<div class="container">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header">
                    <h3 class="card-title">Tabel Barang Permintaan</h3>
                </div>
                <?= form_open('cart/update'); ?>
                <div class="card-body">
                    <table cellpadding="6" cellspacing="1" style="width:100%" border="1">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 85px;">QTY</th>
                                <th class="text-center">Nama Barang</th>
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
                                            'name' => $i . '[qty]',
                                            'value' => $items['qty'],
                                            'maxlength' => '3',
                                            'min' => 1,
                                            'size' => '5',
                                            'type' => 'number',
                                            'class' => 'form-control border-0 text-center'
                                        )); ?>
                                    </td>
                                    <td><?= $items['name']; ?></td>
                                    <td class="text-left" style="width: 10px; border-right-color: transparent;">Rp. </td>
                                    <td class="text-right">
                                        <?php
                                        if ($items['price'] != 0) {
                                            echo number_format($items['price']);
                                        }
                                        ?>
                                    </td>
                                    <td class="text-left" style="width: 10px; border-right-color: transparent;">Rp. </td>
                                    <td class="text-right">
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
                                <td colspan="4" class="text-center"><strong>Total</strong></td>
                                <td class="text-left" style="border-right-color: transparent">Rp. </td>
                                <td class="text-right">
                                    <?php
                                    $total = $this->cart->total();
                                    echo $total != 0 ?  number_format($total) : '';
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                    <a href="<?= base_url('cart/clear'); ?>" class="btn btn-sm btn-danger">Clear</a>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card -->

    <div class="card card-solid">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?= base_url('cart/simpan'); ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="keterangan">Keterangan:</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control">
                            <small class="text-danger"><?= form_error('keterangan'); ?></small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Buat Permintaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.content -->