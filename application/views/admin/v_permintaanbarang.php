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
                                    <th class="text-center align-middle" col>No</th>
                                    <th class="text-center align-middle">Tanggal Permintaan</th>
                                    <th class="text-center align-middle">Nama Peminta</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Action</th>
                                    <th class="text-center align-middle">Sign PDF</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $count = 1; ?>
                                <?php $prev_tanggal_permintaan = ''; ?>
                                <?php $show_sign_button = true; ?>
                                <?php foreach ($permintaan as $pm => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $count++; ?></td>

                                        <?php
                                        $dateFormatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
                                        $dateFormatter->setPattern('EEEE d MMMM y');
                                        $tanggal_permintaan = new DateTime($value->tanggal_permintaan);
                                        $tanggal_indonesia = $dateFormatter->format($tanggal_permintaan);
                                        ?>

                                        <td class="text-center"><?= $tanggal_indonesia; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_user; ?></td>
                                        <td class="text-center align-middle"><?= $value->nama_barang; ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-toggle="modal" data-target="#detailPermintaan<?= $value->id_permintaan; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-search"></i></button>
                                            <button type="button" data-toggle="modal" data-target="#updatePermintaan<?= $value->id_permintaan; ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></button>
                                            <button type="button" data-toggle="modal" data-target="#deletePermintaan<?= $value->id_permintaan; ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                        <td class="text-center align-middle">
                                            <!-- Button "Sign Here" hanya ditampilkan pada baris pertama dengan tanggal_permintaan yang berbeda -->
                                            <?php if ($prev_tanggal_permintaan != $value->tanggal_permintaan) : ?>
                                                <button type="button" data-toggle="modal" data-target="#signPermintaan<?= $value->tanggal_permintaan; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-check-double"></i> Sign Here</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $prev_tanggal_permintaan = $value->tanggal_permintaan; ?>
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