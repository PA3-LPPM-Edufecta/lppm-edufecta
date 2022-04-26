<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>

</script>

<?php echo validation_errors(); ?>
<?php echo form_open_multipart(base_url('index.php/luaran/edit/' . $luaran['id'])) ?>

<section class="content" id="form">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Luaran : Tambah Data</h3>
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
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Luaran</label>
              <div class="col-sm-10">
                <input type="name" id="inputEmail3" class="form-control" name="nama" placeholder="Nama" value="<?php echo $luaran['nama'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
              <div class="col-sm-10">
                <textarea name="keterangan" id="keterangan" cols="50" rows="5" class="form-control" placeholder="Keterangan"><?php echo $luaran['keterangan'] ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10 offset-sm-2 text-right">
                <button type="submit" class="btn btn-danger">Simpan Data</button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $luaran['id'] ?>">
    </form>