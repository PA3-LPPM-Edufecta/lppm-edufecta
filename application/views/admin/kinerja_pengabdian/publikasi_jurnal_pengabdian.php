<?php $this->load->view('admin/layouts/tables'); ?>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.12.1/dataRender/datetime.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script>
	$(function() {
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox({
				alwaysShowClose: true
			});
		});

		$('.btn[data-filter]').on('click', function() {
			$('.btn[data-filter]').removeClass('active');
			$(this).addClass('active');
		});
	})
</script>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light elevation-1"">
						<h3 class=" card-title mt-1"><i class="fa fa-list text-blue"></i> Data Publikasi Jurnal</h3>
						<!-- Card-Tools -->
						<div class="card-tools">
							<button type="button" class="btn btn-tool text-blue" data-card-widget="card-refresh" data-source="/lppm/publikasi_jurnal_pengabdian" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
						<?php
							if ($add_level == 'Y') {
								echo '<button type="button" class="btn btn-primary" onclick="add_publikasi_jurnal()" title="Add Publikasi Jurnal"><i class="fas fa-plus"></i> Tambah Data</button>';
							}
							?>

						</div>
						<table id="tbl_pubjurnal" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-primary">
								<th style="width: 100px;">Nama Dosen</th>
									<th style="width: 60px;">Tipe Pengajuan</th>
									<th style="width: 100px;">Judul</th>
									<th style="width: 100px;">Nama Publikasi</th>
									<th style="width: 50px;">ISSN</th>
									<th style="width: 50px;">Volume</th>
									<th style="width: 50px;">Nomor</th>
									<th style="width: 50px;">Halaman</th>
									<th style="width: 50px;">Penulis Ke</th>
									<th>URL</th>
									<th style="width: 100px;">Tanggal</th>
									<th class="text-center" style="width: 60px;">File</th>
									<th>Status</th>
									<th style="width: 60px;">Aksi</th>
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

<!-- Modal Hapus-->
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Konfirmasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idhapus" id="idhapus">
				<p>Apakah anda yakin ingin menghapus<strong class="text-konfirmasi"> </strong> ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
		table = $("#tbl_pubjurnal").DataTable({
			"dom": "<'row'<'col-sm-12 col-md-8'B><'col-sm-12 col-md-4'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			"buttons": [{
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
				"sEmptyTable": "Data Publikasi Jurnal Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('publikasi_jurnal_pengabdian/ajax_list') ?>",
				"type": "POST"
			},

			"column": {

			},
			//Set column definition initialisation properties.
			"columnDefs": [{
					"targets": [-1], //last column
					"render": function(data, type, row) {

						if (row[17] == 0) {
							return `
							<?php if ($edit_level == 'Y' && $delete_level == 'Y') : ?>
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="view" onclick="vpubjurnal(` + row[18] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_publikasi_jurnal(` + row[18] + `)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="deljurnal(` + row[18] + `)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[18] + `,` + row[17] + `)">Set Status Aktif</a></li>
								</ul>
								<?php elseif ($edit_level == 'Y' && $delete_level == 'N') : ?>
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="view" onclick="vpubjurnal(` + row[18] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_publikasi_jurnal(` + row[18] + `)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[18] + `,` + row[17] + `)">Set Status Aktif</a></li>
								</ul>
								<?php elseif ($edit_level == 'N' && $delete_level == 'Y') : ?>
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="view" onclick="vpubjurnal(` + row[18] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="deljurnal(` + row[18] + `)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[18] + `,` + row[17] + `)">Set Status Aktif</a></li>
								</ul>
								<?php elseif ($edit_level == 'N' && $delete_level == 'N') : ?>
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="view" onclick="vpubjurnal(` + row[18] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[18] + `,` + row[17] + `)">Set Status Aktif</a></li>
								</ul>
							<?php endif; ?>
							`;
						} else {
							return `
							<?php if ($edit_level == 'Y') : ?>
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="view" onclick="vpubjurnal(` + row[18] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_publikasi_jurnal(` + row[18] + `)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[18] + `,` + row[17] + `)">Set Status Tidak Aktif</a></li>
								</ul>
								<?php elseif ($edit_level == 'N') : ?>
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="View" data-role="view" onclick="vpubjurnal(` + row[18] + `)">View</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[18] + `,` + row[17] + `)">Set Status Tidak Aktif</a></li>
								</ul>
							<?php endif; ?>
							`;
						}

					},
					"orderable": false, //set not orderable
				},
				{
					"targets": [0],
					"render": function(data, type, row, meta, date) {
						return row[0] + ' ' + row[1] + ', ' + row[4] + '<br><br>NIDN: ' + row[6];
					}
				},
				{
					targets: [9],
					visible: false,
				},
				{
					targets: [1],
					render: function(data, type, row, meta, date) {
						return row[3];
					}
				},
				{
					targets: [2],
					render: function(data, type, row, meta, date) {
						return row[7];
					}
				},
				{
					targets: [3],
					render: function(data, type, row, meta, date) {
						return row[8];
					}
				},
				{
					targets: [4],
					render: function(data, type, row, meta, date) {
						return row[9];
					}
				},
				{
					targets: [5],
					render: function(data, type, row, meta, date) {
						return row[10];
					}
				},
				{
					targets: [6],
					render: function(data, type, row, meta, date) {
						return row[11];
					}
				},
				{
					targets: [7],
					render: function(data, type, row, meta, date) {
						return row[12];
					}
				},
				{
					targets: [8],
					render: function(data, type, row, meta, date) {
						return row[13];
					}
				},
				{
					targets: [9],
					render: function(data, type, row, meta, date) {
						return row[14];
					}
				},
				{
					targets: [10],
					render: function(data, type, row, meta, date) {
						return moment(new Date(row[15]).toString()).format('DD-MM-YYYY');
					}
				},
				{
					targets: [11],
					render: function(data, type, row, meta, date) {

						if (row[16] != null) {
							return `
								<div class="text-center">
								<button type="button" class="btn btn-xs btn-outline-primary btn-block" onclick="vfile('` + row[16] + `')"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
									<a class="btn btn-xs btn-outline-dark btn-block" href="<?php echo base_url("assets/uploads/foto/cover/"); ?>` + row[16] + `" download><i class="fa fa-download" aria-hidden="true"></i> Download</a>
								</div>
							`;
						} else {
							return `
								<p aria-haspopup="false" aria-expanded="false" class="text-center text-muted">No File</p>
							`;
						}
					}
				},
				{
					"targets": [12],
					"render": function(data, type, row) {
						if (row[17] == 1) {
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

	//view
	function vhki(id) {
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('.modal-title').text('View Publikasi Jurnal');
		$("#modal-default").modal('show');
		$.ajax({
			url: '<?php echo base_url('publikasi_jurnal_pengabdian/viewjurnal'); ?>',
			type: 'post',
			data: 'table=tbl_pubjurnal&id=' + id,
			success: function(respon) {
				$("#md_def").html(respon);
			}
		})
	}

	function vfile(file){
		window.open('<?php echo base_url();?>/assets/uploads/foto/cover/'+file);
	}

	//delete
	function deljurnal(id) {
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
					url: "<?php echo site_url('publikasi_jurnal_pengabdian/delete'); ?>",
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

	//add
	function add_publikasi_jurnal() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Publikasi Jurnal'); // Set Title to Bootstrap modal title
	}

	//ubah status aktif/tidak aktif
	function update_status(id, status) {
		$.ajax({
			url: "<?php echo site_url('publikasi_jurnal_pengabdian/update_status'); ?>",
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

	//edit
	function edit_publikasi_jurnal(id) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('publikasi_jurnal_pengabdian/edit_publikasi_jurnal') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {

				$('[name="id"]').val(data.id);
				$('[name="gelar_depan"]').val(data.gelar_depan);
				$('[name="nama"]').val(data.nama);
				$('[name="id_dosen"]').val(data.id_dosen);
				$('[name="nama_tipe_pengajuan"]').val(data.nama_tipe_pengajuan);
				$('[name="gelar_belakang"]').val(data.gelar_belakang);
				$('[name="id_tipe_pengajuan"]').val(data.id_tipe_pengajuan);
				$('[name="nidn"]').val(data.nidn);
				$('[name="judul"]').val(data.judul);
				$('[name="nama_pubjurnal"]').val(data.nama_pubjurnal);
				$('[name="issn"]').val(data.issn);
				$('[name="volume"]').val(data.volume);
				$('[name="nomor"]').val(data.nomor);
				$('[name="halaman"]').val(data.halaman);
				$('[name="sebagai_penulis_ke"]').val(data.sebagai_penulis_ke);
				$('[name="url"]').val(data.url);
				$('[name="tanggal"]').val(data.tanggal);
				if (data.file == null) {
					var image = "<?php echo base_url('assets/uploads/foto/user/default.png') ?>";
					$("#v_image").attr("src", image);
				} else {
					var image = "<?php echo base_url('assets/uploads/foto/cover/') ?>";
					$("#v_image").attr("src", image + data.file);
				}
				$('[name="status"]').val(data.status);
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Publikasi Jurnal'); // Set title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}


	//save
	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		var url;

		if (save_method == 'add') {
			url = "<?php echo site_url('publikasi_jurnal_pengabdian/insert') ?>";
		} else {
			url = "<?php echo site_url('publikasi_jurnal_pengabdian/update') ?>";
		}

		// ajax adding data to database
		var formdata = new FormData($('#form')[0]);
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
				$('#btnSave').text('Save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 


			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSave').text('Save'); //change button text
				$('#btnSave').attr('disabled', false); //set button enable 

			}
		});
	}
	var loadFile = function(event) {
		var image = document.getElementById('v_image');
		image.src = URL.createObjectURL(event.target.files[0]);
	};

	function batal() {
		$('#form')[0].reset();
		reload_table();
		var image = document.getElementById('v_image');
		image.src = "";
	}
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" value="" name="id" />
					<div class="card-body">
						<div class="form-group row">
							<label for="id_menu" class="col-sm-3 col-form-label">Data Dosen</label>
							<div class="col-sm-9 kosong">
								<select class="form-control" name="id_dosen" id="id_dosen">
									<option value="" selected disabled>Pilih Data Dosen</option>
									<?php
									foreach ($mst_dosen as $dosens) :
										echo "<option value='$dosens->id' $sel>$dosens->gelar_depan $dosens->nama, $dosens->gelar_belakang</option>";
									endforeach; ?>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="judul" class="col-sm-3 col-form-label">Judul</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="nama_pubjurnal" class="col-sm-3 col-form-label">Nama Publikasi</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="nama_pubjurnal" id="nama_pubjurnal" placeholder="Nama Publikasi">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="issn" class="col-sm-3 col-form-label">ISSN</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="issn" id="issn" placeholder="ISSN">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="volume" class="col-sm-3 col-form-label">Volume</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="volume" id="volume" placeholder="Volume">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="nomor" class="col-sm-3 col-form-label">Nomor</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="halaman" class="col-sm-3 col-form-label">Halaman</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="halaman" id="halaman" placeholder="Halaman">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="sebagai_penulis_ke" class="col-sm-3 col-form-label">Penulis Ke</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="sebagai_penulis_ke" id="sebagai_penulis_ke" placeholder="Penulis Ke">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="url" class="col-sm-3 col-form-label">URL</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="url" id="url" placeholder="URL">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
							<div class="col-sm-9 kosong">
								<input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="file" class="col-sm-3 col-form-label">File</label>
							<div class="col-sm-9 kosong">
								<img id="v_image" width="100px" height="100px">
								<input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
							</div>
						</div>
						<!-- <div class="form-group row ">
							<label for="status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9 kosong">
								<select class="form-control" name="status" id="status">
									<option value="" selected disabled>--Pilih Status--</option>
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
								<span class="help-block"></span>
							</div>
						</div> -->
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
				<button type="button" class="btn btn-danger" onclick="batal()" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->