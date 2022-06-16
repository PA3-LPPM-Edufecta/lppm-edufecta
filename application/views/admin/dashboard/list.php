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

      <div class="container-fluid"><br><br>
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
            <h3>Selamat Datang di Sistem Informasi Manajemen P3M</h3><br>
            <ul class="nav nav-pills text-center">
              <li class="nav-item col-6"><a class="nav-link elevation-1 active" href="#penelitian" data-toggle="tab">Penelitian</a></li>
              <li class="nav-item col-6"><a class="nav-link elevation-1" href="#pengabdian" data-toggle="tab">Pengabdian</a></li>
            </ul><br>
            <hr style="border-top: 1px solid #bdbbbb;"><br>

            <!-- Start of tab-content -->
            <div class="tab-content">
              <!-- Tab Penelitian -->
              <div class="tab-pane active" id="penelitian">
                <div class="row">
                  <div class="col-sm-9">
                    <h3>Dashboard Penelitian</h3>
                  </div>
                  <div class="col-sm-3">
                    <a href="<?php echo base_url('download'); ?>" type="button" class="btn btn-block btn-danger btn-right"><i class="fas fa-download"></i>
                      Download Template Proposal</a>
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
              <!-- End of Tab Pengabdian -->

              <!-- Tab Pengabdian -->
              <div class="tab-pane" id="pengabdian">
                <div class="row">
                  <div class="col-sm-9">
                    <h3>Dashboard Pengabdian</h3>
                  </div>
                  <div class="col-sm-3">
                    <a href="<?php echo base_url('download'); ?>" type="button" class="btn btn-block btn-danger btn-right"><i class="fas fa-download"></i>
                      Download Template Proposal</a>
                  </div>
                </div><br>

                <div class="row">

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-indigo">
                      <div class="inner">
                        <p>Usulan Diterima</sup></h3>
                        <h3>50<sup style="font-size: 20px"></h3>
                      </div>
                      <a href="#" class="small-box-footer">Selengkapnya</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of Tab Pengabdian -->
            </div> <!-- End of tab-content -->
          </div> <!-- End of card-body -->
        </div> <!-- End of card card-blue -->
      </div> <!-- End of section -->
    </div>
  </div>
</section>