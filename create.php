<?php
$jwtname = "Access";
if(!isset($_COOKIE[$jwtname])) {
    //echo "Cookie named '" . $jwtname . "' is not set!";
} else {
    //echo "Cookie '" . $jwtname . "' is set!<br>";
    //echo "Value is: " . $_COOKIE[$jwtname];
}

$url = 'http://localhost/jwt_api/api/create.php';
$data= array(
    "username"=>"akshay",
    "password"=>"akshay"
);
//open connection
$postdata = json_encode($data);
//print_r($postdata);
/*$header = array();
$header[] = 'Access-Control-Allow-Origin: *';
$header[] = 'Content-type: application/json';
$header[] = 'Access-Control-Allow-Methods: POST';
$header[] = 'Access-Control-Max-Age: 3600';
$header[] = 'Authorization:'.$_COOKIE[$jwtname];*/
//print_r($header);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Control-Allow-Origin: *','Content-Type: application/json','Access-Control-Allow-Methods: POST','Access-Control-Max-Age: 3600','Authorization:'.$_COOKIE[$jwtname]));
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
echo $output;
$result = json_decode($output);


if (curl_error($ch)) {
    $error_msg = curl_error($ch);
	echo "CURL error ".$error_msg;
}

curl_close($ch);


?>