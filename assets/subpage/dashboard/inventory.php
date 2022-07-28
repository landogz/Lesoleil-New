<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>
<div class="container-fluid">

                      <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Inventory</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                         <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                            List of items &nbsp;
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg" class="btn btn-success rounded-pill waves-effect waves-light">
                                                <span class="btn-label"><i class="mdi mdi-new-box"></i></span>New Item
                                            </button>
                                        </p>
    
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Item</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Last Update</th>
                                                <th style="width: auto;"></th>
                                            </tr>
                                            </thead>
    
    
                                            <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM table_inventory order by Status DESC";
                                                $result = $conn->query($sql);
                                                while($row = $result->fetch_assoc()) { ?>
                                                    <?php 
                                                    $unitss ='';
                                                    if($row["Unit"] == 'kg'){$unitss = 'Kilogram (kg)';}elseif($row["Unit"] == 'g'){$unitss = 'Gram (g)';}elseif($row["Unit"] == 'l'){$unitss = 'Liter (l)';}elseif($row["Unit"] == 'ml'){$unitss = 'Milliliter (ml)';}elseif($row["Unit"] == 'btl'){$unitss = 'Bottle (btl)';}elseif($row["Unit"] == 'pc'){$unitss = 'Pieces (pc)';}elseif($row["Unit"] == 'serving'){$unitss = 'Serving';}elseif($row["Unit"] == 'slc'){$unitss = 'Slice (slc)';}
                                                    ?>
                                                <tr>
                                                    <td><?php echo  htmlentities($row["ID"]); ?></td>
                                                    <td><?php echo  htmlentities($row["Item"]); ?></td>
                                                    <td><?php echo  htmlentities($row["Stock"]) . ' ' . $unitss; ?></td>
                                                    <td><?php if($row["Status"] == 'Available'){ echo '<span class="badge bg-success">Available</span>'; } else { echo '<span class="badge bg-danger">Not Available</span>'; } ?></td>
                                                    <td><?php echo htmlentities(date_format(date_create($row["Last_Update"]),"F d, Y h:i a"));?></td>
                                                    <td class="project-actions text-right">
                                                    <button type="button" class="btn btn-primary btn-rounded text-white btn-sm add_inventory" id="<?php echo $row["ID"]; ?>"><i class="fas fa-plus"></i> Add Stock</button>
                                                    <button type="button" class="btn btn-warning btn-rounded text-white btn-sm edit_inventory" id="<?php echo $row["ID"]; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                    <button type="button" class="btn btn-danger btn-rounded text-white btn-sm" onclick="delete_inventory(<?php echo $row["ID"]; ?>)"><i class="fas fa-trash-alt"></i> Delete</button>
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

        

                                        <div class="modal fade" id="inventory_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Item</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" id="submit_inventory" class="form-material">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Enter Item Name</label>
                                                            <input type="text" name="name" id="name" required class="form-control">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="simpleinput" class="form-label">Enter Stock</label>
                                                                <input type="text" name="stock" id="stock" step=1 required class="form-control">
                                                            </div>


                                                            <div class="mb-3 col-md-6">
                                                                <label for="unit" class="form-label">Select Unit</label>
                                                                <select class="form-select" name="unit" id="unit">
                                                                        <option value="kg">Kilogram (kg)</option>
                                                                        <option value="g">Gram (g)</option>
                                                                        <option value="l">Liter (l)</option>
                                                                        <option value="ml">Milliliter (ml)</option>
                                                                        <option value="btl">Bottle (btl)</option>
                                                                        <option value="pc">Pieces (pc)</option>
                                                                        <option value="serving">Serving</option>
                                                                        <option value="slc">Slices (slc)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                                <label for="status" class="form-label">Select Status</label>
                                                                <select  class="form-select" name="status" id="status">
                                                                    <option value="Available">Available</option>
                                                                    <option value="Not Available">Not Available</option>
                                                                </select>
                                                            </div>
                                                        <div class="modal-footer text-center">  
                                                        <input type="hidden" name="inventory_id" id="inventory_id" /> 
                                                            <input type="submit" name="insert_inventory" id="insert_inventory" value="" class="btn btn-success waves-effect waves-light" />  
                                                            <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                    <div class="modal fade" id="inventory_add_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Add Stock</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form method="post" id="submit_inventory_add" class="form-material">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Item Name</label>
                                                            <input type="text" name="itemname" id="itemname" class="form-control" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Stock</label>
                                                            <input type="text" name="currentstock" id="currentstock" class="form-control" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Enter Additional Stock</label>
                                                            <input type="number" name="itemstock" id="itemstock" class="form-control" step=1 required>
                                                        </div>
                                                        <div class="modal-footer text-center">  
                                                            <input type="hidden" name="inventory_add_id" id="inventory_add_id" /> 
                                                            <input type="hidden" name="currentstock1" id="currentstock1" />
                                                            <input type="submit" name="insert_inventory_add" id="insert_inventory_add" value="" class="btn btn-success waves-effect waves-light" />  
                                                            <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                                                        </div>
                                                      
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->



 <!--  Modal content for the Large example -->
                                        <div class="modal fade" id="bs-example-modal-lg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Inspect New Complaint</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                      <div class="card-body" id="details_place">
                                                                    <h5 class="card-title placeholder-glow">
                                                                        <span class="placeholder col-6"></span>
                                                                    </h5>
                                                                    <p class="card-text placeholder-glow">
                                                                        <span class="placeholder col-7"></span>
                                                                        <span class="placeholder col-4"></span>
                                                                        <span class="placeholder col-4"></span>
                                                                        <span class="placeholder col-6"></span>
                                                                        <span class="placeholder col-8"></span>
                                                                    </p>
                                                                </div>

                                                    <div class="modal-body"  id="details_card" style="display: block">

                                                            <div class="card-body">

                                                                <form id="show_com" method="POST" enctype="multipart/form-data">

                                                                    <div class="card">
                                                                        <div class="card-body task-detail">
                                                                            
                                                                            <div class="d-flex mb-3">
                                                                                <img class="flex-shrink-0 me-3 rounded-circle avatar-md" alt="64x64" src="assets/images/users/avatars-000317336432-0vcza7-t500x500.jpg">
                                                                                <div class="flex-grow-1">
                                                                                    <h4 class="media-heading mt-0" id="showname"></h4>
                                                                                    <span class="badge bg-danger" id="showreference"></span>
                                                                                </div>
                                                                            </div>
                                        
                                                                            <h4 name="showsubject" id="showsubject"></h4>
                                        
                                                                            <p class="text-muted" id="showmessage"></p>
                                        
                                                                            
                                        
                                                                            <div class="row task-dates mb-0 mt-2">
                                                                                <div class="col-lg-4">
                                                                                    <h5 class="font-600 m-b-5">Contact</h5>
                                                                                    <p id="showcontact"></p>
                                                                                </div>
                                        
                                                                                
                                                                                <div class="col-lg-4">
                                                                                    <h5 class="font-600 m-b-5">Email Address</h5>
                                                                                    <p id="showemail"></p>
                                                                                </div><div class="col-lg-4">
                                                                                    <h5 class="font-600 m-b-5">Date Reported</h5>
                                                                                    <p id="date_reported"></p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                        

                                        
                                                                            <div class="attached-files mt-3">
                                                                                <h5>Attached File</h5>
                                                                                <ul class="list-inline files-list">
                                                                                    <li class="list-inline-item file-box">
                                                                                         <img class="img-fluid z-depth-1" src="" alt="video" id="evidence_img" style="display: none;height: 250px">
                                                                                          <video id="evidence_video"  width="400" controls style="width: 100%;height: 250px;display: none;">
                                                                                            <source  id="evidence_video" src="">
                                                                                            Your browser does not support HTML video.
                                                                                            </video>
                                                                                    </li>
                                                                                    
                                                                                </ul>
                                                                                
                                                                            </div>
                                        
                                                                        </div>
                                                                    </div>
                                                           
                                                    </div>
                                                    <div class="modal-footer"> 
                                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="approved_account()">
                                                       Approve
                                                    </button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light"  onclick="declined_account()">
                                                        Decline
                                                    </button>
                                                        <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

<script type="text/javascript">
    
$(document).ready(function() {
    $('#inventory_add_Modal').on('hidden.bs.modal', function (e) {
        $('#inventory_add_Modal').modal('hide');
})

    $(document).on('click', '.add_inventory', function() {
        var inventory_add_ID = $(this).attr("id");
        $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_fetch_inventory' : 1,
                    'inventory_ID' : inventory_add_ID,
                  },
                    dataType: 'json',
                  success: function(data){
                        var unitss ='';
                          if(data.Unit == 'kg')
                            {unitss = 'Kilogram (kg)';}
                          else if(data.Unit == 'g')
                            {unitss = 'Gram (g)';}
                          else if(data.Unit == 'l')
                            {unitss = 'Liter (l)';}
                          else if(data.Unit == 'ml')
                            {unitss = 'Milliliter (ml)';}
                          else if(data.Unit == 'btl')
                            {unitss = 'Bottle (btl)';}
                          else if(data.Unit == 'pc')
                            {unitss = 'Pieces (pc)';}
                          else if(data.Unit == 'serving')
                            {unitss = 'serving';}
                          else if(data.Unit == 'slc')
                            {unitss = 'Slices (slc)';}
                    
                    $('#itemname').val(data.Item);
                    $('#currentstock').val(data.Stock + ' ' + unitss);
                    $('#currentstock1').val(data.Stock);
                    $('#inventory_add_id').val(data.ID);
                    $('#insert_inventory_add').val("Add Stock");
                    $('#inventory_add_Modal').modal('show');
                  }
                });

    }); 

    
    $(document).on('click', '.edit_inventory', function() {
         // document.getElementById("stock").disabled = true;
        var inventory_ID = $(this).attr("id");
        $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_fetch_inventory' : 1,
                    'inventory_ID' : inventory_ID,
                  },
                    dataType: 'json',
                  success: function(data){
                    $('#name').val(data.Item);
                    $('#stock').val(data.Stock);
                    $('#status').val(data.Status);
                    $('#unit').val(data.Unit);
                    $('#inventory_id').val(data.ID);
                    $('#insert_inventory').val("Update");
                    $('#inventory_Modal').modal('show');
                  }
                });

    }); 

    
  $('#submit_inventory_add').on("submit", function(event) {
        event.preventDefault();
        $.ajax({
                    url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_add_inventory_stock' : 1,
                    'inventory_add_id' : $('#inventory_add_id').val(),
                    'itemstock' : $('#itemstock').val(),
                    'currentstock1' : $('#currentstock1').val(),
                  },
            success: function(data) {
                if ($.trim(data) == 'saved') { 
                       setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been saved.",
                                type: "success"
                            }, function() {                                
                                $('#submit_inventory_add')[0].reset();
                                $('#inventory_add_Modal').modal('hide');
                                $("#content").load("<?php echo $route_dashboard; ?>inventory.php");
                            });
                        }, 1);
                    }
            },
      error:function(data){
        //Error Message == 'Title', 'Message body', Last one leave as it is
        swal("Error", "May error. I-refresh ang pahina at ulitin muli.", "error");
      }
        });


    });

    

  $('#submit_inventory').on("submit", function(event) {
        event.preventDefault();
            swal({
              title: "",
              text: "Are you sure you want to save?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, save it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){

               $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_add_inventory' : 1,
                    'inventory_id' : $('#inventory_id').val(),
                    'name' : $('#name').val(),
                    'stock' : $('#stock').val(),
                    'unit' : $('#unit').val(),
                    'status' : $('#status').val(),
                  },
                  success: function(response){
                    if ($.trim(response) == 'saved') {  
                       setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been saved.",
                                type: "success"
                            }, function() {                                
                                location.reload();
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
                                location.reload();
                            });
                        }, 1);
                    }
                    else if ($.trim(response) == 'duplicate')
                    {
                         setTimeout(function() {
                            swal({
                                title: "Duplicate!",
                                text: "Item Name already exist!",
                                type: "error"
                            }, function() {              
                            });
                        }, 1);
                    }
                  }
                });


            });


    });





    $("#datatable").DataTable({order: [[3, 'desc']],});

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
 newPageTitle =  val +' - Inventory';
document.querySelector('title').textContent = newPageTitle;
</script>

