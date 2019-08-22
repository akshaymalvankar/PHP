<?php
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = $data->password;

if(isset($username) && isset($password)){
$secret_key = "abjsvjd16542649889988#$%#%#%%";
$issuer_claim = "localhost"; // this can be the servername
$audience_claim = "THE_AUDIENCE";
$issuedat_claim = time(); // issued at
$notbefore_claim = $issuedat_claim + 10; //not before in seconds
$expire_claim = $issuedat_claim + 60; // expire time in seconds
$token = array(
    "iss" => $issuer_claim,
    "aud" => $audience_claim,
    "iat" => $issuedat_claim,
    "nbf" => $notbefore_claim,
    "exp" => $expire_claim,
    "data" => array(
        "id" => 1,
        "firstname" => "Akshay",
        "lastname" => "Malvankar",
        "email" => "malvankar@gmail.com"
));

http_response_code(200);

$jwt = JWT::encode($token, $secret_key);
echo json_encode(
    array(
        "message" => "Successful login",
        "jwt" => $jwt,
        "email" => "malvankar@gmail.com",
        "expireAt" => $expire_claim
    ));
}
else{

http_response_code(401);
echo json_encode(array("message" => "Login failed.", "password" => $password));
}
?>