<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
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

        <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">

            <div class="media">
              <img src="<?php echo base_url(); ?>assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> 

          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="<?php echo base_url(); ?>assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="<?php echo base_url(); ?>assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-blue elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(); ?>assets/index3.html" class="brand-link">
        <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">EDU</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header mt-3 font-weight-light">
              <h5>SETTINGS</h5>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/calendar.html" class="nav-link">
                <p>
                  Group
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/gallery.html" class="nav-link">
                <p>
                  User
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Menu Manager
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Company
                </p>
              </a>
            </li>

            <li class="nav-header mt-3 font-weight-light">
              <h5><b>MASTER DATA</b></h5>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/calendar.html" class="nav-link">
                <p>
                  Data Dosen
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/gallery.html" class="nav-link">
                <p>
                  Skim Penelitian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Skim Pengabdian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Luaran
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Bidang Ilmu
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Waktu Pengajuan Proposal
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Jenis Pencairan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Upload Template Proposal
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Data Reviewer
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Komponen Penilaian Proposal
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Kategori Template Proposal
                </p>
              </a>
            </li>

            <li class="nav-header mt-3 font-weight-light">
              <h4>PENELITIAN</h4>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/calendar.html" class="nav-link">
                <p>
                  Pengajuan Baru Penelitian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/gallery.html" class="nav-link">
                <p>
                  Data Penelitian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Reviewer
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Cetak Lembar Pengesahan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Upload Proposal
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Persetujuan/Revisi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Catatan Harian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Laporan Kemajuan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Laporan Akhir
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>assets/pages/kanban.html" class="nav-link">
                <p>
                  Upload Hasil Seminar/Luaran
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <br>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                <i class="fas fa-sync-alt"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
            <div class="container-fluid">
              <h3>Selamat Datang di Sistem Informasi Manajemen P3M</h3><br>
              <div class="row">
                <div class="col-6">
                  <button type="button" class="btn btn-primary btn-block">Penelitian</button>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-outline-primary btn-block">Pengabdian</button>
                </div>
              </div>
              <hr><br>

              <div class="row">
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-primary">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-secondary">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>

                <div class="col-lg-3 col-6">
                  <div class="small-box bg-indigo">
                    <div class="inner">
                      <p>Usulan Diterima</sup></h3>
                      <h3>100<sup style="font-size: 20px"></h3>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>

    <footer class="main-footer">
      <strong>Copyright &copy; 2021 <b>John Doe</b>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url(); ?>assets/dist/js/<?php echo base_url(); ?>assets/pages/dashboard.js"></script>
</body>

</html>