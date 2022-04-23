<!-- Main content -->
<section class="content" id="main">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Luaran</h3>
            <!-- Card-Tools -->
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
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger mb-2">Tambah Data</button>
                        <table class="table table-bordered">
                        <thead class="bg-danger">
                            <tr>
                                <th style="width: 20px">No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Max. Pengajuan</th>
                                <th>Tipe Pengajuan</th>
                                <th>Syarat</th>
                                <th>Lama Penyelesaian</th>
                                <th style="">Status</th>
                                <th style="width:40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-danger"></a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                        <li><a href="#" class="dropdown-item" onclick="myFunction()">Edit</a></li>
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-hapus">Hapus</a></li>
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-status">Set Status Tidak Aktif</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- </section> --> 

<section class="content" id="form">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Skim Penelitian : Tambah Data</h3>
            <!-- Card-Tools -->
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
                <div class="row">
                    <div class="col-md-12">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                <textarea name="" id="" cols="30" rows="2" class="form-control" placeholder="Keterangan"></textarea>                             
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Maksimal Pengajuan</label>
                                <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Unlimited</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Limited</label>
                                </div>                         
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Maksimal Pengajuan</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Jumlah Maksimal Pengajuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Syarat</label>
                                <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Tidak</label>
                                </div>                         
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Syarat</label>
                                <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputEmail3" placeholder="Jumlah Syarat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Input Syarat</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Input Syarat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Lama Penyelesaian</label>
                                <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">1 Tahun</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Lebih dari 1 Tahun</label>
                                </div>                         
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Wajib Laporan Kemajuan</label>
                                <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Ya</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Tidak</label>
                                </div>                         
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custom-select" class="col-sm-2 col-form-label">Tidak Untuk Jabatan?</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option selected="">Select Some Option</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custom-select" class="col-sm-2 col-form-label">Luaran Wajib</label>
                                <div class="col-sm-10">
                                    <select class="custom-select">
                                        <option selected="">Select Some Option</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Maksimal Dana</label>
                                <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputEmail3" placeholder="Maksimal Dana">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                <button type="submit" class="btn btn-danger">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Modal Delete-->
<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-danger">Ya</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Status-->
<div class="modal fade" id="modal-status">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Status Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin mengubah status data ini?</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-danger">Ya</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    function myFunction() {
        var x = document.getElementById("form");
        var y = document.getElementById("main");

        y.style.display = "none";
        x.style.display = "block";
    }
</script>