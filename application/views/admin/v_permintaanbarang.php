<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>

                        <div class="card-tools">

                            <a href="<?= base_url('permintaanbarang/add'); ?>" class="btn btn-outline-primary btn-sm">Tambah</a>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="TabelData1" class="table table-bordered table-striped table-hover">

                            <?= validation_errors(
                                '<div class="alert alert-warning alert-dismissible small">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>',
                                '</div>'
                            ); ?>

                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Kategori Barang</th>
                                    <th class="text-center align-middle">Harga Satuan</th>
                                    <th class="text-center align-middle">Total Bayar</th>
                                    <th class="text-center align-middle">Keterangan</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($permintaan as $u => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_user; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_barang; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_kategori; ?></td>
                                        <td class="text-center align-middle">Rp. <?= number_format($value->harga, 0, ',', '.'); ?>,- x <?= $value->jumlah; ?> <?= $value->nama_satuan; ?></td>
                                        <td class="text-center align-middle">Rp. <?= number_format($value->total, 0, ',', '.'); ?></td>
                                        <td class="text-center align-middle"><?= $value->keterangan; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#updateKategori<?= $value->id_kategori; ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></button>
                                            <button type="button" data-toggle="modal" data-target="#deleteKategori<?= $value->id_kategori; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
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