<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title mt-1"><i class="<?php echo $this->db->get('tbl_submenu')->row(6)->icon; ?> text-blue"></i> Data Bidang Ilmu</h3>
						<!-- Card-Tools -->
						<div class="card-tools">
							<button type="button" class="btn btn-tool text-blue" data-card-widget="card-refresh" data-source="/lppm/bidang_ilmu" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
						<div class="text-left mb-4">
							<button type="button" class="btn btn-sm btn-outline-primary" onclick="add_bidang_ilmu()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
						</div>
						<table id="tbl_bidang_ilmu" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-blue">
									<th width="50">No</th>
									<th>Nama Bidang Ilmu</th>
									<th>Keterangan</th>
									<th width="120">Status</th>
									<th width="50">Aksi</th>
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


<script type="text/javascript">
	var save_method; //for save method string
	var table;

	$(document).ready(function() {

		//datatables
		table = $("#tbl_bidang_ilmu").DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Bidang Ilmu Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('bidang_ilmu/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
					"targets": [-1], //last column
					"render": function(data, type, row) {

						// return "<a id=\"dropdownSubMenu1\" href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"nav-link dropdown-toggle btn btn-primary\"></a><ul aria-labelledby=\"dropdownSubMenu1\" class=\"dropdown-menu border-0 shadow\" style=\"left: 0px; right: inherit;\"><center><li><a href=\"javascript:void(0)\" class=\"dropdown-item\" title=\"Edit\" data-role=\"edit\" onclick=\"edit_bidang_ilmu(" + row[4] + ")\">Edit</a></li><li><a href=\"javascript:void(0)\" class=\"dropdown-item\" title=\"Delete\" nama=" + row[0] + "  onclick=\"delbidangilmu(" + row[4] + ")\">Hapus</a></li></center></ul>";
						if(row[3]==0){
							return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item" title="Lihat" data-role="edit" onclick="lihat_sub_bidang_ilmu(`+row[4]+`)">Lihat Sub Bidang Ilmu</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item" title="Edit" data-role="edit" onclick="edit_bidang_ilmu(`+row[4]+`)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item" title="Delete" nama=" + row[0] + "  onclick="delbidangilmu(`+row[4]+`)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item" title="Status" onclick="update_status(`+row[4]+`,` +row[3]+`)">Set Status Aktif</a></li>
								</ul>
							`;
						} else {
							return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item" title="Lihat" data-role="edit" onclick="lihat_sub_bidang_ilmu(`+row[4]+`)">Lihat Sub Bidang Ilmu</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item" title="Edit" data-role="edit" onclick="edit_bidang_ilmu(`+row[4]+`)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item" title="Delete" nama=" + row[0] + "  onclick="delbidangilmu(`+row[4]+`)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item" title="Status" onclick="update_status(`+row[4]+`,` +row[3]+`)">Set Status Tidak Aktif</a></li>
								</ul>
							`;
						}
						// return "<a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" data-role=\"edit\" onclick=\"edit_bidang_ilmu(" + row[4] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" nama=" + row[3] + "  onclick=\"delbidangilmu(" + row[4] + ")\"><i class=\"fas fa-trash\"></i></a>";

					},

					"orderable": false, //set not orderable
				},{
					"targets": [3],
                    "render": function(data, type, row) {
                        if(data == 1){
							return 'Aktif';
						} else {
							return 'Tidak Aktif';
						}
                    },
                    "orderable": false,
                }

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

	//lihat sub bidang ilmu
	function lihat_sub_bidang_ilmu(id){
		url = "<?php echo site_url('sub_bidang_ilmu') ?>?id=" + id;
		window.location = url;
	}

	//delete
	function delbidangilmu(id) {
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
					url: "<?php echo site_url('bidang_ilmu/delete'); ?>",
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
			}
		})
	}



	function add_bidang_ilmu() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Add Bidang Ilmu'); // Set Title to Bootstrap modal title
	}

	function edit_bidang_ilmu(id) {
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('bidang_ilmu/edit_bidang_ilmu') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				
                $('[name="id"]').val(data.id);
				$('[name="nama"]').val(data.nama);
				$('[name="keterangan"]').val(data.keterangan);
				// $('[name="status"]').val(data.status);
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Bidang Ilmu'); // Set title to Bootstrap modal title

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function update_status(id, status){
		$.ajax({
			url: "<?php echo site_url('bidang_ilmu/update_status'); ?>",
			type: "POST",
			data: {id: id, status: status},
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

	function save() {
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable 
		if (save_method == 'add') {
			url = "<?php echo site_url('bidang_ilmu/insert') ?>";
		} else {
			url = "<?php echo site_url('bidang_ilmu/update') ?>";
		}

		// ajax adding data to database
		$.ajax({
			url: url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
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
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header">
				<h3 class="modal-title">Bidang Ilmu</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
					<div class="card-body">
						<div class="form-group row ">
							<label for="nama" class="col-sm-3 col-form-label">Nama Bidang Ilmu</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Bidang Ilmu">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row ">
							<label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
							<div class="col-sm-9 kosong">
								<textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
						<!-- <div class="form-group row ">
							<label for="status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9 kosong">
                                <select class="form-control" name="status" id="status">
                                    <option value="" selected disabled>--Pilih--</option>
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
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->