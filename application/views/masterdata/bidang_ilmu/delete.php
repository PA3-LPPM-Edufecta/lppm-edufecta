<p class="warning">Yakin ingin menghapus data bidang ilmu ini?</p>
<form name="form1" action="<?php echo base_url() ?>bidang_ilmu/delete/<?php echo $bidang_ilmu['id'] ?>" method="post" class="myform">
<input type="hidden" name="id" value="<?php echo $bidang_ilmu['id'] ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <td width="25%">Nama Bidang Ilmu</td>
      <td width="75%"><?php echo $bidang_ilmu['nama'] ?></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><?php echo $bidang_ilmu['status'] ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary btn-lg"  name="submit" id="submit" value="Delete bidang_ilmu">
      
        <a href="<?php echo base_url() ?>bidang_ilmu" class="tambah">Cancel</a></td>
    </tr>
  </table>


</form>