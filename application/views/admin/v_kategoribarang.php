<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>

                        <div class="card-tools">
                            <a href="<?= base_url('kategoribarang/add'); ?>" class="btn btn-outline-primary btn-sm">Tambah</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                    <th class="text-center align-middle">Nama Kategori</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($kategori as $u => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_kategori; ?></td>

                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('kategoribarang/update/' . $value->id_kategori); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
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