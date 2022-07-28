<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Best Selling for the Month of <span class="badge bg-info"><?php echo date('F');?></span></h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                           List of Best Selling Items &nbsp;
                                        </p>
    
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Count</th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <?php  $sql = "SELECT Product,Image,count(*) as `Count`,DateTime_Out
                                                  FROM table_products
                                                  INNER JOIN table_order
                                                  ON table_products.ID = table_order.Product_ID
                                                  INNER JOIN table_transaction
                                                  ON table_order.Transaction_ID = table_transaction.ID WHERE MONTH(DateTime_Out) = MONTH(CURRENT_DATE())
                                                  AND YEAR(DateTime_Out) = YEAR(CURRENT_DATE()) GROUP BY Product order by Count DESC";
                                                  $result = $conn->query($sql);
                                                  while($row = $result->fetch_assoc()) { ?>

                                            <tr>
                                                <td><img src="photos/<?php echo $row["Image"]; ?>" class="rounded-circle" alt="" height="50" width="50"> <?php echo $row["Product"]; ?></td>
                                                <td><?php echo $row["Count"]; ?></td>
                                            </tr>
                                            
                                            <?php } ?>
                                            
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
        ordering:false,
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
 newPageTitle =  val +' - Best Selling Items';
document.querySelector('title').textContent = newPageTitle;
</script>