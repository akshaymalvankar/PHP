<?php
include_once './api/logger.php';
if (isset($_POST['btnsubmit'])) {
    $data = array(
        "username" => "akshay",
        "password" => "akshay",
    );
    callLoginApi($data);
}

function callLoginApi($data)
{

    try {
        //print_r($data);
        //http://localhost/jwt_api/api/login.php
        //$url = 'http://localhost/jwt_api/api/login.php';
        $url = 'http://localhost/jwt_api/api/login1.php';

        //open connection
        $postdata = json_encode($data);
        //print_r($postdata);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Control-Allow-Origin: *', 'Content-Type: application/json', 'Access-Control-Allow-Methods: POST', 'Access-Control-Max-Age: 3600'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $result = json_decode($output);
        if ($result->message == 'Successful login') {
            $jwtname = "Access";
            $jwt = $result->jwt;
            setcookie($jwtname, $jwt, time() + (86400 * 30), "/");
            header("location:create.php");
        }
    } catch (Exception $e) {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        Logger::save($e);
        Logger::LogWebApiError($http_code, 'something went wrong', 'index.php', 'callLoginApi()');
        curl_close($ch);

    }

}

?>
<html>
<body>
<form method="post" action="index.php">
	<input type="submit" name="btnsubmit">
</form>
</body>
</html>
