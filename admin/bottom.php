<footer class="main-footer">
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo ADMIN_LANDING_PATH ?>index">Shop</a>.</strong>
  All rights reserved.
  <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div> -->
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/jquery/jquery.min.js"></script>
<!-- Custom JS -->
<script src="<?php echo ADMIN_LANDING_PATH ?>assets/js/custom.js"></script>
<!-- Sweet Alert JS -->
<script src="<?php echo ADMIN_LANDING_PATH ?>assets/js/sweetalert2.all.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo ADMIN_LANDING_PATH ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo ADMIN_LANDING_PATH ?>assets/js/adminlte.js"></script>
<!-- Chosen js drop down -->
<script src="<?php echo ADMIN_LANDING_PATH ?>assets/js/chosen.jquery.min.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
    });
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
<!-- RESUBMIT FORM PREVENT -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
</body>

</html>