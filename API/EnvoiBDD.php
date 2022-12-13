<?php

require_once("./api.php");
require("phpMQTT.php");

$server = '128.128.0.58';     // change if necessary
$port = 2305;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$client_id = 'phpMQTT-subscribe-msg'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

while (true)
{
if(!$mqtt->connect(true, NULL, $username, $password)) {
        exit(1);
}
$data = $mqtt->subscribeAndWaitForMessage('temperature', 0);
//echo $mqtt->subscribeAndWaitForMessage('temperature', 0);


if($test=! 0){
    DataToBDD($data);
}


}