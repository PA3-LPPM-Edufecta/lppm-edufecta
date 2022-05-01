<!-- Main content -->
<section class="content" id="main">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Sub Bidang Ilmu</h3>
            <!-- Card-Tools -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/lppm/masterdata/sub_bidang_ilmu" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
                <a href="<?php echo base_url('masterdata/sub_bidang_ilmu/tambah') ?>" class="btn btn-danger mb-2">Tambah Data</a><br><br>
                <div class="row">
                    <table id="example1" class="display table table-bordered table-striped">
                        <!-- <table class="display table table-bordered"> -->
                        <thead class="bg-danger">
                            <tr>
                                <th style="width: 20px">No</th>
                                <th>ID Bidang Ilmu</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th style="width:40px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($sub_bidang_ilmu as $row) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td?>
                                        </td>
                                        <td><?php echo $row['id_bidang_ilmu'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>masterdata/bidang_ilmu/">
                                                <i class="fa fa-info-circle"></i> <?php echo $row['nama'] ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row['keterangan'] ?></td>
                                        <td>
                                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-danger"></a>
                                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                                <li><a href="<?php echo base_url() ?>masterdata/bidang_ilmu/" class="dropdown-item">Lihat Bidang Ilmu</a></li>
                                                <li><a href="<?php echo base_url() ?>masterdata/sub_bidang_ilmu/edit/<?php echo $row['id'] ?>" class="dropdown-item">Edit</a></li>
                                                <li><a href="<?php echo base_url() ?>masterdata/sub_bidang_ilmu/delete/<?php echo $row['id'] ?>" class="dropdown-item" onclick="confirmation(event)">Hapus</a></li>
                                            </ul>
                                        </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- </section> -->

<!-- Modal Status-->
<?php foreach ($sub_bidang_ilmu as $row) { ?>
    <div class="modal fade" id="modal-status<?php echo $row['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengubah status data ini?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
                    <form action="<?php echo base_url() ?>masterdata/sub_bidang_ilmu/edit_status/<?php echo $row['id'] ?>" method="post">
                        <?php
                        if ($row['status'] == 1) {
                            echo   '<input type="hidden" name="status" value="0">';
                        } else {
                            echo   '<input type="hidden" name="status" value="1">';
                        }
                        ?>
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>