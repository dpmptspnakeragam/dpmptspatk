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
                            <a href="<?= base_url('satuanbarang/add'); ?>" class="btn btn-outline-primary btn-sm">
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
                                    <th class="text-center align-middle">Nama Satuan</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($satuan as $u => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_satuan; ?></td>

                                        <td class="text-center align-middle">
                                            <a href="<?= base_url('satuanbarang/update/' . $value->id_satuan); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <button type="button" data-toggle="modal" data-target="#deleteSatuan<?= $value->id_satuan; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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