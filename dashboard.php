<?php 
    require_once('connections/database.php'); 
    require_once('connections/Page_Restriction.php');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title><?php echo $System_Name; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
      <meta content="Coderthemes" name="author" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <link rel="shortcut icon" href="assets/images/logo.jpg">
      <?php include 'assets/subpage/styles.php'; ?>
   </head>
   <body class="loading" data-layout-mode="horizontal" data-layout-color="light" data-layout-size="fluid" data-topbar-color="dark" data-leftbar-position="fixed">
      <div id="preloader">
         <div id="status">
            <div class="spinner">Loading...</div>
         </div>
      </div>
      <div id="wrapper">
         <?php include 'assets/subpage/logged.php'; ?>
         <div class="content-page">
            <div class="content" id="content">
               
            </div>
            <?php include 'assets/subpage/footer.php'; ?> 
         </div>
      </div>
      <div class="rightbar-overlay"></div>
      <?php include 'assets/subpage/scripts.php'; ?> 
   </body>
</html>