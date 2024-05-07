<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <a href="<?= base_url('permintaan'); ?>" class="info-box-icon bg-info">
                        <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Permintaan</span>
                        <span class="info-box-number"><?= $total_permintaan; ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <a href="<?= base_url('permintaan'); ?>" class="info-box-icon bg-danger">
                        <span class="info-box-icon"><i class="fas fa-qrcode"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">Menunggu TTE</span>
                        <span class="info-box-number"><?= $total_tte; ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <a href="<?= base_url('datauser'); ?>" class="info-box-icon bg-warning">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number"><?= $total_user; ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <a href="<?= base_url('databarang'); ?>" class="info-box-icon bg-success">
                        <span class="info-box-icon"><i class="fas fa-boxes"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Barang</span>
                        <span class="info-box-number"><?= $total_barang; ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <a href="<?= base_url('kategoribarang'); ?>" class="info-box-icon bg-secondary">
                        <span class="info-box-icon"><i class="fas fa-boxes"></i></span>
                    </a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Kategori</span>
                        <span class="info-box-number"><?= $total_kategori; ?></span>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Permintaan ATK</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas id="permintaan-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->