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
                                            <button type="button"  data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg" class="btn btn-success rounded-pill waves-effect waves-light">
                                                        <span class="btn-label"><i class="mdi mdi-new-box"></i></span>New Account
                                                    </button>
                                        </p>
    
                                        <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap table-hover">
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
                                                    <td><?php echo  htmlentities($row["Privilege"]); ?></td>
                                                    <td><?php echo htmlentities(date_format(date_create($row["Date_Created"]),"F d, Y h:i a"));?></td>
                                                    <td><?php if($row["Status"] == 'Active'){ echo '<span class="badge bg-success">Active</span>'; } else { echo '<span class="badge bg-danger">Not Active</span>'; } ?></td>
                                                    <td class="project-actions text-right">                                                    
                                                      <div class="dropdown text-center">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 11px);">
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Reset</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                                                            <!-- item-->
                                                            <a href="javascript:void(0);" class="dropdown-item">Delete</a>
                                                        </div>
                                                    </div>
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

                                        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Online Oplan ISumbong Natin HelpDesk System</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <div class="card-body">
                                                                <h4 class="header-title">Ilagay ang impormasyon ng account</h4>
                                                                <p class="text-muted font-14">
                                                                    Ilagay ang tamang impormasyon ng account at wag kakalimutan.
                                                                </p>

                                                                <form method="post" id="submit_account" class="parsley-examples">
                                                                     <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Username : <span class="text-danger">*</span></label>
                                                                        <div class="col-7">
                                                                            <input type="text" required parsley-type="text" class="form-control" id="Username" placeholder="Enter Username"  />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Full Name : <span class="text-danger">*</span></label>
                                                                        <div class="col-7">
                                                                            <input type="text" required parsley-type="text" class="form-control" id="name" placeholder="Enter Full Name" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Email : </label>
                                                                        <div class="col-7">
                                                                            <input type="Email"  parsley-type="Email" class="form-control" id="Email" placeholder="Enter Email" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Contact Number : </label>
                                                                        <div class="col-7">
                                                                            <input type="text"  parsley-type="text" class="form-control" id="contact" placeholder="Enter Contact Number (required format: 09123456789)" autocomplete="off"  pattern="[0-9]{11}"/>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="row mb-3">
                                                                    
                                                                    <label for="name" class="col-4 col-form-label">Enter Password : <span class="text-danger">*</span></label>
                                                                        <div class="col-4">
                                                                        <input type="text" required autocomplete="false" parsley-type="text" class="form-control" id="password" placeholder="Enter Password" />
                                                                        </div>
                                                                        <div class="col-3">
                                                                             <button type="button" class="btn btn-warning waves-effect waves-light" onclick="genPassword()">Generate Password</button>
                                                                        </div>
                                                                      
                                                                    </div>
                                                                    
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="account_id_moddify" id="account_id_moddify" /> 
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>

                                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->



                                          
    


        </div>
        

        
        <script type="text/javascript">

var password=document.getElementById("password");

 function genPassword() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 12;
    var password = "";
 for (var i = 0; i <= passwordLength; i++) {
   var randomNumber = Math.floor(Math.random() * chars.length);
   password += chars.substring(randomNumber, randomNumber +1);
  }
        document.getElementById("password").value = password;
 }

        </script>
        <script type="text/javascript">
$(document).ready(function() {

    var val = "<?php echo $System_Name ?>";
 newPageTitle =  val + ' - Accounts';
document.querySelector('title').textContent = newPageTitle;
$("link[rel*='icon']").prop("href",'assets/images/logo.jpg');

$('#bs-example-modal-lg').on('hidden.bs.modal', function (e) {
                    $('#account_id_moddify').val('');
                    $('#Username').val('');
                    $('#password').val('');
                    $('#name').val('');
                    $('#Email').val('');
                    $('#contact').val('');
})


       $(document).on('click', '.edit_account', function() {
        var account_ID = $(this).attr("id");
            $.ajax({
                url: 'connections/actions',
                type: 'post',
                data: {
                    'action_fetch_account': 1,
                    'account_ID': account_ID,
                },
                dataType: 'json',
                success: function(data) {
                     console.log(data);
                    $('#account_id_moddify').val(data.ID);
                    $('#Username').val(data.Username);
                    $('#password').val(data.Password);
                    $('#name').val(data.Name);
                    $('#Email').val(data.Email);
                    $('#contact').val(data.Contact);
                    $('#bs-example-modal-lg').modal('show');
                },
      error:function(data){
        //Error Message == 'Title', 'Message body', Last one leave as it is
        swal("Error", "May error. I-refresh ang pahina at ulitin muli.", "error");
      }
            });

    }); 




    $('#editprofile').on('shown.bs.modal', function(e) {
        $('#edit_account')[0].reset();
        $('#place').show();
        $('#account_form').hide();

        $.ajax({
            url: 'connections/actions',
            type: 'post',
            data: {
                'action_fetch_account': 1,
                'account_ID': '<?php echo $_SESSION['username']; ?>',
            },
            dataType: 'json',
            success: function(data) {

                $('#account_id').val(data.ID);
                $('#editusername').val(data.Username);
                $('#editpassword').val(data.Password);
                $('#editname').val(data.Name);
                $('#editEmail').val(data.Email);
                $('#editcontact').val(data.Contact);
                $('#place').hide();
                $('#account_form').show();
            },
      error:function(data){
        //Error Message == 'Title', 'Message body', Last one leave as it is
        swal("Error", "May error. I-refresh ang pahina at ulitin muli.", "error");
      }
        });
    });



    $('#edit_account').on("submit", function(event) {
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
            function() {

                $.ajax({
                    url: 'connections/actions',
                    type: 'post',
                    data: {
                        'action_add_account': 1,
                        'account_id': $('#account_id').val(),
                        'username': $('#editusername').val(),
                        'name': $('#editname').val(),
                        'email': $('#editEmail').val(),
                        'contact': $('#editcontact').val(),
                        'password': $('#editpassword').val(),
                    },
                    success: function(response) {
                        if ($.trim(response) == 'updated') {
                            setTimeout(function() {
                                swal({
                                    title: "Success",
                                    text: "Na-update na ang iyong profile. Mag login muli gamit ang iyong account.",
                                    type: "success"
                                }, function() {
                                    location.href = "logout";
                                });
                            }, 1);
                        }
                    },
      error:function(response){
        //Error Message == 'Title', 'Message body', Last one leave as it is
        swal("Error", "May error. I-refresh ang pahina at ulitin muli.", "error");
      }
                });

            });
   });
});




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
                  url: 'connections/actions',
                  type: 'post',
                  data: {
                    'action_add_account' : 1,
                    'account_id' : $('#account_id_moddify').val(),
                    'Username' : $('#Username').val(),
                    'name' : $('#name').val(),
                    'Email' : $('#Email').val(),
                    'contact' : $('#contact').val(),
                    'password' : $('#password').val(),
                  },
                  success: function(response){
                    if ($.trim(response) == 'saved') {  
                       setTimeout(function() {
                            swal({
                                title: "Success",
                                text: "The account has been saved.",
                                type: "success"
                            }, function() {                                
                                // showCustomer();
                                location.reload();
                                $('#account_id').val("");
                                $('#submit_account')[0].reset();
                                $('#bs-example-modal-lg').modal('hide');
                            });
                        }, 1);
                    }
                    else if ($.trim(response) == 'updated') {  
                       setTimeout(function() {
                            swal({
                                title: "Success",
                                text: "The account has been updated.",
                                type: "success"
                            }, function() {                                
                                // showCustomer();
                                location.reload();
                                $('#insert_account').val("Save");
                                $('#account_id').val("");
                                $('#submit_account')[0].reset();
                                $('#account_Modal').modal('hide');
                            });
                        }, 1);
                    }
                    else if ($.trim(response) == 'duplicate')
                    {
                         setTimeout(function() {
                            swal({
                                title: "Duplicated!",
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



     function delete_account(id)
    {

         swal({
              title: "Sigurado ka ba?",
              text: "Kapag na-delete na, hindi mo na mababawi ang account na ito!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Oo, tanggalin ito!",
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
            },
            function(){
                $.ajax({
                  url: 'connections/actions',
                  type: 'post',
                  data: {
                    'action_delete_accounts' : 1,
                    'id' : id,
                  },
                  success: function(response){
                    if ($.trim(response) == 'deleted') {  

                       setTimeout(function() {
                            swal({
                                title: "Success",
                                text: "The account has been deleted.",
                                type: "success"
                            }, function() {                                
                                // showCustomer();
                                location.reload();
                            });
                        }, 1);


                    }
                  }
                });
            });
    }





        </script>