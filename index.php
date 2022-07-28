<?php 
      include 'connections/database.php';
    error_reporting(0);
    $isAlert=0;
      $alert = "";
       if(isset($_POST['username'])){
       $username = $_POST['username'];
       $password = $_POST['password'];
       
       $sql = "SELECT * FROM table_account WHERE `Username`='$username' and `password` = '$password' and `Privilege` = 'Administrator'";
       $results = mysqli_query($conn, $sql);
       if (mysqli_num_rows($results) > 0) {
               while($row = mysqli_fetch_array($results))
                   {
                       $_SESSION['empID']=$row['ID'];
                       $_SESSION['name']=$row['Name'];
                       $_SESSION['email']=$row['Email'];
                       $_SESSION['date']=$row['Date_Created'];
                       $_SESSION['priv']=$row['Privilege'];
                   }
                echo "<script type='text/javascript'>window.top.location='dashboard';</script>";
       }
       else{
            $alert="Username or password is incorrect.";
            $isAlert=1;
         }
       }
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Jul 2022 10:01:52 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Log In | Le Soleil et La Lune</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo.jpg">

		<!-- App css -->

		<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

		<!-- icons -->
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages my-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center">   
                            <a href="index">
                                <img src="assets/images/logo.jpg" alt="" height="100" class="mx-auto">
                            </a>
                            <p class="text-muted mt-2 mb-4">Le Soleil et La Lune</p>

                        </div>
                        <div class="card">
                            <div class="card-body p-4">
                                     <div class="login-box-msg text-center" <?php if($isAlert!=0){ echo "style='color:red;text-align:center;'";} ?>><b><?php echo $alert; ?></b></div>

<br>
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>

                            
                                 <form method="post">
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" required="" placeholder="Enter your username">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 d-grid text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

             
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Jul 2022 10:01:53 GMT -->
</html>