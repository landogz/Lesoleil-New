<?php error_reporting(0); 

   require_once('../../../connections/database.php');

?>

                    <div class="container-fluid">
                          
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box"> 
                                    <h4 class="page-title">Accounts</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-muted font-14 mb-3">
                                            Listahan ng mga tagapangasiwa ng sistema &nbsp
                                            <button type="button"  data-bs-toggle="modal" class="btn btn-success rounded-pill waves-effect waves-light add_account">
                                                        <span class="btn-label"><i class="mdi mdi-new-box"></i></span>New Account
                                                    </button>
                                        </p>
    
                                        <table id="datatable" class="table table-bordered table-bordered dt-responsive nowrap table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Privilege</th>
                                                <th>Date Created</th>
                                                <th>Status</th>
                                                <th></th>
                                              </tr>
                                            </thead>
    
    
                                            <tbody  id="sheet">
                                                <?php 
                                                  $sql = "SELECT * FROM table_account where `Status` ='Active' or `Status` ='Not Active'";
                                                  $result = $conn->query($sql);
                                                  while($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?php echo  htmlentities($row["ID"]); ?></td>
                                                    <td><?php echo  htmlentities($row["Username"]); ?></td>
                                                    <td><?php echo encrypt(htmlentities($row["Password"])); ?></td>
                                                    <td><?php echo  htmlentities($row["Email"]); ?></td>
                                                    <td><?php echo  htmlentities($row["Name"]); ?></td>
                                                    <td><?php if($row["Privilege"] == 'Administrator'){ echo '<span class="badge bg-purple">Administrator</span>'; } else { echo '<span class="badge bg-pink">Cashier</span>'; } ?></td>
                                                    <td><?php echo htmlentities(date_format(date_create($row["Date_Created"]),"F d, Y h:i a"));?></td>
                                                    <td><?php if($row["Status"] == 'Active'){ echo '<span class="badge bg-success">Active</span>'; } else { echo '<span class="badge bg-danger">Not Active</span>'; } ?></td>
                                                    <td class="project-actions text-right">
                                                      <button type="button" class="btn btn-info btn-rounded text-white btn-sm reset_account"  id="<?php echo $row["ID"]; ?>"><i class="fas fa-sync-alt"></i> Reset</button>
                                                      <button class="btn btn-warning btn-sm btn-rounded text-white edit_account" name="edit" id="<?php echo $row["ID"]; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                                                      <?php if($row["Privilege"] != 'Administrator'){ ?>
                                                      <button type="button" class="btn btn-danger btn-rounded text-white btn-sm" onclick="delete_account(<?php echo $row["ID"]; ?>)"><i class="fas fa-trash-alt"></i> Delete</button>
                                                      <?php } ?>
                                                    </td>

                                                </tr>
                                                   <?php
                                                      } $conn->close();?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                        </div> <!-- end row -->

                    
                    </div> <!-- container -->





                                        <div class="modal fade" id="account_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Account</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="card-body">
                                                                <form method="post" id="submit_account" class="form-material">
                                                                       <div class="mb-3">
                                                                          <div class="col-md-12">
                                                                             <label for="name">Enter Username</label>
                                                                             <input type="text" name="name" id="name" required class="form-control form-control-line" />  
                                                                          </div>
                                                                       </div>
                                                                       <div class="mb-3">
                                                                          <div class="col-md-12">
                                                                             <label for="Address">Enter Email Address</label>
                                                                             <input type="email" name="email" id="email" class="form-control form-control-line" />  
                                                                          </div>
                                                                       </div>
                                                                       <div class="mb-3">
                                                                          <div class="col-md-12">
                                                                             <label for="Address">Enter Name</label>
                                                                             <input type="text" name="fullname" id="fullname" required class="form-control form-control-line" />  
                                                                          </div>
                                                                       </div>
                                                                      <div class="row">
                                                                             <div class="mb-3 col-md-6">
                                                                                 <label for="status1" class="form-label">Select Privilege</label>
                                                                                 <select class="form-select" name="priv" id="priv">
                                                                                    <option value="Administrator">Administrator</option>
                                                                                    <option value="Cashier">Cashier</option>
                                                                                 </select>
                                                                              </div>
                                                                              <div class="mb-3 col-md-6">
                                                                                 <label for="status1" class="form-label">Select Status</label>
                                                                                 <select class="form-select" name="status1" id="status1">
                                                                                    <option value="Active">Active</option>
                                                                                    <option value="Not Active">Not Active</option>
                                                                                 </select>
                                                                              </div>
                                                                           </div>
                                                                            <div class="modal-footer">  <input type="hidden" name="account_id" id="account_id" /> 
                                                                          <input type="submit" name="insert_account" id="insert_account" value="" class="btn btn-success" />  
                                                                          <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Close</button>  
                                                                       </div>
                                                            </div>
                                                            

                                                                </form>

                                                    </div>
                                                   
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->



                                          
    


        </div>
        


<script type="text/javascript">
    
$(document).ready(function() {

            ajaxLoading = false;

          
   $(document).on('click', '.add_account', function() {
                    $('#insert_account').val("Save");
                    $('#account_id').val("");
                    $('#submit_account')[0].reset();
                    $('#account_Modal').modal('show');
    }); 

   $(document).on('click', '.edit_account', function() {
     if (!ajaxLoading) {
            ajaxLoading = true;


        var account_ID = $(this).attr("id");
        $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_fetch_account' : 1,
                    'account_ID' : account_ID,
                  },
                    dataType: 'json',
                  success: function(data){
                    $('#name').val(data.Username);
                    $('#email').val(data.Email);
                    $('#priv').val(data.Privilege);
                    $('#status').val(data.Status);
                    $('#fullname').val(data.Name);
                    $('#account_id').val(data.ID);
                    $('#insert_account').val("Update");
                    $('#account_Modal').modal('show');
            ajaxLoading = false;
                  }
                });
    }

    }); 


     $(document).on('click', '.reset_account', function() {
        var account_ID = $(this).attr("id");
        swal({
              title: "",
              text: "Are you sure you want to reset password?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, reset it!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function(){

               $.ajax({
                  url: 'connections/actions.php',
                  type: 'post',
                  data: {
                    'action_reset_account' : 1,
                    'account_ID' : account_ID,
                  },
                  success: function(response){
                    if ($.trim(response) == 'updated') {  
                       setTimeout(function() {
                            swal({
                                title: "Awesome!",
                                text: "Data has been updated.",
                                type: "success"
                            }, function() {                                
                                // showCustomer();
                                               $("#content").load("<?php echo $route_dashboard; ?>accounts.php");
                            });
                        }, 1);
                    }
                  }
                });


            });

    }); 



  $('#submit_account').on("submit", function(event) {
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
                    'action_add_account' : 1,
                    'account_id' : $('#account_id').val(),
                    'name' : $('#name').val(),
                    'email' : $('#email').val(),
                    'fullname' : $('#fullname').val(),
                    'priv' : $('#priv').val(),
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
                                // showCustomer();
                                $('#insert_account').val("Save");
                                $('#account_id').val("");
                                $('#submit_account')[0].reset();
                                $('#account_Modal').modal('hide');
                                $("#content").load("<?php echo $route_dashboard; ?>accounts.php");
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
                                // showCustomer();
                                $('#insert_account').val("Save");
                                $('#account_id').val("");
                                $('#submit_account')[0].reset();
                                $('#account_Modal').modal('hide');
                                 $("#content").load("<?php echo $route_dashboard; ?>accounts.php");
                            });
                        }, 1);
                    }
                    else if ($.trim(response) == 'duplicate')
                    {
                         setTimeout(function() {
                            swal({
                                title: "Duplicate!",
                                text: "Username already exist!",
                                type: "error"
                            }, function() {              
                            });
                        }, 1);
                    }
                  }
                });


            });


    });




});


 function delete_account(id)
                    {

                         swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover this Data!",
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonClass: "btn-danger",
                              confirmButtonText: "Yes, delete it!",
                              closeOnConfirm: false,
                              showLoaderOnConfirm: true,
                            },
                            function(){
                                $.ajax({
                                  url: 'connections/actions.php',
                                  type: 'post',
                                  data: {
                                    'action_delete_account' : 1,
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
                                                // showCustomer();
                                               $("#content").load("<?php echo $route_dashboard; ?>accounts.php");
                                              });
                                        }, 1);


                                    }
                                  }
                                });
                            });
                    }

</script>

        <script type="text/javascript">

                 


$(document).ready(function() {

    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val + ' - Accounts';
document.querySelector('title').textContent = newPageTitle;
$("link[rel*='icon']").prop("href",'assets/images/logo.jpg');

    });

        </script>