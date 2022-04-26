<p class="warning">Yakin ingin menghapus data luaran ini?</p>
<form name="form1" action="<?php echo base_url() ?>luaran/delete/<?php echo $luaran['id'] ?>" method="post" class="myform">
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


</form>
