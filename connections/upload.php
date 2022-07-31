<?php 
require_once('database.php');
date_default_timezone_set('UTC');

$art = array();
  $random = substr(md5(mt_rand()), 0, 10);

    $target_dir = "../photos/";
    $uploading= basename($_FILES["profile_pic"]["name"]);

     $imageFileType = pathinfo($uploading,PATHINFO_EXTENSION);

      $names=$random.$_SESSION['product_id'].".".$imageFileType;
      $target_file = $target_dir .$names ;
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" ) {
        $art[]= "Sorry  your file was not uploaded, only  JPG, JPEG, PNG are allowed.";
    }
    else{
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {

           $query = "UPDATE table_products SET Image='".$names."' WHERE ID=".$_SESSION['product_id'];       
           $results = mysqli_query($conn, $query);
           $_SESSION['Image']=$names;
           $art[]= "Files has been Save!";
        } 
        else {
          $art[]= "Sorry, there was an error uploading your files.";
        }
    }

print_r( json_encode($art));
?>
