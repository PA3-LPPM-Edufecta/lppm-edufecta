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
        <a href="<?php echo base_url() ?>masterdata/data_dosen/delete/<?php echo $data_dosen['id'] ?>" class="btn btn-danger">
          Hapus Data</a>
      </div>
    </div>
  </div>
</div>