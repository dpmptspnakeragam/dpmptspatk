<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="<?= base_url('assets/'); ?>image/logo/favicon.png" rel="shortcut icon" type="image/png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/ekko-lightbox/ekko-lightbox.css">

    <!-- jQuery -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>

    <style>
        .row {
            display: flex;
            align-items: center;
        }

        .col-12 p {
            display: flex;
            align-items: center;
            margin-bottom: 0;
            /* Menghilangkan margin bawah pada paragraf */
        }

        .label {
            width: 100px;
            /* Lebar label, sesuaikan dengan kebutuhan */
        }

        /* Atur margin-right untuk memberikan jarak antara label dan isi */
        .label::after {
            content: "";
            margin-right: 10px;
        }

        body {
            font-size: 18pt;
            font-family: 'Times New Roman', Times, serif;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .img-qrcode {
            width: 110px;
            height: 110px;
            /* margin-right: 100px; */
        }

        .header-line {
            border-top: 3px solid #333;
            /* Warna garis dan ketebalan dapat disesuaikan */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row mb-4">
            <div class="col-2 text-center">
                <img src="<?= base_url('assets/image/logo/agam.png'); ?>" alt="Logo Agam" class="img-size-64">
            </div>
            <div class="col-8 text-center">
                <strong>Invoice Permintaan ATK</strong>
                <br>
                <strong>Dinas Penanaman Modal Pelayanan Terpadu Satu Pintu</strong>
                <br>
                <strong>(DPMPTSP) Kabupaten Agam</strong>
            </div>
            <div class="col-2 text-center">
            </div>
        </div>

        <div class="header-line"></div>
        <div class="header-line"></div>

        <div class="row mb-4 mt-4">
            <div class="col-12">
                <p><span class="label">Hari</span> : Senin <?= date('d F Y') ?></p>
            </div>
            <div class="col-12">
                <p><span class="label">Tanggal</span> : <?= date('d F Y') ?></p>
            </div>
            <div class="col-12">
                <p><span class="label">Kegiatan</span> : Isian Kegiatan</p>
            </div>
        </div>

        <table id="TabelData1" class="table table-bordered table-sm table-hover">
            <thead>
                <tr>
                    <th class="text-center align-middle" col>No</th>
                    <th class="text-center align-middle">Nama Barang</th>
                    <th class="text-center align-middle">QTY</th>
                    <th class="text-center align-middle">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                <?php foreach ($nama_barang as  $barang) : ?>
                    <tr>
                        <td class="text-center align-middle"><?= $count++; ?></td>
                        <td class="text-center align-middle nama-barang"><?= $barang->nama_barang; ?></td>
                        <td class="text-center align-middle"><?= $barang->jumlah_perm; ?></td>
                        <td class="text-right align-middle">Rp. <?= number_format($barang->sub_total, 0, ',', '.'); ?></td>

                    </tr>
                <?php endforeach; ?>
                <td class="text-center" colspan="3">Total Bayar</td>
                <td class="text-right">Rp.
                    <?php if ($total_bayar && isset($total_bayar->total_bayar)) : ?>
                        Rp. <?= number_format($total_bayar->total_bayar, 0, ',', '.'); ?>
                    <?php endif; ?>
                </td>
            </tbody>
        </table>

        <div class="row mt-4">
            <div class="col-6 text-center">
                Nama Peminta
                <br>
                <br>
                <br>
                <br>
                <strong>
                    <?php if ($nama_user && isset($nama_user->nama_user)) : ?>
                        <?= $nama_user->nama_user; ?>
                    <?php endif; ?>
                </strong>
            </div>
            <div class="col-6 text-center">
                Staf Administrasi
                <br>
                <br>
                <br>
                <br>
                <strong>WELLY DESVITRI YANTI, S.Pd</strong>
                <br>
                NIP. 19841217 201001 2 026
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 text-center">
                Diketahui oleh:
                <br>
                Pejabat Pelaksana Teknis Kegiatan
                <br>
                <br>
                <br>
                <br>
                <strong>JATIRMAN, SST</strong>
                <br>
                NIP. 19671012 198903 1 007
            </div>
            <div class="col-6 text-center">
                Disetujui oleh:
                <br>
                Pengguna Anggaran
                <br>
                <img src="<?= $qr_code ?>" alt="Foto Profile" class="img-qrcode">
                <br>
                <strong>Dr. MHD LUTFI AR, SH, M.Si</strong>
                <br>
                NIP. 19730313 199703 1 005
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>

    <!-- Select2 -->
    <script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="<?= base_url('assets/'); ?>plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

    <!-- Page specific script -->
    <!-- Tabel Data Custom -->
    <script>
        $(function() {
            function DataTable(selectors) {
                selectors.forEach(function(selector) {
                    $(selector).DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": false,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo($(selector + '_wrapper .col-md-6:eq(0)'));
                });
            }

            DataTable(["#TabelData1", "#TabelData2", "#TabelData3", "#TabelData4"]);
        });
    </script>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>