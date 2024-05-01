<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <link href="<?= base_url('assets/'); ?>image/logo/favicon.png" rel="shortcut icon" type="image/png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url('login'); ?>">
                <img src="<?= base_url('assets/image/logo/atk.png'); ?>" alt="Logo ATK" class="w-75">
            </a>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body rounded">
                <p class="login-box-msg">Sign in to start your session</p>

                <?= validation_errors(
                    '<div class="alert alert-warning alert-dismissible small">
                <i class="icon fas fa-exclamation-triangle"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>',
                    '</div>'
                ); ?>

                <?= form_open('login') ?>
                <div class="input-group mb-3">
                    <input name="username" type="text" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <div class="row">
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <div class="col-7 text-right mt-2">
                        <a href="<?= base_url('/'); ?>">
                            <strong>Back to Website ATK</strong>
                        </a>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) { ?>
                const SuccessToast = Swal.mixin({
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
                    timer: 3000,
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

            <?php if ($this->session->flashdata('info')) { ?>
                const InfoToast = Swal.mixin({
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
                InfoToast.fire({
                    icon: "info",
                    title: "<?= $this->session->flashdata('info'); ?>"
                });
            <?php } ?>

        });
    </script>
</body>

</html>