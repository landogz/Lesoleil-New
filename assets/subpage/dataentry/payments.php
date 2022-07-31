<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
                    <!-- Start Content-->
                    <div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Payment Methods</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                            Mode of Payments &nbsp;
                                            <button type="button" data-bs-toggle="modal" class="btn btn-success rounded-pill waves-effect waves-light add_mop">
                                                <span class="btn-label"><i class="mdi mdi-new-box"></i></span>New Payment Method
                                            </button>
                                        </p>
    
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mode of Payment</th>
                                                <th>Status</th>
                                                <th style="width: auto;"></th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <?php 
                                              $sql = "SELECT * FROM table_MOP";
                                              $result = $conn->query($sql);
                                              while($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo  htmlentities($row["ID"]); ?></td>
                                                <td><?php echo  htmlentities($row["MOP"]); ?></td>
                                                <td><?php if($row["Status"] == 'Available'){ echo '<span class="badge bg-success">Available</span>'; } else { echo '<span class="badge bg-danger">Not Available</span>'; } ?></td>
                                                <td class="project-actions text-right">
                                                  <button type="button" class="btn btn-warning btn-rounded text-white btn-sm edit_MOP" id="<?php echo $row["ID"]; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                  <button type="button" class="btn btn-danger btn-rounded text-white btn-sm" onclick="delete_MOP(<?php echo $row["ID"]; ?>)"><i class="fas fa-trash-alt"></i> Delete</button>
                                                </td>
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


 <!--  Modal content for the Large example -->
                                        <div class="modal fade" id="MOP_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Mode of Payments</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="post" id="submit_MOP" class="form-material">
                                                           <div class="mb-3">
                                                                <label for="name">Enter Mode of Payment Name</label>
                                                                 <input type="text" name="name" id="name" required class="form-control form-control-line" />  
                                                            </div>

                                                            <div class="row"> 
                                                            <div class="mb-3 col-md-12">
                                                                <label for="status1" class="form-label">Select Status</label>
                                                                 <select class="form-select" name="status1" id="status1">
                                                                        <option value="Available">Available</option>
                                                                        <option value="Not Available">Not Available</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                           <div class="modal-footer">  
                                                                <input type="hidden" name="MOP_id" id="MOP_id" /> 
                                                              <input type="submit" name="insert_MOP" id="insert_MOP" value="" class="btn btn-success" />  
                                                             <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                                                           </div>
                                                        </form>
                                                     </div>

                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->






<script type="text/javascript">
    
$(document).ready(function() {


      $(document).on('click', '.edit_MOP', function() {
        var MOP_ID = $(this).attr("id");
        $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_fetch_MOP' : 1,
                    'MOP_ID' : MOP_ID,
                  },
                    dataType: 'json',
                  success: function(data){
                    $('#name').val(data.MOP);
                    $('#status1').val(data.Status);
                    $('#MOP_id').val(data.ID);
                    $('#insert_MOP').val("Update");
                    $('#MOP_Modal').modal('show');
                  }
                });

    }); 


   $(document).on('click', '.add_mop', function() {
                    $('#insert_MOP').val("Save");
                    $('#MOP_id').val("");
                    $('#submit_MOP')[0].reset();
                    $('#MOP_Modal').modal('show');
    }); 

  $('#submit_MOP').on("submit", function(event) {
        event.preventDefault();
            
               $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_add_MOP' : 1,
                    'MOP_id' : $('#MOP_id').val(),
                    'name' : $('#name').val(),
                    'status' : $('#status1').val(),
                  },
                  success: function(response){
                    if ($.trim(response) == 'saved') {  
                       setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been saved.",
                                type: "success"
                            }, function() {                     
                                $("#content").load("<?php echo $route_dataentry; ?>payments.php");
                                $('#insert_MOP').val("Save");
                                $('#MOP_id').val("");
                                $('#submit_MOP')[0].reset();
                                $('#MOP_Modal').modal('hide');
                            });
                        }, 1);
                    }
                    else if ($.trim(response) == 'updated') {  
                       setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been updated.",
                                type: "success"
                            }, function() {                                
                                $('#submit_MOP')[0].reset();
                                $('#MOP_Modal').modal('hide');
                                $("#content").load("<?php echo $route_dataentry; ?>payments.php");
                                $('#insert_MOP').val("Save");
                                $('#MOP_id').val("");
                            });
                        }, 1);
                    }
                    else if ($.trim(response) == 'duplicate')
                    {
                         setTimeout(function() {
                            swal({
                                title: "Duplicate!",
                                text: "Table Name already exist!",
                                type: "error"
                            }, function() {              
                            });
                        }, 1);
                    }
                  }
                });


    });


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

     function delete_MOP(id)
    {

         swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this Data!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_delete_MOP' : 1,
                    'id' : id,
                  },
                  success: function(response){
                    if ($.trim(response) == 'deleted') {  

                       setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been deleted.",
                                type: "success"
                            }, function() {                                
                                $("#content").load("<?php echo $route_dataentry; ?>payments.php");
                            });
                        }, 1);


                    }
                  }
                });
            });
    }

</script>

<script type="text/javascript">
  
    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val +' - Payments';
document.querySelector('title').textContent = newPageTitle;
</script>