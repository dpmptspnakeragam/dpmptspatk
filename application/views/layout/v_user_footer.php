</div>
<!-- /.content-wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
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
        function initializeDataTable(selectors) {
            selectors.forEach(function(selector) {
                $(selector).DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo($(selector + '_wrapper .col-md-6:eq(0)'));
            });
        }

        initializeDataTable(["#TabelData1", "#TabelData2", "#TabelData3", "#TabelData4"]);
    });
</script>

<!-- Select 2 -->
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>

<!-- Sweetalert 2 -->
<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')) { ?>
            const SuccessToast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            SuccessToast.fire({
                icon: "success",
                title: "<?= $this->session->flashdata('success'); ?>"
            });
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            const ErrorToast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            ErrorToast.fire({
                icon: "error",
                title: "<?= $this->session->flashdata('error'); ?>"
            });
        <?php } ?>

        <?php if ($this->session->flashdata('warning')) { ?>
            const WarningToast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            WarningToast.fire({
                icon: "warning",
                title: "<?= $this->session->flashdata('warning'); ?>"
            });
        <?php } ?>

    });
</script>

<!-- Ekko Lightbox -->
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({
            gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>

<!-- Script untuk menampilkan pratinjau gambar -->
<script>
    document.getElementById('profileUpload').onchange = function(e) {
        var input = e.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(event) {
                document.getElementById('profilePreview').src = event.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    };
</script>

<!-- Script menampilkan tb_barang secara otomatis -->
<script>
    $(document).ready(function() {
        // Ketika dropdown dipilih
        $('#id_barang').change(function() {
            var selectedOption = $(this).find(':selected');
            var kategori = selectedOption.data('kategori');
            var satuan = selectedOption.data('satuan');
            var harga = selectedOption.data('harga');

            $('#kategori_barang').val(kategori);
            $('#satuan_barang').val(satuan);
            // Ubah format harga menjadi Rupiah
            $('#harga').val(formatRupiah(harga));
        });

        // Ketika halaman dimuat
        var selectedOption = $('#id_barang').find(':selected');
        var kategori = selectedOption.data('kategori');
        var satuan = selectedOption.data('satuan');
        var harga = selectedOption.data('harga');

        $('#kategori_barang').val(kategori);
        $('#satuan_barang').val(satuan);
        // Ubah format harga menjadi Rupiah
        $('#harga').val(formatRupiah(harga));
    });

    // Fungsi untuk mengubah format harga menjadi Rupiah
    function formatRupiah(angka) {
        var number_string = angka.toString();
        var split = number_string.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }
</script>

<script>
    $(document).ready(function() {
        $('#jumlah').on('input', function() {
            hitungTotalHarga();
        });

        $('#id_barang').change(function() {
            hitungTotalHarga();
        });

        function hitungTotalHarga() {
            var jumlah = parseInt($('#jumlah').val());
            var harga = parseInt($('#harga').val().replace(/\D/g, '')); // Menghilangkan semua karakter non-digit dari harga
            var total = jumlah * harga;

            // Ubah format total harga menjadi Rupiah
            $('#total_harga').val(formatRupiah(total));
        }

        // Fungsi untuk mengubah format harga menjadi Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString();
            var split = number_string.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }
    });
</script>

</body>

</html>