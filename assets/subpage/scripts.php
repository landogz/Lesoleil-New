
        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

          <!-- knob plugin -->
        <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>

          <!--Morris Chart-->
        <script src="assets/libs/morris.js06/morris.min.js"></script>
        <script src="assets/libs/raphael/raphael.min.js"></script>

        <!-- Validation init js-->
        <script src="assets/js/pages/form-validation.init.js"></script>

  
        <!-- Dashboar init js-->
        <script src="assets/js/pages/dashboard.init.js"></script>

         <!-- third party js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- third party js ends -->


        <!-- Plugins js-->
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- Init js-->
        <script src="assets/js/pages/form-pickers.init.js"></script>


        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <script type="text/javascript">
            


$(document).ready(function() {
    $("#datatable").DataTable();

    var a = $("#datatable-buttons").DataTable({
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf"]
    });

    $("#key-table").DataTable({
            keys: !0
        }),
        $("#responsive-datatable").DataTable(),
        $("#selection-datatable").DataTable({
            select: {
                style: "multi"
            }
        }),
        a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
        $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm"),
        $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm"),
        $(".dataTables_length label").addClass("form-label")
});


$(document).ready( function() {

   $("#content").load("<?php echo $route_dashboard; ?>dashboard.php");
    $("#topnav-dashboard").on("click", function() {
        $("#content").load("<?php echo $route_dashboard; ?>dashboard.php");
    });
     $("#topnav-inventory").on("click", function() {
        $("#content").load("<?php echo $route_dashboard; ?>inventory.php");
    });
      $("#settings").on("click", function() {
        $("#content").load("<?php echo $route_dashboard; ?>settings.php");
    });
           $("#accounts").on("click", function() {
        $("#content").load("<?php echo $route_dashboard; ?>accounts.php");
    });


      $("#product").on("click", function() {
        $("#content").load("<?php echo $route_dataentry; ?>products.php");
    });
      $("#category").on("click", function() {
        $("#content").load("<?php echo $route_dataentry; ?>category.php");
    });
      $("#table").on("click", function() {
        $("#content").load("<?php echo $route_dataentry; ?>table.php");
    });
      $("#payment").on("click", function() {
        $("#content").load("<?php echo $route_dataentry; ?>payments.php");
    });



       $("#sales").on("click", function() {
        $("#content").load("<?php echo $route_reports; ?>sales.php");
    });
        $("#best").on("click", function() {
        $("#content").load("<?php echo $route_reports; ?>best.php");
    });
         $("#stocks").on("click", function() {
        $("#content").load("<?php echo $route_reports; ?>stocks.php");
    });
          $("#unsettled").on("click", function() {
        $("#content").load("<?php echo $route_reports; ?>unsettled.php");
    });
           $("#audit").on("click", function() {
        $("#content").load("<?php echo $route_reports; ?>audit.php");
    });

});



        </script>