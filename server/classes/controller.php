<?php
session_start();
require_once 'processrequest.php';
$processRequest = new processRequest;

require_once 'fetchData.php';
$fetchData = new fetchData;

require_once 'insertData.php';
$insertData = new insertData;

require_once 'updateData.php';
$updateData = new updateData;

require_once 'deleteData.php';
$deleteData = new deleteData;

$requestingPage = stripslashes($_GET['_mode']);


$date =  date("d/m/Y");
switch ($requestingPage) {

	case "email-verify":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$email = $processRequest->test_input($_POST['email']);

			if (empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'message'=>"*email is required and must be a valid email format");
			}
			
			else {

				$fetchResponse = $fetchData->registerCheck($email);
				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status']) && $fetchResponse['status'] ==1){

						$response = array('status'=>0,'input'=>"details",'message'=>"A User already exist with this email. ");
					}else {
						$code = rand(11111,99999);
						$expires = date("d-m-Y", time() + 86400);
						$insertResponse = $insertData->addVerificationEmail($email,$code,$expires);

						if ($insertResponse['status']) {
							// Send Verification Link to email
							$response = array('status'=>1,'message'=>"A Verification Email Has Been Sent To Your Email. Please Follow The Verification Link From Your Email To Complete Your Registration Process");

						}else {
							$response = array('status'=>0, 'message'=>$insertResponse['message']);
						}
					}


				}
			}	
		}	
	
	break;


	case "register":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$name = $processRequest->test_input($_POST['name']);
			$email = $processRequest->test_input($_POST['email']);
			$phone = $processRequest->test_input($_POST['phone']);
			$password = $processRequest->test_input($_POST['password']);
			$confirmPass = $processRequest->test_input($_POST['confirm-password']);

			if (empty($name) or (!preg_match("/^[a-zA-Z ]+$/i",$name))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Name is required and must contain only alphabets");
			}

			elseif(empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'message'=>"Valid email is required ");
			}elseif (empty($phone)) {
				$response = array('status'=>0,'message'=>"Valid Phone Number Is Required ");
			}
			elseif (empty($password)) {
				$response = array('status'=>0,'message'=>"password is required ");
			}
			elseif ($password != $confirmPass) {
				$response = array('status'=>0,'message'=>" Password Mismatch, Password must match confirm password ");
			}

			else {
				$password = password_hash($password, PASSWORD_DEFAULT);
				$fetchResponse = $fetchData->registerCheck($email);
				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status']) && $fetchResponse['status'] ==1){

						$response = array('status'=>0,'input'=>"details",'message'=>"A User already exist with this email address please try again with another valid email. ");
					}else {
						$insertResponse = $insertData->register($name,$email,$phone,$password);
						if ($insertResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"User Registration Successful");

						}else {
							$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
						}
					}


				}




			}
		}

	break;


	case "subscribe":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$name = $processRequest->test_input($_POST['name']);
			$email = $processRequest->test_input($_POST['email']);
			$category = $processRequest->test_input($_POST['category']);
			

			if (empty($name) or (!preg_match("/^[a-zA-Z ]+$/i",$name))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Name is required and must contain only alphabets");
			}

			elseif(empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'message'=>"Valid email is required ");
			}elseif (empty($category)) {
				$response = array('status'=>0,'message'=>"Please Select A Category ");
			}
			

			else {
				
				$fetchResponse = $fetchData->subscribeCheck($email);
				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status']) && $fetchResponse['status'] ==1){

						$response = array('status'=>0,'input'=>"details",'message'=>"You have already subscribed to our newsletter, Thank You. ");
					}else {
						$insertResponse = $insertData->subscribe($name,$email,$category);
						if ($insertResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"Newsletter Subscription Successful");

						}else {
							$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
						}
					}


				}




			}
		}

	break;

	case "contact-us":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$name = $processRequest->test_input($_POST['name']);
			$email = $processRequest->test_input($_POST['email']);
			$subject = $processRequest->test_input($_POST['subject']);
			$message = $processRequest->test_input($_POST['message']);


			

			if (empty($name) or (!preg_match("/^[a-zA-Z ]+$/i",$name))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Name is required and must contain only alphabets");
			}

			elseif(empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'message'=>"Valid email is required ");
			}elseif (empty($subject)) {
				$response = array('status'=>0,'message'=>"Please Enter A Subject ");
			}elseif (empty($message)) {
				$response = array('status'=>0,'message'=>"Please Enter Message ");
			}
			

			else {
				
				
				$headers = "From: "  .$email. "\r\n";
	            $headers .= "MIME-Version: 1.0\r\n";
	            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	            $msg = "New Message From Anny Ikebudu Web Platform \r\n";
	            $msg .= "Senders Name : ". $name . "\r\n";
	            $msg .= "Senders Email : ". $email . "\r\n";
	            $msg .= "Message SUbject : ". $subject . "\r\n";
	            $msg .= "Message Content : ". $message . "\r\n";

				
				if (mb_send_mail("info@annyikebudu.org", $subject, $msg, $headers)) {
					$response = array('status'=>1,'input'=>"details",'message'=>"Message Sent Successfully");
				}else{
					$response = array('status'=>0,'input'=>"details",'message'=>"Unable To Send Message Please Refresh This Page And Try Again");
				}





			}
		}

	break;


	case "freeResource":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$name = $processRequest->test_input($_POST['name']);
			$email = $processRequest->test_input($_POST['email']);
			$phone = $processRequest->test_input($_POST['phone']);
			$training_slug = $processRequest->test_input($_POST['training_slug']);
			

			if (empty($name) or (!preg_match("/^[a-zA-Z ]+$/i",$name))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Name is required and must contain only alphabets");
			}

			elseif(empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'message'=>"Valid email is required ");
			}elseif (empty($phone)) {
				$response = array('status'=>0,'message'=>"Please enter a valid phone number ");
			}
			

			else {
				
				$insertResponse = $insertData->freeResource($name,$email,$phone,$training_slug);
				if ($insertResponse['status']) {
					$getFreeResources = $fetchData->fetchFreeResourcesBySlug($training_slug);
					if (is_array($getFreeResources)){
						foreach ($getFreeResources as $resource) {
							$free_link = $resource['link'];	
						}

						$fullLink =  "free-download.php?link=".$free_link."&&training_slug=".$training_slug;

						$subject = "Free Resource Download From Anny Ikebudu";

						$headers = "From: free-download@annyikebudu.org"  . "\r\n";
			            $headers .= "MIME-Version: 1.0\r\n";
			            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			            $message = '<html><body>';
			            $message .= '<div style="background: #000;text-align:center;color:#fff;padding:30px"><div style="background: #fff; padding 20px; text-align:center;color:#000">';
			            
			           
			            $message .= '<h3>Hello '.$name. ', Here are the details for your Free Resource from Anny Ikebudu </h3>';
			            $message .= '<h3 style="margin-bottom:30px">Please Use The Button  Below To Download Your Free Resource</h3>';
			            
			            $message .= '<a href="'.$fullLink.'" style="border:1px solid #fff;background:#DAA419;color:#fff;padding:20px 30px;text-decoration:none;margin:20px;">Download Your Copy</a>';

			            $message .= '<div>Or Use The Link : '.$fullLink.' </div>';

			            
			            
			            
			            $message .= '</div></div>';
			            $message .= '</body></html>';

						
						if (mb_send_mail($email, $subject, $message, $headers)) {
							$response = array('status'=>1,'input'=>"details",'free_link'=>$free_link,'training_slug'=>$training_slug,'message'=>"Your free resource will be downloaded automatically to your device and a back up download link has been send to your email");

						}else{
							$response = array('status'=>1,'input'=>"details",'free_link'=>$free_link,'training_slug'=>$training_slug,'message'=>"Your free resource will be downloaded automatically to your device and a back up download link has been send to your email");
						}
						
					}

				}else {
					$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
				}




			}
		}

	break;


	


	case "changeStatus":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$training_status = $processRequest->test_input($_POST['training_status']);
			$id = $processRequest->test_input($_POST['id']);
			$email = $_SESSION['email'];

			if (empty($training_status)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Error Updating Status");
			}

			elseif(empty($id)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Error Updating Status");
			}
			

			else {
				$updateResponse = $updateData->updateTrainingStatus($training_status,$email,$id);

				if ($updateResponse['status']) {
					$response = array('status'=>1,'message'=>"Status Updated Successfully");

				}else {
					$response = array('status'=>0, 'message'=>$updateResponse['message']);
				}

			}
		}

	break;

	

	


	case "login":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$email = $processRequest->test_input($_POST['email']);
			$password = $processRequest->test_input($_POST['password']);

			if (empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"*email is required and must be a valid email format");
			}
			elseif (empty($password)) {
				$response =array('status'=>0, 'input'=>"details",'message'=>"*password is required");
			}

			else {
				$fetchResponse = $fetchData->userLogin($email);

				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status'])){
						if ($fetchResponse['status']=="0") {
							$response =array('status'=>0, 'input'=>"details",'message'=>"email address or password is incorrect");
						}
						else if($fetchResponse['status']==1){
							$checkPass = $fetchResponse['password'];
							if (password_verify($password, $checkPass)) {
								$response =array('status'=>1, 'input'=>"details",'message'=>"Login Successful, Redirecting to your dashboard...");
								$_SESSION['email']=$email;

							}
							else{
								$response =array('status'=>0, 'input'=>"details",'message'=>"email or password is incorrect");
							}
						}
					}
				}
			}	
		}
	break;

	case "adminLogin":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$email = $processRequest->test_input($_POST['email']);
			$password = $processRequest->test_input($_POST['password']);

			if (empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"*email is required and must be a valid email format");
			}
			elseif (empty($password)) {
				$response =array('status'=>0, 'input'=>"details",'message'=>"*password is required");
			}

			else {
				$fetchResponse = $fetchData->adminLogin($email);

				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status'])){
						if ($fetchResponse['status']=="0") {
							$response =array('status'=>0, 'input'=>"details",'message'=>"Email address or password is incorrect");
						}
						else if($fetchResponse['status']==1){
							$checkPass = $fetchResponse['password'];
							if (password_verify($password, $checkPass)) {
								$response =array('status'=>1, 'input'=>"details",'message'=>"Login Successful, Redirecting to your dashboard...");
								$_SESSION['email']=$email;

							}
							else{
								$response =array('status'=>0, 'input'=>"details",'message'=>"email or password is incorrect");
							}
						}
					}
				}
			}	
		}
	break;

	


	case "purchases":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$training_slug = $processRequest->test_input($_POST['training_slug']);
			$user_email = $_SESSION['email'];
			$training_status = "Not Completed";
			

			if (empty($training_slug)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Training Slug Not Found");
			}
			
			else {
			
				$insertResponse = $insertData->addPurchase($training_slug,$user_email,$training_status);
				if ($insertResponse['status']){
					$fetchResponse = $fetchData->getStudent($training_slug);
					if($fetchResponse['status']==1){
						$students = $fetchResponse['students'];
						$students += 1;
						$updateResponse = $updateData->updateStudents($training_slug,$students);
						if ($updateResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"Purchase Completed Successfully");

						}else {
							$response = array('status'=>0, 'input'=>"details", 'message'=>$updateResponse['message']);
						}
					}else{
						$response = array('status'=>1,'input'=>"details",'message'=>"Purchase Completed Successfully");
					}

				}else {
					$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
				}

			}
		}

	break;




	case "updateProfile":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$name = $processRequest->test_input($_POST['name']);
			$email = $_SESSION['email'];
			$phone = $processRequest->test_input($_POST['phone']);
			
			if (empty($name) or (!preg_match("/^[a-zA-Z ]+$/i",$name))) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Name is required and must contain only alphabets");
			}

			elseif (empty($phone)) {
				$response = array('status'=>0,'message'=>"Valid Phone Number Is Required ");
			}
			

			else {
				$updateResponse = $updateData->updateProfile($name,$email,$phone);
				if ($updateResponse['status']) {
					$response = array('status'=>1,'input'=>"details",'message'=>"Profile Updated Successfully");

				}else {
					$response = array('status'=>0, 'input'=>"details", 'message'=>$updateResponse['message']);
				}
			}	
		}
	break;

	case "updateUserProfile":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$email = $_SESSION['email'];
			$oldPass = $processRequest->test_input($_POST['current-password']);
			$newPass = $processRequest->test_input($_POST['new-password']);
			$confirmPass = $processRequest->test_input($_POST['confirm-password']);
			
			if (empty($oldPass)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"*Current Password is required ");
			}


			elseif (empty($newPass)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"*New Password is required");
			}

			elseif (empty($confirmPass)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"*Please Confirm New Password");
			}
			elseif ($newPass !== $confirmPass) {
				$response =array('status'=>0, 'input'=>"details",'message'=>"*Password Mismatch, New Password Does Not Match With Confirm Password");
			}
			elseif ($newPass == $oldPass) {
				$response =array('status'=>0, 'input'=>"details",'message'=>"*Old Password And New Password Are The Same Please Change or Enter A Different New Password");
			}
			else {
				$tblName = "users";
				$fetchResponse = $fetchData->fetchUserData($email,$tblName);
				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status'])){
						$response = array('status'=>0, 'input'=>"details",'message'=>"There was an error updating your password");
					}else {
						foreach($fetchResponse as $row){
							if (password_verify($oldPass, $row['password'])) {
								$response = array('status'=>1, 'input'=>"details",'message'=>"done");
								$newPass = password_hash($newPass, PASSWORD_DEFAULT);
								$updateResponse = $updateData->updateUserPassword($email,$newPass);
								if ($updateResponse['status']) {
									$response = array('status'=>1,'input'=>"details",'message'=>"Your Password Was Successfully Updated");

								}else {
									$response = array('status'=>0,'message'=>$updateResponse['message']);
								}
							}
							else{
								$response = array('status'=>0, 'input'=>"details",'message'=>"Current Password Is Incorrect, Please Confirm And Try Again");
							}

						}
					}				
				}
				else{
					$response = array('status'=>0, 'input'=>"details",'message'=>"There was an error updating your password");
				}
			} 
		}
	break;


	case "addTraining":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$title = $processRequest->test_input($_POST['title']);	
			$category = $processRequest->test_input($_POST['category']);	
			$author = $processRequest->test_input($_POST['author']);	
			$price = $processRequest->test_input($_POST['price']);	
			$short_description = $processRequest->test_input($_POST['short_description']);	

			$full_description = $processRequest->test_input($_POST['full_description']);

			$students = 0;

			$target_dir = "../../panel-admin/img/";
			

			if (empty($title)){
					$response =array('status'=>0, 'input'=>"details",'message'=>"Title Required");
			}
			elseif (empty($category)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Category is required");
			}

			elseif (empty($author)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Author is Required");
			}

			elseif (empty($price) && $price != 0) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Price is Required");
			}
			elseif (empty($short_description)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Add a short description");
			}
			elseif (empty($short_description)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Add a full description");
			}
			
			elseif (empty($_FILES["fileToUpload"]["name"])) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Please Select The Training Image");
				
			}

			else{
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = filesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Invalid File Format");
				} 


				if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" ) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, only png, jpg, jpeg & png files are allowed.");

				}
				elseif ($_FILES["fileToUpload"]["size"] > 10000000) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, THe Image Is Too Large, Image Must Not Be More Than 10MB");

				}
				else{
					$temp = explode(".", $_FILES["fileToUpload"]["name"]);
					$image = round(microtime(true)) . '.' . end($temp);
					if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $image)){

						$training_slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
						$training_slug = $training_slug ."-".time();

						$insertResponse = $insertData->addTraining($title,$short_description,$full_description,$category,$author,$price,$students,$training_slug,$image);
						if ($insertResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"Training Added Successfully");

						}else {
							$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
						}
					}else{
						$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding New Training Please Try Again");
					}
					
				}
			}	
			
		}else{
			$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding New Training Please Try Again");
		}




	break;

	case "updateTraining":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$title = $processRequest->test_input($_POST['title']);	
			$category = $processRequest->test_input($_POST['category']);	
			$author = $processRequest->test_input($_POST['author']);	
			$price = $processRequest->test_input($_POST['price']);	
			$short_description = $processRequest->test_input($_POST['short_description']);
			$training_slug = $processRequest->test_input($_POST['training_slug']);	
			

			$full_description = $processRequest->test_input($_POST['full_description']);


			$target_dir = "../../panel-admin/img/";


			if (empty($_FILES["fileToUpload"]["name"])) {
				$fetchResponse = $fetchData->fetchBySlug($training_slug);
				if(is_array($fetchResponse)){
					if(isset($fetchResponse['status'])){
						'<div class="alert alert-danger">'.print_r($fetchResponse['message']).'</div>';
					}else {
						foreach($fetchResponse as $row){
							$image = $row['image'];
						}
					}
				}
			}
			else{
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = filesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Invalid File Format");
				} 


				if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" ) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, only png, jpg, jpeg & png files are allowed.");

				}
				elseif ($_FILES["fileToUpload"]["size"] > 10000000) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, THe Image Is Too Large, Image Must Not Be More Than 10MB");

				}
				else{
					$temp = explode(".", $_FILES["fileToUpload"]["name"]);
					$image = round(microtime(true)) . '.' . end($temp);
					move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $image);
					
					
				}
			}
			

			if (empty($title)){
					$response =array('status'=>0, 'input'=>"details",'message'=>"Title Required");
			}
			elseif (empty($category)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Category is required");
			}

			elseif (empty($author)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Author is Required");
			}

			elseif (empty($price) && $price != 0) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Price is Required");
			}
			elseif (empty($short_description)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Add a short description");
			}
			elseif (empty($short_description)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Add a full description");
			}
			
			elseif (empty($image)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Please Select The Training Image");
				
			}else{
				
				$updateResponse = $updateData->updateTraining($title,$short_description,$full_description,$category,$author,$price,$training_slug,$image);
				if ($updateResponse['status']) {
					$response = array('status'=>1,'input'=>"details",'message'=>"Training Updated Successfully");

				}else {
					$response = array('status'=>0, 'input'=>"details", 'message'=>$updateResponse['message']);
				}
				
			}

	
			
		}else{
			$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding Updating Training Please Try Again");
		}




	break;





	case "addResource":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$type = $processRequest->test_input($_POST['type']);	
			$training_slug = $processRequest->test_input($_POST['training_slug']);	
			
			$target_dir = "../../panel-admin/uuiikeosm/";
			

			if (empty($type)){
					$response =array('status'=>0, 'input'=>"details",'message'=>"Type Required");
			}
			elseif (empty($training_slug)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Select A Training");
			}

			
			
			elseif (empty($_FILES["fileToUpload"]["name"])) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Please Select The Training Resource File");
				
			}

			else{
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = filesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Invalid File Format");
				} 


				if($imageFileType != "pdf" && $imageFileType != "mp4" && $imageFileType != "mp3"
					&& $imageFileType != "docx" && $imageFileType != "PDF" && $imageFileType != "MP4" && $imageFileType != "MP3" && $imageFileType != "DOCX" ) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, only pdf, mp4, mp3 & docx files are allowed.");

				}
				elseif ($_FILES["fileToUpload"]["size"] > 100000000) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, THe Image Is Too Large, Image Must Not Be More Than 100MB");

				}
				else{
					$temp = explode(".", $_FILES["fileToUpload"]["name"]);
					$link = round(microtime(true)) . '.' . end($temp);
					if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $link)){


						$insertResponse = $insertData->addResource($type,$link,$training_slug);
						if ($insertResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"Training Resource Added Successfully");

						}else {
							$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
						}
					}else{
						$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding  Training Resource Please Try Again");
					}
					
				}
			}	
			
		}else{
			$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding New Training Please Try Again");
		}




	break;



	case "addFreeResource":
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$type = $processRequest->test_input($_POST['type']);	
			$training_slug = $processRequest->test_input($_POST['training_slug']);	
			
			$target_dir = "../../panel-admin/uuiikeosm/";
			

			if (empty($type)){
					$response =array('status'=>0, 'input'=>"details",'message'=>"Type Required");
			}
			elseif (empty($training_slug)) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Select A Training");
			}

			
			
			elseif (empty($_FILES["fileToUpload"]["name"])) {
				$response = array('status'=>0,'input'=>"details",'message'=>"Please Select The Training Resource File");
				
			}

			else{
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = filesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Invalid File Format");
				} 


				if($imageFileType != "pdf" && $imageFileType != "mp4" && $imageFileType != "mp3"
					&& $imageFileType != "docx" && $imageFileType != "PDF" && $imageFileType != "MP4" && $imageFileType != "MP3" && $imageFileType != "DOCX" ) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, only pdf, mp4, mp3 & docx files are allowed.");

				}
				elseif ($_FILES["fileToUpload"]["size"] > 100000000) {
					$response = array('status'=>0,'input'=>"details",'message'=>"Sorry, THe Image Is Too Large, Image Must Not Be More Than 100MB");

				}
				else{
					$temp = explode(".", $_FILES["fileToUpload"]["name"]);
					$link = round(microtime(true)) . '.' . end($temp);
					if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $link)){


						$insertResponse = $insertData->addFreeResource($type,$link,$training_slug);
						if ($insertResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"Free Training Resource Added Successfully");

						}else {
							$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
						}
					}else{
						$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding Free Training Resource Please Try Again");
					}
					
				}
			}	
			
		}else{
			$response = array('status'=>0,'input'=>"details",'message'=>"Error Adding Free Training Please Try Again");
		}




	break;






	
	case "addAdmin":
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$name = $processRequest->test_input($_POST['name']);
		$email = $processRequest->test_input($_POST['email']);
		$password = $processRequest->test_input($_POST['password']);
		$confirmPass = $processRequest->test_input($_POST['confirmPass']);

		if (empty($name) or (!preg_match("/^[a-zA-Z ]+$/i",$name))) {
			$response = array('status'=>0,'input'=>"details",'message'=>"Name is required and must contain only alphabets");
		}


		elseif(empty($email) or (!filter_var($email, FILTER_VALIDATE_EMAIL,$email))) {
			$response = array('status'=>0,'input'=>"details",'message'=>"Valid email is required ");
		}
		elseif (empty($password)) {
			$response = array('status'=>0,'input'=>"details",'message'=>"password is required ");
		}
		elseif ($password != $confirmPass) {
			$response = array('status'=>0,'input'=>"details",'message'=>" Password Mismatch, Password must match confirm password ");
		}

		else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$fetchResponse = $fetchData->registerCheckAdmin($email);
			if(is_array($fetchResponse)){
				if(isset($fetchResponse['status']) && $fetchResponse['status'] ==1){

					$response = array('status'=>0,'input'=>"details",'message'=>"An Admin already exist with this email. ");
				}else {
					$insertResponse = $insertData->addAdmin($name,$email,$password);
					if ($insertResponse['status']) {
						$response = array('status'=>1,'input'=>"details",'message'=>"New Admin Added Successfully");

					}else {
						$response = array('status'=>0, 'input'=>"details", 'message'=>$insertResponse['message']);
					}
				}


			}




		}
	}

	break;



case "updateAdminPassword":
if ($_SERVER["REQUEST_METHOD"] == "POST") {


	$email = $_SESSION['email'];
	$oldPass = $processRequest->test_input($_POST['current-password']);
	$newPass = $processRequest->test_input($_POST['new-password']);
	$confirmPass = $processRequest->test_input($_POST['confirm-password']);

	if (empty($oldPass)) {
		$response = array('status'=>0,'input'=>"details",'message'=>"*Current Password is required ");
	}


	elseif (empty($newPass)) {
		$response = array('status'=>0,'input'=>"details",'message'=>"*New Password is required");
	}

	elseif (empty($confirmPass)) {
		$response = array('status'=>0,'input'=>"details",'message'=>"*Please Confirm New Password");
	}
	elseif ($newPass !== $confirmPass) {
		$response =array('status'=>0, 'input'=>"details",'message'=>"*Password Mismatch, New Password Does Not Match With Confirm Password");
	}
	elseif ($newPass == $oldPass) {
		$response =array('status'=>0, 'input'=>"details",'message'=>"*Old Password And New Password Are The Same Please Change or Enter A Different New Password");
	}
	else {
		$tblName = "admin";
		$fetchResponse = $fetchData->fetchUserData($email,$tblName);
		if(is_array($fetchResponse)){
			if(isset($fetchResponse['status'])){
				$response = array('status'=>0, 'input'=>"details",'message'=>"There was an error updating your password");
			}else {
				foreach($fetchResponse as $row){
					if (password_verify($oldPass, $row['password'])) {
						$response = array('status'=>1, 'input'=>"details",'message'=>"done");
						$newPass = password_hash($newPass, PASSWORD_DEFAULT);
						$updateResponse = $updateData->updateAdminPassword($email,$newPass);
						if ($updateResponse['status']) {
							$response = array('status'=>1,'input'=>"details",'message'=>"Your Password Was Successfully Updated");

						}else {
							$response = array('status'=>0,'message'=>$updateResponse['message']);
						}
					}
					else{
						$response = array('status'=>0, 'input'=>"details",'message'=>"Current Password Is Incorrect, Please Confirm And Try Again");
					}

				}
			}				
		}
		else{
			$response = array('status'=>0, 'input'=>"details",'message'=>"There was an error updating your password");
		}
	}   
}

break;







default:
$response = array("status"=>0,"message"=>"Invalid Request, please check what you're doing");
break;
}

echo json_encode($response);
?>



