<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Sistem Pergudangan' ?></title>

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="far fa-user"></i> <?= session('name_user') ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="<?= base_url('profile') ?>" class="dropdown-item">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('logout') ?>" class="dropdown-item text-danger">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="<?= base_url() ?>" class="brand-link text-center">
            <span class="brand-text font-weight-light"><strong>PERGUDANGAN</strong></span>
        </a>

        <div class="sidebar">

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu">

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>"
                           class="nav-link <?= current_url() == base_url('dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Master Data (superadmin only) -->
                    <?php if (session('level_user') == 'superadmin'): ?>
                        <li class="nav-header">MASTER DATA</li>

                        <li class="nav-item">
                            <a href="<?= base_url('master/user') ?>"
                               class="nav-link <?= uri_string() == 'master/user' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Master User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('master/gudang') ?>"
                               class="nav-link <?= uri_string() == 'master/gudang' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>Master Gudang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('master/kategori') ?>"
                               class="nav-link <?= uri_string() == 'master/kategori' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Master Kategori</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('master/barang') ?>"
                               class="nav-link <?= uri_string() == 'master/barang' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Master Barang</p>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Transaksi -->
                    <li class="nav-header">TRANSAKSI</li>

                    <li class="nav-item">
                        <a href="<?= base_url('transaksi/penerimaan') ?>" class="nav-link">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>
                                Barang Masuk
                                <?php
                                $pending = (new \App\Models\BarangMasukModel())->getPendingCount();
                                if ($pending > 0): ?>
                                    <span class="right badge badge-danger"><?= $pending ?></span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('transaksi/surat-jalan') ?>" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Barang Keluar
                                <?php
                                $pendingKeluar = (new \App\Models\BarangKeluarModel())->getPendingCount();
                                if ($pendingKeluar > 0): ?>
                                    <span class="right badge badge-danger"><?= $pendingKeluar ?></span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>

        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <h1><?= $title ?? 'Dashboard' ?></h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2025 Sistem Pergudangan.</strong>
        All rights reserved.
    </footer>

</div>

<!-- Scripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>

</body>
</html>
