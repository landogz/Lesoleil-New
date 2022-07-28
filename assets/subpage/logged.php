<?php
   require_once('connections/database.php');
   require_once('connections/Page_Restriction.php');
   ?>

<style type="text/css">
    .is-loading {
  .image,
  h2,
  p {
    background: #eee;
    background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
    border-radius: 5px;
    background-size: 200% 100%;
    animation: 1.5s shine linear infinite;
  }

  .image {
    height: 200px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  h2 {
    height: 30px;
  }

  p {
    height: 70px;
  }
}
</style>

 <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                     
<ul class="list-unstyled topnav-menu float-end mb-0">

            
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/man-300x300.png" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    <?php echo $_SESSION['name']; ?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item" data-bs-toggle="modal" data-bs-target="#editprofile">
                                    <i class="fe-user"></i>
                                    <span>Edit Profile</span>
                                </a>
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="logout" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
    
                            </div>
                        </li>
    
                    </ul>

                      <!-- LOGO -->
                    <div class="logo-box">
               

                        <a href="dashboard" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="assets/images/logo.jpg" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo.jpg" alt="" height="60"><span class="brand-text font-weight-light"  style="font-size: 20px;font-family: Karla,sans-serif; color:white; font-weight: 600;">&nbsp Le Soleil et La Lune</span>
                            </span>
                        </a>
                        <a href="dashboard" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="assets/images/logo.jpg" alt="" height="50">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo.jpg" alt="" height="60">
                            </span>
                        </a>

                    </div>

                  
                    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
             
                    </ul>

                    <div class="clearfix"></div> 
        
                </div>
              
            </div>
            <!-- end Topbar -->




                        <!--  Modal content for the Large example -->
                                        <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Oplan ISumbong Natin</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                            <div class="card-body">
                                                                <h4 class="header-title">Edit Profile</h4>
                                                                <p class="text-muted font-14">
                                                                    Ibahin ang iyong impormasyon
                                                                </p>

                                                                <div class="card-body" id="place">
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


                                                                <form role="form" class="parsley-examples" method="post" id="edit_account" class="form-material" >
                                                                    <div style="display: none" id="account_form">
                                                                    <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Username : <span class="text-danger">*</span></label>
                                                                        <div class="col-7">
                                                                            <input type="text" parsley-type="text" class="form-control" id="editusername" placeholder="Enter Username" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Full Name : <span class="text-danger">*</span></label>
                                                                        <div class="col-7">
                                                                            <input type="text" required parsley-type="text" class="form-control" id="editname" placeholder="Enter Full Name" />
                                                                        </div>
                                                                    </div>
                                                                   <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Email : </label>
                                                                        <div class="col-7">
                                                                            <input type="Email"  parsley-type="Email" class="form-control" id="editEmail" placeholder="Enter Email" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="name" class="col-4 col-form-label">Contact Number : </label>
                                                                         <div class="col-7">
                                                                            <input type="text"  parsley-type="text" class="form-control" id="editcontact" placeholder="Enter Contact Number" />
                                                                        </div>
                                                                    </div>
                                                                     <div class="row mb-3">
                                                                    
                                                                    <label for="editpassword" class="col-4 col-form-label">Enter Password : <span class="text-danger">*</span></label>
                                                                        <div class="col-4">
                                                                        <input type="text" required   parsley-type="text" class="form-control" id="editpassword" placeholder="Enter Password" />
                                                                        </div>
                                                                        <div class="col-3">
                                                                             <button type="button" class="btn btn-primary waves-effect waves-light" onclick="genEditPassword()">Generate Password</button>
                                                                        </div>
                                                                      
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                         <input type="hidden" name="account_id" id="account_id" /> 
                                                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Update Profile</button>
                                                    </div>

                                                                </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
            
        <script type="text/javascript">

        var password=document.getElementById("editpassword");

         function genEditPassword() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";
         for (var i = 0; i <= passwordLength; i++) {
           var randomNumber = Math.floor(Math.random() * chars.length);
           password += chars.substring(randomNumber, randomNumber +1);
          }
                document.getElementById("editpassword").value = password;
         }





        </script>



           <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown active">
                                    <a class="nav-link arrow-none" href="#" id="topnav-dashboard" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-view-dashboard me-1"></i> Dashboard
                                    </a>
                        
                                </li>


                                <li class="nav-item dropdown">
                                    <a class="nav-link arrow-none" href="#" id="topnav-inventory" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-warehouse me-1"></i> Inventory
                                    </a>
                        
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-database-arrow-down me-1"></i> Data Entry <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu active" aria-labelledby="topnav-layout">
                                        <a href="#" id="product" class="dropdown-item">Manage Product</a>
                                        <a href="#" id="category" class="dropdown-item">Manage Category</a>
                                        <a href="#" id="table" class="dropdown-item">Manage Table</a>
                                        <a href="#" id="payment" class="dropdown-item">Mode of Payment</a>
                                    </div>
                                </li> 

                                 <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-clipboard-file me-1"></i> Records <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu active" aria-labelledby="topnav-layout">
                                        <a href="#" id="sales" class="dropdown-item">Sales Report</a>
                                        <a href="#" id="best" class="dropdown-item">Best Selling</a>
                                        <a href="#" id="stocks" class="dropdown-item">Stock in History</a>
                                        <a href="#" id="unsettled" class="dropdown-item">Unsettled Order</a>
                                        <a href="#" id="audit" class="dropdown-item">Audit Trail</a>
                                    </div>
                                </li> 

                                 <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-lifebuoy me-1"></i> Maintenance <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu active" aria-labelledby="topnav-layout">
                                        <a href="#" id="settings" class="dropdown-item">System Settings</a>
                                        <a href="#" id="accounts" class="dropdown-item">User Accounts</a>
                                    </div>
                                </li> 


                            </ul> <!-- end navbar-->
                        </div> <!-- end .collapsed-->
                    </nav>
                </div> <!-- end container-fluid -->
            </div> <!-- end topnav-->