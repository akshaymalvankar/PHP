<?php
$api = curl();
$json_output = json_decode($api, true);
//print_r($json_output);
if($json_output['success'] != ''){
	$suucess = $json_output['success'];
	print($suucess);
}
else if($json_output['errorMessage'] != ''){
	$error = $json_output['errorMessage'];
	print($error);
}
//$json_output['errorMessage'];
function curl(){
$url = 'http://115.249.135.249/EdelweissWebService/api/PushLead';
//$url = 'http://api.payquicker.com/api/SendInvitation';
$data = array("first_name" => "First name","last_name" => "last name","email"=>"email@gmail.com");

/*$data = array(
  "authorizedKey" => "abbad35c5c01-xxxx-xxx",
  "senderEmail" => "myemail@yahoo.com",
  "recipientEmail" => "jaketalledo86@yahoo.com",
  "comment" => "Invitation",
  "countryCode" =>"+91",
  "forceDebitCard" => "false"
);*/
$postdata = json_encode($data);
//print_r($postdata);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
//return $result;
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_error($ch)) {
    $error_msg = curl_error($ch);
	echo "CURL error ".$error_msg;
}

curl_close($ch);
}

