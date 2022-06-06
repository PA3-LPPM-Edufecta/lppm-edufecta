<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>

</script>

<section class="content" id="form">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Buku Ajar : Tambah Data</h3>
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
                        <form method="post" action="<?php echo base_url('dashboard/buku_ajar/tambah') ?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal" id="" cols="30" rows="5" class="form-control" placeholder="Tanggal Terbit" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" name="judul" id="" cols="30" rows="5" class="form-control" placeholder="Judul" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Penerbit</label>
                                <div class="col-sm-10">
                                    <input type="text" name="penerbit" id="" cols="30" rows="5" class="form-control" placeholder="Penerbit" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ISBN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="isbn" id="" cols="30" rows="5" class="form-control" placeholder="ISBN" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Halaman</label>
                                <div class="col-sm-10">
                                    <input type="text" name="halaman" id="" cols="30" rows="5" class="form-control" placeholder="Halaman" required></input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">File Cover</label>
                                <div class="input-group col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" name="file_cover" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">File Editorial Board</label>
                                <div class="input-group col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" name="file_editorial_board" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">File Penerbit</label>
                                <div class="input-group col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" name="file_penerbit" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">File Lainnya</label>
                                <div class="input-group col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" name="file_lainnya" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
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