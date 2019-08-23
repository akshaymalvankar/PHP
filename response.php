<?php
$message = array(
"success"=>"successful",
"warning"=>"could not be send",
"error"=>"failed"
);
$postdata = json_encode($message);
echo  $postdata;
?>