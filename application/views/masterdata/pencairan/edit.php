<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>

</script>

<?php echo validation_errors(); ?>


<section class="content" id="form">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;pencairan : Tambah Data</h3>
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
            <form method="post" action="<?php echo base_url('masterdata/pencairan/edit/' . $pencairan['id']) ?>">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pencairan</label>
                <div class="col-sm-10">
                  <input type="name" id="inputEmail3" class="form-control" name="nama" placeholder="Nama" value="<?php echo $pencairan['nama'] ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10 offset-sm-2 text-right">
                  <button type="submit" class="btn btn-primary">Simpan Data</button>
                  <a href="javascript:history.back()" type="button" class="btn btn-danger">Cancel</a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $pencairan['id'] ?>">
    </form>