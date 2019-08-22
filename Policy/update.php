<?php
include_once '../Policy/config/headers.php';
include_once '../Policy/config/databaseconnection.php';
include_once '../Policy/models/policy.php';

// Instatiate DB & connect
$database = new Connection();
$dbconn = $database->openConnection();

$policy = new Policy($dbconn);

// Getting Data from request send by Client
$data = json_decode(file_get_contents("php://input"));

$policy->id = htmlspecialchars(strip_tags($data->id));
$policy->name = htmlspecialchars(strip_tags($data->name));
$policy->amount = htmlspecialchars(strip_tags($data->amount));

if ($policy->update()) {
    echo json_encode(
        array('success' => 'Record updated successfully')
    );
} else {
    echo json_encode(
        array('error' => 'Failed to update record !')
    );
}
