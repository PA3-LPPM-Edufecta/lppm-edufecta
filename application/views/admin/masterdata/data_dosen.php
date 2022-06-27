<?php $this->load->view('admin/layouts/tables');?>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.12.1/dataRender/datetime.js"></script>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light elevation-1">
                        <h3 class="card-title mt-1"><i class="fa fa-list text-blue"></i> Data Dosen</h3>
                        <!-- Card-Tools -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-blue" data-card-widget="card-refresh" data-source="/lppm/data_dosen" data-source-selector="#card-refresh-content" data-load-on-init="false">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-blue" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-blue" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-blue" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="text-left mb-5">
                            <button type="button" class="btn btn-primary" onclick="add_data_dosen()" title="Add Data"><i class="fas fa-plus"></i> Tambah Data</button>
                        </div>
                        <table id="mst_dosen" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-blue">
                                    <th>NIP</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen</th>
                                    <th>G. Depan</th>
                                    <th>G. Belakang</th>
                                    <th>No. KTP</th>
                                    <th>No. Telp</th>
                                    <th>Email</th>
                                    <th>Tempat Lahir</th>
                                    <th>Temp, Tgl. Lahir</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">View</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="md_def">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        $.fn.dataTable.moment('DD-MM-YYYY');

        //datatables
        table = $("#mst_dosen").DataTable({
            "dom": "<'row'<'col-sm-12 col-md-8'B><'col-sm-12 col-md-4'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			"buttons": [
				{
					"extend": "pageLength",
					"className": 'btn rounded btn-light buttons-excel buttons-html5 btn-outline-dark mr-2',
				},
				{
					"extend": 'excel',
					"text": '<i class="far fa-file-excel"></i> Excel',
					"className": 'btn rounded btn-light buttons-excel buttons-html5 btn-outline-success mr-2',
					"exportOptions": {
						"columns": ':visible'
					}
				},
				{
					"extend": 'pdf',
					"text": '<i class="far fa-file-pdf"></i> PDF',
					"className": 'btn rounded btn-light buttons-pdf buttons-html5 btn-outline-danger mr-2',
					"exportOptions": {
						"columns": ':visible'
					}
				},
				{
					"extend": 'print',
					"text": '<i class="fa fa-table"></i><span> Preview Tables</span>',
					"className": 'btn rounded btn-light buttons-tables buttons-html5 btn-outline-info mr-2',
					"autoPrint": false,
					"exportOptions": {
						"columns": ':visible'
					}
				},
				{
					"extend": 'colvis',
					"className": 'btn rounded btn-light buttons-tables buttons-html5 btn-outline-primary mr-2',
				}
			],
			"lengthMenu": [
				[5, 10, 25, 50, 100, -1],
				[5, 10, 25, 50, 100, "All"]
			],
			"iDisplayLength": 10,
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Dosen Belum Ada"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('data_dosen/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [-1], //last column
                    "render": function(data, type, row) {

                        if (row[12] == 0) {
                            return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                <li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="View" onclick="vdosen(` + row[13] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_data_dosen(` + row[13] + `)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="deldosen(` + row[13] + `)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[13] + `,` + row[12] + `)">Set Status Aktif</a></li>
								</ul>
							`;
                        } else {
                            return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                                <li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="View" onclick="vdosen(` + row[13] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_data_dosen(` + row[13] + `)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[13] + `,` + row[12] + `)">Set Status Tidak Aktif</a></li>
								</ul>
							`;
                        }
                    },

                    "orderable": false, //set not orderable
                },
                {
                    "targets": [0, 1, 3, 4],
                    "visible": false,
                },
                {
                    "targets": [2],
                    "render": function(data, type, row) {
                        return row[3] + ' ' + row[2] + ', ' + row[4] + '<br><br>NIDN: ' + row[1];
                    }
                },
                {
                    "targets": [8],
                    "visible": false,
                },
                {
                    "targets": [9],
                    "render": function(data, type, row) {
                        return row[8] + ', ' + moment(new Date(data).toString()).format('DD-MM-YYYY');
                    }
                },
                {
                    "targets": [11],
                    "render": function(data, type, row) {
                        if (row[11] != null) {
                            return "<img class=\"img img-responsive img-thumbnail\"  src='<?php echo base_url("assets/uploads/foto/dosen/"); ?>" + row[11] + "' width=\"100px\" height=\"100px\">";
                        } else {
                            return "<img class=\"myImgx\"  src='<?php echo base_url("assets/uploads/foto/user/default.png"); ?>' width=\"100px\" height=\"100px\">";
                        }
                    },
                    "orderable": false,
                },
                {
                    "targets": [12],
                    "render": function(data, type, row) {
                        if (row[12] == 1) {
                            return 'Aktif';
                        } else {
                            return 'Tidak Aktif';
                        }
                    },
                    "orderable": false,
                },
            ],
        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });

    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function deldosen(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo site_url('data_dosen/delete_data_dosen'); ?>",
                    type: "POST",
                    data: "id=" + id,
                    cache: false,
                    dataType: 'json',
                    success: function(respone) {
                        if (respone.status == true) {
                            reload_table();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Delete Error!!.'
                            });
                        }
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }

    //view
    function vdosen(id) {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('.modal-title').text('View Dosen');
        $("#modal-default").modal('show');
        $.ajax({
            url: '<?php echo base_url('data_dosen/viewdosen'); ?>',
            type: 'post',
            data: 'table=mst_dosen&id=' + id,
            success: function(respon) {
                $("#md_def").html(respon);
            }
        })
    }

    function add_data_dosen() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal({
            backdrop: 'static',
            keyboard: false
        }); // show bootstrap modal
        $('.modal-title').text('Add Dosen'); // Set Title to Bootstrap modal title
    }

    function update_status(id, status) {
        $.ajax({
            url: "<?php echo site_url('data_dosen/update_status'); ?>",
            type: "POST",
            data: {
                id: id,
                status: status
            },
            dataType: "JSON",
            success: function(data) {
                reload_table();
                Toast.fire({
                    icon: 'success',
                    title: 'Success!!.'
                });
            }
        });
    }

    function edit_data_dosen(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('data_dosen/edit_data_dosen') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="nip"]').val(data.nip);
                $('[name="nidn"]').val(data.nidn);
                $('[name="nama"]').val(data.nama);
                $('[name="gelar_depan"]').val(data.gelar_depan);
                $('[name="gelar_belakang"]').val(data.gelar_belakang);
                $('[name="noktp"]').val(data.noktp);
                $('[name="notelp"]').val(data.notelp);
                $('[name="email"]').val(data.email);
                $('[name="temp_lahir"]').val(data.temp_lahir);
                $('[name="tgl_lahir"]').val(data.tgl_lahir);
                $('[name="alamat"]').val(data.alamat);
                if (data.foto == null) {
                    var image = "<?php echo base_url('assets/uploads/foto/user/default.png') ?>";
                    $("#v_image").attr("src", image);
                } else {
                    var image = "<?php echo base_url('assets/uploads/foto/dosen/') ?>";
                    $("#v_image").attr("src", image + data.foto);
                }
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Dosen'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        if (save_method == 'add') {
            var url = "<?php echo site_url('data_dosen/insert') ?>";
        } else {
            var url = "<?php echo site_url('data_dosen/update') ?>";
        }
        var formdata = new FormData($('#form')[0]);
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Toast.fire({
                        icon: 'success',
                        title: 'Success!!.'
                    });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
    var loadFile = function(event) {
        var image = document.getElementById('v_image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id" />
                    <div class="card-body">
                        <div class="form-group row ">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nidn" id="nidn" placeholder="NIDN">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="gelar_depan" class="col-sm-3 col-form-label">Gelar Depan</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="gelar_depan" id="gelar_depan" placeholder="Gelar Depan">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="gelar_belakang" class="col-sm-3 col-form-label">Gelar Belakang</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="gelar_belakang" id="gelar_belakang" placeholder="Gelar Belakang">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="noktp" class="col-sm-3 col-form-label">No. KTP</label>
                            <div class="col-sm-9 kosong">
                                <input type="number" class="form-control" name="noktp" id="noktp" placeholder="No. KTP">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="notelp" class="col-sm-3 col-form-label">No. Telepon</label>
                            <div class="col-sm-9 kosong">
                                <input type="number" class="form-control" name="notelp" id="notelp" placeholder="No. Telepon">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9 kosong">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="temp_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="temp_lahir" id="temp_lahir" placeholder="Tempat Lahir">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9 kosong">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9 kosong">
                                <img id="v_image" width="100px" height="100px">
                                <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->