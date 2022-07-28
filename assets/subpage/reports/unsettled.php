<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Unsettled Transaction</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                           List of Unsettled Transaction from the POS  &nbsp;
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
                                                    $sql = "SELECT table_transaction.ID,table_transaction.Transaction_Number,table_tables.Table_Name,table_transaction.Date,table_transaction.Total_Amount_Due,table_account.Name,table_transaction.Status from table_transaction
                                                    inner join table_tables on
                                                                table_transaction.Table_ID = table_tables.ID                            
                                                                inner join table_account on 
                                                                table_account.ID = table_transaction.Cashier   where table_transaction.Status = 'Unsettled' order by table_transaction.ID ASC";
                                                    $result = $conn->query($sql);
                                                    while($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo  htmlentities($row["ID"]); ?></td>
                                                        <td><?php echo  htmlentities($row["Transaction_Number"]); ?></td>
                                                        <td><?php echo  htmlentities($row["Table_Name"]); ?></td>
                                                        <td><?php echo htmlentities(date_format(date_create($row["Date"]),"F d, Y h:i a"));?></td>
                                                        <td>N/A</td>
                                                        <td>N/A</td>
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
var val = "<?php echo $System_Name ?>";
 newPageTitle =  val + ' - Unsettled Transactions';
document.querySelector('title').textContent = newPageTitle;

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
