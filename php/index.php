<?php  
error_reporting(0);
$test=$_POST;
$flag=1;
if(!isset($_POST["action"])){
	header('Location: http://www.mahavirtravels.co/');
}
else{

		$r=array();
		$s="";
		if ($_POST["action"]=="send_inquiry_form") {
			$s="Enquiry";
		}elseif ($_POST["action"]=="send_newsletter_form") {
			$s="Subscribe";
		} 
		else {
			$s="Message";
		}

			try{
						$string=printArray($_POST);
				
						$to      = 'nishang@mahavirtravels.co';
						$subject = $s;
						$message = $string;
						$headers = 'From: enquiry@mahavirtravels.co';

						$mail=mail($to, $subject, $message, $headers);
						if(!$mail){
							throw new Exception("Mail Can not Send");
						}
						
						$r["result"]="success";
						$r["msg"][]="Success! Your contact request has been send.";
				
				

			}
			catch(Exception $e){
				$r["result"]="error";
				$r["msg"][]="Error! Your contact request has not been send. Please Try Again Later";
			}
			
		echo json_encode($r);
}
function printArray($array){
					$msg="";
				     foreach ($array as $key => $value){
				        $msg=$msg."$key => $value \n";
				        if(is_array($value)){ //If $value is an array, print it as well!
				            printArray($value);
				        }  
				    } 
				    return $msg;
				}
?>