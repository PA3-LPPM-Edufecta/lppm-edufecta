<p class="warning">Yakin ingin menghapus data pencairan ini?</p>
<form name="form1" action="<?php echo base_url() ?>pencairan/delete/<?php echo $pencairan['id'] ?>" method="post" class="myform">
<input type="hidden" name="id" value="<?php echo $pencairan['id'] ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <td width="25%">Nama pencairan</td>
      <td width="75%"><?php echo $pencairan['nama'] ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary btn-lg"  name="submit" id="submit" value="Delete Pencairan">
      
        <a href="<?php echo base_url() ?>pencairan" class="tambah">Cancel</a></td>
    </tr>
  </table>
</form>
