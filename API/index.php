<?php
require_once("./api.php");
require("phpMQTT.php");


try{
    if(!empty($_GET['demande'])){
        $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
        switch($url[0]){
            case "DeviceId" :
                if(empty($url[1])){
                    getDeviceId();
                } else {
                    getInformationByDeviceId($url[1]);
                }
            break;

            case "NewDevice" : 
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        if(empty($url[3])){
                            throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 3");
                        } else {
                            
                                InsertNewMesure($url[1],$url[2],$url[3]);
                            
                        }
                    }
                }
            break;

            case "Signin" :
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        Signin($url[1],$url[2]);
                    }

                }
            break;

            case "Login" : 
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 2");
                    } else {
                        TryLogin($url[1],$url[2]);
                    }

                }
            break;

            case "Latest" :
                if(empty($url[1])){
                    throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                } else {
                    if(empty($url[2])){
                        throw new Exception ("La demande n'est pas valide, véirifez l'URL au niveau 1");
                    } else{
                        LatestInfoFromDevice($url[1],$url[2]);
                    }
                }

            
        }
    } else {
      
        throw new Exception ("Probleme de récupération de données.");
    }
} catch(Exception $e){
    $erreur = [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}
?>

<html>
    <head>
    <title> JavaScript MQTT</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

     <script>  
       var mqtt;
        var reconnextTimeout = 2000;
        var host ="128.128.0.58";
        var port =2306;

        function onConnect(){
            console.log("Connected to mqtt server");
            mqtt.subscribe("test");
            message = new Paho.MQTT.Message("Connected");
            message.destinationName= "Verification_connect";
            mqtt.send(message);
        }

        function MQTTconnect() {
            console.log("connecting to "+host + "" +port);
            mqtt = new Paho.MQTT.Client(host,port,"clientjs");
            var options ={
                timeout: 3,
                onSuccess:onConnect,
                onFailure:onFailure,                
            };
            mqtt.onMessageArrived = onMessageArrived
            mqtt.connect(options);
        }
        function onFailure(message) {
            console.log("conneciton fail");
            setTimeout(MQTTconnect, reconnectTimeout);
        }
        function onMessageArrived(msg){
            out_msg=msg.payloadString+"<br>";
            console.log(out_msg);
            var div = document.getElementById("message");
            div.innerHTML = out_msg;
        }
        
       
</script>
    </head>
    <body>
    <h1></h1>
    <div id="message"></div>
    <script>
        MQTTconnect();
    </script>
    </body>


</html>

