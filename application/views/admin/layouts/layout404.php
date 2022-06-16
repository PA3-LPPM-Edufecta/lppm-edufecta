<?php $apl = $this->db->get("aplikasi")->row(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->session->userdata['title']; ?> | <?php echo  $this->session->userdata['username']; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/uploads/foto/logo/<?php echo $apl->logo; ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-top-nav">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-blue navbar-dark navbar-secondary">
      <div class="container">
        <a href="<?php echo base_url(); ?>assets/index3.html" class="navbar-brand">
          <img src="<?php echo base_url(); ?>assets/uploads/foto/logo/<?php echo $apl->logo; ?>" alt="<?php echo $apl->title; ?>" class="brand-image img-circle elevation-3" style="opacity: 1">
          <span class="brand-text font-weight-light"><?php echo  $apl->title; ?></span>
        </a>

        <div class="collapse navbar-collapse order-3 ml-4" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?php echo base_url('home'); ?>" class="nav-link">Landing Page</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">Dashboard</a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="#">
              <div class="user-panel">
                <img src="<?php echo base_url(); ?>assets/uploads/foto/user/<?php echo $this->session->userdata['image']; ?>" class="img-circle elevation-2" style="width: 30px;" alt="User Image">
                &nbsp; <?php echo $this->session->userdata['full_name']; ?>
              </div>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('login/logout'); ?>" role="button">
              <i class="fas fa-sign-out-alt" title="Sign Out"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h2 class="font-weight-bold"><?php echo ucwords(str_replace('_', ' ', $this->uri->segment(1))); ?></h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active"><?php echo ucwords(str_replace('_', ' ', $this->uri->segment(1))); ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="container-fluid">
        <?php echo $contents; ?>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer navbar-default">
      <strong>Copyright &copy; <?php echo $apl->tahun; ?> <a href="#"><?php echo $apl->nama_owner; ?></a>.</strong> All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> <?php echo $apl->versi; ?>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

</body>
</html>