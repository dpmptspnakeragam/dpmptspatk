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

<!-- Ekko Lightbox -->
<script src="<?= base_url('assets/'); ?>plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<!-- Script JavaScript Section -->
<!-- <script>
    function scrollToElement(elementId) {
        var element = document.getElementById(elementId);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
</script> -->

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

<!-- Ekko Lightbox -->
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });


        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>

<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('warning')) { ?>
            const WarningToast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
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
        <?php if ($this->session->flashdata('success')) { ?>
            const SuccessToast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 2000,
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
    });
</script>


</body>

</html>