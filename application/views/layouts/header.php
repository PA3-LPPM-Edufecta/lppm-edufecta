<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url() ?>" target="_blank" class="nav-link">Landing Page</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url('admin/dasboard') ?>" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link active">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Settings
                <i class="right fas fa-angle-down"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Master Data
                <i class="right fas fa-angle-down"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Penelitian
                <i class="right fas fa-angle-down"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Pengabdian
                <i class="right fas fa-angle-down"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Kinerja Penelitian
                <i class="right fas fa-angle-down"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Kinerja Pengabdian
                <i class="right fas fa-angle-down"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="image">
                <img src="<?php echo base_url(); ?>assets/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">John Doe</a>
            </div>
        </div>
        <li class="nav-item text-success text-strong">
            <a class="nav-link" href="<?php echo base_url('admin/akun') ?>">
                <i class="fa fa-user"></i> <?php echo $this->session->userdata('name'); ?>
            </a>
        </li>
        <li class="nav-item text-danger text-strong">
            <a class="nav-link" href="<?php echo base_url('login/logout') ?>">
                <i class="fa fa-sign-out"></i> Keluar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->