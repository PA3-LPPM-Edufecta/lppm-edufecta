<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bars"></i></span>
          <div class="info-box-content">
            <span class="info-box-text font-weight-bold">Menu</span>
            <span class="info-box-number">
              <strong class="h4 font-weight-bold"><?php echo $this->db->count_all_results('tbl_menu'); ?></strong>
            </span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-stream"></i></span>
          <div class="info-box-content">
            <span class="info-box-text font-weight-bold">Sub Menu</span>
            <span class="info-box-number">
              <strong class="h4 font-weight-bold"><?php echo $this->db->count_all_results('tbl_submenu'); ?></strong>
            </span>
          </div>
        </div>
      </div>

      <div class="clearfix hidden-md-up"></div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-lock"></i></span>
          <div class="info-box-content">
            <span class="info-box-text font-weight-bold">User Level</span>
            <span class="info-box-number">
              <strong class="h4 font-weight-bold"><?php echo $this->db->count_all_results('tbl_userlevel'); ?></strong>
            </span>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text font-weight-bold">Users</span>
            <span class="info-box-number">
              <strong class="h4 font-weight-bold"><?php echo $this->db->count_all_results('tbl_user'); ?></strong>
            </span>
          </div>
        </div>
      </div>
    </div><br>

    <div class="card card-blue">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list"></i> &nbsp;Dashboard</h3>
        <!-- Card-Tools -->
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/lppm/dashboard" data-source-selector="#card-refresh-content" data-load-on-init="false">
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

          <!-- Dashboard Card Content -->
          <div class="row">
            <div class="col-sm-9">
              <h3>Dashboard Penelitian</h3>
            </div>
            <div class="col-sm-3">
              <button type="button" class="btn btn-block btn-danger btn-right"><i class="fas fa-download"></i> Download Template Proposal</button>
            </div>
          </div><br>

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
  </div>
</section>