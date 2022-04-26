<p class="warning">Yakin ingin menghapus data skim penelitian ini?</p>
<form name="form1" action="<?php echo base_url() ?>skim_penelitian/delete/<?php echo $skim_penelitian['id'] ?>" method="post" class="myform">
<input type="hidden" name="id" value="<?php echo $skim_penelitian['id'] ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <td width="25%">Nama skim_penelitian</td>
      <td width="75%"><?php echo $skim_penelitian['nama'] ?></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><?php echo $skim_penelitian['status'] ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary btn-lg"  name="submit" id="submit" value="Delete skim_penelitian">
      
        <a href="<?php echo base_url() ?>skim_penelitian" class="tambah">Cancel</a></td>
    </tr>
  </table>


</form>
