<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css" integrity="sha512-g2SduJKxa4Lbn3GW+Q7rNz+pKP9AWMR++Ta8fgwsZRCUsawjPvF/BxSMkGS61VsR9yinGoEgrHPGPn2mrj8+4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style type="text/css">
	.btn-group {
    z-index: 1051;
}
</style>
<?php $this->load->view('admin/layouts/tables');?>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light elevation-1"">
						<h3 class="card-title mt-1"><i class="fa fa-list text-blue"></i> Data Skim Pengabdian</h3>
						<!-- Card-Tools -->
						<div class="card-tools">
							<button type="button" class="btn btn-tool text-blue" data-card-widget="card-refresh" data-source="/lppm/skim_pengabdian" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
							<button type="button" class="btn btn-primary" onclick="add_skim_pengabdian()" title="Add Data"><i class="fas fa-plus"></i> Tambah Data</button>
						</div>
						<table id="tbl_skim_pengabdian" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-blue">
									<th width="50">No</th>
									<th>Nama</th>
									<th>Keterangan</th>
									<th>Max Pengajuan</th>
									<th>Syarat</th>
									<th>Lama Penyelesaian</th>
									<th>Tipe Pengajuan</th>
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
		table = $("#tbl_skim_pengabdian").DataTable({
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
			drawCallback: function() {
					$('.dt-select2').select2();
				},
			"autoWidth": false,
			"language": {
				"sEmptyTable": "Data Skim Pengabdian Belum Ada"
			},
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('skim_pengabdian/ajax_list') ?>",
				"type": "POST"
			},
			//Set column definition initialisation properties.
			"columnDefs": [{
					"targets": [-1], //last column
					"render": function(data, type, row) {

						// return "<a id=\"dropdownSubMenu1\" href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" class=\"nav-link dropdown-toggle btn btn-primary\"></a><ul aria-labelledby=\"dropdownSubMenu1\" class=\"dropdown-menu border-0 shadow\" style=\"left: 0px; right: inherit;\"><center><li><a href=\"javascript:void(0)\" class=\"dropdown-item\" title=\"Edit\" data-role=\"edit\" onclick=\"edit_bidang_ilmu(" + row[4] + ")\">Edit</a></li><li><a href=\"javascript:void(0)\" class=\"dropdown-item\" title=\"Delete\" nama=" + row[0] + "  onclick=\"delbidangilmu(" + row[4] + ")\">Hapus</a></li></center></ul>";
						if(row[7]==0){
							return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_skim_pengabdian(`+row[8]+`)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="delskimpengabdian(`+row[8]+`)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(`+row[8]+`,` +row[7]+`)">Set Status Aktif</a></li>
								</ul>
							`;
						} else {
							return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_skim_pengabdian(`+row[8]+`)">Edit</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="delskimpengabdian(`+row[8]+`)">Hapus</a></li>
								<li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(`+row[8]+`,` +row[7]+`)">Set Status Tidak Aktif</a></li>
								</ul>
							`;
						}
						// return "<a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" data-role=\"edit\" onclick=\"edit_bidang_ilmu(" + row[4] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" nama=" + row[3] + "  onclick=\"delbidangilmu(" + row[4] + ")\"><i class=\"fas fa-trash\"></i></a>";

					},

					"orderable": false, //set not orderable
				},{
					"targets": [7],
                    "render": function(data, type, row) {
                        if(data == 1){
							return 'Aktif';
						} else {
							return 'Tidak Aktif';
						}
                    },
                    "orderable": false,
                },{
					"targets": [3],
                    "render": function(data, type, row) {
                        if(data == 1){
							return 'Limited';
						} else {
							return 'Unlimited';
						}
                    },
                    "orderable": true,
                },{
					"targets": [4],
                    "render": function(data, type, row) {
                        if(data == 1){
							return 'Ya';
						} else {
							return 'Tidak';
						}
                    },
                    "orderable": true,
                },{
					"targets": [5],
                    "render": function(data, type, row) {
                        if(data == 1){
							return '1 Tahun';
						} else {
							return 'Lebih dari 1 Tahun';
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
	// function lihat_sub_bidang_ilmu(id){
	// 	url = "<?php echo site_url('sub_bidang_ilmu') ?>?id=" + id;
	// 	window.location = url;
	// }

	//delete
	function delskimpengabdian(id) {
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
					url: "<?php echo site_url('skim_pengabdian/delete'); ?>",
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



	function add_skim_pengabdian() {
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal({
			backdrop: 'static',
			keyboard: false
		}); // show bootstrap modal
		$('.modal-title').text('Add Skim pengabdian'); // Set Title to Bootstrap modal title
	}

	function edit_skim_pengabdian(id) {
		save_method = 'update';
		$('#form_update')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('skim_pengabdian/edit_skim_pengabdian') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				if(data.id_luaran!=null){
					id_luaran = data.id_luaran.split(",");
				}
				if(data.list_syarat!=null){
					list_syarat = data.list_syarat.split(",");
				}
				let jumlah_syarat = list_syarat.length;
                $('[name="id"]').val(data.id);
				$('[name="nama"]').val(data.nama);
				$('[name="keterangan"]').val(data.keterangan);
				$('[name="maksimal_pengajuan"][value='+data.maksimal_pengajuan+']').prop( 'checked', true );
				$('input[name="maksimal_pengajuan"]').on('change', function() {
					$('.jumlah_maksimal_pengajuan').toggle(+this.value === 1 && this.checked);
				}).change();
				$('[name="jumlah_maksimal_pengajuan"]').val(data.jumlah_maksimal_pengajuan);
				$('[name="syarat"][value='+data.syarat+']').prop( 'checked', true );
				$('input[name="syarat"]').on('change', function() {
					$('.list_syarat').toggle(+this.value === 1 && this.checked);
				}).change();
				$('[name="list_syarat"]').val(data.list_syarat);
				$('[name="lama_penyelesaian"][value='+data.lama_penyelesaian+']').prop( 'checked', true );
				$('[name="wajib_laporan_kemajuan"][value='+data.wajib_laporan_kemajuan+']').prop( 'checked', true );
				$('[name="id_luaran[]"').val(id_luaran);
				$('.js-example-basic-multiple').selectpicker('val', id_luaran);
				$('[name="maksimal_dana"]').val(data.maksimal_dana);
				$('#modal_form_update').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Skim Pengabdian'); // Set title to Bootstrap modal title

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function update_status(id, status){
		$.ajax({
			url: "<?php echo site_url('skim_pengabdian/update_status'); ?>",
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
			url = "<?php echo site_url('skim_pengabdian/insert') ?>";
			data = $('#form').serialize();
		} else {
			url = "<?php echo site_url('skim_pengabdian/update') ?>";
			data = $('#form_update').serialize();
		}

		// ajax adding data to database
		$.ajax({
			url: url,
			type: "POST",
			data: data,
			dataType: "JSON",
			success: function(resp) {

				if (resp.status) //if success close modal and reload ajax table
				{	
					if(save_method == "update"){
						$('#modal_form_update').modal('hide');
					}
					$('#modal_form').modal('hide');
					reload_table();
					Toast.fire({
						icon: 'success',
						title: 'Success!!.'
					});
				} else {
					for (var i = 0; i < resp.inputerror.length; i++) {
						$('[name="' + resp.inputerror[i] + '"]').addClass('is-invalid');
						$('[name="' + resp.inputerror[i] + '"]').next().text(resp.error_string[i]).addClass('invalid-feedback');
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


<!-- Bootstrap Form Add modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content ">
			<div class="modal-header">
				<h3 class="modal-title">Skim Pengabdian</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <input type="hidden" value="2" name="id_tipe_pengajuan" />
					<div class="card-body">
						<div class="form-group row ">
							<label for="nama" class="col-sm-3 col-form-label">Nama</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
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
                        <div class="form-group row">
							<label for="maksimal_pengajuan" class="col-sm-3 col-form-label">Maksimal Pengajuan</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="0" name="maksimal_pengajuan"> Unlimited</label>
                                <label class="radio-inline"><input type="radio" value="1" name="maksimal_pengajuan"> Limited</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row jumlah_maksimal_pengajuan">
							<label for="jumlah_maksimal_pengajuan" class="col-sm-3 col-form-label">Jumlah Maksimal Pengajuan</label>
							<div class="col-sm-9 kosong">
								<input type="number" class="form-control" name="jumlah_maksimal_pengajuan" id="jumlah_maksimal_pengajuan" placeholder="Jumlah Maksimal Pengajuan">
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="syarat" class="col-sm-3 col-form-label">Syarat</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="0" name="syarat"> Tidak</label>
                                <label class="radio-inline"><input type="radio" value="1" name="syarat"> Ya</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row jumlah_syarat">
							<label for="jumlah_syarat" class="col-sm-3 col-form-label">Jumlah Syarat</label>
							<div class="col-sm-9 kosong">
								<input type="number" class="form-control" name="jumlah_syarat" id="jumlah_syarat" placeholder="Jumlah Syarat">
								<span class="help-block"></span>
							</div>
						</div>
                        <div id="list_syarat">
							
						</div>
                        <div class="form-group row ">
							<label for="lama_penyelesaian" class="col-sm-3 col-form-label">Lama Penyelesaian</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="1" name="lama_penyelesaian"> 1 Tahun</label>
                                <label class="radio-inline"><input type="radio" value="0" name="lama_penyelesaian"> Lebih dari 1 Tahun</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="wajib_laporan_kemajuan" class="col-sm-3 col-form-label">Wajib Laporan Kemajuan</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="0" name="wajib_laporan_kemajuan"> Tidak</label>
                                <label class="radio-inline"><input type="radio" value="1" name="wajib_laporan_kemajuan"> Ya</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="id_luaran" class="col-sm-3 col-form-label">Luaran Wajib</label>
							<div class="col-sm-9 kosong">
                                <select name="id_luaran[]" class="selectpicker js-example-basic-multiple w-100" multiple data-live-search="true" title="Silahkan pilih" data-actions-box="true">
                                    <?php foreach ($luaran as $luarans) :
										echo "<option value='$luarans->id'>$luarans->nama</option>";
									endforeach; ?>
                                </select>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="maksimal_dana" class="col-sm-3 col-form-label">Maksimal Dana</label>
							<div class="col-sm-9 kosong">
								<input type="number" class="form-control" name="maksimal_dana" id="maksimal_dana" placeholder="Maksimal Dana">
								<span class="help-block"></span>
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

<!-- Bootstrap Form Update modal -->
<div class="modal fade" id="modal_form_update" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content ">
			<div class="modal-header">
				<h3 class="modal-title">Skim Penelitian</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="#" id="form_update" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <input type="hidden" value="2" name="id_tipe_pengajuan" />
					<div class="card-body">
						<div class="form-group row ">
							<label for="nama" class="col-sm-3 col-form-label">Nama</label>
							<div class="col-sm-9 kosong">
								<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
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
                        <div class="form-group row">
							<label for="maksimal_pengajuan" class="col-sm-3 col-form-label">Maksimal Pengajuan</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="0" name="maksimal_pengajuan"> Unlimited</label>
                                <label class="radio-inline"><input type="radio" value="1" name="maksimal_pengajuan"> Limited</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row jumlah_maksimal_pengajuan">
							<label for="jumlah_maksimal_pengajuan" class="col-sm-3 col-form-label">Jumlah Maksimal Pengajuan</label>
							<div class="col-sm-9 kosong">
								<input type="number" class="form-control" name="jumlah_maksimal_pengajuan" id="jumlah_maksimal_pengajuan" placeholder="Jumlah Maksimal Pengajuan">
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="syarat" class="col-sm-3 col-form-label">Syarat</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="0" name="syarat"> Tidak</label>
                                <label class="radio-inline"><input type="radio" value="1" name="syarat"> Ya</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row list_syarat">
							<label for="list_syarat" class="col-sm-3 col-form-label">List Syarat</label>
							<div class="col-sm-9 kosong">
								<textarea type="text" class="form-control" name="list_syarat" id="list_syarat" placeholder="(Syarat1,Syarat2,dst)"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="lama_penyelesaian" class="col-sm-3 col-form-label">Lama Penyelesaian</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="1" name="lama_penyelesaian"> 1 Tahun</label>
                                <label class="radio-inline"><input type="radio" value="0" name="lama_penyelesaian"> Lebih dari 1 Tahun</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="wajib_laporan_kemajuan" class="col-sm-3 col-form-label">Wajib Laporan Kemajuan</label>
							<div class="col-sm-9 kosong">
                                <label class="radio-inline mr-3"><input type="radio" value="0" name="wajib_laporan_kemajuan"> Tidak</label>
                                <label class="radio-inline"><input type="radio" value="1" name="wajib_laporan_kemajuan"> Ya</label>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="id_luaran" class="col-sm-3 col-form-label">Luaran Wajib</label>
							<div class="col-sm-9 kosong">
                                <select name="id_luaran[]" class="selectpicker js-example-basic-multiple w-100" multiple data-live-search="true" title="Silahkan pilih" data-actions-box="true">
                                    <?php foreach ($luaran as $luarans) :
										echo "<option value='$luarans->id'>$luarans->nama</option>";
									endforeach; ?>
                                </select>
							</div>
						</div>
                        <div class="form-group row ">
							<label for="maksimal_dana" class="col-sm-3 col-form-label">Maksimal Dana</label>
							<div class="col-sm-9 kosong">
								<input type="number" class="form-control" name="maksimal_dana" id="maksimal_dana" placeholder="Maksimal Dana">
								<span class="help-block"></span>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //script jumlah maksimal pengajuan muncul
    $('input[name="maksimal_pengajuan"]').on('change', function() {
        $('.jumlah_maksimal_pengajuan')
            .toggle(+this.value === 1 && this.checked);
    }).change();

    //script jumlah syarat muncul 
    $('input[name="syarat"]').on('change', function() {
        $('.jumlah_syarat')
            .toggle(+this.value === 1 && this.checked);
    }).change();

    //script input syarat muncul sesuai jumlah syarat
    $('#jumlah_syarat').change(function() {
        $('#list_syarat').html(''); //added this to clear the div before setting inputs
        var num = $(this).val();
        var n = 1;
        var m = 1;
        for (var i = 0; i < num; i++) {
            $('#list_syarat').append(`
                <div class = "form-group row">
                    <label for="list_syarat" class="col-sm-3 col-form-label">Input Syarat `+ n++ +`</label>
                    <div class="col-sm-9 kosong">
                        <input type="text" class="form-control" name="list_syarat[]" id="list_syarat" placeholder="Input Syarat `+ m++ +`">
                        <span class="help-block"></span>
                    </div>
                </div>`
            );
        }
    });
</script>

<script>
    //script luaran wajib multiple select
    // $(document).ready(function() {
    //     $(".js-example-basic-multiple").select2({
	// 		dropdownParent: $('#modal_form'),
    //         placeholder: "Silahkan Pilih",
	// 		minimumResultsForSearch: 1,
    //     });
    // });

	$(document).ready(function() {
		$(".js-example-basic-multiple").selectpicker();
	});
</script>