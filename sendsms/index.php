<?php
require_once ('../connections/database.php');

date_default_timezone_set("Asia/Manila");
require 'autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;


  // Configure client
  $config = Configuration::getDefaultConfiguration();
  $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY1NzA5MzM5MiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjk1NTQ1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.DSRAOHrGhZn3X4OIo1YvunmhwgDK6VVXf7AqFlKb8VY');
  $apiClient = new ApiClient($config);
  $messageClient = new MessageApi($apiClient);





if (isset($_POST['declined_complaint']))
{

    $sql_search = "SELECT * FROM table_sumbong WHERE `Reference`='" . $_POST["reference"] . "'";
    $results_search = mysqli_query($conn, $sql_search);
    if (mysqli_num_rows($results_search) > 0) {
            while($row = mysqli_fetch_array($results_search))
                {
                    $name_declined_complaint=$row['Name'];          
                    $contact_declined_complaint=$row['Contact'];        
                    $email_declined_complaint=$row['Email'];           
                }
    }
   

    if($contact_declined_complaint != ''){

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $contact_declined_complaint,
            'message' => 'Magandang araw ' . $name_declined_complaint . ',' . PHP_EOL . ' Ang iyong reklamo ay hindi namin matatangap. Bumisita sa aming Barangay upang mag reklamo ng maayos.' . PHP_EOL . 'Maraming salamat sa kooperasyon. ' . PHP_EOL .'-Barangay Palanginan',
            'deviceId' => 128912
        ]);
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);
        
}
   
if ($email_declined_complaint != ''){
    $to = $email_declined_complaint;
    $subject = 'Online Oplan ISumbong Natin HelpDesk System - Denied Complaint';
    $headers = "From: brgy.palanginan@gmail.com" . "\r\n";
    $headers .= "Reply-To: brgy.palanginan@gmail.com";
    $msg = "Magandang araw " . $name_declined_complaint . "," . PHP_EOL . " Ang iyong reklamo ay hindi namin matatangap. Bumisita sa aming Barangay upang mag reklamo ng maayos." . PHP_EOL . "Maraming salamat sa kooperasyon. " . PHP_EOL ."-Barangay Palanginan";

    // send email
    mail($to,$subject,$msg,$headers);

}
   
    $query = "UPDATE table_sumbong SET `Status` = 'Declined' WHERE Reference = '" . $_POST["reference"] . "'";
    $result = mysqli_query($conn, $query);

    echo 'submitted';
    exit();

}

if (isset($_POST['approved_complaint']))
{
    $sql_search_approved = "SELECT * FROM table_sumbong WHERE `Reference`='" . $_POST["reference"] . "'";
    $results_search_approved = mysqli_query($conn, $sql_search_approved);
    if (mysqli_num_rows($results_search_approved) > 0) {
            while($row_approved = mysqli_fetch_array($results_search_approved))
                {
                    $name_approved_complaint=$row_approved['Name'];          
                    $contact_approved_complaint=$row_approved['Contact'];        
                    $email_approved_complaint=$row_approved['Email'];           
                }
    }
   
    

    if($contact_approved_complaint != ''){

        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $contact_approved_complaint,
            'message' => 'Magandang araw ' . $name_approved_complaint . ',' . PHP_EOL . ' Ang iyong reklamo ay naaprubahan na. Panatilihing bukas ang inyong telepono upang makatanggap ng tawag o text mula sa amin' . PHP_EOL . 'Maraming salamat sa kooperasyon. Reference Number : ' . $_POST["reference"] . PHP_EOL . '-Barangay Palanginan',
            'deviceId' => 128912
        ]);
        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);
        

    }
   
if ($email_approved_complaint != ''){
    $to = $email_approved_complaint;
    $subject = 'Online Oplan ISumbong Natin HelpDesk System - Denied Complaint';
    $headers = "From: brgy.palanginan@gmail.com" . "\r\n";
    $headers .= "Reply-To: brgy.palanginan@gmail.com";
    $msg = "Magandang araw " . $name_approved_complaint . "," . PHP_EOL . " Ang iyong reklamo ay naaprubahan na. Panatilihing bukas ang inyong telepono upang makatanggap ng tawag o text mula sa amin" . PHP_EOL . "Maraming salamat sa kooperasyon. Reference Number : " . $_POST["reference"] . PHP_EOL ."-Barangay Palanginan";

    // send email
    mail($to,$subject,$msg,$headers);

}
   
    $query = "UPDATE table_sumbong SET `Status` = 'Approved' WHERE Reference = '" . $_POST["reference"] . "'";
    $result = mysqli_query($conn, $query);

    echo 'submitted';
    exit();
}


?>