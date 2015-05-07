<?php

		function send_sms($foneNumber,$mySMSMsg,$msgType,$sender_id,array $param, $url)
		{
				$request = "";
				
				//send message to all contacts
				$param["message"] = stripslashes($mySMSMsg); //this is the message that we want to send
				$param["mobile"] = $foneNumber; //these are the recipients of the message					
				$param["sender"] = $sender_id;//this is our sender
				$param["type"] = $msgType;//we are only simulating a broadcast
				
				foreach($param as $key=>$val) //traverse through each member of the param array
				{
						$request.= $key."=".urlencode($val); //we have to urlencode the values
						$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
				}
				
				$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request			
				
				$ch = curl_init(); //initialize curl handle
				curl_setopt($ch, CURLOPT_URL, $url); //set the url
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
				curl_setopt($ch, CURLOPT_POST, 1); //set POST method
				curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
				$response = curl_exec($ch); //run the whole process and return the response
				curl_close($ch); //close the curl handle
				//print $response; //show the result onscreen for debugging	
		}
	
		function foneFormatToSendSMS($string)
		{
				return "234".substr($string, -10);//true
		}

?>