<?php
include_once '../Policy/config/headers.php';
include_once '../Policy/config/databaseconnection.php';
include_once '../Policy/models/policy.php';

// Instatiate DB & connect
$database = new Connection();
$dbconn = $database->openConnection();

$policy = new Policy($dbconn);

// Getting Data from request send by Client
$id = $_GET['id'];

$policy->id = htmlspecialchars(strip_tags($id));

if($policy->delete()){
    echo json_encode(
        array('success'=>'Record deleted successfully')
    );
} else{
    echo json_encode(
        array('error'=> 'Failed to deleted record !')
    );
}