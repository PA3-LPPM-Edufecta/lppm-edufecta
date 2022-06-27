<?php $this->load->view('admin/layouts/tables'); ?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light elevation-1">
            <h3 class="card-title mt-1"><i class="fa fa-list text-blue"></i> Data Luaran</h3>
            <!-- Card-Tools -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool text-blue" data-card-widget="card-refresh" data-source="/lppm/dashboard/luaran" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
              <button type="button" class="btn btn-primary" onclick="add_luaran()" title="Add Data"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
            <table id="tabelluaran" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-blue">
                  <th>Nama</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th style="width: 50px;">Aksi</th>
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
        <p>Apakah anda yakin ingin menghapus luaran <strong class="text-konfirmasi"> </strong> ?</p>
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
        <h4 class="modal-title ">View Luaran</h4>
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

    //datatables
    table = $("#tabelluaran").DataTable({
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
        "sEmptyTable": "Data luaran Belum Ada"
      },
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('luaran/ajax_list') ?>",
        "type": "POST"
      },
      //Set column definition initialisation properties.
      "columnDefs": [{
          "targets": [-1], //last column
          "render": function(data, type, row) {

            // return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vluaran(" + row[4] + ")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_luaran(" + row[4] + ")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" nama=" + row[0] + "  onclick=\"delluaran(" + row[4] + ")\"><i class=\"fas fa-trash\"></i></a>"
            if (row[2] == 0) {
              return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                    <li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_luaran(` + row[3] + `)">Edit</a></li>
                    <li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="delluaran(` + row[3] + `)">Hapus</a></li>
                    <li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[3] + `,` + row[2] + `)">Set Status Aktif</a></li>
                </ul>
							`;
            } else {
              return `
								<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary"></a>
								<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                  <li><a href="javascript:void(0)" class="dropdown-item text-center" title="Edit" data-role="edit" onclick="edit_luaran(` + row[3] + `)">Edit</a></li>
                  <li><a href="javascript:void(0)" class="dropdown-item text-center" title="Delete" nama=" + row[0] + "  onclick="delluaran(` + row[3] + `)">Hapus</a></li>
                  <li><a href="javascript:void(0)" class="dropdown-item text-center" title="Status" onclick="update_status(` + row[3] + `,` + row[2] + `)">Set Status Tidak Aktif</a></li>
								</ul>
							`;
            }
          },
          "orderable": false, //set not orderable
        },
        {
          "targets": [2],
          "render": function(data, type, row) {
            if (row[2] == 1) {
              return "Aktif";
            } else {
              return "Tidak Aktif";
            }
          }
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
  // $(".v_luaran").click(function(){
  function vluaran(id) {
    $('.modal-title').text('View Luaran');
    $("#modal-default").modal();
    $.ajax({
      url: '<?php echo base_url('luaran/viewluaran'); ?>',
      type: 'post',
      data: 'table=tbl_luaran&id=' + id,
      success: function(respon) {

        $("#md_def").html(respon);
      }
    })


  }

  function update_status(id, status) {
    $.ajax({
      url: "<?php echo site_url('luaran/update_status'); ?>",
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

  function delluaran(id) {
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
          url: "<?php echo site_url('luaran/delete'); ?>",
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


  function add_luaran() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Luaran'); // Set Title to Bootstrap modal title
  }

  function edit_luaran(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url: "<?php echo site_url('luaran/edit_luaran') ?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        $('[name="id"]').val(data.id);
        $('[name="nama"]').val(data.nama);
        $('[name="keterangan"]').val(data.keterangan);
        $('[name="status"]').val(data.status);
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Luaran'); // Set title to Bootstrap modal title

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    if (save_method == 'add') {
      url = "<?php echo site_url('luaran/insert') ?>";
    } else {
      url = "<?php echo site_url('luaran/update') ?>";
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
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h3 class="modal-title">Luaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id" />
          <div class="card-body">
            <div class="form-group row ">
              <label for="nama" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control selector-nama" name="nama" id="nama" placeholder="Nama Luaran">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row ">
              <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
              <div class="col-sm-9 kosong">
                <textarea type="text" class="form-control selector-keterangan" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
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