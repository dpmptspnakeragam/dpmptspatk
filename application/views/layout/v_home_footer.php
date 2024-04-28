</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Version 0.1
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2024-<?= date("Y"); ?> Development by IT <a href="https://dpmptsp.agamkab.go.id">DPMPTSP Kabupaten Agam</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
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

<!-- SweetAlert2 -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables pada elemen yang berisi card barang
        $('#cardWrapper').DataTable({
            "paging": true, // Aktifkan paging
            "lengthChange": true, // Aktifkan pengaturan jumlah data per halaman
            "searching": true, // Aktifkan fitur pencarian
            "ordering": false, // Nonaktifkan pengurutan (karena kita sudah menggunakan struktur card)
            "info": true, // Aktifkan informasi jumlah data
            "autoWidth": false, // Nonaktifkan penyesuaian lebar otomatis
            "responsive": true // Aktifkan responsif untuk tampilan yang lebih baik pada perangkat mobile
        });
    });
</script>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Barang berhasil masuk ke keranjang.'
            })
        });
    });
</script>

</body>

</html>