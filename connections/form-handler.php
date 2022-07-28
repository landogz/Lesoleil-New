<?php
   include 'database.php';



require '../sendsms/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;


  // Configure client
  $config = Configuration::getDefaultConfiguration();
  $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NzA5MzM5MiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1NTQ1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.DSRAOHrGhZn3X4OIo1YvunmhwgDK6VVXf7AqFlKb8VY');
  $apiClient = new ApiClient($config);
  $messageClient = new MessageApi($apiClient);



$fixedreference = $_POST['fixedreference'];
$fixed_datetime = $_POST['fixed_datetime-datepicker'];
// $purok = $_POST['purok'];
// $barangay = $_POST['barangay'];

// $email_from = $visitor_email;
// $email_subject = 'New Form Submission';
// $email_body = "User Name: $name.\n".
//               "User Email: $visitor_email.\n".
//               "Subject: $subject.\n".
//               "User Message: $message.\n";

// $to = 'rolan.benavidez@gmail.com';
// $headers = "From: $email_from \r\n";
// $headers .= "Reply-To: $visitor_email \r\n";
// mail($to,$email_subject,$email_body,$headers);


date_default_timezone_set('UTC');
$date = new DateTime();
$reference =  $date->getTimestamp();
$random = substr(md5(mt_rand()), 0, 10);
$target_dir = "../../img/";
$uploading= basename($_FILES["photo"]["name"]);
$uploading_agree= basename($_FILES["agreement"]["name"]);


   $imageFileType = pathinfo($uploading,PATHINFO_EXTENSION);   
   $imageFileType1 = pathinfo($uploading_agree,PATHINFO_EXTENSION);

      $names=$random.".".$imageFileType;
      $names_agree=$random.".".$imageFileType1;
      $target_file = $target_dir .$names ;
      $target_file_agree = $target_dir .$names_agree ;
   // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["agreement"]["tmp_name"], $target_file_agree)) {

$query = "UPDATE table_sumbong SET Status='Fixed' WHERE Reference = " . $fixedreference;
 $results = mysqli_query($conn, $query);

 $query_1 = "UPDATE table_summon SET Date_Fixed= '" . date("Y/m/d H:i:s") . "' , Photo= '" . $names . "',Agreement= '" . $names_agree . "' WHERE Reference = " . $fixedreference;
 $results_1 = mysqli_query($conn, $query_1);


                $results = mysqli_query($conn, $query);
                echo 'saved';
                exit();
        } 
        else {
          echo 'Sorry, there was an error uploading your files.';
        }


?>