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

                        <div class="d-flex mb-3">
                            <a href="<?= base_url('databarang/add'); ?>" class="btn btn-outline-primary">
                                <i class="fas fa-plus p-1"></i>
                                Tambah Data
                            </a>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Kategori</th>
                                    <th class="text-center align-middle">Harga Satuan</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($barang as $u => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_barang; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_kategori; ?></td>
                                        <td class="text-center align-middle">Rp. <?= number_format($value->harga ?? 0, 0, ',', '.'); ?> / <?= $value->nama_satuan; ?></td>

                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#detailBarang<?= $value->id_barang; ?>" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                                            <a href="<?= base_url('databarang/update/' . $value->id_barang); ?>" class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
                                            <button type="button" data-toggle="modal" data-target="#deleteBarang<?= $value->id_barang; ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
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