<script>
  tinymce.init({
    selector: '#isi',
    height: 300,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table',
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px"
  });
</script>

<script>
  tinymce.init({
    selector: '.textarea',
    height: 300,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table',
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px"
  });
</script>
<script>
  tinymce.init({
    selector: '.textareatengah',
    height: 500,
    plugins: 'print preview paste searchreplace autolink directionality visualblocks visualchars code fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools colorpicker textpattern help',
    toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | image | table | removeformat',
    visual_table_class: 'tiny-table'
  });
</script>

<!-- SWEETALERT -->
<?php if ($this->session->flashdata('sukses')) { ?>
  <script>
    swal("Berhasil", "<?php echo $this->session->flashdata('sukses'); ?>", "success")
  </script>
<?php } ?>

<?php if ($this->session->flashdata('warning')) { ?>
  <script>
    swal("Oops...", "<?php echo $this->session->flashdata('warning'); ?>", "warning")
  </script>
<?php } ?>

<script>
  // Sweet alert delete
  function confirmation(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    console.log(urlToRedirect); // verify if this is the right URL
    swal({
        title: "Yakin ingin menghapus data ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
        if (willDelete) {
          // Proses ke URL
          window.location.href = urlToRedirect;
        }
      });
  }
</script>

</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.id.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/plugin/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugin/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/plugin/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/plugin/fastclick/fastclick.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url() ?>assets/plugin/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>assets/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- skim_penelitian page script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "aLengthMenu": [
        [5, 10, 25, 50, 100, -1],
        [5, 10, 25, 50, 100, "All"]
      ],
      "iDisplayLength": 5,

      buttons: [
        'csv', 'excel', 'pdf',
        {
          extend: 'print',
          text: 'Preview Tables',
          autoPrint: false,
          exportOptions: {
            columns: ':visible'
          }
        },
        'colvis'
      ],
      columnDefs: [{
        targets: -1,
        visible: true
      }]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#editor1'))
      .then(function(editor) {
        // The editor instance
      })
      .catch(function(error) {
        console.error(error)
      })

    // bootstrap WYSIHTML5 - text editor

    $('.textareaku').wysihtml5({
      toolbar: {
        fa: true
      }
    })
  })
</script>
</body>

</html>