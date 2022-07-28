<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Stock In History</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                           List of Entered Stocks   &nbsp;
                                        </p>
    
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item Name</th>
                                                <th>Stock Added</th>
                                                <th>Last Update</th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <?php 
                                                $sql = "SELECT *,table_stockin.Stock as `Stock in Added` from table_stockin                           
                                                inner join table_inventory on 
                                                table_inventory.ID = table_stockin.Inventory_ID  order by Last_Update DESC ";
                                                $result = $conn->query($sql);
                                                while($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo  htmlentities($row["ID"]); ?></td>
                                                    <td><?php echo  htmlentities($row["Item"]); ?></td>
                                                    <td><?php echo  htmlentities($row["Stock in Added"]) . ' ' . htmlentities($row["Unit"]); ?></td>
                                                    <td><?php echo htmlentities(date_format(date_create($row["Last_Update"]),"F d, Y h:i a")); ?></td>
                                                </tr>
                                                <?php
                                                    } $conn->close();?>
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
        buttons: ["copy", "pdf"]
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
 newPageTitle =  val +' - Stocks';
document.querySelector('title').textContent = newPageTitle;
</script>