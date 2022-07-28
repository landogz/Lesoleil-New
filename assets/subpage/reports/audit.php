<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Audit Trail</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                           List of Audit Trail from the POS  &nbsp;
                                        </p>
    
                                         <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th width="50px">ID</th>
                                                <th width="50px">Cashier</th>
                                                <th width="50px">Date</th>
                                                <th width="50px">Module</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <?php 
                                                    $sql = "SELECT *,table_audit.ID as `AID`
                                                            FROM table_audit
                                                            INNER JOIN table_account
                                                            ON table_audit.User_ID = table_account.ID order by table_audit.ID DESC";
                                                    $result = $conn->query($sql);
                                                    while($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo  htmlentities($row["AID"]); ?></td>
                                                        <td><?php echo  htmlentities($row["Name"]); ?></td>
                                                        <td><?php echo htmlentities(date_format(date_create($row["Date"]),"F d, Y h:i a"));?></td>
                                                        <td><?php echo  htmlentities($row["Module"]); ?></td>
                                                        <td><?php echo  htmlentities($row["Action"]); ?></td>
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
 newPageTitle =  val +' - Audit Trails';
document.querySelector('title').textContent = newPageTitle;
</script>