<script src="<?php echo base_url(); ?>assets/plugin/ckeditor/ckeditor.js"></script>

</script>


<?php echo validation_errors(); ?>


<!-- <form method="post" action="<?php echo base_url('luaran/fungsitambah') ?>">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
    <tr valign="baseline">
        <td width="22%" align="right" nowrap>Nama</td>
        <td width="78%">
            <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama') ?>" placeholder="Nama Luaran" size="50">
        </td>
    </tr>
    <tr valign="baseline">
        <td nowrap align="right" valign="top">Keterangan</td>
        <td><textarea name="keterangan" id="keterangan" cols="50" rows="5" class="ckeditor form-control" placeholder="Keterangan"><?php echo set_value('isi') ?></textarea></td>
    </tr>
    <tr valign="baseline">
        <td align="right" nowrap>Status</td>
        <td>
            <select class="form-control" name="status" id="status">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </td>
    </tr>
    <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td>
            <input name="Submit" type="submit" class="btn btn-primary btn-lg" value="Simpan Data Luaran">
            <input name="Submit2" type="reset" class="btn btn-primary btn-lg" value="Reset">
        </td>
    </tr>
</table>
<input type="hidden" name="MM_insert" value="form1">
</form> -->

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
                        <form method="post" action="<?php echo base_url('luaran/tambah') ?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="name" name="nama" class="form-control" id="inputEmail3" placeholder="Nama" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan" id="" cols="30" rows="5" class="form-control" placeholder="Keterangan" required></textarea>
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