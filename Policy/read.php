<?php
include_once '../Policy/config/headers.php';
include_once '../Policy/config/databaseconnection.php';
include_once '../Policy/models/policy.php';

// Instatiate DB & connect
$database = new Connection();
$dbconn = $database->openConnection();

$policy = new Policy($dbconn);

$result = $policy->read();
$num = $result->rowCount();

// check have any records or not
if ($num > 0) {
    $poilcy_arr = array();
    $policy_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $policy_item=array(
            "id" => $id,
            "name" => $name,
            "amount" => $amount
            
        );
        array_push($policy_arr["data"], $policy_item);
        
    }
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($policy_arr);
    
} else {
    echo json_encode(
        array('error' => 'No Record Found!')
    );
}
