<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>

</script>

<section class="content" id="form">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Data Dosen : Tambah Data</h3>
            <!-- Card-Tools -->
            <div class="card-tools">
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
                        <form method="post" action="<?php echo base_url('masterdata/data_dosen/tambah') ?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="name" name="nama" class="form-control" id="inputEmail3" placeholder="Nama" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nip" id="" cols="30" rows="5" class="form-control" placeholder="NIP" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">NIDN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nidn" id="" cols="30" rows="5" class="form-control" placeholder="NIDN" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor KTP</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_ktp" id="" cols="30" rows="5" class="form-control" placeholder="Nomor KTP" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_telp" id="" cols="30" rows="5" class="form-control" placeholder="Nomor Telepon" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="" name="program_studi" id="" cols="30" rows="5" class="form-control" placeholder="Program Studi" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Golongan</label>
                                <div class="col-sm-10">
                                    <textarea name="golongan" id="" cols="30" rows="5" class="form-control" placeholder="Golongan" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    <a href="javascript:history.back()" type="button" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                            <text class="text-danger"><?php echo validation_errors(); ?></text>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>