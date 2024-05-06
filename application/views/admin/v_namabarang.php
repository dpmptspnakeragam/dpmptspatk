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
                            <a href="<?= base_url('namabarang/add'); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus p-1"></i>
                                Tambah Data
                            </a>
                        </div>

                        <table id="TabelData1" class="table table-bordered table-sm table-hover">

                            <?= validation_errors(
                                '<div class="alert alert-warning alert-dismissible small">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>',
                                '</div>'
                            ); ?>

                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Gambar Barang</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($nama as $u => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_barang; ?></td>
                                        <td class="text-center align-middle">
                                            <img src="<?= base_url('assets/image/barang/' . $value->gambar); ?>" alt="Foto Profile" class="elevation-2 img-thumbnail img-size-50">
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('namabarang/update/' . $value->id_nama); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button type="button" data-toggle="modal" data-target="#deleteNama<?= $value->id_nama; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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