<!-- <?php echo form_open(base_url('luaran/proses')); ?>
<p class="btn-group">
    <a href="<?php echo base_url('luaran/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah Luaran
    </a>
</p>

<div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="bg-info">
                <th>No.</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($luaran as $row) { ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['keterangan'] ?></td>
                    <td><?php echo $row['status'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url() ?>luaran/edit/<?php echo $row['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo base_url() ?>luaran/delete/<?php echo $row['id'] ?>" class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo form_close(); ?> -->

<!-- Main content -->
<section class="content" id="main">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> &nbsp;Luaran</h3>
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
                <a href="<?php echo base_url('luaran/tambah') ?>" class="btn btn-danger mb-2">Tambah Data</a>
                <div class="row">
                    <div class="table-responsive mailbox-messages col-md-12">
                        <table class="display table table-bordered">
                            <thead class="bg-danger">
                                <tr>
                                    <th style="width: 20px">No</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th style="width:40px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($luaran as $row) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama'] ?></td>
                                        <td><?php echo $row['keterangan'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 1) {
                                                echo 'Aktif';
                                            } else {
                                                echo 'Tidak Aktif';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-danger"></a>
                                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                                <li><a href="<?php echo base_url() ?>luaran/edit/<?php echo $row['id'] ?>" class="dropdown-item">Edit</a></li>
                                                <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-hapus<?php echo $row['id'] ?>">Hapus</a></li>
                                                <?php
                                                if ($row['status'] == 1) {  ?>
                                                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-status<?php echo $row['id'] ?>">Set Status Tidak Aktif</a></li>
                                                <?php } else { ?>
                                                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-status<?php echo $row['id'] ?>">Set Status Aktif</a></li>
                                                <?php } ?>
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
    </div>
</section>
    <!-- </section> -->

    <!-- Modal Delete-->

    <?php foreach ($luaran as $row) { ?>
        <div class="modal fade" id="modal-hapus<?php echo $row['id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
                        <form method="post" action="<?php echo base_url() ?>luaran/delete/<?php echo $row['id'] ?>">
                            <button type="submit" class="btn btn-danger" onclick="confirmation(event)">Ya</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php } ?>
    <!-- /.modal -->

    <!-- Modal Status-->
    <?php foreach ($luaran as $row) { ?>
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
                        <form action="<?php echo base_url() ?>luaran/edit_status/<?php echo $row['id'] ?>" method="post">
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