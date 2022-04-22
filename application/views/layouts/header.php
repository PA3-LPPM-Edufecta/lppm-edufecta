<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url('home'); ?>" target="_blank" class="nav-link">Landing Page</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url() ?>" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Settings</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <li><a href="#" class="dropdown-item">Group</a></li>
                <li><a href="#" class="dropdown-item">User</a></li>
                <li><a href="#" class="dropdown-item">Menu Manager</a></li>
                <li><a href="#" class="dropdown-item">Company</a></li>
            </ul>
        </li>
        
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master Data</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <li><a href="#" class="dropdown-item">Data Dosen</a></li>
                <li><a href="#" class="dropdown-item">Skim Penelitian</a></li>
                <li><a href="#" class="dropdown-item">Skim Pengabdian</a></li>
                <li><a href="<?php echo base_url('masterdata/luaran') ?>" class="dropdown-item">Luaran</a></li>
                <li><a href="#" class="dropdown-item">Bidang Ilmu</a></li>
                <li><a href="#" class="dropdown-item">Waktu Pengajuan Proposal</a></li>
                <li><a href="#" class="dropdown-item">Jenis Pencairan</a></li>
                <li><a href="#" class="dropdown-item">Upload Template Proposal</a></li>
                <li><a href="#" class="dropdown-item">Data Reviewer</a></li>
                <li><a href="#" class="dropdown-item">Kompenen Penilaian Proposal</a></li>
                <li><a href="#" class="dropdown-item">Kategori Template Proposal</a></li>
            </ul>
        </li>
        
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Penelitian</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <li><a href="#" class="dropdown-item">Pengajuan Baru Penelitian</a></li>
                <li><a href="#" class="dropdown-item">Data Penelitian</a></li>
                <li><a href="#" class="dropdown-item">Reviewer</a></li>
                <li><a href="#" class="dropdown-item">Cetak Lembar Pengesahan</a></li>
                <li><a href="#" class="dropdown-item">Upload Proposal</a></li>
                <li><a href="#" class="dropdown-item">Persetujuan/Revisi</a></li>
                <li><a href="#" class="dropdown-item">Catatan Harian</a></li>
                <li><a href="#" class="dropdown-item">Laporan Kemajuan</a></li>
                <li><a href="#" class="dropdown-item">Laporan Akhir</a></li>
                <li><a href="#" class="dropdown-item">Upload Hasil Seminar/Luaran</a></li>
            </ul>
        </li>
        
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pengabdian</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                <li><a href="#" class="dropdown-item">Pengajuan Baru Pengabdian</a></li>
                <li><a href="#" class="dropdown-item">Data Pengabdian</a></li>
                <li><a href="#" class="dropdown-item">Reviewer</a></li>
                <li><a href="#" class="dropdown-item">Cetak Lembar Pengesahan</a></li>
                <li><a href="#" class="dropdown-item">Upload Proposal</a></li>
                <li><a href="#" class="dropdown-item">Persetujuan/Revisi</a></li>
                <li><a href="#" class="dropdown-item">Catatan Harian</a></li>
                <li><a href="#" class="dropdown-item">Laporan Kemajuan</a></li>
                <li><a href="#" class="dropdown-item">Laporan Akhir</a></li>
                <li><a href="#" class="dropdown-item">Upload Hasil Seminar/Luaran</a></li>
            </ul>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- <div class="user-panel mt-1 pb-1 mb-1 d-flex">
            <div class="image">
                <img src="<?php echo base_url(); ?>assets/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">John Doe</a>
            </div>
        </div> -->
        <li class="nav-item text-success text-strong">
            <a class="nav-link" href="<?php echo base_url('admin/akun') ?>">
                <i class="fa fa-user"></i> <?php echo $this->session->userdata('name'); ?>
            </a>
        </li>
        <li class="nav-item text-danger text-strong">
            <a class="nav-link" href="#">
                <i class="fa fa-sign-out-alt"></i>
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