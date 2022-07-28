<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Sales Transaction History</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                           List of Transactions &nbsp;
                                        </p>
    
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>Transation No.</th>
                                                <th>Table No.</th>
                                                <th>Date</th>
                                                <th>Mode of Payment</th>
                                                <th>Total Amount Due</th>
                                                <th>Cashier</th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>0 Bottle (btl)</td>
                                                <td><span class="badge bg-success">AVAILABLE</span></td>
                                                <td><span class="badge bg-success">AVAILABLE</span></td>
                                                <td><span class="badge bg-success">AVAILABLE</span></td>
                                                <td><span class="badge bg-success">AVAILABLE</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- end row -->

                </div> <!-- content -->





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


</script>

<script type="text/javascript">
  
    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val +' - Sales';
document.querySelector('title').textContent = newPageTitle;
</script>