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
                                            <?php 
                                                    $sql = "SELECT table_transaction.ID,table_transaction.Transaction_Number,table_tables.Table_Name,table_transaction.DateTime_Out
                                                    ,table_mop.MOP,table_transaction.Total_Amount_Due,table_account.Name from table_transaction
                                                    inner join table_tables on
                                                                table_transaction.Table_ID = table_tables.ID                           
                                                                inner join table_mop on
                                                                table_mop.ID = table_transaction.MOP                            
                                                                inner join table_account on
                                                                table_account.ID = table_transaction.Cashier  where table_transaction.Status = 'Paid' order by table_transaction.Transaction_Number DESC";
                                                    $result = $conn->query($sql);
                                                    while($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo  htmlentities($row["Transaction_Number"]); ?></td>
                                                        <td><?php echo  htmlentities($row["Table_Name"]); ?></td>
                                                        <td><?php echo htmlentities(date_format(date_create($row["DateTime_Out"]),"F d, Y h:i a"));?></td>
                                                        <td><?php echo  htmlentities($row["MOP"]); ?></td>
                                                        <td>₱ <?php echo  htmlentities($row["Total_Amount_Due"]); ?></td>
                                                        <td><?php echo  htmlentities($row["Name"]); ?></td>
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
        order: [[0, 'desc']],
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