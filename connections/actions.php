<?php 
	require_once ('database.php');



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


  function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
  }



date_default_timezone_set("Asia/Manila");
// START TABLES FUNCTION


		if (isset($_POST['action_delete_account']))
			{
			    $id = $_POST['id'];
			    $query = "UPDATE table_sumbong SET Status=1 WHERE ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

		if (isset($_POST['action_recieved_account']))
			{
			    $id = $_POST['id'];
			    $query = "UPDATE table_sumbong SET Status=0 WHERE ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

		if (isset($_POST['action_delete_accounts']))
			{
			    $id = $_POST['id'];
			    $query = "UPDATE table_user
							           SET Status= 'Inactive'
							           WHERE ID='" . $id  . "'";
			    $results = mysqli_query($conn, $query);

			      $sql_search = "SELECT * FROM table_user WHERE `ID`='" . $id . "'";
				    $results_search = mysqli_query($conn, $sql_search);
				    if (mysqli_num_rows($results_search) > 0) {
				            while($row = mysqli_fetch_array($results_search))
				                {
				                    $name_account=$row['Name'];            
 									$contact_account=$row['Contact'];            
				                }
				    }

				     if($contact_account  != ''){
			    $sendMessageRequest1 = new SendMessageRequest([
				            'phoneNumber' => $contact_account,
				            'message' => 'Magandang araw ' . $name_account  . ',' . PHP_EOL . ' Your account information is deleted by ' . PHP_EOL . 'Username : ' .  $_SESSION['username'] . PHP_EOL . 'Name : ' .  $_SESSION['name'],
				            'deviceId' => 128912
				        ]);
				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest1
				        ]);
        }


			    echo 'deleted';
			    exit();
			}



		if (isset($_POST['action_fetch_account']))
			{
			    $query = "SELECT * FROM table_user WHERE Username = '" . $_POST["account_ID"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}


		if (isset($_POST['verify_complaint']))
			{
			    $query = "SELECT * FROM table_sumbong WHERE Reference = '" . $_POST['id'] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);		        	
		        
			}


		if (isset($_POST['reprint_complaint']))
			{
			    $query = "SELECT * FROM table_sumbong WHERE Reference = '" . $_POST['id'] . "' and `Status` = 'Scheduled'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);		      
			}

		if (isset($_POST['show_complaints']))
			{
			    $query = "SELECT * FROM table_sumbong WHERE Reference = '" . $_POST["id"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}



// START Account FUNCTION
	if (isset($_POST['action_add_account']))
		{
		    $id = $_POST['account_id'];

		    if ($id == '')
		    {
		        $sql = "SELECT * FROM table_user WHERE `Username`='" . $_POST["Username"] . "'";
		        $results = mysqli_query($conn, $sql);
		        if (mysqli_num_rows($results) > 0)
		        {
		            echo 'duplicate';
		            exit();
		        }
		        else
		        {
		            $query = "INSERT INTO table_user(Username,Password, Name,Email,Contact,Date_Created)  
						           VALUES('" . $_POST["Username"] . "', '" . $_POST["password"] . "', '" . $_POST["name"] . "', '" . $_POST["Email"] . "', '" . $_POST["contact"] . "','" . date("Y/m/d H:i:s") . "');  
						           ";

		            $results = mysqli_query($conn, $query);


			        if($_POST["contact"]  != ''){
		              $sendMessageRequest1 = new SendMessageRequest([
				            'phoneNumber' => $_POST["contact"],
				            'message' => 'Magandang araw ' . $_POST["name"]  . ',' . PHP_EOL . ' Binabati kita! Mayroon ka nang account para sa Online Oplan ISumbong Natin HelpDesk System. Mangyaring mag-login sa sumusunod na impormasyon ng account:' . PHP_EOL . 'Username : ' .  $_POST["Username"] . PHP_EOL . 'Password : ' .  $_POST["password"],
				            'deviceId' => 128912
				        ]);

				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest1
				        ]);
				    }
        

		            echo 'saved';
		            exit();
		        }
		    }
		    else
		    {
		    	$query = "UPDATE table_user
							           SET Username='" . $_POST["username"] . "'  ,
							           Password='" . $_POST["password"] . "' , 
							           Name='" . $_POST["name"] . "' , 
							           Email='" . $_POST["email"] . "' , 
							           Contact='" . $_POST["contact"] . "' , 
							           Last_Update='" . date("Y/m/d H:i:s") . "'
							           WHERE ID='" . $_POST["account_id"] . "'";

			        $results = mysqli_query($conn, $query);

			        if($_POST["contact"]  != ''){
			        	 $sendMessageRequest1 = new SendMessageRequest([
				            'phoneNumber' => $_POST["contact"],
				            'message' => 'Magandang araw ' . $_POST["name"]  . ',' . PHP_EOL . ' Ang impormasyon ng iyong account para sa Online Oplan ISumbong Natin HelpDesk System ay nagbago. Mangyaring mag-login gamit ang sumusunod na impormasyon ng account:' . PHP_EOL . 'Username : ' .  $_POST["username"] . PHP_EOL . 'Password : ' .  $_POST["password"],
				            'deviceId' => 128912
				        ]);
				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest1
				        ]);
			        }
			        
        

			        echo 'updated';
			        exit();

		        
		    }

		}



	if (isset($_POST['add_summon']))
		{

			$sql_search = "SELECT * FROM table_sumbong WHERE `Reference`='" . $_POST["schedreference"]  . "'";
				    $results_search = mysqli_query($conn, $sql_search);
				    if (mysqli_num_rows($results_search) > 0) {
				            while($row = mysqli_fetch_array($results_search))
				                {
				                    $name_account=$row['Name'];            
 									$subject_account=$row['Subject'];      
 									$contact_account=$row['Contact'];            
				                }
				    }



		            $datesummon = date_format(date_create($_POST["datetime-datepicker"]),"F d, Y h:i a");

			        if($_POST["schedcontact"]  != ''){
		              $sendMessageRequest1 = new SendMessageRequest([
				            'phoneNumber' => $_POST["schedcontact"] ,
				            'message' => 'Magandang araw ' . $_POST["schedname"]  . ',' . PHP_EOL . 'Iniimbitahan ka namin mag pumunta sa ating Barangay sa darating na ' . $datesummon . PHP_EOL . 'Reference Number : ' .  $_POST["schedreference"] . PHP_EOL . 'Complainant : ' .  $name_account . PHP_EOL . 'Subject : ' .  $subject_account . PHP_EOL . PHP_EOL .'-Barangay Palanginan',
				            'deviceId' => 128912
				        ]);

				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest1
				        ]);
				    }

				    if($contact_account != ''){
		              $sendMessageRequest2 = new SendMessageRequest([
				            'phoneNumber' => $contact_account,
				            'message' => 'Magandang araw ' . $name_account . ',' . PHP_EOL . 'Iniimbitahan ka namin mag pumunta sa aming Barangay sa darating na ' . $datesummon . PHP_EOL .  'Reference Number : ' .  $_POST["schedreference"] . PHP_EOL .'Respondent : ' .  $_POST["schedname"] . PHP_EOL . 'Subject : ' .  $subject_account . PHP_EOL . PHP_EOL .'-Barangay Palanginan',
				            'deviceId' => 128912
				        ]);

				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest2
				        ]);
				    }

				    
		            $query = "INSERT INTO table_summon(Reference,Name, Contact,Street,Purok,`DateTime`)  
						           VALUES('" . $_POST["schedreference"] . "', '" . $_POST["schedname"] . "', '" . $_POST["schedcontact"] . "', '" . $_POST["schedstreet"] . "', '" . $_POST["schedpurok"] . "','" . $_POST["datetime-datepicker"] . "');";

		            $results = mysqli_query($conn, $query);

		            $query = "UPDATE table_sumbong SET Status='Scheduled' WHERE Reference = " .  $_POST["schedreference"] ;
			  		  $results = mysqli_query($conn, $query);
        

		            echo 'saved';
		            exit();
		        
		    }
		

if (isset($_POST['action_fetch_summon']))
			{
				if($_POST["search"] == '')
				{
				$sql = "SELECT *,table_summon.Name as `Res_Name`,table_sumbong.Name as `com_Name`
				FROM table_sumbong
				INNER JOIN table_summon
				ON table_sumbong.Reference = table_summon.Reference where table_sumbong.Status='Scheduled' order by `DateTime` ASC";
				}
				else{
					$sql = "SELECT *,table_summon.Name as `Res_Name`,table_sumbong.Name as `com_Name` FROM table_sumbong INNER JOIN table_summon ON table_sumbong.Reference = table_summon.Reference where table_sumbong.Reference like '%" . $_POST["search"] . "%' or table_sumbong.Name like '%" . $_POST["search"] . "%' or table_summon.Name like '%" . $_POST["search"] . "%' or table_sumbong.Email like '%" . $_POST["search"] . "%'	or table_sumbong.Subject like '%" . $_POST["search"] . "%' or table_sumbong.Date like '%" . $_POST["search"] . "%' or table_sumbong.Contact like '%" . $_POST["search"] . "%' or table_summon.Contact like '%" . $_POST["search"] . "%'   or table_summon.Street like '%" . $_POST["search"] . "%'  or table_summon.Purok like '%" . $_POST["search"] . "%'  or table_summon.DateTime like '%" . $_POST["search"] . "%' and table_sumbong.Status='Scheduled' order by `DateTime` ASC";
				}
				 

											 $results = mysqli_query($conn, $sql);
											  if (mysqli_num_rows($results) > 0) {
								               while($row = mysqli_fetch_array($results))
								                   { ?>

								                   	<article class="pricing-column col-xl-3 col-md-6">
				                                        <div class="ribbon"><span><?php echo addOrdinalNumberSuffix(htmlentities($row["Attempt"])); ?> Attempt</span></div>
				                                            <div class="card">
				                                                <div class="card-body">
				                                                    <h3 class="card-title">&nbsp Reference # : <?php echo  htmlentities($row["Reference"]); ?></h3>
				                                                    <h5 class="card-title"><?php echo  htmlentities($row["com_Name"]); ?> <span class="badge bg-danger">VS</span> <?php echo  htmlentities($row["Res_Name"]); ?></h5>
				                                                    <h5 class="card-title"><?php echo  htmlentities(date_format(date_create($row["DateTime"]),"F d, Y h:i a")); ?></h5>

				                                                </div>
				                                                <?php 

				                                                $supported_image = array(
																    'gif',
																    'jpg',
																    'jpeg',
																    'png'
																);

				                                                $ext = strtolower(pathinfo($row["File_Name"], PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
																	if (in_array($ext, $supported_image)) {
																	    ?>
																	     <img class="img-fluid" src="../img/<?php echo  htmlentities($row["File_Name"]); ?>" alt="Card image cap" style="height: 250px !important;">

																	    <?php
																	} else {
																	    ?>
																	    								 <video id="evidence_video"  width="400" controls style="width: 100%;height: 250px;">
				                                                                                            <source  id="evidence_video" src="../img/<?php echo  htmlentities($row["File_Name"]); ?>">
				                                                                                            Your browser does not support HTML video.
				                                                                                            </video>

																	    <?php
																	}
				                                                ?>
				                                               
				                                                <div class="card-body text-center">
				                                                	<h4 class="card-title"><?php echo  htmlentities($row["Subject"]); ?> </h4>
				                                                    <textarea class="form-control" id="example-textarea" rows="5" readonly=""><?php echo  htmlentities($row["Message"]); ?></textarea><br>
				                                                     <button type="button" class="btn btn-warning rounded-pill waves-effect waves-light" onclick="resched(<?php echo $row["Reference"]; ?>)">
				                                                        <span class="btn-label"><i class="mdi mdi-calendar-account"></i></span>Re-Schedule
				                                                    </button>
				                                                    <button type="button" class="btn btn-success rounded-pill waves-effect waves-light" onclick="fixed(<?php echo $row["Reference"]; ?>)">
				                                                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Fixed
				                                                    </button>
				                                                </div>
				                                            </div>
				                                    </article>

								                   <?php }
								               }
								               else{?>
                    <div class="col-md-12 col-lg-12 col-xl-12"> 
                        <div class="card">
                            <div class="card-body p-4">                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0 mb-3">THERE ARE NO RECORD IN THE LIST</h4>
                                </div>       
                            </div>
                        </div>
                    </div> 

            <?php }
			}




if (isset($_POST['resched_submit']))
			{
			    $ref = $_POST['reschedreference'];
			    $date = $_POST['rescheddate'];
			    $query = "UPDATE table_summon SET Attempt=Attempt+1 , `DateTime`= '$date' WHERE Reference = " . $ref;
			    $results = mysqli_query($conn, $query);



			    $sql_search = "SELECT *,table_summon.Name as `Res_Name`,table_sumbong.Name as `com_Name`,table_sumbong.Contact as `com_contact`,table_summon.Contact as `res_contact`
				FROM table_sumbong
				INNER JOIN table_summon
				ON table_sumbong.Reference = table_summon.Reference WHERE table_sumbong.Reference ='" . $_POST["reschedreference"]  . "'";

				    $results_search = mysqli_query($conn, $sql_search);
				    if (mysqli_num_rows($results_search) > 0) {
				            while($row = mysqli_fetch_array($results_search))
				                {
				                    $name_com=$row['com_Name'];   
				                    $name_res=$row['Res_Name'];           
 									$subject_account=$row['Subject'];      
 									$contact_com=$row['com_contact'];    
 									$contact_res=$row['res_contact'];            
				                }
				    }



		            $datesummon = date_format(date_create($date),"F d, Y h:i a");

			        if($contact_res  != ''){
		              $sendMessageRequest1 = new SendMessageRequest([
				            'phoneNumber' => $contact_res ,
				            'message' => 'Magandang araw ' . $name_res  . ',' . PHP_EOL . 'Iniimbitahan ka namin mag pumunta sa ating Barangay sa darating na ' . $datesummon . PHP_EOL . 'Reference Number : ' .   $ref . PHP_EOL . 'Complainant : ' .  $name_com . PHP_EOL . 'Subject : ' .  $subject_account . PHP_EOL . PHP_EOL .'-Barangay Palanginan',
				            'deviceId' => 128912
				        ]);

				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest1
				        ]);
				    }

				    if($contact_com != ''){
		              $sendMessageRequest2 = new SendMessageRequest([
				            'phoneNumber' => $contact_com,
				            'message' => 'Magandang araw ' . $name_com . ',' . PHP_EOL . 'Iniimbitahan ka namin mag pumunta sa aming Barangay sa darating na ' . $datesummon . PHP_EOL .  'Reference Number : ' .   $ref . PHP_EOL .'Respondent : ' .  $name_res . PHP_EOL . 'Subject : ' .  $subject_account . PHP_EOL . PHP_EOL .'-Barangay Palanginan',
				            'deviceId' => 128912
				        ]);

				        $sendMessages = $messageClient->sendMessages([
				            $sendMessageRequest2
				        ]);
				    }




			    echo 'updated';
			    exit();
			}




if (isset($_POST['show_report']))
			{
				if($_POST['id'] == 'incoming'){ 
				$query = "SELECT * FROM table_sumbong where `Status` = 2 ORDER BY `File_Name` DESC , `Date` ASC";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);

}
			}





















	if (isset($_POST['action_add_tables']))
		{
		    $id = $_POST['table_id'];

		    if ($id == '')
		    {
		        $sql = "SELECT * FROM table_tables WHERE `Table_Name`='" . $_POST["name"] . "'";
		        $results = mysqli_query($conn, $sql);
		        if (mysqli_num_rows($results) > 0)
		        {
		            echo 'duplicate';
		            exit();
		        }
		        else
		        {
		            $query = "INSERT INTO table_tables(Table_Name, Description)  
						           VALUES('" . $_POST["name"] . "', '" . $_POST["Description"] . "');  
						           ";

		            $results = mysqli_query($conn, $query);
		            echo 'saved';
		            exit();
		        }
		    }
		    else
		    {
		    	$query = "UPDATE table_tables   
							           SET Table_Name='" . $_POST["name"] . "'  ,
							           Description='" . $_POST["Description"] . "'  
							           WHERE ID='" . $_POST["table_id"] . "'";

			        $results = mysqli_query($conn, $query);
			        echo 'updated';
			        exit();

		        
		    }

		}

		if (isset($_POST['action_fetch_tables']))
			{
			    $query = "SELECT * FROM table_tables WHERE ID = '" . $_POST["table_ID"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}

		if (isset($_POST['action_delete_tables']))
			{
			    $id = $_POST['id'];
			    $query = "DELETE FROM table_tables where ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

// END TABLES FUNCTION


// START CATEGORY FUNCTION
	if (isset($_POST['action_add_category']))
		{
		    $id = $_POST['category_id'];

		    if ($id == '')
		    {
		        $sql = "SELECT * FROM table_category WHERE `Category`='" . $_POST["name"] . "'";
		        $results = mysqli_query($conn, $sql);
		        if (mysqli_num_rows($results) > 0)
		        {
		            echo 'duplicate';
		            exit();
		        }
		        else
		        {
		            $query = "  
						           INSERT INTO table_category(Category, Description)  
						           VALUES('" . $_POST["name"] . "', '" . $_POST["Description"] . "');  
						           ";

		            $results = mysqli_query($conn, $query);
		            echo 'saved';
		            exit();
		        }
		    }
		    else
		    {
		    	$query = "		   UPDATE table_category 
							           SET Category='" . $_POST["name"] . "'  ,
							           Description='" . $_POST["Description"] . "'  
							           WHERE ID='" . $_POST["category_id"] . "'";

			        $results = mysqli_query($conn, $query);
			        echo 'updated';
			        exit();

		        
		    }

		}

		if (isset($_POST['action_fetch_category']))
			{
			    $query = "SELECT * FROM table_category WHERE ID = '" . $_POST["category_ID"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}

		if (isset($_POST['action_delete_category']))
			{
			    $id = $_POST['id'];
			    $query = "DELETE FROM table_category where ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

// END CATEGORY FUNCTION


// START Mode of Payment FUNCTION
	if (isset($_POST['action_add_MOP']))
		{
		    $id = $_POST['MOP_id'];

		    if ($id == '')
		    {
		        $sql = "SELECT * FROM table_MOP WHERE `MOP`='" . $_POST["name"] . "'";
		        $results = mysqli_query($conn, $sql);
		        if (mysqli_num_rows($results) > 0)
		        {
		            echo 'duplicate';
		            exit();
		        }
		        else
		        {
		            $query = "  
						           INSERT INTO table_MOP(MOP, Status)  
						           VALUES('" . $_POST["name"] . "', '" . $_POST["status"] . "');  
						           ";

		            $results = mysqli_query($conn, $query);
		            echo 'saved';
		            exit();
		        }
		    }
		    else
		    {
		    	$query = "		   UPDATE table_MOP
							           SET MOP='" . $_POST["name"] . "'  ,
							           Status='" . $_POST["status"] . "'  
							           WHERE ID='" . $_POST["MOP_id"] . "'";

			        $results = mysqli_query($conn, $query);
			        echo 'updated';
			        exit();

		        
		    }

		}

		if (isset($_POST['action_fetch_MOP']))
			{
			    $query = "SELECT * FROM table_MOP WHERE ID = '" . $_POST["MOP_ID"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}

		if (isset($_POST['action_delete_MOP']))
			{
			    $id = $_POST['id'];
			    $query = "DELETE FROM table_MOP where ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

// END Mode of Payment FUNCTION





// END Account FUNCTION


// START SETTINGS FUNCTION
			if (isset($_POST['action_save_settings']))
			{
			    $query = "UPDATE table_settings SET Store_Name='" . $_POST["storename"] . "',Address='" . $_POST["address"] . "',TIN='" . $_POST["tin"] . "',Zip='" . $_POST["zip"] . "',Email='" . $_POST["email"] . "',Website='" . $_POST["Website"] . "',System_Name='" . $_POST["systemname"] . "',POS='" . $_POST["pos"] . "',Service_Charge='" . $_POST["charge"] . "',Senior_discount='" . $_POST["senior"] . "',PWD_discount='" . $_POST["pwd"] . "'";
			    $results = mysqli_query($conn, $query);
			    echo 'saved';
			    exit();
			}
// END SETTINGS FUNCTION


// START RESET PASSWORD FUNCTION
			if (isset($_POST['action_reset_account']))
			{
			    $query = "UPDATE table_account SET Password='1234' where ID =" . $_POST['account_ID'];
			    $results = mysqli_query($conn, $query);
			    echo 'updated';
			    exit();
			}
// END  RESET PASSWORD FUNCTION


// START INVENTORY FUNCTION
			if (isset($_POST['action_show_inventory']))
			{
			    $query = "SELECT * FROM table_inventory";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}


	if (isset($_POST['action_add_inventory']))
		{

		    $id = $_POST['inventory_id'];

		    if ($id == '')
		    {
		        $sql = "SELECT * FROM table_inventory WHERE `Item`='" . $_POST["name"] . "'";
		        $results = mysqli_query($conn, $sql);
		        if (mysqli_num_rows($results) > 0)
		        {
		            echo 'duplicate';
		            exit();
		        }
		        else
		        {
		            $query = "  
						           INSERT INTO table_inventory(Item, Stock, Unit, Status,Last_Update)  
						           VALUES('" . $_POST["name"] . "', '" . $_POST["stock"] . "', '" . $_POST["unit"] . "','" . $_POST["status"] . "', '" . date("Y/m/d H:i:s") . "');";

		            $results = mysqli_query($conn, $query);
		            echo 'saved';
		            exit();
		        }
		    }
		    else
		    {
		    	$query = "UPDATE table_inventory
							           SET Item='" . $_POST["name"] . "'  ,
							           Unit='" . $_POST["unit"] . "' , 
							           Stock='" . $_POST["stock"] . "' , 
							           Status='" . $_POST["status"] . "', 
							           Last_Update='" . date("Y/m/d H:i:s")  . "'
							           WHERE ID='" . $_POST["inventory_id"] . "'";

			        $results = mysqli_query($conn, $query);
			        echo 'updated';
			        exit();

		        
		    }

		}


	if (isset($_POST['action_add_inventory_stock']))
		{ 
			$total_stock  = $_POST["currentstock1"] + $_POST["itemstock"] ;

		    	$query = "UPDATE table_inventory
							           SET Stock='" . $total_stock . "'  ,
							           Last_Update='" . date("Y/m/d H:i:s")  . "',
							           Status='Available'
							           WHERE ID='" . $_POST["inventory_add_id"] . "'";

			        $results = mysqli_query($conn, $query);

					$query = "INSERT INTO table_stockin(Inventory_ID, Stock, Date)  
					VALUES('" . $_POST["inventory_add_id"] . "', '" . $_POST["itemstock"]  . "','" . date("Y/m/d H:i:s") . "');";

			        $results = mysqli_query($conn, $query);
			        echo 'saved';
			        exit();

		}


		if (isset($_POST['action_fetch_inventory']))
			{
			    $query = "SELECT * FROM table_inventory WHERE ID = '" . $_POST["inventory_ID"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}

		if (isset($_POST['action_delete_inventory']))
			{
			    $id = $_POST['id'];
			    $query = "DELETE FROM table_inventory where ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

// END  INVENTORY FUNCTION
 



// START PRODUCT FUNCTION
		if (isset($_POST['action_fetch_product']))
			{
			    $query = "SELECT * FROM table_products WHERE ID = '" . $_POST["product_id"] . "'";
			    $result = mysqli_query($conn, $query);
			    $row = mysqli_fetch_array($result);
			    echo json_encode($row);
			}

		if (isset($_POST['action_fetch_inventory_from_product']))
			{
				$sql = "SELECT * FROM table_inventory where `Status` ='Available'";
                                          $result = $conn->query($sql);
                                          while($row = $result->fetch_assoc()) { ?>
                                            <?php 
                                              $unitss ='';
                                                if($row["Unit"] == 'kg'){$unitss = 'Kilogram (kg)';}elseif($row["Unit"] == 'g'){$unitss = 'Gram (g)';}elseif($row["Unit"] == 'l'){$unitss = 'Liter (l)';}elseif($row["Unit"] == 'ml'){$unitss = 'Milliliter (ml)';}elseif($row["Unit"] == 'btl'){$unitss = 'Bottle (btl)';}elseif($row["Unit"] == 'pc'){$unitss = 'Pieces (pc)';}elseif($row["Unit"] == 'serving'){$unitss = 'Serving';}elseif($row["Unit"] == 'slc'){$unitss = 'Slice (slc)';}
                                                 ?>

                                                 <?php 
                                                $sql_ingredients = "SELECT * FROM table_ingredients where `Inventory_ID` = " . $row["ID"] . " and `Product_ID` = " . $_POST["product_id"];
                                          		$result_ingredients = mysqli_query($conn, $sql_ingredients);
      											if (mysqli_num_rows($result_ingredients) == 0) { 

      												?>


                                            <tr>    
                                             <td><?php echo  htmlentities($row["Item"]); ?></td>
                                            <td> 
                                              <div class="form-group">
                                                <div class="input-group">
                                                  <input type="number" class="form-control" name="quanityadd<?php echo $row["ID"]; ?>" id="quanityadd<?php echo $row["ID"]; ?>" value="0">
                                                  <div class="input-group-append">
                                                  <span class="input-group-text"><?php echo $row['Unit'];?></span>
                                                  <button style="width: 100px;" type="button" class="btn btn-primary btn-rounded text-white btn-sm add_ingredients" id="<?php echo $row["ID"]; ?>"><i class="fas fa-plus-circle"></i> Add</button>
                                                </div>
                                                </div>
                                              </div>
                                              </td>
                                          </tr>



      										<?php	} ?>

                                            <?php
                                           
                                              
                                           }
			}

	if (isset($_POST['action_add_product']))
		{ 

		    	 $query = " 	INSERT INTO table_products(Category_ID, Product, Price, Status)  
						        VALUES('" . $_POST["category"] . "', '" . $_POST["name"] . "', '" . $_POST["price"] . "','" . $_POST["status"] . "');";

			        $results = mysqli_query($conn, $query);

			        $query = "SELECT * from table_products order by ID DESC LIMIT 1";
				    $result = mysqli_query($conn, $query);
				    $row = mysqli_fetch_array($result);
				    echo json_encode($row);
			        exit();

		}

	if (isset($_POST['action_update_product']))
		{ 

		    	 $query = "UPDATE table_products
							           SET Product='" . $_POST["productname"] . "'  ,
							           Price='" . $_POST["price"]  . "',
							           Status='" . $_POST["status"]  . "'
							           WHERE ID='" . $_POST["id"] . "'";

			        $results = mysqli_query($conn, $query);
			        echo 'updated';
			        exit();

		}

		if (isset($_POST['action_delete_product']))
			{
			    $id = $_POST['id'];
			    $query = "DELETE FROM table_products where ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}

	if (isset($_POST['action_add_ingredients']))
		{ 

		    	 $query = "INSERT INTO table_ingredients(Product_ID, Inventory_ID, Quantity)  
						        VALUES('" . $_POST["product_id"] . "', '" . $_POST["inventory_id"] . "', '" . $_POST["qty"] . "');";

			        $results = mysqli_query($conn, $query);
			        echo 'added';
			        exit();

		}

if (isset($_POST['action_fetch_ingredients']))
			{
				$sql = "SELECT *,table_ingredients.ID as `Ingredients ID`,Item,Quantity,Unit from table_ingredients
						inner join table_products on
						table_ingredients.Product_ID = table_products.ID
						inner join table_inventory on
						table_ingredients.Inventory_ID = table_inventory.ID where `Product_ID` = " . $_POST["product_id"];
                                          $result = $conn->query($sql);
                                          while($row = $result->fetch_assoc()) { ?>
                                            <?php 
                                              $unitss ='';
                                                if($row["Unit"] == 'kg'){$unitss = 'Kilogram (kg)';}elseif($row["Unit"] == 'g'){$unitss = 'Gram (g)';}elseif($row["Unit"] == 'l'){$unitss = 'Liter (l)';}elseif($row["Unit"] == 'ml'){$unitss = 'Milliliter (ml)';}elseif($row["Unit"] == 'btl'){$unitss = 'Bottle (btl)';}
                                                 ?>
                                            <tr>    
                                             <td><?php echo  htmlentities($row["Item"]); ?></td>
                                            <td> 
                                              <div class="form-group">
                                                <div class="input-group">
                                                  <input type="number" class="form-control" name="quanityupdate<?php echo $row["Ingredients ID"]; ?>" id="quanityupdate<?php echo $row["Ingredients ID"]; ?>" value="<?php echo ($row["Quantity"]); ?>">
                                                  <div class="input-group-append">
                                                  <span class="input-group-text"><?php echo $row['Unit'];?></span>
                                                  <button style="width: 100px;" type="button" class="btn btn-warning btn-rounded text-white btn-sm update_ingredients" id="<?php echo $row["Ingredients ID"]; ?>"><i class="fas fa-save"></i></button>
                                                  <button style="width: 100px;" type="button" class="btn btn-danger btn-rounded text-white btn-sm" id="<?php echo $row["Ingredients ID"]; ?>" onclick="delete_ingredients(<?php echo $row["Ingredients ID"]; ?>)"><i class="fas fa-trash"></i></button>
                                                </div>
                                                </div>
                                              </div>
                                              </td>
                                          </tr>

                                            <?php
                                           
                                              
                                           }
			}


		if (isset($_POST['action_delete_ingredients']))
			{
			    $id = $_POST['id'];
			    $query = "DELETE FROM table_ingredients where ID = " . $id;
			    $results = mysqli_query($conn, $query);
			    echo 'deleted';
			    exit();
			}


	if (isset($_POST['action_update_ingredients']))
		{ 

		    	 $query = "UPDATE table_ingredients
							           SET Quantity='" . $_POST["qty"] . "'
							           WHERE ID='" . $_POST["inventory_id"] . "'";

			        $results = mysqli_query($conn, $query);
			        echo 'updated';
			        exit();

		}
?>