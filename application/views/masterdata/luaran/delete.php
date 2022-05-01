<!-- <p class="warning">Yakin ingin menghapus data luaran ini?</p>
<form name="form1" action="<?php echo base_url() ?>masterdata/luaran/delete/<?php echo $luaran['id'] ?>" method="post" class="myform">
<input type="hidden" name="id" value="<?php echo $luaran['id'] ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <td width="25%">Nama Luaran</td>
      <td width="75%"><?php echo $luaran['nama'] ?></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><?php echo $luaran['status'] ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary btn-lg"  name="submit" id="submit" value="Delete Luaran">
      
        <a href="<?php echo base_url() ?>luaran" class="tambah">Cancel</a></td>
    </tr>
  </table>


</form> -->

<div class="modal fade" id="myModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Hapus data?</h4>
      </div>
      <div class="modal-body">
        <p class="alert alert-danger">Yakin ingin menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url() ?>masterdata/luaran/delete/<?php echo $luaran['id'] ?>" class="btn btn-danger">
          Hapus Data</a>
      </div>
    </div>
  </div>
</div>