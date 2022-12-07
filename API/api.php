<?php

function getDeviceId(){
   $pdo = getConnexion();
   $req = "SELECT * FROM `device`;";
   $stmt = $pdo->prepare($req);
   $stmt->execute();
   $Device = $stmt->fetchALL(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   print_r($Device);
}

function getInformationByDeviceId($deviceId){

    $pdo = getConnexion();
    $req = "SELECT * FROM `device_id` WHERE Id = $deviceId;";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $Device = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    print_r($Device);
    //echo "Temperature de 25¨degres..................... Etat : ON";
}

function getConnexion(){
    return new PDO("mysql:host=localhost;dbname=projet_iot_test","root","");
}

function InsertNewMesure($deviceID,$State,$Teamperature) {
    $pdo = getConnexion();
    $req = "INSERT INTO `device_id` (`Id`, `Etat`, `Temperature`) VALUES ($deviceID, $State, $Teamperature);";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $Device = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
}

function Signin($username,$password) {
    $pdo = getConnexion();
    $req = "INSERT INTO `identification` (`Username`, `Password`) VALUES ('$username', '$password')";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $Device = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    echo "Le login est bien enregistré";

}

function TryLogin($username,$password) {

    $db = mysqli_connect('localhost', 'root', '', 'projet_iot_test');

    // get the username and password provided by the user

    // check if a user with the given username exists in the database
    $query = "SELECT * FROM identification WHERE username = '$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // a user with the given username was found in the database
        // get the user's record from the result set
        $user = mysqli_fetch_assoc($result);
        // check if the provided password matches the password for the user in the database
        if (password_verify($password, $user['Password'])) {
            // the password is correct, the user is authenticated
            // redirect the user to the authenticated page
            echo 'Le password est bon';
        } else {
            // the password is incorrect, the user is not authenticated
            // display an error message to the user
            echo 'Incorrect username or passwordddddddd';
        }
    } else {
        // no user with the given username was found in the database
        // display an error message to the user
        echo 'Incorrect username or password';
    }
}


function LatestInfoFromDevice($deviceId,$Information) {
    $pdo = getConnexion();
    $req = "SELECT * FROM `device_id` WHERE Id = $deviceId;";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $DeviceInfo = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    print_r($DeviceInfo);

}


function Subsribe() {
    $server = 'localhost';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$client_id = 'phpMQTT-publisher'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish('kzsbkhkhkjoio', 'Salut louis ' . date('r'), 0, false);
    echo $mqtt->subscribeAndWaitForMessage('bluerhinos/phpMQTT/examples/publishtest', 0);
	$mqtt->close();
} else {
    echo "Time out!\n";
}
}



