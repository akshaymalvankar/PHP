<?php
$headers = apache_request_headers();
if(!empty($headers['Authorization'])){
    http_response_code(200);

    echo json_encode(array(
        "message" => "Access granted."
        //"error" => $e->getMessage()
    ));
}
else{
    http_response_code(401);

    echo json_encode(array(
        "message" => "Access denied."
       // "error" => $e->getMessage()
    ));
}

?>