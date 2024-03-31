<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>

                        <div class="card-tools">

                            <a href="<?= base_url('databarang/add'); ?>" class="btn btn-outline-primary btn-sm">Tambah</a>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="TabelData1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Kategori</th>
                                    <th class="text-center align-middle">Harga Satuan</th>
                                    <th class="text-center align-middle">Stok</th>
                                    <th class="text-center align-middle">Deskripsi</th>
                                    <th class="text-center align-middle">Gambar</th>
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
                                        <td class="text-center align-middle">Rp. <?= $value->harga; ?> / <?= $value->nama_satuan; ?></td>
                                        <td class="text-center align-middle"><?= $value->stok; ?></td>
                                        <td class="text-center align-middle"><?= $value->deskripsi; ?></td>

                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('assets/image/barang/' . $value->gambar); ?>" data-toggle="lightbox">
                                                <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" alt="Foto Profile" class="img-size-50">
                                            </a>
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('databarang/update/' . $value->id_barang); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button type="button" data-toggle="modal" data-target="#deleteUser<?= $value->id_barang; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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